<?php
/**
 * Single Post Template
 */
get_header();
?>

<?php while ( have_posts() ) : the_post(); ?>

<section class="page-hero">
  <div class="page-hero-grid"></div>
  <div class="container">
    <div class="page-hero-content">
      <nav class="breadcrumb" aria-label="Breadcrumb">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
        <span class="sep"><i class="fa-solid fa-chevron-right"></i></span>
        <a href="<?php echo esc_url( home_url( '/blog' ) ); ?>">Insights</a>
        <span class="sep"><i class="fa-solid fa-chevron-right"></i></span>
        <span class="current"><?php the_title(); ?></span>
      </nav>
      <?php $cat = get_the_category(); if ( $cat ) : ?>
        <span class="blog-category" style="margin-bottom:1rem; display:inline-block;"><?php echo esc_html( $cat[0]->name ); ?></span>
      <?php endif; ?>
      <h1><?php the_title(); ?></h1>
      <div class="blog-meta" style="color:rgba(255,255,255,0.5); margin-top:1rem;">
        <span><i class="fa-regular fa-calendar"></i> <?php echo get_the_date( 'F j, Y' ); ?></span> &nbsp;·&nbsp;
        <span><i class="fa-regular fa-clock"></i> <?php echo ceil( str_word_count( get_the_content() ) / 200 ); ?> min read</span>
      </div>
    </div>
  </div>
</section>

<section class="section-py section-white">
  <div class="container">
    <div class="content-sidebar-grid">

      <!-- Main Content -->
      <article class="blog-article">
        <?php if ( has_post_thumbnail() ) : ?>
          <div style="margin-bottom:2rem; border-radius:12px; overflow:hidden;">
            <?php the_post_thumbnail( 'large', [ 'style' => 'width:100%; height:360px; object-fit:cover;' ] ); ?>
          </div>
        <?php endif; ?>

        <div class="article-body" style="line-height:1.9; font-size:1rem; color:var(--gray-600);">
          <?php the_content(); ?>
        </div>

        <div style="margin-top:3rem; padding:24px; background:var(--cream); border-radius:12px;">
          <p style="font-size:0.78rem; color:var(--gray-400); font-style:italic;">
            <i class="fa-solid fa-scale-balanced" style="color:var(--gold); margin-right:6px;"></i>
            <strong>Disclaimer:</strong> This article is for informational purposes only and does not constitute legal advice. For advice specific to your situation, consult Advocate Akash R. Chikate directly.
          </p>
        </div>
      </article>

      <!-- Sidebar -->
      <aside style="position:sticky; top:100px;">

        <!-- WhatsApp CTA -->
        <div style="background:var(--navy); border-radius:16px; padding:28px; margin-bottom:2rem; text-align:center;">
          <i class="fa-brands fa-whatsapp" style="font-size:2.5rem; color:#25d366; margin-bottom:1rem;"></i>
          <h4 style="color:var(--white); margin-bottom:0.5rem;">Need Legal Help?</h4>
          <p style="color:rgba(255,255,255,0.6); font-size:0.88rem; margin-bottom:1.5rem;">Get a free consultation. WhatsApp for a quick response.</p>
          <a href="<?php echo esc_url( akc_wa_link() ); ?>" class="btn btn-primary w-full" target="_blank" rel="noopener">
            <i class="fa-brands fa-whatsapp"></i> WhatsApp Now
          </a>
          <a href="<?php echo esc_url( akc_phone_link() ); ?>" class="btn btn-outline w-full mt-2">
            <i class="fa-solid fa-phone"></i> <?php echo esc_html( AKC_PHONE_DISPLAY ); ?>
          </a>
        </div>

        <!-- Practice Areas -->
        <div style="background:var(--cream); border-radius:16px; padding:24px;">
          <h5 style="font-size:0.72rem; font-weight:700; letter-spacing:0.15em; text-transform:uppercase; color:var(--gold); margin-bottom:1rem;">Practice Areas</h5>
          <?php
          $pa_list = [
              'Criminal Defence' => '/practice-areas/criminal-defence',
              'Anticipatory Bail' => '/practice-areas/anticipatory-bail',
              'FIR Quashing' => '/practice-areas/fir-quashing',
              'Cyber &amp; IT Law' => '/practice-areas/cyber-it-law',
              'Family Law' => '/practice-areas/family-law',
              'NDPS Defence' => '/practice-areas/ndps-defence',
              'POCSO Defence' => '/practice-areas/pocso-defence',
          ];
          foreach ( $pa_list as $name => $url ) :
          ?>
            <a href="<?php echo esc_url( home_url( $url ) ); ?>" style="display:flex; align-items:center; gap:8px; padding:8px 0; border-bottom:1px solid var(--gray-200); font-size:0.88rem; color:var(--navy); font-weight:500; text-decoration:none;">
              <i class="fa-solid fa-chevron-right" style="color:var(--gold); font-size:0.7rem;"></i> <?php echo $name; ?>
            </a>
          <?php endforeach; ?>
        </div>
      </aside>

    </div>
  </div>
</section>

<?php endwhile; ?>

<!-- CTA SECTION -->
<section style="background:var(--navy); padding:60px 0;">
  <div class="container" style="text-align:center; max-width:680px;">
    <h2 style="color:var(--white); margin-bottom:1rem;">Have Questions About Your Case?</h2>
    <p style="color:rgba(255,255,255,0.55); margin-bottom:2rem;">Speak directly with Advocate Akash R. Chikate. Free, confidential first consultation.</p>
    <div style="display:flex; gap:1rem; justify-content:center; flex-wrap:wrap;">
      <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn btn-primary btn-lg"><i class="fa-regular fa-calendar-check"></i> Book Free Consultation</a>
      <a href="<?php echo esc_url( akc_wa_link() ); ?>" class="btn btn-outline btn-lg" target="_blank" rel="noopener"><i class="fa-brands fa-whatsapp"></i> WhatsApp Now</a>
    </div>
  </div>
</section>

<?php get_footer(); ?>
