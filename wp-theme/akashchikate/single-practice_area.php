<?php
/**
 * Single Practice Area Template
 */
get_header();
while ( have_posts() ) : the_post();
$icon    = get_post_meta( get_the_ID(), 'akc_pa_icon', true ) ?: 'fa-solid fa-gavel';
$tier    = get_post_meta( get_the_ID(), 'akc_pa_tier', true );
$faqs_raw = get_post_meta( get_the_ID(), 'akc_pa_faqs', true ); // JSON encoded
$faqs    = $faqs_raw ? json_decode( $faqs_raw, true ) : [];
?>

<!-- Page Hero -->
<section class="page-hero">
  <div class="page-hero-grid"></div>
  <div class="container">
    <div class="page-hero-content">
      <nav class="breadcrumb" aria-label="Breadcrumb">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
        <span class="sep"><i class="fa-solid fa-chevron-right"></i></span>
        <a href="<?php echo esc_url( home_url( '/practice-areas' ) ); ?>">Practice Areas</a>
        <span class="sep"><i class="fa-solid fa-chevron-right"></i></span>
        <span class="current"><?php the_title(); ?></span>
      </nav>
      <div style="width:64px; height:64px; background:rgba(201,160,48,0.15); border-radius:50%; display:flex; align-items:center; justify-content:center; margin-bottom:1.5rem;">
        <i class="<?php echo esc_attr( $icon ); ?>" style="color:var(--gold); font-size:1.5rem;"></i>
      </div>
      <h1><?php the_title(); ?></h1>
      <p class="page-desc"><?php echo esc_html( get_post_meta( get_the_ID(), 'akc_pa_summary', true ) ); ?></p>
    </div>
  </div>
</section>

