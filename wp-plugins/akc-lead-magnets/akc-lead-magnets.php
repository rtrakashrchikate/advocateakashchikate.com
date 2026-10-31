<?php
/**
 * Plugin Name: AKC Lead Magnets
 * Description: Lead capture forms for 8 free PDF guides. Captures name, phone, email — delivers PDF download link via email and on-screen.
 * Version: 1.0
 * Author: Advocate Akash Chikate & Associates
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// ─── Constants ────────────────────────────────────────────────────────────────
define( 'AKC_LM_VER',   '1.0' );
define( 'AKC_LM_TABLE', 'akc_leads' );

// ─── Guide definitions ────────────────────────────────────────────────────────
function akc_lm_guides() {
    return [
        1 => [
            'title'   => 'Emergency Bail Guide: First 24 Hours After Arrest',
            'file'    => '01-emergency-bail-guide.pdf',
            'slug'    => 'free-emergency-bail-guide',
            'tagline' => 'What to do — and what NOT to do — when someone you know is arrested in India.',
            'cta'     => 'Get My Free Emergency Bail Guide',
            'points'  => [
                'Step-by-step action plan for the first 24 hours',
                'All your rights under BNSS 2023 — explained simply',
                'Types of bail and which court to approach',
                'What NOT to do after an arrest',
            ],
        ],
        2 => [
            'title'   => 'Anticipatory Bail Guide: Protect Yourself Before Arrest',
            'file'    => '02-anticipatory-bail-guide.pdf',
            'slug'    => 'free-anticipatory-bail-guide',
            'tagline' => 'How to prevent arrest before it happens — Section 482 BNSS 2023.',
            'cta'     => 'Get My Free Anticipatory Bail Guide',
            'points'  => [
                'What anticipatory bail is and when you need it',
                'Grounds courts consider before granting bail',
                'Anticipatory bail vs regular bail — key differences',
                'The step-by-step application process',
            ],
        ],
        3 => [
            'title'   => 'Know Your Rights When Arrested in India',
            'file'    => '03-know-your-rights.pdf',
            'slug'    => 'free-know-your-rights-guide',
            'tagline' => 'Every right guaranteed under the Constitution and BNSS 2023 — in plain language.',
            'cta'     => 'Get My Free Rights Guide',
            'points'  => [
                'Constitutional rights — Articles 20, 21, 22',
                'BNSS 2023 statutory rights — Sections 47, 49, 51, 57',
                'DK Basu guidelines now codified in law',
                'What to do if your rights are violated in custody',
            ],
        ],
        4 => [
            'title'   => 'NDPS Act Defence Guide: Drug Offence Charges in India',
            'file'    => '04-ndps-defence-guide.pdf',
            'slug'    => 'free-ndps-defence-guide',
            'tagline' => 'Quantities, bail restrictions, and your legal options under the NDPS Act.',
            'cta'     => 'Get My Free NDPS Defence Guide',
            'points'  => [
                'Small vs commercial quantity table for all major substances',
                'Section 37 NDPS — the bail restriction explained',
                'How to challenge a seizure on procedural grounds',
                'Default bail rights under Section 479 BNSS',
            ],
        ],
        5 => [
            'title'   => 'Cybercrime Defence Guide: IT Act and BNS 2023',
            'file'    => '05-cybercrime-defence-guide.pdf',
            'slug'    => 'free-cybercrime-defence-guide',
            'tagline' => 'What to do if accused of hacking, fraud, harassment, or identity theft online.',
            'cta'     => 'Get My Free Cybercrime Defence Guide',
            'points'  => [
                'Cybercrime charges and the applicable law — quick reference table',
                'Why IP address evidence alone is not sufficient proof',
                'How to challenge digital evidence under BSA 2023',
                'Steps to take immediately if an FIR is filed',
            ],
        ],
        6 => [
            'title'   => 'Defending Against False Section 85 BNS Complaints',
            'file'    => '06-false-498a-defence-guide.pdf',
            'slug'    => 'free-false-498a-defence-guide',
            'tagline' => 'Protecting yourself and your family from misuse of matrimonial cruelty provisions.',
            'cta'     => 'Get My Free 498A Defence Guide',
            'points'  => [
                'What Section 85 BNS means and how it is misused',
                'Supreme Court\'s Arnesh Kumar guidelines on arrests',
                'How to quash an FIR at the Bombay High Court',
                'Steps to take the moment a complaint is filed',
            ],
        ],
        7 => [
            'title'   => 'Understanding POCSO: A Guide for the Accused and Their Families',
            'file'    => '07-pocso-defence-guide.pdf',
            'slug'    => 'free-pocso-defence-guide',
            'tagline' => 'The reversed burden of proof, bail challenges, and your legal options.',
            'cta'     => 'Get My Free POCSO Guide',
            'points'  => [
                'The reversed burden of proof — what it means for the defence',
                'When and how bail can be obtained in POCSO cases',
                'Common defence arguments and their basis in law',
                'Immediate steps for families of the accused',
            ],
        ],
        8 => [
            'title'   => 'How to Choose the Right Criminal Lawyer in Pune',
            'file'    => '08-choose-a-criminal-lawyer.pdf',
            'slug'    => 'free-choose-criminal-lawyer-guide',
            'tagline' => '10 questions to ask, red flags to avoid, and what good representation looks like.',
            'cta'     => 'Get My Free Lawyer Selection Guide',
            'points'  => [
                '10 questions to ask before hiring any criminal lawyer',
                'Red flags that signal an inexperienced or dishonest lawyer',
                'How to verify a lawyer\'s Bombay High Court experience',
                'What good criminal legal representation actually looks like',
            ],
        ],
    ];
}

// ─── Activation: create DB table + landing pages ──────────────────────────────
register_activation_hook( __FILE__, 'akc_lm_activate' );
function akc_lm_activate() {
    global $wpdb;
    $table   = $wpdb->prefix . AKC_LM_TABLE;
    $charset = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE IF NOT EXISTS {$table} (
        id        BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
        guide_id  TINYINT NOT NULL,
        name      VARCHAR(120) NOT NULL,
        phone     VARCHAR(30) NOT NULL,
        email     VARCHAR(120) NOT NULL,
        ip        VARCHAR(45) DEFAULT NULL,
        ua        TEXT DEFAULT NULL,
        created   DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id),
        KEY guide_id (guide_id),
        KEY email (email),
        KEY created (created)
    ) {$charset};";
    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta( $sql );

    // Create landing pages (skip if slug already exists)
    foreach ( akc_lm_guides() as $id => $g ) {
        if ( ! get_page_by_path( $g['slug'], OBJECT, 'page' ) ) {
            wp_insert_post( [
                'post_title'   => $g['title'],
                'post_name'    => $g['slug'],
                'post_status'  => 'publish',
                'post_type'    => 'page',
                'post_content' => '[akc_lead_magnet guide="' . $id . '"]',
                'meta_input'   => [
                    '_akc_lm_page' => '1',
                ],
            ] );
        }
    }

    update_option( 'akc_lm_version', AKC_LM_VER );
}

// ─── Deactivation: flush rewrite rules ────────────────────────────────────────
register_deactivation_hook( __FILE__, 'flush_rewrite_rules' );

// ─── Admin menu ───────────────────────────────────────────────────────────────
add_action( 'admin_menu', 'akc_lm_admin_menu' );
function akc_lm_admin_menu() {
    add_menu_page(
        'Lead Magnets',
        'Lead Magnets',
        'manage_options',
        'akc-lead-magnets',
        'akc_lm_admin_leads',
        'dashicons-email-alt',
        30
    );
    add_submenu_page(
        'akc-lead-magnets',
        'Collected Leads',
        'Collected Leads',
        'manage_options',
        'akc-lead-magnets',
        'akc_lm_admin_leads'
    );
    add_submenu_page(
        'akc-lead-magnets',
        'PDF Settings',
        'PDF Settings',
        'manage_options',
        'akc-lm-settings',
        'akc_lm_admin_settings'
    );
}

// ─── Admin: settings page (PDF URLs) ─────────────────────────────────────────
function akc_lm_admin_settings() {
    if ( ! current_user_can( 'manage_options' ) ) return;

    // Save
    if ( isset( $_POST['akc_lm_save'] ) && check_admin_referer( 'akc_lm_settings' ) ) {
        $urls = [];
        foreach ( akc_lm_guides() as $id => $g ) {
            $key        = 'akc_lm_url_' . $id;
            $urls[ $id ] = esc_url_raw( sanitize_text_field( wp_unslash( $_POST[ $key ] ?? '' ) ) );
        }
        update_option( 'akc_lm_pdf_urls', $urls );
        echo '<div class="notice notice-success"><p><strong>PDF URLs saved.</strong></p></div>';
    }

    // Auto-detect from media library
    if ( isset( $_POST['akc_lm_autodetect'] ) && check_admin_referer( 'akc_lm_settings' ) ) {
        $found = akc_lm_autodetect_pdfs();
        $saved = get_option( 'akc_lm_pdf_urls', [] );
        foreach ( $found as $id => $url ) {
            $saved[ $id ] = $url;
        }
        update_option( 'akc_lm_pdf_urls', $saved );
        echo '<div class="notice notice-success"><p><strong>Auto-detected ' . count( $found ) . ' PDF(s) from Media Library.</strong></p></div>';
    }

    $saved_urls = get_option( 'akc_lm_pdf_urls', [] );
    ?>
    <div class="wrap">
        <h1>Lead Magnet — PDF Settings</h1>
        <p>Paste the WordPress Media Library URL for each guide, or use <strong>Auto-Detect</strong> to find PDFs already uploaded.</p>
        <form method="post">
            <?php wp_nonce_field( 'akc_lm_settings' ); ?>
            <p><input type="submit" name="akc_lm_autodetect" class="button button-secondary" value="Auto-Detect PDFs from Media Library"></p>
            <table class="widefat striped" style="margin-top:16px">
                <thead><tr><th>#</th><th>Guide Title</th><th>PDF URL (from Media Library)</th><th>Status</th></tr></thead>
                <tbody>
                <?php foreach ( akc_lm_guides() as $id => $g ) :
                    $url    = $saved_urls[ $id ] ?? '';
                    $status = $url ? '<span style="color:green">&#10003; Set</span>' : '<span style="color:#c00">&#10007; Not set</span>';
                    ?>
                    <tr>
                        <td><?php echo esc_html( $id ); ?></td>
                        <td><?php echo esc_html( $g['title'] ); ?></td>
                        <td><input type="url" name="akc_lm_url_<?php echo esc_attr( $id ); ?>" value="<?php echo esc_url( $url ); ?>" style="width:100%"></td>
                        <td><?php echo $status; ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <p><input type="submit" name="akc_lm_save" class="button button-primary" value="Save PDF URLs"></p>
        </form>
        <hr>
        <h2>Landing Page URLs</h2>
        <table class="widefat striped">
            <thead><tr><th>Guide</th><th>Landing Page URL</th></tr></thead>
            <tbody>
            <?php foreach ( akc_lm_guides() as $id => $g ) :
                $page = get_page_by_path( $g['slug'], OBJECT, 'page' );
                $url  = $page ? get_permalink( $page->ID ) : '<em>Page not found — reactivate plugin</em>';
                ?>
                <tr>
                    <td><?php echo esc_html( $g['title'] ); ?></td>
                    <td><?php if ( $page ) { ?><a href="<?php echo esc_url( $url ); ?>" target="_blank"><?php echo esc_url( $url ); ?></a><?php } else { echo $url; } ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php
}

// Auto-detect PDFs from media library by filename
function akc_lm_autodetect_pdfs() {
    $found = [];
    foreach ( akc_lm_guides() as $id => $g ) {
        // Search by attachment filename
        $basename = $g['file'];
        $results  = get_posts( [
            'post_type'      => 'attachment',
            'post_status'    => 'inherit',
            'posts_per_page' => 1,
            'meta_query'     => [
                [
                    'key'     => '_wp_attached_file',
                    'value'   => $basename,
                    'compare' => 'LIKE',
                ],
            ],
        ] );
        if ( ! empty( $results ) ) {
            $found[ $id ] = wp_get_attachment_url( $results[0]->ID );
        }
    }
    return $found;
}

// ─── Admin: leads table ───────────────────────────────────────────────────────
function akc_lm_admin_leads() {
    if ( ! current_user_can( 'manage_options' ) ) return;
    global $wpdb;
    $table = $wpdb->prefix . AKC_LM_TABLE;

    // Export CSV
    if ( isset( $_GET['export'] ) && $_GET['export'] === 'csv' ) {
        akc_lm_export_csv();
        exit;
    }

    $filter_guide = isset( $_GET['guide_id'] ) ? intval( $_GET['guide_id'] ) : 0;
    $where        = $filter_guide ? $wpdb->prepare( 'WHERE guide_id = %d', $filter_guide ) : '';
    $leads        = $wpdb->get_results( "SELECT * FROM {$table} {$where} ORDER BY created DESC LIMIT 500" );
    $total        = $wpdb->get_var( "SELECT COUNT(*) FROM {$table} {$where}" );
    $guides       = akc_lm_guides();
    ?>
    <div class="wrap">
        <h1>Lead Magnets — Collected Leads
            <a href="<?php echo esc_url( add_query_arg( 'export', 'csv' ) ); ?>" class="page-title-action">Export CSV</a>
        </h1>
        <p><strong>Total leads:</strong> <?php echo intval( $total ); ?></p>

        <form method="get">
            <input type="hidden" name="page" value="akc-lead-magnets">
            <label for="guide_filter">Filter by guide:</label>
            <select name="guide_id" id="guide_filter">
                <option value="0">All guides</option>
                <?php foreach ( $guides as $id => $g ) :
                    $sel = selected( $filter_guide, $id, false );
                    echo '<option value="' . esc_attr( $id ) . '" ' . $sel . '>#' . esc_html( $id ) . ' — ' . esc_html( substr( $g['title'], 0, 50 ) ) . '</option>';
                endforeach; ?>
            </select>
            <input type="submit" class="button" value="Filter">
        </form>
        <br>
        <table class="widefat striped">
            <thead>
                <tr>
                    <th>ID</th><th>Guide</th><th>Name</th><th>Phone / WhatsApp</th><th>Email</th><th>Date</th>
                </tr>
            </thead>
            <tbody>
            <?php if ( empty( $leads ) ) : ?>
                <tr><td colspan="6">No leads yet.</td></tr>
            <?php else : ?>
                <?php foreach ( $leads as $lead ) :
                    $g_title = isset( $guides[ $lead->guide_id ] ) ? '#' . $lead->guide_id . ' ' . substr( $guides[ $lead->guide_id ]['title'], 0, 45 ) . '...' : 'Guide #' . $lead->guide_id;
                    ?>
                    <tr>
                        <td><?php echo esc_html( $lead->id ); ?></td>
                        <td><?php echo esc_html( $g_title ); ?></td>
                        <td><?php echo esc_html( $lead->name ); ?></td>
                        <td><?php echo esc_html( $lead->phone ); ?></td>
                        <td><?php echo esc_html( $lead->email ); ?></td>
                        <td><?php echo esc_html( $lead->created ); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php
}

function akc_lm_export_csv() {
    if ( ! current_user_can( 'manage_options' ) ) wp_die( 'Forbidden' );
    global $wpdb;
    $table  = $wpdb->prefix . AKC_LM_TABLE;
    $leads  = $wpdb->get_results( "SELECT * FROM {$table} ORDER BY created DESC", ARRAY_A );
    $guides = akc_lm_guides();
    header( 'Content-Type: text/csv; charset=UTF-8' );
    header( 'Content-Disposition: attachment; filename="akc-leads-' . date( 'Y-m-d' ) . '.csv"' );
    $out = fopen( 'php://output', 'w' );
    fputcsv( $out, [ 'ID', 'Guide', 'Name', 'Phone', 'Email', 'Date' ] );
    foreach ( $leads as $row ) {
        $g_title = isset( $guides[ $row['guide_id'] ] ) ? $guides[ $row['guide_id'] ]['title'] : 'Guide #' . $row['guide_id'];
        fputcsv( $out, [ $row['id'], $g_title, $row['name'], $row['phone'], $row['email'], $row['created'] ] );
    }
    fclose( $out );
}

// ─── Shortcode: [akc_lead_magnet guide="1"] ───────────────────────────────────
add_shortcode( 'akc_lead_magnet', 'akc_lm_shortcode' );
function akc_lm_shortcode( $atts ) {
    $atts   = shortcode_atts( [ 'guide' => '1' ], $atts );
    $gid    = intval( $atts['guide'] );
    $guides = akc_lm_guides();
    if ( ! isset( $guides[ $gid ] ) ) {
        return '<p><em>Lead magnet guide not found.</em></p>';
    }
    $g = $guides[ $gid ];

    ob_start();
    akc_lm_enqueue_styles();
    ?>
    <div class="akc-lm-wrap" id="akc-lm-<?php echo esc_attr( $gid ); ?>">

        <!-- Hero header -->
        <div class="akc-lm-hero">
            <div class="akc-lm-badge">FREE LEGAL GUIDE #<?php echo esc_html( $gid ); ?></div>
            <h1 class="akc-lm-title"><?php echo esc_html( $g['title'] ); ?></h1>
            <p class="akc-lm-tagline"><?php echo esc_html( $g['tagline'] ); ?></p>
        </div>

        <!-- Two-column layout: bullet points + form -->
        <div class="akc-lm-body">
            <div class="akc-lm-left">
                <h3>What you'll learn in this guide:</h3>
                <ul class="akc-lm-points">
                    <?php foreach ( $g['points'] as $point ) : ?>
                        <li><?php echo esc_html( $point ); ?></li>
                    <?php endforeach; ?>
                </ul>
                <div class="akc-lm-firm-block">
                    <strong>Advocate Akash Chikate &amp; Associates</strong><br>
                    Bombay High Court &amp; District Courts, Pune<br>
                    <small>LLM — Science &amp; Technology Laws (First Class Distinction)</small>
                </div>
            </div>
            <div class="akc-lm-right">
                <div class="akc-lm-form-box" id="akc-lm-form-box-<?php echo esc_attr( $gid ); ?>">
                    <p class="akc-lm-form-heading">Get your <strong>free</strong> copy now</p>
                    <form class="akc-lm-form" data-guide="<?php echo esc_attr( $gid ); ?>">
                        <?php wp_nonce_field( 'akc_lm_submit_' . $gid, 'akc_lm_nonce' ); ?>
                        <input type="hidden" name="guide_id" value="<?php echo esc_attr( $gid ); ?>">
                        <div class="akc-lm-field">
                            <label for="akc-name-<?php echo esc_attr( $gid ); ?>">Full Name <span>*</span></label>
                            <input type="text" id="akc-name-<?php echo esc_attr( $gid ); ?>" name="lm_name" placeholder="Your name" required>
                        </div>
                        <div class="akc-lm-field">
                            <label for="akc-phone-<?php echo esc_attr( $gid ); ?>">WhatsApp / Phone <span>*</span></label>
                            <input type="tel" id="akc-phone-<?php echo esc_attr( $gid ); ?>" name="lm_phone" placeholder="+91 98765 43210" required>
                        </div>
                        <div class="akc-lm-field">
                            <label for="akc-email-<?php echo esc_attr( $gid ); ?>">Email Address <span>*</span></label>
                            <input type="email" id="akc-email-<?php echo esc_attr( $gid ); ?>" name="lm_email" placeholder="you@email.com" required>
                        </div>
                        <button type="submit" class="akc-lm-btn"><?php echo esc_html( $g['cta'] ); ?></button>
                        <p class="akc-lm-privacy">We respect your privacy. No spam. Only relevant legal updates.</p>
                        <div class="akc-lm-error" style="display:none"></div>
                    </form>
                </div>
                <div class="akc-lm-success" id="akc-lm-success-<?php echo esc_attr( $gid ); ?>" style="display:none">
                    <div class="akc-lm-success-inner">
                        <div class="akc-lm-check">&#10003;</div>
                        <h3>Your guide is ready!</h3>
                        <p>We\'ve also sent the link to your email.</p>
                        <a class="akc-lm-download-btn" id="akc-lm-dl-<?php echo esc_attr( $gid ); ?>" href="#" target="_blank" download>
                            &#8681; Download Your Free Guide
                        </a>
                        <div class="akc-lm-cta-divider">&#x2015; Need legal help right now? &#x2015;</div>
                        <a class="akc-lm-wa-btn" href="https://wa.me/918698400302?text=Hi%2C+I+downloaded+the+<?php echo rawurlencode( $g['title'] ); ?>+and+need+legal+advice." target="_blank" rel="noopener">
                            &#128205; WhatsApp Us: +91 8698400302
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <p class="akc-lm-disclaimer">This guide is for general informational purposes only and does not constitute legal advice. Consult a qualified advocate for advice specific to your matter. Advocate Akash Chikate — Bar Council of India Licensed Advocate.</p>
    </div>
    <?php
    return ob_get_clean();
}

// ─── Enqueue inline styles ────────────────────────────────────────────────────
function akc_lm_enqueue_styles() {
    static $done = false;
    if ( $done ) return;
    $done = true;
    ?>
    <style>
    /* ── AKC Lead Magnet Styles ── */
    .akc-lm-wrap { font-family: 'DM Sans', 'Helvetica Neue', Arial, sans-serif; max-width: 860px; margin: 0 auto 40px; color: #2A2A2A; }
    .akc-lm-hero { background: #0A1628; color: #fff; padding: 40px 32px 32px; border-bottom: 4px solid #C9A96E; text-align: center; }
    .akc-lm-badge { display: inline-block; background: #C9A96E; color: #0A1628; font-size: 11px; font-weight: 700; letter-spacing: 1.5px; padding: 4px 14px; border-radius: 2px; margin-bottom: 14px; text-transform: uppercase; }
    .akc-lm-title { font-family: 'Playfair Display', Georgia, serif; font-size: 28px; font-weight: 700; color: #fff; margin: 0 0 12px; line-height: 1.25; }
    .akc-lm-tagline { font-size: 15px; color: #C9A96E; margin: 0; }
    .akc-lm-body { display: flex; gap: 32px; padding: 32px 0 0; flex-wrap: wrap; }
    .akc-lm-left { flex: 1 1 300px; }
    .akc-lm-left h3 { color: #0A1628; font-size: 14px; text-transform: uppercase; letter-spacing: 1px; margin: 0 0 14px; }
    .akc-lm-points { list-style: none; padding: 0; margin: 0 0 24px; }
    .akc-lm-points li { padding: 7px 0 7px 26px; border-bottom: 1px solid #f0f0f0; font-size: 14.5px; position: relative; line-height: 1.45; }
    .akc-lm-points li::before { content: '\2714'; position: absolute; left: 0; color: #C9A96E; font-weight: 700; }
    .akc-lm-firm-block { background: #f7f4ee; border-left: 4px solid #C9A96E; padding: 14px 16px; font-size: 13px; line-height: 1.6; color: #555; }
    .akc-lm-firm-block strong { color: #0A1628; font-size: 13.5px; }
    .akc-lm-right { flex: 0 0 320px; min-width: 280px; }
    .akc-lm-form-box { background: #fff; border: 2px solid #0A1628; border-radius: 4px; padding: 28px 24px; box-shadow: 0 4px 20px rgba(10,22,40,0.10); }
    .akc-lm-form-heading { font-weight: 600; font-size: 16px; color: #0A1628; margin: 0 0 18px; text-align: center; }
    .akc-lm-field { margin-bottom: 14px; }
    .akc-lm-field label { display: block; font-size: 12.5px; font-weight: 600; color: #0A1628; margin-bottom: 5px; }
    .akc-lm-field label span { color: #c00; }
    .akc-lm-field input { width: 100%; padding: 10px 12px; border: 1.5px solid #ccc; border-radius: 3px; font-size: 14px; box-sizing: border-box; transition: border-color .2s; }
    .akc-lm-field input:focus { outline: none; border-color: #C9A96E; }
    .akc-lm-btn { width: 100%; background: #C9A96E; color: #0A1628; border: none; padding: 13px; font-size: 14.5px; font-weight: 700; border-radius: 3px; cursor: pointer; letter-spacing: .3px; transition: background .2s; margin-top: 4px; }
    .akc-lm-btn:hover { background: #b8924f; }
    .akc-lm-privacy { font-size: 11px; color: #888; text-align: center; margin: 10px 0 0; }
    .akc-lm-error { color: #c00; font-size: 13px; margin-top: 10px; padding: 8px 10px; background: #fff0f0; border-radius: 3px; }
    .akc-lm-success { display: none; }
    .akc-lm-success-inner { background: #fff; border: 2px solid #C9A96E; border-radius: 4px; padding: 28px 20px; text-align: center; box-shadow: 0 4px 20px rgba(10,22,40,0.10); }
    .akc-lm-check { width: 50px; height: 50px; background: #C9A96E; border-radius: 50%; color: #0A1628; font-size: 24px; font-weight: 700; line-height: 50px; margin: 0 auto 16px; }
    .akc-lm-success-inner h3 { color: #0A1628; margin: 0 0 8px; font-size: 18px; }
    .akc-lm-success-inner p { color: #555; font-size: 13.5px; margin: 0 0 18px; }
    .akc-lm-download-btn { display: block; background: #0A1628; color: #C9A96E !important; padding: 13px 20px; border-radius: 3px; font-size: 15px; font-weight: 700; text-decoration: none !important; margin-bottom: 18px; }
    .akc-lm-download-btn:hover { background: #1a3050; }
    .akc-lm-cta-divider { font-size: 11px; color: #999; margin: 0 0 12px; }
    .akc-lm-wa-btn { display: block; background: #25D366; color: #fff !important; padding: 11px 20px; border-radius: 3px; font-size: 14px; font-weight: 700; text-decoration: none !important; }
    .akc-lm-wa-btn:hover { background: #1eba57; }
    .akc-lm-disclaimer { font-size: 11px; color: #999; margin-top: 24px; text-align: center; line-height: 1.5; }
    @media (max-width: 600px) {
        .akc-lm-body { flex-direction: column; }
        .akc-lm-right { min-width: 0; }
        .akc-lm-title { font-size: 22px; }
    }
    </style>
    <script>
    (function(){
        document.addEventListener('DOMContentLoaded', function(){
            document.querySelectorAll('.akc-lm-form').forEach(function(form){
                form.addEventListener('submit', function(e){
                    e.preventDefault();
                    var gid  = form.dataset.guide;
                    var btn  = form.querySelector('.akc-lm-btn');
                    var err  = form.querySelector('.akc-lm-error');
                    var data = new FormData(form);
                    data.append('action', 'akc_lm_submit');

                    btn.textContent = 'Sending...';
                    btn.disabled    = true;
                    err.style.display = 'none';

                    fetch('<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>', {
                        method: 'POST',
                        body:   data,
                        credentials: 'same-origin'
                    })
                    .then(function(r){ return r.json(); })
                    .then(function(res){
                        if ( res.success ) {
                            document.getElementById('akc-lm-form-box-' + gid).style.display = 'none';
                            var success = document.getElementById('akc-lm-success-' + gid);
                            success.style.display = 'block';
                            var dl = document.getElementById('akc-lm-dl-' + gid);
                            if ( res.data && res.data.pdf_url ) {
                                dl.href = res.data.pdf_url;
                            }
                        } else {
                            err.textContent    = res.data || 'Something went wrong. Please try again.';
                            err.style.display  = 'block';
                            btn.textContent    = form.querySelector('button').dataset.label || 'Get Guide';
                            btn.disabled       = false;
                        }
                    })
                    .catch(function(){
                        err.textContent   = 'Network error. Please check your connection and try again.';
                        err.style.display = 'block';
                        btn.disabled      = false;
                    });
                });
            });
        });
    })();
    </script>
    <?php
}

// ─── AJAX handler ─────────────────────────────────────────────────────────────
add_action( 'wp_ajax_akc_lm_submit',        'akc_lm_handle_submit' );
add_action( 'wp_ajax_nopriv_akc_lm_submit', 'akc_lm_handle_submit' );

function akc_lm_handle_submit() {
    // Verify nonce
    $guide_id = intval( $_POST['guide_id'] ?? 0 );
    if ( ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['akc_lm_nonce'] ?? '' ) ), 'akc_lm_submit_' . $guide_id ) ) {
        wp_send_json_error( 'Security check failed. Please refresh the page and try again.' );
    }

    // Validate inputs
    $name  = sanitize_text_field( wp_unslash( $_POST['lm_name']  ?? '' ) );
    $phone = sanitize_text_field( wp_unslash( $_POST['lm_phone'] ?? '' ) );
    $email = sanitize_email( wp_unslash( $_POST['lm_email']      ?? '' ) );

    if ( empty( $name ) || strlen( $name ) < 2 ) {
        wp_send_json_error( 'Please enter your full name.' );
    }
    if ( empty( $phone ) || strlen( $phone ) < 7 ) {
        wp_send_json_error( 'Please enter a valid phone number.' );
    }
    if ( ! is_email( $email ) ) {
        wp_send_json_error( 'Please enter a valid email address.' );
    }

    $guides = akc_lm_guides();
    if ( ! isset( $guides[ $guide_id ] ) ) {
        wp_send_json_error( 'Invalid guide. Please refresh the page.' );
    }
    $g = $guides[ $guide_id ];

    // Get PDF URL
    $pdf_urls = get_option( 'akc_lm_pdf_urls', [] );
    $pdf_url  = $pdf_urls[ $guide_id ] ?? '';

    // Save lead to DB
    global $wpdb;
    $table = $wpdb->prefix . AKC_LM_TABLE;
    $wpdb->insert( $table, [
        'guide_id' => $guide_id,
        'name'     => $name,
        'phone'    => $phone,
        'email'    => $email,
        'ip'       => sanitize_text_field( $_SERVER['REMOTE_ADDR'] ?? '' ),
        'ua'       => sanitize_text_field( $_SERVER['HTTP_USER_AGENT'] ?? '' ),
        'created'  => current_time( 'mysql' ),
    ] );

    // Email to user
    if ( ! empty( $pdf_url ) ) {
        $subject = 'Your Free Guide: ' . $g['title'];
        $message = "Dear {$name},\n\n";
        $message .= "Thank you for your interest. Your free guide is ready to download:\n\n";
        $message .= $g['title'] . "\n";
        $message .= $pdf_url . "\n\n";
        $message .= "---\n";
        $message .= "If you need legal assistance, contact us:\n";
        $message .= "WhatsApp: +91 8698400302\n";
        $message .= "Call: +91 8411982241\n";
        $message .= "Website: https://advocateakashchikate.com\n\n";
        $message .= "Advocate Akash Chikate & Associates\n";
        $message .= "Bombay High Court & District Courts, Pune\n\n";
        $message .= "---\n";
        $message .= "This guide is for general informational purposes only and does not constitute legal advice.\n";
        wp_mail( $email, $subject, $message, [
            'From: Advocate Akash Chikate <contact@advocateakashchikate.com>',
            'Reply-To: contact@advocateakashchikate.com',
        ] );
    }

    // Notification email to admin
    $admin_subject = '[AKC Lead] New download: Guide #' . $guide_id . ' — ' . $name;
    $admin_message = "New lead captured:\n\n";
    $admin_message .= "Guide:  #" . $guide_id . " — " . $g['title'] . "\n";
    $admin_message .= "Name:   " . $name . "\n";
    $admin_message .= "Phone:  " . $phone . "\n";
    $admin_message .= "Email:  " . $email . "\n";
    $admin_message .= "Time:   " . current_time( 'mysql' ) . "\n\n";
    $admin_message .= "View all leads: " . admin_url( 'admin.php?page=akc-lead-magnets' ) . "\n";
    wp_mail( 'advakashchikate@yahoo.com', $admin_subject, $admin_message );

    wp_send_json_success( [
        'pdf_url' => $pdf_url,
        'message' => 'Lead saved',
    ] );
}
