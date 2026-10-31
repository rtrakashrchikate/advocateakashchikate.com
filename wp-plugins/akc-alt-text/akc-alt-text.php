<?php
/**
 * Plugin Name: AKC Alt Text Importer
 * Description: One-shot — sets alt text for all images in the Media Library. Skips images that already have alt text. Deactivate and delete after use.
 * Version: 1.0.0
 * Author: Advocate Akash Chikate
 */

if ( ! defined( 'ABSPATH' ) ) exit;

register_activation_hook( __FILE__, 'akc_set_all_alt_text' );

function akc_set_all_alt_text() {

    $set     = 0;
    $skipped = 0;

    /* ── 1. SPECIFIC KNOWN IMAGES (by filename fragment) ─────────── */
    $known = [
        // Advocate photos
        '8d3wmo8d3wmo8d3w'  => 'Advocate Akash R. Chikate — Criminal Defence Lawyer Pune',
        'l0sy92l0sy92l0sy'  => 'Advocate Akash R. Chikate — Criminal Defence Attorney in Law Office, Pune',
        'logo'              => 'Advocate Akash Chikate & Associates — Criminal Lawyer Pune Logo',
        'vector-advocate'   => 'Advocate Akash Chikate — Criminal Law Symbol',

        // Pexels legal images (by photo ID in filename)
        '5668858'           => 'Criminal court hearing — legal proceedings in India',
        '6077326'           => 'Anticipatory bail application — Indian court documents',
        '5669619'           => 'Criminal case lawyer reviewing legal documents',
        '5669602'           => 'Rights of an arrested person in India — legal counsel',
        '5668772'           => 'Lawyer reviewing criminal case files in Pune',
        '6077323'           => 'Criminal defence lawyer consultation in Pune',
        '5669626'           => 'Bombay High Court legal proceedings',
        '5380664'           => 'Cybercrime legal defence — IT Act case in Pune',
        '7876050'           => 'Family court divorce proceedings in Pune',
        '5669456'           => 'Criminal defence case — POCSO and 498A matters',
        '5668845'           => 'Legal documents for property and cheque bounce cases',
    ];

    // Get all attachments
    $attachments = get_posts( [
        'post_type'      => 'attachment',
        'post_status'    => 'inherit',
        'posts_per_page' => -1,
        'post_mime_type' => 'image',
    ] );

    foreach ( $attachments as $att ) {

        // Skip if already has alt text
        $existing = get_post_meta( $att->ID, '_wp_attachment_image_alt', true );
        if ( ! empty( $existing ) ) {
            $skipped++;
            continue;
        }

        $filename = basename( get_attached_file( $att->ID ) );
        $alt      = '';

        // Check known images first
        foreach ( $known as $fragment => $known_alt ) {
            if ( stripos( $filename, $fragment ) !== false ) {
                $alt = $known_alt;
                break;
            }
        }

        // If attached to a post — use post title for context
        if ( empty( $alt ) && $att->post_parent ) {
            $parent = get_post( $att->post_parent );
            if ( $parent ) {
                $type = get_post_type( $parent->ID );
                switch ( $type ) {
                    case 'post':
                        $alt = esc_attr( $parent->post_title ) . ' — Legal Guide by Advocate Akash Chikate, Pune';
                        break;
                    case 'practice_area':
                        $alt = esc_attr( $parent->post_title ) . ' — Advocate Akash Chikate, Pune';
                        break;
                    case 'location_page':
                        $alt = 'Criminal Lawyer ' . esc_attr( $parent->post_title ) . ' — Advocate Akash Chikate';
                        break;
                    case 'case_result':
                        $alt = 'Case Result — ' . esc_attr( $parent->post_title ) . ' — Advocate Akash Chikate';
                        break;
                    default:
                        $alt = esc_attr( $parent->post_title ) . ' — Advocate Akash Chikate';
                }
            }
        }

        // Fallback — generate from filename
        if ( empty( $alt ) ) {
            $name = pathinfo( $filename, PATHINFO_FILENAME );
            $name = preg_replace( '/[-_]/', ' ', $name );        // dashes/underscores → spaces
            $name = preg_replace( '/\d{4,}/', '', $name );       // remove long numbers
            $name = preg_replace( '/\s+/', ' ', trim( $name ) ); // clean spaces
            if ( strlen( $name ) > 5 ) {
                $alt = ucfirst( $name ) . ' — Advocate Akash Chikate, Criminal Lawyer Pune';
            } else {
                $alt = 'Legal services — Advocate Akash Chikate, Criminal Lawyer Pune';
            }
        }

        // Enforce max 125 chars (SEO best practice)
        if ( strlen( $alt ) > 125 ) {
            $alt = substr( $alt, 0, 122 ) . '...';
        }

        update_post_meta( $att->ID, '_wp_attachment_image_alt', sanitize_text_field( $alt ) );
        $set++;
    }

    set_transient( 'akc_alt_text_results', [
        'set'     => $set,
        'skipped' => $skipped,
        'total'   => count( $attachments ),
    ], 300 );
}

// Admin notice
add_action( 'admin_notices', function() {
    $r = get_transient( 'akc_alt_text_results' );
    if ( ! $r ) return;
    delete_transient( 'akc_alt_text_results' );
    echo '<div class="notice notice-success is-dismissible"><p>';
    echo '<strong>AKC Alt Text:</strong> ';
    echo '✅ Alt text set: <strong>' . intval( $r['set'] ) . '</strong> images &nbsp;|&nbsp; ';
    echo 'Already had alt text (skipped): <strong>' . intval( $r['skipped'] ) . '</strong> &nbsp;|&nbsp; ';
    echo 'Total images in library: <strong>' . intval( $r['total'] ) . '</strong>';
    echo '</p></div>';
} );
