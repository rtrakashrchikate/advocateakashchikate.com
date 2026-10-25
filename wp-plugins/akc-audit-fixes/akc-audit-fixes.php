<?php
/**
 * Plugin Name: AKC Audit Fixes (Oct 2026)
 * Description: Phase 1 fixes from the 25 Oct 2026 SEO audit — default social share image, removes the duplicate homepage OG tags, drops a redirecting URL from the sitemap, and adds related-links blocks to practice-area pages and case notes, overrides 57 titles/meta descriptions, noindexes the free-guide sign-up pages and adds takeaways to case notes. Keep active; deactivating undoes every change.
 * Version: 1.2.0
 * Author: Advocate Akash Chikate
 */

if ( ! defined( 'ABSPATH' ) ) exit;

define( 'AKC_AF_OLD_SLUG', 'dhangekar-gets-anticipatory-bail-pune-court' );
define( 'AKC_AF_NEW_SLUG', 'how-to-get-anticipatory-bail-pune' );

/* ════════════════════════════════════════════
   1. DEFAULT OPEN GRAPH IMAGE
   100 of 149 pages had no og:image, so WhatsApp / LinkedIn shares showed
   no preview. Sets Rank Math's own default (Titles & Meta → Global Meta →
   OpenGraph Thumbnail) to a 1200×630 JPG. The previous value is kept and
   restored on deactivation.
════════════════════════════════════════════ */
register_activation_hook( __FILE__, 'akc_af_activate' );
register_deactivation_hook( __FILE__, 'akc_af_deactivate' );

function akc_af_activate() {
    $att_id = akc_af_og_attachment();
    if ( ! $att_id ) return;

    $opts = get_option( 'rank-math-options-titles', [] );
    if ( ! is_array( $opts ) ) $opts = [];

    if ( false === get_option( 'akc_af_prev_og' ) ) {
        update_option( 'akc_af_prev_og', [
            'open_graph_image'    => $opts['open_graph_image'] ?? '',
            'open_graph_image_id' => $opts['open_graph_image_id'] ?? '',
        ], false );
    }

    $opts['open_graph_image']    = wp_get_attachment_url( $att_id );
    $opts['open_graph_image_id'] = $att_id;
    update_option( 'rank-math-options-titles', $opts );
}

function akc_af_deactivate() {
    $prev = get_option( 'akc_af_prev_og' );
    if ( ! is_array( $prev ) ) return;

    $opts = get_option( 'rank-math-options-titles', [] );
    if ( ! is_array( $opts ) ) $opts = [];
    $opts['open_graph_image']    = $prev['open_graph_image'];
    $opts['open_graph_image_id'] = $prev['open_graph_image_id'];
    update_option( 'rank-math-options-titles', $opts );
    delete_option( 'akc_af_prev_og' );
}

// Copies assets/og-default.jpg into the media library once and returns its ID.
function akc_af_og_attachment() {
    $existing = (int) get_option( 'akc_af_og_attachment_id' );
    if ( $existing && get_post( $existing ) ) return $existing;

    $src = plugin_dir_path( __FILE__ ) . 'assets/og-default.jpg';
    if ( ! file_exists( $src ) ) return 0;

    $upload = wp_upload_bits( 'akash-chikate-advocate-pune-og.jpg', null, file_get_contents( $src ) );
    if ( ! empty( $upload['error'] ) ) return 0;

    $att_id = wp_insert_attachment( [
        'post_title'     => 'Adv. Akash R. Chikate — Advocate, Pune',
        'post_mime_type' => 'image/jpeg',
        'post_status'    => 'inherit',
    ], $upload['file'] );
    if ( is_wp_error( $att_id ) || ! $att_id ) return 0;

    require_once ABSPATH . 'wp-admin/includes/image.php';
    wp_update_attachment_metadata( $att_id, wp_generate_attachment_metadata( $att_id, $upload['file'] ) );
    update_post_meta( $att_id, '_wp_attachment_image_alt', 'Adv. Akash R. Chikate, advocate in Pune' );
    update_option( 'akc_af_og_attachment_id', $att_id, false );
    return $att_id;
}

