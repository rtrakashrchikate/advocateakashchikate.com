<?php
/**
 * Plugin Name: AKC SEO Fix
 * Description: Sets Rank Math meta descriptions, OG image, and creates the /locations/ hub page. One-time audit fix. Run once then deactivate.
 * Version: 1.0
 */
if ( ! defined( 'ABSPATH' ) ) exit;

/* ── Admin notice + manual trigger ── */
add_action( 'admin_notices', function() {
    if ( ! current_user_can( 'manage_options' ) ) return;
    if ( get_option( 'akc_seo_fix_done' ) ) {
        echo '<div class="notice notice-success"><p><strong>AKC SEO Fix:</strong> All fixes already applied. You can deactivate and delete this plugin.</p></div>';
        return;
    }
    $nonce = wp_create_nonce( 'akc_seo_fix' );
    echo '<div class="notice notice-warning"><p><strong>AKC SEO Fix:</strong> Audit fixes pending. <a href="' . admin_url( 'admin.php?akc_seo_fix=1&_wpnonce=' . $nonce ) . '" class="button button-primary">Apply All SEO Fixes Now</a></p></div>';
} );

add_action( 'admin_init', function() {
    if ( empty( $_GET['akc_seo_fix'] ) ) return;
    check_admin_referer( 'akc_seo_fix' );
    if ( ! current_user_can( 'manage_options' ) ) return;
    akc_apply_seo_fixes();
    wp_redirect( admin_url( 'options-general.php?akc_seo_done=1' ) );
    exit;
} );

add_action( 'admin_notices', function() {
    if ( ! empty( $_GET['akc_seo_done'] ) ) {
        echo '<div class="notice notice-success is-dismissible"><p><strong>AKC SEO Fix:</strong> All SEO fixes applied successfully.</p></div>';
    }
} );

register_activation_hook( __FILE__, 'akc_apply_seo_fixes' );

/* ═══════════════════════════════════════════════
   MAIN FIX FUNCTION
═══════════════════════════════════════════════ */
function akc_apply_seo_fixes() {
    if ( get_option( 'akc_seo_fix_done' ) ) return;

    /* 1. Homepage meta */
    $front_id = (int) get_option( 'page_on_front' );
    if ( $front_id ) {
        update_post_meta( $front_id, 'rank_math_title',       'Criminal Lawyer in Pune | Bail & FIR Quashing | Adv. Akash Chikate' );
        update_post_meta( $front_id, 'rank_math_description', 'Advocate Akash Chikate — criminal defence lawyer in Pune. Anticipatory bail, FIR quashing, NDPS, cybercrime & 498A. 8+ years, 27+ Bombay HC orders. Free consultation.' );
        update_post_meta( $front_id, 'rank_math_focus_keyword', 'criminal lawyer pune' );
        // OG image — replace with real social image URL when available
        $og_img = get_template_directory_uri() . '/assets/images/logo.png';
        update_post_meta( $front_id, 'rank_math_facebook_image', $og_img );
        update_post_meta( $front_id, 'rank_math_twitter_image',  $og_img );
    }

    /* 2. About page meta */
    $about = get_page_by_path( 'about' );
    if ( $about ) {
        update_post_meta( $about->ID, 'rank_math_title',         'About Adv. Akash Chikate | Criminal Lawyer Pune | 8+ Years Experience' );
        update_post_meta( $about->ID, 'rank_math_description',   'Advocate Akash R. Chikate — criminal defence lawyer in Pune with 8+ years at Bombay High Court & Sessions Court. LLM in Technology Laws. 27+ HC orders. Learn more.' );
        update_post_meta( $about->ID, 'rank_math_focus_keyword', 'about advocate akash chikate' );
    }

    /* 3. Contact page meta */
    $contact = get_page_by_path( 'contact' );
    if ( $contact ) {
        update_post_meta( $contact->ID, 'rank_math_title',         'Contact Criminal Lawyer Pune | Free Consultation | Adv. Akash Chikate' );
        update_post_meta( $contact->ID, 'rank_math_description',   'Contact Advocate Akash Chikate, criminal defence lawyer in Pune. Free confidential consultation by phone, WhatsApp, or contact form. Shivajinagar office. Available for bail emergencies.' );
        update_post_meta( $contact->ID, 'rank_math_focus_keyword', 'criminal lawyer pune contact' );
    }

    /* 4. Practice Areas archive page meta */
    $pa_archive = get_page_by_path( 'practice-areas' );
    if ( $pa_archive ) {
        update_post_meta( $pa_archive->ID, 'rank_math_title',       'Practice Areas | Criminal, Family & Cyber Law Pune | Adv. Akash Chikate' );
        update_post_meta( $pa_archive->ID, 'rank_math_description', '18 practice areas — criminal defence, anticipatory bail, FIR quashing, cybercrime, NDPS, 498A, mutual divorce, POSH & more. Advocate Akash Chikate, Pune.' );
    }

    /* 5. Blog archive meta */
    $blog_page_id = (int) get_option( 'page_for_posts' );
    if ( $blog_page_id ) {
        update_post_meta( $blog_page_id, 'rank_math_title',       'Legal Insights | Criminal Law Blog Pune | Adv. Akash Chikate' );
        update_post_meta( $blog_page_id, 'rank_math_description', 'Plain-language articles on criminal law, bail rights, FIR procedures, cybercrime, divorce, and NDPS law in India. Written by Advocate Akash Chikate, Pune.' );
    }

    /* 6. Create /locations/ hub page */
    akc_create_locations_hub();

    update_option( 'akc_seo_fix_done', true );
}

