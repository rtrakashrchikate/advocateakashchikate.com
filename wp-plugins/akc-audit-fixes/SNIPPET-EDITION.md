# Snippet edition on the live site

On 11 Nov 2026 this plugin's fixes were saved on the live site as a Code Snippets entry instead of an uploaded zip:

- **Where:** WordPress admin → Snippets → "AKC Audit Fixes 1.4 (snippet edition)" (snippet ID 7, scope: everywhere).
- **State:** activated 11 Nov 2026 at the owner's request. Turning it off undoes the fixes.
- **Verified live after activation:** share image on pages without one, single OG set on the homepage, contact-page map and directions link, related-links blocks, free-guide noindex, descriptions on privacy/disclaimer/Bar Council pages, `.html` redirects, footer tap-target CSS.
- **Not taking effect:** the schema map-pin correction (the coordinates are added to the page after this snippet's output filter runs), the robots.txt sitemap line (robots.txt is not served through WordPress's filter), and the sitemap exclusions until Rank Math's sitemap cache refreshes.
- **Differences from the plugin files here:**
  - The 57-entry title/description override map (`meta-overrides.php`) is **not** included. The live site's titles and descriptions were reworked after 25 Oct, and the old map would overwrite them (some old descriptions also carried "Call +91…" lines). Only the three pages with no description at all (privacy, disclaimer, Bar Council compliance) get one, and only when Rank Math has none.
  - The case-note takeaways (`case-takeaways.php`) are not included yet.
  - The default share image is an existing media-library image (ID 3005, `akash-chikate-cover-supreme-court.jpg`, 1206×678), set once in Rank Math's options only if no default is set.
  - Everything is wrapped in a `function_exists` guard, so uploading the plugin zip later does not clash; the plugin wins and the snippet stands down.

Do not upload `akc-audit-fixes.zip` as it is: its override map is out of date for the same reason.

## Second snippet: case-note takeaways (11 Nov 2026)

- **Where:** Snippets → "AKC Content Additions 1.1 (case-note takeaways)" (snippet ID 8), active.
- **What it does:** on each of the 11 case notes, adds "What this means if you face a similar situation" (text from `case-takeaways.php`) and a "Related practice areas" block, inserted just before the end of the article.
- **Why it rewrites the page output:** the case-note template does not call `the_content`, so the content filters in the plugin files here never ran on case notes. The same applies to the related-links block for case notes in snippet 7.
- **FAQ markup:** the snippet contains an FAQ generator that is switched off. The blog guides already carry FAQPage data (type `["WebPage","FAQPage"]`) from the site's own schema; the 10 Nov audit note saying no page had FAQ markup was wrong.
- **Snippet 7 changes the same day:** free-guide rule widened to cover the two `-checklist` pages; the map-pin correction still does not take effect (the coordinates are written by another plugin after this filter runs).

## 12 Nov 2026: links to the criminal defence page

Snippet 7 now appends one sentence linking to `/practice-areas/criminal-defence/` (anchor "criminal lawyer in Pune", or the Hindi/Marathi equivalent) on the five high-traffic guides that had no link to that page: MCOCA, FIR quashing, BNS 103 (Hindi), bail timeline (Hindi) and police custody (Marathi). It skips any post whose content already links there.

Checked the same day and found already done on the live site (by work on 9 Nov, outside this repo): the two BNS Section 103 titles are 53 characters and open with a quick answer that says the offence is non-bailable, and the top guides carry a "bridge" box of situation-specific links after the quick answer. No further "what to do now" boxes were added.

## 13–14 Nov 2026
- Snippet 7: added `akc_af_next_step_map` (contextual links from guides to bail / anticipatory bail / cheque bounce practice pages; skipped where the guide already links there).
- Snippet 9 (Ryze head code): Meta Pixel 2171544603736550, PageView only.
- `.htaccess` "Security Headers" block, CSP line: added connect.facebook.net, www.facebook.com, googleadservices.com, googleads.g.doubleclick.net, ad.doubleclick.net, www.google.com (connect-src). Backup: `.htaccess.akc-bak-20261113192023` in the web root. Temporary snippets 10 and 11 used for this are in the Code Snippets trash.
