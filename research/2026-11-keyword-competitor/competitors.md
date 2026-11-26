# Pune criminal-lawyer competitor teardown (for advocateakashchikate.com)

Research date: 26 Nov 2026. Free tools only. Raw files: `research/comp/html/` (downloaded HTML, sitemaps, JSON per domain), scripts in `research/comp/scripts/`.

## 0. Where the data came from, and its limits (read first)

| Source | What happened | Used? |
|---|---|---|
| **Bing HTML** (`bing.com/search?...&cc=IN`) | HTTP 200, but every query returned **unrelated filler results** (WhatsApp threads on zhihu.com, Tata Motors share prices, Chennai Super Kings, YouTube login pages). Bing's RSS output did the same. This is Bing serving junk to traffic it thinks is automated from this IP. | **No.** Nothing from Bing is in this report. |
| **Google HTML** (`google.com/search?...&gl=in`) | HTTP 200, but the page was the "enable JavaScript" stub (`/httpservice/retry/enablejs`) with no results. I made no further attempts to get around it. | **No.** |
| DuckDuckGo / Yahoo / Brave / Mojeek / Startpage | Returned 202, 500, 429, 403 or a robot check. | No. |
| **WebSearch tool** | Worked for all 20 keywords. It runs from a **US index, not Google India**, and shows **no ads and no map pack**. It returns about 10 to 20 links per query, ranked by its own engine. | **Yes: this is the only SERP view.** |
| Direct fetches (curl) of competitor homepages, robots.txt and sitemaps | Worked. | Yes, for the teardown. |
| RDAP (domain registration dates) | Worked for .com only. | Yes. |
| Ahrefs free Domain Rating | Call not approved, so it was not run. | No. |

**What this means:** the SERP table below is a *proxy* for Google. It tells you which domains a mainstream index ranks for each query. It does **not** give real Google India positions, and it says **nothing about ads or the local 3-pack**. To capture those, run the same 20 queries by hand in a browser (incognito, location set to Shivajinagar) or use Google Ads Keyword Planner and Ads Transparency Center (both free with a Google account).

---

## 1. SERP table (WebSearch top 10, as served)

Notation: domain ×n = n of the top-10 slots. "Ads / map pack": none were visible in any query (the tool does not show them).

