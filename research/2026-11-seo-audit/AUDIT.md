# SEO and AI-search audit: advocateakashchikate.com (26 Nov 2026)

Read-only audit. No site changes were made for it.

Method:
- Fetched all 162 sitemap URLs as Googlebot.
- Tested 9 crawler user-agents.
- Checked redirects, canonicals, meta robots, titles, H1s and JSON-LD on every page.
- Measured 5-word-shingle similarity between the location pages.
- Ran Lighthouse 12.2.1 (mobile lab) on 3 key pages. The PageSpeed Insights API quota was exhausted.

## Findings

| Sev | Area | Finding | Evidence | Proposed fix |
|---|---|---|---|---|
| High | Performance | Homepage mobile Lighthouse score is 39 (LCP 12.5 s, TBT 750 ms, 1.2 MB). Service and blog pages score 78–83. | Lighthouse JSON (scratchpad `lh/`). 3rd-party blocking: Google Tag Manager 628 KiB / 456 ms, Facebook pixel 206 KiB / 289 ms. | Remove the duplicate Google tag loads. Delay the Facebook pixel and Ads tag until user interaction, or drop the pixel if Meta ads are not running. Find and fix the homepage LCP element. |
| High | Analytics/perf | Google tag `GT-M3SMZ4NS` loads twice: once directly and once through GTM `GTM-KHJB7M88`. Ads tag `AW-10830296684` also loads. | Lighthouse unused-JS list | Keep one path (GTM or direct gtag, not both). Before removing either, confirm phone_click and whatsapp_click still fire. |
| High | Entity consistency | Hours differ: GBP main says 24/7, while site schema and pages say Mon–Sat 10:00–19:00. Name differs: GBP "Advocate Akash Chikate", schema "Advocate Akash R. Chikate & Associates". | `location_get` vs homepage JSON-LD | The owner decides the real hours. Then make GBP, schema, site footer and directories identical. Use one name everywhere, or the same name plus the legal suffix. |
| Medium | Hiring intent | Money pages have explainer titles without "lawyer" (anticipatory bail, FIR quashing, cyber, 498A practice page H1). They rank ~25–39 for "<service> lawyer pune". | Research report, GSC | Retitle to "<Service> Lawyer in Pune" and keep the explanation in the body. |
| Medium | Cannibalisation | Posts compete with practice pages on the same topic: "498A & Domestic Violence Defence in Pune" vs "498A Defence Lawyer in Pune"; "SC/ST Atrocities Act Defence in Pune" vs "… Lawyer in Pune". | Titles from crawl | Check in GSC which URL Google picks per query. Make each post clearly informational and link it to the practice page. No deletions. |
| Medium | Answer-first | A direct summary near the top appears on 66/97 posts, 13/24 practice pages and 0/15 location pages. | Crawl (pattern: In short / संक्षेप / थोडक्यात / Quick answer) | Add a 2–3 sentence answer block to the 11 practice pages and 15 location pages that lack one. |
| Medium | Trust signals | The 5.0 Google rating (20 reviews) is not shown anywhere on the site. The 11 case results average ~300 words and are not surfaced on the homepage or service pages. | Crawl; competitor teardown | Add a plain-text rating line linking to the GBP, with no self-served AggregateRating schema. Add a case-results strip on the homepage and service pages. |
| Low | Crawl access | Bluehost mod_security returns 406 for short or tool user-agents ("Mozilla/5.0", python-requests, AhrefsBot). Googlebot, Bingbot, OAI-SearchBot, ChatGPT-User, GPTBot, ClaudeBot, PerplexityBot and link-preview bots all get 200. | curl matrix | Optional: ask Bluehost to whitelist AhrefsBot (backlink data only; not a ranking factor). |
| Low | Redirects | `http://www.` → `https://www.` → apex makes a 2-hop chain. | curl | Add a single-hop rule at Cloudflare. |
| Low | Sitemap | `/practice-areas/` is listed twice. | page and practice_area sitemaps | Exclude one entry in Rank Math. |
| Low | Caching | HTML has `cf-cache-status: BYPASS`; average TTFB is 0.48 s, max 0.96 s. | headers | Optional Cloudflare HTML caching (APO) with WordPress cookie bypass. |
| Info | Thin/pSEO | No programmatic bloat: 15 location pages with 14–25% pairwise similarity (unique), 808–1,269 words each. Nothing to delete or 410. | Shingle similarity | None. The r/SEO mass-deletion playbook does not apply here. |
| OK | Indexation | All 162 sitemap URLs return 200. All canonicals are self-referencing and correct. No noindex. Exactly one H1 per page. No JSON-LD parse errors. UTM URLs canonicalise correctly. | Crawl | None. |
| OK | Schema | LegalService, LocalBusiness, Person, BreadcrumbList on all templates; BlogPosting on 97/97 posts; FAQPage on 61 posts and all location pages, with the FAQs visible on the page. | Crawl | Keep. Do not add AggregateRating. |
| OK | AI crawlers | robots.txt allows everything. OAI-SearchBot is not named but is covered by `User-agent: *`. llms.txt exists. | robots.txt | None. |
