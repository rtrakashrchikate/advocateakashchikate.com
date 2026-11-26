# Keyword universe: criminal defence, Pune (advocateakashchikate.com)

Built 26 Nov 2026 with free tools only.

## How this was built, and what the numbers mean

- **Source:** Google Autocomplete (`suggestqueries.google.com`, `gl=in`). It was queried with `hl=en` (English and Hinglish seeds), `hl=hi` (Devanagari Hindi seeds) and `hl=mr` (Devanagari Marathi seeds).
- **Calls:** 2,474 distinct queries, about 2,475 network calls, with a 0.3–0.5 s pause between calls.
- **Seeds and expansions:**
  - 23 core English seeds, each expanded with a–z suffixes, six question prefixes (how to, what is, can, kya, kaise, best) and 14 suffixes (fees, cost, time, near me, pune, in pune, maharashtra, high court, bombay high court, kitne din me, kitna paisa, kaise, process, lawyer).
  - 44 secondary English and Hinglish seeds, each with 12 suffixes and two prefixes.
  - 16 Hindi and 15 Marathi seeds, each with 12 native modifiers (कितने दिन, कितना पैसा, फीस, किती दिवस, किती खर्च, म्हणजे काय, उच्च न्यायालय …).
  - 26 areas × 4 patterns ("advocate in X", "lawyer in X", "criminal lawyer in X", "X court").
  - 12 Pune courts and police units × 6 modifiers.
  - A second pass of 54 lead-heavy Hinglish, Hindi and Marathi stems ("anticipatory bail me kitna", "lawyer for X", "जामीन किती दिवसात" …).
- **Result:** 10,120 suggestions came back. After cleaning, **5,738 unique keywords** remain in `keywords.csv`. Cleaning removed:
  - 758 keywords tied to other Indian or foreign cities (Delhi, Chandigarh, Toronto …).
  - Junk such as "हुंडाई" (Hyundai), "जामीन पोळा" (a festival), badminton courts, housing societies called "… Court", "how to become a lawyer", and "discharge form" for hospitals or banks.
- **Bing did not work.** Bing SERP HTML was tried for related searches and "People also ask". From this environment Bing returns unrelated, bot-poisoned results: "fir quashing fees high court" came back with Chennai Super Kings and muscle-anatomy pages. Bing data was discarded, so no `bing-related` or `bing-paa` rows exist. Question phrasing comes from the autocomplete question prefixes instead.
- **There are no search volumes.** Autocomplete only shows that a phrase is a real, recurring query, and it shows the suggestion's rank (1 = shown first). Priorities below are set by:
  1. lead intent (hire, cost, time, near-me, area, court) over pure information;
  2. presence and rank in autocomplete, plus `times_seen` (how many different seed queries surfaced the same phrase);
  3. the site's own GSC impressions and positions you supplied, which are merged into the CSV as `gsc_impressions` and `gsc_avg_position`.
  - `lead_score` is a rough sort key built from those signals. It is not a volume estimate.
- **Rules that constrain the copy** (from `local-seo-context.md`): Bar Council of India Rule 36 bars "best", "top", "famous" and "expert" claims. Autocomplete is full of those phrases ("best criminal lawyer in pune", "famous criminal lawyers in pune", "top 10 advocate in pune"). They can only be met with neutral pages such as "how to choose a criminal lawyer in Pune", fee transparency and process guides. Never use them as titles or claims.

CSV columns: `keyword, language, topic, intent, geo, source, autocomplete_rank, seed`, plus four helper columns: `times_seen, lead_score, gsc_impressions, gsc_avg_position`.

Mix in the CSV:

| Dimension | Counts |
|---|---|
| Language | en 4,743 · hinglish 633 · hi 260 · mr 102 |
| Intent | info 2,550 · process 1,062 · hire 821 · eligibility 445 · cost 305 · time 294 · local-court 261 |
| Geo | none 4,884 · pune 374 · area 303 · maharashtra 177 |

---

## (a) Most promising lead keywords per topic

Notation: **r** = autocomplete rank (best seen); **x** = times seen across seed queries; **GSC** = your supplied data.

### 1. Anticipatory bail (492 keywords)

