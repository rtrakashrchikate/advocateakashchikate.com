# Ads plan: criminal defence first (Google Search)

**Date:** 8 November 2026 (v2: criminal-defence focus) · **Account:** Google Ads 826-700-8748 (INR) · **Status:** draft for approval. Nothing is live.

**Focus:** criminal defence (bail, anticipatory bail, arrest, police custody and remand, FIR quashing, trial). Mutual-consent divorce runs as a small side campaign. **Cheque bounce / NI Act is dropped.**

The old campaigns were removed on 8 November 2026. None had served an ad in the past year: all four showed as "Suspended" while the account was active and billing was approved. Both Meta ad accounts were already empty.

**Method.** The structure follows the `ads` skill in `marketingskills-2.11.1.zip` (its Google Search playbook and RSA spec). Volumes and bids come from Google Keyword Planner through the Ryze connector (Oct 2025–Sep 2026, monthly averages).

## Step 0: fix these before anything goes live

| # | Task | Why | Who |
|---|---|---|---|
| 1 | Check **Billing → Summary** (a manual-payments balance of zero stops all ads) and **Advertiser verification** | This is what suspended the old campaigns. New ones will be suspended too until it's fixed. | You, in Google Ads |
| 2 | Track website leads: contact-form submit, tap on the phone number, tap on WhatsApp | Today only calls from ads and map directions are tracked. Without this, Google can't learn which searches bring clients. | Me: a small akc-* WordPress plugin with the Google tag and three events |
| 3 | Call asset with the office number (office hours) | Every old ad was flagged PHONE_NUMBER_IN_AD_TEXT | Me, through Ryze, with your approval |
| 4 | Once a week, mark which calls and forms were **genuine enquiries** | The playbook's top lever: optimise on real enquiries, not on every call (wrong numbers, students, other lawyers) | You (2 minutes); I'll set up the import |

## What people search (monthly)

| Search | Pune city | Maharashtra | Bid range ₹ (state) | Use |
|---|---|---|---|---|
| criminal lawyer | 880 | 4,400 (spikes Jan–Mar) | 25–114 | Pune only, Phrase |
| criminal lawyer near me | n/a | 880 | 22–115 | Pune only |
| criminal lawyer pune | 390 | 590 | 9–48 | Core |
| best criminal lawyer in pune | 210 | 320 | 11–30 | Core (the keyword can say "best"; the ad never does) |
| criminal advocate | n/a | 90 | 26–111 | Core |
| anticipatory bail | 590 | 3,600 | 24–40 | Phrase with a modifier only (many are students) |
| अग्रिम जमानत (Hindi) | n/a | 480 | n/a | Hindi ad group |
| अटकपूर्व जामीन (Marathi) | n/a | 50 | n/a | Marathi ad group |
| fir quashing / quashing of fir | 90 | 590 | n/a | High Court campaign |
| default bail | n/a | 170 | n/a | High Court / remand group |
| police custody | n/a | 170 | n/a | Remand group, with modifiers |
| regular bail | 10 | 70 | n/a | Bail group |
| cross examination, criminal trial | 10–90 | n/a | n/a | **No ads.** Mostly students and law books. Trial work goes in ad text and sitelinks, and stays an SEO topic. |

**Not used:** "jamin" (880), which is ambiguous with जमीन (land), and bare "जामीन" (880), which spikes with news. Both go in negatives or wait for search-term data.

## Campaigns: ₹600/day to start (about ₹18,000/month), each with its own budget

### C1 · GOOG_Search_Criminal_Pune (₹350/day) · Pune + Pimpri-Chinchwad, 30 km