/* ════════════════════════════════════════════
   2. REMOVE THE THEME'S DUPLICATE HOMEPAGE OG TAGS
   The theme's "Fix: OG / Open Graph tags for homepage" hook (wp_head, 99)
   predates Rank Math's social output. It now prints a second og:/twitter:
   set with logo.svg (no preview on social apps) and a conflicting
   twitter:card. Unhooks only that closure: priority 99, defined in the
   theme's functions.php, and its source prints og:image.
════════════════════════════════════════════ */
add_action( 'wp_head', function() {
    global $wp_filter;
    if ( ! is_front_page() || empty( $wp_filter['wp_head']->callbacks[99] ) ) return;

    foreach ( $wp_filter['wp_head']->callbacks[99] as $cb ) {
        if ( ! ( $cb['function'] instanceof Closure ) ) continue;
        $ref  = new ReflectionFunction( $cb['function'] );
        $file = wp_normalize_path( (string) $ref->getFileName() );
        if ( substr( $file, -strlen( '/themes/akashchikate/functions.php' ) ) !== '/themes/akashchikate/functions.php' ) continue;

        $lines = @file( $ref->getFileName() );
        if ( ! $lines ) continue;
        $src = implode( '', array_slice( $lines, $ref->getStartLine() - 1, $ref->getEndLine() - $ref->getStartLine() + 1 ) );
        if ( strpos( $src, 'og:image' ) !== false ) {
            remove_action( 'wp_head', $cb['function'], 99 );
        }
    }
}, 0 );

/* ════════════════════════════════════════════
   3. REDIRECTING URL IN SITEMAP / INTERNAL LINK
   /dhangekar-gets-anticipatory-bail-pune-court/ 301s to the anticipatory
   bail guide but was still listed in post-sitemap.xml and linked from the
   Hindi anticipatory bail page.
════════════════════════════════════════════ */
add_filter( 'rank_math/sitemap/entry', function( $url, $type, $object ) {
    if ( is_array( $url ) && ! empty( $url['loc'] ) ) {
        $path = trailingslashit( (string) wp_parse_url( $url['loc'], PHP_URL_PATH ) );
        if ( strpos( $path, '/' . AKC_AF_OLD_SLUG ) !== false || akc_af_is_free_guide( $path ) ) return false;
    }
    return $url;
}, 10, 3 );

add_filter( 'the_content', function( $content ) {
    if ( strpos( $content, AKC_AF_OLD_SLUG ) === false ) return $content;
    return str_replace( '/' . AKC_AF_OLD_SLUG . '/', '/' . AKC_AF_NEW_SLUG . '/', $content );
}, 20 );

/* ════════════════════════════════════════════
   4. RELATED LINKS
   The audit found practice-area articles with no in-content links, and 15
   pages with one or no internal links pointing to them (11 case notes plus
   four guides). Practice-area pages get "Related reported orders" and
   "Related guides"; each case note links back to its practice areas.
   Targets are looked up by slug, so a missing or unpublished page is skipped.
════════════════════════════════════════════ */
function akc_af_related_map() {
    return [
        'anticipatory-bail' => [
            'orders' => [ 'anticipatory-bail-sc-st-act-bhc-2025-sayyed', 'interim-protection-eow-financial-fraud-bhc-2025' ],
            'guides' => [ 'how-to-get-anticipatory-bail-pune', 'bombay-high-court-lawyer-pune' ],
        ],
        'bail-application' => [
            'orders' => [ 'attempt-murder-arms-act-bail-bhc-2025', 'child-trafficking-bail-section-370-bhc-2025', 'murder-bail-granted-after-4-years-bhc-2025' ],
            'guides' => [ 'bombay-high-court-lawyer-pune' ],
        ],
        'criminal-appeals-suspension-of-sentence' => [
            'orders' => [ 'murder-sentence-suspended-bail-bhc-db-2025-jamdade', 'murder-conviction-bail-women-co-accused-bhc-db-2025', 'murder-conviction-bail-rejected-bhc-db-2025', 'murder-conviction-altered-304-sentence-reduced-bhc-db-2025', 'pocso-conviction-bail-pending-appeal-bhc-2025' ],
            'guides' => [ 'bombay-high-court-lawyer-pune' ],
        ],
        'sessions-trial-defence' => [
            'orders' => [ 'murder-conviction-altered-304-sentence-reduced-bhc-db-2025', 'murder-bail-granted-after-4-years-bhc-2025' ],
            'guides' => [],
        ],
        'criminal-defence' => [
            'orders' => [ 'attempt-murder-arms-act-bail-bhc-2025', 'murder-bail-granted-after-4-years-bhc-2025', 'mcoca-proclamation-stayed-bhc-2025' ],
            'guides' => [ 'bombay-high-court-lawyer-pune' ],
        ],
        'fir-quashing' => [
            'orders' => [ 'interim-protection-eow-financial-fraud-bhc-2025' ],
            'guides' => [ 'bombay-high-court-lawyer-pune' ],
        ],
        'sc-st-atrocities-act-defence' => [
            'orders' => [ 'anticipatory-bail-sc-st-act-bhc-2025-sayyed' ],
            'guides' => [],
        ],
        'eow-financial-crimes-defence' => [
            'orders' => [ 'interim-protection-eow-financial-fraud-bhc-2025' ],
            'guides' => [],
        ],
        'mcoca-defence' => [
            'orders' => [ 'mcoca-proclamation-stayed-bhc-2025' ],
            'guides' => [],
        ],
        'pocso-defence' => [
            'orders' => [ 'pocso-conviction-bail-pending-appeal-bhc-2025' ],
            'guides' => [],
        ],
        'cyber-it-law' => [
            'orders' => [],
            'guides' => [ 'bank-account-frozen-cyber-police-maharashtra', 'police-notice-whatsapp-how-to-verify-digital-arrest-scam' ],
        ],
        'police-notice-section-35-bnss' => [
            'orders' => [],
            'guides' => [ 'police-notice-whatsapp-how-to-verify-digital-arrest-scam' ],
        ],
        'cheque-bounce-ni-act' => [
            'orders' => [],
            'guides' => [ 'cheque-bounce-ni-act-pune' ],
        ],
    ];
}

