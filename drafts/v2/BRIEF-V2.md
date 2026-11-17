# Brief V2: rewrite and build pages for advocateakashchikate.com (Pune + Mumbai)

Read `drafts/BRIEF.md` FIRST. Everything in it still applies (facts, Bar Council Rule 36, accuracy rules, page format, HTML rules, output file structure, "do not write to WordPress, do not commit"). This file ADDS to it and wins where they differ.

## What is new
The advocate exported Semrush keyword research (seeds: "criminal lawyer Pune" and "FIR quashing"). Each task below gives you the real search terms (monthly searches in India, keyword difficulty KD) that your page must serve. Use them: the main term in the title, H1 and first paragraph; related terms as H2/H3 headings, FAQ questions and natural wording. Never stuff keywords.

## Geography: hard limit
- Write only for **Pune** (including Pimpri-Chinchwad) and **Mumbai** (Bombay High Court, Mumbai courts). Name no other city, district or state, and no other state's court, police portal or procedure. (The Supreme Court of India is fine, since it is national.)
- The advocate's offices are in Pune. He appears at the Bombay High Court in Mumbai. Do NOT say or imply he has a Mumbai office. For Mumbai readers say matters before the Bombay High Court and Mumbai courts are handled, with consultation by phone or video, and that the office is in Shivajinagar, Pune.
- Mumbai-specific facts (Mumbai Police, Mumbai courts, Bombay High Court rules) only if verified. Cite the source.

## Copywriting rules (from the copywriting skill, adapted to a law practice)
- Clarity over cleverness. Plain words: "use", not "utilise". Sentences under 25 words, active voice, no exclamation marks, no buzzwords.
- Specific over vague: name the court, the section, the document, the stage. A reader should be able to act on each paragraph.
- Customer language: use the phrases a worried family member types (Hinglish like "jamanat kaise milti hai" where it matches a real search).
- Lead with the direct answer. One idea per section. Headline must pass the test "does a person searching this term see their exact question answered?"
- Honest over sensational: no invented figures, no promises. Rule 36 overrides the skill's advice on social proof, testimonials, urgency and strong sales CTAs. The only call to action allowed is one neutral closing line, e.g. "If you need advice on your situation, you can contact the office."
- Titles: SEO_TITLE max 60 characters, starts with the main term, no "best", "top", "expert", "leading", "No. 1", "free consultation".
- Never target "best / top" keywords even though they have volume.

## Accuracy (make no mistakes)
- Verify EVERY section number, time limit and quoted rule by web search against the bare act or a reliable comparison table. Give new and old numbers together: e.g. "Section 482 BNSS (old Section 438 CrPC)". Offences before 1 July 2024 are still tried under the old laws: say so where relevant.
- Verify EVERY judgment by web search; list URL in SOURCES. If you cannot verify it, leave it out. Do not cite from memory.
- Where something varies by court or is not confirmed, say so in the text in general terms and add it to VERIFY. Never guess.
- FAQ: 6 to 8 real questions as people search them, each 2 to 4 sentences, answers consistent with the body.
- Length: 1,500 to 2,200 words for service pages, 1,200 to 1,800 for guides.

## Editing an existing live page
1. Fetch the current content (public REST, needs a browser user agent):
   `curl -s -A "Mozilla/5.0 (iPhone; CPU iPhone OS 17_0 like Mac OS X) AppleWebKit/605.1.15 Version/17.0 Mobile/15E148 Safari/604.1" "https://advocateakashchikate.com/wp-json/wp/v2/<posts|pages|practice_area>/<ID>?_fields=id,slug,title,content"` and save it under the scratchpad, not the repo.
2. Read it fully. Keep what is correct and useful. Correct anything wrong. Remove any Rule 36 problem (superlatives, "specialist", success claims, results, urgency, fee amounts). Add what the keyword list shows is missing.
3. Keep the SLUG exactly as the live slug (do not change URLs). Keep internal links that still make sense.
4. If the live page has a non-text block (a styled "Free Download" box, contact box, table of services, hub links), copy it verbatim into a section `---PRESERVE---` after VERIFY, with a one-line note on where it belongs. Do NOT include the "Next step" boxes or the "Every criminal service is listed on..." line; the site adds those automatically.
5. Report in your final message what you changed in 3 bullet points.

## Output
One file per page in `drafts/v2/`, named as given in your task. Same structure as BRIEF.md, with two extra header lines at the top:
```
ACTION: EDIT <type> <ID>   (or)   ACTION: NEW
KEYWORDS_SERVED: <the Semrush terms you used, with volume>
SLUG: ...
POST_TITLE: ...
SEO_TITLE: ...
META_DESCRIPTION: ...
FOCUS_KEYWORDS: ...
---HTML---
...
---SOURCES---
...
---VERIFY---
...
---PRESERVE---   (only when editing, only if needed)
```
Final message per page: slug, word count, number of VERIFY items, 3 bullets of what changed (edits).

## Extra existing pages you may link to (besides the BRIEF.md list)
/bombay-high-court-lawyer-pune/ (Bombay High Court criminal lawyer), /practice-areas/criminal-defence/, /how-to-check-fir-registered-against-you-maharashtra/, /free-criminal-defence-guide/ is NOT to be linked. Newly planned pages from this batch (link to them only if your task says so): /section-438-crpc-section-482-bnss-anticipatory-bail-explained/, /section-439-crpc-section-483-bnss-bail-explained/, /interim-bail-meaning-pune/, /section-482-crpc-section-528-bnss-quashing-fir-bombay-high-court/, /private-complaint-section-200-crpc-section-223-bnss-pune/.
