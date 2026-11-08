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

Mumbai, Mumbai Suburban, Thane, Palghar, Raigad, Pune, Nashik. **Not** the six districts moved to the Kolhapur circuit bench on 18 Aug 2025 (Kolhapur, Satara, Sangli, Solapur, Ratnagiri, Sindhudurg), and not the Aurangabad or Nagpur bench districts. If you also take Kolhapur-bench matters, add those six back. **Check this list against where you actually take matters.**

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

## Trial build: 8 Nov 2026 (in the account, PAUSED)

**Why ads never ran:** the account budget (manual payments) had an approved spending limit of **₹0**, so every campaign showed "Suspended". Funds must be added under Billing before anything serves. Auto-tagging was off; it's now on, so ad clicks carry a click ID.

**Campaign `GOOG_Search_Criminal_Pune_Trial` (ID 24445166105)**
- ₹800/day cap, Manual CPC, Google Search only (no partners, no Display), Pune + Pimpri-Chinchwad, *Presence* only, English/Hindi/Marathi.
- 83 campaign negatives (research, jobs, non-criminal practice areas, divorce), plus "chikate" as a negative outside the Brand group.

| Ad group | Max CPC ₹ | Keywords | Landing page |
|---|---|---|---|
| Criminal Lawyer Pune | 60 | 14 | /practice-areas/criminal-defence/ |
| Bail and Anticipatory Bail | 55 | 16 | /practice-areas/anticipatory-bail/ |
| Arrest Custody Remand | 60 | 17 (arrest terms sent with a clickbait-policy exemption request) | /practice-areas/police-custody-remand/ |
| Advocate Near Me Pune | 30 | 8 generic; the ad pins "For Criminal Cases Only" to filter out non-criminal clicks | /practice-areas/criminal-defence/ |
| Brand | 15 | 4 | / |
| Hindi Jamanat | 40 | 7 | /agrim-jamanat-anticipatory-bail-hindi-pune/ |
| Marathi Jamin | 40 | 6 | /atakpurva-jaamin-vkil-pune/ |

- One RSA per ad group (15 headlines / 4 descriptions, lengths checked). Situation headline pinned at H1. Facts as you instructed ("Experienced Criminal Advocate", "Hundreds of Matters Handled", no numbers). A Diwali vacation-court line runs for the trial window.
- Assets: call button **+91 84119 82241** (the website number, so Google can verify it; scheduled 6am–11pm), WhatsApp **+91 86984 00302** (needs advertiser verification to show), 6 sitelinks, 8 callouts, a "Services" snippet.
- Conversions: "Qualified enquiry (offline)" created for uploads. Google's API refused a 60-second call action (likely India call-forwarding limits), so calls use the account's existing "Clicks to call" action. Real call quality comes from your phone log, recorded in `LEAD-LOG.csv`.
- Not used in the trial: the lead form. Without a webhook, form leads wait inside Google Ads; calls and WhatsApp reach you instantly.

**Realistic volume (Keyword Planner, Pune city, monthly):** criminal-intent searches about 1,000–1,500; generic "advocate / lawyer in Pune / near me" about 4,200 (mixed practice areas). At full coverage that's about 6–12 clicks a day at ₹30–60, and roughly 1–3 calls or WhatsApps a day. **10 qualified leads a day is not reachable from Pune Google Search alone.** About 5–12 genuine enquiries over 2 weeks is a good result; that number decides whether to widen to the High Court districts and raise the budget.

**Before switching on:** (1) add funds, ₹10,000 suggested for 14 days; (2) check Billing → Advertiser verification; (3) tell me to enable the campaign, or set it to Enabled yourself.

## Lead-quality setup (v3, from research)

The research: practitioner and agency guides, Google's help pages and Google Ads forum write-ups; sources are listed at the end. It agrees that **lead quality is decided by what you count as a conversion and how fast you answer**, more than by the ads themselves. So the first campaign launches with this setup:

1. **Only genuine enquiries teach Google.**
   - Primary conversion: "Qualified enquiry", uploaded by us (offline import or enhanced conversions for leads). You mark it after the first conversation: a real matter, the right practice area, and the person can engage you.
   - Secondary (observe only, not used for bidding): raw calls, form sends, WhatsApp taps.
   - Without this, smart bidding finds more of whatever fills the form, including students, wrong numbers and bots.
