<?php
/**
 * Plugin Name: AKC Case Result Importer
 * Description: Creates 11 Bombay High Court case result posts. One-time use.
 * Version: 1.0
 */
if ( ! defined( 'ABSPATH' ) ) exit;

register_activation_hook( __FILE__, 'akc_import_cases' );

add_action( 'admin_notices', function() {
    if ( ! current_user_can( 'manage_options' ) ) return;
    if ( get_option( 'akc_cases_imported' ) ) {
        echo '<div class="notice notice-success"><p><strong>AKC Case Importer:</strong> All 11 case results already created. You can deactivate and delete this plugin.</p></div>';
        return;
    }
    $nonce = wp_create_nonce( 'akc_case_import' );
    echo '<div class="notice notice-warning"><p><strong>AKC Case Importer:</strong> Case results not yet created. <a href="' . admin_url( 'admin.php?akc_case_import=1&_wpnonce=' . $nonce ) . '" class="button button-primary">Create All 11 Case Results Now</a></p></div>';
});

add_action( 'admin_init', function() {
    if ( empty( $_GET['akc_case_import'] ) ) return;
    check_admin_referer( 'akc_case_import' );
    if ( ! current_user_can( 'manage_options' ) ) return;
    akc_import_cases();
    wp_redirect( admin_url( 'edit.php?post_type=case_result&akc_done=1' ) );
    exit;
});

add_action( 'admin_notices', function() {
    if ( ! empty( $_GET['akc_done'] ) ) {
        echo '<div class="notice notice-success is-dismissible"><p><strong>Success!</strong> All 11 case results have been created.</p></div>';
    }
});

function akc_import_cases() {
    if ( get_option( 'akc_cases_imported' ) ) return;

    foreach ( akc_get_cases() as $case ) {
        $existing = get_page_by_path( $case['slug'], OBJECT, 'case_result' );
        if ( $existing ) continue;

        $post_id = wp_insert_post([
            'post_title'  => $case['title'],
            'post_name'   => $case['slug'],
            'post_content'=> '',
            'post_status' => 'publish',
            'post_type'   => 'case_result',
        ]);

        if ( is_wp_error( $post_id ) || ! $post_id ) continue;

        update_post_meta( $post_id, 'akc_cr_court',       $case['court'] );
        update_post_meta( $post_id, 'akc_cr_bench',       $case['bench'] );
        update_post_meta( $post_id, 'akc_cr_date',        $case['date'] );
        update_post_meta( $post_id, 'akc_cr_date_sort',   $case['date_sort'] );
        update_post_meta( $post_id, 'akc_cr_section',     $case['section'] );
        update_post_meta( $post_id, 'akc_cr_result',      $case['result'] );
        update_post_meta( $post_id, 'akc_cr_result_type', $case['result_type'] );
        update_post_meta( $post_id, 'akc_cr_summary',     $case['summary'] );
        update_post_meta( $post_id, 'akc_cr_argument',    $case['argument'] );

        update_post_meta( $post_id, 'rank_math_title',       $case['seo_title'] );
        update_post_meta( $post_id, 'rank_math_description', $case['seo_desc'] );
    }

    update_option( 'akc_cases_imported', true );
}