| Keyword | Why |
|---|---|
| anticipatory bail me kitna paisa lagta hai | r1, x3. GSC 96 imp. Hinglish cost intent; the top Hinglish cost query. |
| अग्रिम जमानत में कितना पैसा लगता है | r1. GSC 97 imp. Same intent in Devanagari. |
| anticipatory bail cost | r1, x5. GSC 21. |
| lawyer fees for anticipatory bail | r2, **x24**. The most widely surfaced cost phrase in the whole dataset. |
| anticipatory bail lawyers in pune | r1, x7. Hire + Pune. Site sits at about pos 31 for "anticipatory bail lawyer pune". |
| anticipatory bail charges in pune | r1. Cost + Pune. |
| anticipatory bail lawyer near me | r1, x8. |
| anticipatory bail kitne din me milta hai | r1, x6. GSC 58. Time intent. |
| high court se anticipatory bail kitne din me hota hai | r1, x5. Time + High Court. |
| anticipatory bail cost in district court / in high court / court fees for anticipatory bail | Shows people split cost by forum: sessions court vs High Court. |
| anticipatory bail lawyer fees / advocate fees / anticipatory bail fees in india | r1–r2 cluster. |
| agrim jamanat fees; agrim jamanat me kitna kharcha aata hai | Romanised Hindi variants. |
| how long is anticipatory bail valid | r3, **x17**. Post-grant worry; good FAQ. |
| अग्रिम जमानत कितने दिन में मिलती है / मिलने में कितना समय लगता है | Hindi time cluster (r1). |
| anticipatory bail cost for 420 / anticipatory bail cost for 498a | Offence-specific cost. Links to the 498A and cheating pages. |

Voice-typed misspellings also appear: "antiseptic bail kitne din me milta hai" (r3) and "anti safety bail kitne din me hota hai". These suggest phone voice search. A Hinglish FAQ catches them naturally.

### 2. Bail after arrest and regular bail (sessions court and High Court) (572)

| Keyword | Why |
|---|---|
| हाई कोर्ट से जमानत कितने दिन में होती है | r1, x4. GSC 184 imp, the biggest time query in your data. |
| bail kitne din me milti hai | r1, x5. GSC 75. |
| jamanat me kitna paisa lagta hai | r1. GSC 70. |
| bail karne me kitna paisa lagta hai | r1. GSC 77. |
| bail lawyer in pune | r1, x3. Hire + Pune. |
| bail lawyer near me | r1, x5. |
| how much a lawyer charge for bail | r2, x11. |
| how many days for bail in high court | r2, **x23**. Very widely surfaced. |
| how much time it takes to get bail from sessions court | r2, x5. Sessions court is the first forum in Pune. |
| lawyer fees for bail / bail lawyer fees / bail application lawyer fees / cost of bail in high court | Cost cluster, r1–r3. |
| jamanat karne me kitna kharcha aata hai (x5) / jamanat fees | Hinglish cost variants. |
| जमानत के लिए कितना पैसा चाहिए / जमानत कराने में कितना पैसा लगता है | Hindi cost. |
| session court me bail kaise milti hai / session court me bail kitne din me hota hai | Hinglish sessions-court process and time. |
| 307 / 302 / 376 / 420 / 354 / 306 की जमानत कितने दिन में होती है | Hindi time-by-section. Lists IPC numbers; people have not switched to BNS numbers. |
| bail rejected / "हाई कोर्ट से जमानत खारिज होने पर क्या होता है" | Next-step intent. Existing post: /bail-rejected-sessions-court-pune-what-next/. |

### 3. Interim bail (140)

- interim bail cost (r1, x7). A surprisingly strong cost signal.
- interim bail time period / duration / time limit (r1–r2).
- interim bail kitne din me hota hai; interim bail kab milti hai.
- अंतरिम जमानत कितने दिन की होती है.
- when can interim bail be granted (x4); can interim bail be extended; interim bail on medical grounds / humanitarian grounds.
- can interim bail be converted to regular bail; interim bail extension application format.

Why: the intent is mostly how long and whether it can be extended. Families of undertrials ask this during medical or family emergencies.

### 4. Default bail (145)

- default bail time limit (r2, x3); default bail how many days; default bail kitne din me hota hai.
- default bail after 60 days / after 90 days; how to calculate days for default bail; how to calculate 90 days for default bail.
- default bail bombay high court (x4); default bail kab milti hai; can default bail be cancelled.

Why: nearly all of this is day-count anxiety. A "60/90-day default bail calculator" (from date of first remand) would be a strong, linkable lead magnet.

### 5. FIR quashing, Bombay High Court (275)

