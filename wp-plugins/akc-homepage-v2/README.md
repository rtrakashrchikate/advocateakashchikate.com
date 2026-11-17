# AKC homepage v2 (hero + "Where do you stand today?")

Status: built and tested locally against a saved copy of the live homepage. NOT deployed.

Files
- `hero.html`  new hero + situations markup (replaces the theme's `<section class="hero">`).
- `home.css`   styles, scoped to `.hero2` and `.sit2` only.
- `home.js`    office-hours pill (India time, Mon-Sat 10-19), scroll reveal, smooth scroll. Works without JS.
- `build_preview.py`  makes a preview of the live page with the v2 hero (local testing).
- `build_snippet.py`  generates `akc-homepage-v2.php`, the Code Snippets body.
- `akc-homepage-v2.php`  the snippet. Runs on the front page only; falls back to the original page if any marker is missing.

Optional copy fixes (off by default; set `AKC_HOME_COPY_FIXES` to true): remove "Available for Bail Emergencies 24/7"
(conflicts with the Mon-Sat 10-7 hours), "answered the same day", "not a junior", "relentless advocacy", "Vigorous
Representation", "Why Choose Me" and "handled urgently" wording. Each replacement applies only if the original text
occurs exactly once.

Revert: deactivate the snippet.

Tests run: PHP lint; PHP output equals the Python preview apart from 3 newlines; fallback leaves the page unchanged
when the marker is missing; no new console errors (the existing "wp is not defined" and one 404 are on the live page too);
no horizontal scroll at 1440, 1180 and 390 px; CSP allows the inline CSS/JS, Google Fonts and data: images used.
