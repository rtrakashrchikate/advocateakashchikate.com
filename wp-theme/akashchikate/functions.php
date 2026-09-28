<?php
/**
 * Akash Chikate Law — functions.php
 * Theme setup, enqueue scripts, Custom Post Types, nav menus
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/* Google Search Console verification */
add_action( 'wp_head', function() {
    echo '<meta name="google-site-verification" content="E33jvV5c65vm0II9g0O1nQXzd3ZRytLidKqoIoTIp5I" />' . "\n";
}, 1 );

/* ════════════════════════════════════════════
   1. THEME SETUP
════════════════════════════════════════════ */
function akc_theme_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', [ 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ] );
    add_theme_support( 'custom-logo' );
    add_theme_support( 'menus' );

    register_nav_menus( [
        'primary' => __( 'Primary Navigation', 'akashchikate' ),
    ] );
}
add_action( 'after_setup_theme', 'akc_theme_setup' );

/* ════════════════════════════════════════════
   2. ENQUEUE STYLES & SCRIPTS
════════════════════════════════════════════ */
function akc_enqueue_assets() {
    $ver = '1.0.0';
    $uri = get_template_directory_uri();

    // Google Fonts
    wp_enqueue_style(
        'akc-fonts',
        'https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,600&family=Inter:wght@300;400;500;600;700&display=swap',
        [],
        null
    );

    // Font Awesome handled by Font Awesome WordPress plugin — no enqueue needed here.

    // Theme stylesheet
    wp_enqueue_style( 'akc-style', $uri . '/assets/css/style.css', [ 'akc-fonts' ], $ver );

    // Theme JS
    wp_enqueue_script( 'akc-main', $uri . '/assets/js/main.js', [], $ver, true );
}
add_action( 'wp_enqueue_scripts', 'akc_enqueue_assets' );

/* ════════════════════════════════════════════
   3. CUSTOM POST TYPE — CASE RESULTS
════════════════════════════════════════════ */
function akc_register_cpts() {

    // Case Results CPT
    register_post_type( 'case_result', [
        'labels' => [
            'name'               => 'Case Results',
            'singular_name'      => 'Case Result',
            'add_new'            => 'Add Case Result',
            'add_new_item'       => 'Add New Case Result',
            'edit_item'          => 'Edit Case Result',
            'view_item'          => 'View Case Result',
            'all_items'          => 'All Case Results',
            'search_items'       => 'Search Case Results',
            'not_found'          => 'No case results found.',
        ],
        'public'             => true,
        'has_archive'        => true,
        'menu_icon'          => 'dashicons-hammer',
        'menu_position'      => 5,
        'supports'           => [ 'title', 'editor', 'thumbnail', 'custom-fields' ],
        'rewrite'            => [ 'slug' => 'case-results' ],
        'show_in_rest'       => true,
    ] );

    // Practice Areas CPT
    register_post_type( 'practice_area', [
        'labels' => [
            'name'               => 'Practice Areas',
            'singular_name'      => 'Practice Area',
            'add_new'            => 'Add Practice Area',
            'add_new_item'       => 'Add New Practice Area',
            'edit_item'          => 'Edit Practice Area',
            'all_items'          => 'All Practice Areas',
        ],
        'public'             => true,
        'has_archive'        => true,
        'menu_icon'          => 'dashicons-clipboard',
        'menu_position'      => 6,
        'supports'           => [ 'title', 'editor', 'thumbnail', 'custom-fields', 'page-attributes' ],
        'rewrite'            => [ 'slug' => 'practice-areas' ],
        'show_in_rest'       => true,
    ] );

    // Location Pages CPT
    register_post_type( 'location_page', [
        'labels' => [
            'name'               => 'Location Pages',
            'singular_name'      => 'Location Page',
            'add_new'            => 'Add Location Page',
            'all_items'          => 'All Location Pages',
        ],
        'public'             => true,
        'has_archive'        => false,
        'menu_icon'          => 'dashicons-location',
        'menu_position'      => 7,
        'supports'           => [ 'title', 'editor', 'thumbnail', 'custom-fields' ],
        'rewrite'            => [ 'slug' => 'criminal-lawyer' ],
        'show_in_rest'       => true,
    ] );
}
add_action( 'init', 'akc_register_cpts' );

