<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- ══ BCI DISCLAIMER BANNER ══ -->
<div class="disclaimer-banner" id="disclaimer-banner" style="background:#0d1b3e; border-bottom:1px solid rgba(201,160,48,0.2); padding:10px 0; display:none;">
  <div class="container">
    <div class="disclaimer-inner">
      <p style="color:rgba(255,255,255,0.45); font-size:0.78rem;">
        <i class="fa-solid fa-scale-balanced" style="color:var(--gold); margin-right:6px;"></i>
        <strong style="color:rgba(255,255,255,0.6);">Disclaimer:</strong> The Bar Council of India does not permit solicitation of work or advertising by legal practitioners. This website is for informational purposes only and does not constitute legal advice.
      </p>
      <button id="disclaimer-close" style="background:none; border:none; color:rgba(255,255,255,0.4); cursor:pointer; font-size:1rem; padding:4px; flex-shrink:0;">
        <i class="fa-solid fa-xmark"></i>
      </button>
    </div>
  </div>
</div>

<!-- ══ NAVIGATION ══ -->
<nav id="navbar">
  <div class="container">
    <div class="nav-inner">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nav-logo">
        <span class="logo-name">Adv. Akash R. Chikate</span>
        <span class="logo-tag">Criminal Defence Attorney · Pune</span>
      </a>

      <ul class="nav-links">
        <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"<?php echo is_front_page() ? ' class="active"' : ''; ?>>Home</a></li>
        <li><a href="<?php echo esc_url( home_url( '/about' ) ); ?>"<?php echo is_page( 'about' ) ? ' class="active"' : ''; ?>>About</a></li>
        <li><a href="<?php echo esc_url( home_url( '/practice-areas' ) ); ?>"<?php echo is_page( 'practice-areas' ) || is_singular( 'practice_area' ) ? ' class="active"' : ''; ?>>Practice Areas</a></li>
        <li><a href="<?php echo esc_url( home_url( '/blog' ) ); ?>"<?php echo is_home() || is_singular( 'post' ) ? ' class="active"' : ''; ?>>Insights</a></li>
        <li><a href="<?php echo esc_url( home_url( '/contact' ) ); ?>"<?php echo is_page( 'contact' ) ? ' class="active"' : ''; ?>>Contact</a></li>
      </ul>

      <div class="nav-cta">
        <span class="nav-phone"><i class="fa-solid fa-phone"></i> <?php echo esc_html( AKC_PHONE_DISPLAY ); ?></span>
        <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn btn-primary" style="padding:10px 20px; font-size:0.75rem;">
          <i class="fa-regular fa-calendar"></i> Free Consultation
        </a>
      </div>

      <button class="hamburger" aria-label="Menu">
        <span></span><span></span><span></span>
      </button>
    </div>
  </div>
</nav>

<!-- ══ MOBILE NAV ══ -->
<div class="mobile-nav">
  <button class="mobile-nav-close"><i class="fa-solid fa-xmark"></i></button>
  <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
  <a href="<?php echo esc_url( home_url( '/about' ) ); ?>">About</a>
  <a href="<?php echo esc_url( home_url( '/practice-areas' ) ); ?>">Practice Areas</a>
  <a href="<?php echo esc_url( home_url( '/blog' ) ); ?>">Insights</a>
  <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>">Contact</a>
  <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn btn-primary mt-3">Book Free Consultation</a>
</div>
