# SEO audit re-check: advocateakashchikate.com

**Date:** 12 November 2026. Follows `AUDIT-UPDATE-2026-11-10.md`. Fresh, uncached crawl of all 143 sitemap URLs, Search Console to 11 Nov (last day incomplete), Google Business Profile reviews.

## What changed since 10 November

| Check | 10 Nov | 12 Nov |
|---|---|---|
| Pages in sitemap | 151 | 143 (8 free-guide pages and the redirected Dhangekar URL removed; one new page, `/consumer-dispute-representation-pune/`) |
| Pages returning 200 | 150 of 151 | 143 of 143 |
| Pages with no share image | 102 | 0 |
| Pages with no meta description | 3 | 0 |
| robots.txt sitemap line | `/sitemap.xml` | `/sitemap_index.xml` |
| Contact-page map | placeholder | real Business Profile |
| Case notes | 320–400 words, no internal links | 460–545 words, with takeaways and related practice areas |
| Wakad / Pimple Saudagar pages | about 840 words, "criminal lawyer" only | about 1,220 words, "Advocate in …" titles, first-24-hours section |
| One H1, self-canonical, no duplicate titles | pass | pass |

## Still open

| Issue | Impact | Fix |
|---|---|---|
| Two checklist pages are noindex but still in the sitemap (`/free-consumer-complaint-checklist/`, `/free-mutual-divorce-checklist/`) | Low | Rank Math drops them when its page sitemap is rebuilt: save any page in WordPress |
| MCOCA guide title is 69 characters and its description 200. This changed after 10 Nov (was 55 / 157) and was not done in this session | Medium: 15,000 impressions in 90 days | Title: `MCOCA Act Maharashtra: Meaning, Bail (Sec 21) & Defence` (55); cut the description to under 160 |
| Three other descriptions are 161–164 characters; one case-note title is 61 | Low | Trim |
| Schema map pin about 300 m off | Low | Needs the live `akc-seo-toolkit` source |
| Self-review still on the Business Profile | High (profile risk) | Owner deletes it in Google Maps |
| Profile hours (24 h) differ from the website (Mon–Sat 10–19) | Medium | Owner decides |
| Thin pages under 500 words: `/blog/`, `/contact/`, `/locations/`, `/legal-fees-consultation/`, legal pages, and five case notes at 460–482 | Low | Fine for legal and contact pages; `/locations/` and `/legal-fees-consultation/` could use more text |
| Server response median 0.83 s on uncached fetches (0.45 s cached) | Low | Normal for uncached WordPress; Core Web Vitals still unmeasured |
| No backlink data | Unknown | Needs Ahrefs, Semrush or OpenSEO connected |

## Search Console

- Clicks fell from about 75 a day (27 Oct–4 Nov) to about 46 a day (5–11 Nov), with impressions down in step and average position unchanged at about 5.7. Position holding steady while impressions fall points to fewer searches, most likely the Diwali week (8 Nov) and court vacation, not a ranking loss. Re-check after 17 Nov.
- "criminal lawyer pune": average position 7.9 over the last four weeks (8 impressions), against 10.6 over the previous 90 days. Too few impressions to call a trend.
- "advocate wakad": 10.8. The page changes went live on 12 Nov, so this is the baseline.
- "best criminal lawyer in pune": 34.7. Unchanged.

## Next actions, in order

1. Owner: delete the self-review; settle the opening hours.
2. Fix the MCOCA title and description (and find out who changed them).
3. Get the live plugins (`akc-seo-toolkit`, `akc-content`, `akc-site-fixes` and others) into the repo so changes stop colliding.
4. Re-check Search Console on or after 26 Nov for "criminal lawyer pune", "advocate wakad" and "advocate pimple saudagar".
5. Local links and the keyword-gap pages (unchanged from the 10 Nov plan).