function akc_af_find( $slug, $types ) {
    $p = get_page_by_path( $slug, OBJECT, $types );
    return ( $p && 'publish' === $p->post_status ) ? $p : null;
}

function akc_af_link_list( $heading, $posts ) {
    if ( ! $posts ) return '';
    $html = '<h3>' . esc_html( $heading ) . '</h3><ul>';
    foreach ( $posts as $p ) {
        $html .= '<li><a href="' . esc_url( get_permalink( $p ) ) . '">' . esc_html( get_the_title( $p ) ) . '</a></li>';
    }
    return $html . '</ul>';
}

add_filter( 'the_content', function( $content ) {
    if ( ! is_singular( [ 'practice_area', 'case_result' ] ) || ! in_the_loop() || ! is_main_query() ) return $content;

    $map  = akc_af_related_map();
    $slug = get_post_field( 'post_name', get_the_ID() );
    $html = '';

    if ( is_singular( 'practice_area' ) ) {
        if ( empty( $map[ $slug ] ) ) return $content;
        $orders = array_filter( array_map( function( $s ) { return akc_af_find( $s, 'case_result' ); }, $map[ $slug ]['orders'] ) );
        $guides = array_filter( array_map( function( $s ) { return akc_af_find( $s, [ 'post', 'page' ] ); }, $map[ $slug ]['guides'] ) );
        $html  .= akc_af_link_list( 'Related reported orders', $orders );
        $html  .= akc_af_link_list( 'Related guides', $guides );
        if ( $orders && ( $hub = akc_af_hub_link() ) ) $html .= $hub;
    } else {
        $areas = [];
        foreach ( $map as $pa => $rel ) {
            if ( in_array( $slug, $rel['orders'], true ) && ( $p = akc_af_find( $pa, 'practice_area' ) ) ) $areas[] = $p;
        }
        $html .= akc_af_link_list( 'Related practice areas', $areas );
        if ( $hub = akc_af_hub_link() ) $html .= $hub;
    }

    if ( ! $html ) return $content;
    return $content . '<aside class="akc-related" aria-label="Related pages">' . $html . '</aside>';
}, 30 );

function akc_af_hub_link() {
    $url = get_post_type_archive_link( 'case_result' );
    return $url ? '<p class="akc-related-hub"><a href="' . esc_url( $url ) . '">All reported orders &rarr;</a></p>' : '';
}

add_action( 'wp_head', function() {
    if ( ! is_singular( [ 'practice_area', 'case_result' ] ) ) return;
    echo '<style id="akc-related-css">'
        . '.akc-related{margin-top:2.5rem;padding:1.5rem 1.75rem;border:1px solid #e5e7eb;border-left:4px solid var(--gold,#c9a030);border-radius:8px;background:#fafaf7}'
        . '.akc-related h3{font-size:1.05rem;color:var(--navy,#0d1b3e);margin:0 0 .6rem}'
        . '.akc-related h3:not(:first-child){margin-top:1.25rem}'
        . '.akc-related ul{margin:0;padding-left:1.1rem}'
        . '.akc-related li{margin:.35rem 0}'
        . '.akc-related a{color:var(--navy,#0d1b3e);text-decoration:underline;text-decoration-color:var(--gold,#c9a030);text-underline-offset:3px;display:inline-block;padding:2px 0}'
        . '.akc-related-hub{margin:1rem 0 0;font-weight:600}'
        . '</style>' . "\n";
}, 20 );

