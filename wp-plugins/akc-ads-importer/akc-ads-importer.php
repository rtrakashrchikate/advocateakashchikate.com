<?php
/**
 * Plugin Name: AKC Ads Importer
 * Description: Creates 5 Google Ads landing pages for Advocate Akash Chikate. One-time use.
 * Version: 1.0
 */
if ( ! defined( 'ABSPATH' ) ) exit;

register_activation_hook( __FILE__, 'akc_import_ads_pages' );

add_action( 'admin_notices', function() {
    if ( ! current_user_can( 'manage_options' ) ) return;
    if ( get_option( 'akc_ads_pages_imported' ) ) {
        echo '<div class="notice notice-success"><p><strong>AKC Ads Importer:</strong> All 5 Google Ads landing pages already created. You can deactivate and delete this plugin.</p></div>';
        return;
    }
    $nonce = wp_create_nonce( 'akc_ads_import' );
    echo '<div class="notice notice-warning"><p><strong>AKC Ads Importer:</strong> Landing pages not yet created. <a href="' . admin_url( 'admin.php?akc_ads_import=1&_wpnonce=' . $nonce ) . '" class="button button-primary">Create All 5 Ads Landing Pages Now</a></p></div>';
} );

add_action( 'admin_init', function() {
    if ( empty( $_GET['akc_ads_import'] ) ) return;
    check_admin_referer( 'akc_ads_import' );
    if ( ! current_user_can( 'manage_options' ) ) return;
    akc_import_ads_pages();
    wp_redirect( admin_url( 'edit.php?post_type=page&akc_ads_done=1' ) );
    exit;
} );

add_action( 'admin_notices', function() {
    if ( ! empty( $_GET['akc_ads_done'] ) ) {
        echo '<div class="notice notice-success is-dismissible"><p><strong>Success!</strong> All 5 Google Ads landing pages have been created. Assign the <em>Ads Landing Page</em> template to each page in the WordPress editor.</p></div>';
    }
} );

function akc_import_ads_pages() {
    if ( get_option( 'akc_ads_pages_imported' ) ) return;

    foreach ( akc_get_ads_pages() as $pg ) {
        $existing = get_page_by_path( $pg['slug'], OBJECT, 'page' );
        if ( $existing ) {
            // Still set the template in case page exists without it
            update_post_meta( $existing->ID, '_wp_page_template',     'page-ads-landing.php' );
            update_post_meta( $existing->ID, 'akc_ads_hero_title',    $pg['hero_title'] );
            update_post_meta( $existing->ID, 'akc_ads_hero_subtitle', $pg['hero_subtitle'] );
            update_post_meta( $existing->ID, 'akc_ads_hero_badge',    $pg['hero_badge'] );
            update_post_meta( $existing->ID, 'akc_ads_page_type',     $pg['page_type'] );
            continue;
        }

        $post_id = wp_insert_post( [
            'post_title'   => $pg['title'],
            'post_name'    => $pg['slug'],
            'post_content' => $pg['content'],
            'post_status'  => 'publish',
            'post_type'    => 'page',
        ] );

        if ( is_wp_error( $post_id ) || ! $post_id ) continue;

        update_post_meta( $post_id, '_wp_page_template',     'page-ads-landing.php' );
        update_post_meta( $post_id, 'akc_ads_hero_title',    $pg['hero_title'] );
        update_post_meta( $post_id, 'akc_ads_hero_subtitle', $pg['hero_subtitle'] );
        update_post_meta( $post_id, 'akc_ads_hero_badge',    $pg['hero_badge'] );
        update_post_meta( $post_id, 'akc_ads_page_type',     $pg['page_type'] );

        update_post_meta( $post_id, 'rank_math_title',         $pg['seo_title'] );
        update_post_meta( $post_id, 'rank_math_description',   $pg['seo_desc'] );
        update_post_meta( $post_id, 'rank_math_focus_keyword', $pg['focus_kw'] );
        // Noindex ads pages — they are paid traffic destinations, not organic
        update_post_meta( $post_id, 'rank_math_robots', [ 'noindex' ] );
    }

    update_option( 'akc_ads_pages_imported', true );
}

