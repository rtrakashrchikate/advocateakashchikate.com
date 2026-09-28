<?php
/**
 * Plugin Name: AKC Meta Descriptions
 * Description: One-shot importer — sets Rank Math meta descriptions for all pages, practice areas, location pages, guides, and blog posts. Deactivate and delete after use.
 * Version: 1.0.0
 * Author: Advocate Akash Chikate
 */

if ( ! defined( 'ABSPATH' ) ) exit;

register_activation_hook( __FILE__, 'akc_set_all_meta_descriptions' );

function akc_set_all_meta_descriptions() {

    $entries = [

        /* ── CORE PAGES ─────────────────────────────────────────────── */
        'about'          => 'Advocate Akash R. Chikate — criminal defence lawyer in Pune with 8+ years, LLM Cyber Laws (Distinction), 27+ Bombay HC orders. Learn his practice, philosophy & credentials.',
        'contact'        => 'Book a free consultation with criminal lawyer Advocate Akash Chikate in Pune. Call +91 84119 82241 or WhatsApp +91 86984 00302. Office: Shivajinagar & Pimple Gurav.',
        'practice-areas' => 'Comprehensive legal services in Pune — criminal defence, anticipatory bail, FIR quashing, cybercrime, family law & more. Advocate Akash Chikate, 8+ years, Bombay HC.',
        'blog'           => 'Legal insights on criminal law, anticipatory bail, FIR quashing, cybercrime & family law in Pune — by Advocate Akash Chikate, 8+ years criminal defence practice.',
        'locations'      => 'Advocate Akash Chikate serves clients across Pune — Shivajinagar, Pimple Saudagar, Baner, Wakad, Hinjewadi & more. Criminal defence lawyer with free initial consultation.',
        'case-results'   => 'Real case outcomes by Advocate Akash Chikate — anticipatory bail granted, discharge orders, Bombay HC orders. Verified, anonymised results from Pune courts.',

        /* ── PRACTICE AREAS ─────────────────────────────────────────── */
        'anticipatory-bail'           => 'Facing arrest in Pune? Advocate Akash Chikate secures anticipatory bail fast at Bombay High Court & Sessions Court. 27+ HC orders. Free consultation: +91 84119 82241.',
        'bail-application'            => 'Arrested in Pune? Get bail granted quickly. Advocate Akash Chikate handles all bail applications before Sessions Court & Bombay High Court. Call now.',
        'fir-quashing'                => 'FIR filed against you in Pune? Advocate Akash Chikate quashes FIRs at Bombay High Court. 27+ published HC orders. Free consultation: +91 84119 82241.',
        'criminal-defence'            => 'Strong criminal defence in Pune from FIR to acquittal — Sessions Court to Bombay High Court. Advocate Akash Chikate, 8+ years, 99+ cases. Call now.',
        'ndps-drug-offence-defence'   => 'NDPS Act case in Pune? Advocate Akash Chikate handles drug offence defence — anticipatory bail, trial & Bombay HC matters. 8+ years experience. Free consultation.',
        'pocso-defence'               => 'POCSO case in Pune? Advocate Akash Chikate provides skilled, confidential defence for accused families at Sessions Court & Bombay High Court. Call now.',
        '498a-domestic-violence-defence' => 'False 498A or domestic violence case in Pune? Advocate Akash Chikate provides expert matrimonial defence — discharge, quashing & trial. Free consultation.',
        'cyber-it-law'                => 'Cybercrime FIR or notice in Pune? Advocate Akash Chikate — LLM Cyber Laws, IT Act & digital evidence specialist. Defence for online fraud, hacking & data theft.',
        'family-law-divorce'          => 'Divorce, child custody & family disputes in Pune Family Court. Advocate Akash Chikate provides sensitive, strategic legal support. Free consultation.',
        'mcoca-defence'               => 'MCOCA charges in Maharashtra? Advocate Akash Chikate handles organised crime defence — bail, discharge applications & trial. Call +91 84119 82241.',
        'sc-st-atrocities-act-defence'=> 'SC/ST Atrocities Act case in Pune? Advocate Akash Chikate provides balanced, thorough defence at Sessions Court & Bombay High Court. Free consultation.',
        'cheque-bounce-ni-act'        => 'Cheque bounce case under NI Act Section 138 in Pune? Advocate Akash Chikate handles both complainant & accused sides. Fast, strategic resolution.',
        'corporate-legal-advisory'    => 'Corporate legal advisory in Pune — contracts, compliance, shareholder disputes & business law. Advocate Akash Chikate advises startups to established firms.',
        'eow-financial-crimes-defence'=> 'EOW summons or financial fraud case in Pune? Advocate Akash Chikate defends economic offences — anticipatory bail, bail & trial defence. Call now.',
        'intellectual-property'       => 'Trademark, copyright & IP disputes in Pune. Advocate Akash Chikate handles IP registration, infringement enforcement & litigation. Free consultation.',
        'posh-workplace-law'          => 'POSH Act compliance for Pune employers. Advocate Akash Chikate provides ICC training, internal inquiry assistance & workplace law advisory. Call now.',
        'consumer-court'              => 'Consumer complaint against a company in Pune? Advocate Akash Chikate files and argues consumer forum cases efficiently. Call +91 84119 82241.',
        'discharge-application'       => 'Charged in a criminal case in Pune? A discharge application can end the case before trial begins. Advocate Akash Chikate, 8+ years. Free consultation.',

        /* ── LOCATION PAGES ─────────────────────────────────────────── */
        'criminal-lawyer-shivajinagar-pune'    => 'Criminal lawyer in Shivajinagar, Pune — Advocate Akash Chikate. Office at Ekbote Complex, Revenue Colony. Anticipatory bail, FIR quashing & criminal defence.',
        'criminal-lawyer-pimple-saudagar-pune' => 'Criminal lawyer serving Pimple Saudagar, Pune — Advocate Akash Chikate. Bail applications, FIR quashing & all criminal matters. Free consultation.',
        'criminal-lawyer-pimpri-chinchwad'     => 'Criminal lawyer for Pimpri-Chinchwad clients — Advocate Akash Chikate, Pune. Industrial area criminal cases, bail & FIR quashing. Call now.',
        'criminal-lawyer-kothrud-pune'         => 'Criminal lawyer serving Kothrud, Pune — Advocate Akash Chikate. Anticipatory bail, FIR quashing, 498A & cybercrime defence. Free consultation.',
        'criminal-lawyer-hadapsar-pune'        => 'Criminal lawyer serving Hadapsar, Pune — Advocate Akash Chikate. Bail applications, criminal defence & FIR quashing at Bombay High Court.',
        'criminal-lawyer-wakad-pune'           => 'Criminal lawyer serving Wakad, Pune — Advocate Akash Chikate. IT corridor cybercrime, NDPS, bail & all criminal matters. Free consultation.',
        'criminal-lawyer-baner-pune'           => 'Criminal lawyer serving Baner, Pune — Advocate Akash Chikate. Cybercrime, NDPS, anticipatory bail & FIR quashing. 8+ years experience.',
        'criminal-lawyer-viman-nagar-pune'     => 'Criminal lawyer serving Viman Nagar, Pune — Advocate Akash Chikate. Bail applications, cybercrime & criminal defence. Free consultation.',
        'criminal-lawyer-hinjewadi-pune'       => 'Criminal lawyer serving Hinjewadi, Pune — Advocate Akash Chikate. IT sector cybercrime, corporate fraud & criminal defence. Call now.',
        'criminal-lawyer-pune-camp'            => 'Criminal lawyer serving Pune Camp area — Advocate Akash Chikate. Bail, FIR quashing, criminal defence at Sessions Court & Bombay HC.',
        'criminal-lawyer-deccan-gymkhana-pune' => 'Criminal lawyer serving Deccan Gymkhana, Pune — Advocate Akash Chikate. All criminal matters, anticipatory bail & FIR quashing. Free consultation.',
        'criminal-lawyer-yerawada-pune'        => 'Criminal lawyer serving Yerawada, Pune — Advocate Akash Chikate. Yerawada Jail bail matters, criminal defence & FIR quashing specialist.',
        'criminal-lawyer-magarpatta-pune'      => 'Criminal lawyer serving Magarpatta, Pune — Advocate Akash Chikate. Cybercrime, corporate fraud, bail & all criminal matters. Call now.',
        'criminal-lawyer-aundh-pune'           => 'Criminal lawyer serving Aundh, Pune — Advocate Akash Chikate. Anticipatory bail, FIR quashing, 498A & criminal defence. Free consultation.',
        'criminal-lawyer-koregaon-park-pune'   => 'Criminal lawyer serving Koregaon Park, Pune — Advocate Akash Chikate. High-profile criminal defence, bail & FIR quashing at Bombay HC.',

        /* ── FREE GUIDE PAGES ───────────────────────────────────────── */
        'free-anticipatory-bail-guide'   => 'Free guide: How to get anticipatory bail in Pune — step-by-step process, documents needed & what to expect. By Advocate Akash Chikate.',
        'free-emergency-bail-guide'      => 'Free guide: Emergency bail process in Pune — what to do immediately after arrest. By Advocate Akash Chikate, criminal defence lawyer.',
        'free-false-498a-defence-guide'  => 'Free guide: Defending a false 498A case in Pune — grounds for discharge, quashing & what evidence matters. By Advocate Akash Chikate.',
        'free-ndps-defence-guide'        => 'Free guide: NDPS Act defence in Pune — bail eligibility, commercial vs small quantity, trial strategy. By Advocate Akash Chikate.',
        'free-pocso-defence-guide'       => 'Free guide: POCSO Act defence for accused families in Pune — process, bail & trial overview. By Advocate Akash Chikate.',
        'free-cybercrime-defence-guide'  => 'Free guide: Cybercrime FIR or notice in Pune — immediate steps, bail & defence strategy. By Advocate Akash Chikate, LLM Cyber Laws.',
        'free-know-your-rights-guide'    => 'Free guide: Know your legal rights when arrested in India — right to bail, lawyer & silence. By Advocate Akash Chikate, Pune.',
        'free-choose-criminal-lawyer-guide' => 'Free guide: How to choose the right criminal lawyer in Pune — 10 questions to ask before hiring. By Advocate Akash Chikate.',

        /* ── BLOG POSTS ─────────────────────────────────────────────── */
        'how-to-ensure-lawyer-answers-when-it-matters'       => 'Your lawyer must be reachable in a crisis. Learn how to ensure your criminal lawyer responds immediately when it matters most — by Adv. Akash Chikate.',
        'criminal-trial-process-india-fir-to-verdict'        => 'Step-by-step guide to the criminal trial process in India — from FIR registration to final verdict. What to expect at each stage, by Adv. Akash Chikate.',
        'witness-criminal-case-india-rights-obligations'     => 'Called as a witness in a criminal case in India? Know your rights, obligations and how to prepare — by Advocate Akash Chikate, Pune.',
        'plea-bargaining-india-criminal-case-bnss'           => 'Plea bargaining under BNSS in India — when to accept a deal and when to fight your case. Practical guide by Advocate Akash Chikate.',
        'investment-fraud-trading-app-scam-pune'             => 'Lost money to a trading app or investment scam in Pune? Know your legal options — FIR, recovery & cybercrime complaint. By Adv. Akash Chikate.',
        'stalking-harassment-complaint-pune-india'           => 'Being stalked or harassed in Pune? How to file a complaint under BNS, get a protection order & your legal rights explained.',
        'whatsapp-social-media-defamation-india-legal-options'=> 'Defamed on WhatsApp or social media in India? Your legal options — criminal complaint, civil suit & cease and desist. By Adv. Akash Chikate.',
        'child-custody-after-divorce-pune-family-court'      => 'Who gets child custody after divorce in Pune? Factors Pune Family Court considers — welfare, age, parents\' conduct. By Adv. Akash Chikate.',
        'domestic-violence-protection-order-pune-women'      => 'How to get a domestic violence protection order in Pune — process, documents needed & immediate relief available. By Adv. Akash Chikate.',
        'murder-case-defence-bns-section-103-india'          => 'Facing a murder charge under BNS Section 103 in India? Defence strategies, bail eligibility & trial process explained by Adv. Akash Chikate.',
        'property-fraud-cheating-case-pune'                  => 'Property fraud or cheating case in Pune? How to file a complaint, what to expect & how to defend yourself — by Adv. Akash Chikate.',
        'drug-offences-ndps-act-pune-penalties'              => 'NDPS Act drug offence in Pune — penalties, bail rules, commercial vs personal use quantities explained. By Advocate Akash Chikate.',
        'legal-aid-india-free-legal-help-maharashtra'        => 'How to get free legal aid in India and Maharashtra — who qualifies, where to apply & what help you get. By Adv. Akash Chikate.',
        'marital-disputes-family-court-vs-criminal-court-india'=> 'Should your marital dispute go to Family Court or Criminal Court? Key differences explained by Advocate Akash Chikate, Pune.',
        'legal-notice-india-when-to-send-format'             => 'When to send a legal notice in India, what it must include & the correct format — practical guide by Advocate Akash Chikate.',
        'default-bail-167-crpc-bnss-chargesheet-deadline'    => 'What is default bail under BNSS Section 187? Chargesheet deadline, how to apply & when courts grant it — by Adv. Akash Chikate.',
        'bombay-high-court-pune-bench-jurisdiction'          => 'Bombay High Court Pune Bench jurisdiction explained — which cases it hears, location & how to file. By Advocate Akash Chikate.',
        'online-fraud-cyber-scam-complaint-pune'             => 'How to report online fraud or cyber scam in Pune — Cybercrime portal, FIR & legal remedies. By Advocate Akash Chikate, LLM Cyber Laws.',
        'how-to-choose-criminal-lawyer-pune'                 => '10 key questions to ask before hiring a criminal lawyer in Pune. What qualifications, experience & track record to look for.',
        'pocso-act-cases-pune-accused-families'              => 'POCSO Act case in Pune — what accused families need to know about bail, trial process & defence. By Advocate Akash Chikate.',
        'consumer-court-pune-how-to-file-complaint'          => 'How to file a consumer complaint in Pune Consumer Forum — step-by-step process, fees & what relief you can claim.',
        'discharge-application-criminal-case-india'          => 'What is a discharge application in a criminal case? When to file, grounds & how it can end a case before trial — by Adv. Akash Chikate.',
        'eow-economic-offence-wing-pune-summons'             => 'Received an EOW summons in Pune? What it means, what to do immediately & how to protect your rights — by Adv. Akash Chikate.',
        'sc-st-atrocities-act-defence-pune'                  => 'SC/ST Atrocities Act case in Pune — bail restrictions, grounds for quashing & defence strategy. By Advocate Akash Chikate.',
        'intellectual-property-rights-india-pune-businesses' => 'Intellectual property rights for Pune businesses — trademarks, copyrights & how to protect them. By Advocate Akash Chikate.',
        'bail-after-arrest-pune-guide'                       => 'Complete guide to getting bail after arrest in Pune — types of bail, process, documents & what a lawyer does. By Adv. Akash Chikate.',
        'mcoca-charges-bail-defence-maharashtra'             => 'MCOCA charges in Maharashtra — bail restrictions, how defence works & what to expect at trial. By Advocate Akash Chikate.',
        'cheque-bounce-ni-act-pune'                          => 'Cheque bounce case under NI Act Section 138 in Pune — complaint process, penalties & defence options. By Adv. Akash Chikate.',
        'posh-act-compliance-pune-employers'                 => 'POSH Act compliance for Pune employers — ICC setup, complaint process & legal obligations. By Advocate Akash Chikate.',
        'ndps-act-bail-pune'                                 => 'How to get bail in an NDPS Act drug case in Pune — eligibility, process & bail conditions. By Advocate Akash Chikate.',
        'how-to-file-divorce-pune'                           => 'How to file for divorce in Pune Family Court — mutual consent vs contested, process, documents & timeline. By Adv. Akash Chikate.',
        'cybercrime-notice-fir-pune-action-plan'             => 'Received a cybercrime notice or FIR in Pune? Immediate action plan — do\'s, don\'ts & how to get bail. By Adv. Akash Chikate.',
        'rights-when-arrested-india'                         => 'Your rights when arrested in India — right to bail, lawyer, silence & against illegal detention. Know the law before it happens.',
        '498a-domestic-violence-defence-pune'                => '498A and domestic violence case in Pune — how to defend, grounds for discharge & quashing. By Advocate Akash Chikate.',
        'how-to-get-anticipatory-bail-pune'                  => 'How to get anticipatory bail in Pune — who can apply, process at Sessions Court & Bombay HC, documents needed. By Adv. Akash Chikate.',
        'fir-quashing-bombay-high-court-pune'                => 'How to get an FIR quashed at Bombay High Court from Pune — grounds, process & documents needed. By Adv. Akash Chikate, 27+ HC orders.',
        'defining-domestic-violence'                         => 'What is domestic violence under Indian law? Physical, emotional, economic & sexual abuse defined. Legal remedies available in Maharashtra.',
        'dhangekar-gets-anticipatory-bail-pune-court'        => 'Case update: Anticipatory bail granted by Pune court — analysis of the order, grounds & legal significance. By Adv. Akash Chikate.',
    ];

    $updated = 0;
    $skipped = 0;
    $not_found = [];

    foreach ( $entries as $slug => $description ) {

        // Try pages first, then any post type
        $post = get_page_by_path( $slug, OBJECT, [ 'page', 'post', 'practice_area', 'location_page', 'case_result' ] );

        if ( ! $post ) {
            // Fallback: search all post types by slug
            $args = [
                'name'           => $slug,
                'post_type'      => 'any',
                'post_status'    => 'publish',
                'posts_per_page' => 1,
            ];
            $results = get_posts( $args );
            $post = $results ? $results[0] : null;
        }

        if ( $post ) {
            $existing = get_post_meta( $post->ID, 'rank_math_description', true );
            if ( empty( $existing ) ) {
                update_post_meta( $post->ID, 'rank_math_description', sanitize_text_field( $description ) );
                $updated++;
            } else {
                $skipped++; // Already has a description — don\'t overwrite
            }
        } else {
            $not_found[] = $slug;
        }
    }

    // Log results to a transient for display
    set_transient( 'akc_meta_desc_results', [
        'updated'   => $updated,
        'skipped'   => $skipped,
        'not_found' => $not_found,
    ], 300 );
}

// Show results as an admin notice after activation
add_action( 'admin_notices', function() {
    $results = get_transient( 'akc_meta_desc_results' );
    if ( ! $results ) return;
    delete_transient( 'akc_meta_desc_results' );

    $nf = implode( ', ', $results['not_found'] );
    echo '<div class="notice notice-success is-dismissible"><p>';
    echo '<strong>AKC Meta Descriptions:</strong> ';
    echo 'Set: <strong>' . intval( $results['updated'] ) . '</strong> &nbsp;|&nbsp; ';
    echo 'Already had description (skipped): <strong>' . intval( $results['skipped'] ) . '</strong>';
    if ( $nf ) {
        echo '<br><strong>Not found (check slugs):</strong> ' . esc_html( $nf );
    }
    echo '</p></div>';
} );
