import json
from pathlib import Path

import pytest

from gbp import drafts
from gbp.api import ApiError, GbpClient
from gbp.feed import parse_feed


class FakeResp:
    def __init__(self, status, data):
        self.status_code = status
        self._data = data
        self.content = json.dumps(data).encode()
        self.text = json.dumps(data)

    def json(self):
        return self._data


class FakeSession:
    def __init__(self, responses):
        self.responses = list(responses)
        self.calls = []

    def request(self, method, url, **kw):
        self.calls.append((method, url, kw))
        return self.responses.pop(0)


def review(stars, name="Rahul Patil", comment="Very helpful", replied=False, anon=False):
    r = {"name": "accounts/1/locations/2/reviews/r1", "starRating": stars, "comment": comment,
         "reviewer": {"displayName": name, "isAnonymous": anon}}
    if replied:
        r["reviewReply"] = {"comment": "thanks"}
    return r


def test_v4_location_path():
    assert GbpClient.v4_location("accounts/11", "locations/22") == "accounts/11/locations/22"


def test_reviews_follow_pagination():
    s = FakeSession([FakeResp(200, {"reviews": [review("FIVE")], "nextPageToken": "t"}),
                     FakeResp(200, {"reviews": [review("ONE")]})])
    revs = GbpClient(s).reviews("accounts/1/locations/2")
    assert len(revs) == 2
    assert s.calls[1][2]["params"]["pageToken"] == "t"
    assert s.calls[0][1] == "https://mybusiness.googleapis.com/v4/accounts/1/locations/2/reviews"


def test_locations_send_read_mask():
    s = FakeSession([FakeResp(200, {"locations": []})])
    GbpClient(s).locations("accounts/1")
    assert "readMask" in s.calls[0][2]["params"]


def test_403_explains_api_approval():
    s = FakeSession([FakeResp(403, {"error": "denied"})])
    with pytest.raises(ApiError, match="approved"):
        GbpClient(s).accounts()


def test_reply_put_body():
    s = FakeSession([FakeResp(200, {"comment": "x"})])
    GbpClient(s).reply_to_review("accounts/1/locations/2/reviews/r1", "Thank you")
    method, url, kw = s.calls[0]
    assert method == "PUT" and url.endswith("/reviews/r1/reply") and kw["json"] == {"comment": "Thank you"}


@pytest.mark.parametrize("stars,tone", [("FIVE", "appreciate"), ("THREE", "welcome"), ("ONE", "privacy")])
def test_draft_tone(stars, tone):
    assert tone in drafts.draft_reply(review(stars))["reply"]


def test_draft_uses_first_name_only_and_not_anonymous():
    assert drafts.draft_reply(review("FIVE"))["reply"].startswith("Thank you, Rahul, for")
    assert drafts.draft_reply(review("FIVE", anon=True))["reply"].startswith("Thank you for")


def test_draft_never_repeats_review_details():
    d = drafts.draft_reply(review("FIVE", comment="Got bail in my 498A case at Shivajinagar"))
    assert "498A" not in d["reply"] and "bail" not in d["reply"].lower()
    assert d["approved"] is False


def test_low_rating_and_spam_flagged():
    assert drafts.draft_reply(review("ONE", comment="fake reviews, scam"))["flags"] == [
        "low rating: have the advocate read this before replying",
        "possible spam or wrong business: consider flagging in GBP instead"]


def test_unreplied_filter():
    assert len(drafts.unreplied([review("FIVE"), review("FIVE", replied=True)])) == 1


def test_validate_reply_blocks_fees_and_outcomes():
    assert drafts.validate_reply("Thanks, our fee is Rs 5000")
    assert drafts.validate_reply("Glad you were acquitted")
    assert drafts.validate_reply("We won your case")
    assert not drafts.validate_reply("Thank you. We won't discuss matters publicly.")
    assert not drafts.validate_reply(drafts.draft_reply(review("ONE"))["reply"])


def test_build_post_shape_and_limits():
    p = drafts.build_post("x" * 2000, url="https://e.com/a", image_url="https://e.com/i.jpg")
    assert len(p["summary"]) <= drafts.MAX_POST_SUMMARY
    assert p["topicType"] == "STANDARD" and p["languageCode"] == "en"
    assert p["callToAction"] == {"actionType": "LEARN_MORE", "url": "https://e.com/a"}
    assert p["media"][0]["sourceUrl"] == "https://e.com/i.jpg"


def test_hindi_post_language():
    s = drafts.post_summary_from_article("अग्रिम जमानत", "कितने दिन में मिलती है [&hellip;]")
    assert "[&hellip;]" not in s and s.endswith("पढ़ें।")
    assert drafts.build_post(s)["languageCode"] == "hi"


FEED = """<?xml version="1.0"?><rss version="2.0" xmlns:content="http://purl.org/rss/1.0/modules/content/">
<channel><item><title>Bail in Pune &amp; FAQs</title><link>https://advocateakashchikate.com/bail/</link>
<pubDate>Mon, 12 Oct 2026 09:44:03 +0000</pubDate>
<description><![CDATA[<p>How bail works.</p> [&#8230;]]]></description>
<content:encoded><![CDATA[<p><img src="https://x.com/a.webp" /></p>]]></content:encoded></item></channel></rss>"""


def test_parse_feed():
    [a] = parse_feed(FEED)
    assert a["title"] == "Bail in Pune & FAQs"
    assert a["image"] == "https://x.com/a.webp"
    assert "How bail works." in a["excerpt"]
    assert "[" not in drafts.post_summary_from_article(a["title"], a["excerpt"])


def test_publish_replies_dry_run_needs_no_login(tmp_path, capsys):
    from gbp.__main__ import main
    f = tmp_path / "r.json"
    d = drafts.draft_reply(review("FIVE")); d["approved"] = True
    f.write_text(json.dumps([d]))
    main(["publish-replies", str(f)])
    out = capsys.readouterr().out
    assert "[dry run]" in out and "Add --yes" in out
