<?php
/**
 * 404 Template
 */
get_header();
?>

<section class="page-hero">
  <div class="page-hero-grid"></div>
  <div class="container">
    <div class="page-hero-content" style="text-align:center;">
      <div style="font-family:var(--font-serif); font-size:8rem; font-weight:800; color:var(--gold); line-height:1; margin-bottom:1rem;">404</div>
      <h1>Page <span>Not Found</span></h1>
      <p class="page-desc">The page you are looking for may have been moved or doesn't exist. Please use the navigation above to find what you need.</p>
    </div>
  </div>
</section>

<section class="section-py section-white">
  <div class="container" style="text-align:center; max-width:600px;">
    <p style="color:var(--gray-600); margin-bottom:2rem;">If you were looking for legal help, please use the options below to get in touch directly.</p>
    <div style="display:flex; gap:1rem; justify-content:center; flex-wrap:wrap;">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-outline-navy"><i class="fa-solid fa-house"></i> Back to Home</a>
      <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn btn-primary"><i class="fa-regular fa-calendar"></i> Book Consultation</a>
      <a href="<?php echo esc_url( akc_wa_link() ); ?>" class="btn btn-outline" target="_blank" rel="noopener"><i class="fa-brands fa-whatsapp"></i> WhatsApp</a>
    </div>
  </div>
</section>

<?php get_footer(); ?>
