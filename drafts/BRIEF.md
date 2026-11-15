# Brief for new guide pages: advocateakashchikate.com

You are writing one guide page for the website of **Advocate Akash R. Chikate**, a criminal defence advocate in Pune, India. The page goes into WordPress as a **draft**, and the advocate reviews it before it is published. Accuracy matters more than length: a wrong section number or an invented judgment harms a real lawyer's reputation.

## Facts you may use (do not invent others)
- Advocate Akash R. Chikate, enrolled with the Bar Council of Maharashtra & Goa (MAH/4681/2020). B.A. LL.B., LL.M.
- Main office: Office No. 202-203, Second Floor, Ekbote Complex, Above Dr. Gajanan Ekbote Hospital, Revenue Colony, Shivajinagar, Pune 411005, near the Pune District and Sessions Court. Second office by appointment: Pimple Gurav, Pimpri-Chinchwad.
- Phone +91 84119 82241; WhatsApp +91 86984 00302. Languages: Marathi, Hindi, English.
- Courts: Magistrate courts in Pune and Pimpri-Chinchwad, Pune District and Sessions Court (Shivajinagar), Bombay High Court in Mumbai. **There is no Pune bench of the Bombay High Court.**

## Bar Council of India Rule 36 (mandatory)
- No "best", "top", "expert", "leading", "No. 1", success rates, results, guarantees, testimonials, or past-client stories.
- No fee amounts. You may say fees depend on court and stage and are agreed at consultation, and link to `/criminal-lawyer-fees-pune/`.
- Informational tone. One short, neutral closing line is allowed, e.g. "If you need advice on your situation, you can contact the office." No pressure, no "call now".
- End the body with: `<p><em>This page explains the law in general terms and is not legal advice. Every case depends on its own facts.</em></p>`

## Accuracy rules
- India's criminal laws changed on 1 July 2024: BNS replaced IPC, BNSS replaced CrPC, BSA replaced the Evidence Act. Give **both** new and old section numbers (e.g. "Section 482 BNSS (old Section 438 CrPC)"). Verify every section number with a web search against a reliable comparison table or the bare act; do not rely on memory.
- **Every judgment you cite must be verified by a web search** and listed in Sources with a working URL. If you cannot verify a case, do not cite it. Prefer fewer, solid citations.
- No invented statistics, timelines, fees, office hours or procedures. Where a procedure varies (e.g. jail visit rules), say so and point to the official source.
- Maharashtra and Pune specifics only if you verified them (name the source in Sources).
- Write for a worried family member reading on a phone: short paragraphs, plain English, sentences under about 25 words, no legalese without explanation.

## Page format (this is what already works on the site)
1. Opening paragraph starting with `<p><strong>In short:</strong> ...</p>`: 2–4 sentences that directly answer the main question.
2. Sections with `<h2>`: what it is → what happens next and the stages → options (which court: Magistrate / Sessions / Bombay High Court) → documents to collect → realistic time (ranges only, if verifiable) → mistakes to avoid.
3. `<h2>Frequently asked questions</h2>` with 5–7 `<h3>` questions phrased the way people search (include Hinglish or old-section phrasings where people use them), each answered in 2–4 sentences.
4. Internal links (relative URLs) to 4–8 relevant existing pages, chosen from the list below, placed naturally in the text.
5. Plain HTML only: `<h2> <h3> <p> <ul> <ol> <li> <strong> <em> <a> <table>`. No inline styles, no scripts, no images.
6. Length: 1,200–1,800 words.

## Existing pages you may link to
/practice-areas/criminal-defence/ (criminal lawyer in Pune), /practice-areas/anticipatory-bail/, /practice-areas/bail-application/, /practice-areas/police-custody-remand/, /practice-areas/default-bail-undertrial-release/, /practice-areas/fir-quashing/, /practice-areas/discharge-application/, /practice-areas/sessions-trial-defence/, /practice-areas/criminal-appeals-suspension-of-sentence/, /practice-areas/police-notice-section-35-bnss/, /practice-areas/mcoca-defence/, /practice-areas/ndps-drug-offence-defence/, /practice-areas/pocso-defence/, /practice-areas/sc-st-atrocities-act-defence/, /practice-areas/eow-financial-crimes-defence/, /practice-areas/498a-domestic-violence-defence/, /practice-areas/cyber-it-law/, /how-to-get-anticipatory-bail-pune/, /bail-after-arrest-pune-guide/, /jamanat-kitne-din-me-milti-hai-kharcha-documents-pune/, /bail-rejected-sessions-court-pune-what-next/, /fir-quashing-bombay-high-court-pune/, /how-to-check-fir-registered-against-you-maharashtra/, /chargesheet-filed-what-next/, /police-kothadi-nyayalayin-kothadi-farak/, /rights-when-arrested-india/, /husband-arrested-pune-what-to-do/, /498a-fir-filed-husband-pune/, /false-fir-pune-legal-remedies/, /pending-criminal-case-job-passport-visa/, /fir-in-another-state-transit-anticipatory-bail/, /non-bailable-warrant-cancellation-pune/, /economic-offences-bail-bombay-high-court/, /eow-economic-offence-wing-pune-summons/, /investment-fraud-trading-app-scam-pune/, /ndps-act-bail-pune/, /drug-offences-ndps-act-pune-penalties/, /anticipatory-bail-conditions-pune/, /criminal-lawyer-fees-pune/, /crpc-to-bnss-ipc-to-bns-section-table/, /legal-aid-india-free-legal-help-maharashtra/

## Output: write ONE file at the path you are given, in exactly this structure
```
SLUG: <lowercase-hyphenated slug, include 'pune' where natural>
POST_TITLE: <H1 title shown on the page>
SEO_TITLE: <max 60 characters, starts with the main search phrase, no "best">
META_DESCRIPTION: <max 155 characters>
FOCUS_KEYWORDS: <3-5 comma-separated searches>
---HTML---
<the full HTML body>
---SOURCES---
- <title> — <URL>   (every judgment, section and Pune-specific fact)
---VERIFY---
- <each point the advocate should personally check before publishing, e.g. a procedure you could only partly confirm>
```
Do not write anything to WordPress and do not commit. Just write the file and, in your final message, give a 3-line summary: slug, word count, and the number of items in VERIFY.
