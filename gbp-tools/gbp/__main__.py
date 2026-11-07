"""Command line: python -m gbp <command>   (run from the gbp-tools folder)

  login                       sign in with Google and save a token
  offices                     list the Business Profile locations you manage
  reviews [--all] [--csv F]   show reviews (unreplied only, unless --all)
  draft-replies               write reply drafts for unreplied reviews
  publish-replies FILE        post the drafts marked "approved": true
  draft-posts [--limit N]     turn the newest blog articles into post drafts
  publish-posts FILE          publish the post drafts marked "approved": true

Add --office TEXT to pick one office by name (default: every office).
publish-* commands are dry runs unless you add --yes.
"""

from __future__ import annotations

import argparse
import csv
import json
import sys
from datetime import datetime
from pathlib import Path

from . import drafts
from .api import GbpClient

WORK = Path(__file__).resolve().parent.parent / "work"


def client() -> GbpClient:
    from .auth import session

    return GbpClient(session())


def offices(gbp: GbpClient, selector: str | None) -> list[dict]:
    found = []
    for acc in gbp.accounts():
        for loc in gbp.locations(acc["name"]):
            found.append({
                "title": loc.get("title", ""),
                "address": ", ".join(loc.get("storefrontAddress", {}).get("addressLines", [])),
                "location": loc["name"],
                "v4": GbpClient.v4_location(acc["name"], loc["name"]),
                "maps": loc.get("metadata", {}).get("mapsUri", ""),
            })
    if selector:
        s = selector.lower()
        found = [o for o in found if s in o["title"].lower() or s in o["address"].lower()]
        if not found:
            raise SystemExit(f'No office matches "{selector}". Run: python -m gbp offices')
    return found


def save(kind: str, data) -> Path:
    WORK.mkdir(exist_ok=True)
    path = WORK / f"{kind}-{datetime.now():%Y%m%d-%H%M}.json"
    path.write_text(json.dumps(data, indent=2, ensure_ascii=False), encoding="utf-8")
    return path


def load(path: str) -> list[dict]:
    return json.loads(Path(path).read_text(encoding="utf-8"))


# -- commands ---------------------------------------------------------------

def cmd_login(args):
    client()
    print("Signed in. Token saved in gbp-tools/.secrets/token.json")


def cmd_offices(args):
    for i, o in enumerate(offices(client(), args.office), 1):
        print(f"{i}. {o['title']}\n   {o['address']}\n   {o['location']}  (v4: {o['v4']})\n   {o['maps']}")


def cmd_reviews(args):
    gbp = client()
    rows = []
    for o in offices(gbp, args.office):
        revs = gbp.reviews(o["v4"])
        if not args.all:
            revs = drafts.unreplied(revs)
        print(f"\n== {o['title']}: {len(revs)} {'reviews' if args.all else 'unreplied reviews'}")
        for r in revs:
            stars = drafts.star_value(r)
            who = r.get("reviewer", {}).get("displayName", "Anonymous")
            replied = "replied" if r.get("reviewReply") else "NO REPLY"
            print(f"  {'*' * stars:<5} {r.get('createTime', '')[:10]}  {who}  [{replied}]")
            if r.get("comment"):
                print("        " + r["comment"][:200].replace("\n", " "))
            rows.append({"office": o["title"], "date": r.get("createTime", "")[:10], "stars": stars,
                         "reviewer": who, "comment": r.get("comment", ""),
                         "reply": r.get("reviewReply", {}).get("comment", "")})
    if args.csv:
        with open(args.csv, "w", newline="", encoding="utf-8-sig") as f:
            w = csv.DictWriter(f, fieldnames=["office", "date", "stars", "reviewer", "comment", "reply"])
            w.writeheader()
            w.writerows(rows)
        print(f"\nSaved {len(rows)} rows to {args.csv}")