/* ═══════════════════════════════════════════════
   LOCATIONS HUB PAGE
═══════════════════════════════════════════════ */
function akc_create_locations_hub() {
    $existing = get_page_by_path( 'locations' );
    if ( $existing ) {
        // Page exists — update meta only
        akc_set_locations_hub_meta( $existing->ID );
        return;
    }

    $content = akc_locations_hub_content();

    $post_id = wp_insert_post( [
        'post_title'   => 'Criminal Lawyer in Pune — All Areas Served',
        'post_name'    => 'locations',
        'post_content' => $content,
        'post_status'  => 'publish',
        'post_type'    => 'page',
    ] );

    if ( is_wp_error( $post_id ) || ! $post_id ) return;

    akc_set_locations_hub_meta( $post_id );
}

function akc_set_locations_hub_meta( $post_id ) {
    update_post_meta( $post_id, 'rank_math_title',         'Criminal Lawyer in Pune — All Areas Served | Adv. Akash Chikate' );
    update_post_meta( $post_id, 'rank_math_description',   'Advocate Akash Chikate serves clients across all areas of Pune — Shivajinagar, Kothrud, Wakad, Hadapsar, Baner, Viman Nagar, Pimpri-Chinchwad and more. Criminal defence, bail & family law.' );
    update_post_meta( $post_id, 'rank_math_focus_keyword', 'criminal lawyer pune areas' );
}

function akc_locations_hub_content() {
    // Get all published location pages
    $location_pages = get_posts( [
        'post_type'      => 'location_page',
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'orderby'        => 'title',
        'order'          => 'ASC',
    ] );

    $areas = [];
    foreach ( $location_pages as $lp ) {
        $area    = get_post_meta( $lp->ID, 'akc_lp_area', true ) ?: $lp->post_title;
        $tagline = get_post_meta( $lp->ID, 'akc_lp_tagline', true );
        $areas[] = [
            'title'   => $area,
            'tagline' => $tagline,
            'url'     => get_permalink( $lp->ID ),
        ];
    }

    // Build HTML content
    ob_start();
    ?>
<div style="max-width:860px;margin:0 auto;padding:2rem 1rem;">
  <p style="font-size:1.05rem;color:#444;line-height:1.8;margin-bottom:2rem;">Advocate Akash R. Chikate provides criminal defence, anticipatory bail, FIR quashing, cybercrime, family law, and NDPS defence services across all areas of Pune and Pimpri-Chinchwad. Select your area below to find location-specific legal information.</p>

  <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(240px,1fr));gap:1.25rem;margin-bottom:3rem;">
    <?php foreach ( $areas as $area ) : ?>
    <a href="<?php echo esc_url( $area['url'] ); ?>" style="display:block;padding:1.25rem 1.5rem;border:1px solid #e2ddd6;border-radius:10px;text-decoration:none;background:#fff;transition:border-color .2s,box-shadow .2s;" onmouseover="this.style.borderColor='#C9A96E';this.style.boxShadow='0 4px 16px rgba(0,0,0,0.08)';" onmouseout="this.style.borderColor='#e2ddd6';this.style.boxShadow='none';">
      <span style="display:flex;align-items:center;gap:.5rem;font-weight:700;color:#0A1628;font-size:.97rem;margin-bottom:.4rem;">
        <span style="color:#C9A96E;">&#9678;</span>
        Criminal Lawyer in <?php echo esc_html( $area['title'] ); ?>
      </span>
      <?php if ( $area['tagline'] ) : ?>
      <span style="font-size:.82rem;color:#666;line-height:1.5;"><?php echo esc_html( $area['tagline'] ); ?></span>
      <?php endif; ?>
    </a>
    <?php endforeach; ?>
  </div>

  <div style="background:#0A1628;border-radius:12px;padding:2rem 2.5rem;text-align:center;">
    <h2 style="color:#C9A96E;font-family:'Playfair Display',serif;margin-bottom:.75rem;">Not Sure Which Area?</h2>
    <p style="color:rgba(255,255,255,0.65);margin-bottom:1.5rem;">Call or WhatsApp directly — we serve all of Pune, PCMC, and surrounding districts.</p>
    <div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap;">
      <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" style="background:#C9A96E;color:#0A1628;padding:12px 24px;border-radius:5px;font-weight:700;text-decoration:none;font-size:.95rem;">Book Free Consultation</a>
      <a href="tel:+918411982241" style="background:transparent;color:#fff;padding:12px 24px;border-radius:5px;font-weight:700;text-decoration:none;border:1px solid rgba(255,255,255,.3);font-size:.95rem;">&#9742; +91 8411982241</a>
    </div>
  </div>
</div>
    <?php
    return ob_get_clean();
}
