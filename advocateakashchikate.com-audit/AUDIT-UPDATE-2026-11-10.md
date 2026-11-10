# SEO audit update: advocateakashchikate.com

**Date:** 10 November 2026. **Builds on:** `FULL-AUDIT-REPORT.md` (25 Oct, score 87/100) and `ACTION-PLAN.md`.
**New this time:** real Google Search Console and Google Business Profile data (through the Ryze connector), and a fresh crawl of all 151 sitemap URLs.
**Not available:** Core Web Vitals (the PageSpeed API's shared daily quota was used up; add your own API key to `seo-cockpit` for this) and WordPress REST access (Ryze's requests are blocked by Bluehost ModSecurity, the same issue that blocked Fly Social).

---

## Executive summary

The site is technically healthy and its content is working: Search Console impressions went from about **1,000 a day to 5,000–8,000 a day from 6 October**, and clicks from about 15 to 50–90 a day, at an average position of about 5.6. Over the last 90 days: **2,647 clicks from 227,885 impressions**, 80% on mobile.

The problem is **what** it ranks for. Nearly all traffic comes from people researching the law (checking an FIR online, BNS Section 103 in Hindi, consumer court), not from people looking for a lawyer. The searches that bring clients rank poorly or not at all.

| Search | Position | Page Google shows |
|---|---|---|
| criminal lawyer pune | 10.6 (15.5 for the page shown) | `/free-choose-criminal-lawyer-guide/` (a 274-word sign-up page) |
| best criminal lawyer in pune | 37 | — |
| anticipatory bail lawyer | 42 | — |
| criminal lawyer fees in pune | 4.7 | `/criminal-lawyer-fees-pune/` (working) |
| advocate pimple saudagar | 8.2 | Pimple Saudagar location page |
| advocate wakad | 11 | Wakad location page |

On Google Maps, the profile was seen 1,688 times in 3 months but almost only by people searching your name ("chikate"): 211 direction requests, 10 website clicks, **0 calls**.

### Top 5 priorities

1. **Upload the `akc-audit-fixes` plugin.** None of versions 1.1–1.4 is live: 102 pages still have no share image, robots.txt still points at `/sitemap.xml`, the redirected Dhangekar URL is still in the sitemap, the free-guide pages are still indexed, there are no related-links blocks, and the contact-page map is still a placeholder. All of that is already built and tested.
2. **Deal with the review spike before Google does** (see Local below). It puts the whole Maps profile at risk.
3. **Make one page own "criminal lawyer pune".** Right now a thin sign-up page holds it; the homepage and `/practice-areas/criminal-defence/` (2,502 words) don't appear for it.
4. **Turn research traffic into enquiries** on the 10 pages that get 80% of clicks.
5. **Build local authority.** Links and mentions from Pune sources; the on-page work is mostly done.

---

## Technical SEO

| Check | Result | Status |
|---|---|---|
| Status codes | 150 × 200, 1 × 301 (the Dhangekar URL, still listed in the sitemap) | ⚠️ fixed by plugin 1.0 |
| HTTPS / HTTP redirect | `http://` → `https://` 301 | ✅ |
| Server response | Median 0.45 s, max 1.1 s (time to first byte, through Cloudflare) | ✅ |
| Canonicals | Present and self-referencing on all 150 | ✅ |
| H1 | Exactly one on every page | ✅ |
| Structured data | JSON-LD on all 150 pages | ✅ |
| Image alt text | 50 of 50 images have it | ✅ |
| Hreflang | 38 pages carry English/Marathi/Hindi pairs | ✅ |
| robots.txt | `Sitemap:` line points at `/sitemap.xml`; Rank Math serves `/sitemap_index.xml` | ⚠️ fixed by plugin 1.3 |
| Sitemap in Search Console | 1 submitted, 198 URLs, 0 errors | ✅ |
| Share images | 102 of 150 pages have no `og:image`, so WhatsApp and LinkedIn shares show no preview | ❌ fixed by plugin 1.0 |
| Schema map pin | About 300 m from the Google profile's pin | ⚠️ fixed by plugin 1.4 |
| REST API from apps | Blocked by Bluehost ModSecurity (406), and the Authorization header doesn't reach WordPress | ❌ Bluehost setting |
| Duplicate domain advakashchikate.com | Unreachable from here (connection fails) | Check: if it's expired, fine; if it's live elsewhere, 301 it |