2. **Calls count only at 60 seconds or longer.** Under 60s is mostly wrong numbers and hang-ups. Note: in India, Google does not show the caller's number for ad calls, so to know who called, use your own call log for website calls. For full recording and caller ID, an Indian virtual-number service (Exotel / MyOperator / Knowlarity type) is optional later.
3. **WhatsApp message asset** (available in India on Search; mobile only; needs advertiser verification). Google doesn't show it next to a call asset, so **schedule the two**: call asset 9am–9pm, WhatsApp asset 9pm–9am and when the office is closed. Arrests happen at night, and a WhatsApp message waits for you; a missed call is wasted money.
4. **Lead form asset, "more qualified" + SMS OTP** (Search only). Three qualifying questions: *Has an FIR been registered? · Is someone in police or judicial custody now? · Which police station or court?* OTP verification cuts fake numbers and bots. Leads that can't verify are dropped.
5. **Website form hardening:** capture the click ID (GCLID) in a hidden field so we can report qualified leads back to Google; add a honeypot field and reCAPTCHA; make the phone number required.
6. **Answer within 5 minutes.** Criminal clients hire within hours; most guides cite ~70% hiring within 48 hours of starting the search. If nobody can answer at night, WhatsApp-only hours (point 3) cover it. Never let ads run into an unanswered phone.
7. **Hiring-intent words in, research words out.** Keywords carry a situation or a hiring word: *arrested, police station, FIR registered, custody, remand, notice received, near me, advocate, vakil, lawyer, today*. Words like *meaning, section, pdf, judgment, notes, llb* are negatives.
8. **Ad text speaks to the situation.** Pin headline 1 to the ad group's situation: "Arrested in Pune?" · "FIR Registered Against You?" · "Received a 41A Notice?" · "Bail Rejected? Next Steps". Then add facts: courts, office, languages, hours. Proof such as years at the Bar or matters handled only if you give me the true numbers.
9. **Click protection:** exclude the office IP and any known competitor or office IPs, check invalid clicks weekly, and dispute repeated invalid clicks with Google.
10. **Bid by hour later, not now.** After 2–3 weeks of data, raise bids on hours and days that bring qualified enquiries (often late night and weekends for arrest searches).

**Not using:** Local Services Ads (pay-per-lead, "Google Screened"). They're a big win for US criminal firms, but I found no confirmation that legal categories are open in India. Bidding on other advocates' names is allowed by Google but leads to disputes; skip it unless you want it. JustDial / LawRato style paid leads: reviews are mixed and there's no lead-quality data, so they're not part of this plan.

**What nobody can promise:** a guaranteed number of quality leads. Points 1–6 are what make quality likely; after 3–4 weeks we'll have your own cost per qualified enquiry, and that number decides what we scale.

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

## Ad wording rules (your instruction + Google policy)

- **Your rule:** no direct inducement, and no fees, prices or discounts. The professional-conduct call is yours as the advocate.
- **Google's rules, which apply regardless:** no guaranteed outcomes ("bail guaranteed"); no phone number in the ad text; no clickbait or excessive punctuation; every claim must be true and checkable on the landing page.
- **Allowed and recommended:** situation headlines ("Arrested in Pune?"), urgency that's true ("Available after hours on WhatsApp", only if someone actually answers), courts and stages, languages, office location. Facts like years of practice or matters handled only with the true numbers you give me. Case-result pages already exist on the site and can be sitelinks.

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

## Sources (v3 research)

