# gbp-tools: Google reviews and posts for both Pune offices

A small command-line tool for the firm's Google Business Profile (GBP). With it you can:

- list the offices (locations) your Google account manages
- see Google reviews that have no reply yet, and export all reviews to CSV
- draft replies that are safe for an advocate, check them, and post the approved ones
- turn the newest blog articles from advocateakashchikate.com into GBP posts for each office

It is based on Google's [google-my-business-samples (v4)](https://github.com/google/google-my-business-samples/tree/v4), updated for the APIs that work today:

| What | API used here | What happened to the v4 sample |
|---|---|---|
| Accounts | Account Management API v1 | `accounts.list` in v4 was turned off |
| Offices | Business Information API v1 | v4 `locations.list` / `create` were turned off |
| Reviews, replies | My Business API v4 | still on v4 |
| Posts | My Business API v4 (`localPosts`) | still on v4 |
| Insights | Business Profile Performance API (not in this tool) | `reportInsights` sample no longer works |

The samples also used `oauth2client` (deprecated) and a downloaded discovery file. This tool uses `google-auth` and plain HTTPS calls instead.

## Safety rules built in

- **Nothing is posted by accident.** Every draft starts with `"approved": false`. The `publish-*` commands only do a dry run unless you add `--yes`.
- **Confidentiality.** Draft replies never say that the reviewer was a client, and never repeat a case, charge, court or result from the review.
- **BCI Rule 36 (no solicitation).** Before sending, each reply is checked. Any reply that mentions fees or case outcomes ("acquitted", "won", "bail granted") is skipped.
- Reviews with 1 or 2 stars, and reviews that look like spam, are flagged so the advocate reads them first.
- `.secrets/` (OAuth files) and `work/` (drafts, which contain reviewer names) are git-ignored.

## One-time setup

**1. Get API access (Google approval, takes a few days).**
In [Google Cloud Console](https://console.cloud.google.com/), create a project. Then fill in the [Business Profile API access request](https://developers.google.com/my-business/content/prereqs#request-access) for it. Until Google approves, every call fails with quota 0 or `403`. Google expects the profile to be verified and active for 60+ days and to have a website (it has both).
After approval, enable these three APIs for the project:
*My Business Account Management API*, *My Business Business Information API* and *Google My Business API*.

**2. Create OAuth credentials.**
Go to *APIs & Services → Credentials → Create credentials → OAuth client ID → Desktop app*. Download the JSON file and save it as `gbp-tools/.secrets/client_secret.json`. On the OAuth consent screen, add your Google account as a test user.

**3. Install and sign in** (Python 3.10+):

```bash
cd gbp-tools
pip install -r requirements.txt
python -m gbp login      # opens a browser; sign in with the account that owns the profiles
python -m gbp offices    # should list both Pune offices
```

## Everyday use

```bash
# Reviews
python -m gbp reviews                       # unreplied reviews, every office
python -m gbp reviews --all --csv reviews.csv
python -m gbp draft-replies                 # writes work/replies-<date>.json
#   open the file, edit "reply", set "approved": true on the ones to send
python -m gbp publish-replies work/replies-<date>.json        # dry run
python -m gbp publish-replies work/replies-<date>.json --yes  # send

# Posts from the blog
python -m gbp draft-posts --limit 2                     # newest 2 articles x each office
python -m gbp draft-posts --limit 1 --office Shivajinagar   # one office only
#   edit post.summary, set "approved": true
python -m gbp publish-posts work/posts-<date>.json --yes
```

Use `--office TEXT` with any command to pick one office by part of its name or address.

**Photos on posts:** the site's RSS feed and article pages do not carry a featured image (no `og:image`), so post drafts have no photo. To add one, put `"media": [{"mediaFormat": "PHOTO", "sourceUrl": "https://…jpg"}]` inside `post` before publishing. The photo must be a public JPG/PNG of at least 400×300 px.

**Hindi and Marathi articles:** these get `languageCode: "hi"` and a Devanagari "read more" line. Google uses the language code only as a hint.

## Tests

```bash
pip install pytest
python -m pytest -q tests
```

The tests use a fake HTTP session, so they need no Google account. They cover pagination, request shapes, reply drafting and checks, post limits and feed parsing.