| Keyword | Why |
|---|---|
| fir quashing fees | r1, **x18**. GSC 395 imp, pos 6.7. The single strongest cost query; you already rank. |
| quash petition fees | r1, x6. GSC 69. |
| fir quashing fees high court | r1, x5. GSC 39. |
| quash petition cost | r1, **x20**. |
| high court quashing fees | GSC 32. Not surfaced by autocomplete but real for you. |
| fir quashing fees in mumbai | r3, x4. Bombay High Court is in Mumbai; capture it with a "Pune client, Bombay High Court petition" angle. |
| fir quashing cost / quash petition price / quash petition charges in high court / quash petition court fees | Cost cluster. |
| best lawyer for fir quashing / best advocate for fir quashing | Hire intent; Rule 36 means a neutral title. |
| fir quashing kitne din me hota hai; quash petition time period / time limit; how much time it takes to quash an fir | Time cluster. |
| quash petition success rate | r1. Answer honestly with factors, not percentages. |
| quashing of fir on compromise / settlement; fir quashing compromise deed format | Strong in 498A and cheque matters; a high-converting sub-topic. |
| quashing petition format bombay high court (x3) | Process + MH. |
| fir quashing process / quash petition procedure | x21 each. Widely surfaced process terms. |

### 6. 498A, dowry and domestic violence (542)

- 498a quashing fees: r1, x4. GSC 37.
- 498a lawyer near me (r1); lawyer for 498a case; 498a lawyers.
- best lawyer in pune for domestic violence: Pune + hire, r7.
- anticipatory bail cost for 498a (x5); 498a anticipatory bail cost; 498a bail cost.
- 498a case fees; domestic violence case fees / cost / lawyer fees; how much does a domestic violence case cost.
- how much time it takes to quash 498a (x4); 498a time limit; dowry case time limit (x6).
- 498a case kitne din chalta hai; dahej case kitne din chalta hai: Hinglish time.
- 498a quashing petition on compromise; 498a me settlement / compromise kaise kare; 498a केस में समझौता कैसे करें.
- झूठे दहेज केस से कैसे बचे; दहेज केस में गिरफ्तारी कब होती है: Hindi defence intent. There is no Hindi 498A page on the site.
- domestic violence case pune; recent dowry case in pune; pune dowry case in marathi.

### 7. Police notice, Section 35(3) BNSS (old 41A CrPC) (161)

- police notices near me (r1).
- what is section 35 bnss / what is section 35 3 bnss (+ "in hindi").
- what is 41a notice (x3).
- section 35 bnss notice format / section 35 3 bnss notice format.
- police notice ka jawab kaise de; police ko notice kaise likhe: Hinglish "how to reply".
- 41a सीआरपीसी नोटिस कितने दिन: time.
- section 35 bns is bailable or not. Users confuse BNS 35 (private defence) with BNSS 35. Clarify on the page.
- pune police notice.

Why: demand is modest and mostly informational, but a notice is the point just before arrest. Pair the page with "what to do in 24 hours" and the WhatsApp-scam verification post.

### 8. MCOCA (201)

- mcoca court pune (r2, x2): local-court intent, the best lead term here.
- mcoca pune; mcoca case in pune: Pune + topic.
- how to get bail in mcoca.
- when can mcoca be invoked; mcoca kab lagta hai.
- mcoca act jail time period; mcoca act how many years.
- मकोका म्हणजे काय; मकोका कायदा म्हणजे काय: Marathi info. You already rank 8–9 for "mcoca act".

Why: the cluster is informational. Leads come from the "MCOCA invoked against a family member, bail and special court in Pune" angle.

### 9. MPID and EOW (109)

- eow case lawyer pune (r1): the only hire term.
- economic offences wing pune / address / contact number / city: a large navigational set of about 15 variants.
- how to get bail in mpid act; mpid act bailable or non bailable (x3); is mpid act bailable in marathi.
- mpid act amount limit; when mpid act is applicable; mpid act information in marathi.

### 10. Cyber crime and bank-account freeze (612): the largest under-served lead cluster