- Google Ads Help: [call reporting](https://support.google.com/google-ads/answer/2454052?hl=en) (no caller numbers in India), [call details](https://support.google.com/google-ads/answer/9099302), [phone call conversions](https://support.google.com/google-ads/answer/6100664?hl=en), [lead form assets](https://support.google.com/google-ads/answer/9423234?hl=en), [create lead form assets](https://support.google.com/google-ads/answer/16726130?hl=en), [offline conversion import](https://support.google.com/google-ads/answer/7014069?hl=en), [restricted businesses (bail bonds)](https://support.google.com/adspolicy/answer/6368711?hl=en)
- WhatsApp message assets in India: [Search Engine Roundtable](https://www.seroundtable.com/google-ads-click-to-whatsapp-message-assets-37818.html), [Search Engine Land](https://searchengineland.com/google-ads-call-assets-lead-forms-message-assets-476618), [SleekFlow](https://sleekflow.io/blog/google-click-to-whatsapp-ads)
- Lead quality / offline conversions: [AttorneySync](https://www.attorneysync.com/blog/offline-conversion-imports-for-law-firms/), [Pete Bowen](https://pete-bowen.com/getting-a-lot-of-junk-leads-from-google-ads), [Relevant Audience](https://www.relevantaudience.com/google-ads-en/google-ads-invalid-leads-three-form-checks/), [ClickFortify](https://www.clickfortify.com/blog/google-ads-lead-form-spam)
- Criminal-defence PPC: [Marketing for Justice, "2 A.M. playbook"](https://www.marketingforjustice.com/resources/criminal-defense-dui-google-ads), [GrowLaw](https://growlaw.co/blog/ppc-for-criminal-defense-lawyers), [ForwardPush](https://forwardpush.com/insights/google-ads-criminal-defense-lawyers/), [Savvy](https://savvylawfirmmarketing.com/blog/google-ads-for-criminal-defense-lawyers/), [Scorpion](https://www.scorpion.co/criminal-defense/insights/blog/verticals/criminal-defense/five-tips-for-criminal-defense-attorney-advertis/)
- Kolhapur bench: [India Legal](https://indialegallive.com/constitutional-law-news/courts-news/bombay-high-court-circuit-bench-kolhapur/), [Drishti](https://www.drishtiias.com/state-pcs-current-affairs/inauguration-of-circuit-bench-of-bombay-hc)

Most guides are US agency content. Their US benchmarks ($100–300 per lead) don't carry over to India; your own first month sets the real number.

## What I need from you

1. The fix for Step 0 #1 (billing / verification) once you've checked it.
2. OK ₹600/day and the split (C1 ₹350 · C2 ₹150 · C4 ₹75 · C3 ₹25), or change it.
3. Confirm the High Court district list for C2.
4. OK the lead-tracking plugin (Step 0 #2).

Then I'll build all four campaigns **paused** through Ryze, show you every ad, and switch them on only after you approve.

## Audit and fixes: 8 Nov 2026 (evening)

**Checked and fine:** Google tag AW-10830296684 (this account) and GTM on every page; the site's "AKC Compliance & Leads" plugin already tracks phone, WhatsApp and form taps and pre-fills WhatsApp with three screening questions plus an "Ads" source tag; Google's automatic ad text is OFF; no auto-apply recommendations; campaign goals count only website leads, calls from ads and qualified enquiries (not map directions).

**Done:**
- Conversion action "Website lead tap (call / WhatsApp / form)", label `AW-10830296684/oyoRCLqVt7QdEOzspKwo`. It records nothing until the label is pasted into the AKC Compliance & Leads plugin setting (step A).
- A second RSA in the 4 main ad groups (new angles: "FIR Registered Against You?", "Fear of Arrest in Pune?", "Family Member Arrested?", "Need a Criminal Advocate?" + "Criminal Matters Only"). 11 ads in total.
- Ad schedule rows: 7 days x 4 six-hour blocks, all on, no bid changes (for hour-of-day data).
- Audience in observation: Legal Jobs (to spot job-seeker clicks). Legal Education isn't offered for Search.
- Portrait (square crop, uploaded to the WP media library as ID 2999) and logo uploaded to the Google Ads asset library.

**Blocked by Google:**
- Business name and logo: refused with CUSTOMER_NOT_VERIFIED. The account isn't advertiser-verified, and Google requires verification for these.
- Image assets on Search ads: the account isn't eligible yet.
- 60-second call conversion (AD_CALL): the API refuses it for this account. Calls count as taps; your phone log is the record.
- Google Business Profile link via the API needs a Business Profile sign-in token. It must be linked in Google Ads (Admin → Linked accounts → Business Profiles).

## 8 Nov 2026 (evening): campaign paused by the user, Arrest ad fixed

- The user paused the trial campaign and set the budget to ₹700/day (5:50pm IST). This was their own decision. Leave it paused until they say otherwise.
- In the Arrest/Custody/Remand ad group, Google rejected 2 headlines as CLICKBAIT: "Family Member Arrested?" and "Bail After Arrest, Pune". Ad 831001210523 was fully disapproved because the rejected one was its pinned Headline 1. Ad 830862722829 was approved with limits.
- Replacements:
  - Ad 830862722829: "Custody & Remand Advice" and "Regular Bail Applications".
  - Ad 831001210523: pinned Headline 1 is now "Remand & Custody Lawyer, Pune", plus "Regular Bail Applications".
- Both ads are back in Google's review queue. The old CLICKBAIT status shows until the review finishes.
