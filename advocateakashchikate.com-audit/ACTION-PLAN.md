# Action plan: advocateakashchikate.com

SEO Health Score: **87/100** (25 Oct 2026). Nothing is critical; nothing blocks indexing.

## Phase 1: High impact (this week)

> **Built:** `wp-plugins/akc-audit-fixes/` covers all five items below. Upload the zip, activate it and leave it active; deactivating undoes it. After activating, check by sharing a practice-area link on WhatsApp, or run the [Facebook Sharing Debugger](https://developers.facebook.com/tools/debug/) on `/practice-areas/fir-quashing/`.

- [ ] Rank Math → Titles & Meta → Global Meta → set a default **OpenGraph thumbnail** (1200×630 JPG/PNG of you or the office). This fixes 100 pages with no share image.
- [ ] Remove the theme's homepage OG/Twitter hook in `functions.php` ("Fix: OG / Open Graph tags for homepage"). Sync the repo copy from the server first.
- [ ] Remove `/dhangekar-gets-anticipatory-bail-pune-court/` from the sitemap (noindex or delete it; the 301 stays). Point the link on `/agrim-jamanat-anticipatory-bail-hindi-pune/` straight at `/how-to-get-anticipatory-bail-pune/`.
- [ ] Add internal links to `/bombay-high-court-lawyer-pune/`, `/cheque-bounce-ni-act-pune/`, `/bank-account-frozen-cyber-police-maharashtra/`, `/police-notice-whatsapp-how-to-verify-digital-arrest-scam/` from 2–3 related pages each.
- [ ] Add a "Related reported orders" block to practice-area pages, linking the 11 weakly linked case notes.

## Phase 2: On-page polish (weeks 2–3)

> **Built:** plugin v1.1 overrides 57 titles and descriptions (first three items below; the experience figure still needs a manual edit in the page content). Full before/after list in `META-CHANGES.md`.
- [ ] Trim the 46 meta descriptions over 160 characters, starting with the homepage (230).
- [ ] Shorten the 15 titles over 60 characters.
- [ ] Add meta descriptions to `/privacy/`, `/disclaimer/`, `/bar-council-compliance/`; lengthen the one on `/practice-areas/`.
- [ ] Use one experience figure everywhere (body "6+", OG "5+"), or "enrolled 2020".

## Phase 3: Content and authority (month 2)

> **Built:** plugin v1.2 covers the first two items.
- [ ] Free-guide sign-up pages: **noindex, follow** and removed from the sitemap (they were ~60 words each and overlapped full pages).
- [ ] Case notes: "What this means if you face a similar situation" section on all 11, with old and new section numbers.
- [ ] Manual, one line: in `page-contact.php`, change the Maps link from `https://maps.google.com/?q=Ekbote+Complex+Shivajinagar+Pune` to your Business Profile link `https://www.google.com/maps?cid=2771672946981232004`. Make the edit on the live theme (the repo copy is behind).
- [ ] Manual: use one experience figure in page content (body "6+", enrolment supports "5+").
- [ ] Optional: hreflang for `/bns-dhara-103-hatya-jamanat-saza-hindi/`, `/jamanat-kitne-din-me-milti-hai-kharcha-documents-pune/`, `/police-kothadi-nyayalayin-kothadi-farak/` only if they get English twins, added through the same plugin that outputs the existing 39 pairs.

## Phase 4: Technical housekeeping and monitoring (ongoing)

> **Built:** plugin v1.3 covers the first three items.
- [ ] 301s for old static URLs: `/index.html` → `/`, `/about.html` → `/about/`, `/services.html` → `/practice-areas/`, `/contact.html` → `/contact/`, `/blog.html` → `/blog/` (only when the URL would otherwise 404).
- [ ] robots.txt `Sitemap:` line now points at `/sitemap_index.xml`.
- [ ] Footer and disclaimer-card links ≥ 24 px tall on mobile (measured 26–43 px after the change).
- [ ] Manual (Cloudflare): Rules → Redirect Rules → new rule: *When* hostname equals `www.advocateakashchikate.com` → *Dynamic* redirect to `concat("https://advocateakashchikate.com", http.request.uri)`, 301, preserve query string. This makes `http://www.` a single hop.
- [ ] Manual (theme): add `width="847" height="1063"` to the desktop hero `<img>` and `width="800" height="993"` to the mobile/about hero `<img>` (live theme; repo copy is behind).
- [ ] Connect Google Search Console (and a PageSpeed API key or DataForSEO) and re-run the audit for field Core Web Vitals, indexation and rankings.