| Keyword | Why |
|---|---|
| cyber crime lawyer in pune / cyber crime advocate pune / advocate in pune for cyber crime | r1–r2. Site is at about pos 36. |
| lawyer for cyber crime near me | r2, **x17**. |
| bank account freeze lawyer / bank account freeze advocate lawyer | r1. |
| bank account freeze kitne din me hota hai / kitne din me thik hota hai; freeze bank account kitne din me khulta hai | Time. |
| bank account freeze kaise hataye (x4); bank account freeze unfreeze kaise kare; bank account debit freeze kaise hataye | Hinglish process. |
| account freeze ho gaya kya karen / kaise sahi hoga / application kaise likhe; cyber cell ne account freeze ho jaye to kya kare | Distress queries; very lead-like. |
| bank account freeze by cyber crime how to unfreeze (sbi) | Bank-specific variants (SBI, Axis, Union). |
| bank account freeze application in hindi / english; bank account freeze letter format | Template demand; good lead magnet. |
| bank account freeze due to online gaming | Emerging sub-cause. |
| cyber crime lawyer fees / cyber crime lawyer fees in india | Cost. |
| cyber police station pune address / contact number; cyber police station pune rural | Navigational; local proof. |
| बँक खाते ब्लॉक किंवा गोठवले; बैंक अकाउंट फ्रीज बाय साइबर क्राइम | Marathi and Hindi. |

### 11. NDPS (141)

- ndps lawyer in pune / ndps lawyer pune (r1); best ndps lawyer in pune (r2). Pune hire demand exists.
- ndps lawyer near me; lawyer for ndps case.
- ndps bail fees; ndps lawyer fees; ndps fees.
- ndps bail time; ndps act me bail kitne din me hota hai.
- how to get bail in ndps case (x15); bail in ndps act in commercial quantity (x17); ndps bail bombay high court (x4).
- is ndps act bailable.

### 12. POCSO (343)

- pocso lawyer near me (r1, x3); pocso advocate near me; pocso lawyer.
- pocso court in pune (r1); pune pocso court: local court.
- pocso case lawyer fees; pocso case fees.
- pocso act jamanat kitne din me hota hai; pocso act me bail kitne din me hota hai; पास्को एक्ट में जमानत कितने दिन में मिलती है.
- can pocso case be withdrawn; can pocso case be quashed on the basis of compromise.
- pocso chargesheet time; pocso investigation time.

### 13. Cheque bounce (Section 138 NI Act) (391)

- cheque bounce lawyers in pune (r1): Pune hire.
- cheque bounce case lawyer / advocates near me (r1, x4); cheque bounce lawyer near me.
- cheque bounce lawyer fees (x7); cheque bounce case lawyer fees (x7); cheque bounce case fees; cheque bounce case court fees.
- court fees for cheque bounce case in maharashtra (r1): a fee table or calculator idea.
- cheque bounce case time limit (x4); cheque bounce case kitne din chalta hai; चेक बाउंस केस कितने दिन चलता है.
- चेक बाउंस केस में समझौता कैसे करें; चेक बाउंस केस में जमानत.
- best lawyer for cheque bounce cases in wadgaon sheri: an area-level hire query.

### 14. Discharge application (174)

- discharge application time limit (r1); discharge application limitation period.
- can discharge application be filed after / before framing of charges.
- discharge application fee / fees.
- discharge application before jmfc; discharge application draft / format; discharge application in bnss in hindi.

Why: almost no hire wording. Serve it with the existing guide plus a "chargesheet filed, what next" funnel.

### 15. Criminal appeals and suspension of sentence (200; many UK-style results removed)

- criminal appeal lawyers near me (r2).
- criminal appeal court fees; how much does it cost to appeal a criminal case.
- criminal appeal time limit / time limit in high court / criminal appeal kitne din me hota hai.
- criminal appeal against acquittal / against conviction; criminal appeal bombay high court.
- suspension of sentence (searched mostly with "supreme court judgment").

### 16. Generic hiring terms: "criminal lawyer Pune" (679)