function akc_get_cases() {
    return [

[
'title'       => 'Anticipatory Bail Granted — SC/ST Atrocities Act | Bombay High Court 2025',
'slug'        => 'anticipatory-bail-sc-st-act-bhc-2025-sayyed',
'court'       => 'Bombay High Court',
'bench'       => 'Justice Shivkumar Dige',
'date'        => 'July 2025',
'date_sort'   => '2025-07',
'section'     => 'SC/ST Prevention of Atrocities Act + BNSS S.482',
'result'      => 'Anticipatory Bail Granted',
'result_type' => 'success',
'summary'     => 'Applicant apprehended arrest in a caste atrocity matter arising from a dispute at a PMC garbage unloading point. The High Court noted that the applicant\'s name was not mentioned in the FIR at all and that the caste abuse allegations were general and in chorus — not specific to the applicant. The first informant was found to be a history-sheeter with MCOCA applied against him. Anticipatory bail granted with standard conditions.',
'argument'    => 'Applicant not named in FIR; allegations of caste abuse omnibus and vague; complainant\'s credibility undermined by his own criminal antecedents.',
'seo_title'   => 'Anticipatory Bail Granted — SC/ST Act | Bombay High Court 2025',
'seo_desc'    => 'Bombay High Court granted anticipatory bail in SC/ST Atrocities Act matter — name absent from FIR, caste abuse allegations unspecific, complainant a history-sheeter.',
],

[
'title'       => 'Interim Protection from Arrest — EOW Financial Fraud | Bombay High Court 2025',
'slug'        => 'interim-protection-eow-financial-fraud-bhc-2025',
'court'       => 'Bombay High Court',
'bench'       => 'Justice R.N. Laddha',
'date'        => 'July 2025',
'date_sort'   => '2025-07',
'section'     => 'Financial Fraud — EOW Pimpri-Chinchwad',
'result'      => 'Interim Protection Granted (No Coercive Action)',
'result_type' => 'success',
'summary'     => 'Applicants faced arrest in an EOW Pimpri-Chinchwad financial fraud FIR. The High Court granted interim protection against coercive action, accepting the submission that the dispute was essentially civil in nature and that the FIR was lodged after an inordinate, unexplained delay since November 2022. Applicants deposited Rs.1 Crore with the Court Registry to demonstrate bona fides. Matter stood over for final hearing.',
'argument'    => 'Dispute is civil in nature; FIR filed with inordinate delay casting doubt on genuineness; applicants demonstrated bona fides by depositing Rs.1 Crore with court.',
'seo_title'   => 'Interim Protection Against Arrest — EOW Fraud | Bombay High Court 2025',
'seo_desc'    => 'Bombay High Court granted interim protection to applicants in EOW Pimpri-Chinchwad financial fraud matter — civil dispute, inordinate FIR delay, Rs.1 Crore deposited.',
],

[
'title'       => 'MCOCA Proclamation Stayed — Absconding Accused | Bombay High Court 2025',
'slug'        => 'mcoca-proclamation-stayed-bhc-2025',
'court'       => 'Bombay High Court',
'bench'       => 'Justice S.M. Modak',
'date'        => 'July 2025',
'date_sort'   => '2025-07',
'section'     => 'MCOCA + BNSS Sections 109, 118, 126, 111',
'result'      => 'Proclamation Stayed — Anticipatory Bail Directed on Priority',
'result_type' => 'success',
'summary'     => 'Petitioner was shown as an absconding accused in a MCOCA chargesheet registered at Kothrud Police Station. The proclamation order passed by the MCOCA Special Judge was challenged by writ petition. The High Court held that the filing of an anticipatory bail application itself demonstrated that the petitioner had taken recourse to law — the police were aware of the pending application through their own report, making the absconding label untenable. Proclamation kept in abeyance; Special Judge directed to hear anticipatory bail on priority.',
'argument'    => 'Filing of anticipatory bail application negates absconding — police\'s own report to that court acknowledged the pending application; proclamation procedure not followed correctly.',
'seo_title'   => 'MCOCA Proclamation Stayed — Writ Petition | Bombay High Court 2025',
'seo_desc'    => 'Bombay High Court stayed MCOCA absconding proclamation — petitioner had filed anticipatory bail, demonstrating engagement with legal process, not absconding.',
],

[
'title'       => 'Murder Conviction — Sentence Suspended, Bail Granted Pending Appeal | Bombay HC DB 2025',
'slug'        => 'murder-sentence-suspended-bail-bhc-db-2025-jamdade',
'court'       => 'Bombay High Court — Division Bench',
'bench'       => 'Revati Mohite Dere & Sandesh D. Patil, JJ.',
'date'        => 'September 2025',
'date_sort'   => '2025-09',
'section'     => 'S.302 IPC — Murder (Life Imprisonment)',
'result'      => 'Sentence Suspended — Bail Granted Pending Appeal',
'result_type' => 'success',
'summary'     => 'Applicant was convicted of murder under Section 302 IPC and sentenced to life imprisonment by the Additional Sessions Judge, Pune. The Division Bench suspended the sentence pending appeal. The prosecution\'s case rested entirely on a single recovery — an axe allegedly recovered 7 days after the incident. Both eyewitnesses (the nephew and wife of the applicant) had turned hostile. The Court found the recovery evidence suspicious as the same panch witness appeared in both the spot panchnama and the recovery panchnama, and the axe was recovered from an open space already covered in the spot panchnama.',
'argument'    => 'No direct evidence; both prosecution eyewitnesses turned hostile; recovery evidence suspicious — same panch for spot and recovery; S.106 Evidence Act cannot substitute prosecution burden.',
'seo_title'   => 'Murder Sentence Suspended Pending Appeal | Bombay High Court 2025',
'seo_desc'    => 'Bombay HC Division Bench suspended life imprisonment sentence pending appeal — sole recovery evidence found suspicious, both eyewitnesses turned hostile.',
],

[
'title'       => 'Murder Bail Granted After 4 Years — Sessions Court Had Rejected | Bombay High Court 2025',
'slug'        => 'murder-bail-granted-after-4-years-bhc-2025',
'court'       => 'Bombay High Court',
'bench'       => 'Justice Ashwin D. Bhobe',
'date'        => 'August 2025',
'date_sort'   => '2025-08',
'section'     => 'S.302 IPC — Murder',
'result'      => 'Bail Granted (Sessions Court Rejection Overturned)',
'result_type' => 'success',
'summary'     => 'Applicant had been in custody since June 2021 — over 4 years — for a murder arising from a sudden quarrel. The Additional Sessions Judge had rejected bail in July 2024. The High Court granted bail finding the assault occurred at the spur of the moment, without premeditation, in the heat of passion — bringing the case prima facie within Exception 4 to Section 300 IPC (culpable homicide not amounting to murder). The trial had progressed at a glacial pace with only 1 of 26 listed prosecution witnesses examined in over 4 years.',
'argument'    => 'No premeditation; sudden quarrel; Exception 4 to S.300 IPC prima facie applicable; severe trial delay — only 1 of 26 witnesses examined in 4+ years of custody.',
'seo_title'   => 'Bail Granted in Murder Case After 4 Years | Bombay High Court 2025',
'seo_desc'    => 'Bombay High Court granted bail in S.302 murder matter after 4+ years in custody — sudden quarrel, no premeditation, Exception 4 to S.300 IPC, severe trial delay.',
],

[
'title'       => 'POCSO Conviction — Bail Granted Pending Appeal | Bombay High Court 2025',
'slug'        => 'pocso-conviction-bail-pending-appeal-bhc-2025',
'court'       => 'Bombay High Court',
'bench'       => 'Justice Sarang V. Kotwal',
'date'        => 'August 2025',
'date_sort'   => '2025-08',
'section'     => 'POCSO Act S.11 r/w 12 + IPC S.363, S.507',
'result'      => 'Bail Granted Pending Appeal',
'result_type' => 'success',
'summary'     => 'Applicant was convicted under the POCSO Act and IPC for kidnapping and sentenced to 7 years rigorous imprisonment. Bail was granted pending appeal after the Court examined the victim\'s own deposition. The victim herself had repeatedly insisted on going with the applicant; on multiple occasions the applicant had told her to return home. The Court found the sentence harsh and excessive given that the victim had left home of her own free will and the applicant had not taken undue advantage of the situation.',
'argument'    => 'Victim\'s own deposition showed she left home voluntarily and persisted despite applicant asking her to return; sentence disproportionate to the facts; no undue advantage taken.',
'seo_title'   => 'POCSO Bail Pending Appeal Granted | Bombay High Court 2025',
'seo_desc'    => 'Bombay HC granted bail in POCSO conviction appeal — victim\'s own deposition showed she left voluntarily, sentence found harsh and excessive.',
],

[
'title'       => 'Child Trafficking Bail After 3 Years — S.370 IPC | Bombay High Court 2025',
'slug'        => 'child-trafficking-bail-section-370-bhc-2025',
'court'       => 'Bombay High Court',
'bench'       => 'Justice Dr. Neela Gokhale',
'date'        => 'September 2025',
'date_sort'   => '2025-09',
'section'     => 'S.370(1)(4)(5) IPC + S.120-B + S.81 JJ Act (Child Trafficking)',
'result'      => 'Bail Granted After Nearly 3 Years in Custody',
'result_type' => 'success',
'summary'     => 'Applicant had been in custody since November 2022 — nearly 3 years — in a child trafficking case. The Court had previously observed in related matters that the applicability of Section 370 IPC was itself debatable on the facts. The main accused and all co-accused had already been granted bail. Charges had not yet been framed by the trial court. Bail was granted on grounds of parity, long incarceration, and the debatable nature of S.370 applicability.',
'argument'    => 'Parity — main accused and all co-accused already on bail; charges not framed after 3 years in custody; applicability of S.370 IPC to the facts is itself debatable.',
'seo_title'   => 'Bail in S.370 Child Trafficking Case After 3 Years | Bombay High Court 2025',
'seo_desc'    => 'Bombay HC granted bail in child trafficking S.370 IPC matter — main accused on bail, charges not framed, applicability of S.370 on facts found debatable.',
],

[
'title'       => 'Attempt to Murder + Arms Act — Bail Granted, Sessions Court Had Rejected | Bombay HC 2025',
'slug'        => 'attempt-murder-arms-act-bail-bhc-2025',
'court'       => 'Bombay High Court',
'bench'       => 'Justice Ashwin D. Bhobe',
'date'        => 'September 2025',
'date_sort'   => '2025-09',
'section'     => 'S.307 IPC (Attempt to Murder) + Arms Act S.4(25)',
'result'      => 'Bail Granted (Sessions Court Rejection Overturned)',
'result_type' => 'success',
'summary'     => 'Applicant — a 22-year-old college student — had been in custody since July 2022 in a case arising from a parking dispute that turned violent. He was accused of assaulting the injured on the head with a sickle. The Sessions Court had rejected bail. The High Court granted bail noting that the medical certificate on record did not support the prosecution\'s case — there was no corresponding injury attributable to the alleged weapon. Trial had not progressed with charges remaining unframed. Parity argument succeeded as co-accused with similar or greater alleged roles had been released on bail.',
'argument'    => 'Medical evidence inconsistent with alleged weapon; charges not framed despite long custody; parity with co-accused already on bail whose alleged roles were comparable or greater.',
'seo_title'   => 'S.307 Attempt to Murder Bail Granted | Bombay High Court 2025',
'seo_desc'    => 'Bombay HC granted bail in S.307 attempt to murder matter — medical evidence inconsistent with prosecution case, charges not framed, parity with co-accused.',
],

[
'title'       => 'Murder Conviction — Bail Pending Appeal Rejected | Bombay High Court DB 2025',
'slug'        => 'murder-conviction-bail-rejected-bhc-db-2025',
'court'       => 'Bombay High Court — Division Bench',
'bench'       => 'Sarang V. Kotwal & Advait M. Sethna, JJ.',
'date'        => 'August 2025',
'date_sort'   => '2025-08',
'section'     => 'S.302 IPC — Murder Conviction',
'result'      => 'Bail Application Rejected',
'result_type' => 'rejected',
'summary'     => 'Applicant had been convicted of murder in a multiple-accused assault case. Application for bail pending appeal was rejected by the Division Bench. The Court found that unlike co-accused who had been released on bail, the applicant was specifically attributed the use of a deadly weapon (sword) by two independent eyewitnesses. The roles were clearly distinguishable — the bail grounds available to other accused did not apply to this applicant given the direct evidence of his specific role.',
'argument'    => 'Distinguished from co-accused granted bail — specific role with deadly weapon attributed by two independent witnesses; direct evidence of participation clearly established.',
'seo_title'   => 'Murder Conviction Bail Rejected — Specific Role Established | Bombay HC DB 2025',
'seo_desc'    => 'Bombay HC Division Bench rejected bail in murder conviction — applicant distinguished from co-accused who received bail based on specific weapon role established by two eyewitnesses.',
],

[
'title'       => 'Murder Conviction Altered from S.302 to S.304 Part I — Sentence Reduced | Bombay HC DB 2025',
'slug'        => 'murder-conviction-altered-304-sentence-reduced-bhc-db-2025',
'court'       => 'Bombay High Court — Division Bench',
'bench'       => 'Sarang V. Kotwal & Advait M. Sethna, JJ.',
'date'        => 'August 2025',
'date_sort'   => '2025-08',
'section'     => 'S.302 IPC → Altered to S.304 Part I IPC',
'result'      => 'Appeal Partly Allowed — Life Sentence Set Aside, Convicted Under S.304 Part I, Sentence Reduced to Period Already Undergone',
'result_type' => 'success',
'summary'     => 'Appellant had been convicted of murder under S.302 IPC and sentenced to life imprisonment for pushing a person from a railway skywalk at Kandivali. He had been in continuous custody since June 2014 — over 11 years. The Division Bench altered the conviction from S.302 to S.304 Part I IPC. The Court found that the prosecution had failed to explain significant injuries on the appellant\'s person, established no prior enmity or motive, and the evidence showed a sudden fight. The incident fell within Exception 4 to Section 300 IPC. Sentence was reduced to the period already undergone and the appellant was directed to be released.',
'argument'    => 'Injuries on appellant unexplained by prosecution; no motive or prior enmity established; sudden fight on skywalk — Exception 4 to S.300 IPC; prosecution case does not establish ingredients of S.300/302.',
'seo_title'   => 'Murder Conviction S.302 Altered to S.304 Part I — Life Sentence Set Aside | Bombay HC 2025',
'seo_desc'    => 'Bombay HC Division Bench altered murder conviction from S.302 to S.304 Part I IPC, reducing life sentence to period undergone (11+ years) — sudden fight, injuries on accused unexplained.',
],

[
'title'       => 'Murder Conviction — Bail Granted Pending Appeal for Women Co-Accused | Bombay HC DB 2025',
'slug'        => 'murder-conviction-bail-women-co-accused-bhc-db-2025',
'court'       => 'Bombay High Court — Division Bench',
'bench'       => 'Sarang V. Kotwal & Shyam C. Chandak, JJ.',
'date'        => 'July 2025',
'date_sort'   => '2025-07',
'section'     => 'S.302 r/w 149 IPC (Murder — Unlawful Assembly)',
'result'      => 'Bail Granted Pending Appeal',
'result_type' => 'success',
'summary'     => 'Two women applicants — wives of the main accused — had been convicted with the aid of S.149 IPC for murder in a multi-accused assault case. Bail was granted pending appeal. The Division Bench found that the second independent eyewitness (PW2) had not referred to the applicants at all — only PW1 (wife of the deceased) had named them. No deadly weapon was attributed to either applicant. The Court accepted the submission that they had possibly been roped in due to their family connection with the main accused. They had been on bail during the trial and had not misused their liberty.',
'argument'    => 'PW2 (independent eyewitness) made no reference to applicants; no weapon attributed; role minimal and distinct from main accused; women applicants on bail during trial without misuse.',
'seo_title'   => 'Bail Granted for Women Co-Accused in Murder Case | Bombay HC DB 2025',
'seo_desc'    => 'Bombay HC Division Bench granted bail pending appeal to two women convicted under S.302 r/w 149 IPC — independent eyewitness did not name them, no weapon attributed, minimal role.',
],

    ]; // end all 11 cases
}
