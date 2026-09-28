<?php
/**
 * Plugin Name: AKC Location Importer
 * Description: Creates 15 location pages for Advocate Akash Chikate. One-time use.
 * Version: 1.0
 */
if ( ! defined( 'ABSPATH' ) ) exit;

register_activation_hook( __FILE__, 'akc_import_locations' );

add_action( 'admin_notices', function() {
    if ( ! current_user_can( 'manage_options' ) ) return;
    if ( get_option( 'akc_locations_imported' ) ) {
        echo '<div class="notice notice-success"><p><strong>AKC Location Importer:</strong> All 15 location pages already created. You can deactivate and delete this plugin.</p></div>';
        return;
    }
    $nonce = wp_create_nonce( 'akc_location_import' );
    echo '<div class="notice notice-warning"><p><strong>AKC Location Importer:</strong> Location pages not yet created. <a href="' . admin_url( 'admin.php?akc_loc_import=1&_wpnonce=' . $nonce ) . '" class="button button-primary">Create All 15 Location Pages Now</a></p></div>';
});

add_action( 'admin_init', function() {
    if ( empty( $_GET['akc_loc_import'] ) ) return;
    check_admin_referer( 'akc_location_import' );
    if ( ! current_user_can( 'manage_options' ) ) return;
    akc_import_locations();
    wp_redirect( admin_url( 'edit.php?post_type=location_page&akc_loc_done=1' ) );
    exit;
});

add_action( 'admin_notices', function() {
    if ( ! empty( $_GET['akc_loc_done'] ) ) {
        echo '<div class="notice notice-success is-dismissible"><p><strong>Success!</strong> All 15 location pages have been created.</p></div>';
    }
});

function akc_import_locations() {
    if ( get_option( 'akc_locations_imported' ) ) return;

    foreach ( akc_get_locations() as $loc ) {
        $existing = get_page_by_path( $loc['slug'], OBJECT, 'location_page' );
        if ( $existing ) continue;

        $post_id = wp_insert_post([
            'post_title'   => $loc['title'],
            'post_name'    => $loc['slug'],
            'post_content' => $loc['content'],
            'post_status'  => 'publish',
            'post_type'    => 'location_page',
        ]);

        if ( is_wp_error( $post_id ) || ! $post_id ) continue;

        update_post_meta( $post_id, 'akc_lp_area',           $loc['area'] );
        update_post_meta( $post_id, 'akc_lp_tagline',        $loc['tagline'] );
        update_post_meta( $post_id, 'akc_lp_police_station', $loc['police'] );
        update_post_meta( $post_id, 'akc_lp_court',          $loc['courts'] );

        update_post_meta( $post_id, 'rank_math_title',        $loc['seo_title'] );
        update_post_meta( $post_id, 'rank_math_description',  $loc['seo_desc'] );
        update_post_meta( $post_id, 'rank_math_focus_keyword',$loc['focus_kw'] );
        update_post_meta( $post_id, 'rank_math_robots',       [ 'index', 'follow' ] );
    }

    update_option( 'akc_locations_imported', true );
}

