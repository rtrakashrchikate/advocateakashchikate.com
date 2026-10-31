<?php
/**
 * Plugin Name: AKC Data Importer
 * Description: One-time importer — creates all 18 Practice Area posts for advocateakashchikate.com. Deactivate & delete after use.
 * Version: 1.0.0
 * Author: Advocate Akash Chikate Site
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/* ── Run import on activation ── */
register_activation_hook( __FILE__, 'akc_import_all_data' );

/* ── Also add admin notice with a manual trigger button ── */
add_action( 'admin_notices', 'akc_importer_notice' );
add_action( 'admin_init',    'akc_handle_manual_import' );

function akc_importer_notice() {
    if ( ! current_user_can( 'manage_options' ) ) return;
    $done = get_option( 'akc_import_done' );
    if ( $done ) {
        echo '<div class="notice notice-success"><p><strong>AKC Importer:</strong> All 18 Practice Area pages have been created successfully! You can now deactivate and delete this plugin.</p></div>';
    } else {
        echo '<div class="notice notice-warning"><p><strong>AKC Importer:</strong> Practice Area pages not yet created. <a href="' . esc_url( admin_url( '?akc_run_import=1&_wpnonce=' . wp_create_nonce('akc_import') ) ) . '" class="button button-primary">Create All 18 Practice Areas Now</a></p></div>';
    }
}

function akc_handle_manual_import() {
    if ( isset( $_GET['akc_run_import'] ) && wp_verify_nonce( $_GET['_wpnonce'], 'akc_import' ) && current_user_can( 'manage_options' ) ) {
        akc_import_all_data();
        wp_redirect( admin_url() );
        exit;
    }
}

function akc_import_all_data() {
    if ( get_option( 'akc_import_done' ) ) return;

    $practice_areas = akc_get_practice_areas_data();

    foreach ( $practice_areas as $pa ) {
        // Check if already exists
        $existing = get_page_by_path( $pa['slug'], OBJECT, 'practice_area' );
        if ( $existing ) continue;

        $post_id = wp_insert_post([
            'post_type'    => 'practice_area',
            'post_title'   => $pa['title'],
            'post_name'    => $pa['slug'],
            'post_content' => $pa['content'],
            'post_status'  => 'publish',
            'menu_order'   => $pa['order'],
        ]);

        if ( $post_id && ! is_wp_error( $post_id ) ) {
            update_post_meta( $post_id, 'akc_pa_icon',    $pa['icon'] );
            update_post_meta( $post_id, 'akc_pa_tier',    $pa['tier'] );
            update_post_meta( $post_id, 'akc_pa_summary', $pa['summary'] );
            update_post_meta( $post_id, 'akc_pa_anchor',  $pa['anchor'] );
            if ( ! empty( $pa['faqs'] ) ) {
                update_post_meta( $post_id, 'akc_pa_faqs', wp_json_encode( $pa['faqs'] ) );
            }
            // Rank Math SEO meta
            if ( ! empty( $pa['seo_title'] ) ) {
                update_post_meta( $post_id, 'rank_math_title',          $pa['seo_title'] );
                update_post_meta( $post_id, 'rank_math_description',    $pa['seo_desc'] );
                update_post_meta( $post_id, 'rank_math_focus_keyword',  $pa['focus_kw'] );
            }
        }
    }

    update_option( 'akc_import_done', true );
}