| Ad group | Keywords (Phrase / [Exact]) | Landing page |
|---|---|---|
| Criminal lawyer Pune | "criminal lawyer pune", [best criminal lawyer in pune], "criminal advocate pune", "criminal lawyer near me", "criminal lawyer" | /practice-areas/criminal-defence/ |
| Anticipatory bail | "anticipatory bail pune", "anticipatory bail lawyer", "anticipatory bail advocate", "apply for anticipatory bail", "anticipatory bail process" | /practice-areas/anticipatory-bail/ |
| Arrest, custody and remand | "arrested by police", "husband arrested", "police custody lawyer", "remand hearing", "police custody bail", "what to do after arrest" | /practice-areas/police-custody-remand/ (husband queries: /husband-arrested-pune-what-to-do/) |
| Regular bail | "bail lawyer", "regular bail", "bail application", "bail rejected", "bail in sessions court" | /practice-areas/bail-application/ (rejected: /bail-rejected-sessions-court-pune-what-next/) |
| Police notice | "41a notice", "section 35 bnss notice", "police notice received", "police called for inquiry" | /practice-areas/police-notice-section-35-bnss/ |
| Hindi · अग्रिम जमानत | "अग्रिम जमानत", "जमानत वकील", "agrim jamanat", "jamanat kaise milti hai" | /agrim-jamanat-anticipatory-bail-hindi-pune/ · /jamanat-kitne-din-me-milti-hai-kharcha-documents-pune/ |
| Marathi · अटकपूर्व जामीन | "अटकपूर्व जामीन", "जामीन वकील", "jamin vakil", "atakpurva jamin" | /atakpurva-jaamin-vkil-pune/ · /jamin-vakil-pune/ |

### C2 · GOOG_Search_Criminal_HighCourt (₹150/day) · districts under the Bombay High Court principal seat

Mumbai, Mumbai Suburban, Thane, Palghar, Raigad, Pune, Satara, Sangli, Kolhapur, Solapur, Ratnagiri, Sindhudurg, Nashik. Leave out the Aurangabad and Nagpur bench districts. **Check this list against where you actually take matters.**

| Ad group | Keywords | Landing page |
|---|---|---|
| FIR quashing | "fir quashing", "quashing of fir", "quash fir high court", "section 528 bnss", "482 crpc quashing" | /practice-areas/fir-quashing/ |
| High Court bail | "anticipatory bail high court", "bail in high court", "bombay high court bail", "bail after sessions court rejection" | /practice-areas/anticipatory-bail/ |
| Default bail / undertrial | "default bail", "chargesheet not filed bail", "undertrial release" | /practice-areas/default-bail-undertrial-release/ |
| Appeal and suspension of sentence | "criminal appeal high court", "suspension of sentence", "bail pending appeal" | /practice-areas/criminal-appeals-suspension-of-sentence/ |

### C3 · GOOG_Search_Brand (₹25/day) · India

[advocate akash chikate], [akash chikate], [akash chikate advocate]. About 30 searches a month. It stops other firms from taking your name. Add your name as a negative in C1, C2 and C4.

### C4 · GOOG_Search_MutualDivorce (₹75/day) · Pune + 30 km, mutual consent only

