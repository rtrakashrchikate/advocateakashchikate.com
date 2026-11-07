"""Draft review replies and Business Profile posts.

Replies are written for an advocate's practice, so they follow two rules:

  * Confidentiality: a reply never confirms that the reviewer was a client,
    never mentions a case, court, charge or outcome, and never repeats
    details from the review.
  * Bar Council of India Rule 36 (no solicitation): a reply thanks or
    acknowledges. It does not advertise results, invite people to hire the
    firm, or quote fees.

Every draft is a starting point. Nothing is posted until a person sets
"approved": true in the drafts file and runs the publish command.
"""

from __future__ import annotations

import re

from .api import STARS

MAX_REPLY = 4096
MAX_POST_SUMMARY = 1500

OFFICE_LINE = "Advocate Akash R. Chikate & Associates"

REPLY_TEMPLATES = {
    "positive": (
        "Thank you{name} for taking the time to share your feedback. "
        "We appreciate your kind words.\n- " + OFFICE_LINE
    ),
    "neutral": (
        "Thank you{name} for your feedback. We take every comment seriously "
        "and would welcome the chance to hear more. Please call the office "
        "during working hours.\n- " + OFFICE_LINE
    ),
    "negative": (
        "Thank you{name} for your feedback. We are sorry to read about your "
        "experience. To protect everyone's privacy we do not discuss any "
        "matter in a public forum. Please contact the office directly so we "
        "can look into your concerns.\n- " + OFFICE_LINE
    ),
}

# Words that suggest the reviewer is not a client at all (spam, wrong
# business, competitor). These are flagged for a human, never auto-drafted.
SUSPECT_PATTERNS = re.compile(r"\b(fake|scam|fraud|wrong (number|place|business))\b", re.I)


def star_value(review: dict) -> int:
    return STARS.get(review.get("starRating", ""), 0)


def tone_for(stars: int) -> str:
    if stars >= 4:
        return "positive"
    if stars == 3:
        return "neutral"
    return "negative"


def first_name(review: dict) -> str:
    reviewer = review.get("reviewer", {})
    if reviewer.get("isAnonymous"):
        return ""
    name = (reviewer.get("displayName") or "").strip().split()
    return name[0] if name else ""


def draft_reply(review: dict) -> dict:
    stars = star_value(review)
    tone = tone_for(stars)
    name = first_name(review)
    text = REPLY_TEMPLATES[tone].format(name=f", {name}," if name else "")
    comment = review.get("comment", "") or ""
    flags = []
    if stars <= 2:
        flags.append("low rating: have the advocate read this before replying")
    if SUSPECT_PATTERNS.search(comment):
        flags.append("possible spam or wrong business: consider flagging in GBP instead")
    return {
        "review": review.get("name"),
        "stars": stars,
        "reviewer": review.get("reviewer", {}).get("displayName", ""),
        "comment": comment,
        "reply": text,
        "flags": flags,
        "approved": False,
    }


def unreplied(reviews: list[dict]) -> list[dict]:
    return [r for r in reviews if not r.get("reviewReply")]


def validate_reply(text: str) -> list[str]:
    problems = []
    if not text.strip():
        problems.append("reply is empty")
    if len(text) > MAX_REPLY:
        problems.append(f"reply is {len(text)} chars, limit is {MAX_REPLY}")
    if re.search(r"(₹|\bRs\.?\s*\d|\bfees?\b)", text, re.I):
        problems.append("mentions fees: remove (BCI Rule 36)")
    if re.search(r"\b(acquitt\w*|won(?!['’]t)|bail (was )?granted|case (was )?dismissed)\b", text, re.I):
        problems.append("mentions a case outcome: remove (confidentiality / Rule 36)")
    return problems


# -- posts -----------------------------------------------------------------

DEVANAGARI = re.compile(r"[ऀ-ॿ]")


def language_for(text: str, default: str = "en") -> str:
    # Hindi and Marathi share the script; "hi" is accepted for both by GBP,
    # which uses languageCode only as a hint.
    return "hi" if DEVANAGARI.search(text) else default


def build_post(summary: str, url: str | None = None, image_url: str | None = None,
               language: str | None = None, action: str = "LEARN_MORE") -> dict:
    summary = summary.strip()
    if len(summary) > MAX_POST_SUMMARY:
        summary = summary[: MAX_POST_SUMMARY - 1].rstrip() + "…"
    body: dict = {
        "languageCode": language or language_for(summary),
        "summary": summary,
        "topicType": "STANDARD",
    }
    if url:
        body["callToAction"] = {"actionType": action, "url": url}
    if image_url:
        body["media"] = [{"mediaFormat": "PHOTO", "sourceUrl": image_url}]
    return body


def post_summary_from_article(title: str, excerpt: str) -> str:
    excerpt = re.sub(r"\s+", " ", excerpt).strip()
    # WordPress excerpts end with "[…]" or "The post X appeared first on Y."
    excerpt = re.sub(r"\s*(\[(…|&hellip;|\.\.\.)\]|The post .* appeared first on .*)$", "", excerpt)
    text = f"{title.strip()}\n\n{excerpt}"
    limit = MAX_POST_SUMMARY - 40
    if len(text) > limit:
        text = text[:limit].rsplit(" ", 1)[0] + "…"
    more = "पूरा लेख हमारी वेबसाइट पर पढ़ें।" if DEVANAGARI.search(text) else "Read the full article on our website."
    return f"{text}\n\n{more}"
