<?php
/**
 * Archive Template — Practice Areas
 */
get_header();
?>

<section class="page-hero">
  <div class="page-hero-grid"></div>
  <div class="container">
    <div class="page-hero-content">
      <nav class="breadcrumb" aria-label="Breadcrumb">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
        <span class="sep"><i class="fa-solid fa-chevron-right"></i></span>
        <span class="current">Practice Areas</span>
      </nav>
      <h1>Legal Services &amp; <span>Practice Areas</span></h1>
      <p class="page-desc">Comprehensive legal representation in criminal, cyber, family, corporate, IP, and POSH matters — at Bombay High Court and Pune courts.</p>
    </div>
  </div>
</section>

<!-- Tier 1 — Primary Practice Areas -->
<?php
$tier1 = new WP_Query([
    'post_type'      => 'practice_area',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'meta_key'       => 'akc_pa_tier',
    'meta_value'     => '1',
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
]);
if ( $tier1->have_posts() ) :
?>
<section class="section-py section-white">
  <div class="container">
    <div style="text-align:center; max-width:700px; margin:0 auto 3rem;">
      <div class="section-label">Core Practice Areas</div>
      <h2 class="section-title">Criminal Defence <span>Specialisations</span></h2>
      <p class="section-subtitle">The most critical areas of criminal law — where experienced representation makes the difference between freedom and incarceration.</p>
    </div>
    <div class="services-grid" style="grid-template-columns:repeat(auto-fit,minmax(280px,1fr));">
      <?php while ( $tier1->have_posts() ) : $tier1->the_post();
        $icon    = get_post_meta( get_the_ID(), 'akc_pa_icon', true ) ?: 'fa-solid fa-gavel';
        $summary = get_post_meta( get_the_ID(), 'akc_pa_summary', true );
      ?>
      <a href="<?php the_permalink(); ?>" class="service-card reveal" style="border-top:3px solid var(--gold);">
        <div class="service-icon"><i class="<?php echo esc_attr( $icon ); ?>"></i></div>
        <h3><?php the_title(); ?></h3>
        <p><?php echo esc_html( $summary ); ?></p>
        <span class="service-arrow">Learn More <i class="fa-solid fa-arrow-right"></i></span>
      </a>
      <?php endwhile; wp_reset_postdata(); ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- Tier 2 — All Other Practice Areas -->
<?php
$tier2 = new WP_Query([
    'post_type'      => 'practice_area',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'meta_key'       => 'akc_pa_tier',
    'meta_value'     => '2',
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
]);
if ( $tier2->have_posts() ) :
?>
<section class="section-py section-cream">
  <div class="container">
    <div style="text-align:center; max-width:700px; margin:0 auto 3rem;">
      <div class="section-label">All Practice Areas</div>
      <h2 class="section-title">Full Range of <span>Legal Services</span></h2>
      <p class="section-subtitle">Expert legal representation across civil, family, corporate, and specialised matters in Pune and Maharashtra.</p>
    </div>
    <div class="services-grid">
      <?php $i=0; while ( $tier2->have_posts() ) : $tier2->the_post();
        $icon    = get_post_meta( get_the_ID(), 'akc_pa_icon', true ) ?: 'fa-solid fa-scale-balanced';
        $summary = get_post_meta( get_the_ID(), 'akc_pa_summary', true );
        $delays  = ['','delay-1','delay-2','','delay-1','delay-2','','delay-1','delay-2','','delay-1','delay-2','','delay-1'];
        $dc      = $delays[$i % 14];
      ?>
      <a href="<?php the_permalink(); ?>" class="service-card reveal <?php echo esc_attr($dc); ?>">
        <div class="service-icon"><i class="<?php echo esc_attr( $icon ); ?>"></i></div>
        <h3><?php the_title(); ?></h3>
        <p><?php echo esc_html( $summary ); ?></p>
        <span class="service-arrow">Learn More <i class="fa-solid fa-arrow-right"></i></span>
      </a>
      <?php $i++; endwhile; wp_reset_postdata(); ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- FAQ Section -->