| Keyword | Why |
|---|---|
| criminal lawyer fees in pune | r1, **x11**. GSC 83 imp, pos 24. The top lead term in the dataset. |
| criminal lawyer in pune / criminal lawyer pune / criminal advocate in pune | r1. GSC positions 30–36 and 13.6. |
| criminal lawyer in pimpri chinchwad | r1, **x9**. The strongest area term. |
| criminal lawyer in pcmc / criminal advocate in pcmc | r1. |
| criminal lawyers pune shivaji nagar | r1, x4. Your home area. |
| bombay high court advocate in pune | r1, x5. |
| bombay high court lawyer near me | x3. |
| bombay high court lawyer fees | **x8**. Cost. |
| advocate in pune district court | r1, x4. |
| advocate pune near me / lawyer pune near me | r1. |
| best / good / famous / top / biggest criminal lawyer in pune | r1–r5, x5–x18. Rule 36: answer with "how to choose" content and transparent fees, never with the claim. |
| advocate in pune for family matters / for property / for court marriage | Secondary practice signals. |
| पुणे वकील; वकील पुणे; pune vakil contact number | Hindi and Marathi navigational. |
| वकील की फीस कितनी होती है; हाई कोर्ट में वकील की फीस; vakil ki fees kitni hoti hai | Hindi and Hinglish fee curiosity. A Hindi version of /criminal-lawyer-fees-pune/ would catch it. |

Competitor names surface too ("adv … criminal lawyer pune"). Don't target them; they only confirm that people search for lawyers by name in Pune.

### 17. Family and divorce (secondary; 64)

- divorce lawyer in pune near me (r2).
- divorce lawyer in {pimpri chinchwad (x4), pimple saudagar, viman nagar, nigdi, aundh, bhosari, katraj, kharadi, magarpatta, pcmc, ravet, wakad, baner, kothrud, hadapsar, hinjewadi, wagholi}.
- family court pune lawyer; घटस्फोट वकील पुणे.

Divorce has **more area-level autocomplete demand than criminal** does. This matches GSC "family lawyer in pune" at pos 22.

---

## (b) Hinglish, Hindi and Marathi patterns worth targeting

1. **Cost: "X me kitna paisa lagta hai" / "kitna kharcha aata hai".**
   - Romanised: anticipatory bail / agrim jamanat / jamanat / bail karne / regular bail / court se bail + "me kitna paisa lagta hai"; "… ke liye kitne paise lagte hain"; "jamanat ki fees kitni hai"; "vakil ki fees kitni hoti hai".
   - Devanagari: "अग्रिम जमानत में कितना पैसा लगता है"; "जमानत के लिए कितना पैसा चाहिए"; "वकील की फीस कितनी होती है".
   - Your GSC already shows 70–97 impressions for four of these. They deserve **one Hindi page and one Hinglish-friendly section**, with ranges and the factors that drive cost (forum, offence, urgency, number of hearings), not a fixed price.
2. **Time: "kitne din me milti/milta/hota hai".**
   - "bail / jamanat / anticipatory bail / high court se bail / session court me bail / default bail / interim bail / fir quash / ndps me bail / pocso act me bail / sc st act me bail + kitne din me hota hai".
   - Hindi: "हाई कोर्ट से जमानत कितने दिन में होती है" (GSC 184); "<section number> की जमानत कितने दिन में होती है" for 302, 307, 376, 420, 354, 306 and 326.
   - Duration variants: "kitne din chalta hai" (498a / dahej / cheque bounce case); "kitne din tak valid hota hai" (anticipatory bail).
   - Marathi: "जामीन किती दिवसात" (sparse in autocomplete).
3. **Process: "kaise milti hai / kaise hoti hai / kaise hataye / kya kare".**
   - jamanat kaise milti hai; session court se bail kaise hoti hai; atrocity act me bail kaise hoti hai.
   - account freeze ho gaya kya karen / kaise sahi hoga / kaise hataye; police notice ka jawab kaise de.
   - Hindi: झूठे दहेज केस से कैसे बचे; चेक बाउंस केस में समझौता कैसे करें.
4. **Eligibility: "kya … mil sakti hai / ho sakta hai".** "kya high court se jamanat mil sakti hai"; "kya bank account freeze ho sakta hai"; "kya bail cancel ho sakta hai".
5. **Marathi demand is almost all "म्हणजे काय" (meaning) or "अर्ज नमुना" (application format).**
   - Examples: अटकपूर्व जामीन म्हणजे काय; अटकपूर्व जामीन अर्ज नमुना; जामीन कसा मिळतो / कसा मिळवावा; जामीन अर्ज फेटाळला; जामीन साठी लागणारी कागदपत्रे; मकोका म्हणजे काय; पोलीस तक्रार कशी करावी; चेक बाउन्स प्रक्रिया; सायबर फसवणूक तक्रार.
   - Marathi cost and time phrases ("किती खर्च", "किती दिवसात") returned almost nothing. Marathi pages should lead with **process + documents + format**, and carry cost and time as FAQs.
   - Marathi users also type English and Hinglish ("atakpurva jamin", "jamin vakil").