function akc_get_ads_pages() {
    return [

/* ======================================================
   1. ANTICIPATORY BAIL LAWYER PUNE
   ====================================================== */
[
'title'          => 'Anticipatory Bail Lawyer in Pune',
'slug'           => 'anticipatory-bail-lawyer-pune-ads',
'hero_title'     => 'Need Anticipatory Bail in Pune?<br><em>Get Legal Help — Right Now.</em>',
'hero_subtitle'  => 'Anticipatory bail prevents arrest before it happens. If you fear imminent arrest, call Advocate Akash Chikate immediately — same-day filing available at Pune Sessions Court or Bombay High Court.',
'hero_badge'     => 'Anticipatory Bail Specialist · Pune &amp; Bombay High Court',
'page_type'      => 'criminal',
'focus_kw'       => 'anticipatory bail lawyer pune',
'seo_title'      => 'Anticipatory Bail Lawyer in Pune — Same-Day Filing | Adv. Akash Chikate',
'seo_desc'       => 'Need an anticipatory bail lawyer in Pune? Advocate Akash Chikate files anticipatory bail at Pune Sessions Court and Bombay High Court. Available for urgent matters. Call or WhatsApp now.',
'content'        => '<h2>What is Anticipatory Bail?</h2>
<p>Anticipatory bail (Section 482, BNSS 2023) is a direction from a Sessions Court or High Court instructing police <strong>not to arrest</strong> a person in connection with a specific case. It is applied for <em>before</em> arrest — making it a proactive protection tool.</p>
<p>If you have reason to believe you may be arrested — based on an FIR filed against you, a police notice, or credible information — an anticipatory bail application can be filed immediately. You do not need to wait for the police to act.</p>

<h2>When Should You Apply?</h2>
<ul>
<li>An FIR has been registered against you at any Maharashtra police station</li>
<li>You have received a notice under Section 35 or 179 BNSS (formerly S.160 CrPC)</li>
<li>A family member or business rival has filed a complaint and police action is expected</li>
<li>You are anticipating arrest in a matrimonial dispute (498A, DV Act), financial matter, or criminal case</li>
<li>You are involved in a case where co-accused have already been arrested</li>
</ul>

<h2>Where is Anticipatory Bail Filed?</h2>
<ul>
<li><strong>Sessions Court, Pune</strong> — first application; heard within 1–3 days typically</li>
<li><strong>Bombay High Court (Pune Bench)</strong> — if Sessions Court rejects, or for urgent High Court protection</li>
<li>High Court can also be approached directly in serious matters without going to Sessions Court first</li>
</ul>

<h2>Why Choose Advocate Akash Chikate?</h2>
<ul>
<li>Regular appearance at Pune Sessions Court and Bombay High Court Pune Bench</li>
<li>27+ bail and anticipatory bail orders on Indian Kanoon (verifiable public record)</li>
<li>Personal handling — your matter is not passed to a junior</li>
<li>Available for urgent consultations — WhatsApp or call at any hour in genuine emergencies</li>
<li>LLM in Science &amp; Technology Laws; Diploma in Cyber Laws — additional expertise for tech-related FIRs</li>
</ul>

<h2>Frequently Asked Questions</h2>
<div class="ads-faq">
<div class="ads-faq-item">
  <p class="ads-faq-q"><i class="fa-solid fa-circle-question"></i> Can anticipatory bail be granted on the same day?</p>
  <p class="ads-faq-a">In urgent situations, an application can be filed and mentioned before the court for urgent hearing on the same day. The outcome depends on the court\'s schedule and the facts of the case. Same-day filing is possible; same-day hearing requires the court\'s permission.</p>
</div>
<div class="ads-faq-item">
  <p class="ads-faq-q"><i class="fa-solid fa-circle-question"></i> What if the Sessions Court rejects my application?</p>
  <p class="ads-faq-a">A rejection by the Sessions Court can be challenged before the Bombay High Court. The High Court has independent jurisdiction to grant anticipatory bail and applies a fresh mind to the matter.</p>
</div>
<div class="ads-faq-item">
  <p class="ads-faq-q"><i class="fa-solid fa-circle-question"></i> What documents are needed?</p>
  <p class="ads-faq-a">A copy of the FIR (if registered), identity proof, address proof, and a brief statement of facts. In many urgent situations, the application can be filed with minimal documents and the rest submitted thereafter.</p>
</div>
<div class="ads-faq-item">
  <p class="ads-faq-q"><i class="fa-solid fa-circle-question"></i> Does anticipatory bail protect my family members too?</p>
  <p class="ads-faq-a">Anticipatory bail is granted to a specific named person. Separate applications must be filed for each family member who apprehends arrest.</p>
</div>
</div>',
],

/* ======================================================
   2. CRIMINAL LAWYER PUNE
   ====================================================== */
[
'title'          => 'Criminal Lawyer in Pune',
'slug'           => 'criminal-lawyer-pune-ads',
'hero_title'     => 'Criminal Lawyer in Pune —<br><em>Expert. Personal. Committed.</em>',
'hero_subtitle'  => 'Facing criminal charges, an FIR, or a bail emergency? Advocate Akash Chikate provides direct criminal defence at all Pune courts and Bombay High Court — with personal attention to every case.',
'hero_badge'     => 'Criminal Defence · Bail · Bombay High Court',
'page_type'      => 'criminal',
'focus_kw'       => 'criminal lawyer pune',
'seo_title'      => 'Criminal Lawyer in Pune — Bail, FIR Quashing &amp; High Court | Adv. Akash Chikate',
'seo_desc'       => 'Looking for a criminal lawyer in Pune? Advocate Akash Chikate handles bail, anticipatory bail, FIR quashing, NDPS, cybercrime, and 498A defence at Pune Sessions Court and Bombay High Court.',
'content'        => '<h2>Criminal Defence in Pune — Experienced. Direct. Reliable.</h2>
<p>A criminal charge — whether an FIR, a police notice, or an arrest — is one of the most stressful situations a person or family can face. The decisions made in the first 24–72 hours after an FIR or arrest are often the most consequential for the outcome of the case.</p>
<p>Advocate Akash Chikate is a criminal defence lawyer based in Shivajinagar, Pune, with regular appearance before the Bombay High Court, Pune District &amp; Sessions Court, Family Court, and all subordinate courts. Every case is handled personally — there is no delegation to juniors.</p>

<h2>Practice Areas</h2>
<ul>
<li><strong>Anticipatory Bail</strong> — prevent arrest before it happens; filed at Sessions Court or Bombay High Court</li>
<li><strong>Regular Bail</strong> — after arrest at Magistrate, Sessions Court, or High Court level</li>
<li><strong>FIR Quashing</strong> — writ petitions under S.528 BNSS at Bombay High Court Pune Bench</li>
<li><strong>Criminal Trial Defence</strong> — full representation at Sessions Court and subordinate courts</li>
<li><strong>Cybercrime Defence</strong> — IT Act, online fraud, social media FIRs at Pune Cyber Cell</li>
<li><strong>498A / Domestic Violence</strong> — defence for accused and their families</li>
<li><strong>NDPS / MCOCA / POCSO</strong> — specialist defence at Sessions and High Court level</li>
<li><strong>Cheque Bounce (S.138 NI Act)</strong> — both prosecution and defence</li>
<li><strong>Corporate Fraud Defence</strong> — cheating, criminal breach of trust, EOW matters</li>
</ul>

<h2>Credentials &amp; Track Record</h2>
<ul>
<li>LLM in Science &amp; Technology Laws (First Class Distinction) — SCLC / SPPU Pune</li>
<li>Diploma in Cyber Laws</li>
<li>Licensed Advocate — Bar Council of India</li>
<li>Legal Advisor — Chemist Association, Pune</li>
<li>27+ Bombay High Court orders on Indian Kanoon (verifiable)</li>
<li>Murder conviction set aside at Bombay High Court — <em>Dilbarsingh Chauhan</em> (2025:BHC-AS:36505-DB)</li>
<li>Multiple bail grants in NDPS, POCSO, MCOCA, and trafficking matters at Bombay HC</li>
</ul>

<h2>How a Consultation Works</h2>
<ul>
<li><strong>Step 1:</strong> Call or WhatsApp — describe your situation briefly</li>
<li><strong>Step 2:</strong> Receive an immediate honest assessment of your legal position</li>
<li><strong>Step 3:</strong> If you wish to proceed, we meet at our Shivajinagar office or by phone for a detailed discussion</li>
<li><strong>Step 4:</strong> A legal strategy is prepared and court action begins</li>
</ul>
<p>First consultation is free and completely confidential.</p>

<h2>Frequently Asked Questions</h2>
<div class="ads-faq">
<div class="ads-faq-item">
  <p class="ads-faq-q"><i class="fa-solid fa-circle-question"></i> How soon can you file a bail application?</p>
  <p class="ads-faq-a">A bail application can be filed the same day in most cases. For bail emergencies — where a family member has just been arrested — call or WhatsApp immediately and we will advise you on the fastest available route.</p>
</div>
<div class="ads-faq-item">
  <p class="ads-faq-q"><i class="fa-solid fa-circle-question"></i> Do you handle matters in courts outside Pune?</p>
  <p class="ads-faq-a">Primary practice is at Pune courts and the Bombay High Court Pune Bench. Matters requiring appearance at the principal Bombay High Court in Mumbai can be discussed on a case-by-case basis.</p>
</div>
<div class="ads-faq-item">
  <p class="ads-faq-q"><i class="fa-solid fa-circle-question"></i> Is the consultation really free?</p>
  <p class="ads-faq-a">Yes. The first consultation — in person, by phone, or via WhatsApp — is free and carries no obligation whatsoever.</p>
</div>
</div>',
],

/* ======================================================
   3. BAIL LAWYER PUNE
   ====================================================== */
[
'title'          => 'Bail Lawyer in Pune',
'slug'           => 'bail-lawyer-pune-ads',
'hero_title'     => 'Bail Lawyer in Pune —<br><em>Act Fast. Every Hour Matters.</em>',
'hero_subtitle'  => 'Is a family member in police custody? Advocate Akash Chikate files bail applications at Magistrate Court, Sessions Court, and Bombay High Court. Available for bail emergencies.',
'hero_badge'     => 'Bail Applications · All Pune Courts · Bombay High Court',
'page_type'      => 'criminal',
'focus_kw'       => 'bail lawyer pune',
'seo_title'      => 'Bail Lawyer in Pune — Regular &amp; Anticipatory Bail Expert | Adv. Akash Chikate',
'seo_desc'       => 'Need a bail lawyer in Pune? Advocate Akash Chikate files regular and anticipatory bail at Pune Magistrate, Sessions Court, and Bombay High Court. Call or WhatsApp for urgent bail matters.',
'content'        => '<h2>Bail After Arrest — Immediate Legal Action</h2>
<p>When a family member is arrested, the first priority is securing their release through bail. Acting quickly — with the right legal representation — significantly improves the chances of bail being granted at the earliest hearing.</p>
<p>Advocate Akash Chikate has secured bail in hundreds of matters across a wide range of offences, from minor criminal complaints to serious charges including murder (S.302 BNS), trafficking, NDPS, POCSO, and MCOCA — both at Sessions Court and the Bombay High Court.</p>

<h2>Types of Bail Applications</h2>
<ul>
<li><strong>Regular Bail (S.483 BNSS)</strong> — filed after arrest at the Magistrate or Sessions Court level, depending on the offence</li>
<li><strong>Anticipatory Bail (S.482 BNSS)</strong> — applied for <em>before</em> arrest when arrest is anticipated</li>
<li><strong>Default Bail (S.187 BNSS)</strong> — statutory right to bail if the chargesheet is not filed within 60 or 90 days (depending on offence)</li>
<li><strong>Bail on Merits at Bombay High Court</strong> — when bail is rejected at Sessions Court, an application can be made to the High Court</li>
<li><strong>Surety / Cash Bail Compliance</strong> — assistance with completing bail bond formalities after bail is granted</li>
</ul>

<h2>Recent Bail Results at Bombay High Court</h2>
<ul>
<li><em>Dashrath Jamdade</em> — Murder (S.302) — Bail GRANTED pending appeal — 2025:BHC-AS:39949-DB</li>
<li><em>Yash Gopi</em> — Murder (S.302) — Bail GRANTED after Sessions rejection — 2025:BHC-AS:33577</li>
<li><em>Mayuri &amp; Madhuri Taak</em> — S.302 r/w 149 — Bail GRANTED pending appeal — 2025:BHC-AS:27529-DB</li>
<li><em>Siddharth Yenpure</em> — S.307 + Arms Act — Bail GRANTED — 2025:BHC-AS:37154</li>
<li><em>Santosh Dhumale</em> — S.370 Trafficking + JJ Act — Bail GRANTED after approx. 3 years — 2025:BHC-AS:37347</li>
<li><em>Pratik Kalane</em> — POCSO + S.363 — Bail GRANTED pending appeal — 2025:BHC-AS:35251</li>
</ul>
<p style="font-size:0.83rem; color:#777;"><em>All orders publicly available on Indian Kanoon. Past results are not indicative of future outcomes.</em></p>

<h2>What to Do Right Now</h2>
<ul>
<li><strong>Call or WhatsApp immediately</strong> with the name of the arrested person, the police station, and the offence if known</li>
<li>Find out which police station has custody and whether a remand hearing has been scheduled</li>
<li>Do not speak to police without a lawyer present — advise the arrested person to exercise their right to silence</li>
<li>Collect the FIR copy as soon as it is available</li>
</ul>

<h2>Frequently Asked Questions</h2>
<div class="ads-faq">
<div class="ads-faq-item">
  <p class="ads-faq-q"><i class="fa-solid fa-circle-question"></i> How long does a bail application take?</p>
  <p class="ads-faq-a">At the Magistrate level, bail applications in bailable offences can be addressed at the first remand hearing (within 24 hours of arrest). In non-bailable offences at Sessions Court, hearings are typically scheduled within 2–7 days. At the Bombay High Court, urgent bail matters can be heard on priority.</p>
</div>
<div class="ads-faq-item">
  <p class="ads-faq-q"><i class="fa-solid fa-circle-question"></i> What if bail is rejected?</p>
  <p class="ads-faq-a">A Sessions Court rejection can be challenged at the Bombay High Court. The High Court applies an independent assessment and has frequently granted bail where the Sessions Court has rejected it.</p>
</div>
<div class="ads-faq-item">
  <p class="ads-faq-q"><i class="fa-solid fa-circle-question"></i> Can you appear at weekend remand hearings?</p>
  <p class="ads-faq-a">Weekend and holiday remand hearings are possible. Contact us immediately and we will advise on the available options for your specific situation.</p>
</div>
</div>',
],

/* ======================================================
   4. NDPS DRUG CASE LAWYER PUNE
   ====================================================== */
[
'title'          => 'NDPS Drug Case Lawyer in Pune',
'slug'           => 'ndps-lawyer-pune-ads',
'hero_title'     => 'NDPS Drug Case Lawyer in Pune —<br><em>Specialist Bail &amp; Defence</em>',
'hero_subtitle'  => 'NDPS cases are complex — bail is severely restricted under Section 37 NDPS Act. Advocate Akash Chikate has experience securing NDPS bail at Bombay High Court. Get specialist legal help now.',
'hero_badge'     => 'NDPS Act Specialist · Bail &amp; Trial Defence · Bombay High Court',
'page_type'      => 'criminal',
'focus_kw'       => 'ndps lawyer pune',
'seo_title'      => 'NDPS Drug Case Lawyer in Pune — Bail &amp; High Court Defence | Adv. Akash Chikate',
'seo_desc'       => 'Facing an NDPS drug case in Pune? Advocate Akash Chikate specialises in NDPS bail at Bombay High Court and criminal trial defence. Call or WhatsApp for specialist legal help.',
'content'        => '<h2>Why NDPS Cases Need a Specialist Lawyer</h2>
<p>The Narcotic Drugs and Psychotropic Substances Act, 1985 (NDPS Act) is one of India\'s most stringent criminal statutes. Bail in NDPS cases is not a routine matter — Section 37 of the NDPS Act imposes special conditions that make bail significantly harder to obtain than in ordinary criminal cases.</p>
<p>Under Section 37, bail can only be granted if the court is satisfied that there are reasonable grounds for believing the accused is not guilty <em>and</em> that he is not likely to commit any offence while on bail. This double threshold means that NDPS bail applications require careful preparation and strong legal arguments — a generic bail application will not succeed.</p>

<h2>Key Distinctions: Small, Intermediate, and Commercial Quantity</h2>
<p>The NDPS Act treats different quantities of drugs very differently. The punishment and bail rules depend heavily on whether the seized quantity is classified as:</p>
<ul>
<li><strong>Small Quantity</strong> — lower penalties; bail application more straightforward</li>
<li><strong>Intermediate Quantity</strong> — between small and commercial; moderate approach</li>
<li><strong>Commercial Quantity</strong> — most serious; S.37 restrictions apply in full; Sessions Court bail nearly impossible; High Court route essential</li>
</ul>
<p>Correctly characterising the seized quantity and challenging the FSL (Forensic Science Laboratory) report is often a key element of the defence strategy.</p>

<h2>NDPS Defence Strategy</h2>
<ul>
<li><strong>Bail Application at Sessions Court</strong> — where S.37 conditions can arguably be met (small/intermediate quantity or special circumstances)</li>
<li><strong>Bail at Bombay High Court</strong> — when Sessions bail is refused or where commercial quantity is involved</li>
<li><strong>Challenging the Recovery</strong> — procedural safeguards under S.42, S.50, and S.55 NDPS Act must be followed; failure to comply can be fatal to the prosecution</li>
<li><strong>FSL Report Challenge</strong> — questioning the chain of custody, sample integrity, and laboratory methodology</li>
<li><strong>Bail Pending Trial</strong> — prolonged pre-trial incarceration can itself become a ground for bail where the trial is unlikely to conclude soon</li>
<li><strong>Trial Defence</strong> — full representation through the trial process at Sessions Court</li>
</ul>

<h2>Common NDPS Scenarios We Handle</h2>
<ul>
<li>Drug seizures by Pune City Police, Pimpri-Chinchwad Police, or ANC (Anti-Narcotics Cell)</li>
<li>Airport seizures at Pune International Airport</li>
<li>Ganja (cannabis), charas, MDMA, cocaine, heroin matters</li>
<li>Section 8 (possession), Section 20 (ganja), Section 21 (opium/heroin) charges</li>
<li>Linked matters involving S.302 or Arms Act charges</li>
</ul>

<h2>Frequently Asked Questions</h2>
<div class="ads-faq">
<div class="ads-faq-item">
  <p class="ads-faq-q"><i class="fa-solid fa-circle-question"></i> Is bail possible in commercial quantity NDPS cases?</p>
  <p class="ads-faq-a">It is difficult but not impossible. Several Bombay High Court benches have granted bail in commercial quantity NDPS cases where procedural violations under S.42/50 NDPS Act were established, or where the trial was significantly delayed. Each case must be assessed on its specific facts.</p>
</div>
<div class="ads-faq-item">
  <p class="ads-faq-q"><i class="fa-solid fa-circle-question"></i> What if the recovery was planted or unlawful?</p>
  <p class="ads-faq-a">If police did not follow the mandatory procedures under S.42 or S.50 NDPS Act — such as offering the accused the option to be searched before a gazetted officer or Magistrate — this can be a strong ground for both bail and acquittal at trial. These arguments need to be raised correctly and at the right stage.</p>
</div>
<div class="ads-faq-item">
  <p class="ads-faq-q"><i class="fa-solid fa-circle-question"></i> How long do NDPS trials last?</p>
  <p class="ads-faq-a">NDPS trials at the Sessions Court level can take anywhere from 1 to 5+ years depending on the complexity, number of witnesses, and court workload. Prolonged pre-trial detention can itself become a ground for bail after a point.</p>
</div>
</div>',
],

/* ======================================================
   5. MUTUAL DIVORCE LAWYER PUNE
   ====================================================== */
[
'title'          => 'Mutual Divorce Lawyer in Pune',
'slug'           => 'mutual-divorce-lawyer-pune-ads',
'hero_title'     => 'Mutual Divorce Lawyer in Pune —<br><em>Fast, Smooth &amp; Confidential</em>',
'hero_subtitle'  => 'Both spouses agree to divorce? Advocate Akash Chikate handles mutual consent divorce at Pune Family Court — with care, efficiency, and complete confidentiality. NRI / overseas cases handled.',
'hero_badge'     => 'Mutual Consent Divorce · Pune Family Court · NRI Cases',
'page_type'      => 'family',
'focus_kw'       => 'mutual divorce lawyer pune',
'seo_title'      => 'Mutual Divorce Lawyer in Pune — Fast, Confidential &amp; NRI Cases | Adv. Akash Chikate',
'seo_desc'       => 'Mutual divorce lawyer in Pune. Advocate Akash Chikate handles mutual consent divorce at Pune Family Court — including cases where one or both spouses live outside India. Call or WhatsApp.',
'content'        => '<h2>Mutual Consent Divorce — How It Works in Pune</h2>
<p>A mutual consent divorce (under Section 13B of the Hindu Marriage Act, 1955, or Section 28 of the Special Marriage Act, 1954) is the most straightforward and least adversarial way to dissolve a marriage when both spouses agree to separate.</p>
<p>The process at Pune Family Court involves two motions: the first motion (joint petition filing) and the second motion (confirmation of consent and passing of the decree). Between the two motions, there is a statutory cooling-off period of six months — though this period can be waived by the court in appropriate circumstances.</p>

<h2>The Step-by-Step Process</h2>
<ul>
<li><strong>Step 1 — Joint Petition:</strong> Both spouses sign a joint petition confirming mutual consent to divorce and agreeing on settlement terms (maintenance, property, custody if children are involved)</li>
<li><strong>Step 2 — First Motion:</strong> The petition is filed at Pune Family Court; both spouses (or their authorised representatives) appear; statements are recorded</li>
<li><strong>Step 3 — Cooling-Off Period:</strong> A minimum of 6 months must pass between the first and second motion (this may be waived in appropriate cases)</li>
<li><strong>Step 4 — Second Motion:</strong> Both spouses confirm their consent has not been withdrawn; the court passes the divorce decree</li>
</ul>

<h2>Documents Required</h2>
<ul>
<li>Original marriage certificate (or certified copy)</li>
<li>Address proof of both spouses (Aadhaar, passport, utility bill)</li>
<li>Passport-size photographs of both spouses</li>
<li>Details of any children (name, age, custody arrangement agreed)</li>
<li>Details of any jointly owned property or financial assets to be settled</li>
<li>For NRI cases: additionally, notarised / apostilled Special Power of Attorney (see section below)</li>
</ul>

<div class="ads-nri-box">
<h2>If One Spouse Resides Outside India</h2>
<p>A mutual divorce can proceed even when one — or both — spouses are living abroad. India\'s Hindu Marriage Act and Special Marriage Act do not require physical presence in India, provided proper legal authorisation is in place.</p>

<h3>Option 1 — Special Power of Attorney (Recommended)</h3>
<p>The spouse residing abroad executes a <strong>Special Power of Attorney (SPA)</strong> authorising a trusted person in India (a parent, sibling, or other family member) to:</p>
<ul>
<li>Sign and file the joint divorce petition on their behalf</li>
<li>Appear at all Family Court hearings in their place</li>
<li>Give consent statements and receive the final divorce decree</li>
</ul>

<h3>Attestation Requirements for the SPA</h3>
<ul>
<li><strong>Hague Convention countries</strong> (USA, UK, Australia, Canada, Germany, New Zealand, etc.) — the SPA must be notarised by a local Notary Public and then <strong>apostilled</strong> by the competent authority of that country (e.g., Secretary of State in USA; Notarial Faculty Office in UK)</li>
<li><strong>Non-Hague countries</strong> (UAE, Saudi Arabia, Qatar, Bahrain, Oman, Kuwait, etc.) — the SPA must be notarised and then <strong>attested by the Indian Embassy or Consulate</strong> in that country</li>
</ul>
<p>The original apostilled or consulate-attested SPA is submitted to Pune Family Court along with the divorce petition.</p>

<h3>Option 2 — Video Conferencing</h3>
<p>Pune Family Court may, in appropriate cases, permit the spouse abroad to appear via <strong>video conferencing</strong> for the statement-recording hearing (first motion). This requires a prior application to the court and is granted at the court\'s discretion. It is often used alongside the SPA route to ensure smooth proceedings.</p>

<h3>Documents Required from the Spouse Abroad</h3>
<ul>
<li>Original SPA (notarised + apostilled or consulate-attested)</li>
<li>Attested copy of passport (all relevant pages)</li>
<li>Proof of current overseas address (bank statement, utility bill, or employer letter)</li>
<li>Signed consent affidavit for the divorce (can be notarised abroad)</li>
</ul>

<h3>Timeline for NRI Mutual Divorce</h3>
<p>The process is the same as a regular mutual divorce — typically <strong>6 to 18 months</strong> from first motion to decree. The additional time, if any, is usually in arranging and apostilling the SPA. Once the SPA is in place, proceedings move at the same pace as any mutual divorce matter.</p>
<p><strong>Important:</strong> Both spouses must genuinely and independently consent to the divorce. The consent of the spouse abroad must be free and voluntary — it cannot be given under pressure or coercion.</p>
</div>

<h2>Settlement Terms — What Can Be Agreed?</h2>
<p>A mutual divorce petition should ideally address all ancillary matters to avoid future litigation:</p>
<ul>
<li><strong>Maintenance / Alimony</strong> — one-time settlement or monthly payments</li>
<li><strong>Streedhan and personal belongings</strong> — return of jewellery and items belonging to the wife</li>
<li><strong>Child custody and visitation</strong> — if minor children are involved, the arrangement must be in the children\'s best interest</li>
<li><strong>Jointly owned property</strong> — division or sale arrangement</li>
<li><strong>Withdrawal of any pending cases</strong> — 498A, DV Act, or other matrimonial FIRs / cases should ideally be settled simultaneously</li>
</ul>

<h2>Frequently Asked Questions</h2>
<div class="ads-faq">
<div class="ads-faq-item">
  <p class="ads-faq-q"><i class="fa-solid fa-circle-question"></i> Can the 6-month waiting period be waived?</p>
  <p class="ads-faq-a">Yes, in appropriate cases. The Supreme Court in <em>Amardeep Singh v. Harveen Kaur</em> (2017) held that the 6-month cooling-off period is not mandatory and can be waived by the court if the parties have been living separately for a long period and all efforts at reconciliation have failed. An application for waiver can be filed at the time of the first motion.</p>
</div>
<div class="ads-faq-item">
  <p class="ads-faq-q"><i class="fa-solid fa-circle-question"></i> What if one spouse changes their mind before the second motion?</p>
  <p class="ads-faq-a">Either party can withdraw their consent at any time before the second motion. If consent is withdrawn, the mutual divorce petition fails and cannot proceed as a mutual divorce. The parties would need to pursue a contested divorce on other grounds.</p>
</div>
<div class="ads-faq-item">
  <p class="ads-faq-q"><i class="fa-solid fa-circle-question"></i> Can a mutual divorce be filed if there are children?</p>
  <p class="ads-faq-a">Yes. The petition must include agreed arrangements for custody, visitation rights, and maintenance of the children. The court will consider whether the agreed arrangement is in the children\'s best interest before passing the decree.</p>
</div>
<div class="ads-faq-item">
  <p class="ads-faq-q"><i class="fa-solid fa-circle-question"></i> Will my matter be kept confidential?</p>
  <p class="ads-faq-a">Family Court proceedings in India are conducted in-camera (i.e., not open to the public). Your matter will be handled with complete discretion — no details will be shared with anyone outside the legal process.</p>
</div>
</div>',
],

    ]; // end all 5 ads pages
}
