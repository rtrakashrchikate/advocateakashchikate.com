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