"mutual divorce pune", "mutual consent divorce", "mutual divorce process", "mutual divorce lawyer". Negatives: contested, alimony fight, cruelty, 498a, custody battle. Landing pages: /mutual-consent-divorce-pune/ and /practice-areas/family-law-divorce/. ("divorce lawyer pune" gets 1,600 searches a month but is mostly contested cases, so it's left out on purpose.)

### No Meta for now

Nobody looks for a bail lawyer while scrolling. Revisit Meta only for remarketing once the site has ad traffic.

## Settings (from the playbook)

- Search network only. Search Partners off, Display off.
- Location: **Presence** ("people in or regularly in"), not "interested in".
- Languages: English, Hindi, Marathi. Google matches on the phone's language, so ads in all three are needed.
- Bidding: Manual CPC (max ₹45 in C1, ₹35 in C2) or Maximize clicks with that cap. Move to **Maximize conversions** only once a campaign has 15+ genuine leads a month. Phrase and Exact match only; Broad only after 30+ conversions a month.
- Schedule: 24×7 (arrests happen at night and on weekends). Call asset during office hours only.
- 2–3 ads per ad group. Change bids in ±10–15% steps, no more than once a week.

## Negative keywords (campaign level, from day 1)

pdf, judgment, judgement, case law, citation, format, draft, sample, notes, meaning, definition, essay, upsc, mpsc, llb, llm, exam, question, mcq, project, assignment, wikipedia, book, salary, job, internship, vacancy, free legal aid, online course, bare act, movie, film, web series, netflix, cast, "art of cross examination", pozner, dodd, krieger, jamin (land), plot, property, 7/12, cheque, 138, ni act, consumer, trademark.

Your name goes in as a negative everywhere except C3. Bare "anticipatory bail" without a modifier goes in as a negative **exact** in C1, until search terms show it brings real enquiries.

## Sitelinks and callouts (shared)

- Sitelinks: Anticipatory Bail → /practice-areas/anticipatory-bail/ · Arrest & Remand → /practice-areas/police-custody-remand/ · FIR Quashing → /practice-areas/fir-quashing/ · Trial Defence → /practice-areas/sessions-trial-defence/ · Contact the Office → /contact/
- Callouts (≤25): `Bombay High Court` · `Pune District Courts` · `Office in Shivajinagar` · `English, Hindi, Marathi` · `By Appointment`

## Sample ad: C1 › Criminal lawyer Pune

Final URL: https://advocateakashchikate.com/practice-areas/criminal-defence/ · Path: `criminal-defence` / `pune` · No pins

| # | Headline (≤30) | Chars |
|---|---|---|
| 1 | Criminal Lawyer in Pune | 23 |
| 2 | Criminal Defence, Pune | 22 |
| 3 | Adv. Akash R. Chikate | 21 |
| 4 | Bail & Anticipatory Bail | 24 |
| 5 | Arrest, Remand & Custody | 24 |
| 6 | FIR Quashing, High Court | 24 |
| 7 | Sessions Trial Defence | 22 |
| 8 | Bombay High Court Practice | 26 |
| 9 | Pune District Courts | 20 |
| 10 | Office in Shivajinagar | 22 |
| 11 | Consultation by Appointment | 27 |
| 12 | English, Hindi, Marathi | 23 |
| 13 | Police Notice: What to Do | 25 |
| 14 | Bail Appeals & Revisions | 24 |
| 15 | Speak to the Office Today | 25 |

| # | Description (≤90) | Chars |
|---|---|---|
| 1 | Criminal defence in Pune: bail, anticipatory bail, remand, trial and FIR quashing. | 82 |
| 2 | Practice before the Bombay High Court and Pune District Courts. Office in Shivajinagar. | 87 |
| 3 | Arrested or served a police notice? Read the first steps, then book a consultation. | 83 |
| 4 | Consultation by appointment. English, Hindi and Marathi. Read how each stage works. | 83 |

The full set of ads for every ad group gets written at build time, to the same rules, and shown to you before anything goes live.

## Ad wording rules (BCI Rule 36 + Google policy)

- Factual and informational: what the service is, which court, which stage, languages, office.
- **Never:** best / top / No. 1 / expert / leading, guaranteed, success rates, case results, testimonials, fees, discounts, urgency claims ("get bail today"), the phone number in the text.
- The keyword "best criminal lawyer in pune" is fine to bid on. The ad text still never says "best".

## Running it

| When | What |
|---|---|
| Days 1–7 | Search-terms review every 2 days: add negatives for waste, add converting terms as Exact. No bid changes. |
| Weekly | The three passes (waste / winners / drift). You mark genuine enquiries. |
| Week 4 | Review cost per genuine enquiry by ad group. Move budget toward what brings matters. Decide whether to scale (≤20% at a time). |

**Expected first month at ₹18,000:** around 500–800 clicks at ₹20–35 each. That's an estimate from Keyword Planner bids, not a promise. The number to judge is cost per **genuine** enquiry, which we'll only know after 3–4 weeks.

## Other skills in the repo that help here

| Skill (zip) | Use for |
|---|---|
| `ads` + `references/google-search-playbook.md`, `rsa-output-spec.md`, `conversion-tracking.md` (marketingskills) | This plan, writing the ads, and setting up tracking |
| `analytics` (marketingskills) / `analytics-tracking` (claude-skills) | The lead-tracking plugin: GA4 events for form, phone and WhatsApp |
| `page-cro` (both) | Tightening the practice-area pages so the H1 matches the ad and the call button sits above the fold |
| `ai-seo` (marketingskills) | The open question "Does ChatGPT mention my brand?" |
| `local-seo-manager` (claude-skills) | The Google Business Profile side, alongside gbp-tools |
| `ad-creative` | Only if Meta is added later |

## What I need from you

1. The fix for Step 0 #1 (billing / verification) once you've checked it.
2. OK ₹600/day and the split (C1 ₹350 · C2 ₹150 · C4 ₹75 · C3 ₹25), or change it.
3. Confirm the High Court district list for C2.
4. OK the lead-tracking plugin (Step 0 #2).

Then I'll build all four campaigns **paused** through Ryze, show you every ad, and switch them on only after you approve.