/* ════════════════════════════════════════════
   4. CASE RESULT CUSTOM META BOXES
════════════════════════════════════════════ */
function akc_case_result_meta_boxes() {
    add_meta_box(
        'case_result_details',
        'Case Result Details',
        'akc_case_result_meta_box_html',
        'case_result',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'akc_case_result_meta_boxes' );

function akc_case_result_meta_box_html( $post ) {
    wp_nonce_field( 'akc_case_result_save', 'akc_case_result_nonce' );
    $fields = [
        'akc_client_name'   => 'Client Name (e.g. Dilbarsingh Chauhan)',
        'akc_citation'      => 'Citation (e.g. 2025:BHC-AS:36505-DB)',
        'akc_offence'       => 'Offence / Section (e.g. S.302 IPC / Murder)',
        'akc_result'        => 'Result (e.g. BAIL GRANTED / CONVICTION SET ASIDE)',
        'akc_result_type'   => 'Result Type (bail_granted / conviction_overturned / protection_granted / bail_rejected)',
        'akc_court'         => 'Court (e.g. Bombay High Court)',
        'akc_year'          => 'Year (e.g. 2025)',
    ];
    foreach ( $fields as $key => $label ) {
        $val = get_post_meta( $post->ID, $key, true );
        echo '<p><label style="font-weight:600;display:block;margin-bottom:4px;">' . esc_html( $label ) . '</label>';
        echo '<input type="text" name="' . esc_attr( $key ) . '" value="' . esc_attr( $val ) . '" style="width:100%;padding:6px 10px;" /></p>';
    }
}

function akc_save_case_result_meta( $post_id ) {
    if ( ! isset( $_POST['akc_case_result_nonce'] ) ) return;
    if ( ! wp_verify_nonce( $_POST['akc_case_result_nonce'], 'akc_case_result_save' ) ) return;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    $fields = [ 'akc_client_name', 'akc_citation', 'akc_offence', 'akc_result', 'akc_result_type', 'akc_court', 'akc_year' ];
    foreach ( $fields as $key ) {
        if ( isset( $_POST[ $key ] ) ) {
            update_post_meta( $post_id, $key, sanitize_text_field( $_POST[ $key ] ) );
        }
    }
}
add_action( 'save_post', 'akc_save_case_result_meta' );

/* ════════════════════════════════════════════
   5. PRACTICE AREA META BOX
════════════════════════════════════════════ */
function akc_practice_area_meta_boxes() {
    add_meta_box(
        'practice_area_details',
        'Practice Area Details',
        'akc_practice_area_meta_box_html',
        'practice_area',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'akc_practice_area_meta_boxes' );

function akc_practice_area_meta_box_html( $post ) {
    wp_nonce_field( 'akc_pa_save', 'akc_pa_nonce' );
    $fields = [
        'akc_pa_icon'         => 'Font Awesome Icon Class (e.g. fa-solid fa-gavel)',
        'akc_pa_tier'         => 'Tier (1 = primary, 2 = secondary)',
        'akc_pa_summary'      => 'Short Summary (1-2 sentences for listing cards)',
        'akc_pa_anchor'       => 'Anchor/Section ID (e.g. criminal, cyber, family)',
    ];
    foreach ( $fields as $key => $label ) {
        $val = get_post_meta( $post->ID, $key, true );
        echo '<p><label style="font-weight:600;display:block;margin-bottom:4px;">' . esc_html( $label ) . '</label>';
        echo '<input type="text" name="' . esc_attr( $key ) . '" value="' . esc_attr( $val ) . '" style="width:100%;padding:6px 10px;" /></p>';
    }
}

function akc_save_practice_area_meta( $post_id ) {
    if ( ! isset( $_POST['akc_pa_nonce'] ) ) return;
    if ( ! wp_verify_nonce( $_POST['akc_pa_nonce'], 'akc_pa_save' ) ) return;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    $fields = [ 'akc_pa_icon', 'akc_pa_tier', 'akc_pa_summary', 'akc_pa_anchor' ];
    foreach ( $fields as $key ) {
        if ( isset( $_POST[ $key ] ) ) {
            update_post_meta( $post_id, $key, sanitize_text_field( $_POST[ $key ] ) );
        }
    }
}
add_action( 'save_post', 'akc_save_practice_area_meta' );

/* ════════════════════════════════════════════
   6. THEME CONSTANTS (easy editing in one place)
════════════════════════════════════════════ */
define( 'AKC_PHONE',           '+918411982241' );
define( 'AKC_PHONE_DISPLAY',   '+91 84119 82241' );
define( 'AKC_WHATSAPP',        '+918698400302' );
define( 'AKC_WHATSAPP_DISPLAY','+91 86984 00302' );
define( 'AKC_EMAIL',           'contact@advocateakashchikate.com' );
define( 'AKC_ADDRESS_1',       'Office No. 202-203, Ekbote Complex, Above Dr. Gajanan Ekbote Hospital, Revenue Colony, Shivajinagar, Pune' );
define( 'AKC_ADDRESS_2',       'Ravikaran Heights, Shivdatta Nagar, Pimple Gurav, Pune' );
define( 'AKC_WA_MSG',          'Hello+Advocate+Akash%2C+I+need+legal+assistance.' );
define( 'AKC_WA_URGENT',       'URGENT%3A+I+need+immediate+legal+help+for+a+bail+matter.' );

/* Social media profile URLs — update once profiles are created */
define( 'AKC_SOCIAL_LINKEDIN', 'https://www.linkedin.com/in/advocateakashchikate' );
define( 'AKC_SOCIAL_FACEBOOK', '' );  /* Add Facebook URL when profile is ready */
define( 'AKC_SOCIAL_TWITTER',  '' );  /* Add Twitter/X URL when profile is ready */

/* ════════════════════════════════════════════
   7. HELPER FUNCTIONS
════════════════════════════════════════════ */

// WhatsApp link builder
function akc_wa_link( $msg = null ) {
    $m = $msg ?: AKC_WA_MSG;
    return 'https://wa.me/' . AKC_WHATSAPP . '?text=' . $m;
}

// Emergency WhatsApp link
function akc_wa_urgent() {
    return akc_wa_link( AKC_WA_URGENT );
}

// Phone call link
function akc_phone_link() {
    return 'tel:' . AKC_PHONE;
}

/* ════════════════════════════════════════════
   8. REMOVE WP DEFAULT ITEMS FROM HEAD
════════════════════════════════════════════ */
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wp_shortlink_wp_head' );

/* ════════════════════════════════════════════
   9. CONTACT FORM 7 — FORM ID STORAGE
════════════════════════════════════════════ */
// After installing Contact Form 7 and creating the consultation form,
// update this option via Settings > Akash Chikate or directly in DB:
// Option name: akc_cf7_consultation_id — set to your CF7 form ID
// Then the contact page will render: [contact-form-7 id="X"]

/* ════════════════════════════════════════════
   10. ADD BODY CLASS FOR PAGE IDENTIFICATION
════════════════════════════════════════════ */
function akc_body_classes( $classes ) {
    if ( is_front_page() ) $classes[] = 'page-home';
    if ( is_page( 'about' ) ) $classes[] = 'page-about';
    if ( is_page( 'contact' ) ) $classes[] = 'page-contact';
    if ( is_singular( 'case_result' ) ) $classes[] = 'page-case-result';
    if ( is_singular( 'practice_area' ) ) $classes[] = 'page-practice-area';
    return $classes;
}
add_filter( 'body_class', 'akc_body_classes' );

/* ════════════════════════════════════════════
   11. FLUSH REWRITE RULES ON ACTIVATION
════════════════════════════════════════════ */
function akc_activation() {
    akc_register_cpts();
    flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'akc_activation' );

/* ════════════════════════════════════════════
   12. SCHEMA MARKUP — JSON-LD
════════════════════════════════════════════ */
add_action( 'wp_head', 'akc_schema_markup' );
function akc_schema_markup() {

    $base_url = home_url( '/' );

    /* ── Sitewide: LegalService + LocalBusiness ── */
    $org = [
        '@context'        => 'https://schema.org',
        '@type'           => [ 'LegalService', 'LocalBusiness' ],
        '@id'             => $base_url . '#legalservice',
        'name'            => 'Advocate Akash R. Chikate & Associates',
        'alternateName'   => 'Akash Chikate Law',
        'url'             => $base_url,
        'logo'            => $base_url . 'wp-content/themes/akashchikate/assets/images/logo.svg',
        'image'           => $base_url . 'wp-content/themes/akashchikate/assets/images/logo.svg',
        'description'     => 'Criminal defence law firm in Pune specialising in anticipatory bail, FIR quashing, cybercrime, NDPS, MCOCA, 498A, and Bombay High Court matters.',
        'telephone'       => AKC_PHONE,
        'email'           => AKC_EMAIL,
        'priceRange'      => '₹₹',
        'currenciesAccepted' => 'INR',
        'paymentAccepted' => 'Cash, Bank Transfer, UPI',
        'areaServed'      => [
            [ '@type' => 'City', 'name' => 'Pune' ],
            [ '@type' => 'State', 'name' => 'Maharashtra' ],
        ],
        'serviceType'     => [
            'Criminal Defence',
            'Anticipatory Bail',
            'Bail Application',
            'FIR Quashing',
            'Cybercrime Defence',
            'NDPS Defence',
            'MCOCA Defence',
            'POCSO Defence',
            '498A Defence',
            'Family Law',
            'Divorce',
            'POSH Act Compliance',
        ],
        'address'         => [
            '@type'           => 'PostalAddress',
            'streetAddress'   => 'Office No. 202-203, Ekbote Complex, Revenue Colony, Shivajinagar',
            'addressLocality' => 'Pune',
            'addressRegion'   => 'Maharashtra',
            'postalCode'      => '411005',
            'addressCountry'  => 'IN',
        ],
        'geo'             => [
            '@type'     => 'GeoCoordinates',
            'latitude'  => '18.5308',
            'longitude' => '73.8475',
        ],
        'openingHoursSpecification' => [
            [
                '@type'     => 'OpeningHoursSpecification',
                'dayOfWeek' => [ 'Monday','Tuesday','Wednesday','Thursday','Friday','Saturday' ],
                'opens'     => '10:00',
                'closes'    => '19:00',
            ],
        ],
        'sameAs'          => [
            'https://www.linkedin.com/in/advocateakashchikate',
            'https://maps.app.goo.gl/ShivajinagarprimaryGMB',  /* TODO: replace with actual Shivajinagar GMB short URL */
            'https://maps.app.goo.gl/PimpleGuravGMB',          /* TODO: replace with actual Pimple Gurav GMB short URL */
        ],
        'aggregateRating' => [
            '@type'       => 'AggregateRating',
            'ratingValue' => '5.0',
            'reviewCount' => '5',
            'bestRating'  => '5',
            'worstRating' => '1',
        ],
        'hasOfferCatalog' => [
            '@type' => 'OfferCatalog',
            'name'  => 'Legal Services',
        ],
        'employee'        => [
            '@type'       => 'Person',
            '@id'         => $base_url . '#advocate',
            'name'        => 'Akash R. Chikate',
            'jobTitle'    => 'Advocate — Bombay High Court',
            'worksFor'    => [ '@id' => $base_url . '#legalservice' ],
            'alumniOf'    => [
                [ '@type' => 'EducationalOrganization', 'name' => 'ILS Law College, Pune' ],
            ],
            'knowsAbout'  => [
                'Criminal Law India',
                'Anticipatory Bail BNSS',
                'FIR Quashing Bombay High Court',
                'NDPS Act Defence',
                'MCOCA Maharashtra',
                'Cyber Law India',
                'POCSO Defence',
                'Domestic Violence Act',
            ],
            'memberOf'    => [
                [ '@type' => 'Organization', 'name' => 'Bar Council of Maharashtra and Goa' ],
                [ '@type' => 'Organization', 'name' => 'Bombay High Court Bar Association' ],
            ],
        ],
    ];

    /* ── Branch location: Pimple Gurav ── */
    $branch = [
        '@context'              => 'https://schema.org',
        '@type'                 => [ 'LegalService', 'LocalBusiness' ],
        '@id'                   => $base_url . '#legalservice-pimplegurav',
        'name'                  => 'Advocate Akash R. Chikate & Associates — Pimple Gurav',
        'url'                   => $base_url,
        'telephone'             => AKC_PHONE,
        'email'                 => AKC_EMAIL,
        'parentOrganization'    => [ '@id' => $base_url . '#legalservice' ],
        'address'               => [
            '@type'           => 'PostalAddress',
            'streetAddress'   => 'Ravikaran Heights, Shivdatta Nagar, Pimple Gurav',
            'addressLocality' => 'Pune',
            'addressRegion'   => 'Maharashtra',
            'postalCode'      => '411061',
            'addressCountry'  => 'IN',
        ],
        'geo'                   => [
            '@type'     => 'GeoCoordinates',
            'latitude'  => '18.5912',
            'longitude' => '73.7884',
        ],
        'openingHoursSpecification' => [
            [
                '@type'     => 'OpeningHoursSpecification',
                'dayOfWeek' => [ 'Monday','Tuesday','Wednesday','Thursday','Friday','Saturday' ],
                'opens'     => '10:00',
                'closes'    => '19:00',
            ],
        ],
        'sameAs' => [
            'https://maps.app.goo.gl/PimpleGuravGMB', /* TODO: replace with actual Pimple Gurav GMB short URL */
        ],
    ];

    /* ── Homepage: org schema + FAQPage ── */
    if ( is_front_page() ) {
        echo '<script type="application/ld+json">' . wp_json_encode( $org, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT ) . '</script>' . "\n";
        echo '<script type="application/ld+json">' . wp_json_encode( $branch, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n";

        $hp_faq = [
            '@context'   => 'https://schema.org',
            '@type'      => 'FAQPage',
            'mainEntity' => [
                [
                    '@type'          => 'Question',
                    'name'           => 'How do I get anticipatory bail in Pune?',
                    'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'To get anticipatory bail in Pune, file an application under Section 482 of the BNSS 2023 at the Sessions Court, Pune. If Sessions Court rejects it, you can approach the Bombay High Court. Anticipatory bail prevents arrest before it happens — apply as soon as you have reason to believe arrest is imminent. Advocate Akash Chikate handles anticipatory bail matters at Pune Sessions Court and Bombay High Court. Call +91 8411982241 for urgent matters.' ],
                ],
                [
                    '@type'          => 'Question',
                    'name'           => 'What should I do immediately after an FIR is filed against me in Pune?',
                    'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'If an FIR is registered against you in Pune: (1) Do not speak to police without a lawyer. (2) Consult a criminal lawyer immediately. (3) Apply for anticipatory bail if you fear arrest. (4) Obtain a copy of the FIR. (5) Preserve all relevant documents and digital evidence. Acting quickly in the first 24–48 hours significantly affects the outcome of your case.' ],
                ],
                [
                    '@type'          => 'Question',
                    'name'           => 'What is the difference between anticipatory bail and regular bail?',
                    'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Anticipatory bail (Section 482, BNSS 2023) is applied for before arrest — it is a protective direction preventing police from arresting a person. Regular bail (Section 483, BNSS 2023) is applied for after a person has already been arrested. Anticipatory bail is proactive; regular bail is remedial. Both can be applied at Sessions Court; if rejected, an application can be made to the Bombay High Court.' ],
                ],
                [
                    '@type'          => 'Question',
                    'name'           => 'Does Advocate Akash Chikate practice at Bombay High Court?',
                    'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Yes. Advocate Akash R. Chikate is enrolled at the Bombay High Court and regularly appears before Bombay High Court benches at Pune and Mumbai. He has 27+ Bombay High Court orders on Indian Kanoon across bail, criminal appeals, and writ petition matters.' ],
                ],
            ],
        ];
        echo '<script type="application/ld+json">' . wp_json_encode( $hp_faq, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n";
        return;
    }

    /* Output org schema on all pages */
    echo '<script type="application/ld+json">' . wp_json_encode( $org, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n";

    /* ── Breadcrumb schema ── */
    $breadcrumb_items = [
        [ '@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => $base_url ],
    ];
    $position = 2;

    if ( is_singular( 'practice_area' ) ) {
        $breadcrumb_items[] = [ '@type' => 'ListItem', 'position' => $position++, 'name' => 'Practice Areas', 'item' => $base_url . 'practice-areas/' ];
        $breadcrumb_items[] = [ '@type' => 'ListItem', 'position' => $position,   'name' => get_the_title(), 'item' => get_permalink() ];
    } elseif ( is_singular( 'case_result' ) ) {
        $breadcrumb_items[] = [ '@type' => 'ListItem', 'position' => $position++, 'name' => 'Case Results', 'item' => $base_url . 'case-results/' ];
        $breadcrumb_items[] = [ '@type' => 'ListItem', 'position' => $position,   'name' => get_the_title(), 'item' => get_permalink() ];
    } elseif ( is_singular( 'location_page' ) ) {
        $breadcrumb_items[] = [ '@type' => 'ListItem', 'position' => $position++, 'name' => 'Locations', 'item' => $base_url . 'locations/' ];
        $breadcrumb_items[] = [ '@type' => 'ListItem', 'position' => $position,   'name' => get_the_title(), 'item' => get_permalink() ];
    } elseif ( is_singular( 'post' ) ) {
        $breadcrumb_items[] = [ '@type' => 'ListItem', 'position' => $position++, 'name' => 'Blog', 'item' => $base_url . 'blog/' ];
        $breadcrumb_items[] = [ '@type' => 'ListItem', 'position' => $position,   'name' => get_the_title(), 'item' => get_permalink() ];
    } elseif ( is_page() ) {
        $breadcrumb_items[] = [ '@type' => 'ListItem', 'position' => $position, 'name' => get_the_title(), 'item' => get_permalink() ];
    }

    if ( count( $breadcrumb_items ) > 1 ) {
        $breadcrumb = [
            '@context'        => 'https://schema.org',
            '@type'           => 'BreadcrumbList',
            'itemListElement' => $breadcrumb_items,
        ];
        echo '<script type="application/ld+json">' . wp_json_encode( $breadcrumb, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n";
    }

    /* ── Practice Area: FAQPage schema ── */
    if ( is_singular( 'practice_area' ) ) {
        $faqs_raw = get_post_meta( get_the_ID(), 'akc_pa_faqs', true );
        $faqs     = $faqs_raw ? json_decode( $faqs_raw, true ) : [];
        if ( ! empty( $faqs ) && is_array( $faqs ) ) {
            $faq_entities = [];
            foreach ( $faqs as $faq ) {
                if ( empty( $faq['q'] ) || empty( $faq['a'] ) ) continue;
                $faq_entities[] = [
                    '@type'          => 'Question',
                    'name'           => $faq['q'],
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text'  => wp_strip_all_tags( $faq['a'] ),
                    ],
                ];
            }
            if ( ! empty( $faq_entities ) ) {
                $faq_schema = [
                    '@context'   => 'https://schema.org',
                    '@type'      => 'FAQPage',
                    'mainEntity' => $faq_entities,
                ];
                echo '<script type="application/ld+json">' . wp_json_encode( $faq_schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n";
            }
        }
    }

    /* ── Blog post: Article schema ── */
    if ( is_singular( 'post' ) ) {
        $article = [
            '@context'      => 'https://schema.org',
            '@type'         => 'Article',
            'headline'      => get_the_title(),
            'url'           => get_permalink(),
            'datePublished' => get_the_date( 'c' ),
            'dateModified'  => get_the_modified_date( 'c' ),
            'author'        => [ '@id' => $base_url . '#advocate' ],
            'publisher'     => [ '@id' => $base_url . '#legalservice' ],
            'inLanguage'    => 'en-IN',
        ];
        echo '<script type="application/ld+json">' . wp_json_encode( $article, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n";
    }
}

/* ════════════════════════════════════════════
   13. SEO ENHANCEMENTS (Audit fixes — Mar 2026)
════════════════════════════════════════════ */

/* ── Fix: Homepage title tag ── */
add_filter( 'rank_math/frontend/title', function( $title ) {
    if ( is_front_page() ) {
        return 'Criminal Lawyer in Pune | Bail &amp; FIR Quashing | Adv. Akash Chikate';
    }
    return $title;
} );
// Fallback if Rank Math filter isn't available
add_filter( 'pre_get_document_title', function( $title ) {
    if ( is_front_page() ) {
        return 'Criminal Lawyer in Pune | Bail &amp; FIR Quashing | Adv. Akash Chikate';
    }
    return $title;
}, 99 );

/* ── Fix: Demote H1 → H2 inside the_content() for all singular pages ──
   Importers wrote multiple H1s inside post content. The template H1
   (hero title) is outside the_content() and remains H1.
   Ahrefs flagged 28 pages with multiple H1 tags — extending to all
   singular content (posts, pages, CPTs). */
add_filter( 'the_content', function( $content ) {
    if ( is_singular() ) {
        $content = preg_replace( '/<h1(\b[^>]*)>/i',  '<h2$1>',  $content );
        $content = preg_replace( '/<\/h1>/i',          '</h2>',    $content );
    }
    return $content;
}, 5 );

/* ── Fix: Wrap tables in scrollable div for mobile ──
   Prevents horizontal overflow on narrow screens. */
add_filter( 'the_content', function( $content ) {
    if ( is_admin() ) return $content;
    return preg_replace(
        '/<table(\b[^>]*)>/i',
        '<div class="table-wrap"><table$1>',
        preg_replace( '/<\/table>/i', '</table></div>', $content )
    );
}, 15 );

/* ── Fix: Lazy loading on all content images ──
   WordPress 5.5+ adds loading="lazy" via wp_filter_content_tags.
   This filter is an explicit safeguard for any images that bypass it. */
add_filter( 'wp_lazy_loading_enabled', '__return_true' );

add_filter( 'the_content', function( $content ) {
    if ( is_admin() ) return $content;
    // Add loading="lazy" only to img tags that don't already have a loading attribute
    return preg_replace(
        '/<img\b(?![^>]*\bloading\s*=)([^>]*)>/i',
        '<img loading="lazy"$1>',
        $content
    );
}, 20 );

// Post thumbnails (archive/blog grids) — skip hero/LCP images via class check
add_filter( 'post_thumbnail_html', function( $html ) {
    if ( strpos( $html, 'loading=' ) === false ) {
        $html = str_replace( '<img ', '<img loading="lazy" ', $html );
    }
    return $html;
} );

/* ── Fix: OG / Open Graph tags for homepage ──
   Rank Math v6.9.4 on this install has no Social Meta module active,
   so OG tags are not output by Rank Math. We output them directly.
   Priority 99 = runs after Rank Math (priority ~1).
   If Rank Math ever starts outputting them too, duplicates are harmless
   (first value wins in social scrapers). */
add_action( 'wp_head', function() {
    if ( ! is_front_page() ) return;
    $title   = 'Criminal Lawyer in Pune | Bail &amp; FIR Quashing | Adv. Akash Chikate';
    $desc    = 'Criminal defence lawyer in Pune — anticipatory bail, FIR quashing, NDPS, cybercrime &amp; 498A. Adv. Akash R. Chikate, 8+ years, 27+ Bombay HC orders. Free consultation.';
    $img_url = esc_url( get_template_directory_uri() . '/assets/images/logo.svg' );
    $url     = esc_url( home_url( '/' ) );
    echo '<meta property="og:type" content="website">' . "\n";
    echo '<meta property="og:title" content="' . esc_attr( $title ) . '">' . "\n";
    echo '<meta property="og:description" content="' . esc_attr( $desc ) . '">' . "\n";
    echo '<meta property="og:image" content="' . $img_url . '">' . "\n";
    echo '<meta property="og:url" content="' . $url . '">' . "\n";
    echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
    echo '<meta name="twitter:title" content="' . esc_attr( $title ) . '">' . "\n";
    echo '<meta name="twitter:description" content="' . esc_attr( $desc ) . '">' . "\n";
    echo '<meta name="twitter:image" content="' . $img_url . '">' . "\n";
}, 99 );

/* ════════════════════════════════════════════
   14. 301 REDIRECTS — OLD THEME / LEGACY URLs
   Fixes: 25 GSC soft 404s, 112 Ahrefs "links to broken page"
   Old theme had: portfolio-archive, portfolio_tags, portfolio_categories,
   services, my-account, resume, cookies-policy, WooCommerce endpoints.
════════════════════════════════════════════ */
add_action( 'template_redirect', function() {
    $uri = trim( $_SERVER['REQUEST_URI'], '/' );
    $uri = strtok( $uri, '?' ); // strip query string for matching

    $redirect_prefixes = [
        'portfolio-archive',
        'portfolio_tags',
        'portfolio_categories',
        'my-account',
        'resume',
        'cookies-policy',
        'cgi-sys/suspendedpage.cgi',
    ];

    foreach ( $redirect_prefixes as $prefix ) {
        if ( strpos( $uri, $prefix ) === 0 ) {
            wp_redirect( home_url( '/' ), 301 );
            exit;
        }
    }

    // Specific old page redirects to relevant new pages
    $exact_redirects = [
        'services/criminal-legal-services-advisory'  => '/practice-areas/criminal-defence/',
        'services/family-legal-services-advisory'     => '/practice-areas/family-law-divorce/',
        'services/posh-legal-services-advisory'       => '/practice-areas/posh-workplace-law/',
        'services/corporate-legal-services-advisory'  => '/practice-areas/corporate-legal-advisory/',
        'services/cyber-security-information-technology-advisory' => '/practice-areas/cyber-it-law/',
        'services/intellectual-property-legal-services-advisory'  => '/practice-areas/intellectual-property/',
        'services'                                    => '/practice-areas/',
        'Home'                                        => '/',
        'privacy-policy'                              => '/',
    ];

    $uri_no_slash = rtrim( $uri, '/' );
    foreach ( $exact_redirects as $old => $new ) {
        if ( $uri_no_slash === rtrim( $old, '/' ) ) {
            wp_redirect( home_url( $new ), 301 );
            exit;
        }
    }
} );

/* ════════════════════════════════════════════
   15. DISABLE AMP — REDIRECT /amp/ TO CANONICAL
   GSC shows 25 "Alternative page with proper canonical"
   from AMP versions. AMP is unnecessary for this site.
════════════════════════════════════════════ */
add_action( 'template_redirect', function() {
    if ( preg_match( '#/amp/?$#', $_SERVER['REQUEST_URI'] ) ) {
        $clean_url = preg_replace( '#/amp/?$#', '/', $_SERVER['REQUEST_URI'] );
        wp_redirect( home_url( $clean_url ), 301 );
        exit;
    }
}, 1 );

/* ════════════════════════════════════════════
   16. REDIRECT AUTHOR / DATE / UNCATEGORIZED ARCHIVES
   "Crawled – not indexed" includes author and date archives.
════════════════════════════════════════════ */
add_action( 'template_redirect', function() {
    if ( is_author() ) {
        wp_redirect( home_url( '/about/' ), 301 );
        exit;
    }
    if ( is_category( 'uncategorized' ) ) {
        wp_redirect( home_url( '/blog/' ), 301 );
        exit;
    }
    if ( is_date() ) {
        wp_redirect( home_url( '/blog/' ), 301 );
        exit;
    }
} );

/* ════════════════════════════════════════════
   17. EMOJI SLUG REDIRECT
   Blog post with emoji in URL cannot be indexed.
   Redirect encoded emoji slug to clean version.
   ALSO: Change slug in WP Admin → Posts → edit that post.
════════════════════════════════════════════ */
add_action( 'template_redirect', function() {
    $uri = $_SERVER['REQUEST_URI'];
    // Match the emoji slug (URL-encoded 🚨 = %F0%9F%9A%A8)
    if ( strpos( $uri, '%F0%9F%9A%A8' ) !== false || strpos( $uri, "\xF0\x9F\x9A\xA8" ) !== false ) {
        wp_redirect( home_url( '/how-to-ensure-lawyer-answers-when-it-matters/' ), 301 );
        exit;
    }
} );

/* ════════════════════════════════════════════
   18. INDEXNOW — PING ON PUBLISH/UPDATE
   Speeds up indexing of new/updated content.
   Bing, Yandex, and other IndexNow-supporting engines.
════════════════════════════════════════════ */
define( 'AKC_INDEXNOW_KEY', 'edb05972f9274a019e59d50a7da1059b' );

add_action( 'publish_post',          'akc_indexnow_ping' );
add_action( 'publish_practice_area', 'akc_indexnow_ping' );
add_action( 'publish_case_result',   'akc_indexnow_ping' );
add_action( 'publish_location_page', 'akc_indexnow_ping' );
add_action( 'publish_page',          'akc_indexnow_ping' );

function akc_indexnow_ping( $post_id ) {
    $url = get_permalink( $post_id );
    if ( ! $url ) return;

    $body = wp_json_encode( [
        'host'   => wp_parse_url( home_url(), PHP_URL_HOST ),
        'key'    => AKC_INDEXNOW_KEY,
        'urlList' => [ $url ],
    ] );

    wp_remote_post( 'https://api.indexnow.org/IndexNow', [
        'headers'   => [ 'Content-Type' => 'application/json; charset=utf-8' ],
        'body'      => $body,
        'timeout'   => 5,
        'blocking'  => false,
    ] );
}

/* ════════════════════════════════════════════
   19. INDEXNOW KEY FILE ROUTE
   Serves the verification key file at /a1b2c3d4e5f6g7h8i9j0.txt
════════════════════════════════════════════ */
add_action( 'init', function() {
    add_rewrite_rule(
        '^' . AKC_INDEXNOW_KEY . '\.txt$',
        'index.php?akc_indexnow_verify=1',
        'top'
    );
} );
add_filter( 'query_vars', function( $vars ) {
    $vars[] = 'akc_indexnow_verify';
    return $vars;
} );
add_action( 'template_redirect', function() {
    if ( get_query_var( 'akc_indexnow_verify' ) ) {
        header( 'Content-Type: text/plain' );
        echo AKC_INDEXNOW_KEY;
        exit;
    }
} );