def cmd_draft_replies(args):
    gbp = client()
    out = []
    for o in offices(gbp, args.office):
        for r in drafts.unreplied(gbp.reviews(o["v4"])):
            d = drafts.draft_reply(r)
            d["office"] = o["title"]
            out.append(d)
    if not out:
        print("No unreplied reviews. Nothing to draft.")
        return
    path = save("replies", out)
    flagged = sum(1 for d in out if d["flags"])
    print(f"Wrote {len(out)} drafts to {path} ({flagged} flagged for a closer look).")
    print('Edit the "reply" text, set "approved": true on the ones to send, then run:')
    print(f"  python -m gbp publish-replies {path} --yes")


def cmd_publish_replies(args):
    items = [d for d in load(args.file) if d.get("approved")]
    if not items:
        print('No drafts have "approved": true. Nothing to send.')
        return
    gbp = client() if args.yes else None
    for d in items:
        problems = drafts.validate_reply(d["reply"])
        if problems:
            print(f"SKIP {d['reviewer']}: " + "; ".join(problems))
            continue
        if not args.yes:
            print(f"[dry run] would reply to {d['reviewer']} ({d['stars']}*):\n  {d['reply']}\n")
            continue
        gbp.reply_to_review(d["review"], d["reply"])
        print(f"Replied to {d['reviewer']}")
    if not args.yes:
        print("Dry run only. Add --yes to send.")


def cmd_draft_posts(args):
    from .feed import fetch_feed

    articles = fetch_feed(args.feed)[: args.limit]
    targets = offices(client(), args.office)
    out = []
    for a in articles:
        summary = drafts.post_summary_from_article(a["title"], a["excerpt"])
        for o in targets:
            out.append({
                "office": o["title"],
                "v4": o["v4"],
                "article": a["url"],
                "post": drafts.build_post(summary, url=a["url"], image_url=a["image"]),
                "approved": False,
            })
    path = save("posts", out)
    print(f"Wrote {len(out)} post drafts ({len(articles)} articles x {len(targets)} offices) to {path}")
    print('Edit the "summary" text, set "approved": true, then run:')
    print(f"  python -m gbp publish-posts {path} --yes")


def cmd_publish_posts(args):
    items = [d for d in load(args.file) if d.get("approved")]
    if not items:
        print('No drafts have "approved": true. Nothing to publish.')
        return
    gbp = client() if args.yes else None
    for d in items:
        post = d["post"]
        if len(post["summary"]) > drafts.MAX_POST_SUMMARY:
            print(f"SKIP {d['article']}: summary over {drafts.MAX_POST_SUMMARY} chars")
            continue
        if not args.yes:
            print(f"[dry run] {d['office']}:\n{post['summary']}\n  -> {post.get('callToAction', {}).get('url', '')}\n")
            continue
        res = gbp.create_post(d["v4"], post)
        print(f"Posted to {d['office']}: {res.get('searchUrl', res.get('name', 'ok'))}")
    if not args.yes:
        print("Dry run only. Add --yes to publish.")


def main(argv=None):
    p = argparse.ArgumentParser(prog="python -m gbp", description=__doc__,
                                formatter_class=argparse.RawDescriptionHelpFormatter)
    sub = p.add_subparsers(dest="cmd", required=True)

    def add(name, fn, **kw):
        sp = sub.add_parser(name, **kw)
        sp.set_defaults(fn=fn)
        sp.add_argument("--office", help="pick one office by name or address text")
        return sp

    add("login", cmd_login)
    add("offices", cmd_offices)
    sp = add("reviews", cmd_reviews)
    sp.add_argument("--all", action="store_true", help="include reviews that already have a reply")
    sp.add_argument("--csv", help="also save to this CSV file")
    add("draft-replies", cmd_draft_replies)
    sp = add("publish-replies", cmd_publish_replies)
    sp.add_argument("file")
    sp.add_argument("--yes", action="store_true", help="really send (default is a dry run)")
    sp = add("draft-posts", cmd_draft_posts)
    sp.add_argument("--limit", type=int, default=3, help="number of newest articles (default 3)")
    sp.add_argument("--feed", default="https://advocateakashchikate.com/feed/")
    sp = add("publish-posts", cmd_publish_posts)
    sp.add_argument("file")
    sp.add_argument("--yes", action="store_true", help="really publish (default is a dry run)")

    args = p.parse_args(argv)
    args.fn(args)


if __name__ == "__main__":
    sys.exit(main())