/* ════════════════════════════════════════════
   5. TITLE & META DESCRIPTION OVERRIDES
   46 descriptions were over 160 characters, 15 titles over 60, and three
   pages had no description. New values live in meta-overrides.php, keyed
   by URL path; null keeps Rank Math's value. Social titles/descriptions
   follow so shares match the search snippet.
════════════════════════════════════════════ */
function akc_af_meta_override( $i ) {
    static $map = null;
    if ( null === $map ) $map = include plugin_dir_path( __FILE__ ) . 'meta-overrides.php';
    if ( is_admin() || ! is_array( $map ) ) return null;

    $path = wp_parse_url( isset( $_SERVER['REQUEST_URI'] ) ? wp_unslash( $_SERVER['REQUEST_URI'] ) : '/', PHP_URL_PATH );
    $path = trailingslashit( '/' . ltrim( (string) $path, '/' ) );
    return $map[ $path ][ $i ] ?? null;
}

foreach ( [ 'rank_math/frontend/title', 'rank_math/opengraph/facebook/og_title', 'rank_math/opengraph/twitter/twitter_title' ] as $hook ) {
    add_filter( $hook, function( $v ) { return akc_af_meta_override( 0 ) ?? $v; }, 20 );
}
foreach ( [ 'rank_math/frontend/description', 'rank_math/opengraph/facebook/og_description', 'rank_math/opengraph/twitter/twitter_description' ] as $hook ) {
    add_filter( $hook, function( $v ) { return akc_af_meta_override( 1 ) ?? $v; }, 20 );
}

/* ════════════════════════════════════════════
   6. FREE-GUIDE SIGN-UP PAGES → NOINDEX, FOLLOW
   The eight /free-*-guide/ pages are lead forms with ~60 words of their
   own, each overlapping a full practice-area page or guide. Kept out of
   the index and sitemap so Google ranks the full pages instead; links on
   them are still followed and ads can still point at them.
════════════════════════════════════════════ */
function akc_af_is_free_guide( $path ) {
    return (bool) preg_match( '#^/free-[a-z0-9-]+-guide/$#', $path );
}

add_filter( 'rank_math/frontend/robots', function( $robots ) {
    $path = wp_parse_url( isset( $_SERVER['REQUEST_URI'] ) ? wp_unslash( $_SERVER['REQUEST_URI'] ) : '/', PHP_URL_PATH );
    if ( akc_af_is_free_guide( trailingslashit( '/' . ltrim( (string) $path, '/' ) ) ) ) {
        $robots['index']  = 'noindex';
        $robots['follow'] = 'follow';
    }
    return $robots;
}, 20 );

/* ════════════════════════════════════════════
   7. CASE-NOTE TAKEAWAYS
   Case notes were 440–490 words with no practical guidance. Adds a short
   "what this means" section from case-takeaways.php, above the related
   links (section 4 runs at priority 30).
════════════════════════════════════════════ */
add_filter( 'the_content', function( $content ) {
    if ( ! is_singular( 'case_result' ) || ! in_the_loop() || ! is_main_query() ) return $content;

    static $map = null;
    if ( null === $map ) $map = include plugin_dir_path( __FILE__ ) . 'case-takeaways.php';
    $points = $map[ get_post_field( 'post_name', get_the_ID() ) ] ?? null;
    if ( ! $points ) return $content;

    $html = '<section class="akc-takeaways"><h2>What this means if you face a similar situation</h2><ul>';
    foreach ( $points as $pt ) $html .= '<li>' . wp_kses( $pt, [ 'em' => [] ] ) . '</li>';
    $html .= '</ul><p class="akc-takeaways-note">Every case turns on its own facts and the order of the court. This is general information, not advice on your matter.</p></section>';
    return $content . $html;
}, 25 );

add_action( 'wp_head', function() {
    if ( ! is_singular( 'case_result' ) ) return;
    echo '<style id="akc-takeaways-css">'
        . '.akc-takeaways{margin-top:2.5rem}'
        . '.akc-takeaways h2{font-size:1.35rem;color:var(--navy,#0d1b3e);margin:0 0 .9rem}'
        . '.akc-takeaways ul{margin:0;padding-left:1.2rem}'
        . '.akc-takeaways li{margin:.55rem 0;line-height:1.75}'
        . '.akc-takeaways-note{font-size:.85rem;color:var(--gray-600,#4b5563);margin-top:1rem;font-style:italic}'
        . '</style>' . "\n";
}, 20 );