| # | Keyword | Top-10 domains in order (WebSearch) | Individual lawyer sites in top 10 |
|---|---|---|---|
| 1 | criminal lawyer in pune | justia.com (Vikram Sawant Inamdar profile), restthecase ×2, lawrato ×7 (city page + Sadashiv Peth, Gokhale Nagar, Deccan, Pune West, Kothrud, Akurdi) | none (only a Justia profile) |
| 2 | best criminal lawyer in pune | justia (Sawant), lawrato ×8 (incl. /shivaji-nagar), sites.google.com/view/advvikramsawant | Sawant's Google Site |
| 3 | criminal advocate in pune | restthecase, advocatekhoj, justia (Sawant), restthecase, advocatekhoj, lawrato, ueni.com (Alliance Law Associate), lawrato ×3 | none |
| 4 | anticipatory bail lawyer pune | lawrato ×10 (/anticipatory-bail-lawyers/pune + Deccan, Baner, Anand Nagar, Pune West, Gokhale Nagar, Pune East, Swargate, Aundh, Bavdhan) | none |
| 5 | bail lawyer pune | restthecase, lawrato, leadindia ×2, lawrato, restthecase (6 results only) | none |
| 6 | cyber crime lawyer in pune | lawrato ×10 (/cyber-crime-lawyers/pune + 9 locality pages) | none |
| 7 | fir quashing lawyer pune | lawrato ×3 (individual profiles), slideshare, leadindia ×2, lawrato (Ravi Jadhav), leadindia ×2, legalsuvidha.com | legalsuvidha (service page) |
| 8 | 498a lawyer pune | lawrato (Dipti Deshpande), **adityarajshirkeofficial.github.io/Adv.ShaileshJoshinew**, lawrato, kaanoon, restthecase (dowry), vidhikarya, delhihighcourt.nic.in ×2, kaanoon, blogspot (Upadhye) | Shailesh Joshi (free GitHub Pages site) |
| 9 | anticipatory bail advocate pune | lawrato ×10 | none |
| 10 | bail advocate in pune | restthecase, lawrato ×7, restthecase, lawrato | none |
| 11 | quashing of fir lawyer bombay high court | business-standard, indiankanoon, scconline ×2, indiankanoon, barandbench, dnaindia, indiankanoon, scconline, indiankanoon (read as news, not hiring intent) | none |
| 12 | 498a lawyer in pune | lawrato, Shailesh Joshi github.io, lawrato ×8 (women-lawyers locality pages) | Shailesh Joshi |
| 13 | mcoca lawyer pune | wikipedia, restthecase ×2 (Navid Mulani), freepressjournal ×2, threebestrated.in, sites.google (Sawant), legalserviceindia, threebestrated (Hindi), punekarnews | Sawant's Google Site |
| 14 | cyber fraud lawyer pune | leadindia ×10 (city + Yeravada, Kothrud, Karve Nagar, Parvati Hill, Danori, Handewadi, Khadki) | none |
| 15 | criminal lawyer shivajinagar pune | lawrato ×2, **sites.google.com/view/bestcriminallawyerinpune** (Sawant), lawrato ×7 | Sawant's Google Site |
| 16 | criminal lawyer pimpri chinchwad | lawrato, leadindia ×2, ezylegal, lawrato ×2, threebestrated, lawrato, ueni, lawrato | none |
| 17 | criminal lawyer near pune district court | lawrato ×10 | none |
| 18 | best advocate for bail in pune | lawrato ×10 | none |
| 19 | jamanat ke liye vakil pune | restthecase, lawrato, leadindia ×2, lawrato, restthecase | none |
| 20 | anticipatory bail lawyer mumbai | lawrato ×10 (Mumbai HC, South/Central/West Mumbai, Colaba, Worli...) | none |

### 1b. Same intent with directories filtered out (the individual-site contest)

To see which **individual Pune lawyer sites** compete, I re-ran key queries with LawRato, RestTheCase, LeadIndia, Justia, AdvocateKhoj, Kaanoon, ThreeBestRated, Vidhikarya, ezyLegal and Quora excluded:

| Query | Order (WebSearch) |
|---|---|
| criminal lawyer in pune advocate office bail | **advocateakashchikate.com (#1)**, advshirishpatil.in, palshikarlegal.in/criminal-bail-lawyer-in-pune, indrajitdongre.com/services/best-criminal-lawyer-pune, advocatepmmodi.in/top-criminal-lawyer-in-pune, advocateupadhye.in/criminal-lawyer-pune, dhendeassociates.com/criminal-law.html, advocatepmmodi.in (tag), **advocateakashchikate.com/practice-areas/criminal-defence**, advhajikaramat.in |
| anticipatory bail lawyer pune | palshikarlegal.in/anticipatory-bail-lawyer-in-pune, **advocateakashchikate.com (#2)**, advocateaashutoshsrivastava.com/anticipatory-bail-lawyer, dhendeassociates.com, advocatepmmodi.in ×3, indrajitdongre.com, gaglawyers.com/bail-lawyer-in-pune, pdlegal.in |
| cyber crime lawyer in pune | advocatekhan.in, pathlegal.in, netlawgic.com, vakeelsaab.com, tridentlegal.in ×2, panchanandshaw.com, advsamyakdhirajnahata.in, bafnalaw.com, vakilo.legaladvocateonline.com (**client not in top 10**) |
| 498a lawyer pune | indrajitdongre.com ×2, thedivorcelawfirm.in, lawtendo ×2, advmayurg.com, lawyerpune.com, pathlegal ×2, lawtendo (**client not in top 10**) |
| fir quashing lawyer pune bombay high court | **advocateakashchikate.com ×2 (#1, #2)** and #5 (Kothrud page), spglegalconsultancy.in ×2, bestdivorcelawyerinmumbai.com, advocatepmmodi.in ×2, punekarnews |

**Takeaway:** once directories are filtered out, the client **already beats** the individual competitors on relevance for criminal, anticipatory bail and quashing queries. So the Google gap (positions 25 to 40) is probably **not on-page content**. It is (a) directories holding most of page 1, and (b) off-page and local trust signals: review count, citations and links, where the competitors below are ahead. Cyber and 498A are the two topics where the client is weak even among individual sites.

---

## 2. Recurring-domain tally (20 main queries, top-10 slots)

| Domain | Type | Slots (of ~190) | Queries present (of 20) |
|---|---|---|---|
| **lawrato.com** | Directory / marketplace | ~121 | 17 |
| **leadindia.law** | Directory + call-centre lead broker | ~20 | 5 (owns "cyber fraud lawyer pune") |
| **restthecase.com** | Directory / marketplace (en/hi/mr) | ~13 | 7 |
| justia.com (Vikram Sawant profile) | Directory profile of an individual | 3 | 3 |
| sites.google.com (Vikram Sawant, 2+ sites) | Individual on free Google Sites | 3 | 3 |
| threebestrated.in | "Top 3" review directory | 3 | 2 |
| advocatekhoj.com | Directory | 2 | 1 |
| kaanoon.com | Q&A directory | 2 | 1 |
| ueni.com | Free business-site builder (Alliance Law Associate) | 2 | 2 |
| github.io (Adv. Shailesh Joshi) | Individual on free GitHub Pages | 2 | 2 |
| ezylegal.in, vidhikarya.com, legalsuvidha.com, slideshare, legalserviceindia.com | Directory / marketplace / misc | 1 each | 1 |
| indiankanoon, scconline, barandbench, freepressjournal, business-standard, dnaindia, punekarnews, wikipedia, delhihighcourt.nic.in | Info / news / judgments | 1 to 4 | 2 (quashing BHC, MCOCA) |
| justdial, sulekha, vakilsearch, legalkart, quora | Directory | **0** in this index | 0 (Justdial does have Pune criminal-lawyer category pages, found with a domain-restricted search) |

**Split:** about 85% directories and marketplaces, about 8% info and news, about 7% individual lawyers (and those were all Vikram Sawant's free profiles or Shailesh Joshi's GitHub page). No individual's *own domain* reached the unfiltered top 10 on any of the 20 queries.

---

## 3. Competitor teardown

Sitemap counts come from each site's XML sitemap (classified by URL slug). Schema is the `@type` values found on the homepage and service page. Domain dates are from RDAP (.com only).

| Competitor | Base | Sitemap (service / location / blog / total) | Key service page title / H1 | Schema | CTAs | Trust claims | Reviews / reputation | Language | Off-site footprint |
|---|---|---|---|---|---|---|---|---|---|
| **Indrajit Dongre & Associates** indrajitdongre.com (reg. Dec 2024) | Kasba Peth | 18 / 15 (`/locations/lawyers-in-<area>-pune`) / 45 insights / 83 | "Criminal Lawyer in Pune \| Bail & Defence" / H1 "Criminal Lawyer in Pune" | LegalService, Person, FAQPage, OpeningHours, EducationalOccupationalCredential | Call, WhatsApp, "Book Consultation", "Replies within 2 hours" | 28+ yrs (since 1998), **15-advocate team**, 1000+ matters, anonymised "On the Record" outcomes (e.g. "Protection secured at the first listing. Bail granted") | Header: **"5.0 on Google · 351+ reviews"** | "Consultations in Marathi · Hindi · English" | ThreeBestRated #2 (criminal, Pune), AdvocateKhoj verified, LawyersClubIndia, LinkedIn, Facebook |
| **Dhende Associates** dhendeassociates.com (reg. Feb 2026) | Gokhalenagar | 4 / 0 / 0 / 14 | "Criminal Lawyer Pune \| Bail & FIR Defence" / "Criminal Defence & Bail — Protecting Your Liberty" (2,872 words) | LegalService, FAQPage, Offer/OfferCatalog, GeoCoordinates | Call ×2, WhatsApp **enquiry form** (pre-fills WhatsApp), "same-day anticipatory bail filings" | **40+ yrs, est. 1984, Notary since 1998** | None shown | English plus Marathi kids' page | **Free tools**: Maharashtra stamp-duty estimator, MACT claim estimator, Hindu succession share calculator, NI Act 138 limitation calculator, Constitution-for-kids (Eng/Marathi). LawRato profile (Ajinkya Dhende) |
| **Advocate Upadhye & Associates** advocateupadhye.in | Sadashiv Peth | 70 / 7 (Mumbai) / 78 / 250 | "Criminal Lawyer in Pune \| Criminal Defence \| Advocate Upadhye" / "Criminal Lawyers in Pune for Defence & Bail Cases" | Breadcrumb/WebPage only (**no LegalService**) | Call ×3, 2 forms | "30 years experience", "500+ clients", testimonials block | Not on site | English | **Justdial: top listing for "Lawyers for Criminal in Sadashiv Peth"**, Blogspot blog, Q&A-style URLs ("can-i-apply-for-anticipatory-bail-before-being-arrested") |
| **Advocate Khan & Associates** (Adv. Sadiya Khan) advocatekhan.in | Bhawani Peth | 19 / 0 / 2 / 30 | "Bail & Anticipatory Bail Lawyer in Pune \| Advocate Khan" / "Bail & Anticipatory Bail" (538 words) | LegalService, Person, Place | Phone **in meta description**, 2 forms | none | none | English | Facebook, X. #1 for "cyber crime lawyer in pune" among individual sites with only about 500-word pages |
| **Trident Legal** (Adv. Nikhil Rathod) tridentlegal.in | Katraj | 102 / 0 / **570** / 691 | "Cybercrime Lawyer in Pune \| Trident Legal" (3,844 words) | LegalService, FAQ (Question/Answer), **VideoObject** | Call, WhatsApp, form, "free consultation" | "devotes his knowledge exclusively to cybercrime" (niche positioning) | none | English | Justia profile, FB, IG, LinkedIn company page |
| **Adv. Aashuutosh Srivastava** advocateaashutoshsrivastava.com (reg. **2015**) | Camp | 13 / 0 / 45 / 68 | "Bail & Anticipatory Bail Lawyer in Pune, Mumbai & India" / "Anticipatory Bail". Homepage title is keyword-stuffed ("Top and Best lawyer in Pune-Top and Best lawyer in Mumbai- Top 10...") | LegalService, LocalBusiness, GeoCoordinates | Call ×6, 3 forms | **Case-win posts**: `/pune-court-grants-bail-dskulkarni-mofa-case-case-argued-by-advocate-aashutosh-srivastava/` | Testimonials block | English | **YouTube channel + 4 embedded videos**, FB, IG, LinkedIn, X. Oldest domain in the set |
| **Adv. Paresh M. Modi** advocatepmmodi.in (Ahmedabad) | Ahmedabad, targets Pune/Mumbai | **375** / 8 / 1 / 585 | "Anticipatory Bail Lawyer in Pune \| Regular Bail Lawyer in Pune \| 9925002031 \| ..." (phone number in title, H1 and URLs) | LegalService, **AggregateRating 4.7 / 135** (self-served), FAQPage | Call ×3–5 | "138 cases", fee figure ₹70,000 | "142 Google reviews" text | English | YouTube @pareshmodiadvocate, IG, LinkedIn ×2, FB. Out-of-city programmatic pages |
| **Adv. Vikram Sawant Inamdar** (no own domain) | Shivajinagar court / Parvati | n/a. At least 4 Google Sites: `/view/advvikramsawant`, `/view/bestcriminallawyerinpune`, `/view/advocate-vikram-sawant-inamdar`, `/view/vglegalassociates` | "Adv Vikram Sawant Inamdar - Top Criminal Lawyer in Pune" | n/a | Phone on profiles | Practising about 2020 (6 yrs), "TOP CRIMINAL LAWYER IN PUNE" | LawRato 4.0 (2+) | Profiles in en/hi/mr via RestTheCase | **Citation saturation**: Justia, LawRato, RestTheCase (en/hi/mr), law4u, jurigram, multiple Google Sites. Appears in WebSearch for criminal lawyer pune, best criminal lawyer, criminal advocate, MCOCA, Shivajinagar and 498A. Same bar vintage as the client |
| Shirish Patil & Associates advshirishpatil.in | Shivajinagar (Malave Bhavan) | site returned 502/503 during the crawl | — | — | — | 15+ yrs (since 2010) | ThreeBestRated **#1** criminal lawyer Pune (4.9); LeadIndia profile "3.4 from 214+ ratings" (match not confirmed) | — | ThreeBestRated, LeadIndia, Facebook |
| Ketan Palshikar palshikarlegal.in | Sadashiv Peth | 80 / 13 / 29 / 186 | Criminal bail pages **now 404**: the site has pivoted to property law (index still lists the old criminal URLs) | Sitewide **AggregateRating 5 / 91** (self-served), attorney | Form | — | — | English | FB, YouTube |
| GAG Lawyers gaglawyers.com (Delhi) | national | **42,426 URLs** (service × city programmatic, e.g. `/bail-lawyer-in-pune`, `/bail-lawyer-in-shivajinagar`) | — | LegalService | none on home | — | — | — | Pure programmatic scale |
| **Client: advocateakashchikate.com** (reg. Jun 2024) | Shivajinagar | 24 practice areas / 15 location / 98 posts / 13 pages; **case_result sitemap = 0** | ABA page: "Anticipatory Bail in Pune: Meaning, Process, Section 482" (no "lawyer"); quashing: "Quashing of FIR in Bombay High Court \| Section 528 BNSS" (no "lawyer"); bail: "Bail Application Lawyer in Pune..." | LegalService, Person, FAQ, Breadcrumb, Credential. No AggregateRating | WhatsApp, call | "6+ years" on location page | **No Google rating or review count shown anywhere on the site**; no testimonials | Marathi pages (jamin-vakil-pune, atakpurva-jaamin-vkil-pune) plus Devanagari blocks | sameAs: GBP, Justdial, LinkedIn, Facebook, X. **No YouTube or Instagram. Not found on LawRato, RestTheCase, ThreeBestRated or Justia** in searches |

**Heavy link building or paid placement:** none of the individual sites shows obvious paid placement. The aggressive patterns are:
- Vikram Sawant's multi-profile and multi-Google-Site citation network
- Paresh Modi's 375-page programmatic set with the phone number in every slug
- GAG's 42k-URL city × service matrix
- Self-served AggregateRating schema (Modi 4.7/135, Palshikar 5/91). Google ignores self-serving review markup for LocalBusiness/Organization, and it can draw a manual action.

LeadIndia and Justdial are the clearest **paid** lead channels: LeadIndia routes enquiries through its own call centre (+91-8800444555, "Request Callback", "1000-2000" consult tile), and Justdial's top positions come from paid packages.

---

## 4. Tactics competitors use that advocateakashchikate.com lacks

1. **Visible review count in the hero and header.** Indrajit Dongre shows "5.0 on Google · 351+ reviews" on every page (https://www.indrajitdongre.com/). The client has 5.0 from 20 reviews but shows it nowhere. Add a plain-text badge linking to the GBP. Do *not* add self-served AggregateRating schema.
2. **Review volume and velocity on the GBP.** 351 vs 20 is the single biggest visible local-pack gap. A systematic ask (WhatsApp review link after every bail order or disposal) is the main lever for map-pack visibility on non-brand searches.
3. **Anonymised case outcomes on the homepage and service pages.** Indrajit's "On the Record: Recent outcomes" (Family Court, District Court, Sec 138 recoveries). The client's `case_result` post type exists but has **0 published entries** (https://advocateakashchikate.com/case_result-sitemap.xml).
4. **Case-win news posts naming the advocate and the court.** https://www.advocateaashutoshsrivastava.com/pune-court-grants-bail-dskulkarni-mofa-case-case-argued-by-advocate-aashutosh-srivastava/ (anonymise the client and stay within BCI Rule 36).
5. **Directory citation saturation.** Vikram Sawant (same bar vintage) is on Justia, LawRato, RestTheCase (en/hi/mr), law4u, jurigram and several Google Sites, and shows up across 6 of the 20 queries: https://lawyers.justia.com/lawyer/vikram-sawant-inamdar-1675279, https://lawrato.com/advocate-vikram-sawant-inamdar, https://restthecase.com/lawyers/details/vikram-sawant-inamdar. The client was not found on any of these.
6. **ThreeBestRated "Top 3" listing.** The Pune criminal list (Shirish Patil, Indrajit Dongre, Bhooshan Kokare) ranks for MCOCA and PCMC queries and has a Hindi mirror: https://threebestrated.in/criminal-case-lawyers-in-pune-mh. It has a free "List your business" route and its stated inspection weighs reviews heavily.
7. **Hiring-intent title tags on money pages.** Competitors use "Anticipatory Bail Lawyer in Pune" (https://www.advocateaashutoshsrivastava.com/anticipatory-bail-lawyer/, palshikarlegal, pmmodi). The client's ABA title reads as an explainer ("Meaning, Process, Section 482") and the quashing title lacks "lawyer". That suits the informational queries the site already wins, but the ABA page is the URL that should rank for "anticipatory bail lawyer pune" (~31).
8. **Firm-scale trust strip.** Indrajit: 28+ yrs, 15 advocates, 1000+ matters. Dhende: 40+ yrs, est. 1984, Notary since 1998. Upadhye: 30 yrs, 500+ clients. The client has no counted metrics. Use honest, verifiable counts (e.g. bail applications filed, Bombay HC appearances) without "best" claims.
9. **Response-time and language promise.** "Replies within 2 hours" and "Consultations in Marathi · Hindi · English" (https://www.indrajitdongre.com/). The client has Marathi pages but no such badge.
10. **Free linkable tools.** Dhende's stamp-duty, MACT, succession-share and NI 138 limitation calculators (https://www.dhendeassociates.com/nia_138_limitation.html, /maharashtra-stampduty-estimator.html). These earn links and citations on a site with only 14 URLs. Criminal-side ideas: an IPC→BNS / CrPC→BNSS section converter, a default-bail (Sec 187 BNSS) day counter, a Sec 138 limitation calculator.
11. **Court-guide local content.** https://www.indrajitdongre.com/insights/pune-district-court-shivajinagar-guide, /pimpri-chinchwad-court-cases-guide, plus decision-stage pages (/choosing-a-lawyer-in-pune, /insights/lawyer-fees-in-pune-how-legal-pricing-works). The client sits next to the Shivajinagar court and has no court guide.
12. **Justdial presence that actually ranks.** Upadhye is the top listing for "Lawyers for Criminal in Sadashiv Peth" (https://www.justdial.com/pune/Lawyers-For-Criminal-in-Sadashiv-Peth/nct-10296153). Mayur Gajbhiye and Sunil Gumley are featured for Shivaji Nagar (https://www.justdial.com/Pune/Criminal-Lawyers-in-Shivaji-Nagar). The client's schema already references a Justdial listing (RSL-ITN1794201538): complete it (photos, categories, reviews).
13. **Video.** Aashutosh embeds his YouTube channel (UCFmjIF-ZTthQHXIlUpboW6Q). Paresh Modi runs @pareshmodiadvocate. Trident uses VideoObject schema on its cyber page. The client has no YouTube or Instagram in sameAs.
14. **Niche cyber / 498A positioning.** These are the two topics where the client is outside the individual-site top 10. Trident ("exclusively cybercrime", 570 posts) and Advocate Khan own cyber. Indrajit (498A quashing insights plus a 498A anticipatory-bail outcome) owns 498A. The client needs a dedicated "Cyber Crime Lawyer in Pune" page with a bank-freeze/1930 funnel, and a "498A Lawyer in Pune" page title with H1 rather than "498A & Domestic Violence Defence".
15. **WhatsApp enquiry form.** Dhende's form pre-fills a WhatsApp message with the enquiry details, which lowers friction compared with a bare wa.me link.

*Observed but not recommended:* phone numbers in titles and URLs (Modi), 42k-page programmatic matrices (GAG), self-served AggregateRating (Modi, Palshikar), keyword-stuffed titles (Aashutosh), and parasite Google Sites or GitHub pages named "bestcriminallawyerinpune" (Sawant, Shailesh Joshi). These carry Google spam-policy and/or BCI Rule 36 risk.

---

## 5. Directories: how listing works and whether they send leads

| Directory | Ranks for | Listing cost | Lead mechanism | Recommendation |
|---|---|---|---|---|
| **LawRato** | 17 of 20 queries; city, locality and practice-area pages (e.g. /anticipatory-bail-lawyers/pune/shivaji-nagar) | **Free.** Signup page: "There is no cost to join and no monthly subscription"; no marketing fee. Multi-level verification (online, social, offline, references). Lawyer must be enrolled. | Client fills "contact lawyer" form on the profile; LawRato shares contact details via its **Partner App**. Lawyers also get "exclusive access to queries posted by the public". Listings show rating and count; many have only 2+ to 10+ ratings, so 20+ reviews would stand out. Site promises "upto 30% off first consult fee". | **Do first.** Free, and its Shivajinagar criminal and ABA locality pages occupy page 1. Pick criminal, anticipatory bail, cyber crime, 498A/DV, NDPS, High Court as practice areas, set locality = Shivajinagar / District Court, and ask existing clients to rate there too. https://lawrato.com/lawyer-signup |
| **RestTheCase** | 7 of 20 (criminal, bail, MCOCA, Hindi bail query); profiles mirrored in /hi/ and /mr/ | Not stated publicly. Lawyer signup at lawyer.restthecase.com/register; separate "Become a VCLO" programme. Directory says "no fee for obtaining contact details", "you pay the lawyer directly". | "Verified client enquiries", appointment booking (/lawyers/appointment/...), visibility via its blogs and podcasts | **Do second.** Free signup appears available. The automatic Hindi and Marathi profile pages give the client trilingual citations. Confirm any paid tier before paying. |
| **LeadIndia** | 5 of 20; owns "cyber fraud lawyer pune" (10/10) | No public lawyer signup (only "Lawyer Sign In"); claims "8,500+ Verified Associates" | **Broker model**: central phone +91-8800444555, "Request for Callback", support team matches the lawyer; "1000-2000" consult tile. The lead belongs to LeadIndia, not the lawyer. | Optional. Leads are mediated and the network is national. Only consider if they offer a Pune criminal associate slot with clear per-lead terms. |
| **ThreeBestRated** (honourable mention) | MCOCA, PCMC | "List your business for Free!" link; claims no compensation for ratings | Profile shows phone, hours and website; drives calls directly | Apply. The Pune criminal top 3 is winnable on review quality. |
| **Justdial** | 0 in this index, but category pages exist for Shivaji Nagar / Sadashiv Peth / Camp | Basic listing free. Top positions are paid packages (reported from about ₹20k/yr, "24 verified leads/month" claims, mixed reviews) | Calls and enquiries pushed to the listed number; Justdial ranks its own "top 5" | Complete the existing free listing. Test a paid package only with call tracking. |

---

## 6. Suggested next checks (free) to close the data gaps

1. Run the 20 queries by hand in Google (incognito, location Shivajinagar) and screenshot the **local 3-pack and any "Sponsored" ads**. This could not be captured here.
2. Google Ads Transparency Center: search "Indrajit Dongre", "LawRato", "Lead India", "RestTheCase" to see who buys criminal-lawyer ads in Pune.
3. GBP comparison with a free geo-grid tool or manual Maps searches for "criminal lawyer" at 5 points (Shivajinagar, Kothrud, Hadapsar, Wakad, PCMC), recording review counts for the top 3.
4. Free backlink checks (Ahrefs Backlink Checker free tier, or Bing Webmaster Tools "Backlinks" with competitor comparison) for indrajitdongre.com, advocateaashutoshsrivastava.com and tridentlegal.in vs the client.