**Mobile:** 80% of clicks are on mobile. The earlier audit measured tap targets (fixed in plugin 1.3). Core Web Vitals weren't measurable today.

---

## On-page SEO

The 25 Oct title and description work shows: only **3 titles over 60 characters** (was 15) and **5 descriptions over 160** (was 46).

Remaining items:

| Page | Issue | Fix |
|---|---|---|
| `/bns-dhara-103-hatya-jamanat-saza-hindi/` | Title 82 characters, description 166. This is the second most-viewed page (34,229 impressions). | Title: `BNS धारा 103(1) क्या है? सज़ा, जमानत और IPC 302 से फर्क` (52) |
| `/murder-case-defence-bns-section-103-india/` | Title 68, description 174. 31,079 impressions, but only 0.35% click. | Title: `BNS 103 (IPC 302): Is Murder Bailable? Punishment & Trial` (57); answer "bailable or not" in the first two lines, because that is what people search for (719 impressions for "103 1 bns bailable or non bailable") |
| `/case-results/anticipatory-bail-sc-st-act-bhc-2025-sayyed/` | Title 61 | Trim one word |
| `/privacy/`, `/disclaimer/`, `/bar-council-compliance/` | No meta description | Already in plugin 1.1 |

Every page carries WhatsApp (7–9 links) and click-to-call. The way enquiries can reach you is there; the job is to make it relevant to each page (see Content).

---

## Content

**What works:** long, specific guides (1,000–2,500 words) in English, Hindi and Marathi, with BNS/BNSS and old IPC/CrPC numbers. The Hindi and Marathi pages are behind much of the October growth.

**Thin pages (under 500 words):**
- the **11 case notes** (320–400 words each)
- the **10 free-guide pages** (about 260 words each)
- `/blog/`, `/contact/`, `/disclaimer/` and `/bar-council-compliance/`

**Three content problems that cost clients:**

1. **A sign-up page ranks for the main search.** `/free-choose-criminal-lawyer-guide/` (274 words) is what Google shows for "criminal lawyer pune". Plugin 1.2 noindexes it, which is right, but it should also link prominently to `/practice-areas/criminal-defence/` with the anchor text "criminal lawyer in Pune". That way the stronger page inherits the ranking instead of it disappearing. Also add 2–3 internal links with that anchor from the top guides to the homepage or the criminal defence page.
2. **The research pages don't offer a next step that fits.** A family reading "is murder bailable" at 11 pm needs something like *"If a family member has been arrested under Section 103, here is what happens in the next 24 hours: call or WhatsApp"*, not a generic site-wide button. Add a 2–3 line box after the first answer on the top 10 pages, written for that page's situation. Bar Council-safe wording: information plus contact details, no promises.
3. **Case notes are short.** Plugin 1.2 adds "What this means for you" takeaways. That's good, but they're still around 400 words. Expand the 3 most relevant (murder bail after 4 years, MCOCA, POCSO) to 800+ words with the legal test the court applied.

---

## Local SEO (Google Business Profile)

