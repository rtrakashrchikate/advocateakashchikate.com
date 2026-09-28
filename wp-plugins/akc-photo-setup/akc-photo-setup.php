<?php
/**
 * Plugin Name: AKC Photo Setup
 * Description: Sets advocate photos (hero + about) and assigns featured images to all blog posts. Deactivate and delete after use.
 * Version: 1.0.0
 * Author: Advocate Akash Chikate
 */

if ( ! defined( 'ABSPATH' ) ) exit;

register_activation_hook( __FILE__, 'akc_run_photo_setup' );

function akc_run_photo_setup() {
    akc_set_advocate_photos();
    akc_assign_blog_featured_images();
}

/* ── 1. SET ADVOCATE PHOTOS ─────────────────────────────────────── */
function akc_set_advocate_photos() {
    // Hero section (homepage) + fallback for about page
    update_option( 'akc_advocate_photo', 'https://advocateakashchikate.com/wp-content/uploads/2026/04/Gemini_Generated_Image_8d3wmo8d3wmo8d3w.png' );
    // About page (homepage about section + about page left panel)
    update_option( 'akc_about_photo', 'https://advocateakashchikate.com/wp-content/uploads/2026/04/Gemini_Generated_Image_l0sy92l0sy92l0sy.png' );
}

/* ── 2. ASSIGN FEATURED IMAGES TO BLOG POSTS ────────────────────── */
function akc_assign_blog_featured_images() {

    // Curated free legal images from Pexels (royalty-free, no attribution required)
    // Each image is matched to the post topic for relevance
    $post_images = [

        // Criminal law / bail / courts
        'criminal-trial-process-india-fir-to-verdict'         => 'https://images.pexels.com/photos/5668858/pexels-photo-5668858.jpeg?w=800',
        'how-to-get-anticipatory-bail-pune'                   => 'https://images.pexels.com/photos/6077326/pexels-photo-6077326.jpeg?w=800',
        'bail-after-arrest-pune-guide'                        => 'https://images.pexels.com/photos/6077326/pexels-photo-6077326.jpeg?w=800',
        'default-bail-167-crpc-bnss-chargesheet-deadline'     => 'https://images.pexels.com/photos/5669619/pexels-photo-5669619.jpeg?w=800',
        'rights-when-arrested-india'                          => 'https://images.pexels.com/photos/5669602/pexels-photo-5669602.jpeg?w=800',
        'discharge-application-criminal-case-india'           => 'https://images.pexels.com/photos/5669619/pexels-photo-5669619.jpeg?w=800',
        'murder-case-defence-bns-section-103-india'           => 'https://images.pexels.com/photos/5668858/pexels-photo-5668858.jpeg?w=800',
        'plea-bargaining-india-criminal-case-bnss'            => 'https://images.pexels.com/photos/5668772/pexels-photo-5668772.jpeg?w=800',
        'witness-criminal-case-india-rights-obligations'      => 'https://images.pexels.com/photos/5668772/pexels-photo-5668772.jpeg?w=800',
        'how-to-ensure-lawyer-answers-when-it-matters'        => 'https://images.pexels.com/photos/6077323/pexels-photo-6077323.jpeg?w=800',
        'how-to-choose-criminal-lawyer-pune'                  => 'https://images.pexels.com/photos/6077323/pexels-photo-6077323.jpeg?w=800',

        // FIR / High Court
        'fir-quashing-bombay-high-court-pune'                 => 'https://images.pexels.com/photos/5669626/pexels-photo-5669626.jpeg?w=800',
        'bombay-high-court-pune-bench-jurisdiction'           => 'https://images.pexels.com/photos/5669626/pexels-photo-5669626.jpeg?w=800',

        // Cybercrime / IT law
        'cybercrime-notice-fir-pune-action-plan'              => 'https://images.pexels.com/photos/5380664/pexels-photo-5380664.jpeg?w=800',
        'online-fraud-cyber-scam-complaint-pune'              => 'https://images.pexels.com/photos/5380664/pexels-photo-5380664.jpeg?w=800',
        'investment-fraud-trading-app-scam-pune'              => 'https://images.pexels.com/photos/5380664/pexels-photo-5380664.jpeg?w=800',
        'whatsapp-social-media-defamation-india-legal-options'=> 'https://images.pexels.com/photos/5380664/pexels-photo-5380664.jpeg?w=800',

        // Family law / divorce / domestic violence
        'how-to-file-divorce-pune'                            => 'https://images.pexels.com/photos/7876050/pexels-photo-7876050.jpeg?w=800',
        'child-custody-after-divorce-pune-family-court'       => 'https://images.pexels.com/photos/7876050/pexels-photo-7876050.jpeg?w=800',
        'domestic-violence-protection-order-pune-women'       => 'https://images.pexels.com/photos/7876050/pexels-photo-7876050.jpeg?w=800',
        'marital-disputes-family-court-vs-criminal-court-india'=> 'https://images.pexels.com/photos/7876050/pexels-photo-7876050.jpeg?w=800',
        'defining-domestic-violence'                          => 'https://images.pexels.com/photos/7876050/pexels-photo-7876050.jpeg?w=800',
        'stalking-harassment-complaint-pune-india'            => 'https://images.pexels.com/photos/7876050/pexels-photo-7876050.jpeg?w=800',

        // 498A / POCSO / SC-ST
        '498a-domestic-violence-defence-pune'                 => 'https://images.pexels.com/photos/5669456/pexels-photo-5669456.jpeg?w=800',
        'pocso-act-cases-pune-accused-families'               => 'https://images.pexels.com/photos/5669456/pexels-photo-5669456.jpeg?w=800',
        'sc-st-atrocities-act-defence-pune'                   => 'https://images.pexels.com/photos/5669456/pexels-photo-5669456.jpeg?w=800',

        // NDPS / drugs
        'drug-offences-ndps-act-pune-penalties'               => 'https://images.pexels.com/photos/5669619/pexels-photo-5669619.jpeg?w=800',
        'ndps-act-bail-pune'                                  => 'https://images.pexels.com/photos/5669619/pexels-photo-5669619.jpeg?w=800',
        'mcoca-charges-bail-defence-maharashtra'              => 'https://images.pexels.com/photos/5669619/pexels-photo-5669619.jpeg?w=800',

        // Property / cheque / consumer / corporate
        'property-fraud-cheating-case-pune'                   => 'https://images.pexels.com/photos/5668845/pexels-photo-5668845.jpeg?w=800',
        'cheque-bounce-ni-act-pune'                           => 'https://images.pexels.com/photos/5668845/pexels-photo-5668845.jpeg?w=800',
        'consumer-court-pune-how-to-file-complaint'           => 'https://images.pexels.com/photos/5668845/pexels-photo-5668845.jpeg?w=800',
        'intellectual-property-rights-india-pune-businesses'  => 'https://images.pexels.com/photos/5668845/pexels-photo-5668845.jpeg?w=800',
        'posh-act-compliance-pune-employers'                  => 'https://images.pexels.com/photos/5668845/pexels-photo-5668845.jpeg?w=800',
        'eow-economic-offence-wing-pune-summons'              => 'https://images.pexels.com/photos/5668845/pexels-photo-5668845.jpeg?w=800',

        // Legal process / general
        'legal-notice-india-when-to-send-format'              => 'https://images.pexels.com/photos/5668772/pexels-photo-5668772.jpeg?w=800',
        'legal-aid-india-free-legal-help-maharashtra'         => 'https://images.pexels.com/photos/5668772/pexels-photo-5668772.jpeg?w=800',

        // News / case updates
        'dhangekar-gets-anticipatory-bail-pune-court'         => 'https://images.pexels.com/photos/5669626/pexels-photo-5669626.jpeg?w=800',
    ];

    $set = 0;
    $skipped = 0;
    $failed = [];

    foreach ( $post_images as $slug => $img_url ) {

        // Find the post
        $posts = get_posts( [
            'name'           => $slug,
            'post_type'      => 'post',
            'post_status'    => 'publish',
            'posts_per_page' => 1,
        ] );

        if ( empty( $posts ) ) {
            $failed[] = $slug;
            continue;
        }

        $post_id = $posts[0]->ID;

        // Skip if already has a featured image
        if ( has_post_thumbnail( $post_id ) ) {
            $skipped++;
            continue;
        }

        // Sideload the image into Media Library
        require_once ABSPATH . 'wp-admin/includes/media.php';
        require_once ABSPATH . 'wp-admin/includes/file.php';
        require_once ABSPATH . 'wp-admin/includes/image.php';

        $attachment_id = media_sideload_image( $img_url, $post_id, $posts[0]->post_title, 'id' );

        if ( ! is_wp_error( $attachment_id ) ) {
            set_post_thumbnail( $post_id, $attachment_id );
            $set++;
        } else {
            $failed[] = $slug . ' (sideload error)';
        }
    }

    set_transient( 'akc_photo_setup_results', [
        'photos_set' => true,
        'blog_set'   => $set,
        'skipped'    => $skipped,
        'failed'     => $failed,
    ], 300 );
}

// Admin notice
add_action( 'admin_notices', function() {
    $r = get_transient( 'akc_photo_setup_results' );
    if ( ! $r ) return;
    delete_transient( 'akc_photo_setup_results' );

    echo '<div class="notice notice-success is-dismissible"><p>';
    echo '<strong>AKC Photo Setup:</strong> ';
    if ( $r['photos_set'] ) echo '✅ Hero + About photos set &nbsp;|&nbsp; ';
    echo '✅ Blog featured images set: <strong>' . intval( $r['blog_set'] ) . '</strong> &nbsp;|&nbsp; ';
    echo 'Already had image (skipped): <strong>' . intval( $r['skipped'] ) . '</strong>';
    if ( ! empty( $r['failed'] ) ) {
        echo '<br>⚠️ Failed/not found: ' . esc_html( implode( ', ', $r['failed'] ) );
    }
    echo '</p></div>';
} );
