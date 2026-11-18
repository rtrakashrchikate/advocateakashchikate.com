# AKC homepage, final version

Status: built and tested locally against a saved copy of the live homepage. NOT deployed.

What it replaces: everything from the hero to just before "Areas We Serve" (hero, courts bar, about, stats, services,
why, process, blog). The areas block, the consultation form (Contact Form 7), the footer and the floating buttons stay as
the theme renders them, with the Rule 36 wording fixes listed below applied to those kept blocks.

Files
- `hero.html`      hero (self-drawing arches, enrolment seal, portrait frame)
- `sections.html`  situations, courts, about, method, topics, process, guides, FAQ (`{{FAQ_ITEMS}}` is filled from faq.json)
- `faq.json`       single source for the visible FAQ and the FAQPage JSON-LD (8 questions)
- `home.css`, `home.js`   scoped styles and behaviour (no libraries); motion respects prefers-reduced-motion
- `build.py preview <live.html> <out.html>`   local preview;  `build.py snippet`  writes `akc-homepage-final.php`
- `akc-homepage-final.php`   the Code Snippets body. Front page only. If a marker is missing it returns the page unchanged.

Structured data fixes done by the snippet: FAQPage JSON-LD replaced by the visible FAQ (the old one listed questions that
were not on the page and said the advocate appears before "Pune benches"); `priceRange` removed from LegalService.

Rule 36 posture (see drafts/home/RESEARCH-rule36.md): hero and about use Schedule facts (name, enrolment number and year,
State Bar Council, qualifications, area of practice, address, phone/email) plus these neutral extras that are NOT in the
BCI Schedule and are the advocate's call: portrait photo, languages, office hours, WhatsApp number, contact form.
No ratings, reviews, testimonials, results, awards, fees, "free", "best/expert/specialist", "24/7", counters or "years of experience".

Kept-block wording fixes (on by default; `define('AKC_HOME_COPY_FIXES', false)` turns them off): removes "No Obligation",
"Available for Bail Emergencies 24/7", "answered the same day", "Don't Face the Legal System Alone", "Every legal matter has a
solution", "We'll Call You Back", "Call Now", "WhatsApp Now", "ethical legal representation".

Tests run: PHP lint; PHP output equals the Python preview apart from JSON-LD; fallback leaves the page unchanged when either
marker is missing; no console errors beyond two that already exist on the live page; no horizontal scroll at 1440/1180/390;
axe-core (WCAG A/AA + best practice) 0 violations on desktop and phone; requests 35 vs 33 and weight about 2.7 MB vs 2.66 MB
against the live homepage; LCP about 0.8 s and layout shift near 0 in headless Chrome.

Revert: deactivate the snippet.
