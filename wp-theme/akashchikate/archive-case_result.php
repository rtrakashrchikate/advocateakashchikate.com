<?php
/**
 * Archive Template — Case Results
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
        <span class="current">Court Orders &amp; Results</span>
      </nav>
      <h1>Court Orders &amp; <span>Case Results</span></h1>
      <p class="page-desc">A selection of significant matters argued at the Bombay High Court and subordinate courts in Pune — bail grants, sentence suspensions, acquittals, and writ reliefs.</p>
    </div>
  </div>
</section>

<!-- Stats bar -->
<div style="background:var(--navy);padding:2rem 0;border-bottom:3px solid var(--gold);">
  <div class="container">
    <div style="display:flex;gap:3rem;flex-wrap:wrap;justify-content:center;align-items:center;">
      <div style="text-align:center;">
        <div style="font-family:var(--font-serif);font-size:2.5rem;font-weight:800;color:var(--gold);line-height:1;">27+</div>
        <div style="color:rgba(255,255,255,0.6);font-size:.8rem;text-transform:uppercase;letter-spacing:.08em;margin-top:.25rem;">High Court Orders</div>
      </div>
      <div style="width:1px;height:50px;background:rgba(255,255,255,0.15);"></div>
      <div style="text-align:center;">
        <div style="font-family:var(--font-serif);font-size:2.5rem;font-weight:800;color:var(--gold);line-height:1;">11</div>
        <div style="color:rgba(255,255,255,0.6);font-size:.8rem;text-transform:uppercase;letter-spacing:.08em;margin-top:.25rem;">Shown Below (2025)</div>
      </div>
      <div style="width:1px;height:50px;background:rgba(255,255,255,0.15);"></div>
      <div style="text-align:center;">
        <div style="font-family:var(--font-serif);font-size:2.5rem;font-weight:800;color:var(--gold);line-height:1;">BHC</div>
        <div style="color:rgba(255,255,255,0.6);font-size:.8rem;text-transform:uppercase;letter-spacing:.08em;margin-top:.25rem;">Bombay High Court</div>
      </div>
    </div>
  </div>
</div>

<!-- Disclaimer -->
<div style="background:var(--cream);border-bottom:1px solid #e0d9cc;padding:.75rem 0;">
  <div class="container">
    <p style="font-size:.78rem;color:var(--gray-500);text-align:center;margin:0;line-height:1.6;">
      <i class="fa-solid fa-circle-info" style="color:var(--gold);margin-right:.3rem;"></i>
      These matters were handled before the Bombay High Court and Pune courts. Past results do not guarantee future outcomes. Each case is decided on its own facts and merits.
      Appearances in some matters listed below may have been with or under the supervision of senior counsel and are subject to confirmation.
    </p>
  </div>
</div>

<!-- Results grid -->
<section class="section-py section-white">
  <div class="container">
    <?php
    $query = new WP_Query([
        'post_type'      => 'case_result',
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'orderby'        => 'meta_value',
        'meta_key'       => 'akc_cr_date_sort',
        'order'          => 'DESC',
    ]);
    ?>

    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(340px,1fr));gap:1.75rem;">
    <?php
    if ( $query->have_posts() ) :
        while ( $query->have_posts() ) : $query->the_post();
            $court       = get_post_meta( get_the_ID(), 'akc_cr_court',       true );
            $bench       = get_post_meta( get_the_ID(), 'akc_cr_bench',       true );
            $date_str    = get_post_meta( get_the_ID(), 'akc_cr_date',        true );
            $section     = get_post_meta( get_the_ID(), 'akc_cr_section',     true );
            $result      = get_post_meta( get_the_ID(), 'akc_cr_result',      true );
            $result_type = get_post_meta( get_the_ID(), 'akc_cr_result_type', true ) ?: 'success';
            $summary     = get_post_meta( get_the_ID(), 'akc_cr_summary',     true );
            $argument    = get_post_meta( get_the_ID(), 'akc_cr_argument',    true );

            $badge_colors = [
                'success' => ['bg' => '#0a5c36', 'label' => 'Relief Granted'],
                'partial' => ['bg' => '#7a5a00', 'label' => 'Partial Relief'],
                'rejected'=> ['bg' => '#7a1a1a', 'label' => 'Application Rejected'],
            ];
            $bc = $badge_colors[ $result_type ] ?? $badge_colors['success'];
    ?>
      <div class="reveal" style="background:#fff;border:1px solid #e8e2d8;border-radius:12px;overflow:hidden;display:flex;flex-direction:column;box-shadow:0 2px 12px rgba(13,27,62,.06);">

        <!-- Card header -->
        <div style="background:var(--navy);padding:1rem 1.25rem;display:flex;justify-content:space-between;align-items:flex-start;gap:.5rem;">
          <div>
            <div style="color:rgba(255,255,255,0.55);font-size:.72rem;text-transform:uppercase;letter-spacing:.08em;margin-bottom:.2rem;"><?php echo esc_html( $court ); ?></div>
            <div style="color:var(--gold);font-size:.8rem;font-weight:600;"><?php echo esc_html( $bench ); ?></div>
          </div>
          <div style="background:rgba(255,255,255,0.08);border-radius:6px;padding:.25rem .6rem;font-size:.75rem;color:#fff;white-space:nowrap;flex-shrink:0;"><?php echo esc_html( $date_str ); ?></div>
        </div>

        <!-- Result badge -->
        <div style="background:<?php echo esc_attr( $bc['bg'] ); ?>;padding:.6rem 1.25rem;display:flex;align-items:center;gap:.5rem;">
          <i class="fa-solid <?php echo $result_type === 'rejected' ? 'fa-circle-xmark' : 'fa-circle-check'; ?>" style="color:#fff;font-size:.9rem;"></i>
          <span style="color:#fff;font-weight:700;font-size:.85rem;text-transform:uppercase;letter-spacing:.06em;"><?php echo esc_html( $result ); ?></span>
        </div>

        <!-- Card body -->
        <div style="padding:1.25rem;flex:1;display:flex;flex-direction:column;gap:.75rem;">

          <!-- Offence tag -->
          <div style="display:inline-flex;align-items:center;gap:.35rem;background:var(--cream);border-radius:4px;padding:.25rem .6rem;font-size:.75rem;color:var(--navy);font-weight:600;width:fit-content;">
            <i class="fa-solid fa-gavel" style="color:var(--gold);font-size:.7rem;"></i>
            <?php echo esc_html( $section ); ?>
          </div>

          <!-- Summary -->
          <p style="font-size:.88rem;color:var(--gray-600);line-height:1.75;margin:0;"><?php echo esc_html( $summary ); ?></p>

          <?php if ( $argument ) : ?>
          <!-- Key argument -->
          <div style="border-left:3px solid var(--gold);padding:.5rem .75rem;background:#fffdf5;border-radius:0 6px 6px 0;">
            <div style="font-size:.7rem;color:var(--gray-500);text-transform:uppercase;letter-spacing:.07em;margin-bottom:.2rem;">Key Argument</div>
            <p style="font-size:.82rem;color:var(--navy);font-weight:500;margin:0;line-height:1.6;"><?php echo esc_html( $argument ); ?></p>
          </div>
          <?php endif; ?>

          <!-- Disclaimer -->
          <p style="font-size:.68rem;color:var(--gray-400);margin:0;margin-top:auto;padding-top:.75rem;border-top:1px solid #f0ebe3;line-height:1.5;font-style:italic;">
            Appearance in this matter may or may not have been with senior counsel and is subject to confirmation. Past results do not guarantee future outcomes.
          </p>

        </div>
      </div>
    <?php
        endwhile;
        wp_reset_postdata();
    else :
    ?>
      <p style="color:var(--gray-500);text-align:center;grid-column:1/-1;">No case results found.</p>
    <?php endif; ?>
    </div>

  </div>
</section>

<!-- CTA -->
<section style="background:var(--navy);padding:80px 0;">
  <div class="container" style="text-align:center;max-width:680px;">
    <div class="section-label">Experienced Representation</div>
    <h2 style="color:var(--white);margin-bottom:1rem;">Facing a Serious Criminal Matter?</h2>
    <p style="color:rgba(255,255,255,0.55);font-size:1.05rem;margin-bottom:2.5rem;">Bail emergencies, High Court matters, murder trials, cybercrime — handled personally. First consultation is free.</p>
    <div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap;">
      <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn btn-primary btn-lg"><i class="fa-regular fa-calendar-check"></i> Book Free Consultation</a>
      <a href="<?php echo esc_url( akc_wa_urgent() ); ?>" class="btn btn-outline btn-lg" target="_blank" rel="noopener"><i class="fa-brands fa-whatsapp"></i> WhatsApp Emergency</a>
    </div>
  </div>
</section>

<?php get_footer(); ?>
