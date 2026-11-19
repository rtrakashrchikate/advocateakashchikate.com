/**
 * AKC Homepage (final): new hero, situations, courts, about, method, services, process, guides and FAQ.
 * Scope: front page only. Safe fallback: if the START or END marker is missing, the page is returned unchanged.
 * Also corrects the homepage structured data: the FAQPage JSON-LD is replaced with the visible FAQ, and the
 * priceRange field is removed from the LegalService nodes.
 * Copy fixes for the kept consultation/footer blocks (Rule 36 wording) are ON; define AKC_HOME_COPY_FIXES as false to turn them off.
 * To revert completely: deactivate this snippet.
 */
if ( ! defined( 'AKC_HOME_COPY_FIXES' ) ) {
    define( 'AKC_HOME_COPY_FIXES', true );
}

if ( ! function_exists( 'akc_home_final_filter' ) ) {
    function akc_home_final_filter( $html ) {
        $start_marker = '<!-- ══ HERO SECTION ══ -->';
        $end_marker   = '<!-- ══ AREAS WE SERVE ══ -->';
        $a = strpos( $html, $start_marker );
        if ( false === $a ) { return $html; }
        $b = strpos( $html, $end_marker, $a );
        if ( false === $b ) { return $html; }

        $block = <<<'AKC_HERO_HTML'
<!-- ══ HERO SECTION (final) ══ -->
<section class="hero hero2" id="top" aria-labelledby="h2-title">
  <div class="h2-bg" aria-hidden="true">
    <span class="h2-grain"></span>
    <span class="h2-vignette"></span>
    <svg class="h2-arches" viewBox="0 0 600 800" fill="none" stroke="#c9a030" stroke-width="1.2" preserveAspectRatio="xMidYMid meet" focusable="false">
      <path pathLength="1" style="--o:.46;--d:.15s" d="M10 790V300a290 290 0 0 1 580 0v490"/>
      <path pathLength="1" style="--o:.34;--d:.4s"  d="M60 790V300a240 240 0 0 1 480 0v490"/>
      <path pathLength="1" style="--o:.22;--d:.65s" d="M110 790V300a190 190 0 0 1 380 0v490"/>
      <path pathLength="1" style="--o:.13;--d:.9s"  d="M160 790V300a140 140 0 0 1 280 0v490"/>
    </svg>
    <span class="h2-mark" lang="mr">न्याय</span>
  </div>

  <div class="container h2-wrap">
    <div class="h2-copy">
      <p class="h2-status" id="h2-status" data-state="static">
        <span class="h2-dot" aria-hidden="true"></span>
        <span id="h2-status-text">Office hours: Mon–Sat, 10 AM – 7 PM</span>
      </p>

      <p class="h2-eyebrow">Criminal law practice <i aria-hidden="true">·</i> Shivajinagar, Pune</p>

      <h1 id="h2-title">Criminal Defence &amp; <em>Bail Lawyer</em> in Pune</h1>

      <p class="h2-deva" lang="mr">जामीन · अटकपूर्व जामीन · एफआयआर रद्द</p>

      <p class="h2-lede">An arrest, an FIR or a police notice changes things quickly. Start with clear information about your options, the court involved and the steps that come next.</p>

      <div class="hero-actions h2-actions"><a href="tel:+918411982241" class="btn btn-primary btn-lg"><i class="fa-solid fa-phone akc-i" aria-hidden="true"><svg viewBox="0 0 512 512" focusable="false"><use href="#akci-solid-phone"/></svg></i> Call 84119 82241</a> <a href="https://wa.me/918698400302?text=Hello%2C%20I%20have%20a%20question%20about%20a%20criminal%20matter." class="btn btn-outline btn-lg akc-hero-wa" target="_blank" rel="noopener"><svg class="akc-wa-ico" viewBox="0 0 448 512" aria-hidden="true"><path fill="currentColor" d="M380.9 97.1C339 55.1 283.2 32 223.9 32 101.5 32 2 131.5 2 253.9c0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.5 224.1-221.9 0-59.3-25.2-115-67.1-157zM223.9 438.7c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/></svg> WhatsApp 86984 00302</a></div>

      <a class="h2-find" href="#situations">Not sure where to start? Find your situation <span aria-hidden="true">↓</span></a>

      <ul class="h2-facts">
        <li><small>Enrolled</small><span>2020 · MAH/4681/2020</span></li>
        <li><small>Qualifications</small><span>B.A. LL.B., LL.M.</span></li>
        <li><small>Languages</small><span>Marathi · हिन्दी · English</span></li>
        <li><small>Office</small><span>Shivajinagar</span></li>
      </ul>
    </div>

    <figure class="h2-portrait">
      <div class="h2-frame">
        <img fetchpriority="high" decoding="async" width="847" height="1063" src="https://advocateakashchikate.com/wp-content/uploads/2026/07/akash-chikate-hero-desktop-847w.webp" alt="Advocate Akash R. Chikate, criminal lawyer in Pune">
        <figcaption class="h2-tag"><strong>Adv. Akash R. Chikate</strong><span>B.A. LL.B., LL.M.</span></figcaption>
      </div>

      <svg class="h2-seal" viewBox="0 0 200 200" role="img" aria-label="Enrolled with the Bar Council of Maharashtra and Goa, 2020, MAH/4681/2020">
        <defs><path id="h2-ring" d="M100 100m-77 0a77 77 0 1 1 154 0a77 77 0 1 1 -154 0"/></defs>
        <circle cx="100" cy="100" r="97" class="s-disc"/>
        <circle cx="100" cy="100" r="62" class="s-inner"/>
        <g class="s-ring"><text><textPath href="#h2-ring" textLength="478" lengthAdjust="spacing">BAR COUNCIL OF MAHARASHTRA &amp; GOA · ENROLLED 2020 · MAH/4681/2020 ·</textPath></text></g>
        <text x="100" y="121" text-anchor="middle" class="s-glyph">§</text>
      </svg>

      <div class="h2-chip"><small>Office</small><b>Near the Pune District &amp; Sessions Court</b></div>
    </figure>
  </div>
</section>

<!-- ══ SITUATIONS (final) ══ -->
<section class="sit2" id="situations" aria-labelledby="sit2-title">
  <div class="container">
    <header class="sit2-head">
      <p class="sit2-kicker"><span></span>Where do you stand today?</p>
      <h2 id="sit2-title">Choose the situation <em>closest to yours</em></h2>
      <p class="sit2-sub">Each page explains the law, the court, the documents and the usual next steps in plain language, with the old CrPC section numbers beside the new BNSS ones.</p>
    </header>

    <div class="sit2-grid">
      <a class="sit2-card" href="https://advocateakashchikate.com/practice-areas/anticipatory-bail/">
        <span class="sit2-n">01</span>
        <h3>I may be arrested</h3>
        <p>A complaint, FIR or police call has come, and arrest is possible. Anticipatory bail and the police notice route.</p>
        <span class="sit2-go">Anticipatory bail <b aria-hidden="true">→</b></span>
        <small>Section 482 BNSS · old 438 CrPC</small>
      </a>
      <a class="sit2-card" href="https://advocateakashchikate.com/practice-areas/bail-application/">
        <span class="sit2-n">02</span>
        <h3>Someone has been arrested</h3>
        <p>Remand, regular bail, default bail and what to do after a refusal at the Sessions Court.</p>
        <span class="sit2-go">Bail after arrest <b aria-hidden="true">→</b></span>
        <small>Sections 480, 483 BNSS · old 437, 439 CrPC</small>
      </a>
      <a class="sit2-card" href="https://advocateakashchikate.com/practice-areas/fir-quashing/">
        <span class="sit2-n">03</span>
        <h3>An FIR is registered</h3>
        <p>When an FIR can be challenged in the Bombay High Court, and how to check what is registered against you.</p>
        <span class="sit2-go">FIR quashing <b aria-hidden="true">→</b></span>
        <small>Section 528 BNSS · old 482 CrPC</small>
      </a>
      <a class="sit2-card" href="https://advocateakashchikate.com/practice-areas/cheque-bounce-ni-act/">
        <span class="sit2-n">04</span>
        <h3>A cheque has bounced</h3>
        <p>Notice, reply, complaint and settlement under Section 138, for the payer or the person who was paid.</p>
        <span class="sit2-go">Cheque bounce <b aria-hidden="true">→</b></span>
        <small>Section 138 Negotiable Instruments Act</small>
      </a>
    </div>

    <p class="sit2-more">
      <span>Also useful:</span>
      <a href="https://advocateakashchikate.com/rights-when-arrested-india/">Your rights when arrested</a>
      <a href="https://advocateakashchikate.com/practice-areas/police-notice-section-35-bnss/">Police notice (Section 35 BNSS)</a>
      <a href="https://advocateakashchikate.com/how-to-check-fir-registered-against-you-maharashtra/">Check an FIR in Maharashtra</a>
      <a href="https://advocateakashchikate.com/yerwada-jail-mulakat-release-after-bail-pune/">Yerwada jail mulakat</a>
      <a href="https://advocateakashchikate.com/practice-areas/criminal-defence/">All criminal services</a>
    </p>
  </div>
</section>

<!-- ══ COURTS (final) ══ -->
<section class="crt2" aria-label="Courts">
  <div class="container crt2-in">
    <p class="crt2-lead">Courts explained in these guides</p>
    <ul class="crt2-list">
      <li><small>Pune</small><span>District &amp; Sessions Court, Shivajinagar</span></li>
      <li><small>Pune &amp; Pimpri-Chinchwad</small><span>Magistrate courts (JMFC)</span></li>
      <li><small>Mumbai</small><span>Bombay High Court (no Pune bench)</span></li>
    </ul>
  </div>
</section>

<!-- ══ ABOUT (final) ══ -->
<section class="abt2" id="about-advocate" aria-labelledby="abt2-title">
  <div class="container abt2-grid">
    <figure class="abt2-fig">
      <div class="abt2-frame"><img loading="lazy" decoding="async" width="847" height="1063" src="https://advocateakashchikate.com/wp-content/uploads/2026/07/akash-chikate-hero-desktop-847w.webp" alt="Advocate Akash R. Chikate in his Pune office"></div>
      <figcaption>Adv. Akash R. Chikate<span>B.A. LL.B., LL.M.</span></figcaption>
    </figure>

    <div class="abt2-copy">
      <p class="sit2-kicker"><span></span>The advocate</p>
      <h2 id="abt2-title">Advocate Akash R. Chikate, <em>criminal law</em> in Pune</h2>
      <p>Advocate Akash R. Chikate is enrolled with the Bar Council of Maharashtra &amp; Goa and practises criminal law. The main office is in Shivajinagar, near the Pune District and Sessions Court, with a second office at Pimple Gurav by appointment.</p>
      <p>Criminal law is covered at every stage: bail and anticipatory bail, police notices and custody, FIR quashing, trials and appeals. The Bombay High Court sits in Mumbai, and there is no Pune bench.</p>

      <dl class="abt2-dl">
        <div><dt>Enrolment</dt><dd>Bar Council of Maharashtra &amp; Goa · MAH/4681/2020 · enrolled 2020</dd></div>
        <div><dt>Qualifications</dt><dd>B.A. LL.B., LL.M.</dd></div>
        <div><dt>Area of practice</dt><dd>Criminal law</dd></div>
        <div><dt>Languages</dt><dd>Marathi · हिन्दी · English</dd></div>
        <div><dt>Offices</dt><dd>Shivajinagar, Pune · Pimple Gurav, Pimpri-Chinchwad (by appointment)</dd></div>
      </dl>
      <a class="abt2-link" href="https://advocateakashchikate.com/about/">More about the advocate <b aria-hidden="true">→</b></a>
    </div>
  </div>
</section>

<!-- ══ METHOD (final) ══ -->
<section class="mth2" aria-labelledby="mth2-title">
  <div class="mth2-bg" aria-hidden="true"></div>
  <div class="container">
    <header class="mth2-head">
      <p class="sit2-kicker sit2-kicker-dk"><span></span>How a matter is approached</p>
      <h2 id="mth2-title">Facts first, <em>then advice</em></h2>
    </header>
    <ol class="mth2-grid">
      <li><span class="mth2-n">I</span><h3>Documents first</h3><p>The FIR, remand order, notice or chargesheet is read in full before any advice is given.</p></li>
      <li><span class="mth2-n">II</span><h3>Plain explanations</h3><p>Each section, court and stage is explained in simple words, with old and new section numbers side by side.</p></li>
      <li><span class="mth2-n">III</span><h3>Each case on its facts</h3><p>The same section can lead to different advice, so every matter is read on its own facts.</p></li>
      <li><span class="mth2-n">IV</span><h3>Confidentiality</h3><p>What you share about your case is kept confidential, which is a professional duty under the Bar Council rules.</p></li>
    </ol>
  </div>
</section>

<!-- ══ SERVICES (final) ══ -->
<section class="svc2" id="services" aria-labelledby="svc2-title">
  <div class="container">
    <header class="sit2-head">
      <p class="sit2-kicker"><span></span>Criminal law topics</p>
      <h2 id="svc2-title">Criminal law topics, <em>each explained in plain language</em></h2>
    </header>
    <ul class="svc2-grid">
      <li><a href="https://advocateakashchikate.com/practice-areas/anticipatory-bail/"><b>Anticipatory bail</b><small>Section 482 BNSS</small></a></li>
      <li><a href="https://advocateakashchikate.com/practice-areas/bail-application/"><b>Bail after arrest</b><small>Sections 480, 483 BNSS</small></a></li>
      <li><a href="https://advocateakashchikate.com/practice-areas/police-custody-remand/"><b>Police custody &amp; remand</b><small>Section 187 BNSS</small></a></li>
      <li><a href="https://advocateakashchikate.com/practice-areas/police-notice-section-35-bnss/"><b>Police notice</b><small>Section 35 BNSS · old 41A</small></a></li>
      <li><a href="https://advocateakashchikate.com/practice-areas/fir-quashing/"><b>FIR quashing</b><small>Section 528 BNSS</small></a></li>
      <li><a href="https://advocateakashchikate.com/practice-areas/default-bail-undertrial-release/"><b>Default bail</b><small>Sections 187, 479 BNSS</small></a></li>
      <li><a href="https://advocateakashchikate.com/practice-areas/discharge-application/"><b>Discharge application</b><small>Before charge is framed</small></a></li>
      <li><a href="https://advocateakashchikate.com/practice-areas/sessions-trial-defence/"><b>Sessions trial defence</b><small>Pune Sessions Court</small></a></li>
      <li><a href="https://advocateakashchikate.com/practice-areas/criminal-appeals-suspension-of-sentence/"><b>Criminal appeals</b><small>Section 415 BNSS</small></a></li>
      <li><a href="https://advocateakashchikate.com/practice-areas/ndps-drug-offence-defence/"><b>NDPS Act matters</b><small>Bail, Section 37, trial</small></a></li>
      <li><a href="https://advocateakashchikate.com/practice-areas/pocso-defence/"><b>POCSO Act matters</b><small>Bail and defence</small></a></li>
      <li><a href="https://advocateakashchikate.com/practice-areas/mcoca-defence/"><b>MCOCA matters</b><small>Bail and defence</small></a></li>
      <li><a href="https://advocateakashchikate.com/practice-areas/cheque-bounce-ni-act/"><b>Cheque bounce</b><small>Section 138 NI Act</small></a></li>
      <li><a href="https://advocateakashchikate.com/practice-areas/498a-domestic-violence-defence/"><b>Section 85 BNS (old 498A)</b><small>Matrimonial cruelty cases</small></a></li>
      <li><a href="https://advocateakashchikate.com/practice-areas/eow-financial-crimes-defence/"><b>EOW &amp; financial crimes</b><small>Economic offences</small></a></li>
      <li><a href="https://advocateakashchikate.com/practice-areas/sc-st-atrocities-act-defence/"><b>SC/ST Atrocities Act</b><small>Bail and defence</small></a></li>
      <li><a href="https://advocateakashchikate.com/practice-areas/cyber-it-law/"><b>Cyber crime</b><small>IT Act and BNS</small></a></li>
      <li class="svc2-all"><a href="https://advocateakashchikate.com/practice-areas/criminal-defence/"><b>All criminal services</b><small>Criminal lawyer in Pune <span aria-hidden="true">→</span></small></a></li>
    </ul>
  </div>
</section>

<!-- ══ PROCESS (final) ══ -->
<section class="prc2" id="process" aria-labelledby="prc2-title">
  <div class="container">
    <header class="sit2-head">
      <p class="sit2-kicker"><span></span>What to expect</p>
      <h2 id="prc2-title">How a matter <em>usually proceeds</em></h2>
    </header>
    <ol class="prc2-steps">
      <li><span class="prc2-dot" aria-hidden="true"></span><small>Step 1</small><h3>Consultation</h3><p>You explain the situation and share the documents you have, in person, by phone or on video.</p></li>
      <li><span class="prc2-dot" aria-hidden="true"></span><small>Step 2</small><h3>Reading the record</h3><p>The FIR, orders and papers are read, and your legal position and options are explained.</p></li>
      <li><span class="prc2-dot" aria-hidden="true"></span><small>Step 3</small><h3>Filing and hearing</h3><p>The application or reply is drafted, filed in the right court and argued at the hearing.</p></li>
      <li><span class="prc2-dot" aria-hidden="true"></span><small>Step 4</small><h3>Order and next steps</h3><p>The order is explained, with the conditions to follow and the stage that comes next.</p></li>
    </ol>
  </div>
</section>

<!-- ══ GUIDES (final) ══ -->
<section class="gde2" aria-labelledby="gde2-title">
  <div class="container">
    <header class="sit2-head gde2-head">
      <div>
        <p class="sit2-kicker"><span></span>Legal guides</p>
        <h2 id="gde2-title">Read before you <em>decide</em></h2>
        <p class="sit2-sub gde2-sub">General information, not legal advice.</p>
      </div>
      <a class="gde2-all" href="https://advocateakashchikate.com/blog/">All guides <b aria-hidden="true">→</b></a>
    </header>
    <div class="gde2-grid">
      <a class="gde2-card" href="https://advocateakashchikate.com/rights-when-arrested-india/"><small>Arrest</small><h3>Your rights when arrested in India</h3><p>What the police must do, what you can ask for, and what to avoid saying or signing.</p></a>
      <a class="gde2-card" href="https://advocateakashchikate.com/section-438-crpc-section-482-bnss-anticipatory-bail-explained/"><small>Anticipatory bail</small><h3>Section 438 CrPC is now Section 482 BNSS</h3><p>What the section says, how courts apply it and how it differs from regular bail.</p></a>
      <a class="gde2-card" href="https://advocateakashchikate.com/yerwada-jail-mulakat-release-after-bail-pune/"><small>Custody</small><h3>Yerwada jail mulakat and release after bail</h3><p>Meeting a prisoner, e-mulakat and the release process, step by step.</p></a>
      <a class="gde2-card" href="https://advocateakashchikate.com/practice-areas/police-notice-section-35-bnss/"><small>Police notice</small><h3>A Section 35 BNSS (41A) notice: what it means</h3><p>Why a notice is not an arrest, how to comply and when anticipatory bail still matters.</p></a>
      <a class="gde2-card" href="https://advocateakashchikate.com/interim-bail-meaning-pune/"><small>Bail</small><h3>Interim bail: meaning and when courts grant it</h3><p>How interim bail differs from regular bail, parole and furlough.</p></a>
      <a class="gde2-card" href="https://advocateakashchikate.com/recent-supreme-court-judgments-cheque-bounce-section-138/"><small>Cheque bounce</small><h3>Recent Supreme Court judgments on Section 138</h3><p>Settlement costs, jurisdiction, security cheques and the time limits.</p></a>
    </div>
  </div>
</section>

<!-- ══ FAQ (final) ══ -->
<section class="faq2" id="faq" aria-labelledby="faq2-title">
  <div class="container faq2-grid">
    <header class="faq2-head">
      <p class="sit2-kicker"><span></span>Common questions</p>
      <h2 id="faq2-title">Questions people <em>ask first</em></h2>
      <p class="sit2-sub">General information in plain words. Every case depends on its own facts, and this is not legal advice.</p>
    </header>
    <div class="faq2-list">
      <details name="faq2" open><summary>Which court hears an anticipatory bail application from Pune?</summary><div class="faq2-a"><p>The application can be made to the Sessions Court in Pune or to the Bombay High Court in Mumbai. If the Sessions Court refuses, a fresh application can be made to the High Court. The provision is Section 482 BNSS, which replaced Section 438 CrPC.</p></div></details>
      <details name="faq2"><summary>Is there a Pune bench of the Bombay High Court?</summary><div class="faq2-a"><p>No. The Bombay High Court sits at its principal seat in Mumbai, and bail, quashing and appeal matters from Pune are heard there. First-stage bail and trial matters are heard in the Pune courts.</p></div></details>
      <details name="faq2"><summary>What is the difference between anticipatory bail and regular bail?</summary><div class="faq2-a"><p>Anticipatory bail (Section 482 BNSS, old 438 CrPC) is sought before arrest, so that a person is released on bail if arrested. Regular bail is sought after arrest: from the Magistrate under Section 480 BNSS (old 437 CrPC), or from the Sessions Court or High Court under Section 483 BNSS (old 439 CrPC).</p></div></details>
      <details name="faq2"><summary>A police notice under Section 35 BNSS has come. Does that mean I will be arrested?</summary><div class="faq2-a"><p>Not by itself. A Section 35 BNSS notice (old Section 41A CrPC) asks a person to appear before the police, in a case where arrest is not required. The notice should be read carefully and complied with, and advice on the next step is sensible.</p><p><a href="https://advocateakashchikate.com/practice-areas/police-notice-section-35-bnss/">Read about the police notice</a></p></div></details>
      <details name="faq2"><summary>How can I check whether an FIR has been registered against me in Maharashtra?</summary><div class="faq2-a"><p>Published FIRs can be searched on the Maharashtra Police citizen portal by police station and date. Sensitive FIRs are not published, so the police station can also confirm whether one exists.</p><p><a href="https://advocateakashchikate.com/how-to-check-fir-registered-against-you-maharashtra/">How to check an FIR in Maharashtra</a></p></div></details>
      <details name="faq2"><summary>In which languages and where are consultations held?</summary><div class="faq2-a"><p>Marathi, Hindi and English. Consultations are held in person at the Shivajinagar office near the Pune District and Sessions Court, by phone or on video. The Pimple Gurav office is by appointment.</p></div></details>
      <details name="faq2"><summary>When is the office open?</summary><div class="faq2-a"><p>Monday to Saturday, 10 AM to 7 PM. You can call 84119 82241 or message on WhatsApp at 86984 00302. A message sent outside these hours is read when the office opens.</p></div></details>
      <details name="faq2"><summary>Where are Bombay High Court matters heard, and can I consult from Mumbai?</summary><div class="faq2-a"><p>The Bombay High Court sits in Mumbai, and bail, anticipatory bail, FIR quashing and criminal appeals from Pune are heard there. The office is in Pune, and a consultation can be by phone or video if you are in Mumbai.</p><p><a href="https://advocateakashchikate.com/bombay-high-court-lawyer-pune/">Bombay High Court matters</a></p></div></details>
    </div>
  </div>
</section>


AKC_HERO_HTML;
        $css = <<<'AKC_CSS'
/* AKC homepage v2: hero + situations. Scoped to .hero2 and .sit2 so the rest of the theme is untouched. */
.hero.hero2{
  --g:#c9a030; --gl:#e8c355; --n:#0d1b3e; --nd:#07112a; --paper:#f9f6f0;
  position:relative; display:block; min-height:min(100vh,1000px);
  padding:clamp(104px,14vh,150px) 0 clamp(80px,10vh,120px);
  background:radial-gradient(110% 85% at 80% 28%,#162c63 0%,#0d1b3e 44%,#07112a 100%);
  overflow:hidden; isolation:isolate; align-items:initial;
}
.hero2 .h2-bg{position:absolute; inset:0; z-index:-1; pointer-events:none}
.hero2 .h2-grain{position:absolute; inset:0; opacity:.2; mix-blend-mode:overlay;
  background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='160' height='160'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.85' numOctaves='2' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E")}
.hero2 .h2-arches{position:absolute; right:max(0px,calc((100vw - 1200px)/2 - 100px)); top:50%; width:min(50vw,650px); height:auto; aspect-ratio:3/4; transform:translateY(-52%); translate:calc(var(--mx,0) * -14px) calc(var(--my,0) * -10px); opacity:.95; overflow:visible}
.hero2 .h2-arches path{stroke-opacity:var(--o); stroke-dasharray:1; stroke-dashoffset:1; animation:h2arch 2.8s var(--d,.2s) cubic-bezier(.3,.6,.2,1) forwards}
@keyframes h2arch{to{stroke-dashoffset:0}}
.hero2 .h2-vignette{position:absolute; inset:0; background:radial-gradient(120% 100% at 50% 40%,transparent 55%,rgba(3,8,22,.55) 100%)}
.hero2 .h2-mark{position:absolute; left:-1.5vw; bottom:-5vw; font:400 clamp(190px,27vw,430px)/1 'Tiro Devanagari Marathi','Noto Serif Devanagari',serif; color:transparent; -webkit-text-stroke:1px rgba(201,160,48,.15); user-select:none; white-space:nowrap}

.hero2 .h2-wrap{display:grid; grid-template-columns:minmax(0,1.14fr) minmax(0,.86fr); gap:clamp(36px,5vw,84px); align-items:center}

/* status pill */
.hero2 .h2-status{display:inline-flex; align-items:center; gap:10px; margin:0; padding:9px 15px; border:1px solid rgba(201,160,48,.38); border-radius:999px; background:rgba(255,255,255,.035); backdrop-filter:blur(6px); -webkit-backdrop-filter:blur(6px);
  font:600 .7rem/1 'Inter',system-ui,sans-serif; letter-spacing:.14em; text-transform:uppercase; color:var(--gl)}
.hero2 .h2-dot{width:8px; height:8px; border-radius:50%; background:#d9a441; flex:none}
.hero2 .h2-status[data-state="open"] .h2-dot{background:#3ddc84; box-shadow:0 0 0 0 rgba(61,220,132,.55); animation:h2pulse 2.2s ease-out infinite}
@keyframes h2pulse{70%{box-shadow:0 0 0 9px rgba(61,220,132,0)}100%{box-shadow:0 0 0 0 rgba(61,220,132,0)}}

.hero2 .h2-eyebrow{margin:20px 0 14px; font:500 .76rem/1.4 'Inter',system-ui,sans-serif; letter-spacing:.22em; text-transform:uppercase; color:rgba(255,255,255,.6)}
.hero2 .h2-eyebrow i{font-style:normal; color:var(--g); margin:0 .35em}

.hero2 h1{margin:0; font:600 clamp(2.5rem,4.7vw,4.5rem)/1.04 'Playfair Display',Georgia,serif; letter-spacing:-.012em; color:#fff; text-wrap:balance}
.hero2 h1 em{position:relative; display:inline-block; font-style:italic; font-weight:600; color:var(--gl); white-space:nowrap}
@supports (background-clip:text) or (-webkit-background-clip:text) {
  .hero2 h1 em{background:linear-gradient(100deg,#c9a030 18%,#f7e49a 42%,#d8b247 56%,#c9a030 78%) 100% 0/260% 100% no-repeat; -webkit-background-clip:text; background-clip:text; -webkit-text-fill-color:transparent; color:transparent; animation:h2shine 3s 1.1s ease-out both}
}
@keyframes h2shine{to{background-position:0 0}}
.hero2 h1 em::after{content:""; position:absolute; left:2%; right:2%; bottom:.04em; height:.07em; border-radius:2px; background:linear-gradient(90deg,var(--g),rgba(232,195,85,.15)); transform-origin:left; animation:h2draw 1.1s .9s cubic-bezier(.2,.7,.2,1) both}
@keyframes h2draw{from{transform:scaleX(0)}to{transform:scaleX(1)}}

.hero2 .h2-deva{margin:16px 0 0; font:400 clamp(1.05rem,1.55vw,1.32rem)/1.5 'Tiro Devanagari Marathi','Noto Serif Devanagari',Georgia,serif; color:rgba(232,195,85,.92); letter-spacing:.02em}
.hero2 .h2-lede{max-width:33em; margin:18px 0 26px; font:400 clamp(1rem,1.22vw,1.16rem)/1.72 'Inter',system-ui,sans-serif; color:rgba(255,255,255,.82)}

.hero2 .h2-actions{display:flex; flex-wrap:wrap; gap:14px; margin:0}
.hero2 .h2-find{display:inline-flex; align-items:center; gap:10px; margin-top:24px; font:500 .95rem/1.3 'Inter',system-ui,sans-serif; color:var(--gl); text-decoration:underline; text-decoration-color:rgba(232,195,85,.4); text-decoration-thickness:1px; text-underline-offset:.4em; transition:text-decoration-color .25s,gap .25s}
.hero2 .h2-find span{display:inline-block; animation:h2nudge 1.8s ease-in-out infinite}
.hero2 .h2-find:hover{text-decoration-color:var(--gl); gap:14px}
@keyframes h2nudge{50%{transform:translateY(4px)}}

.hero2 .h2-facts{list-style:none; display:flex; flex-wrap:wrap; gap:16px 26px; margin:30px 0 0; padding:20px 0 0; border-top:1px solid rgba(255,255,255,.13)}
.hero2 .h2-facts li{display:flex; flex-direction:column; gap:5px}
.hero2 .h2-facts small{font:600 .64rem/1 'Inter',system-ui,sans-serif; letter-spacing:.2em; text-transform:uppercase; color:var(--g)}
.hero2 .h2-facts span{font:500 .86rem/1.3 'Inter',system-ui,sans-serif; color:rgba(255,255,255,.86)}

/* portrait in an arched "courtroom window" frame */
.hero2 .h2-portrait{position:relative; margin:0; width:min(100%,456px); justify-self:end}
.hero2 .h2-frame{translate:calc(var(--mx,0) * 8px) calc(var(--my,0) * 6px); position:relative; aspect-ratio:4/5; border-radius:50% 50% 16px 16px / 40% 40% 16px 16px; overflow:visible; box-shadow:0 46px 90px -30px rgba(0,0,0,.65)}
.hero2 .h2-frame::before{content:""; position:absolute; inset:0; border-radius:inherit; border:1px solid rgba(232,195,85,.6); transform:translate(18px,18px); z-index:-1}
.hero2 .h2-frame img{position:absolute; inset:0; width:100%; height:100%; object-fit:cover; object-position:50% 20%; border-radius:inherit; filter:saturate(.96) contrast(1.03); animation:h2zoom 3.2s .2s cubic-bezier(.2,.7,.2,1) both}
@keyframes h2zoom{from{transform:scale(1.07)}to{transform:none}}
.hero2 .h2-frame::after{content:""; position:absolute; inset:0; border-radius:inherit; background:linear-gradient(to top,rgba(7,17,42,.9) 0%,rgba(7,17,42,.35) 26%,transparent 46%); pointer-events:none}
.hero2 .h2-tag{position:absolute; left:0; right:0; bottom:26px; z-index:2; display:flex; flex-direction:column; align-items:center; gap:4px; text-align:center}
.hero2 .h2-tag strong{font:600 1.28rem/1.2 'Playfair Display',Georgia,serif; color:#fff}
.hero2 .h2-tag span{font:500 .7rem/1 'Inter',system-ui,sans-serif; letter-spacing:.18em; text-transform:uppercase; color:var(--gl)}

.hero2 .h2-chip{right:-34px; bottom:24%; position:absolute; z-index:3; padding:12px 16px; border-radius:10px; background:rgba(13,27,62,.82); border:1px solid rgba(201,160,48,.42); backdrop-filter:blur(10px); -webkit-backdrop-filter:blur(10px); box-shadow:0 18px 40px -16px rgba(0,0,0,.6); animation:h2float 7s ease-in-out infinite alternate}
.hero2 .h2-chip small{display:block; margin-bottom:5px; font:600 .6rem/1 'Inter',system-ui,sans-serif; letter-spacing:.18em; text-transform:uppercase; color:var(--g)}
.hero2 .h2-chip b{display:block; font:600 .95rem/1.25 'Playfair Display',Georgia,serif; color:#fff}
@keyframes h2float{from{transform:translateY(-5px)}to{transform:translateY(6px)}}

/* load-in sequence */
.hero2 .h2-copy > *{opacity:0; transform:translateY(18px); animation:h2up .8s cubic-bezier(.2,.7,.2,1) forwards}
.hero2 .h2-copy{--stagger:.09s}
@supports (animation-delay: calc(sibling-index() * 0.1s)) {
  .hero2 .h2-copy > *{animation-delay:calc(sibling-index() * var(--stagger))}
}
@supports not (animation-delay: calc(sibling-index() * 0.1s)) {
  .hero2 .h2-copy > :nth-child(1){animation-delay:.05s}
  .hero2 .h2-copy > :nth-child(2){animation-delay:.14s}
  .hero2 .h2-copy > :nth-child(3){animation-delay:.24s}
  .hero2 .h2-copy > :nth-child(4){animation-delay:.34s}
  .hero2 .h2-copy > :nth-child(5){animation-delay:.44s}
  .hero2 .h2-copy > :nth-child(6){animation-delay:.54s}
  .hero2 .h2-copy > :nth-child(7){animation-delay:.62s}
  .hero2 .h2-copy > :nth-child(8){animation-delay:.72s}
}
.hero2 .h2-portrait{opacity:0; animation:h2rise 1.1s .25s cubic-bezier(.2,.7,.2,1) forwards}
@keyframes h2up{to{opacity:1; transform:none}}
@keyframes h2rise{from{opacity:0; transform:translateY(34px) scale(.985)} to{opacity:1; transform:none}}

/* ───────── situations ───────── */
.sit2{--g:#c9a030; --n:#0d1b3e; background:#f9f6f0; padding:clamp(64px,9vw,112px) 0 clamp(60px,8vw,96px); position:relative}
.sit2::before{content:""; position:absolute; left:0; right:0; top:0; height:1px; background:linear-gradient(90deg,transparent,rgba(201,160,48,.7),transparent)}
.sit2-head{max-width:760px; margin:0 0 clamp(34px,5vw,56px)}
.sit2-kicker{--g:#c9a030; display:flex; align-items:center; gap:14px; margin:0 0 16px; font:600 .74rem/1 'Inter',system-ui,sans-serif; letter-spacing:.22em; text-transform:uppercase; color:#7a5c0d}
.sit2-kicker span{width:34px; height:1px; background:var(--g); flex:none}
.sit2 h2,.sit2-head h2{margin:0; font:600 clamp(2rem,4vw,3.3rem)/1.08 'Playfair Display',Georgia,serif; color:var(--n); letter-spacing:-.01em; text-wrap:balance}
.sit2 h2 em,.sit2-head h2 em{font-style:italic; color:#a07820}
.sit2-sub{margin:18px 0 0; max-width:40em; font:400 1.05rem/1.7 'Inter',system-ui,sans-serif; color:#4b5563}

.sit2-grid{display:grid; grid-template-columns:repeat(4,minmax(0,1fr)); gap:20px}
.sit2-card{position:relative; display:flex; flex-direction:column; padding:30px 26px 26px; background:#fff; border:1px solid rgba(13,27,62,.1); border-radius:14px; text-decoration:none; color:inherit; overflow:hidden;
  transition:transform .35s cubic-bezier(.2,.7,.2,1), box-shadow .35s, border-color .35s}
.sit2-card::before{content:""; position:absolute; left:0; top:0; height:3px; width:0; background:linear-gradient(90deg,var(--g),#e8c355); transition:width .45s cubic-bezier(.2,.7,.2,1)}
.sit2-card:hover,.sit2-card:focus-visible{transform:translateY(-6px); box-shadow:0 26px 50px -24px rgba(13,27,62,.35); border-color:rgba(201,160,48,.55)}
.sit2-card:hover::before,.sit2-card:focus-visible::before{width:100%}
.sit2-card:focus-visible{outline:2px solid var(--g); outline-offset:3px}
.sit2-n{font:italic 600 2.5rem/1 'Playfair Display',Georgia,serif; color:#8a6a12; margin-bottom:18px}
.sit2-card h3{margin:0 0 12px; font:600 1.38rem/1.22 'Playfair Display',Georgia,serif; color:var(--n)}
.sit2-card p{margin:0 0 20px; font:400 .95rem/1.65 'Inter',system-ui,sans-serif; color:#4b5563; flex:1}
.sit2-go{display:flex; align-items:center; justify-content:space-between; padding-top:16px; border-top:1px solid rgba(13,27,62,.1); font:600 .78rem/1 'Inter',system-ui,sans-serif; letter-spacing:.12em; text-transform:uppercase; color:var(--n)}
.sit2-go b{font-weight:600; font-size:1.1rem; color:var(--g); transition:transform .3s}
.sit2-card:hover .sit2-go b{transform:translateX(5px)}
.sit2-card small{margin-top:12px; min-height:2.8em; font:500 .72rem/1.4 'Inter',system-ui,sans-serif; color:#566070; letter-spacing:.02em}

.sit2-more{display:flex; flex-wrap:wrap; align-items:center; gap:10px 22px; margin:clamp(30px,4vw,46px) 0 0; padding-top:24px; border-top:1px solid rgba(13,27,62,.12); font:400 .92rem/1.4 'Inter',system-ui,sans-serif; color:#4b5563}
.sit2-more span{font-weight:600; color:var(--n)}
.sit2-more a{color:var(--n); text-decoration:underline; text-decoration-color:rgba(201,160,48,.6); text-decoration-thickness:1px; text-underline-offset:.3em; transition:color .2s,text-decoration-color .2s}
.sit2-more a:hover{color:#a07820; text-decoration-color:#a07820}

/* scroll reveal: CSS scroll-driven animation where supported */
@supports (animation-timeline: view()) {
  .sit2-card,.gde2-card,.mth2-grid li,.prc2-steps li,.svc2-grid li,.abt2-fig,.abt2-copy{animation:sit2-in linear both; animation-timeline:view(); animation-range:entry 4% entry 38%}
  @keyframes sit2-in{from{opacity:0; transform:translateY(26px)}}
}
/* fallback (only when JS adds .h2-js because scroll-driven animations are unsupported) */
.h2-js :is(.sit2-card,.gde2-card,.mth2-grid li,.prc2-steps li,.svc2-grid li){opacity:0; transform:translateY(24px)}
.h2-js :is(.sit2-card,.gde2-card,.mth2-grid li,.prc2-steps li,.svc2-grid li).is-in{opacity:1; transform:none; transition:opacity .7s ease, transform .7s cubic-bezier(.2,.7,.2,1), box-shadow .35s, border-color .35s, background .3s}

/* ───────── responsive ───────── */
@media (max-width:1280px){
    }
@media (max-width:1100px){
  .sit2-grid{grid-template-columns:repeat(2,minmax(0,1fr))}
    }
@media (max-width:900px){
  .hero.hero2{min-height:0; padding:112px 0 64px}
  .hero2 .h2-wrap{grid-template-columns:1fr; gap:46px}
  .hero2 .h2-portrait{justify-self:center; width:min(86%,380px); margin-top:4px}
  .hero2 .h2-arches{right:50%; transform:translate(50%,-30%); translate:none; top:62%; width:min(120vw,620px); opacity:.55}
  .hero2 .h2-mark{font-size:clamp(150px,44vw,260px); bottom:-3vw}
    }
@media (max-width:560px){
  .hero2 .h2-status{font-size:.62rem; letter-spacing:.1em; padding:8px 12px}
  .hero2 .h2-eyebrow{font-size:.68rem; letter-spacing:.16em; margin-top:20px}
  .hero2 h1{font-size:clamp(2.3rem,10.4vw,3rem)}
  .hero2 .h2-actions .btn{width:100%; justify-content:center}
  .hero2 .h2-facts{gap:14px 24px}
  .hero2 .h2-chip{padding:10px 12px}
  .hero2 .h2-chip b{font-size:.84rem}
  .sit2-grid{grid-template-columns:1fr}
  .sit2-card{padding:26px 22px 22px}
}
@media (prefers-reduced-motion:reduce){
  .hero2 *,.sit2 *{animation:none!important; transition:none!important}
  .hero2 .h2-copy > *,.hero2 .h2-portrait{opacity:1; transform:none}
  .h2-js :is(.sit2-card,.gde2-card,.mth2-grid li,.prc2-steps li,.svc2-grid li){opacity:1; transform:none}
}

/* ───────── final: seal ───────── */
.hero2 .h2-seal{position:absolute; left:-52px; bottom:-34px; width:clamp(104px,10.5vw,142px); height:auto; z-index:4; filter:drop-shadow(0 18px 26px rgba(0,0,0,.55)); opacity:0; animation:h2seal .9s 1.5s cubic-bezier(.2,.7,.2,1) forwards}
@keyframes h2seal{from{opacity:0; transform:scale(.8) rotate(-30deg)} to{opacity:1; transform:none}}
.hero2 .h2-seal .s-disc{fill:#0d1b3e; stroke:#c9a030; stroke-width:1.4}
.hero2 .h2-seal .s-inner{fill:none; stroke:rgba(201,160,48,.55); stroke-width:.9}
.hero2 .h2-seal .s-ring{transform-origin:100px 100px; animation:h2spin 90s linear infinite}
.hero2 .h2-seal text{font:600 10.4px/1 'Inter',system-ui,sans-serif; letter-spacing:.06em; fill:#e8c355}
.hero2 .h2-seal .s-glyph{font:600 52px/1 'Playfair Display',Georgia,serif; letter-spacing:0; fill:#e8c355}
@keyframes h2spin{to{transform:rotate(360deg)}}

/* ───────── final: shared section bits ───────── */
.sit2-kicker-dk{color:#e8c355}
.sit2-kicker-dk span{background:#e8c355}
.sit2 + .crt2{margin-top:0}

/* courts strip */
.crt2{background:#07112a; padding:26px 0; border-top:1px solid rgba(201,160,48,.25); border-bottom:1px solid rgba(201,160,48,.25)}
.crt2-in{display:flex; align-items:center; gap:clamp(20px,4vw,56px)}
.crt2-lead{margin:0; font:italic 600 1.15rem/1.3 'Playfair Display',Georgia,serif; color:#e8c355; flex:none}
.crt2-list{list-style:none; margin:0; padding:0; display:flex; flex:1; justify-content:space-between; gap:12px 28px; flex-wrap:wrap}
.crt2-list li{display:flex; flex-direction:column; gap:5px; padding-left:18px; border-left:1px solid rgba(201,160,48,.4)}
.crt2-list small{font:600 .64rem/1 'Inter',system-ui,sans-serif; letter-spacing:.2em; text-transform:uppercase; color:#c9a030}
.crt2-list span{font:500 .95rem/1.3 'Inter',system-ui,sans-serif; color:rgba(255,255,255,.88)}

/* about */
.abt2{background:#f0ebe0; padding:clamp(70px,9vw,120px) 0; position:relative; overflow:hidden}
.abt2::before{content:"§"; position:absolute; right:-2vw; top:-6vw; font:600 clamp(280px,40vw,560px)/1 'Playfair Display',Georgia,serif; color:rgba(13,27,62,.045); pointer-events:none}
.abt2-grid{display:grid; grid-template-columns:minmax(0,.78fr) minmax(0,1.22fr); gap:clamp(36px,6vw,96px); align-items:center; position:relative}
.abt2-fig{margin:0; position:relative; justify-self:center; width:min(100%,430px)}
.abt2-frame{position:relative; aspect-ratio:4/5; border-radius:50% 50% 14px 14px / 38% 38% 14px 14px; box-shadow:0 40px 70px -34px rgba(13,27,62,.55)}
.abt2-frame::before{content:""; position:absolute; inset:0; border-radius:inherit; border:1px solid rgba(160,120,32,.7); transform:translate(-16px,16px); z-index:-1}
.abt2-frame img{width:100%; height:100%; object-fit:cover; object-position:50% 14%; border-radius:inherit; display:block}
.abt2-fig figcaption{margin-top:30px; font:600 1.15rem/1.3 'Playfair Display',Georgia,serif; color:#0d1b3e; text-align:center}
.abt2-fig figcaption span{display:block; margin-top:5px; font:500 .7rem/1 'Inter',system-ui,sans-serif; letter-spacing:.18em; text-transform:uppercase; color:#7a5c0d}
.abt2 h2{margin:0 0 22px; font:600 clamp(1.9rem,3.6vw,3rem)/1.1 'Playfair Display',Georgia,serif; color:#0d1b3e; letter-spacing:-.01em; text-wrap:balance}
.abt2 h2 em{font-style:italic; color:#a07820}
.abt2-copy p:not(.sit2-kicker){margin:0 0 16px; max-width:38em; font:400 1.05rem/1.75 'Inter',system-ui,sans-serif; color:#374151}
.abt2-dl{margin:26px 0 0; display:grid; gap:0; border-top:1px solid rgba(13,27,62,.16)}
.abt2-dl > div{display:grid; grid-template-columns:150px 1fr; gap:18px; padding:13px 0; border-bottom:1px solid rgba(13,27,62,.12)}
.abt2-dl dt{font:600 .68rem/1.6 'Inter',system-ui,sans-serif; letter-spacing:.18em; text-transform:uppercase; color:#7a5c0d}
.abt2-dl dd{margin:0; font:500 .95rem/1.55 'Inter',system-ui,sans-serif; color:#0d1b3e}
.abt2-link{display:inline-flex; gap:10px; align-items:center; margin-top:26px; font:600 .8rem/1 'Inter',system-ui,sans-serif; letter-spacing:.12em; text-transform:uppercase; color:#0d1b3e; text-decoration:underline; text-decoration-color:rgba(201,160,48,.7); text-decoration-thickness:1px; text-underline-offset:.5em}
.abt2-link b{color:#a07820; font-size:1.1rem; transition:transform .3s}
.abt2-link:hover b{transform:translateX(5px)}

/* method (dark band) */
.mth2{position:relative; background:#07112a; padding:clamp(70px,9vw,112px) 0; overflow:hidden; isolation:isolate}
.mth2-bg{position:absolute; inset:0; z-index:-1; background:radial-gradient(90% 120% at 15% 0%,#14285a 0%,transparent 60%), radial-gradient(70% 90% at 100% 100%,#0d1b3e 0%,transparent 70%)}
.mth2-head{margin-bottom:clamp(34px,5vw,56px)}
.mth2 h2{margin:0; font:600 clamp(1.9rem,3.8vw,3.2rem)/1.1 'Playfair Display',Georgia,serif; color:#fff; letter-spacing:-.01em}
.mth2 h2 em{font-style:italic; color:#e8c355}
.mth2-grid{list-style:none; margin:0; padding:0; display:grid; grid-template-columns:repeat(4,minmax(0,1fr)); gap:clamp(20px,3vw,40px)}
.mth2-grid li{padding-top:22px; border-top:1px solid rgba(201,160,48,.55); position:relative}
.mth2-grid li::before{content:""; position:absolute; left:0; top:-1px; width:42px; height:3px; background:#e8c355}
.mth2-n{display:block; margin-bottom:14px; font:italic 600 1.9rem/1 'Playfair Display',Georgia,serif; color:rgba(232,195,85,.9)}
.mth2-grid h3{margin:0 0 10px; font:600 1.3rem/1.25 'Playfair Display',Georgia,serif; color:#fff}
.mth2-grid p{margin:0; font:400 .98rem/1.7 'Inter',system-ui,sans-serif; color:rgba(255,255,255,.76)}

/* services index */
.svc2{background:#f9f6f0; padding:clamp(70px,9vw,112px) 0}
.svc2-grid{list-style:none; margin:0; padding:0; display:grid; grid-template-columns:repeat(3,minmax(0,1fr)); border-top:1px solid rgba(13,27,62,.18); border-left:1px solid rgba(13,27,62,.18)}
.svc2-grid li{border-right:1px solid rgba(13,27,62,.18); border-bottom:1px solid rgba(13,27,62,.18); background:#fff; transition:background .3s}
.svc2-grid a{display:flex; flex-direction:column; gap:6px; padding:22px 24px; height:100%; text-decoration:none; position:relative}
.svc2-grid a::after{content:"→"; position:absolute; right:22px; top:50%; transform:translateY(-50%) translateX(-6px); opacity:0; color:#a07820; font-size:1.2rem; transition:all .3s}
.svc2-grid b{font:600 1.12rem/1.3 'Playfair Display',Georgia,serif; color:#0d1b3e}
.svc2-grid small{font:500 .78rem/1.4 'Inter',system-ui,sans-serif; color:#566070; letter-spacing:.02em}
.svc2-grid li:hover,.svc2-grid li:focus-within{background:#0d1b3e}
.svc2-grid li:hover b,.svc2-grid li:focus-within b{color:#fff}
.svc2-grid li:hover small,.svc2-grid li:focus-within small{color:#e8c355}
.svc2-grid li:hover a::after,.svc2-grid li:focus-within a::after{opacity:1; transform:translateY(-50%)}
.svc2-grid a:focus-visible{outline:2px solid #c9a030; outline-offset:-3px}
.svc2-all{background:#0d1b3e !important}
.svc2-all b{color:#fff !important}
.svc2-all small{color:#e8c355 !important}

/* process timeline */
.prc2{background:#f0ebe0; padding:clamp(70px,9vw,112px) 0}
.prc2-steps{list-style:none; margin:0; padding:0; display:grid; grid-template-columns:repeat(4,minmax(0,1fr)); gap:clamp(18px,3vw,36px); position:relative}
.prc2-steps::before{content:""; position:absolute; left:0; right:0; top:9px; height:1px; background:linear-gradient(90deg,#c9a030,rgba(201,160,48,.25)); transform-origin:left; animation:h2line linear both; animation-timeline:view(); animation-range:entry 10% cover 45%}
@keyframes h2line{from{transform:scaleX(0)}to{transform:scaleX(1)}}
.prc2-steps li{position:relative; padding-top:44px}
.prc2-dot{position:absolute; left:0; top:0; width:19px; height:19px; border-radius:50%; background:#f0ebe0; border:2px solid #c9a030; box-shadow:0 0 0 5px #f0ebe0}
.prc2-steps small{display:block; margin-bottom:8px; font:600 .66rem/1 'Inter',system-ui,sans-serif; letter-spacing:.2em; text-transform:uppercase; color:#7a5c0d}
.prc2-steps h3{margin:0 0 8px; font:600 1.3rem/1.25 'Playfair Display',Georgia,serif; color:#0d1b3e}
.prc2-steps p{margin:0; font:400 .98rem/1.7 'Inter',system-ui,sans-serif; color:#4b5563}

/* guides */
.gde2{background:#f9f6f0; padding:clamp(70px,9vw,112px) 0}
.gde2-head{display:flex; justify-content:space-between; align-items:flex-end; gap:24px; max-width:none}
.gde2-all{flex:none; font:600 .8rem/1 'Inter',system-ui,sans-serif; letter-spacing:.12em; text-transform:uppercase; color:#0d1b3e; text-decoration:underline; text-decoration-color:rgba(201,160,48,.7); text-underline-offset:.5em; padding-bottom:6px}
.gde2-all b{color:#a07820}
.gde2-grid{display:grid; grid-template-columns:repeat(3,minmax(0,1fr)); gap:20px}
.gde2-card{display:flex; flex-direction:column; padding:26px 26px 24px; background:#fff; border:1px solid rgba(13,27,62,.1); border-radius:12px; text-decoration:none; transition:transform .35s cubic-bezier(.2,.7,.2,1), box-shadow .35s, border-color .35s}
.gde2-card:hover,.gde2-card:focus-visible{transform:translateY(-5px); box-shadow:0 24px 46px -26px rgba(13,27,62,.4); border-color:rgba(201,160,48,.55)}
.gde2-card:focus-visible{outline:2px solid #c9a030; outline-offset:3px}
.gde2-card small{font:600 .66rem/1 'Inter',system-ui,sans-serif; letter-spacing:.2em; text-transform:uppercase; color:#7a5c0d; margin-bottom:12px}
.gde2-card h3{margin:0 0 10px; font:600 1.2rem/1.3 'Playfair Display',Georgia,serif; color:#0d1b3e}
.gde2-card p{margin:0; font:400 .95rem/1.65 'Inter',system-ui,sans-serif; color:#4b5563}

/* faq */
.faq2{background:#fff; padding:clamp(70px,9vw,112px) 0; border-top:1px solid rgba(13,27,62,.08)}
.faq2-grid{display:grid; grid-template-columns:minmax(0,.8fr) minmax(0,1.2fr); gap:clamp(32px,6vw,96px); align-items:start}
.faq2-head{position:sticky; top:96px}
.faq2 h2{margin:0; font:600 clamp(1.9rem,3.6vw,3rem)/1.1 'Playfair Display',Georgia,serif; color:#0d1b3e; letter-spacing:-.01em}
.faq2 h2 em{font-style:italic; color:#a07820}
.faq2-list details{border-bottom:1px solid rgba(13,27,62,.16)}
.faq2-list details:first-child{border-top:1px solid rgba(13,27,62,.16)}
.faq2-list summary{list-style:none; cursor:pointer; display:flex; justify-content:space-between; align-items:flex-start; gap:20px; padding:22px 0; font:600 1.12rem/1.4 'Playfair Display',Georgia,serif; color:#0d1b3e}
.faq2-list summary::-webkit-details-marker{display:none}
.faq2-list summary::after{content:"+"; flex:none; width:28px; height:28px; display:grid; place-items:center; border:1px solid rgba(160,120,32,.7); border-radius:50%; font:400 1.2rem/1 'Inter',system-ui,sans-serif; color:#a07820; transition:transform .3s, background .3s, color .3s}
.faq2-list details[open] summary::after{transform:rotate(45deg); background:#0d1b3e; color:#e8c355; border-color:#0d1b3e}
.faq2-list summary:focus-visible{outline:2px solid #c9a030; outline-offset:4px; border-radius:4px}
.faq2-a{padding:0 48px 24px 0; font:400 1rem/1.75 'Inter',system-ui,sans-serif; color:#374151}
.faq2-a p{margin:0 0 10px}
.faq2-a a{color:#0d1b3e; text-decoration-color:rgba(201,160,48,.8); text-underline-offset:.3em}

/* ───────── final: responsive ───────── */
@media (max-width:1100px){
  .mth2-grid,.prc2-steps{grid-template-columns:repeat(2,minmax(0,1fr))}
  .prc2-steps::before{display:none}
  .svc2-grid,.gde2-grid{grid-template-columns:repeat(2,minmax(0,1fr))}
  .crt2-in{flex-direction:column; align-items:flex-start}
  .crt2-list{width:100%; justify-content:flex-start}
}
@media (max-width:900px){
  .abt2-grid,.faq2-grid{grid-template-columns:1fr}
  .faq2-head{position:static}
  .hero2 .h2-portrait{margin-bottom:46px}
  .hero2 .h2-seal{left:auto; right:6px; bottom:-56px; width:92px}
  .abt2-fig{width:min(78%,360px)}
}
@media (max-width:560px){
  .mth2-grid,.prc2-steps,.svc2-grid,.gde2-grid{grid-template-columns:1fr}
  .abt2-dl > div{grid-template-columns:1fr; gap:4px}
  .gde2-head{flex-direction:column; align-items:flex-start}
  .faq2-a{padding-right:0}
  .crt2-list{flex-direction:column}
}
@media (prefers-reduced-motion:reduce){
  .hero2 .h2-arches path{stroke-dashoffset:0}
  .hero2 .h2-seal{opacity:1; transform:none}
  .hero2 h1 em{background-position:0 0}
  .prc2-steps::before{transform:none}
}

.gde2-sub{margin-top:12px}
AKC_CSS;
        $js = <<<'AKC_JS'
(function () {
  'use strict';
  var root = document.documentElement;

  /* Office-hours pill: Mon-Sat 10:00-19:00 India time. Falls back to the static text if Intl is unavailable. */
  try {
    var pill = document.getElementById('h2-status');
    var txt = document.getElementById('h2-status-text');
    if (pill && txt && pill.hasAttribute('data-live') && window.Intl && Intl.DateTimeFormat) {
      var parts = new Intl.DateTimeFormat('en-GB', {
        timeZone: 'Asia/Kolkata', weekday: 'short', hour: 'numeric', minute: 'numeric', hour12: false
      }).formatToParts(new Date());
      var get = function (t) { var p = parts.filter(function (x) { return x.type === t; })[0]; return p ? p.value : ''; };
      var day = get('weekday');
      var mins = (parseInt(get('hour'), 10) % 24) * 60 + parseInt(get('minute'), 10);
      var order = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
      var di = order.indexOf(day);
      if (di > -1) {
        var working = di <= 5;
        if (working && mins >= 600 && mins < 1140) {
          pill.setAttribute('data-state', 'open');
          txt.textContent = 'Office open now · until 7 PM';
        } else {
          pill.setAttribute('data-state', 'closed');
          var next;
          if (working && mins < 600) { next = 'today 10 AM'; }
          else if (di === 5 || di === 6) { next = 'Monday 10 AM'; }
          else { next = 'tomorrow 10 AM'; }
          txt.textContent = 'Office closed · opens ' + next;
        }
      }
    }
  } catch (e) { /* keep static text */ }

  /* Scroll reveal for the situation cards. Cards stay visible if JS or IntersectionObserver is missing. */
  try {
    var cards = document.querySelectorAll('.sit2-card, .gde2-card, .mth2-grid li, .prc2-steps li, .svc2-grid li');
    if (cards.length && 'IntersectionObserver' in window && !(window.CSS && CSS.supports && CSS.supports('animation-timeline: view()')) &&
        !(window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches)) {
      root.classList.add('h2-js');
      var io = new IntersectionObserver(function (entries) {
        entries.forEach(function (en) {
          if (en.isIntersecting) {
            var el = en.target;
            var i = Array.prototype.indexOf.call(cards, el);
            el.style.transitionDelay = (i % 4) * 90 + 'ms';
            el.classList.add('is-in');
            io.unobserve(el);
          }
        });
      }, { threshold: 0.15, rootMargin: '0px 0px -40px 0px' });
      cards.forEach(function (c) { io.observe(c); });
    }
  } catch (e) { /* cards remain visible */ }

  /* Smooth scroll to #situations, leaving room for the fixed navbar. */
  var find = document.querySelector('.h2-find');
  if (find) {
    find.addEventListener('click', function (ev) {
      var target = document.getElementById('situations');
      if (!target) { return; }
      ev.preventDefault();
      var y = target.getBoundingClientRect().top + window.pageYOffset - 70;
      window.scrollTo({ top: y, behavior: 'smooth' });
    });
  }

  /* Gentle pointer parallax on the hero portrait and arches (mouse only, never for reduced motion). */
  try {
    var hero = document.querySelector('.hero2');
    var fine = window.matchMedia && window.matchMedia('(hover: hover) and (pointer: fine)').matches;
    var calm = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (hero && fine && !calm) {
      var raf = 0, tx = 0, ty = 0;
      hero.addEventListener('pointermove', function (ev) {
        var r = hero.getBoundingClientRect();
        tx = ((ev.clientX - r.left) / r.width - 0.5) * 2;
        ty = ((ev.clientY - r.top) / r.height - 0.5) * 2;
        if (!raf) {
          raf = requestAnimationFrame(function () {
            raf = 0;
            hero.style.setProperty('--mx', tx.toFixed(3));
            hero.style.setProperty('--my', ty.toFixed(3));
          });
        }
      }, { passive: true });
      hero.addEventListener('pointerleave', function () {
        hero.style.setProperty('--mx', 0);
        hero.style.setProperty('--my', 0);
      });
    }
  } catch (e) { /* no parallax */ }
})();
AKC_JS;

        $out = substr( $html, 0, $a ) . $block . substr( $html, $b );

        $fonts = '<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Tiro+Devanagari+Marathi:ital@0;1&display=swap">';
        $out   = str_replace( '</head>', $fonts . '<style id="akc-home-final-css">' . $css . '</style></head>', $out, $c1 );
        $out   = str_replace( '</body>', '<script id="akc-home-final-js">' . $js . '</script></body>', $out, $c2 );
        if ( ! $c1 || ! $c2 ) { return $html; }

        $out = akc_home_final_schema( $out );

        if ( AKC_HOME_COPY_FIXES ) {
            $fixes = array(
                array( 'Fill the form below — messages are answered the same day.', 'Fill the form below. The office replies during working hours.' ),
                array( 'Available for Bail Emergencies 24/7', 'Phone and WhatsApp, Mon–Sat 10 AM–7 PM' ),
                array( 'No Obligation — Just Honest Advice', 'In person, by phone or on video' ),
                array( '100% Confidential Consultation', 'Confidential consultation' ),
                array( "<h2>Don't Face the <em>Legal System</em> Alone.</h2>", '<h2>Contact the <em>Office</em></h2>' ),
                array( '<p>Every legal matter has a solution. Get a confidential consultation and understand your options — with no pressure and no obligations.</p>', '<p>Get a confidential consultation and understand your options.</p>' ),
                array( 'value="Submit — We&#039;ll Call You Back"', 'value="Send message"' ),
                array( '</i> WhatsApp, Phone, or In-Person</div>', '</i> Marathi, Hindi and English</div>' ),
                array( '</i> WhatsApp Now', '</i> WhatsApp' ),
                array( 'aria-label="Call Now"', 'aria-label="Call"' ),
                array( '<span>Call Now</span>', '<span>Call</span>' ),
                array( 'Providing ethical legal representation across criminal, civil, family, and corporate matters in Pune and Maharashtra since 2020.', 'Criminal, civil, family and corporate legal practice in Pune and Maharashtra. Enrolled 2020.' ),
            );
            foreach ( $fixes as $f ) {
                if ( substr_count( $out, $f[0] ) === 1 ) {
                    $out = str_replace( $f[0], $f[1], $out );
                }
            }
        }
        return $out;
    }
}

if ( ! function_exists( 'akc_home_final_schema' ) ) {
    function akc_home_final_schema( $html ) {
        $faq = json_decode( <<<'AKC_FAQ_JSON'
{"@type": "FAQPage", "mainEntity": [{"@type": "Question", "name": "Which court hears an anticipatory bail application from Pune?", "acceptedAnswer": {"@type": "Answer", "text": "The application can be made to the Sessions Court in Pune or to the Bombay High Court in Mumbai. If the Sessions Court refuses, a fresh application can be made to the High Court. The provision is Section 482 BNSS, which replaced Section 438 CrPC."}}, {"@type": "Question", "name": "Is there a Pune bench of the Bombay High Court?", "acceptedAnswer": {"@type": "Answer", "text": "No. The Bombay High Court sits at its principal seat in Mumbai, and bail, quashing and appeal matters from Pune are heard there. First-stage bail and trial matters are heard in the Pune courts."}}, {"@type": "Question", "name": "What is the difference between anticipatory bail and regular bail?", "acceptedAnswer": {"@type": "Answer", "text": "Anticipatory bail (Section 482 BNSS, old 438 CrPC) is sought before arrest, so that a person is released on bail if arrested. Regular bail is sought after arrest: from the Magistrate under Section 480 BNSS (old 437 CrPC), or from the Sessions Court or High Court under Section 483 BNSS (old 439 CrPC)."}}, {"@type": "Question", "name": "A police notice under Section 35 BNSS has come. Does that mean I will be arrested?", "acceptedAnswer": {"@type": "Answer", "text": "Not by itself. A Section 35 BNSS notice (old Section 41A CrPC) asks a person to appear before the police, in a case where arrest is not required. The notice should be read carefully and complied with, and advice on the next step is sensible."}}, {"@type": "Question", "name": "How can I check whether an FIR has been registered against me in Maharashtra?", "acceptedAnswer": {"@type": "Answer", "text": "Published FIRs can be searched on the Maharashtra Police citizen portal by police station and date. Sensitive FIRs are not published, so the police station can also confirm whether one exists."}}, {"@type": "Question", "name": "In which languages and where are consultations held?", "acceptedAnswer": {"@type": "Answer", "text": "Marathi, Hindi and English. Consultations are held in person at the Shivajinagar office near the Pune District and Sessions Court, by phone or on video. The Pimple Gurav office is by appointment."}}, {"@type": "Question", "name": "When is the office open?", "acceptedAnswer": {"@type": "Answer", "text": "Monday to Saturday, 10 AM to 7 PM. You can call 84119 82241 or message on WhatsApp at 86984 00302. A message sent outside these hours is read when the office opens."}}, {"@type": "Question", "name": "Where are Bombay High Court matters heard, and can I consult from Mumbai?", "acceptedAnswer": {"@type": "Answer", "text": "The Bombay High Court sits in Mumbai, and bail, anticipatory bail, FIR quashing and criminal appeals from Pune are heard there. The office is in Pune, and a consultation can be by phone or video if you are in Mumbai."}}]}
AKC_FAQ_JSON
        , true );
        if ( ! is_array( $faq ) ) { return $html; }

        return preg_replace_callback(
            '#(<script[^>]*type="application/ld\+json"[^>]*>)(.*?)(</script>)#s',
            function ( $m ) use ( $faq ) {
                $data = json_decode( $m[2], true );
                if ( ! is_array( $data ) ) { return $m[0]; }
                $changed = false;
                $walk = function ( &$node ) use ( &$walk, $faq, &$changed ) {
                    if ( ! is_array( $node ) ) { return; }
                    $types = isset( $node['@type'] ) ? (array) $node['@type'] : array();
                    if ( in_array( 'FAQPage', $types, true ) ) {
                        $node['mainEntity'] = $faq['mainEntity'];
                        $changed = true;
                    }
                    if ( in_array( 'LegalService', $types, true ) && isset( $node['priceRange'] ) ) {
                        unset( $node['priceRange'] );
                        $changed = true;
                    }
                    foreach ( $node as $k => &$child ) { if ( is_array( $child ) ) { $walk( $child ); } }
                };
                $walk( $data );
                if ( ! $changed ) { return $m[0]; }
                return $m[1] . wp_json_encode( $data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . $m[3];
            },
            $html
        );
    }
}

add_action( 'template_redirect', function () {
    if ( is_admin() || is_feed() || is_preview() || ! is_front_page() ) { return; }
    ob_start( 'akc_home_final_filter' );
}, 20 );
