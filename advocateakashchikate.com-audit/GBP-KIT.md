# Google Business Profile kit: Advocate Akash R. Chikate & Associates

**Date:** 6 November 2026. Everything here can be done on a phone in the **Google Maps** app: tap your profile picture → **Your business profiles** → choose the profile → **Edit profile**. Do the Shivajinagar profile first.

**Limits of this kit:** Google Maps would not render for an automated browser, so I could not read either profile's current categories, rating, review count, photos or Insights. Check those yourself as you go. Nothing here is posted automatically: the Business Profile API needs a Google-approved app and your sign-in.

---

## 0. Fix these first (they cost rankings now)

| # | Problem found | Where | Fix |
|---|---|---|---|
| 1 | The map on the contact page is a **placeholder**: it points at "Shivajinagar, Pune" at the wrong spot (18.5195, 73.8530) instead of your office (18.5308, 73.8475), and its place ID is fake. | `/contact/` | Replace it with the embed from your own profile: Maps app → your profile → **Share** → **Embed a map** (open Maps in a phone browser in desktop mode if the app doesn't show it). Send me the code and I'll add it to the plugin. |
| 2 | The "Get directions" link on the contact page searches for "Ekbote Complex" instead of opening your profile. | `/contact/` | Already in the audit plan: change it to `https://www.google.com/maps?cid=2771672946981232004`. |
| 3 | **Pimple Gurav profile at a residential flat (B-701, Ravikaran Heights).** Google allows a home office only if clients really meet you there during the listed hours. If they don't, Google can suspend the profile, and a suspension can spill over to the Shivajinagar one. | Pimple Gurav profile | If clients visit by appointment, keep it, set **appointment-only** hours and keep the address visible. If they don't, edit it to a **service-area business**: hide the address and list Pimpri-Chinchwad, Wakad, Pimple Saudagar, Hinjewadi and Chakan as service areas. |
| 4 | Experience differs across directories: LawRato 6 years, PathLegal 3, your site 5+. | LawRato, PathLegal | Use one figure everywhere (the audit suggests "enrolled 2020"). Edit both directory profiles. |
| 5 | The second site **advakashchikate.com** is still live. | Domain | Redirect it (301) to advocateakashchikate.com, or take it down. Two sites with your name split trust signals. |
| 6 | The old theme copy in the repo hard-codes a **5.0 / 5 reviews** rating and two placeholder Maps links. The live site doesn't output them now. | `wp-theme/akashchikate/functions.php` | Don't upload that copy as it is. A self-written rating on your own business is against Google's rules, and the numbers don't match any real reviews. |

---

## 1. Categories (the biggest single ranking factor)

Set these on **both** profiles. Edit profile → **Business category**.

- **Primary:** `Criminal justice attorney`
- **Additional (up to 4):** `Lawyer`, `Legal services`, `Family law attorney`, `Divorce lawyer`

Only keep a category for work you take. If you don't take divorce or custody work, drop the last two. Don't use `Law firm` as the primary: it is broader and ranks worse for "criminal lawyer" searches.

---

## 2. Business description (paste as is; 738 of 750 characters)

Use the same text on both profiles; for Pimple Gurav, change "Shivajinagar" in the second sentence to "Pimple Gurav".

```
Advocate Akash R. Chikate & Associates is a criminal defence practice in Pune, enrolled with the Bar Council of Maharashtra & Goa. The Shivajinagar office is a short walk from the Pune District and Sessions Court.

Work includes regular and anticipatory bail, police custody and remand, FIR quashing and criminal appeals before the Bombay High Court, sessions trials, discharge applications, NDPS, MCOCA, POCSO, EOW and cyber crime matters, cheque bounce (NI Act) cases, and Section 498A and domestic violence matters, along with family court work.

Appearances are made at Pune and Pimpri-Chinchwad courts and the Bombay High Court. Consultations are in Marathi, Hindi and English, by appointment at the office or by phone or video call.
```

(No "best", "top", "expert" or results claims: Bar Council Rule 36, and Google also rejects promotional descriptions.)

---

## 3. Services (Edit profile → Services → Add a custom service)

Add each with this description (each is under 300 characters):

| Service | Description |
|---|---|
| Anticipatory bail | Applications under Section 482 BNSS (old 438 CrPC) before Pune Sessions Court and the Bombay High Court, including interim protection and transit anticipatory bail. |
| Regular bail | Bail after arrest under Sections 480 and 483 BNSS (old 437 and 439 CrPC), including default bail when the chargesheet is late. |
| Police custody and remand | Appearance at remand hearings, objections to police custody, and applications on grounds of arrest under Section 47 BNSS. |
| FIR quashing | Petitions before the Bombay High Court under Section 528 BNSS (old 482 CrPC) and Article 226, including quashing on settlement. |
| Criminal trials | Sessions and magistrate court trials in Pune: discharge, framing of charge, cross-examination and final arguments. |
| Criminal appeals | Appeals and suspension of sentence before the Sessions Court and the Bombay High Court. |
| NDPS, MCOCA and POCSO cases | Bail, trial and appeal work in special Act cases before Pune special courts and the Bombay High Court. |
| Cyber crime and bank account freezes | Defence in IT Act and online fraud cases, replies to cyber police notices, and applications to release frozen accounts. |
| Cheque bounce (NI Act) | Complaints and defence under Section 138 Negotiable Instruments Act in Pune courts. |
| 498A and domestic violence | Defence for the husband and family in Section 498A (now 85 BNS) and Domestic Violence Act matters, including anticipatory bail. |
| Tadipar and MPDA | Replies to externment notices under the Maharashtra Police Act, appeals, and challenges to MPDA detention orders in the High Court. |

---

## 4. Contact details and links

| Field | Shivajinagar profile | Pimple Gurav profile |
|---|---|---|
| Phone | +91 84119 82241 | +91 84119 82241 |
| Website | `https://advocateakashchikate.com/?utm_source=gbp&utm_medium=organic&utm_campaign=shivajinagar` | `https://advocateakashchikate.com/criminal-lawyer/criminal-lawyer-pimpri-chinchwad/?utm_source=gbp&utm_medium=organic&utm_campaign=pimple-gurav` |
| Appointment link | `https://advocateakashchikate.com/contact/?utm_source=gbp&utm_medium=appointment` | same |
| WhatsApp (Edit profile → Contact → Chat) | +91 86984 00302 | +91 86984 00302 |
| Hours | Mon–Sat 10:00–19:00 (matches the site) | Appointment-only (see fix 3) |
| Languages / attributes | Turn on "Online appointments" and "Onsite services" if offered | same |

The `utm_` tags let Google Analytics separate profile visits from other traffic, so we can see which profile sends enquiries.

---

## 5. Photos (aim for 10+ on each profile, then 2–3 a month)

Take these on your phone, in daylight, without filters:

1. Building front with the Ekbote Complex signboard visible (this helps people find you).
2. Office entrance or nameplate.
3. Reception or waiting area.
4. Your cabin or desk.
5. A professional photo of you in your advocate's robes (set it as the **profile photo**).
6. You at the office desk with books (no client files or faces visible).
7. Team photo, if you have associates or juniors.
8. Logo (square) and a cover photo (landscape).

Don't photograph case files, court records or clients, and don't geotag-edit photos (Google ignores it).

---

## 6. Weekly posts (Add update; copy one per week)

Posts don't move rankings directly, but they show the profile is active and give searchers a reason to click. Add the **Learn more** button with the link shown.

**Week 1: Anticipatory bail** (link: `/how-to-get-anticipatory-bail-pune/`)
```
Worried about arrest in a case that has just been registered? Anticipatory bail under Section 482 BNSS can be sought before the Sessions Court or the Bombay High Court before an arrest happens. Our guide explains when to apply, the documents needed and what conditions courts usually impose.
```

**Week 2: Bail after arrest** (link: `/bail-after-arrest-pune-guide/`)
```
If a family member has been arrested in Pune, the first 24 hours matter: the remand hearing, police custody, and when a bail application can be filed. This guide walks through each step and the documents to collect.
```

**Week 3: Frozen bank account** (link: `/bank-account-frozen-cyber-police-maharashtra/`)
```
Bank account frozen on a cyber police request? This is now common in Maharashtra, often because of a single disputed transaction. Read what the freeze means, who to write to, and how release applications work.
```

**Week 4: FIR quashing** (link: `/fir-quashing-bombay-high-court-pune/`)
```
An FIR can be quashed by the Bombay High Court where it discloses no offence, is plainly an abuse of process, or the dispute has been settled. Our guide explains the grounds, the process and realistic timelines.
```

**Week 5: Digital arrest scam** (link: `/police-notice-whatsapp-how-to-verify-digital-arrest-scam/`)
```
A "police officer" on a video call says you are under digital arrest? There is no such thing in Indian law. Here is how to verify a real police notice and what to do if you have already paid.
```

**Week 6: Tadipar notice** (link: `/tadipar-externment-notice-pune/`, once the draft is published)
```
Received a tadipar (externment) notice from Pune or Pimpri-Chinchwad police? The hearing before the order is your best chance to stop it. Read what to file, the documents to collect and how the 30-day appeal works.
```

After week 6, ask me for the next set; each new site page gets a matching post.

---

## 7. Reviews

Reviews matter (roughly a fifth of map ranking weight), and a steady trickle matters more than a burst.

- **Getting your review link:** Maps app → your profile → **Ask for reviews** → copy the link.
- **Bar Council caution:** asking for testimonials is a grey area under Rule 36. Keep any request neutral, don't offer anything in return, don't ask only happy clients (Google forbids that too), and never write or post reviews yourself or through others.
- **Neutral request** (only after a matter is concluded, sent individually, never as a bulk message):

```
Thank you for your trust during the matter. If you wish, you can share your experience of our office on Google. It is entirely optional. [review link]
```

- **Replying to reviews:** reply to every review within a few days. Never confirm that the reviewer was a client, and never mention any case details (professional confidentiality).

Positive review:
```
Thank you for taking the time to write this. We appreciate it.
```

Negative or unclear review:
```
Thank you for your feedback. We take every concern seriously, but we cannot discuss any matter in a public forum. Please call the office on +91 84119 82241 so we can understand this better.
```

Fake or abusive review: tap the review → **Report review**. Don't argue in the reply.

---

## 8. Copy the profile to Bing and Apple (10 minutes, phone)

ChatGPT and Copilot read Bing's business data, not Google's, and iPhone users see Apple Maps.

1. **Bing Places** (bingplaces.com): sign in with Google and choose **Import from Google Business Profile**. It copies both profiles.
2. **Apple Business Connect** (businessconnect.apple.com): claim "Advocate Akash R. Chikate & Associates" and use the same name, address, phone, hours and description as above.
3. **JustDial and Sulekha:** if you have listings, make the name, address and phone match exactly. Delete duplicates.

---

## 9. What I'll add to the site to match (next plugin version)

- Replace the contact-page map with your real profile embed (fix 1) and the directions link (fix 2).
- Raise `geo` coordinates in the schema to 5+ decimal places, after you confirm the exact pin.
- Add a "Find us on Google" link to both profiles in the footer.
- Once the Pimple Gurav decision (fix 3) is made, make the schema for that office match it (service area or full address).
