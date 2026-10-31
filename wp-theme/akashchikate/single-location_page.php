<?php
/**
 * Single Template — Location Page
 */
get_header();

while ( have_posts() ) : the_post();

$area         = get_post_meta( get_the_ID(), 'akc_lp_area',           true );
$tagline      = get_post_meta( get_the_ID(), 'akc_lp_tagline',        true );
$police       = get_post_meta( get_the_ID(), 'akc_lp_police_station', true );
$courts       = get_post_meta( get_the_ID(), 'akc_lp_court',          true );
$practices    = get_post_meta( get_the_ID(), 'akc_lp_practices',      true ); // comma-separated
$area         = $area ?: get_the_title();
?>

<!-- Hero -->
<section class="page-hero">
  <div class="page-hero-grid"></div>
  <div class="container">
    <div class="page-hero-content">
      <nav class="breadcrumb" aria-label="Breadcrumb">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
        <span class="sep"><i class="fa-solid fa-chevron-right"></i></span>
        <a href="<?php echo esc_url( home_url( '/locations/' ) ); ?>">Locations</a>
        <span class="sep"><i class="fa-solid fa-chevron-right"></i></span>
        <span class="current"><?php echo esc_html( $area ); ?></span>
      </nav>
      <h1>Criminal Lawyer in <span><?php echo esc_html( $area ); ?></span></h1>
      <p class="page-desc"><?php echo esc_html( $tagline ); ?></p>
      <div style="display:flex;gap:1rem;flex-wrap:wrap;margin-top:1.5rem;">
        <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn btn-primary"><i class="fa-regular fa-calendar-check"></i> Book Free Consultation</a>
        <a href="<?php echo esc_url( akc_wa_urgent() ); ?>" class="btn btn-outline" target="_blank" rel="noopener"><i class="fa-brands fa-whatsapp"></i> WhatsApp Now</a>
      </div>
    </div>
  </div>
</section>

<!-- Trust bar -->
<div style="background:var(--navy-light,#1a2e5a);padding:1rem 0;border-bottom:2px solid var(--gold);">
  <div class="container">
    <div style="display:flex;gap:2rem;flex-wrap:wrap;justify-content:center;align-items:center;">
      <span style="color:#fff;font-size:.9rem;"><i class="fa-solid fa-gavel" style="color:var(--gold);margin-right:.4rem;"></i> Bombay High Court &amp; Pune Sessions Court</span>
      <span style="color:#fff;font-size:.9rem;"><i class="fa-solid fa-shield-halved" style="color:var(--gold);margin-right:.4rem;"></i> 10+ Years Experience</span>
      <span style="color:#fff;font-size:.9rem;"><i class="fa-solid fa-phone" style="color:var(--gold);margin-right:.4rem;"></i> Available for Bail Emergencies</span>
    </div>
  </div>
</div>