6. **People search by old IPC/CrPC numbers** (302, 307, 420, 438, 439, 482, 41A) far more than by BNS/BNSS numbers. Keep both in titles and H2s, e.g. "Section 438 CrPC / 482 BNSS".
7. **Voice-search misspellings** ("antiseptic bail", "anti safety bail", "anti separatory bail") show phone users who speak Hinglish. Write FAQ answers that read naturally aloud.

---

## (c) Pages the site should have (one per cluster), and gaps

The existing URLs come from the live sitemap (150 URLs, saved at `kw/data/site_urls.txt`).

| # | Cluster / page | Primary targets | Existing URL(s) | Status |
|---|---|---|---|---|
| 1 | Anticipatory bail (service) | anticipatory bail lawyer pune, anticipatory bail lawyers in pune, near me | /practice-areas/anticipatory-bail/, /how-to-get-anticipatory-bail-pune/, /anticipatory-bail-conditions-pune/, /section-438…482-bnss…/ | Served. Pos 31 means the service page needs strengthening and internal links, not a new page. |
| 2 | **Anticipatory bail: fees and time (Hindi + Hinglish)** | अग्रिम जमानत में कितना पैसा लगता है; anticipatory bail me kitna paisa lagta hai; anticipatory bail kitne din me milta hai; lawyer fees for anticipatory bail; cost in district court vs high court | /agrim-jamanat-anticipatory-bail-hindi-pune/ (general), /criminal-lawyer-fees-pune/ (English, general) | **Partly unserved.** Add a dedicated cost and time section, or a separate page. GSC shows about 250 impressions across these phrases. |
| 3 | **High Court bail: how many days, what it costs (Hindi)** | हाई कोर्ट से जमानत कितने दिन में होती है; how many days for bail in high court; high court se jamanat kitne din | /jamanat-kitne-din-me-milti-hai-kharcha-documents-pune/ (generic), /bail-rejected-sessions-court-pune-what-next/ | **Unserved as its own intent.** 184 imp for one query. Build a Bombay High Court bail-timeline page in Hindi, with an English twin. |
| 4 | Bail after arrest / regular bail (sessions court) | bail lawyer in pune; how much time it takes to get bail from sessions court; session court me bail kaise milti hai | /practice-areas/bail-application/, /bail-after-arrest-pune-guide/, /jamin-vakil-pune/ | Served. Add a sessions-court time FAQ and a "bail by section" table (302/307/376/420 …). |
| 5 | Interim bail | interim bail cost, time period, extension, medical grounds | /interim-bail-meaning-pune/ (blog only) | **Thin.** No service page. Add a section to /practice-areas/bail-application/ or a short service page. |
| 6 | Default bail + **60/90-day calculator** | default bail kitne din, how to calculate 90 days | /practice-areas/default-bail-undertrial-release/, two blogs | Served. **The calculator is missing.** |
| 7 | FIR quashing (service) | fir quashing bombay high court, quash petition lawyer | /practice-areas/fir-quashing/, /fir-quashing-bombay-high-court-pune/, /section-482…528…/, /latest-judgments…/ | Served. |
| 8 | **FIR quashing fees and timeline, Bombay High Court** | fir quashing fees (395 imp), quash petition fees / cost, 498a quashing fees, high court quashing fees, quash petition time period, fees in mumbai | /legal-fees-consultation/, /criminal-lawyer-fees-pune/ | **Unserved as its own page.** The strongest single opportunity. Check which URL earns the pos 6.7 now and make it the dedicated page. |
| 9 | **Quashing on compromise (498A / cheque / other)** | quashing fir on compromise, 498a quashing petition on compromise, compromise deed format, 498a settlement process | none | **Unserved.** |
| 10 | 498A defence | 498a lawyer near me, lawyer for 498a case, 498a case fees, how much time to quash 498a | /practice-areas/498a-domestic-violence-defence/, /498a-domestic-violence-defence-pune/, /498a-fir-filed-husband-pune/, Marathi version | Served in EN and MR. **A Hindi page (दहेज केस / 498A) is missing**, and so is a 498A cost and time FAQ. |
| 11 | Police notice 35(3) BNSS | section 35 3 bnss notice format, police notice ka jawab kaise de, 41a notice | /practice-areas/police-notice-section-35-bnss/, /police-notice-whatsapp-how-to-verify…/ | Served. Add "how to reply / format" and a Hindi FAQ. |
| 12 | MCOCA | mcoca court pune, how to get bail in mcoca, mcoca kab lagta hai | /practice-areas/mcoca-defence/, /mcoca-charges-bail-defence-maharashtra/, MR version | Served. Add a "MCOCA special court Pune" section. |
| 13 | MPID / EOW | eow case lawyer pune, economic offences wing pune address, mpid act bailable | /practice-areas/eow-financial-crimes-defence/, /eow-…-summons/, /mpid-act-case-pune-bail-defence/ | Served. Add an EOW Pune office/contact box. Navigational demand is large. |
| 14 | Cyber crime (service) | cyber crime lawyer in pune, cyber crime advocate pune, lawyer for cyber crime near me | /practice-areas/cyber-it-law/ | Served but ranks about 36. Retitle toward "Cyber crime lawyer in Pune". |
| 15 | **Bank account freeze / unfreeze (Hinglish + Hindi + English) + application format** | bank account freeze kaise hataye, account freeze ho gaya kya kare, kitne din me khulta hai, freeze application format, bank account freeze lawyer, by cyber crime how to unfreeze (SBI…) | /bank-account-frozen-cyber-police-maharashtra/ (English blog) | **Under-served.** No service page and no Hindi or Hinglish version. 60+ distress-type queries. |
| 16 | **Cyber police station Pune: address, jurisdiction, notices** | cyber police station pune address / contact / rural | /cybercrime-notice-fir-pune-action-plan/ (indirect) | **Unserved.** |
| 17 | NDPS | ndps lawyer in pune, ndps bail fees, bail in commercial quantity | /practice-areas/ndps-drug-offence-defence/, /ndps-act-bail-pune/, /drug-offences…/ | Served. Add a fees FAQ. |
| 18 | POCSO | pocso lawyer near me, pocso court in pune, pocso bail kitne din | /practice-areas/pocso-defence/, three blogs | Served. Add a Pune POCSO court section and a Hinglish bail-time FAQ. |
| 19 | Cheque bounce | cheque bounce lawyers in pune, lawyer fees, court fees in maharashtra, kitne din chalta hai, समझौता | /practice-areas/cheque-bounce-ni-act/, /cheque-bounce-ni-act-pune/, /recent-supreme-court-judgments…/ | Served in English. **Missing:** a Maharashtra court-fee table and a Hindi page. |
| 20 | Discharge | discharge application time limit, after framing of charges | /practice-areas/discharge-application/, two blogs | Served. |
| 21 | Criminal appeals / suspension of sentence | criminal appeal time limit (high court), appeal against conviction | /practice-areas/criminal-appeals-suspension-of-sentence/ | Served. Add a limitation-period FAQ. |
| 22 | Criminal lawyer fees, Pune | criminal lawyer fees in pune (GSC 83, pos 24), vakil ki fees kitni hoti hai, bombay high court lawyer fees | /criminal-lawyer-fees-pune/, /legal-fees-consultation/ | Served in English. **A Hindi version is missing.** |
| 23 | Bombay High Court lawyer from Pune | bombay high court advocate in pune, bombay high court lawyer near me / fees | /bombay-high-court-lawyer-pune/ | Served. |
| 24 | **Pune courts guide (hub)**: which court hears your case | pune district court timings / case status; shivajinagar court case status / timings; morwadi court pimpri timings; pimpri chinchwad court (district court, jurisdiction); khadki court; vadgaon maval court; moshi new court; hadapsar / wagholi court jurisdiction; family court pune | none | **Unserved.** A high local-court signal (260+ keywords). It suits a police-station-to-court map, case-status how-to, timings and holidays. It is a natural link and GBP asset. |
| 25 | **Pimple Gurav location page** (you have an office there) | advocate in pimple gurav, lawyer in pimple gurav | none | **Unserved.** The other location pages are in the next section. |
| 26 | SC/ST Atrocities Act | atrocity act bail, sc st act me bail kitne din | /practice-areas/sc-st-atrocities-act-defence/ | Served. Demand is small. |