<!-- Main Content + Sidebar -->
<section class="section-py section-white">
  <div class="container">
    <div class="content-sidebar-grid">

      <!-- Main Content -->
      <article>
        <div class="article-body" style="line-height:1.9; color:var(--gray-600);">
          <?php the_content(); ?>
        </div>

        <!-- FAQ Section (from meta) -->
        <?php if ( ! empty( $faqs ) ) : ?>
        <div style="margin-top:3rem;">
          <div class="section-label">Common Questions</div>
          <h2 class="section-title" style="font-size:1.6rem;">Frequently Asked <span>Questions</span></h2>
          <div class="faq-list" style="margin-top:1.5rem;">
            <?php foreach ( $faqs as $faq ) : ?>
            <div class="faq-item">
              <button class="faq-question"><?php echo esc_html( $faq['q'] ); ?> <i class="fa-solid fa-plus"></i></button>
              <div class="faq-answer"><p><?php echo wp_kses_post( $faq['a'] ); ?></p></div>
            </div>
            <?php endforeach; ?>
          </div>
        </div>
        <?php endif; ?>

        <!-- BCI Disclaimer -->
        <div style="margin-top:3rem; padding:20px 24px; background:var(--cream); border-radius:12px; border-left:3px solid var(--gold);">
          <p style="font-size:0.78rem; color:var(--gray-400); font-style:italic; margin:0;">
            <i class="fa-solid fa-scale-balanced" style="color:var(--gold); margin-right:6px;"></i>
            <strong>Disclaimer:</strong> This page is for informational purposes only and does not constitute legal advice. The Bar Council of India does not permit solicitation of work by legal practitioners. Please consult Advocate Akash R. Chikate directly for advice specific to your situation.
          </p>
        </div>
      </article>

      <!-- Sidebar -->
      <aside style="position:sticky; top:100px;">

        <!-- Emergency CTA -->
        <div style="background:var(--navy); border-radius:16px; padding:28px; margin-bottom:1.5rem; text-align:center;">
          <i class="<?php echo esc_attr( $icon ); ?>" style="font-size:2.5rem; color:var(--gold); margin-bottom:1rem;"></i>
          <h4 style="color:var(--white); margin-bottom:0.5rem;">Need Help With This?</h4>
          <p style="color:rgba(255,255,255,0.6); font-size:0.88rem; margin-bottom:1.5rem;">Free consultation. Adv. Akash R. Chikate responds within 2 hours.</p>
          <a href="<?php echo esc_url( akc_wa_link() ); ?>" class="btn btn-primary w-full" target="_blank" rel="noopener" style="margin-bottom:0.75rem; display:block;">
            <i class="fa-brands fa-whatsapp"></i> WhatsApp Now
          </a>
          <a href="<?php echo esc_url( akc_phone_link() ); ?>" class="btn btn-outline w-full" style="display:block;">
            <i class="fa-solid fa-phone"></i> <?php echo esc_html( AKC_PHONE_DISPLAY ); ?>
          </a>
          <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" style="display:block; text-align:center; margin-top:1rem; font-size:0.78rem; color:rgba(255,255,255,0.4);">
            Or fill the consultation form →
          </a>
        </div>

        <!-- Key Info Box -->
        <div style="background:var(--cream); border-radius:16px; padding:24px; margin-bottom:1.5rem;">
          <h5 style="font-size:0.72rem; font-weight:700; letter-spacing:0.15em; text-transform:uppercase; color:var(--gold); margin-bottom:1rem;">Courts We Practice In</h5>
          <div style="display:flex; flex-direction:column; gap:8px;">
            <?php
            $courts = ['Bombay High Court', 'District &amp; Sessions Court, Pune', 'Family Court, Pune', 'Consumer Court, Pune', 'JMFC Court'];
            $court_icons = ['fa-landmark', 'fa-gavel', 'fa-heart', 'fa-users', 'fa-balance-scale'];
            foreach ( $courts as $i => $court ) :
            ?>
            <div style="display:flex; align-items:center; gap:8px; font-size:0.85rem; color:var(--navy); font-weight:500;">
              <i class="fa-solid <?php echo $court_icons[$i]; ?>" style="color:var(--gold); width:14px; font-size:0.75rem;"></i>
              <?php echo $court; ?>
            </div>
            <?php endforeach; ?>
          </div>
        </div>

        <!-- Other Practice Areas -->
        <div style="background:var(--white); border-radius:16px; padding:24px; border:1px solid var(--gray-200);">
          <h5 style="font-size:0.72rem; font-weight:700; letter-spacing:0.15em; text-transform:uppercase; color:var(--gold); margin-bottom:1rem;">Other Practice Areas</h5>
          <?php
          $others = new WP_Query([
              'post_type'      => 'practice_area',
              'posts_per_page' => 6,
              'post_status'    => 'publish',
              'post__not_in'   => [ get_the_ID() ],
              'meta_key'       => 'akc_pa_tier',
              'orderby'        => 'meta_value_num',
              'order'          => 'ASC',
          ]);
          while ( $others->have_posts() ) : $others->the_post();
          ?>
          <a href="<?php the_permalink(); ?>" style="display:flex; align-items:center; gap:8px; padding:8px 0; border-bottom:1px solid var(--gray-100); font-size:0.85rem; color:var(--navy); font-weight:500; text-decoration:none;">
            <i class="fa-solid fa-chevron-right" style="color:var(--gold); font-size:0.65rem;"></i>
            <?php the_title(); ?>
          </a>
          <?php endwhile; wp_reset_postdata(); ?>
        </div>

      </aside>
    </div>
  </div>
</section>

<!-- CTA -->
<section style="background:var(--navy); padding:60px 0;">
  <div class="container" style="text-align:center; max-width:680px;">
    <h2 style="color:var(--white); margin-bottom:1rem;">Ready to Discuss <em style="color:var(--gold);">Your Case?</em></h2>
    <p style="color:rgba(255,255,255,0.55); margin-bottom:2rem;">Free, confidential first consultation. Call, WhatsApp, or book online.</p>
    <div style="display:flex; gap:1rem; justify-content:center; flex-wrap:wrap;">
      <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn btn-primary btn-lg"><i class="fa-regular fa-calendar-check"></i> Book Free Consultation</a>
      <a href="<?php echo esc_url( akc_wa_link() ); ?>" class="btn btn-outline btn-lg" target="_blank" rel="noopener"><i class="fa-brands fa-whatsapp"></i> WhatsApp Now</a>
    </div>
  </div>
</section>

<?php endwhile; get_footer(); ?>