function akc_get_locations() {
    return [

/* ======================================================
   1. SHIVAJINAGAR
   ====================================================== */
[
'title'     => 'Criminal Lawyer in Shivajinagar Pune',
'slug'      => 'criminal-lawyer-shivajinagar-pune',
'area'      => 'Shivajinagar',
'tagline'   => 'Experienced criminal defence, bail, and High Court representation steps from Pune Sessions Court.',
'police'    => 'Shivajinagar Police Station, Deccan Police Station',
'courts'    => 'Pune District & Sessions Court, Bombay High Court Annexe (Pune Bench) — both located in Shivajinagar',
'focus_kw'  => 'criminal lawyer shivajinagar pune',
'seo_title' => 'Criminal Lawyer in Shivajinagar Pune — Bail & High Court Expert',
'seo_desc'  => 'Need a criminal lawyer in Shivajinagar, Pune? Advocate Akash Chikate practises at Pune Sessions Court and Bombay High Court Annexe — bail, FIR quashing, cybercrime, 498A defence.',
'content'   => '<h2>Criminal Defence Lawyer in Shivajinagar, Pune</h2>
<p>Shivajinagar is the legal heart of Pune — home to the <strong>Pune District and Sessions Court</strong>, the <strong>Bombay High Court Annexe (Pune Bench)</strong>, the Family Court, and the Labour Court, all within walking distance of each other. If you are facing criminal charges, a bail emergency, or need to approach the Bombay High Court for FIR quashing or anticipatory bail, having a lawyer who practises daily in this precinct is a decisive advantage.</p>
<p>Advocate Akash Chikate is a criminal defence lawyer based in Shivajinagar with over a decade of regular practice at Pune Sessions Court and the Bombay High Court Pune Bench. From bail hearings on the day of arrest to complex High Court writ petitions, every matter is handled personally — not delegated to a junior.</p>
<h2>Legal Services Available in Shivajinagar</h2>
<ul>
<li><strong>Anticipatory Bail</strong> — filed at Sessions Court or Bombay High Court same day in emergencies</li>
<li><strong>Bail Application</strong> — regular bail after arrest at Magistrate, Sessions, or High Court level</li>
<li><strong>FIR Quashing</strong> — writ petitions under S.528 BNSS at Bombay High Court Pune Bench</li>
<li><strong>Criminal Defence</strong> — full trial defence at Sessions Court and subordinate courts</li>
<li><strong>Cybercrime Defence</strong> — Pune Cyber Cell matters and IT Act cases</li>
<li><strong>498A / Domestic Violence</strong> — defence and anticipatory bail for accused</li>
<li><strong>NDPS / MCOCA / POCSO</strong> — specialist defence at Sessions Court and High Court</li>
<li><strong>Family Court Matters</strong> — divorce, maintenance, custody at Pune Family Court</li>
</ul>
<h2>Why Location Matters in Criminal Cases</h2>
<p>Shivajinagar courts have their own procedures, timings, and judicial tendencies. A lawyer who appears there daily knows which court room handles which type of matter, when urgent mentions are entertained, and how to navigate the system efficiently. In bail matters especially, every hour counts — and a lawyer who knows the Shivajinagar court complex can move faster than one travelling from elsewhere.</p>',
],

/* ======================================================
   2. PIMPRI-CHINCHWAD
   ====================================================== */
[
'title'     => 'Criminal Lawyer in Pimpri-Chinchwad',
'slug'      => 'criminal-lawyer-pimpri-chinchwad',
'area'      => 'Pimpri-Chinchwad',
'tagline'   => 'Criminal defence, bail, and cybercrime legal representation across PCMC — Pimpri, Chinchwad, Bhosari, Nigdi, Akurdi.',
'police'    => 'Pimpri Police Station, Chinchwad Police Station, Bhosari Police Station, Nigdi Police Station, Akurdi Police Station, Wakad Police Station',
'courts'    => 'JMFC Court Pimpri-Chinchwad, Pune Sessions Court (for HC-level matters)',
'focus_kw'  => 'criminal lawyer pimpri chinchwad',
'seo_title' => 'Criminal Lawyer in Pimpri-Chinchwad — Bail & Defence Expert (PCMC)',
'seo_desc'  => 'Criminal lawyer in Pimpri-Chinchwad (PCMC)? Advocate Akash Chikate handles bail, anticipatory bail, FIR quashing, cybercrime, and 498A defence across Pimpri, Chinchwad, Bhosari & Nigdi.',
'content'   => '<h2>Criminal Defence Lawyer Serving Pimpri-Chinchwad (PCMC)</h2>
<p>Pimpri-Chinchwad is one of Maharashtra\'s most industrially significant cities — home to auto, pharma, and IT industries. With a rapidly growing population across Pimpri, Chinchwad, Bhosari, Nigdi, Akurdi, Wakad, and surrounding areas, the demand for specialist criminal legal representation has grown significantly. Industrial disputes, cybercrime complaints, workplace harassment (POSH Act), and domestic violence cases are among the most common legal matters arising in PCMC.</p>
<p>Advocate Akash Chikate provides criminal defence and bail services to clients from across PCMC. Matters from PCMC police stations are typically prosecuted at the JMFC courts in Pimpri-Chinchwad, with serious matters committed to Pune Sessions Court and the Bombay High Court Pune Bench.</p>
<h2>Common Legal Issues in Pimpri-Chinchwad</h2>
<ul>
<li><strong>Cybercrime FIRs</strong> — IT company employees and business owners facing online fraud or hacking allegations at Pimpri-Chinchwad Cyber Cell</li>
<li><strong>POSH Act complaints</strong> — industrial and IT sector employers facing workplace harassment complaints</li>
<li><strong>498A / Domestic Violence</strong> — matrimonial disputes arising from PCMC households</li>
<li><strong>NDPS cases</strong> — drug seizures by Pimpri-Chinchwad police; bail at Sessions level and Bombay HC</li>
<li><strong>Industrial / corporate disputes</strong> turned criminal — cheating, breach of trust allegations</li>
<li><strong>Cheque bounce (NI Act)</strong> — commercial disputes from Pimpri-Chinchwad industrial areas</li>
</ul>
<h2>How We Serve PCMC Clients</h2>
<p>Our office is in Shivajinagar, Pune — approximately 20–25 minutes from Pimpri. We attend remand hearings at PCMC courts and handle all High Court matters at the Bombay High Court Pune Bench. For bail emergencies, contact us on WhatsApp or phone — we can advise you immediately and appear at the earliest possible hearing.</p>',
],

/* ======================================================
   3. KOTHRUD
   ====================================================== */
[
'title'     => 'Criminal Lawyer in Kothrud Pune',
'slug'      => 'criminal-lawyer-kothrud-pune',
'area'      => 'Kothrud',
'tagline'   => 'Criminal defence, bail applications, and cybercrime legal services for Kothrud and Warje residents.',
'police'    => 'Kothrud Police Station, Warje-Malwadi Police Station',
'courts'    => 'JMFC Kothrud, Pune Sessions Court, Bombay High Court Pune Bench',
'focus_kw'  => 'criminal lawyer kothrud pune',
'seo_title' => 'Criminal Lawyer in Kothrud Pune — Bail, FIR Quashing & Defence',
'seo_desc'  => 'Looking for a criminal lawyer in Kothrud, Pune? Advocate Akash Chikate handles bail, anticipatory bail, cybercrime, 498A, and criminal defence for Kothrud and Warje clients.',
'content'   => '<h2>Criminal Defence Services for Kothrud, Pune</h2>
<p>Kothrud is one of Pune\'s largest and most densely populated residential areas — a mix of established families, students, and working professionals. Criminal matters arising from Kothrud typically involve domestic disputes, cybercrime complaints, road accident cases, and property-related FIRs. The area falls under the jurisdiction of <strong>Kothrud Police Station</strong> and <strong>Warje-Malwadi Police Station</strong>.</p>
<p>Advocate Akash Chikate provides criminal defence services to Kothrud residents across the full range of criminal and quasi-criminal matters — from anticipatory bail applications to full trial defence and FIR quashing at the Bombay High Court.</p>
<h2>Legal Services for Kothrud Residents</h2>
<ul>
<li><strong>Anticipatory Bail</strong> — protect yourself from arrest before the police act</li>
<li><strong>Bail After Arrest</strong> — urgent representation at Magistrate and Sessions Court</li>
<li><strong>498A / Domestic Violence Defence</strong> — for accused and their families in matrimonial disputes</li>
<li><strong>Cybercrime</strong> — online fraud accusations, social media harassment cases, IT Act notices</li>
<li><strong>Cheque Bounce Defence</strong> — S.138 NI Act matters at JMFC Kothrud and Pune courts</li>
<li><strong>FIR Quashing</strong> — High Court petitions for false or frivolous FIRs</li>
</ul>
<h2>Consultation for Kothrud Clients</h2>
<p>Our office is located in Shivajinagar — easily accessible from Kothrud via Karve Road (15–20 minutes). We offer in-person consultations and can also provide initial advice by phone or WhatsApp before you visit. In urgent situations — particularly bail matters — call us directly and we will advise you on immediate steps.</p>',
],

/* ======================================================
   4. HADAPSAR
   ====================================================== */
[
'title'     => 'Criminal Lawyer in Hadapsar Pune',
'slug'      => 'criminal-lawyer-hadapsar-pune',
'area'      => 'Hadapsar',
'tagline'   => 'Criminal defence, bail, and cybercrime representation for Hadapsar, Magarpatta and Manjari.',
'police'    => 'Hadapsar Police Station, Mundhwa Police Station, Wanowrie Police Station',
'courts'    => 'JMFC Hadapsar, Pune Sessions Court, Bombay High Court Pune Bench',
'focus_kw'  => 'criminal lawyer hadapsar pune',
'seo_title' => 'Criminal Lawyer in Hadapsar Pune — Bail, Cybercrime & Defence Expert',
'seo_desc'  => 'Criminal lawyer in Hadapsar, Pune? Advocate Akash Chikate handles bail, anticipatory bail, cybercrime FIRs, 498A, and criminal defence for Hadapsar, Magarpatta and Wanowrie clients.',
'content'   => '<h2>Criminal Defence Lawyer for Hadapsar, Magarpatta &amp; Wanowrie</h2>
<p>Hadapsar and the adjoining Magarpatta City belt is one of Pune\'s fastest-growing corridors — a mix of IT professionals, manufacturing workers, and long-established residential communities. The Hadapsar, Mundhwa, and Wanowrie police stations together cover a large and economically diverse population. Legal matters in this area frequently involve cybercrime (given the high IT workforce density), domestic disputes, and business-related FIRs.</p>
<p>Advocate Akash Chikate provides criminal defence, bail, and civil litigation services to clients from Hadapsar, Magarpatta, Kharadi, Undri, Manjari, and Wanowrie.</p>
<h2>Key Legal Services</h2>
<ul>
<li><strong>Cybercrime Defence</strong> — IT professionals at Magarpatta and Kharadi tech parks facing cyber allegations</li>
<li><strong>Anticipatory Bail</strong> — urgent applications at Sessions Court and Bombay High Court</li>
<li><strong>498A / DV Act Defence</strong> — matrimonial dispute defence for families in the Hadapsar belt</li>
<li><strong>NDPS Bail</strong> — drug-related arrests by Hadapsar and Mundhwa police</li>
<li><strong>Cheque Bounce (NI Act)</strong> — business disputes from Hadapsar industrial estate</li>
<li><strong>FIR Quashing</strong> — High Court petitions for motivated complaints</li>
</ul>
<p>For urgent matters, WhatsApp or call us directly. We are available for bail emergencies arising from Hadapsar police stations and can appear at the earliest remand hearing.</p>',
],

/* ======================================================
   5. WAKAD
   ====================================================== */
[
'title'     => 'Criminal Lawyer in Wakad Pune',
'slug'      => 'criminal-lawyer-wakad-pune',
'area'      => 'Wakad',
'tagline'   => 'Criminal defence, bail, and legal services for Wakad, Hinjewadi Phase 1 and Pimple Nilakh residents.',
'police'    => 'Wakad Police Station, Hinjewadi Police Station',
'courts'    => 'JMFC Pimpri-Chinchwad, Pune Sessions Court, Bombay High Court Pune Bench',
'focus_kw'  => 'criminal lawyer wakad pune',
'seo_title' => 'Criminal Lawyer in Wakad Pune — Bail, Cybercrime & IT Law Expert',
'seo_desc'  => 'Criminal lawyer in Wakad, Pune? Advocate Akash Chikate handles bail, cybercrime, FIR quashing, 498A defence, and POSH matters for Wakad and Hinjewadi IT corridor clients.',
'content'   => '<h2>Criminal Defence Services for Wakad &amp; Hinjewadi Corridor</h2>
<p>Wakad sits at the intersection of Pune\'s residential and IT zones — bordered by Hinjewadi IT Park (Phase 1) on one side and dense residential towers on the other. The area has seen significant growth in cybercrime complaints, workplace harassment matters, and matrimonial disputes driven by the young, working professional demographic. Wakad falls under <strong>Wakad Police Station</strong> (PCMC jurisdiction).</p>
<p>Advocate Akash Chikate handles criminal matters for Wakad, Pimple Nilakh, Hinjewadi Phase 1, and Rahatni residents — including urgent bail applications, cybercrime FIR defence, and POSH advisory for IT companies in the area.</p>
<h2>Common Legal Matters in Wakad</h2>
<ul>
<li><strong>Cybercrime FIRs</strong> — tech workers facing online fraud, hacking, or impersonation accusations</li>
<li><strong>POSH Act Compliance &amp; Defence</strong> — IT and startup companies in Hinjewadi Phase 1</li>
<li><strong>Anticipatory Bail</strong> — protection from arrest in domestic and financial disputes</li>
<li><strong>498A / DV Act</strong> — matrimonial defence for families in Wakad</li>
<li><strong>Bail After Arrest</strong> — representation at JMFC Pimpri-Chinchwad and Pune Sessions Court</li>
<li><strong>FIR Quashing</strong> — High Court intervention for frivolous complaints</li>
</ul>
<p>Contact us by WhatsApp or phone for an immediate consultation. We serve Wakad clients from our Shivajinagar office and can advise remotely in urgent situations.</p>',
],

/* ======================================================
   6. BANER
   ====================================================== */
[
'title'     => 'Criminal Lawyer in Baner Pune',
'slug'      => 'criminal-lawyer-baner-pune',
'area'      => 'Baner',
'tagline'   => 'Criminal defence and legal representation for Baner, Balewadi and Pashan residents.',
'police'    => 'Chatushringi Police Station, Baner Police Station',
'courts'    => 'Pune Sessions Court, Bombay High Court Pune Bench',
'focus_kw'  => 'criminal lawyer baner pune',
'seo_title' => 'Criminal Lawyer in Baner Pune — Bail, Cybercrime & Criminal Defence',
'seo_desc'  => 'Criminal lawyer in Baner, Pune? Advocate Akash Chikate provides bail, anticipatory bail, cybercrime defence, FIR quashing, and 498A legal services to Baner and Balewadi clients.',
'content'   => '<h2>Criminal Lawyer Serving Baner, Balewadi &amp; Pashan</h2>
<p>Baner and Balewadi are among Pune\'s most affluent residential and commercial corridors — home to IT professionals, startup founders, and established businesses. Criminal and quasi-criminal legal issues arising from this area frequently involve cybercrime FIRs, business fraud allegations, matrimonial disputes, and POSH Act matters at IT and corporate offices.</p>
<p>Advocate Akash Chikate provides criminal defence, bail, and cyber law services to clients in Baner, Balewadi, Pashan, Aundh Road, and Sus Road areas. Our Shivajinagar office is approximately 20 minutes from Baner, and we are available for WhatsApp consultations before you travel.</p>
<h2>Services for Baner &amp; Balewadi Clients</h2>
<ul>
<li><strong>Anticipatory Bail</strong> — if you apprehend arrest, act before the police do</li>
<li><strong>Cybercrime Defence</strong> — online fraud, IT Act notices, social media cases</li>
<li><strong>POSH Compliance &amp; Advisory</strong> — for Baner-based companies and startups</li>
<li><strong>498A / DV Act Defence</strong> — matrimonial dispute strategy for accused families</li>
<li><strong>Corporate / Financial Fraud Defence</strong> — cheating and criminal breach of trust cases</li>
<li><strong>FIR Quashing at Bombay High Court</strong> — for false or motivated FIRs</li>
</ul>
<p>Call or WhatsApp us for a confidential consultation. First consultation is free.</p>',
],

/* ======================================================
   7. VIMAN NAGAR
   ====================================================== */
[
'title'     => 'Criminal Lawyer in Viman Nagar Pune',
'slug'      => 'criminal-lawyer-viman-nagar-pune',
'area'      => 'Viman Nagar',
'tagline'   => 'Criminal defence, bail, and corporate legal services for Viman Nagar, Nagar Road and Vishrantwadi.',
'police'    => 'Viman Nagar Police Station, Lohegaon Police Station',
'courts'    => 'JMFC Viman Nagar, Pune Sessions Court, Bombay High Court Pune Bench',
'focus_kw'  => 'criminal lawyer viman nagar pune',
'seo_title' => 'Criminal Lawyer in Viman Nagar Pune — Bail, Cyber & Corporate Defence',
'seo_desc'  => 'Criminal lawyer in Viman Nagar, Pune? Advocate Akash Chikate handles bail, cybercrime, FIR quashing, POSH, corporate fraud defence for Viman Nagar, Nagar Road and Vishrantwadi clients.',
'content'   => '<h2>Criminal &amp; Corporate Legal Defence in Viman Nagar</h2>
<p>Viman Nagar is one of Pune\'s premier residential and commercial addresses — located along the Nagar Road corridor near Pune Airport. The area attracts a mix of IT professionals, aviation-sector workers, NRIs, and business executives. Common legal matters from Viman Nagar include cybercrime complaints, business disputes, matrimonial FIRs, and POSH Act compliance for the many corporate offices in the area.</p>
<p>Advocate Akash Chikate serves clients from Viman Nagar, Nagar Road, Vishrantwadi, Kharadi, and the Nagar Road corridor for criminal defence, bail, cybercrime, and corporate legal matters.</p>
<h2>Legal Services for Viman Nagar Clients</h2>
<ul>
<li><strong>Cybercrime Defence</strong> — online fraud, hacking, and social media FIRs from Viman Nagar police</li>
<li><strong>Corporate Fraud Defence</strong> — cheating, misappropriation, financial crime allegations</li>
<li><strong>Anticipatory Bail &amp; Regular Bail</strong> — urgent applications at Sessions Court and Bombay High Court</li>
<li><strong>POSH Act Advisory</strong> — compliance, ICC formation, and complaint handling for Viman Nagar companies</li>
<li><strong>498A / DV Defence</strong> — for families facing matrimonial complaints from this area</li>
<li><strong>FIR Quashing</strong> — writ petitions at Bombay High Court Pune Bench</li>
</ul>',
],

/* ======================================================
   8. HINJEWADI
   ====================================================== */
[
'title'     => 'Criminal Lawyer in Hinjewadi Pune',
'slug'      => 'criminal-lawyer-hinjewadi-pune',
'area'      => 'Hinjewadi',
'tagline'   => 'Cybercrime, POSH, and criminal defence legal services for Hinjewadi IT Park Phase 1, 2 and 3.',
'police'    => 'Hinjewadi Police Station, Wakad Police Station',
'courts'    => 'JMFC Pimpri-Chinchwad, Pune Sessions Court, Bombay High Court Pune Bench',
'focus_kw'  => 'criminal lawyer hinjewadi pune',
'seo_title' => 'Criminal Lawyer in Hinjewadi Pune — Cybercrime, POSH & Bail Expert',
'seo_desc'  => 'Criminal lawyer in Hinjewadi, Pune? Advocate Akash Chikate specialises in cybercrime defence, POSH Act compliance, bail, and FIR quashing for Hinjewadi IT Park employees and companies.',
'content'   => '<h2>Criminal &amp; Cyber Law Services for Hinjewadi IT Park</h2>
<p>Hinjewadi IT Park — spread across Phase 1, Phase 2, and Phase 3 — is Maharashtra\'s largest IT and technology campus, employing hundreds of thousands of professionals from across India. With this scale of workforce comes a proportionate volume of legal matters: cybercrime FIRs against IT professionals, POSH Act complaints within companies, workplace disputes escalating into criminal complaints, and matrimonial FIRs (498A, DV Act) filed by or against employees who have relocated to Pune.</p>
<p>Advocate Akash Chikate provides specialist cybercrime defence, POSH advisory, anticipatory bail, and criminal defence services to individuals and companies in the Hinjewadi IT Park ecosystem.</p>
<h2>Top Legal Issues for Hinjewadi Professionals</h2>
<ul>
<li><strong>Cybercrime FIR</strong> — accused of online fraud, data theft, hacking, or digital harassment</li>
<li><strong>POSH Act</strong> — companies needing ICC formation, policy drafting, complaint handling support</li>
<li><strong>Anticipatory Bail</strong> — IT professional apprehending arrest in a matrimonial or financial dispute</li>
<li><strong>498A / DV Act</strong> — spouses relocated from other states filing complaints in Pune</li>
<li><strong>Corporate / IP Disputes</strong> — trade secret theft, employer-employee criminal allegations</li>
<li><strong>FIR Quashing</strong> — Bombay High Court petitions for motivated workplace complaints</li>
</ul>
<p>We advise Hinjewadi clients by phone and WhatsApp before an in-office consultation. Many IT professionals prefer a discreet, after-hours consultation — this can be arranged.</p>',
],

/* ======================================================
   9. PUNE CAMP
   ====================================================== */
[
'title'     => 'Criminal Lawyer in Pune Camp',
'slug'      => 'criminal-lawyer-pune-camp',
'area'      => 'Pune Camp',
'tagline'   => 'Criminal defence, bail, and NI Act legal services for Pune Camp, Koregaon Park and Cantonment area.',
'police'    => 'Camp Police Station, Mundhwa Police Station, Wanowrie Police Station',
'courts'    => 'CJM Court Pune Camp, Pune Sessions Court, Bombay High Court Pune Bench',
'focus_kw'  => 'criminal lawyer pune camp',
'seo_title' => 'Criminal Lawyer in Pune Camp — Bail, Criminal Defence & NI Act (2025)',
'seo_desc'  => 'Criminal lawyer in Pune Camp? Advocate Akash Chikate handles bail, anticipatory bail, cheque bounce (NI Act), cybercrime, and criminal defence for Pune Cantonment and Camp area clients.',
'content'   => '<h2>Criminal Defence Services for Pune Camp &amp; Cantonment Area</h2>
<p>Pune Camp (Cantonment area) is one of Pune\'s oldest and most commercially active zones — home to trading businesses, hospitality establishments, defence personnel, and long-established residential communities. Common legal matters from the Camp area include NI Act cheque bounce cases (from the high volume of commercial transactions), theft and property FIRs, and criminal complaints arising from business disputes.</p>
<p>Advocate Akash Chikate serves clients from Pune Camp, MG Road, East Street, Boat Club Road, and the Cantonment area for criminal defence, bail, and commercial dispute litigation.</p>
<h2>Services for Pune Camp Clients</h2>
<ul>
<li><strong>Cheque Bounce (S.138 NI Act)</strong> — for both complainants seeking recovery and accused seeking defence</li>
<li><strong>Anticipatory Bail</strong> — commercial disputes escalating into criminal FIRs</li>
<li><strong>Criminal Defence</strong> — IPC / BNS offences registered at Camp Police Station</li>
<li><strong>Cybercrime</strong> — online fraud and financial scam complaints</li>
<li><strong>498A / DV Act</strong> — matrimonial dispute defence</li>
<li><strong>FIR Quashing</strong> — High Court petitions for civil-origin criminal complaints</li>
</ul>',
],

/* ======================================================
   10. DECCAN GYMKHANA
   ====================================================== */
[
'title'     => 'Criminal Lawyer in Deccan Gymkhana Pune',
'slug'      => 'criminal-lawyer-deccan-gymkhana-pune',
'area'      => 'Deccan Gymkhana',
'tagline'   => 'Criminal defence and legal services for Deccan, FC Road, JM Road and Erandwane residents.',
'police'    => 'Deccan Police Station, Chatushringi Police Station',
'courts'    => 'Pune Sessions Court (Shivajinagar, 5 min from Deccan), Bombay High Court Pune Bench',
'focus_kw'  => 'advocate deccan gymkhana pune',
'seo_title' => 'Criminal Lawyer in Deccan Gymkhana Pune — Bail & Criminal Defence',
'seo_desc'  => 'Advocate in Deccan Gymkhana, Pune? Advocate Akash Chikate provides criminal defence, bail, anticipatory bail, cybercrime, and FIR quashing for Deccan, Erandwane and FC Road clients.',
'content'   => '<h2>Criminal Defence Services — Deccan, FC Road &amp; Erandwane</h2>
<p>Deccan Gymkhana and the FC Road / JM Road belt is Pune\'s cultural and educational heartland — home to universities, colleges, medical institutions, and some of the city\'s oldest residential neighborhoods. Criminal matters from this area often involve student-related cases, matrimonial disputes, cyber harassment, and property FIRs. Deccan falls under <strong>Deccan Police Station</strong> jurisdiction, with Pune Sessions Court located just 5 minutes away in Shivajinagar.</p>
<p>Advocate Akash Chikate serves clients from Deccan Gymkhana, FC Road, JM Road, Erandwane, Model Colony, and Shivajinagar for the full range of criminal and civil matters.</p>
<h2>Services for Deccan &amp; Erandwane Clients</h2>
<ul>
<li><strong>Anticipatory Bail</strong> — rapid applications at Sessions Court next door in Shivajinagar</li>
<li><strong>Criminal Defence</strong> — full representation at Pune subordinate courts and Sessions Court</li>
<li><strong>Cybercrime</strong> — social media harassment, online defamation, IT Act cases</li>
<li><strong>498A / DV Act</strong> — matrimonial dispute defence and strategy</li>
<li><strong>FIR Quashing</strong> — motivated complaints quashed at Bombay High Court</li>
<li><strong>Consumer &amp; Civil Disputes</strong> — escalated commercial or property matters</li>
</ul>',
],

/* ======================================================
   11. YERAWADA
   ====================================================== */
[
'title'     => 'Criminal Lawyer in Yerawada Pune',
'slug'      => 'criminal-lawyer-yerawada-pune',
'area'      => 'Yerawada',
'tagline'   => 'Bail applications, undertrial representation, and criminal defence for Yerawada and Kalyani Nagar.',
'police'    => 'Yerawada Police Station, Kalyani Nagar Police Station',
'courts'    => 'JMFC Yerawada, Pune Sessions Court, Bombay High Court Pune Bench',
'focus_kw'  => 'criminal lawyer yerawada pune',
'seo_title' => 'Criminal Lawyer in Yerawada Pune — Bail & Undertrial Representation',
'seo_desc'  => 'Criminal lawyer in Yerawada, Pune? Advocate Akash Chikate handles bail, undertrial representation, anticipatory bail, and criminal defence for Yerawada, Kalyani Nagar and Nagar Road clients.',
'content'   => '<h2>Bail &amp; Undertrial Representation — Yerawada, Pune</h2>
<p>Yerawada is home to the <strong>Yerwada Central Prison</strong> — Pune\'s main jail facility — as well as a large residential population across Yerawada, Kalyani Nagar, and the Nagar Road belt. Families of undertrial prisoners held at Yerwada Central Prison frequently need urgent legal assistance for bail, default bail applications, and remand hearings.</p>
<p>Advocate Akash Chikate handles bail applications, remand opposition, and undertrial representation for clients from Yerawada and the Nagar Road corridor. We are familiar with the procedures for visiting undertrial clients and obtaining necessary court orders.</p>
<h2>Services for Yerawada Clients</h2>
<ul>
<li><strong>Bail Application</strong> — regular bail for undertrials held at Yerwada Central Prison</li>
<li><strong>Default Bail (S.187 BNSS)</strong> — statutory bail if chargesheet not filed on time</li>
<li><strong>Anticipatory Bail</strong> — prevent arrest before it happens</li>
<li><strong>Remand Opposition</strong> — arguing against police custody remand at JMFC level</li>
<li><strong>Criminal Defence</strong> — full trial defence at Pune subordinate courts and Sessions Court</li>
<li><strong>FIR Quashing</strong> — High Court relief for false cases registered at Yerawada PS</li>
</ul>
<p>If a family member has been taken into custody by Yerawada or Kalyani Nagar police, call us immediately. The first 24 hours after arrest are critical.</p>',
],

/* ======================================================
   12. MAGARPATTA
   ====================================================== */
[
'title'     => 'Criminal Lawyer in Magarpatta Pune',
'slug'      => 'criminal-lawyer-magarpatta-pune',
'area'      => 'Magarpatta',
'tagline'   => 'Cybercrime, POSH, corporate fraud, and criminal defence for Magarpatta City and Kharadi IT hub.',
'police'    => 'Hadapsar Police Station, Mundhwa Police Station',
'courts'    => 'Pune Sessions Court, Bombay High Court Pune Bench',
'focus_kw'  => 'criminal lawyer magarpatta pune',
'seo_title' => 'Criminal Lawyer in Magarpatta Pune — Cybercrime, POSH & Bail Expert',
'seo_desc'  => 'Criminal lawyer in Magarpatta City, Pune? Advocate Akash Chikate handles cybercrime FIRs, POSH compliance, bail, FIR quashing, and corporate fraud defence for Magarpatta and Kharadi clients.',
'content'   => '<h2>Legal Services for Magarpatta City &amp; Kharadi IT Hub</h2>
<p>Magarpatta City is a self-contained township that houses thousands of IT professionals and businesses. Together with the adjacent Kharadi IT Park, this corridor is one of Pune\'s most active technology zones. The professional demographic — largely IT employees, software engineers, and corporate executives — faces specific legal risks: cybercrime FIRs, POSH workplace complaints, relocation-driven matrimonial disputes (498A), and corporate fraud allegations.</p>
<p>Advocate Akash Chikate provides specialist legal defence to individuals and companies in the Magarpatta-Kharadi belt.</p>
<h2>Most Common Legal Issues Here</h2>
<ul>
<li><strong>Cybercrime Defence</strong> — IT professionals accused of hacking, fraud, or online harassment</li>
<li><strong>POSH Act</strong> — compliance setup, ICC training, complaint handling for Magarpatta companies</li>
<li><strong>Anticipatory Bail</strong> — IT employees facing arrest threat in financial or matrimonial disputes</li>
<li><strong>Corporate Fraud</strong> — cheating and misappropriation cases within tech companies</li>
<li><strong>498A / DV Act</strong> — matrimonial disputes from transferred employees</li>
<li><strong>FIR Quashing</strong> — High Court petitions for false workplace complaints</li>
</ul>',
],

/* ======================================================
   13. AUNDH
   ====================================================== */
[
'title'     => 'Criminal Lawyer in Aundh Pune',
'slug'      => 'criminal-lawyer-aundh-pune',
'area'      => 'Aundh',
'tagline'   => 'Criminal defence, bail, and legal services for Aundh, Sus Road and Panchawati residents.',
'police'    => 'Aundh Police Station, Chatushringi Police Station',
'courts'    => 'Pune Sessions Court, Bombay High Court Pune Bench',
'focus_kw'  => 'criminal lawyer aundh pune',
'seo_title' => 'Criminal Lawyer in Aundh Pune — Bail, 498A & Criminal Defence',
'seo_desc'  => 'Criminal lawyer in Aundh, Pune? Advocate Akash Chikate provides bail, anticipatory bail, 498A defence, cybercrime, and FIR quashing for Aundh, Sus Road and Panchawati residents.',
'content'   => '<h2>Criminal Defence for Aundh, Sus Road &amp; Panchawati</h2>
<p>Aundh is one of Pune\'s premier residential areas — a mix of established families, professionals, and students. Well-connected to Baner, Wakad, and central Pune, Aundh residents often face criminal matters that span multiple police jurisdictions. The area falls primarily under <strong>Aundh Police Station</strong> and <strong>Chatushringi Police Station</strong>.</p>
<p>Common legal matters from Aundh include matrimonial disputes, property-related FIRs, cybercrime complaints, and financial fraud cases. Advocate Akash Chikate serves Aundh clients from our Shivajinagar office — accessible in 15–20 minutes.</p>
<h2>Services for Aundh Residents</h2>
<ul>
<li><strong>Anticipatory Bail</strong> — apply before the police arrest you</li>
<li><strong>498A / Domestic Violence Defence</strong> — experienced matrimonial criminal defence</li>
<li><strong>Cybercrime FIR</strong> — online fraud and harassment complaints</li>
<li><strong>Bail After Arrest</strong> — urgent representation at Magistrate and Sessions Court</li>
<li><strong>Cheque Bounce</strong> — both recovery and defence under S.138 NI Act</li>
<li><strong>FIR Quashing</strong> — Bombay High Court petitions</li>
</ul>',
],

/* ======================================================
   14. KOREGAON PARK
   ====================================================== */
[
'title'     => 'Criminal Lawyer in Koregaon Park Pune',
'slug'      => 'criminal-lawyer-koregaon-park-pune',
'area'      => 'Koregaon Park',
'tagline'   => 'Criminal defence, bail, and discreet legal services for Koregaon Park, Kalyani Nagar and Boat Club Road.',
'police'    => 'Koregaon Park Police Station, Kalyani Nagar Police Station',
'courts'    => 'Pune Sessions Court, Bombay High Court Pune Bench',
'focus_kw'  => 'advocate koregaon park pune',
'seo_title' => 'Criminal Lawyer in Koregaon Park Pune — Discreet, Expert Legal Defence',
'seo_desc'  => 'Need a criminal lawyer in Koregaon Park, Pune? Advocate Akash Chikate provides discreet, expert legal defence — bail, cybercrime, 498A, NDPS, and High Court matters for KP and Kalyani Nagar clients.',
'content'   => '<h2>Discreet Criminal Defence for Koregaon Park &amp; Kalyani Nagar</h2>
<p>Koregaon Park is Pune\'s most high-profile residential address — home to business leaders, expats, hospitality establishments, and high-net-worth families. Criminal matters arising from Koregaon Park frequently require discreet, high-calibre legal representation — whether it is a high-profile matrimonial dispute, a NDPS case, a cybercrime allegation, or a financial fraud FIR.</p>
<p>Advocate Akash Chikate provides confidential, direct legal representation to clients from Koregaon Park, Kalyani Nagar, Boat Club Road, and Mundhwa. All matters are handled personally with complete confidentiality — no details are shared without your explicit consent.</p>
<h2>Services for Koregaon Park Clients</h2>
<ul>
<li><strong>Anticipatory Bail</strong> — discreet, urgent applications before arrest</li>
<li><strong>NDPS Defence</strong> — drug-related arrests in Koregaon Park; bail at Sessions Court and Bombay High Court</li>
<li><strong>High-Value Financial Fraud</strong> — cheating, EOW, and corporate criminal allegations</li>
<li><strong>498A / DV Act</strong> — matrimonial defence with complete confidentiality</li>
<li><strong>Cybercrime</strong> — online privacy violations, defamation, financial scam FIRs</li>
<li><strong>FIR Quashing</strong> — High Court petitions for motivated complaints</li>
</ul>
<p>Initial consultation can be arranged at a location convenient to you. Call or WhatsApp for a confidential discussion.</p>',
],

/* ======================================================
   15. PIMPLE SAUDAGAR
   ====================================================== */
[
'title'     => 'Criminal Lawyer in Pimple Saudagar Pune',
'slug'      => 'criminal-lawyer-pimple-saudagar-pune',
'area'      => 'Pimple Saudagar',
'tagline'   => 'Criminal defence, bail, and legal services for Pimple Saudagar, Pimple Gurav and Rahatni residents.',
'police'    => 'Sangvi Police Station, Pimple Gurav Police Station',
'courts'    => 'JMFC Pimpri-Chinchwad, Pune Sessions Court, Bombay High Court Pune Bench',
'focus_kw'  => 'criminal lawyer pimple saudagar pune',
'seo_title' => 'Criminal Lawyer in Pimple Saudagar Pune — Bail & Criminal Defence',
'seo_desc'  => 'Criminal lawyer in Pimple Saudagar, Pune? Advocate Akash Chikate handles bail, anticipatory bail, 498A, cybercrime, and criminal defence for Pimple Saudagar, Pimple Gurav and Rahatni clients.',
'content'   => '<h2>Criminal Defence for Pimple Saudagar, Pimple Gurav &amp; Rahatni</h2>
<p>Pimple Saudagar and adjoining Pimple Gurav and Rahatni are among Pune\'s fastest-growing residential zones — packed with middle-class families, working professionals, and small business owners. The area falls under the Sangvi and Pimple Gurav police station jurisdictions (PCMC). Criminal matters here frequently involve domestic disputes, property FIRs, NI Act cheque bounce cases, and cybercrime complaints.</p>
<p>Advocate Akash Chikate provides criminal defence and bail services to clients from Pimple Saudagar, Pimple Gurav, Rahatni, and Sangvi. Our Shivajinagar office is accessible within 25–30 minutes, and initial consultations can be conducted by phone or WhatsApp.</p>
<h2>Legal Services Available</h2>
<ul>
<li><strong>Anticipatory Bail</strong> — before police arrest you in a domestic or financial dispute</li>
<li><strong>Bail After Arrest</strong> — remand representation and bail applications at JMFC and Sessions Court</li>
<li><strong>498A / DV Act Defence</strong> — for accused and family members</li>
<li><strong>Cheque Bounce (NI Act)</strong> — both filing and defending S.138 matters</li>
<li><strong>Cybercrime</strong> — online fraud FIRs from Sangvi and Pimple Gurav police</li>
<li><strong>FIR Quashing</strong> — Bombay High Court intervention for false or frivolous complaints</li>
</ul>
<p>Call or WhatsApp for an immediate consultation. First consultation is free and confidential.</p>',
],

    ]; // end all 15 locations
}