---

## (d) Area and court terms seen in autocomplete (evidence of local demand)

Counts are unique kept keywords that mention the place.

**Areas where Google completes criminal-lawyer hiring phrases:**
- Pimpri-Chinchwad / PCMC: "criminal lawyer in pimpri chinchwad" r1 x9; "criminal lawyer in pcmc"; "criminal advocate in pcmc"; "best criminal lawyers in pimpri chinchwad"; "law firms in pimpri chinchwad". 28 PCMC-named and 23 "pcmc" keywords.
- Shivajinagar: "criminal lawyers pune shivaji nagar" r1 x4; "advocates in shivajinagar"; "advocate in shivaji nagar pune"; "advocate near shivaji nagar"; "shivaji nagar court advocate list".
- Baner: "criminal lawyer in baner".
- Wagholi: "criminal lawyer in wagholi". **No location page.**
- Wadgaon Sheri: "best lawyer for cheque bounce cases in wadgaon sheri".

**Areas with only generic "advocate / lawyer in X" completions** (mostly divorce and property; no criminal wording):
- wakad (11 hire terms; GSC "advocate wakad" pos 11), hadapsar (11), kothrud (9), wagholi (9), hinjewadi (8), kharadi (8), viman nagar (8), pimple saudagar (6; GSC pos 8.7), ravet (5), aundh (4), bhosari (4), katraj (4), chakan (3), nigdi (3), kondhwa (3), camp (3), magarpatta (2), moshi (2), **pimple gurav (2)**, undri, kalyani nagar, bavdhan, dhayari, bhor.
- These areas have **no location page:** wagholi, kharadi, katraj, chakan, bhosari, nigdi, ravet, moshi, kondhwa, pimple gurav.
- Wagholi, kharadi and pimple gurav (your second office) have the most evidence.
- The **Deccan and Koregaon Park pages exist but autocomplete showed no demand for them.** "lawyer in yerawada" also returned nothing; demand there is court and jail only.

