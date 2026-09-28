<?php
/**
 * Template Name: Ads Landing Page
 *
 * Stripped-down, conversion-focused template for Google Ads landing pages.
 * No site navigation. Single CTA focus: WhatsApp + Call.
 * Hero, trust bar, content, testimonial, form, sticky mobile bar.
 */

$post_id       = get_the_ID();
$hero_title    = get_post_meta( $post_id, 'akc_ads_hero_title',    true ) ?: get_the_title();
$hero_subtitle = get_post_meta( $post_id, 'akc_ads_hero_subtitle', true );
$hero_badge    = get_post_meta( $post_id, 'akc_ads_hero_badge',    true );
$page_type     = get_post_meta( $post_id, 'akc_ads_page_type',     true ) ?: 'criminal';
$show_emergency = ( $page_type === 'criminal' );
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
  <style>
  /* ── Reset & base ── */
  *, *::before, *::after { box-sizing: border-box; }
  body.ads-page { margin: 0; padding: 0 0 60px; background: #fff; }

  /* ── Emergency bar ── */
  .ads-emg {
    background: #b91c1c; color: #fff; text-align: center;
    padding: 8px 16px; font-size: 0.82rem; font-weight: 600;
    display: flex; align-items: center; justify-content: center;
    gap: 8px; flex-wrap: wrap;
  }
  .ads-emg i { flex-shrink: 0; }
  .ads-emg a { color: #fde68a; text-decoration: none; font-weight: 700; }
  .ads-emg a:hover { text-decoration: underline; }

  /* ── Sticky top bar ── */
  .ads-topbar {
    position: sticky; top: 0; z-index: 999;
    background: var(--navy, #0A1628);
    border-bottom: 2px solid var(--gold, #C9A96E);
    padding: 10px 20px;
    display: flex; align-items: center; justify-content: space-between;
    gap: 12px;
  }
  .ads-logo {
    font-family: 'Playfair Display', serif;
    color: var(--gold, #C9A96E); font-size: 1.05rem; font-weight: 700;
    text-decoration: none; line-height: 1.25; flex-shrink: 0;
  }
  .ads-logo span {
    display: block; color: rgba(255,255,255,0.5);
    font-size: 0.62rem; font-family: 'DM Sans', sans-serif;
    font-weight: 400; letter-spacing: 0.07em; text-transform: uppercase;
  }
  .ads-topbar-right { display: flex; gap: 8px; align-items: center; }
  .ads-topbar-phone {
    color: #fff; text-decoration: none; font-size: 0.84rem;
    font-weight: 600; display: flex; align-items: center; gap: 6px;
    white-space: nowrap;
  }
  .ads-topbar-phone i { color: var(--gold, #C9A96E); }
  .ads-topbar-wa {
    background: #25D366; color: #fff; text-decoration: none;
    padding: 8px 14px; border-radius: 5px; font-weight: 700;
    font-size: 0.82rem; display: flex; align-items: center; gap: 6px;
    white-space: nowrap; transition: opacity .2s;
  }
  .ads-topbar-wa:hover { opacity: 0.9; }

  /* ── Hero ── */
  .ads-hero {
    background: linear-gradient(135deg, #0A1628 0%, #152240 55%, #0A1628 100%);
    padding: 56px 20px 48px; text-align: center; position: relative; overflow: hidden;
  }
  .ads-hero-badge {
    display: inline-flex; align-items: center; gap: 8px;
    background: rgba(201,169,110,0.12); border: 1px solid rgba(201,169,110,0.3);
    color: var(--gold, #C9A96E); padding: 6px 16px; border-radius: 50px;
    font-size: 0.76rem; font-weight: 600; letter-spacing: 0.05em;
    text-transform: uppercase; margin-bottom: 20px;
  }
  .ads-hero h1 {
    font-family: 'Playfair Display', serif;
    color: #fff; font-size: clamp(1.65rem, 5vw, 2.7rem);
    line-height: 1.25; margin: 0 auto 14px; max-width: 700px;
  }
  .ads-hero h1 em { color: var(--gold, #C9A96E); font-style: normal; }
  .ads-hero-sub {
    color: rgba(255,255,255,0.68); font-size: clamp(0.88rem, 2.4vw, 1.02rem);
    max-width: 580px; margin: 0 auto 30px; line-height: 1.65;
  }
  .ads-hero-cta { display: flex; gap: 12px; justify-content: center; flex-wrap: wrap; }
  .ads-btn-wa {
    background: #25D366; color: #fff; text-decoration: none;
    padding: 14px 26px; border-radius: 6px; font-weight: 700; font-size: 1rem;
    display: inline-flex; align-items: center; gap: 8px;
    box-shadow: 0 4px 20px rgba(37,211,102,0.3); transition: transform .2s, opacity .2s;
  }
  .ads-btn-wa:hover { transform: translateY(-2px); opacity: 0.95; }
  .ads-btn-call {
    background: transparent; color: #fff; text-decoration: none;
    padding: 14px 26px; border-radius: 6px; font-weight: 700; font-size: 1rem;
    display: inline-flex; align-items: center; gap: 8px;
    border: 2px solid rgba(201,169,110,0.5); transition: all .2s;
  }
  .ads-btn-call:hover { background: rgba(201,169,110,0.1); border-color: var(--gold, #C9A96E); }

  /* ── Trust bar ── */
  .ads-trust {
    background: #f8f7f5; border-top: 3px solid var(--gold, #C9A96E);
    display: flex; justify-content: center; flex-wrap: wrap; padding: 4px 0;
  }
  .ads-trust-item {
    text-align: center; padding: 14px 22px;
    border-right: 1px solid #ddd8cf;
  }
  .ads-trust-item:last-child { border-right: none; }
  .ads-trust-num {
    font-family: 'Playfair Display', serif;
    color: var(--navy, #0A1628); font-size: 1.55rem; font-weight: 700; line-height: 1;
  }
  .ads-trust-lbl { color: #666; font-size: 0.72rem; margin-top: 3px; }

  /* ── Content area ── */
  .ads-content {
    max-width: 780px; margin: 0 auto; padding: 36px 20px 28px;
  }
  .ads-content h2 {
    font-family: 'Playfair Display', serif;
    color: var(--navy, #0A1628); font-size: 1.42rem; margin: 30px 0 10px;
    border-left: 3px solid var(--gold, #C9A96E); padding-left: 13px; line-height: 1.35;
  }
  .ads-content h3 {
    font-family: 'Playfair Display', serif;
    color: var(--navy, #0A1628); font-size: 1.12rem; margin: 22px 0 8px;
  }
  .ads-content p { color: #3f3f3f; line-height: 1.78; margin-bottom: 12px; font-size: 0.97rem; }
  .ads-content ul { padding-left: 1.3rem; color: #3f3f3f; line-height: 1.95; margin-bottom: 12px; font-size: 0.97rem; }
  .ads-content ul li::marker { color: var(--gold, #C9A96E); }
  .ads-content strong { color: var(--navy, #0A1628); }

  /* ── NRI / abroad box ── */
  .ads-nri-box {
    background: linear-gradient(135deg, #0A1628 0%, #152240 100%);
    border: 1px solid rgba(201,169,110,0.4); border-radius: 10px;
    padding: 26px 28px; margin: 28px 0;
  }
  .ads-nri-box h2 {
    color: var(--gold, #C9A96E) !important;
    border-left-color: rgba(201,169,110,0.5) !important;
  }
  .ads-nri-box h3 { color: rgba(255,255,255,0.9) !important; }
  .ads-nri-box p, .ads-nri-box ul { color: rgba(255,255,255,0.72) !important; }
  .ads-nri-box strong { color: #fff !important; }
  .ads-nri-box ul li::marker { color: var(--gold, #C9A96E); }

  /* ── FAQ ── */
  .ads-faq { border-top: 1px solid #e8e3da; margin-top: 4px; }
  .ads-faq-item { border-bottom: 1px solid #e8e3da; padding: 14px 0; }
  .ads-faq-q {
    font-weight: 700; color: var(--navy, #0A1628);
    font-size: 0.97rem; margin-bottom: 6px;
  }
  .ads-faq-q i { color: var(--gold, #C9A96E); margin-right: 8px; }
  .ads-faq-a { color: #555; font-size: 0.93rem; line-height: 1.7; margin: 0; }

  /* ── Testimonial ── */
  .ads-testi-wrap { max-width: 780px; margin: 0 auto; padding: 0 20px 28px; }
  .ads-testi {
    background: #f8f7f5; border-left: 4px solid var(--gold, #C9A96E);
    padding: 22px 26px; border-radius: 0 8px 8px 0;
  }
  .ads-testi-text {
    font-size: 0.98rem; font-style: italic; color: #444;
    line-height: 1.72; margin-bottom: 10px;
  }
  .ads-testi-author { font-weight: 700; color: var(--navy, #0A1628); font-size: 0.88rem; }
  .ads-testi-case { color: #888; font-size: 0.8rem; margin-top: 2px; }

  /* ── Form section ── */
  .ads-form-section {
    background: var(--navy, #0A1628); padding: 48px 20px; text-align: center;
  }
  .ads-form-section h2 {
    font-family: 'Playfair Display', serif;
    color: var(--gold, #C9A96E); font-size: 1.75rem; margin-bottom: 6px;
  }
  .ads-form-section > p { color: rgba(255,255,255,0.6); margin-bottom: 28px; font-size: 0.95rem; }
  .ads-form {
    max-width: 500px; margin: 0 auto;
    display: flex; flex-direction: column; gap: 13px; text-align: left;
  }
  .ads-form input, .ads-form textarea, .ads-form select {
    width: 100%; padding: 12px 15px; border-radius: 5px;
    border: 1px solid rgba(201,169,110,0.3); background: rgba(255,255,255,0.07);
    color: #fff; font-size: 0.94rem; font-family: 'DM Sans', sans-serif;
    outline: none; transition: border-color .2s;
  }
  .ads-form input:focus, .ads-form textarea:focus, .ads-form select:focus {
    border-color: rgba(201,169,110,0.7);
  }
  .ads-form input::placeholder, .ads-form textarea::placeholder { color: rgba(255,255,255,0.3); }
  .ads-form select option { background: #0A1628; color: #fff; }
  .ads-form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 13px; }
  .ads-form-submit {
    width: 100%; padding: 14px; background: var(--gold, #C9A96E);
    color: var(--navy, #0A1628); font-weight: 700; font-size: 1rem;
    border: none; border-radius: 5px; cursor: pointer;
    font-family: 'DM Sans', sans-serif; transition: opacity .2s;
    display: flex; align-items: center; justify-content: center; gap: 8px;
  }
  .ads-form-submit:hover { opacity: 0.88; }
  .ads-form-note {
    color: rgba(255,255,255,0.35); font-size: 0.76rem; text-align: center; margin-top: -4px;
  }

  /* ── Footer ── */
  .ads-footer {
    background: #07111e; padding: 24px 20px; text-align: center;
    color: rgba(255,255,255,0.3); font-size: 0.73rem; line-height: 1.65;
  }
  .ads-footer a { color: rgba(201,169,110,0.45); text-decoration: none; }
  .ads-footer a:hover { color: rgba(201,169,110,0.7); }
  .ads-footer-name { color: rgba(201,169,110,0.65); font-weight: 600; font-size: 0.82rem; }
  .ads-footer-disc {
    margin-top: 12px; max-width: 640px; margin-left: auto; margin-right: auto;
  }

  /* ── Sticky mobile CTA bar ── */
  .ads-sticky {
    position: fixed; bottom: 0; left: 0; right: 0; z-index: 997;
    display: grid; grid-template-columns: 1fr 1fr;
  }
  .ads-sticky-wa {
    background: #25D366; color: #fff; text-decoration: none;
    padding: 15px; text-align: center; font-weight: 700; font-size: 0.97rem;
    display: flex; align-items: center; justify-content: center; gap: 7px;
  }
  .ads-sticky-call {
    background: var(--navy, #0A1628); color: var(--gold, #C9A96E);
    text-decoration: none; padding: 15px; text-align: center;
    font-weight: 700; font-size: 0.97rem;
    display: flex; align-items: center; justify-content: center; gap: 7px;
    border-top: 2px solid rgba(201,169,110,0.25);
  }

  @media (min-width: 769px) {
    .ads-sticky { display: none !important; }
    body.ads-page { padding-bottom: 0; }
  }
  @media (max-width: 520px) {
    .ads-topbar-phone .ph-text { display: none; }
    .ads-form-row { grid-template-columns: 1fr; }
    .ads-trust-item { padding: 12px 14px; }
    .ads-nri-box { padding: 18px 16px; }
  }
  </style>
</head>
<body class="ads-page" <?php body_class(); ?>>

<?php if ( $show_emergency ) : ?>
<div class="ads-emg">
  <i class="fa-solid fa-circle-exclamation"></i>
  Bail Emergency? &nbsp;
  <a href="<?php echo esc_url( akc_wa_urgent() ); ?>" target="_blank" rel="noopener">WhatsApp Now</a>
  &nbsp;&nbsp;|&nbsp;&nbsp;
  <a href="tel:+918411982241">Call +91&nbsp;8411982241</a>
</div>
<?php endif; ?>

<!-- ══ TOP BAR ══ -->
<div class="ads-topbar">
  <a href="<?php echo esc_url( home_url() ); ?>" class="ads-logo">
    Adv. Akash R. Chikate
    <span>Pune &amp; Bombay High Court</span>
  </a>
  <div class="ads-topbar-right">
    <a href="tel:+918411982241" class="ads-topbar-phone">
      <i class="fa-solid fa-phone"></i>
      <span class="ph-text">+91 8411982241</span>
    </a>
    <a href="<?php echo esc_url( akc_wa_link() ); ?>" class="ads-topbar-wa" target="_blank" rel="noopener">
      <i class="fa-brands fa-whatsapp"></i> WhatsApp
    </a>
  </div>
</div>

<!-- ══ HERO ══ -->
<section class="ads-hero">
  <?php if ( $hero_badge ) : ?>
  <div class="ads-hero-badge">
    <i class="fa-solid fa-shield-halved"></i>
    <?php echo esc_html( $hero_badge ); ?>
  </div>
  <?php endif; ?>

  <h1><?php echo wp_kses( $hero_title, [ 'em' => [], 'br' => [], 'strong' => [] ] ); ?></h1>

  <?php if ( $hero_subtitle ) : ?>
  <p class="ads-hero-sub"><?php echo esc_html( $hero_subtitle ); ?></p>
  <?php endif; ?>

  <div class="ads-hero-cta">
    <a href="<?php echo esc_url( akc_wa_link() ); ?>" class="ads-btn-wa" target="_blank" rel="noopener">
      <i class="fa-brands fa-whatsapp"></i> WhatsApp Now
    </a>
    <a href="tel:+918411982241" class="ads-btn-call">
      <i class="fa-solid fa-phone"></i> Call +91 8411982241
    </a>
  </div>
</section>

<!-- ══ TRUST BAR ══ -->
<div class="ads-trust">
  <div class="ads-trust-item">
    <div class="ads-trust-num">99+</div>
    <div class="ads-trust-lbl">Cases Handled</div>
  </div>
  <div class="ads-trust-item">
    <div class="ads-trust-num">8+</div>
    <div class="ads-trust-lbl">Years Experience</div>
  </div>
  <div class="ads-trust-item">
    <div class="ads-trust-num">27+</div>
    <div class="ads-trust-lbl">Bombay HC Orders</div>
  </div>
  <div class="ads-trust-item">
    <div class="ads-trust-num">BCI</div>
    <div class="ads-trust-lbl">Licensed Advocate</div>
  </div>
</div>

<!-- ══ MAIN CONTENT ══ -->
<div class="ads-content">
  <?php
  while ( have_posts() ) :
      the_post();
      the_content();
  endwhile;
  ?>
</div>

<!-- ══ TESTIMONIAL ══ -->
<?php
$testimonials = [
    'criminal' => [
        'text'   => '"Advocate Akash secured my anticipatory bail within 24 hours when my family was in complete panic. His clarity, speed, and professionalism in the Sessions Court was remarkable. I will always be grateful."',
        'author' => 'Rahul M.',
        'case'   => 'Anticipatory Bail · Pune Sessions Court',
    ],
    'family' => [
        'text'   => '"Advocate Akash handled our mutual divorce with complete sensitivity and efficiency. He guided us through every step clearly and ensured everything was filed correctly. A difficult process was made straightforward."',
        'author' => 'Priya & Amit S.',
        'case'   => 'Mutual Consent Divorce · Pune Family Court',
    ],
];
$testi = isset( $testimonials[ $page_type ] ) ? $testimonials[ $page_type ] : $testimonials['criminal'];
?>
<div class="ads-testi-wrap">
  <div class="ads-testi">
    <p class="ads-testi-text"><?php echo esc_html( $testi['text'] ); ?></p>
    <div class="ads-testi-author"><?php echo esc_html( $testi['author'] ); ?></div>
    <div class="ads-testi-case"><?php echo esc_html( $testi['case'] ); ?></div>
  </div>
</div>

<!-- ══ CONSULTATION FORM ══ -->
<section class="ads-form-section" id="consult">
  <h2>Get Free Legal Advice</h2>
  <p>Fill in your details — we will call you back within 2 hours. Completely confidential.</p>

  <?php if ( function_exists( 'wpcf7_contact_form' ) ) : ?>
    <?php echo do_shortcode( '[contact-form-7 id="3acb990" title="Consultation Form"]' ); ?>
  <?php else : ?>
  <form class="ads-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" autocomplete="off">
    <?php wp_nonce_field( 'akc_consultation_form', 'akc_form_nonce' ); ?>
    <input type="hidden" name="action"     value="akc_consultation_submit">
    <input type="hidden" name="akc_source" value="<?php echo esc_attr( get_the_title() . ' (Google Ads)' ); ?>">
    <div class="ads-form-row">
      <input type="text" name="akc_name"  placeholder="Full Name"      required>
      <input type="tel"  name="akc_phone" placeholder="+91 Phone Number" required>
    </div>
    <select name="akc_matter">
      <option value="">Type of Legal Matter…</option>
      <?php if ( $page_type === 'criminal' ) : ?>
      <option>Anticipatory Bail</option>
      <option>Regular Bail</option>
      <option>FIR Quashing</option>
      <option>Criminal Defence / Trial</option>
      <option>NDPS / Drug Case</option>
      <option>Cybercrime Defence</option>
      <option>498A / Domestic Violence</option>
      <?php else : ?>
      <option>Mutual Consent Divorce</option>
      <option>Contested Divorce</option>
      <option>Maintenance / Alimony</option>
      <option>Child Custody</option>
      <option>NRI / Overseas Divorce Matter</option>
      <?php endif; ?>
      <option>Other</option>
    </select>
    <textarea name="akc_message" placeholder="Briefly describe your situation (strictly confidential)…" rows="3"></textarea>
    <button type="submit" class="ads-form-submit">
      <i class="fa-solid fa-paper-plane"></i> Submit — We\'ll Call Back in 2 Hours
    </button>
    <p class="ads-form-note"><i class="fa-solid fa-lock"></i> Protected by attorney-client privilege. Strictly confidential.</p>
  </form>
  <?php endif; ?>
</section>

<!-- ══ FOOTER ══ -->
<footer class="ads-footer">
  <p>
    <span class="ads-footer-name">Advocate Akash R. Chikate &amp; Associates</span><br>
    Office No. 202-203, Ekbote Complex, Revenue Colony, Shivajinagar, Pune — 411 005<br>
    <a href="tel:+918411982241">+91 8411982241</a>
    &nbsp;|&nbsp;
    <a href="<?php echo esc_url( akc_wa_link() ); ?>" target="_blank" rel="noopener">WhatsApp: +91 8698400302</a>
  </p>
  <p class="ads-footer-disc">
    <strong>Bar Council of India Disclaimer:</strong>
    As per the rules of the Bar Council of India, lawyers are not permitted to solicit work or advertise.
    This page is for informational purposes only. No attorney-client relationship is created by visiting this page.
    Nothing here constitutes legal advice and should not be acted upon without consulting a qualified lawyer.
  </p>
  <p style="margin-top:10px;">
    <a href="<?php echo esc_url( home_url() ); ?>">Main Website</a>
    &nbsp;|&nbsp;
    <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>">Contact</a>
    &nbsp;|&nbsp;
    <a href="<?php echo esc_url( home_url( '/practice-areas' ) ); ?>">Practice Areas</a>
  </p>
</footer>

<!-- ══ STICKY MOBILE BAR ══ -->
<div class="ads-sticky">
  <a href="<?php echo esc_url( akc_wa_link() ); ?>" class="ads-sticky-wa" target="_blank" rel="noopener">
    <i class="fa-brands fa-whatsapp"></i> WhatsApp
  </a>
  <a href="tel:+918411982241" class="ads-sticky-call">
    <i class="fa-solid fa-phone"></i> Call Now
  </a>
</div>

<?php wp_footer(); ?>
</body>
</html>
