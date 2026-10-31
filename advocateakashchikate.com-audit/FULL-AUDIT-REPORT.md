# SEO Audit: advocateakashchikate.com

**Date:** 25 October 2026 · **Method:** claude-seo v2.5.0 `seo-audit` process, run inline (crawl of all 149 sitemap URLs, Playwright lab performance, header/robots/schema/hreflang checks). No Google Search Console, CrUX or DataForSEO data was available, so performance is lab-only and there are no ranking or traffic figures.

## Executive summary

**SEO Health Score: 87 / 100**

**Business type:** Local legal service (hybrid: Shivajinagar office plus Pimple Gurav office by appointment). Criminal defence first, then family and consumer law. WordPress + Rank Math behind Cloudflare.

The site is in strong shape: every page returns 200, has one H1, a self-referencing canonical, valid JSON-LD and descriptive alt text. Pages are fast (mobile LCP 0.5–1.8 s under throttling), AI crawlers are explicitly allowed and `llms.txt` is unusually good. What's left is mostly polish and social-sharing, not anything blocking indexing.

### Top 5 issues
1. **100 of 149 pages have no `og:image`**: all 23 practice-area pages, all 15 area pages (`/criminal-lawyer/...`), 11 case notes and 51 guides. Links shared on WhatsApp, LinkedIn or Facebook show no picture. WhatsApp is your main contact channel.
2. **Homepage outputs two conflicting sets of Open Graph/Twitter tags.** Rank Math outputs a correct set (hero photo, "experienced" description), then the theme outputs a second set with `logo.svg` (social networks don't render SVG previews) and "5+ years", while the page body says "6+ years".
3. **The sitemap lists a redirecting URL:** `/dhangekar-gets-anticipatory-bail-pune-court/` 301s to `/how-to-get-anticipatory-bail-pune/`. It's also linked from `/agrim-jamanat-anticipatory-bail-hindi-pune/` and causes the only duplicate title on the site.
4. **15 pages have one or no internal links pointing to them**, including money pages `/bombay-high-court-lawyer-pune/`, `/cheque-bounce-ni-act-pune/` and `/bank-account-frozen-cyber-police-maharashtra/`, plus 11 of the 12 case notes.
5. **46 meta descriptions are over 160 characters** (homepage is 230), so Google truncates them. 3 pages have none (`/privacy/`, `/disclaimer/`, `/bar-council-compliance/`).

### Top 5 quick wins
1. Set a default Open Graph image (1200×630 JPG/PNG) in Rank Math → Titles & Meta → Global Meta.
2. Delete the theme's homepage OG block in `functions.php` (the "Fix: OG / Open Graph tags for homepage" hook), since Rank Math now handles it.
3. Remove the Dhangekar URL from the sitemap (set it to noindex or delete the post) and point the Hindi page's link straight at `/how-to-get-anticipatory-bail-pune/`.
4. Trim the homepage meta description to about 155 characters.
5. Link to the case-notes hub and the weakly linked guides from the relevant practice-area pages.

## Scores by category

| Category | Weight | Score |
|---|---|---|
| Technical SEO | 22% | 92 |
| Content quality | 23% | 86 |
| On-page SEO | 20% | 78 |
| Schema / structured data | 10% | 92 |
| Performance (lab) | 10% | 95 |
| AI search readiness | 10% | 95 |
| Images & social | 5% | 65 |
| **Weighted total** | | **87** |

## Technical SEO (92)

**Works:** HTTPS with HSTS; http→https and www→apex 301s; trailing-slash normalisation; real 404s for missing pages; all 149 sitemap URLs return 200 with self-canonicals; no stray `noindex`; strong security headers (CSP, X-Frame-Options, nosniff, Permissions-Policy); robots.txt blocks only admin and private paths.

| Severity | Finding | Fix |
|---|---|---|
| High | Sitemap contains `/dhangekar-gets-anticipatory-bail-pune-court/`, which 301s. | Remove from sitemap (Rank Math: noindex or delete the post); update the internal link on `/agrim-jamanat-anticipatory-bail-hindi-pune/`. |
| Low | `http://www.` takes two hops (→ `https://www.` → apex). | Add a single Cloudflare redirect rule from `http://www.*` to `https://advocateakashchikate.com/$1`. |
| Low | Old static-site URLs (`/index.html`, `/services.html`, `/contact.html`, `/blog.html`, `/about.html`) return 404. | If any were ever live or linked, add 301s to `/`, `/practice-areas/`, `/contact/`, `/blog/`, `/about/` in the theme's legacy-redirect block. |
| Info | `/sitemap.xml` 301s to `/sitemap_index.xml` (Rank Math). robots.txt points to the old path. | Optional: change the robots.txt `Sitemap:` line to `/sitemap_index.xml`. |
| Info | CSP allows `'unsafe-eval'`. | Not an SEO issue; tighten later if nothing needs it. |

## Content quality (86)

**Works:** median page length 1,225 words; strong E-E-A-T signals (enrolment number, LL.M., office address, BNS/BNSS sections with old IPC/CrPC numbers, links to indiacode.nic.in, sci.gov.in, ecourts.gov.in); English, Marathi and Hindi content; honest, non-promotional tone suited to Bar Council rules.

| Severity | Finding | Fix |
|---|---|---|
| Medium | Experience is stated inconsistently: page body "6+ years", theme OG tag "5+ years", repo copy of the theme "8+ years". Enrolment (9 Dec 2020) supports "5+". | Pick one figure and use it everywhere, or say "enrolled 2020" so it never goes out of date. |
| Low | 8 lead-magnet pages (`/free-*-guide/`) are ~400 words each. | Fine as landing pages. Either expand each with a short summary of the guide, or set them to noindex so they don't count as thin content. |
| Low | Case notes are 440–490 words. | Acceptable. Add a "What this means for you" paragraph and a link to the matching practice area. |
| Info | Case-note slugs include party surnames (`...-sayyed`, `...-jamdade`). | Orders are public, but you may prefer neutral slugs given Bar Council sensitivity. Your call. |

## On-page SEO (78)

**Works:** every page has exactly one H1 and a unique title (except the redirect duplicate); descriptive titles targeting Pune and court-specific searches.

| Severity | Finding | Fix |
|---|---|---|
| High | 15 pages have 0–1 internal links pointing to them: `/bombay-high-court-lawyer-pune/`, `/cheque-bounce-ni-act-pune/`, `/bank-account-frozen-cyber-police-maharashtra/`, `/police-notice-whatsapp-how-to-verify-digital-arrest-scam/` and 11 case notes. | Link each from 2–3 related practice-area pages and guides; add a "Related orders" block on practice-area pages. |
| Medium | 46 meta descriptions are over 160 characters (homepage 230, `/bombay-high-court-lawyer-pune/` 185). | Trim to 140–155 characters. |
| Medium | 15 titles are over 60 characters (e.g. `/business-partner-criminal-complaint-pune/` 84, `/498a-fir-filed-husband-pune/` 81, `/nri-criminal-lawyer-india-pune/` 74). | Shorten so the key phrase plus "Pune" shows before truncation. |
| Low | `/privacy/`, `/disclaimer/`, `/bar-council-compliance/` have no meta description; `/practice-areas/` has a very short one. | Add short descriptions. |
| Low | Homepage meta description ends "Consult today." and uses "experienced". | Optional: neutral wording such as "Office in Shivajinagar, Pune." fits the site's Bar Council stance better. |

## Schema / structured data (92)

**Works:** valid JSON-LD on all 149 pages, with no parse errors. `LegalService` + `LocalBusiness` for both offices with full address, phone, hours, geo coordinates, `hasMap` (Google Business Profile CIDs) and `sameAs`. `Person` with credentials. `BreadcrumbList` on 148 pages, `FAQPage` on 81, `BlogPosting` on 77, `Service` on 23. No `Review` or `AggregateRating` markup, which is correct for an advocate.

| Severity | Finding | Fix |
|---|---|---|
| Low | Both offices share one phone number; the second office has no `openingHours` or `priceRange`. | Add "by appointment" hours to the second office for consistency with your Google Business Profile. |
| Info | Google shows FAQ rich results only for government and health sites now. | Keep the FAQPage markup (it still helps AI answers), but don't expect FAQ snippets. |

## Performance, lab (95)

Playwright, Pixel 7 emulation with 4× CPU and slow-network throttling:

| Page | Mobile LCP | CLS | Page weight |
|---|---|---|---|
| `/` | 1.8 s | 0.04 | 117 KB |
| `/practice-areas/anticipatory-bail/` | 0.6 s | 0 | 32 KB |
| `/mutual-consent-divorce-pune/` | 0.5 s | 0 | 25 KB |
| `/atakpurva-jaamin-vkil-pune/` | 0.6 s | 0 | 24 KB |

All well inside "good" thresholds (LCP < 2.5 s, CLS < 0.1). Cloudflare cache hits, average HTML 89 KB, about 550 ms server response from the crawler. Field data (CrUX) could not be fetched because the shared PageSpeed API quota was exhausted. Check PageSpeed Insights or Search Console for real-user numbers.

| Severity | Finding | Fix |
|---|---|---|
| Low | Footer and mobile-menu links are 15–23 px tall, under the 24 px minimum tap-target size. | Add `padding-block: 4px` to footer and menu links. |
| Info | The Bar Council disclaimer pop-up covers the first screen on every first visit. | Google exempts legally required interstitials; the content stays in the HTML. No change needed. |

## AI search readiness (95)

**Works:** robots.txt explicitly allows GPTBot, ClaudeBot, PerplexityBot, Google-Extended and Bingbot, and Cloudflare serves them 200 (tested). `llms.txt` is excellent: enrolment facts, offices, the BNS/BNSS changeover and the no-Pune-bench clarification, with links to every practice area. Pages answer questions directly with section numbers, which makes them easy for AI answers to cite.

| Severity | Finding | Fix |
|---|---|---|
| Low | 3 Hindi/Marathi pages have no `hreflang` (`/bns-dhara-103-hatya-jamanat-saza-hindi/`, `/jamanat-kitne-din-me-milti-hai-kharcha-documents-pune/`, `/police-kothadi-nyayalayin-kothadi-farak/`). The other 39 language pairs are valid and reciprocal, with `x-default`. | Fine if they have no English counterpart; otherwise add the pair. Hindi pages could also use `hi-IN` alternates. |

## Images & social (65)

**Works:** 51 content images, all with alt text; WebP hero; lazy loading on below-the-fold images.

| Severity | Finding | Fix |
|---|---|---|
| High | 100 of 149 pages have no `og:image`. | Set a default OG image in Rank Math; ideally a per-section image for practice areas, area pages and case notes. |
| High | Homepage has duplicate OG/Twitter tags; the second set uses `logo.svg` and `twitter:card` conflicts (`summary` vs `summary_large_image`). | Remove the theme's homepage OG hook from `functions.php`. |
| Low | 3 images lack `width`/`height` attributes. | Add dimensions to avoid layout shift. |

## Local SEO notes

Both offices are marked up and linked to Google Business Profile CIDs, and the address is identical across schema, `llms.txt` and the page footer. The 15 `/criminal-lawyer/<area>-pune/` pages cover Pune neighbourhoods well. For more local visibility, link the Google Maps listing visibly on `/contact/`, and make sure your Google Business Profile categories match the practice areas listed on the site. Rank tracking and review analysis need DataForSEO or Google Business Profile access, which this audit didn't have.

## Note on the repository

The live site runs the `wp-theme/akashchikate` theme, but the copy in this repo is older than what's deployed: the repo says "8+ years" where the live site says "5+ years". Sync the repo from the server before editing `functions.php`, so a deploy doesn't roll back newer changes.