<!-- Main content -->
<section class="section-py section-white">
  <div class="container">
    <div class="content-sidebar-grid location-grid">

      <!-- Article body -->
      <div class="article-body" style="line-height:1.9;font-size:1rem;color:var(--gray-600);">
        <?php the_content(); ?>
      </div>

      <!-- Sidebar -->
      <aside>

        <!-- Emergency CTA -->
        <div style="background:var(--navy);border-radius:12px;padding:2rem;margin-bottom:1.5rem;text-align:center;">
          <div style="color:var(--gold);font-size:.8rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;margin-bottom:.5rem;">Bail Emergency?</div>
          <h3 style="color:#fff;font-size:1.2rem;margin-bottom:1rem;">Call Now — Available 24/7</h3>
          <a href="<?php echo esc_url( akc_phone_link() ); ?>" class="btn btn-primary" style="width:100%;justify-content:center;margin-bottom:.75rem;"><i class="fa-solid fa-phone"></i> <?php echo esc_html( AKC_PHONE_DISPLAY ); ?></a>
          <a href="<?php echo esc_url( akc_wa_urgent() ); ?>" class="btn btn-outline" style="width:100%;justify-content:center;border-color:rgba(255,255,255,.3);color:#fff;" target="_blank" rel="noopener"><i class="fa-brands fa-whatsapp"></i> WhatsApp</a>
        </div>

        <?php if ( $police ) : ?>
        <!-- Local police stations -->
        <div style="background:var(--cream);border-radius:12px;padding:1.5rem;margin-bottom:1.5rem;">
          <h4 style="color:var(--navy);margin-bottom:1rem;font-size:1rem;"><i class="fa-solid fa-building-shield" style="color:var(--gold);margin-right:.5rem;"></i>Local Police Stations</h4>
          <p style="font-size:.9rem;color:var(--gray-600);line-height:1.7;margin:0;"><?php echo esc_html( $police ); ?></p>
        </div>
        <?php endif; ?>

        <?php if ( $courts ) : ?>
        <!-- Local courts -->
        <div style="background:var(--cream);border-radius:12px;padding:1.5rem;margin-bottom:1.5rem;">
          <h4 style="color:var(--navy);margin-bottom:1rem;font-size:1rem;"><i class="fa-solid fa-landmark" style="color:var(--gold);margin-right:.5rem;"></i>Relevant Courts</h4>
          <p style="font-size:.9rem;color:var(--gray-600);line-height:1.7;margin:0;"><?php echo esc_html( $courts ); ?></p>
        </div>
        <?php endif; ?>

        <!-- Practice areas -->
        <div style="background:var(--cream);border-radius:12px;padding:1.5rem;">
          <h4 style="color:var(--navy);margin-bottom:1rem;font-size:1rem;"><i class="fa-solid fa-scale-balanced" style="color:var(--gold);margin-right:.5rem;"></i>Services in <?php echo esc_html( $area ); ?></h4>
          <?php
          $pa_query = new WP_Query([
              'post_type'      => 'practice_area',
              'posts_per_page' => 8,
              'post_status'    => 'publish',
              'orderby'        => 'menu_order',
              'order'          => 'ASC',
          ]);
          if ( $pa_query->have_posts() ) :
          ?>
          <ul style="list-style:none;padding:0;margin:0;">
            <?php while ( $pa_query->have_posts() ) : $pa_query->the_post(); ?>
            <li style="margin-bottom:.4rem;"><a href="<?php the_permalink(); ?>" style="color:var(--gray-600);font-size:.9rem;text-decoration:none;display:flex;align-items:center;gap:.4rem;"><i class="fa-solid fa-chevron-right" style="color:var(--gold);font-size:.7rem;"></i><?php the_title(); ?></a></li>
            <?php endwhile; wp_reset_postdata(); ?>
          </ul>
          <?php else : ?>
          <ul style="list-style:none;padding:0;margin:0;">
            <?php foreach(['Anticipatory Bail','Bail Application','FIR Quashing','Criminal Defence','Cyber Law','Family & Divorce','498A Defence','NDPS Defence'] as $pa): ?>
            <li style="margin-bottom:.4rem;"><span style="color:var(--gray-600);font-size:.9rem;display:flex;align-items:center;gap:.4rem;"><i class="fa-solid fa-chevron-right" style="color:var(--gold);font-size:.7rem;"></i><?php echo esc_html($pa); ?></span></li>
            <?php endforeach; ?>
          </ul>
          <?php endif; ?>
        </div>

      </aside>
    </div>
  </div>
</section>

<!-- Why choose section -->
<section class="section-py section-cream">
  <div class="container">
    <div style="text-align:center;max-width:700px;margin:0 auto 3rem;">
      <div class="section-label">Local Expertise</div>
      <h2 class="section-title">Why Choose Advocate Akash Chikate<br>for <span><?php echo esc_html( $area ); ?></span> Cases?</h2>
    </div>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:2rem;">
      <?php
      $reasons = [
          ['fa-solid fa-map-location-dot', 'Local Court Knowledge', 'Regular appearances at Pune Sessions Court and the Bombay High Court, Mumbai — familiar with local judges, prosecutors, and procedures.'],
          ['fa-solid fa-bolt', 'Fast Response', 'Bail emergencies handled same day. WhatsApp and phone available for urgent matters from ' . esc_html($area) . '.'],
          ['fa-solid fa-handshake', 'Direct Communication', 'You speak directly with Advocate Akash Chikate — not a junior or clerk. Clear updates at every stage.'],
          ['fa-solid fa-shield-halved', 'Proven Track Record', '10+ years of criminal defence, bail, and High Court matters across Pune, PCMC and Maharashtra.'],
      ];
      foreach ( $reasons as $r ) :
      ?>
      <div class="service-card reveal" style="text-align:center;">
        <div class="service-icon"><i class="<?php echo esc_attr($r[0]); ?>"></i></div>
        <h3><?php echo esc_html($r[1]); ?></h3>
        <p><?php echo esc_html($r[2]); ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- CTA -->
<section style="background:var(--navy);padding:80px 0;">
  <div class="container" style="text-align:center;max-width:680px;">
    <div class="section-label">Get Legal Help in <?php echo esc_html( $area ); ?></div>
    <h2 style="color:var(--white);margin-bottom:1rem;">Need a Lawyer in <em style="color:var(--gold);"><?php echo esc_html( $area ); ?></em>?</h2>
    <p style="color:rgba(255,255,255,0.55);font-size:1.05rem;margin-bottom:2.5rem;">Criminal defence, bail, cybercrime, family law — first consultation is free and completely confidential.</p>
    <div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap;">
      <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn btn-primary btn-lg"><i class="fa-regular fa-calendar-check"></i> Book Free Consultation</a>
      <a href="<?php echo esc_url( akc_wa_urgent() ); ?>" class="btn btn-outline btn-lg" target="_blank" rel="noopener"><i class="fa-brands fa-whatsapp"></i> WhatsApp Emergency</a>
    </div>
  </div>
</section>

<?php endwhile; ?>

<?php get_footer(); ?>