**Courts and police units in autocomplete:**
- Pune District and Sessions Court, Shivajinagar: pune district court timings (x4), case status (by name / party / CNR / FIR no.), working hours, holidays 2026, Diwali vacation 2026, address; sessions court pune address / case status; shivajinagar court case status / timings / news; pune court timings on saturday; "is pune court open on saturday".
- Pimpri-Chinchwad courts: morwadi court pimpri timings (today), address, directions; pimpri court case status / cause list / "judges on leave"; pimpri court nehru nagar; pimpri chinchwad district court / session court / civil court / jurisdiction / pin code; additional district court pimpri case status; pimpri jmfc court case status.
- Other district courts: khadki court (cantonment; timings, case status by name, judge name); vadgaon maval court case status / address; moshi court (new court building, location); chakan court / district court; bhosari court; hadapsar court / jurisdiction; wagholi court jurisdiction; "wagholi police station court jurisdiction"; sessions court khed pune; pune camp court.
- Special and family courts: family court pune case status / address / lawyer / advocate list; family court shivaji nagar; pocso court in pune; mcoca court pune; juvenile court yerwada.
- Transit queries (courthouse visitors): "bhosari / nigdi / yerwada / hinjewadi to civil court metro"; "katraj / wagholi / viman nagar to district court distance".
- Police: cyber police station pune (address, contact, rural, city); economic offences wing pune (address, contact, officers); pcmc police station / pcmc police complaint online; पोलीस तक्रार प्राधिकरण पुणे (Police Complaints Authority).
- Bombay High Court: bombay high court anticipatory bail status; bail application format; quashing petition format bombay high court; bombay high court lawyer fees (x8); bombay high court advocate in pune.

**What to do with the court and jurisdiction evidence:**
- Searches like "which court / jurisdiction" and "case status" come from accused people and their families in the days after an FIR or chargesheet.
- A Pune courts hub (row 24) that maps police stations to courts can link to the bail, quashing and default-bail pages, and to Google Business Profile posts. Example: "Wakad / Hinjewadi police station → Morwadi (Pimpri) court; MCOCA / POCSO → Shivajinagar special courts".
-

---

### Files
- `research/keywords.csv`: 5,738 rows.
- `research/kw/fetch_ac.py`, `fetch_rev.py`: harvesters (cached, rate-limited).
- `research/kw/build.py`: classifier.
- `research/kw/analyze.py`: views.
- `research/kw/gsc_given.tsv`: the GSC rows you supplied.
- `research/kw/data/`: raw `ac_raw.jsonl`, `ac_cache/`, `excluded_other_geo.tsv`, `site_urls.txt`, sitemaps, Bing test pages.
