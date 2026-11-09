# Site changes

## 8 Nov 2026: "Talk to the advocate" box on the top 5 pages

The user approved this from a preview. It was added to the 5 pages with the most Search Console clicks (8 Aug–6 Nov), straight after the first paragraph and before the first heading. Edits were made through the WordPress REST API (Ryze connector).

| Post | Page | Heading line |
|---|---|---|
| 2916 | how-to-check-fir-registered-against-you-maharashtra | Think an FIR may be registered against you, or got a police notice? |
| 2714 | whatsapp-social-media-defamation-india-legal-options | Received a legal notice, police notice or FIR over a post or message? |
| 2600 | discharge-application-criminal-case-india | Charge sheet filed and thinking about a discharge application? |
| 2919 | jamanat-kitne-din-me-milti-hai-kharcha-documents-pune | जमानत के लिए तुरंत सलाह चाहिए? |
| 2923 | bns-dhara-103-hatya-jamanat-saza-hindi | BNS धारा 103 के मामले में गिरफ्तारी या जमानत को लेकर चिंता है? |

- The body line says who and where (Shivajinagar, Pune) and that calls and WhatsApp are answered at any hour. It says nothing about fees, results or inducement (BCI Rule 36).
- The buttons are `tel:+918411982241` and `https://wa.me/918698400302`. The site's existing tracker (`akc-cl-js`) fills in the WhatsApp screening text and sends the Ads conversion.
- The box is a `<div class="akc-cta">` with inline styles. Posts 2714 and 2600 are block posts, so there it is wrapped in a `wp:html` block.
- Emoji icons were removed from the buttons. WordPress swaps emoji for images that load late, so they showed as broken images on phones.
- All 5 pages were checked live on a phone-sized screen: one box on each page, with working call and WhatsApp links. Screenshot: `cta-box-live.png`.
- To undo it, delete the `akc-cta` div (and its `wp:html` wrapper) from each post, or restore the previous revision.

Measure it in Search Console and Google Ads: compare phone and WhatsApp conversions from these pages over the next 2–4 weeks.

## 9 Nov 2026: JustDial added to sameAs
- The user approved installing the **Code Snippets** plugin. Snippet #5, "Ryze head code: AKC sameAs directories", is active on wp_head.
- One of the live AKC plugins (not in this repo; probably akc-seo-toolkit, akc-site-fixes or akc-performance) strips every `application/ld+json` block except `id="akc-schema"`. Rank Math's schema is stripped too.
- Workaround: a small inline script that adds a JSON-LD node (`@id` …/#legalservice) with sameAs: Google Maps CID, JustDial (https://www.justdial.com/RSL-ITN1794201538), LinkedIn, Facebook, X. Google's renderer picks up JSON-LD added by JavaScript.
- Checked in headless Chromium: the node is present and valid on the homepage. The only page error, "wp is not defined", was already there and is not from this snippet.
- To add more directories (LawRato, Sulekha): edit snippet #5 (Snippets → All Snippets) and add each URL to the sameAs array.