<section class="faq-section">
  <div class="container">
    <div style="text-align:center; max-width:600px; margin:0 auto 3rem;">
      <div class="section-label">Common Questions</div>
      <h2 class="section-title">Frequently Asked <span>Legal Questions</span></h2>
      <p class="section-subtitle" style="margin:0 auto;">Answers to common questions about criminal law, bail, divorce, and cybercrime in India.</p>
    </div>
    <div class="faq-list">
      <?php
      $faqs = [
          [
              'q' => 'What is the difference between bail and anticipatory bail in India?',
              'a' => 'Bail (S.483 BNSS / S.439 CrPC) is applied for after arrest to secure release from custody. Anticipatory bail (S.482 BNSS / S.438 CrPC) is applied for <em>before</em> arrest when a person apprehends arrest. If anticipatory bail is granted, you cannot be arrested without prior notice to your lawyer. Regular bail is the post-arrest remedy to be released pending trial.',
          ],
          [
              'q' => 'Can an FIR be quashed in Pune / Maharashtra?',
              'a' => 'Yes. The Bombay High Court has inherent powers under S.528 BNSS (formerly S.482 CrPC) to quash an FIR if it is filed with malicious intent, the allegations are frivolous, or the parties have settled. A qualified criminal lawyer can file a writ petition at the Bombay High Court.',
          ],
          [
              'q' => 'How long does a divorce take in India?',
              'a' => 'Mutual consent divorce (S.13B HMA) typically takes 6–18 months including the mandatory cooling-off period (which courts may waive in genuine cases). Contested divorce can take 2–5 years. An experienced family lawyer can significantly streamline the process.',
          ],
          [
              'q' => 'What should I do if I receive a cybercrime notice or FIR?',
              'a' => 'Do not panic. Do not delete any digital data or devices. Do not share passwords with anyone. Do not make public statements online. Contact a cyber law advocate immediately. Early legal intervention can significantly improve the outcome.',
          ],
          [
              'q' => 'What is the first thing to do when arrested in India?',
              'a' => 'Under Article 22 of the Constitution: (1) You have the right to know the grounds of arrest. (2) You have the right to consult a lawyer. (3) You must be produced before a Magistrate within 24 hours. (4) Do not sign any document or give any statement without your lawyer present. Call a criminal lawyer immediately — the first 24 hours are critical.',
          ],
          [
              'q' => 'Is my company required to have a POSH policy?',
              'a' => 'Yes. The POSH Act 2013 applies to all employers with 10 or more employees. You must: (1) Form an Internal Complaints Committee (ICC), (2) Draft an anti-harassment policy, (3) Conduct annual training, and (4) Submit an annual compliance report. Non-compliance can result in fines of ₹50,000 and cancellation of business licences.',
          ],
      ];
      foreach ( $faqs as $faq ) :
      ?>
      <div class="faq-item">
        <button class="faq-question"><?php echo esc_html( $faq['q'] ); ?> <i class="fa-solid fa-plus"></i></button>
        <div class="faq-answer"><p><?php echo $faq['a']; ?></p></div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- CTA -->
<section style="background:var(--navy); padding:80px 0;">
  <div class="container" style="text-align:center; max-width:680px;">
    <div class="section-label">Get Legal Help Now</div>
    <h2 style="color:var(--white); margin-bottom:1rem;">Need <em style="color:var(--gold);">Immediate</em> Legal Assistance?</h2>
    <p style="color:rgba(255,255,255,0.55); font-size:1.05rem; margin-bottom:2.5rem;">Whether it's a bail emergency, a cybercrime notice, or a family dispute — reach out now. First consultation is free and completely confidential.</p>
    <div style="display:flex; gap:1rem; justify-content:center; flex-wrap:wrap;">
      <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn btn-primary btn-lg"><i class="fa-regular fa-calendar-check"></i> Book Free Consultation</a>
      <a href="<?php echo esc_url( akc_wa_urgent() ); ?>" class="btn btn-outline btn-lg" target="_blank" rel="noopener"><i class="fa-brands fa-whatsapp"></i> WhatsApp Emergency</a>
    </div>
  </div>
</section>

<?php get_footer(); ?>