| Signal | Finding |
|---|---|
| Category | Primary "Criminal defence lawyer", plus Lawyer, Law firm, Legal services, Trial lawyer, Divorce lawyer ✅ |
| Description | Replaced on 10 Nov with Bar Council-safe text (pending Google review) ✅ |
| Services | 23 services with BNSS/CrPC sections ✅ |
| Posts | 1 on 8 Nov, plus 5 scheduled weekly from 15 Nov to 13 Dec, each linking to a tagged guide page ✅ |
| Hours | Open 24/7 on the profile; Mon–Sat 10–19 on the website ⚠️ decide which is true |
| Reviews | 21 reviews, 5.0. **15 arrived on 9 Nov within about 4 hours.** They include 4 accounts that appear to be the same person, a review by "Akash Chikate", a family surname, and near-identical wording. ❌ High risk of mass removal or a warning on the profile |
| Review replies | All replied to within minutes by a tool, several confirming case outcomes ("Securing your desired result…") ❌ Confidentiality and Bar Council risk |
| Second profile (Pimple Gurav) | Linked from the site but not connected to Ryze; status unknown |
| Search terms | Only brand searches clear Google's reporting threshold, so the profile isn't yet showing in the map pack for "criminal lawyer near me" |

**Fixes, in order:**
1. Delete your own review.
2. Ask the one reviewer with 4 accounts to keep one review.
3. Turn off the auto-replies and swap them for neutral ones (I can do this through Ryze on your go-ahead).
4. From here on, ask for reviews only from real clients, one at a time and steadily. A steady trickle ranks better than a spike.

---

## Authority and links

Not measured (no Ahrefs, Semrush or Moz connected). Signs from the data: the homepage gets only 765 impressions in 90 days, almost all from brand searches, while the guides rank in the top 5. That pattern usually means few links point to the site's main pages.

Realistic, Bar Council-safe link sources:
- Pune Bar Association and Bombay High Court bar directories
- your alma mater's alumni page (SPPU, LLM)
- Rotaract (the reviews mention it)
- legal news sites citing your case notes (LiveLaw, Bar & Bench, LawBeat accept articles and "reported orders" contributions)
- local news quotes on topics you already cover: digital arrest scams, frozen bank accounts, tadipar

---

## Prioritised action plan

### Critical (this week)
1. **Bluehost:** turn off ModSecurity for the site and pass the Authorization header (two settings, steps given in chat). This unblocks Ryze, Fly Social and plugin installs.
2. **Upload or activate `akc-audit-fixes` 1.4.** Fixes share images, sitemap, robots.txt, the contact map and the schema pin in one step.
3. **Reviews:** delete the self-review, consolidate the duplicate reviewer, and stop the auto-replies.

### High impact (next 2 weeks)
4. Point the free-guide page and the top guides at `/practice-areas/criminal-defence/` with "criminal lawyer in Pune" anchors.
5. Add a page-specific "what to do now" box to the 10 most-clicked guides.
6. Shorten the Hindi BNS 103 and English BNS 103 titles and put the "bailable or not" answer first.
7. Decide hours (24/7 vs office hours) and make the profile and website match.

### Quick wins
8. Meta descriptions for privacy, disclaimer and bar-council pages (in plugin 1.1).
9. Push the Wakad (11) and Pimple Saudagar (8.2) location pages onto page 1: add 2–3 local specifics each (the nearest police stations and the court that hears their cases) and link them from the Pimpri-Chinchwad page.
10. Publish the Tadipar draft (`akc-gap-pages`) after your legal review.

### Longer term
11. Keyword gap pages: MPDA, hit-and-run, false rape / Section 69, maintenance (see `KEYWORD-GAPS.md`).
12. Local links and press, as above.
13. Connect a PageSpeed API key and re-measure Core Web Vitals.

---

## Data sources
- Crawl: all 151 sitemap URLs, mobile Chrome user agent, 10 Nov 2026.
- Google Search Console, `https://advocateakashchikate.com/`: 10 Aug to 7 Nov 2026 (queries, pages, devices) and 1 May to 7 Nov (daily trend).
- Google Business Profile (Shivajinagar, verified): location details, 21 reviews, performance 1 Aug to 7 Nov, search keywords Sep to Nov.