/* ═══════════════════════════════════════════════════════
   ALL 18 PRACTICE AREAS DATA
═══════════════════════════════════════════════════════ */
function akc_get_practice_areas_data() {
    return [

/* ── 1. ANTICIPATORY BAIL ── TIER 1 ── */
[
'title'    => 'Anticipatory Bail in Pune',
'slug'     => 'anticipatory-bail',
'icon'     => 'fa-solid fa-shield-halved',
'tier'     => '1',
'order'    => 1,
'anchor'   => 'anticipatory-bail',
'summary'  => 'Pre-arrest protection under S.482 BNSS. Emergency anticipatory bail at Sessions Court & Bombay High Court, Pune.',
'focus_kw' => 'anticipatory bail Pune',
'seo_title'=> 'Anticipatory Bail Lawyer in Pune | S.482 BNSS | Adv. Akash Chikate',
'seo_desc' => 'Experienced anticipatory bail lawyer in Pune. Emergency applications at Sessions Court & Bombay High Court under S.482 BNSS. Call Adv. Akash Chikate now.',
'content'  => '<h2>What is Anticipatory Bail?</h2>
<p>Anticipatory bail (also called pre-arrest bail) is a legal protection granted by a court <strong>before a person is arrested</strong>. It is governed by <strong>Section 482 of the Bharatiya Nagarik Suraksha Sanhita, 2023 (BNSS)</strong> — formerly Section 438 of CrPC.</p>
<p>When anticipatory bail is granted, the police cannot arrest the applicant without first informing the court and the advocate. It is one of the most powerful protective remedies in criminal law.</p>

<h2>When Should You Apply for Anticipatory Bail?</h2>
<ul>
<li>You have received a police notice or summons</li>
<li>You apprehend arrest in connection with a criminal case</li>
<li>An FIR has been registered against you or your name appears in an FIR</li>
<li>A family member or business rival has threatened to file a false complaint</li>
<li>You are involved in a matrimonial dispute with 498A risk</li>
<li>You have been called for questioning by police or EOW/CID</li>
</ul>

<h2>Courts Where Anticipatory Bail Can Be Filed</h2>
<ul>
<li><strong>Sessions Court, Pune</strong> — First option; faster hearing</li>
<li><strong>Bombay High Court</strong> — When Sessions Court rejects, or for complex matters</li>
</ul>

<h2>What Adv. Akash R. Chikate Does for You</h2>
<div class="service-bullets">
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span>Emergency consultation — same day if needed</span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span>Draft anticipatory bail application with strongest possible grounds</span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span>File at Sessions Court or Bombay High Court based on strategy</span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span>Appear and argue before the court on your behalf</span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span>Ensure conditions of bail are reasonable and manageable</span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span>Available 24/7 for bail emergencies</span></div>
</div>

<h2>Verified Bombay High Court Orders — Anticipatory Bail</h2>
<p>Adv. Akash Chikate has secured anticipatory bail and related protections in multiple matters at the Bombay High Court, including:</p>
<ul>
<li><strong>Gopalan Anish</strong> — EOW Financial Crime — Interim protection + ₹1Cr deposit secured (2025)</li>
<li><strong>Shaibaz Sayyed</strong> — SC/ST Atrocities Act — Anticipatory bail granted — Crl Appeal (ST) 14342/2025</li>
</ul>
<p><em>All orders verifiable on <a href="https://indiankanoon.org/search/?formInput=Akash+Chikate" target="_blank" rel="noopener">Indian Kanoon</a>.</em></p>',
'faqs' => [
    ['q' => 'What is the difference between anticipatory bail and regular bail?', 'a' => 'Anticipatory bail (S.482 BNSS) is granted <em>before</em> arrest — it prevents arrest. Regular bail (S.483 BNSS) is applied for after arrest to secure release from custody.'],
    ['q' => 'How quickly can anticipatory bail be obtained in Pune?', 'a' => 'An urgent anticipatory bail application can be filed and heard within 1–3 days at Sessions Court. In genuine emergencies, courts can take up urgent matters on the same day. Adv. Akash Chikate handles emergency filings.'],
    ['q' => 'Can anticipatory bail be rejected?', 'a' => 'Yes. If the Sessions Court rejects it, you can approach the Bombay High Court. Each court evaluates the application independently based on the facts, gravity of the offence, and likelihood of tampering with evidence.'],
    ['q' => 'What are the conditions usually imposed with anticipatory bail?', 'a' => 'Common conditions include: (1) Reporting to the police station periodically, (2) Not leaving the jurisdiction without permission, (3) Surrendering passport, (4) Cooperating with the investigation.'],
],
],

/* ── 2. REGULAR BAIL ── TIER 1 ── */
[
'title'    => 'Bail Application Lawyer in Pune',
'slug'     => 'bail-application',
'icon'     => 'fa-solid fa-lock-open',
'tier'     => '1',
'order'    => 2,
'anchor'   => 'bail',
'summary'  => 'Emergency bail at Sessions Court & Bombay High Court. S.483 BNSS bail applications handled urgently for all offences.',
'focus_kw' => 'bail lawyer Pune',
'seo_title'=> 'Bail Lawyer in Pune | Emergency Bail Application | Adv. Akash Chikate',
'seo_desc' => 'Emergency bail lawyer in Pune. Bail applications at Sessions Court & Bombay High Court under S.483 BNSS. Available 24/7 for bail emergencies. Call now.',
'content'  => '<h2>Emergency Bail Application in Pune</h2>
<p>Being arrested is one of the most traumatic experiences a person can face. Every hour in custody matters. Advocate Akash R. Chikate provides <strong>emergency bail representation</strong> at the Sessions Court, Bombay High Court, and JMFC courts in Pune — available 24/7 for urgent matters.</p>

<h2>Types of Bail</h2>
<ul>
<li><strong>Regular Bail (S.483 BNSS)</strong> — After arrest, to secure release pending trial</li>
<li><strong>Anticipatory Bail (S.482 BNSS)</strong> — Before arrest, to prevent arrest</li>
<li><strong>Default Bail (S.187 BNSS)</strong> — When investigation is not completed within statutory time limit</li>
<li><strong>Interim Bail</strong> — Temporary bail granted while main application is pending</li>
</ul>

<h2>Bail in Different Types of Cases</h2>
<div class="service-bullets">
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>Murder / S.103 BNS</strong> — Bail at Sessions Court or Bombay HC</span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>NDPS Act</strong> — Bail with special grounds under S.37 NDPS</span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>POCSO Act</strong> — Bail with strict conditions and court scrutiny</span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>S.85 BNS (498A IPC)</strong> — Matrimonial offences bail</span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>MCOCA / Organised Crime</strong> — HC bail with detailed grounds</span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>SC/ST Atrocities Act</strong> — ABA at Sessions / HC level</span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>Cheque Bounce (S.138 NI Act)</strong> — Bail and defence</span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>EOW / Financial Crimes</strong> — Bail with protective conditions</span></div>
</div>

<h2>Verified Bombay High Court Bail Orders</h2>
<p>Adv. Akash Chikate has secured bail in multiple serious criminal matters at the Bombay High Court, including:</p>
<ul>
<li><strong>Dilbarsingh Chauhan</strong> — S.302 Murder — Conviction Set Aside → S.304 Pt.I — 2025:BHC-AS:36505-DB</li>
<li><strong>Dashrath Jamdade</strong> — S.302 Murder — Bail granted pending appeal — 2025:BHC-AS:39949-DB</li>
<li><strong>Yash Gopi</strong> — S.302 Murder — Bail granted after Sessions rejection — 2025:BHC-AS:33577</li>
<li><strong>Siddharth Yenpure</strong> — S.307 + Arms Act — Bail granted (S.483 BNSS) — 2025:BHC-AS:37154</li>
<li><strong>Santosh Dhumale</strong> — S.370 Trafficking + JJ Act — Bail granted after ~3 years — 2025:BHC-AS:37347</li>
<li><strong>Pratik Kalane</strong> — POCSO + S.363 — Bail granted pending appeal — 2025:BHC-AS:35251</li>
</ul>
<p><em>All orders verifiable on <a href="https://indiankanoon.org/search/?formInput=Akash+Chikate" target="_blank" rel="noopener">Indian Kanoon</a>.</em></p>',
'faqs' => [
    ['q' => 'How quickly can bail be obtained after arrest in Pune?', 'a' => 'For bailable offences, bail should be granted at the police station itself. For non-bailable offences, a bail application is filed before the Magistrate or Sessions Court — typically within 24–48 hours of filing. Adv. Akash Chikate handles emergency bail matters on the same day.'],
    ['q' => 'What happens if bail is rejected at the Sessions Court?', 'a' => 'You can approach the Bombay High Court for bail. The High Court considers the matter afresh and can grant bail even after a Sessions Court rejection, if there are strong grounds.'],
    ['q' => 'Can bail be cancelled after it is granted?', 'a' => 'Yes. Bail can be cancelled if the accused violates bail conditions, threatens witnesses, tampers with evidence, or commits another offence while on bail. It is important to strictly comply with all bail conditions.'],
],
],

/* ── 3. FIR QUASHING ── TIER 1 ── */
[
'title'    => 'FIR Quashing at Bombay High Court',
'slug'     => 'fir-quashing',
'icon'     => 'fa-solid fa-file-circle-xmark',
'tier'     => '1',
'order'    => 3,
'anchor'   => 'fir-quashing',
'summary'  => 'Writ petitions under S.528 BNSS at Bombay High Court to quash false or malicious FIRs in Pune and Maharashtra.',
'focus_kw' => 'FIR quashing Bombay High Court Pune',
'seo_title'=> 'FIR Quashing Lawyer Pune | Bombay High Court | S.528 BNSS | Adv. Akash Chikate',
'seo_desc' => 'Expert FIR quashing lawyer at Bombay High Court. Writ petitions under S.528 BNSS for false, malicious or frivolous FIRs from Pune, Maharashtra. Call now.',
'content'  => '<h2>What is FIR Quashing?</h2>
<p>FIR Quashing is the legal process of <strong>having an FIR cancelled or set aside by the High Court</strong>. The Bombay High Court has inherent powers under <strong>Section 528 of BNSS 2023</strong> (formerly S.482 CrPC) to quash an FIR if it is filed with mala fide intent, is frivolous, or if continuing proceedings would be an abuse of the process of law.</p>

<h2>Grounds for FIR Quashing</h2>
<ul>
<li>The FIR is filed with <strong>malicious or vindictive intent</strong></li>
<li>The allegations do not constitute any cognizable offence</li>
<li>The dispute is <strong>purely civil in nature</strong> being given criminal colour</li>
<li>The parties have <strong>amicably settled</strong> the dispute</li>
<li>The FIR is filed against a family member in a <strong>matrimonial dispute</strong></li>
<li>There is a <strong>double jeopardy</strong> situation (tried twice for same offence)</li>
<li>The FIR involves a <strong>compoundable offence</strong> and parties have compromised</li>
<li>The complaint is filed <strong>beyond the limitation period</strong></li>
</ul>

<h2>Process for FIR Quashing at Bombay High Court</h2>
<div class="service-bullets">
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>Step 1:</strong> Detailed consultation and case evaluation</span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>Step 2:</strong> Draft writ petition with grounds and supporting documents</span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>Step 3:</strong> File writ petition at Bombay High Court (Aurangabad Bench if applicable)</span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>Step 4:</strong> Apply for interim stay of investigation/arrest</span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>Step 5:</strong> Appear and argue before the HC bench</span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>Step 6:</strong> Secure quashing order</span></div>
</div>

<h2>Verified HC Order</h2>
<p><strong>Rupesh Marne</strong> — MCOCA + BNSS — Proclamation Stayed via Writ Petition at Bombay High Court — 2025:BHC-AS:29231</p>
<p><em>Verifiable on <a href="https://indiankanoon.org/search/?formInput=Akash+Chikate" target="_blank" rel="noopener">Indian Kanoon</a>.</em></p>',
'faqs' => [
    ['q' => 'Can all FIRs be quashed?', 'a' => 'No. FIRs involving serious offences like murder, rape, or offences against the state are generally not quashed. The High Court exercises its power judiciously. FIRs in matrimonial disputes, false complaints, civil matters given criminal colour, and compoundable offences have the best prospects.'],
    ['q' => 'How long does FIR quashing take at Bombay High Court?', 'a' => 'The process typically takes 3–12 months depending on court schedule, complexity of the matter, and whether an interim stay is granted. Adv. Akash Chikate applies for interim protection at the time of filing to protect the client while the main petition is pending.'],
    ['q' => 'Can I get an interim stay on investigation while the quashing petition is pending?', 'a' => 'Yes. The High Court can grant an interim stay on investigation, arrest, or further proceedings while the quashing petition is pending. This is applied for at the time of filing.'],
],
],

/* ── 4. CRIMINAL DEFENCE ── TIER 1 ── */
[
'title'    => 'Criminal Defence Lawyer in Pune',
'slug'     => 'criminal-defence',
'icon'     => 'fa-solid fa-gavel',
'tier'     => '1',
'order'    => 4,
'anchor'   => 'criminal',
'summary'  => 'Aggressive criminal defence at all stages — from FIR to acquittal. Bombay High Court & Sessions Court, Pune.',
'focus_kw' => 'criminal lawyer Pune',
'seo_title'=> 'Criminal Defence Lawyer in Pune | Bombay High Court | Adv. Akash Chikate',
'seo_desc' => 'Experienced criminal defence attorney in Pune. Expert representation at Bombay High Court, Sessions Court & JMFC. Bail, FIR quashing, criminal trials. Call now.',
'content'  => '<h2>Expert Criminal Defence in Pune</h2>
<p>Criminal charges can destroy your reputation, freedom, and future in an instant. Advocate Akash R. Chikate provides <strong>aggressive, strategic criminal defence representation</strong> at every stage — from the moment of FIR registration through trial and appeal.</p>

<h2>Criminal Defence Services</h2>
<div class="service-bullets">
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>Bail &amp; Anticipatory Bail</strong> — Emergency bail at Sessions Court and Bombay High Court</span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>FIR Quashing (S.528 BNSS)</strong> — Writ petitions at Bombay High Court</span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>Criminal Trial Defence</strong> — JMFC, Sessions Court, and Special Courts</span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>NDPS Act Cases</strong> — Drug offence defence and bail matters</span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>POCSO Act Defence</strong> — Sensitive cases requiring expert handling</span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>Criminal Appeals &amp; Revision</strong> — High Court criminal appeals</span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>Discharge Applications</strong> — Before framing of charge</span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>S.85 BNS (498A)</strong> — Domestic Violence Defence</span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>Cheque Bounce (NI Act S.138)</strong> — Defence and representation</span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>Murder &amp; Culpable Homicide</strong> — BNS S.103/104 defence</span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>MCOCA / Organised Crime</strong> — Complex multi-accused matters</span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>Illegal Arrest</strong> — Habeas corpus &amp; rights protection</span></div>
</div>

<h2>Landmark Results at Bombay High Court (2025)</h2>
<ul>
<li><strong>Dilbarsingh Chauhan</strong> — Murder conviction <strong>set aside</strong> → Culpable Homicide Pt.I — 2025:BHC-AS:36505-DB</li>
<li><strong>Dashrath Jamdade</strong> — S.302 Murder — Bail granted pending appeal — 2025:BHC-AS:39949-DB</li>
<li><strong>Yash Gopi</strong> — S.302 Murder — Bail granted after Sessions rejection — 2025:BHC-AS:33577</li>
<li><strong>Mayuri &amp; Madhuri Taak</strong> — S.302 r/w 149 — Bail granted pending appeal — 2025:BHC-AS:27529-DB</li>
<li><strong>Siddharth Yenpure</strong> — S.307 + Arms Act — Bail granted — 2025:BHC-AS:37154</li>
<li><strong>Santosh Dhumale</strong> — S.370 Trafficking + JJ Act — Bail granted after ~3 years — 2025:BHC-AS:37347</li>
<li><strong>Pratik Kalane</strong> — POCSO + S.363 — Bail granted pending appeal — 2025:BHC-AS:35251</li>
<li><strong>Rupesh Marne</strong> — MCOCA + BNSS — Proclamation Stayed — 2025:BHC-AS:29231</li>
</ul>',
'faqs' => [
    ['q' => 'What is the first thing to do when arrested in India?', 'a' => 'Under Article 22 of the Constitution: (1) You have the right to know the grounds of arrest. (2) You have the right to consult a lawyer immediately. (3) You must be produced before a Magistrate within 24 hours. (4) Do NOT sign any statement or document without your lawyer present. Call a criminal lawyer immediately — the first 24 hours are critical.'],
    ['q' => 'What is a discharge application in a criminal case?', 'a' => 'A discharge application is filed before the framing of charge in a Sessions Court case. If there is insufficient evidence or the case does not make out a prima facie offence, the court can discharge the accused — meaning the trial does not proceed against them.'],
    ['q' => 'Can a murder conviction be appealed?', 'a' => 'Yes. A conviction by the Sessions Court can be challenged through a criminal appeal at the Bombay High Court. Adv. Akash Chikate has successfully had a murder conviction set aside at the Bombay High Court (Dilbarsingh Chauhan — 2025:BHC-AS:36505-DB).'],
],
],

/* ── 5. NDPS DEFENCE ── TIER 2 ── */
[
'title'    => 'NDPS Drug Offence Defence Pune',
'slug'     => 'ndps-drug-offence-defence',
'icon'     => 'fa-solid fa-capsules',
'tier'     => '2',
'order'    => 5,
'anchor'   => 'ndps',
'summary'  => 'Expert NDPS Act defence in Pune. Bail under S.37 NDPS, discharge applications, and trial defence in drug cases.',
'focus_kw' => 'NDPS lawyer Pune',
'seo_title'=> 'NDPS Drug Case Lawyer in Pune | S.37 Bail | Adv. Akash Chikate',
'seo_desc' => 'Expert NDPS Act lawyer in Pune. Bail under S.37 NDPS, discharge, trial defence and HC appeals in drug offence cases. Call Adv. Akash Chikate now.',
'content'  => '<h2>NDPS Act Defence in Pune</h2>
<p>The Narcotic Drugs and Psychotropic Substances Act, 1985 (NDPS Act) imposes <strong>harsh mandatory minimum sentences</strong> — including 10 years to life imprisonment for commercial quantity offences. Bail in NDPS matters is extremely difficult to obtain due to the stringent conditions under <strong>Section 37 of the NDPS Act</strong>.</p>
<p>An experienced NDPS defence lawyer is essential from the moment of arrest.</p>

<h2>NDPS Defence Services</h2>
<div class="service-bullets">
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>Bail under S.37 NDPS</strong> — Showing reasonable grounds for innocence</span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>Default Bail (S.187 BNSS)</strong> — When investigation is not completed in time</span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>Challenge to Search &amp; Seizure</strong> — S.50 NDPS procedural compliance</span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>Challenge to Sampling Procedure</strong> — S.52A NDPS compliance</span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>Discharge Application</strong> — Before framing of charge</span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>Trial Defence</strong> — Cross-examination of police witnesses</span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>Bombay High Court Appeals</strong> — Against conviction or sentence</span></div>
</div>',
'faqs' => [
    ['q' => 'Is bail possible in NDPS cases?', 'a' => 'Bail in NDPS cases is very difficult. Under S.37 NDPS, the court must be satisfied that there are reasonable grounds to believe the accused is not guilty AND that they will not commit any offence while on bail. However, bail is possible with strong grounds, especially for small quantities or procedural violations.'],
    ['q' => 'What is the difference between small, intermediate, and commercial quantity in NDPS?', 'a' => 'For each drug, the government has specified small quantity (attracts up to 1 year), intermediate quantity (1–10 years), and commercial quantity (rigorous 10 years to life). The quantity allegedly found determines the severity of punishment and difficulty of bail.'],
],
],

/* ── 6. POCSO DEFENCE ── TIER 2 ── */
[
'title'    => 'POCSO Act Defence Lawyer Pune',
'slug'     => 'pocso-defence',
'icon'     => 'fa-solid fa-child-reaching',
'tier'     => '2',
'order'    => 6,
'anchor'   => 'pocso',
'summary'  => 'Sensitive, expert POCSO Act defence in Pune. Bail applications and trial representation in Special POCSO Courts.',
'focus_kw' => 'POCSO lawyer Pune',
'seo_title'=> 'POCSO Defence Lawyer Pune | Special Court | Adv. Akash Chikate',
'seo_desc' => 'Expert POCSO Act defence lawyer in Pune. Bail applications and trial defence in Special POCSO Courts. Confidential consultation. Call Adv. Akash Chikate.',
'content'  => '<h2>POCSO Act Defence — Sensitive Matters Handled Confidentially</h2>
<p>The Protection of Children from Sexual Offences Act, 2012 (POCSO Act) deals with sexual offences against children below 18 years. Cases under POCSO are tried before <strong>Special Courts</strong> with expedited procedures and strict protections for the child complainant.</p>
<p>False POCSO complaints are not uncommon — often arising from family disputes, custody battles, or personal vendettas. Every accused has the right to a fair defence.</p>

<h2>POCSO Defence Services</h2>
<div class="service-bullets">
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>Bail Application in POCSO matters</strong> — Special Court &amp; Bombay HC</span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>Challenge to Complainant Age</strong> — Medical &amp; documentary evidence</span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>Cross-Examination Strategy</strong> — Careful, lawful questioning</span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>Discharge Applications</strong></span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>Trial Defence</strong> at Special POCSO Court</span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>Bombay HC Appeals</strong> against conviction or sentence</span></div>
</div>

<h2>Verified Result</h2>
<p><strong>Pratik Kalane</strong> — POCSO + S.363 — Bail granted pending appeal — 2025:BHC-AS:35251 (Bombay High Court)</p>',
'faqs' => [
    ['q' => 'Can bail be granted in POCSO cases?', 'a' => 'Yes, bail in POCSO matters is possible but requires strong grounds. Adv. Akash Chikate has secured bail in POCSO matters at the Bombay High Court (Pratik Kalane — 2025:BHC-AS:35251).'],
    ['q' => 'What if the POCSO complaint is false?', 'a' => 'False POCSO complaints must be challenged strategically — through bail, discharge applications, and careful cross-examination during trial. An experienced POCSO defence lawyer can identify inconsistencies and build a strong defence.'],
],
],

/* ── 7. 498A DEFENCE ── TIER 2 ── */
[
'title'    => '498A & Domestic Violence Defence Pune',
'slug'     => '498a-domestic-violence-defence',
'icon'     => 'fa-solid fa-house-circle-exclamation',
'tier'     => '2',
'order'    => 7,
'anchor'   => '498a',
'summary'  => 'Expert 498A and domestic violence defence for husbands and in-laws falsely accused in matrimonial disputes in Pune.',
'focus_kw' => '498A lawyer Pune',
'seo_title'=> '498A Defence Lawyer Pune | Domestic Violence | Adv. Akash Chikate',
'seo_desc' => '498A and domestic violence defence lawyer in Pune. Expert representation for husbands and in-laws in false dowry harassment cases. Call now for free consultation.',
'content'  => '<h2>498A & Domestic Violence Defence in Pune</h2>
<p>Section 85 of the Bharatiya Nyaya Sanhita, 2023 (formerly S.498A IPC) — dowry harassment — is one of the most commonly misused criminal provisions in matrimonial disputes in India. The offence is <strong>cognizable and non-bailable</strong>, which means immediate arrest is possible.</p>
<p>False 498A cases can destroy careers, families, and reputations. Adv. Akash Chikate provides aggressive defence for those falsely accused.</p>

<h2>Defence Services</h2>
<div class="service-bullets">
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>Anticipatory Bail</strong> — Before arrest in 498A matters</span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>Regular Bail</strong> — After arrest</span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>FIR Quashing at Bombay HC</strong> — When complaint is false or settled</span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>DV Act (PWDVA) Defence</strong> — Contesting protection orders</span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>Maintenance Defence</strong> — Opposing unreasonable maintenance claims</span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>Trial Defence</strong> — Sessions Court representation</span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>Settlement Negotiation</strong> — When both parties agree to resolve</span></div>
</div>',
'faqs' => [
    ['q' => 'Can a 498A FIR be quashed?', 'a' => 'Yes. The Bombay High Court can quash a 498A FIR under S.528 BNSS, especially when the dispute has been settled between the parties or the complaint is clearly false or motivated. Many 498A quashings happen after the couple reaches an agreement.'],
    ['q' => 'Is arrest mandatory in 498A cases?', 'a' => 'Not necessarily. The Supreme Court in Arnesh Kumar v. State of Bihar (2014) issued guidelines directing police not to arrest automatically in 498A cases. Anticipatory bail before arrest is a strong protective measure.'],
],
],

/* ── 8. CYBER & IT LAW ── TIER 2 ── */
[
'title'    => 'Cyber & IT Law Advocate Pune',
'slug'     => 'cyber-it-law',
'icon'     => 'fa-solid fa-wifi',
'tier'     => '2',
'order'    => 8,
'anchor'   => 'cyber',
'summary'  => 'Expert cyber law defence in Pune. IT Act violations, cybercrime FIRs, digital evidence challenges, and online fraud defence.',
'focus_kw' => 'cybercrime lawyer Pune',
'seo_title'=> 'Cybercrime & IT Law Lawyer Pune | IT Act Defence | Adv. Akash Chikate',
'seo_desc' => 'Expert cyber law and IT Act defence lawyer in Pune. Cybercrime FIRs, online fraud, digital evidence, data privacy. LLM Cyber Laws. Call now.',
'content'  => '<h2>Cyber Law & IT Act Defence in Pune</h2>
<p>Cybercrime allegations are complex, fast-moving, and can have severe consequences. Advocate Akash R. Chikate holds an <strong>LLM in Science &amp; Technology Laws (First Class Distinction)</strong> and a <strong>Diploma in Cyber Laws</strong> — providing deep expertise in IT Act 2000 offences.</p>

<h2>Cyber Law Services</h2>
<div class="service-bullets">
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>Cybercrime FIR Defence</strong> — IT Act S.66, 66C, 66D, 66E, 67</span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>Online Fraud &amp; Hacking Defence</strong></span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>Cyber Defamation &amp; Social Media Cases</strong></span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>Data Theft &amp; Privacy Violations</strong></span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>Digital Evidence Challenges</strong> — Admissibility under BSA 2023</span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>Cryptocurrency &amp; Fintech Legal Issues</strong></span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>Corporate Data Security Advisory</strong></span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>IT Act Compliance &amp; Policy</strong></span></div>
</div>',
'faqs' => [
    ['q' => 'What should I do immediately after receiving a cybercrime notice?', 'a' => 'Do not ignore it. Do not delete any digital data. Do not share passwords. Do not post anything on social media about the matter. Contact a cyber law advocate immediately. Adv. Akash Chikate offers emergency cybercrime consultations.'],
    ['q' => 'Can digital evidence be challenged in court?', 'a' => 'Yes. Digital evidence must comply with the Bharatiya Sakshya Adhiniyam 2023 (BSA). Certificate requirements under S.63 BSA, chain of custody, and metadata integrity can all be challenged. Adv. Akash Chikate has expertise in digital evidence admissibility challenges.'],
],
],

/* ── 9. FAMILY LAW ── TIER 2 ── */
[
'title'    => 'Family & Divorce Lawyer Pune',
'slug'     => 'family-law-divorce',
'icon'     => 'fa-solid fa-house-heart',
'tier'     => '2',
'order'    => 9,
'anchor'   => 'family',
'summary'  => 'Sensitive family law representation in Pune — divorce, custody, maintenance, domestic violence, and 498A defence at Family Court.',
'focus_kw' => 'divorce lawyer Pune',
'seo_title'=> 'Family Law & Divorce Lawyer Pune | Family Court | Adv. Akash Chikate',
'seo_desc' => 'Expert family and divorce lawyer in Pune. Mutual divorce, contested divorce, child custody, maintenance, 498A defence at Pune Family Court. Call now.',
'content'  => '<h2>Family & Matrimonial Law in Pune</h2>
<p>Family legal matters are deeply personal and emotionally difficult. Adv. Akash R. Chikate handles every family case with <strong>sensitivity, discretion, and the strategic expertise</strong> needed to protect your interests and those of your children.</p>

<h2>Family Law Services</h2>
<div class="service-bullets">
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>Mutual Consent Divorce (S.13B HMA)</strong> — Streamlined process at Pune Family Court</span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>Contested Divorce (S.13 HMA)</strong> — Strong representation for petitioner or respondent</span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>Child Custody &amp; Guardianship</strong></span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>Maintenance (S.144 BNSS)</strong> — Claims and opposition</span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>Domestic Violence (PWDVA)</strong> — Protection orders &amp; DV Act cases</span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>498A / S.85 BNS Defence</strong> — False dowry harassment cases</span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>Matrimonial Property Disputes</strong></span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>NRI Divorce &amp; International Custody</strong></span></div>
</div>',
'faqs' => [
    ['q' => 'How long does mutual divorce take at Pune Family Court?', 'a' => 'Mutual consent divorce under S.13B HMA typically takes 6–18 months at Pune Family Court. The Supreme Court has allowed waiver of the 6-month cooling-off period in genuine cases where the marriage has irretrievably broken down.'],
    ['q' => 'What factors does the court consider for child custody?', 'a' => 'The paramount consideration is the <em>best interests of the child</em>. Courts consider the child\'s age, education, emotional bond with each parent, financial stability, and the child\'s own wishes (if old enough). Mothers generally get custody of young children; older children\'s preferences are given weight.'],
],
],

/* ── 10. MCOCA DEFENCE ── TIER 2 ── */
[
'title'    => 'MCOCA Defence Lawyer Pune',
'slug'     => 'mcoca-defence',
'icon'     => 'fa-solid fa-shield-halved',
'tier'     => '2',
'order'    => 10,
'anchor'   => 'mcoca',
'summary'  => 'Expert MCOCA bail and defence in Pune. Bombay High Court representation in organised crime matters under MCOCA 1999.',
'focus_kw' => 'MCOCA lawyer Pune',
'seo_title'=> 'MCOCA Defence Lawyer Pune | Bombay High Court | Adv. Akash Chikate',
'seo_desc' => 'Expert MCOCA defence lawyer in Pune. Bail at Bombay High Court, challenge to invocation, discharge applications. Call Adv. Akash Chikate for MCOCA matters.',
'content'  => '<h2>MCOCA Defence in Pune</h2>
<p>The Maharashtra Control of Organised Crime Act, 1999 (MCOCA) is one of the most stringent criminal laws in Maharashtra. Bail in MCOCA matters can only be granted by the <strong>Bombay High Court</strong> — not the Sessions Court. The standard of proof for bail is extremely high.</p>

<h2>MCOCA Defence Services</h2>
<div class="service-bullets">
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>Bail at Bombay High Court</strong> — MCOCA bail applications</span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>Challenge to Invocation of MCOCA</strong> — Questioning the legal basis for invoking MCOCA</span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>Discharge Applications</strong> — Before framing of charge</span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>Writ Petitions</strong> — Challenging arrest, remand, and procedure</span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>Trial Representation</strong> — MCOCA Special Court</span></div>
</div>

<h2>Verified HC Order</h2>
<p><strong>Rupesh Marne</strong> — MCOCA + BNSS — Proclamation Stayed via Writ Petition — 2025:BHC-AS:29231 (Bombay High Court)</p>',
'faqs' => [
    ['q' => 'Who can grant bail in MCOCA cases?', 'a' => 'Only the Bombay High Court can grant bail in MCOCA matters. The Sessions Court has no jurisdiction to grant bail in MCOCA cases. The standard under MCOCA is higher than regular bail — the accused must show they are prima facie not guilty.'],
],
],

/* ── 11. SC/ST ATROCITIES ── TIER 2 ── */
[
'title'    => 'SC/ST Atrocities Act Defence Pune',
'slug'     => 'sc-st-atrocities-act-defence',
'icon'     => 'fa-solid fa-scale-balanced',
'tier'     => '2',
'order'    => 11,
'anchor'   => 'scst',
'summary'  => 'Expert SC/ST Atrocities Act (ABA) bail and defence at Pune Sessions Court and Bombay High Court.',
'focus_kw' => 'SC ST Atrocities lawyer Pune',
'seo_title'=> 'SC/ST Atrocities Act Defence Lawyer Pune | ABA | Adv. Akash Chikate',
'seo_desc' => 'Expert SC/ST Prevention of Atrocities Act defence in Pune. Anticipatory bail, regular bail, discharge and trial defence. Call Adv. Akash Chikate.',
'content'  => '<h2>SC/ST (Prevention of Atrocities) Act Defence</h2>
<p>The Scheduled Castes and Scheduled Tribes (Prevention of Atrocities) Act, 1989 is a serious criminal law with stringent provisions. Anticipatory bail in SC/ST matters is governed by specific conditions set by the Supreme Court. Adv. Akash Chikate has experience in securing ABA and bail in SC/ST matters at Sessions Court and Bombay High Court.</p>

<h2>SC/ST Defence Services</h2>
<div class="service-bullets">
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>Anticipatory Bail (ABA)</strong> — Sessions Court &amp; Bombay HC</span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>Regular Bail</strong> after arrest</span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>FIR Quashing</strong> — When complaint is false or fabricated</span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>Discharge Application</strong></span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>Trial Defence</strong> at Special SC/ST Court</span></div>
</div>

<h2>Verified Result</h2>
<p><strong>Shaibaz Sayyed</strong> — SC/ST Atrocities — <strong>ABA Granted</strong> — Crl Appeal (ST) 14342/2025</p>',
'faqs' => [
    ['q' => 'Is anticipatory bail allowed in SC/ST Atrocities Act cases?', 'a' => 'Yes. The Supreme Court in Prathvi Raj Chauhan (2020) held that anticipatory bail can be granted in SC/ST matters. Courts look at whether a prima facie case is made out, and exercise discretion based on the facts.'],
],
],

/* ── 12. CHEQUE BOUNCE ── TIER 2 ── */
[
'title'    => 'Cheque Bounce Lawyer Pune — NI Act S.138',
'slug'     => 'cheque-bounce-ni-act',
'icon'     => 'fa-solid fa-money-check-dollar',
'tier'     => '2',
'order'    => 12,
'anchor'   => 'cheque',
'summary'  => 'Cheque bounce (NI Act S.138) defence and prosecution in Pune. JMFC Court representation for dishonour of cheque matters.',
'focus_kw' => 'cheque bounce lawyer Pune',
'seo_title'=> 'Cheque Bounce Lawyer Pune | NI Act S.138 | Adv. Akash Chikate',
'seo_desc' => 'Expert cheque bounce (NI Act S.138) defence and prosecution lawyer in Pune. JMFC Court representation. Call Adv. Akash Chikate for cheque dishonour matters.',
'content'  => '<h2>Cheque Bounce — NI Act Section 138</h2>
<p>Dishonour of a cheque under Section 138 of the Negotiable Instruments Act, 1881 is a criminal offence punishable with imprisonment up to 2 years or fine up to twice the cheque amount or both. It is one of the most common commercial disputes in India.</p>

<h2>Services</h2>
<div class="service-bullets">
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>Defence in S.138 NI Act cases</strong> — For accused drawer of cheque</span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>Filing S.138 complaints</strong> — For payee who has received a dishonoured cheque</span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>Demand Notice Drafting</strong> — Statutory notice within 30 days</span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>JMFC Court Representation</strong></span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>Settlement Negotiation</strong></span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>Appeals against conviction</strong></span></div>
</div>',
'faqs' => [
    ['q' => 'What should I do if my cheque has bounced?', 'a' => 'You must send a legal demand notice to the drawer within 30 days of receiving the dishonour memo from the bank. If the drawer does not pay within 15 days of receiving the notice, you can file a complaint under S.138 NI Act before the JMFC Court. Time limits are strict — consult a lawyer immediately.'],
    ['q' => 'What defences are available in a cheque bounce case?', 'a' => 'Common defences include: (1) Cheque was not issued for a legally enforceable debt, (2) Cheque was given as security, (3) Payment was already made, (4) Notice was not properly served, (5) Complaint was filed beyond limitation period, (6) Cheque was issued under coercion.'],
],
],

/* ── 13. CORPORATE LAW ── TIER 2 ── */
[
'title'    => 'Corporate Legal Advisory Pune',
'slug'     => 'corporate-legal-advisory',
'icon'     => 'fa-solid fa-building-columns',
'tier'     => '2',
'order'    => 13,
'anchor'   => 'corporate',
'summary'  => 'End-to-end corporate legal support — contracts, compliance, disputes, and business protection for companies in Pune.',
'focus_kw' => 'corporate lawyer Pune',
'seo_title'=> 'Corporate Lawyer Pune | Business Legal Advisory | Adv. Akash Chikate',
'seo_desc' => 'Corporate and business legal advisory in Pune. Contract drafting, compliance, dispute resolution, employment law. Call Adv. Akash Chikate for corporate legal help.',
'content'  => '<h2>Corporate Legal Advisory in Pune</h2>
<p>Businesses face legal risks at every stage. From startup formation to dispute resolution, Adv. Akash R. Chikate provides comprehensive corporate legal advisory that protects your business, minimises risk, and supports growth.</p>

<h2>Corporate Legal Services</h2>
<div class="service-bullets">
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>Contract Drafting &amp; Review</strong> — Vendor, client, employment agreements</span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>Business Dispute Resolution</strong> — Litigation and arbitration</span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>Company Law Compliance</strong> — Companies Act 2013</span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>Partnership &amp; Shareholder Disputes</strong></span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>Legal Notice &amp; Recovery</strong></span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>Startup Legal Setup</strong> — MoU, SHA, term sheets</span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>Employment Law Advisory</strong></span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>Criminal liability of directors</strong> — Defence when directors are personally named</span></div>
</div>',
'faqs' => [
    ['q' => 'Can company directors be personally arrested for company offences?', 'a' => 'Yes. Directors can be personally prosecuted under the Companies Act 2013, GST Act, Cheque Bounce cases, and other statutes. It is important to have legal protection structures in place and consult a corporate criminal lawyer when your company faces regulatory action.'],
],
],

/* ── 14. EOW / FINANCIAL CRIMES ── TIER 2 ── */
[
'title'    => 'EOW & Financial Crimes Defence Pune',
'slug'     => 'eow-financial-crimes-defence',
'icon'     => 'fa-solid fa-sack-dollar',
'tier'     => '2',
'order'    => 14,
'anchor'   => 'eow',
'summary'  => 'Defence in EOW, MPID Act, economic offences and financial crime matters at Bombay High Court and Pune courts.',
'focus_kw' => 'EOW lawyer Pune',
'seo_title'=> 'EOW & Financial Crimes Defence Lawyer Pune | MPID | Adv. Akash Chikate',
'seo_desc' => 'Expert EOW, MPID Act and economic offences defence lawyer in Pune. Bail, interim protection, discharge at Bombay High Court. Call Adv. Akash Chikate.',
'content'  => '<h2>EOW & Financial Crime Defence</h2>
<p>The Economic Offences Wing (EOW) and the Maharashtra Protection of Interest of Depositors (MPID) Act investigations carry severe consequences — including attachment of properties and pre-trial detention. Early legal intervention is critical.</p>

<h2>Services</h2>
<div class="service-bullets">
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>EOW / CBI Investigation Defence</strong></span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>MPID Act Defence</strong></span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>Anticipatory Bail &amp; Interim Protection</strong> at Bombay HC</span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>Challenge to Property Attachment</strong></span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>Discharge Applications</strong></span></div>
</div>

<h2>Verified Result</h2>
<p><strong>Gopalan Anish</strong> — EOW Financial Crime — <strong>Interim protection secured + ₹1 Crore deposit</strong> arrangement at Bombay High Court (2025)</p>',
'faqs' => [
    ['q' => 'What is MPID Act and how is it different from regular cheating cases?', 'a' => 'The Maharashtra Protection of Interest of Depositors Act, 1999 (MPID Act) is invoked in cases of fraudulent investment schemes, chit fund frauds, and financial scams. It allows attachment of property before conviction and is tried by a Special MPID Court. The consequences are far more severe than regular cheating cases.'],
],
],

/* ── 15. INTELLECTUAL PROPERTY ── TIER 2 ── */
[
'title'    => 'Intellectual Property Lawyer Pune',
'slug'     => 'intellectual-property',
'icon'     => 'fa-solid fa-lightbulb',
'tier'     => '2',
'order'    => 15,
'anchor'   => 'ip',
'summary'  => 'Trademark, copyright, patent and trade secret protection for individuals and businesses in Pune and Maharashtra.',
'focus_kw' => 'intellectual property lawyer Pune',
'seo_title'=> 'Intellectual Property Lawyer Pune | Trademark | Copyright | Adv. Akash Chikate',
'seo_desc' => 'IP lawyer in Pune for trademark registration, copyright protection, patent advisory and infringement litigation. Call Adv. Akash Chikate for IP matters.',
'content'  => '<h2>Intellectual Property Protection in Pune</h2>
<p>Your ideas, brand, and creative work are valuable assets. Adv. Akash R. Chikate helps individuals, creators, and businesses protect their intellectual property through registration, enforcement, and litigation.</p>

<h2>IP Services</h2>
<div class="service-bullets">
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>Trademark Registration &amp; Protection</strong></span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>Copyright Registration &amp; Infringement</strong></span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>Patent Filing Advisory</strong></span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>Trade Secret Protection</strong></span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>IP Infringement Litigation</strong></span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>Domain Name Disputes</strong></span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>IP Due Diligence for Startups &amp; M&amp;A</strong></span></div>
</div>',
'faqs' => [
    ['q' => 'How long does trademark registration take in India?', 'a' => 'Trademark registration in India typically takes 18–24 months from application to registration, assuming no objections. However, once a trademark application is filed, you get TM™ symbol rights and the filing date serves as your priority date.'],
],
],

/* ── 16. POSH ── TIER 2 ── */
[
'title'    => 'POSH Act Compliance & Workplace Law Pune',
'slug'     => 'posh-workplace-law',
'icon'     => 'fa-solid fa-users-shield',
'tier'     => '2',
'order'    => 16,
'anchor'   => 'posh',
'summary'  => 'POSH Act compliance, ICC formation, complaint handling, and workplace harassment advisory for businesses in Pune.',
'focus_kw' => 'POSH Act lawyer Pune',
'seo_title'=> 'POSH Act Compliance Lawyer Pune | ICC | Workplace Law | Adv. Akash Chikate',
'seo_desc' => 'POSH Act compliance lawyer in Pune. ICC formation, anti-harassment policy, complaint investigation, annual compliance. Call Adv. Akash Chikate for POSH advisory.',
'content'  => '<h2>POSH Act Compliance in Pune</h2>
<p>The Sexual Harassment of Women at Workplace (Prevention, Prohibition and Redressal) Act, 2013 (POSH Act) applies to <strong>all employers with 10 or more employees</strong>. Non-compliance can result in fines of ₹50,000 and cancellation of business licences.</p>

<h2>POSH Services</h2>
<div class="service-bullets">
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>POSH Compliance Audit</strong> — For all employers in Pune</span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>ICC Formation &amp; Training</strong></span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>Anti-Harassment Policy Drafting</strong></span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>Complaint Handling &amp; Investigation</strong></span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>Employee Sensitization Workshops</strong></span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>Annual Compliance Reporting</strong></span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>Employee Rights Advisory</strong></span></div>
</div>',
'faqs' => [
    ['q' => 'Does POSH Act apply to small companies in Pune?', 'a' => 'Yes. The POSH Act applies to all employers with 10 or more employees — including private companies, startups, NGOs, and government bodies. If you have fewer than 10 employees, complaints go to the Local Complaints Committee (LCC) of the district.'],
    ['q' => 'What is the penalty for not having an ICC under POSH?', 'a' => 'Non-compliance can result in a fine of ₹50,000 for first violation. Repeat violations can lead to doubling of the penalty and cancellation or non-renewal of business registration licences.'],
],
],

/* ── 17. CONSUMER COURT ── TIER 2 ── */
[
'title'    => 'Consumer Court Lawyer Pune',
'slug'     => 'consumer-court',
'icon'     => 'fa-solid fa-receipt',
'tier'     => '2',
'order'    => 17,
'anchor'   => 'consumer',
'summary'  => 'Consumer forum complaints and defence in Pune. District Consumer Commission, State Commission representation.',
'focus_kw' => 'consumer court lawyer Pune',
'seo_title'=> 'Consumer Court Lawyer Pune | District Commission | Adv. Akash Chikate',
'seo_desc' => 'Expert consumer court lawyer in Pune. File or defend consumer complaints at District Consumer Commission and State Commission. Call Adv. Akash Chikate.',
'content'  => '<h2>Consumer Court — District Consumer Commission, Pune</h2>
<p>The Consumer Protection Act, 2019 provides strong rights to consumers against defective goods, deficient services, unfair trade practices, and misleading advertisements. Adv. Akash R. Chikate represents both complainants and opposite parties before the District Consumer Commission and State Consumer Disputes Redressal Commission.</p>

<h2>Services</h2>
<div class="service-bullets">
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>Consumer Complaint Filing</strong> — For buyers, service recipients</span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>Defence of Consumer Complaints</strong> — For businesses and service providers</span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>Real Estate Disputes</strong> — Builder deficiency, possession delay</span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>Insurance Claim Disputes</strong></span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>Banking &amp; Financial Services Deficiency</strong></span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>Appeals to State Commission</strong></span></div>
</div>',
'faqs' => [
    ['q' => 'What is the time limit for filing a consumer complaint?', 'a' => 'A consumer complaint must be filed within 2 years from the date the cause of action arose (the deficiency or unfair practice). Beyond 2 years, you need to file a condonation application explaining the delay.'],
    ['q' => 'How much compensation can I get in consumer court?', 'a' => 'The District Commission can award compensation up to ₹50 lakhs. The State Commission handles complaints between ₹50 lakhs and ₹2 crores. The National Commission handles matters above ₹2 crores. Compensation can include refund, replacement, damages, and litigation costs.'],
],
],

/* ── 18. DISCHARGE APPLICATION ── TIER 2 ── */
[
'title'    => 'Discharge Application Criminal Case Pune',
'slug'     => 'discharge-application',
'icon'     => 'fa-solid fa-person-walking-arrow-right',
'tier'     => '2',
'order'    => 18,
'anchor'   => 'discharge',
'summary'  => 'Discharge applications before framing of charge in Sessions Court — preventing criminal trial when evidence is insufficient.',
'focus_kw' => 'discharge application lawyer Pune',
'seo_title'=> 'Discharge Application Lawyer Pune | Sessions Court | Adv. Akash Chikate',
'seo_desc' => 'Expert discharge application lawyer in Pune. File discharge before framing of charge at Sessions Court. Prevent criminal trial with strong legal arguments. Call now.',
'content'  => '<h2>Discharge Application — Stop the Trial Before It Begins</h2>
<p>A discharge application is filed <strong>before the framing of charge</strong> in a Sessions Court or Magistrate Court case. If the court finds that there is no sufficient evidence to proceed against the accused, it can <strong>discharge them</strong> — meaning no trial takes place.</p>
<p>This is one of the most powerful yet underutilised remedies in criminal law. A well-argued discharge application can save years of trial.</p>

<h2>When Can You File a Discharge Application?</h2>
<ul>
<li>There is insufficient evidence against you in the chargesheet</li>
<li>The allegations do not legally constitute the offence charged</li>
<li>Key witnesses have retracted their statements</li>
<li>There are procedural irregularities in the investigation</li>
<li>The chargesheet has been filed prematurely or with fabricated evidence</li>
</ul>

<h2>Services</h2>
<div class="service-bullets">
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>Drafting Discharge Application</strong> — With detailed legal grounds</span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>Sessions Court Representation</strong> — Arguing for discharge</span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>Revision against Discharge Rejection</strong> — High Court revision petition</span></div>
<div class="service-bullet"><i class="fa-solid fa-check-circle"></i><span><strong>Combined Strategy</strong> — Bail + Discharge + FIR Quashing where applicable</span></div>
</div>',
'faqs' => [
    ['q' => 'What is the difference between acquittal and discharge?', 'a' => 'Discharge happens before the trial begins — the court finds insufficient grounds to frame charge. Acquittal happens after the trial is complete — the court finds the accused not guilty after examining all evidence. Discharge is preferred as it avoids the trauma of a full trial.'],
    ['q' => 'Can a discharged person be re-arrested for the same offence?', 'a' => 'Yes. A discharge order does not bar future prosecution. If new evidence emerges, the prosecution can file a fresh chargesheet. However, in practice, discharge often ends the matter.'],
],
],

    ]; // end return array
}
