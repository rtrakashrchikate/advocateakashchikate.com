<?php
/**
 * Front Page (Homepage) Template
 * Template Name: Homepage
 */
get_header();
?>

<!-- ══ HERO SECTION ══ -->
<section class="hero">
  <div class="hero-bg"></div>
  <div class="hero-grid"></div>

  <div class="container">
    <div class="hero-content">
      <div class="hero-left">
        <div class="hero-badge">
          <span class="dot"></span>
          <span>Bombay High Court, Mumbai &amp; Sessions Court, Pune</span>
        </div>

        <h1>
          Fighting For Your<br>
          <em>Freedom.</em> Your Rights.<br>
          Your Future.
        </h1>

        <p class="hero-desc">
          Advocate Akash R. Chikate — a dedicated criminal defence attorney in Pune with 8+ years of experience standing by clients in their most critical moments. Honest counsel. Strong defence. Real results.
        </p>

        <div class="hero-actions">
          <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn btn-primary btn-lg">
            <i class="fa-regular fa-calendar-check"></i> Book Free Consultation
          </a>
          <a href="<?php echo esc_url( akc_phone_link() ); ?>" class="btn btn-outline btn-lg">
            <i class="fa-solid fa-phone"></i> Call Now
          </a>
        </div>

        <div class="hero-trust">
          <div class="hero-trust-item">
            <span class="num"><span data-target="99">0</span>+</span>
            <span class="lbl">Cases Handled</span>
          </div>
          <div class="hero-trust-divider"></div>
          <div class="hero-trust-item">
            <span class="num"><span data-target="8">0</span>+</span>
            <span class="lbl">Years Experience</span>
          </div>
          <div class="hero-trust-divider"></div>
          <div class="hero-trust-item">
            <span class="num"><span data-target="5">0</span></span>
            <span class="lbl">Courts Practiced</span>
          </div>
          <div class="hero-trust-divider"></div>
          <div class="hero-trust-item">
            <span class="num"><span data-target="10">0</span>+</span>
            <span class="lbl">Awards &amp; Recognition</span>
          </div>
        </div>
      </div>

      <div class="hero-right">
        <div class="hero-img-wrap">
          <?php
          // Replace with actual photo: get_template_part or ACF field
          $photo = get_option( 'akc_advocate_photo' );
          if ( $photo ) :
          ?>
            <img src="<?php echo esc_url( $photo ); ?>" alt="Advocate Akash R. Chikate — Criminal Lawyer Pune" style="width:100%; height:580px; object-fit:cover; border-radius:4px 4px 0 0;">
          <?php else : ?>
            <div style="width:100%; height:580px; background:linear-gradient(180deg, rgba(26,47,90,0.3) 0%, rgba(7,17,42,0.8) 100%); border-radius:4px 4px 0 0; display:flex; align-items:center; justify-content:center;">
              <div style="text-align:center; padding:2rem;">
                <div style="width:140px; height:140px; border-radius:50%; background:rgba(201,160,48,0.15); border:2px solid rgba(201,160,48,0.3); display:flex; align-items:center; justify-content:center; margin:0 auto 1.5rem;">
                  <i class="fa-solid fa-user-tie" style="font-size:4rem; color:rgba(201,160,48,0.6);"></i>
                </div>
                <p style="color:rgba(255,255,255,0.12); font-size:0.7rem; letter-spacing:0.05em; text-transform:uppercase;">Adv. Akash R. Chikate</p>
              </div>
            </div>
          <?php endif; ?>

          <div class="hero-card hero-card-1">
            <div class="card-label">Specialization</div>
            <div class="card-value">Criminal Law</div>
            <div class="card-sub">Bombay High Court</div>
          </div>

          <div class="hero-card hero-card-2">
            <div class="card-label">Consultation</div>
            <div class="card-value">Free</div>
            <div class="card-sub">First Session · Confidential</div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="hero-scroll">
    <span>Scroll</span>
    <div class="hero-scroll-line"></div>
  </div>
</section>

<!-- ══ COURTS BAR ══ -->
<div class="courts-bar">
  <div class="container">
    <div class="courts-inner">
      <div class="court-item"><i class="fa-solid fa-landmark"></i><span>Bombay High Court</span></div>
      <div class="court-item"><i class="fa-solid fa-gavel"></i><span>District &amp; Sessions Court</span></div>
      <div class="court-item"><i class="fa-solid fa-balance-scale"></i><span>Consumer Court</span></div>
      <div class="court-item"><i class="fa-solid fa-heart"></i><span>Family Court</span></div>
      <div class="court-item"><i class="fa-solid fa-shield-halved"></i><span>JMFC Court</span></div>
    </div>
  </div>
</div>

<!-- ══ ABOUT SECTION ══ -->
<section class="about-section section-white">
  <div class="container">
    <div class="grid-2">
      <div class="about-img-wrap reveal-left">
        <div style="width:100%; height:560px; background:linear-gradient(135deg, #0d1b3e 0%, #1a2f5a 100%); border-radius:16px; overflow:hidden; position:relative;">
          <?php $about_photo = get_option( 'akc_about_photo' ) ?: get_option( 'akc_advocate_photo' ); ?>
          <?php if ( $about_photo ) : ?>
            <img src="<?php echo esc_url( $about_photo ); ?>" alt="Advocate Akash R. Chikate — Criminal Defence Attorney, Pune" style="width:100%; height:560px; object-fit:cover; display:block;">
          <?php else : ?>
          <div style="display:flex; align-items:center; justify-content:center; height:100%;">
            <div style="text-align:center;">
              <i class="fa-solid fa-user-tie" style="font-size:5rem; color:rgba(201,160,48,0.4);"></i>
              <p style="color:rgba(255,255,255,0.12); font-size:0.7rem; margin-top:1rem; letter-spacing:0.05em; text-transform:uppercase;">Adv. Akash R. Chikate</p>
            </div>
          </div>
          <?php endif; ?>
        </div>
        <div class="about-exp-badge">
          <div class="num">8+</div>
          <div class="txt">Years<br>Practice</div>
        </div>
      </div>

      <div class="about-content reveal-right">
        <div class="section-label">About the Advocate</div>
        <h2 class="section-title">Dedicated to Justice.<br><span>Committed to You.</span></h2>

        <p class="about-bio">
          Advocate Akash R. Chikate is a seasoned criminal defence attorney based in Pune, practicing before the Bombay High Court, District &amp; Sessions Court, Family Court, and Consumer Court. With over 8 years of courtroom experience, he brings a rare combination of legal precision, ethical integrity, and personal commitment to every case.
        </p>
        <p class="about-bio">
          His practice spans criminal defence, cyber law, corporate advisory, intellectual property, family law, and POSH compliance — making him a versatile advocate trusted by individuals, families, and businesses across Maharashtra.
        </p>

        <div class="about-highlights">
          <div class="highlight-item">
            <div class="highlight-icon"><i class="fa-solid fa-landmark"></i></div>
            <div><h5>High Court Advocate</h5><p>Enrolled at Bombay High Court</p></div>
          </div>
          <div class="highlight-item">
            <div class="highlight-icon"><i class="fa-solid fa-shield-halved"></i></div>
            <div><h5>Criminal Specialist</h5><p>Bail, FIR quashing, defence</p></div>
          </div>
          <div class="highlight-item">
            <div class="highlight-icon"><i class="fa-solid fa-wifi"></i></div>
            <div><h5>Cyber Law Expert</h5><p>IT Act, cybercrime defence</p></div>
          </div>
          <div class="highlight-item">
            <div class="highlight-icon"><i class="fa-solid fa-trophy"></i></div>
            <div><h5>Award Winning</h5><p>10+ media recognitions</p></div>
          </div>
        </div>

        <div class="about-credentials">
          <span class="credential-tag"><i class="fa-solid fa-check-circle"></i> Bar Council of Maharashtra &amp; Goa</span>
          <span class="credential-tag"><i class="fa-solid fa-check-circle"></i> Bombay High Court Registered</span>
          <span class="credential-tag"><i class="fa-solid fa-check-circle"></i> 8+ Years Experience</span>
        </div>

        <div class="mt-4">
          <a href="<?php echo esc_url( home_url( '/about' ) ); ?>" class="btn btn-outline-navy">
            <i class="fa-solid fa-arrow-right"></i> Learn More About Me
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ══ STATS ══ -->
<section class="stats-section">
  <div class="container">
    <div class="stats-grid">
      <div class="stat-item reveal">
        <div class="stat-icon"><i class="fa-solid fa-gavel"></i></div>
        <div class="stat-number"><span data-target="99">0</span><span>+</span></div>
        <div class="stat-label">Legal Matters Handled</div>
      </div>
      <div class="stat-item reveal delay-1">
        <div class="stat-icon"><i class="fa-solid fa-calendar-check"></i></div>
        <div class="stat-number"><span data-target="8">0</span><span>+</span></div>
        <div class="stat-label">Years of Practice</div>
      </div>
      <div class="stat-item reveal delay-2">
        <div class="stat-icon"><i class="fa-solid fa-landmark"></i></div>
        <div class="stat-number"><span data-target="5">0</span></div>
        <div class="stat-label">Courts Practiced In</div>
      </div>
      <div class="stat-item reveal delay-3">
        <div class="stat-icon"><i class="fa-solid fa-trophy"></i></div>
        <div class="stat-number"><span data-target="10">0</span><span>+</span></div>
        <div class="stat-label">Awards &amp; Media Recognition</div>
      </div>
    </div>
  </div>
</section>

<!-- ══ PRACTICE AREAS ══ -->
<section class="services-section" id="services">
  <div class="container">
    <div class="services-header">
      <div>
        <div class="section-label">Practice Areas</div>
        <h2 class="section-title">Expert Legal <span>Services</span></h2>
        <p class="section-subtitle">Comprehensive legal representation across criminal, civil, family, and corporate matters in Pune and Maharashtra.</p>
      </div>
      <a href="<?php echo esc_url( home_url( '/practice-areas' ) ); ?>" class="btn btn-outline-navy" style="flex-shrink:0;">
        All Practice Areas <i class="fa-solid fa-arrow-right"></i>
      </a>
    </div>

    <div class="services-grid">
      <?php
      // Try to load from CPT first; fallback to static cards
      $pa_query = new WP_Query( [
          'post_type'      => 'practice_area',
          'posts_per_page' => 6,
          'meta_key'       => 'akc_pa_tier',
          'orderby'        => 'meta_value_num',
          'order'          => 'ASC',
          'post_status'    => 'publish',
      ] );

      if ( $pa_query->have_posts() ) :
          $delay_classes = [ '', 'delay-1', 'delay-2', 'delay-1', 'delay-2', 'delay-3' ];
          $i = 0;
          while ( $pa_query->have_posts() ) :
              $pa_query->the_post();
              $icon    = get_post_meta( get_the_ID(), 'akc_pa_icon', true ) ?: 'fa-solid fa-gavel';
              $summary = get_post_meta( get_the_ID(), 'akc_pa_summary', true );
              $dc      = $delay_classes[ $i % 6 ];
              ?>
              <a href="<?php the_permalink(); ?>" class="service-card reveal <?php echo esc_attr( $dc ); ?>">
                <div class="service-icon"><i class="<?php echo esc_attr( $icon ); ?>"></i></div>
                <h3><?php the_title(); ?></h3>
                <p><?php echo esc_html( $summary ?: get_the_excerpt() ); ?></p>
                <span class="service-arrow">Learn More <i class="fa-solid fa-arrow-right"></i></span>
              </a>
              <?php
              $i++;
          endwhile;
          wp_reset_postdata();
      else :
          // Static fallback cards
          $services = [
              [ 'icon' => 'fa-gavel',            'title' => 'Criminal Law &amp; Defence',     'desc' => 'Comprehensive criminal defence from FIR registration to High Court appeals. Strong representation at every stage.',           'tags' => ['Bail &amp; Anticipatory Bail', 'FIR Quashing', 'Sessions Court'],       'anchor' => 'criminal', 'delay' => '' ],
              [ 'icon' => 'fa-shield-halved',     'title' => 'Cyber &amp; IT Law',              'desc' => 'Defence in cybercrime cases, IT Act violations, online fraud, digital evidence handling, and data privacy matters.',         'tags' => ['Cybercrime Defence', 'IT Act', 'Online Fraud'],                          'anchor' => 'cyber',    'delay' => 'delay-1' ],
              [ 'icon' => 'fa-house-heart',       'title' => 'Family &amp; Matrimonial Law',   'desc' => 'Sensitive handling of divorce, custody, maintenance, domestic violence and matrimonial property disputes.',                 'tags' => ['Divorce', 'Child Custody', '498A Defence'],                              'anchor' => 'family',   'delay' => 'delay-2' ],
              [ 'icon' => 'fa-building-columns',  'title' => 'Corporate Legal Advisory',       'desc' => 'End-to-end corporate legal support — contracts, compliance, disputes, and business protection strategies.',                 'tags' => ['Contract Drafting', 'Compliance', 'Business Disputes'],                 'anchor' => 'corporate','delay' => 'delay-1' ],
              [ 'icon' => 'fa-lightbulb',         'title' => 'Intellectual Property',          'desc' => 'Protection of trademarks, copyrights, patents, and trade secrets. IP enforcement and infringement defence.',               'tags' => ['Trademark', 'Copyright', 'Patent'],                                     'anchor' => 'ip',       'delay' => 'delay-2' ],
              [ 'icon' => 'fa-users-shield',      'title' => 'POSH &amp; Workplace Law',       'desc' => 'Advisory on POSH Act compliance, ICC formation, complaint handling, and workplace harassment investigations.',              'tags' => ['POSH Compliance', 'ICC Advisory', 'HR Legal'],                          'anchor' => 'posh',     'delay' => 'delay-3' ],
          ];
          foreach ( $services as $svc ) :
          ?>
          <a href="<?php echo esc_url( home_url( '/practice-areas/#' . $svc['anchor'] ) ); ?>" class="service-card reveal <?php echo esc_attr( $svc['delay'] ); ?>">
            <div class="service-icon"><i class="fa-solid <?php echo esc_attr( $svc['icon'] ); ?>"></i></div>
            <h3><?php echo $svc['title']; ?></h3>
            <p><?php echo $svc['desc']; ?></p>
            <div class="service-tags">
              <?php foreach ( $svc['tags'] as $tag ) : ?>
                <span class="service-tag"><?php echo $tag; ?></span>
              <?php endforeach; ?>
            </div>
            <span class="service-arrow">Learn More <i class="fa-solid fa-arrow-right"></i></span>
          </a>
          <?php endforeach;
      endif; ?>
    </div>
  </div>
</section>

<!-- ══ WHY CHOOSE ══ -->
<section class="why-section section-white">
  <div class="container">
    <div class="why-grid">
      <div class="why-visual reveal-left">
        <div style="width:100%; height:500px; background:linear-gradient(135deg, #0d1b3e 0%, #1a2f5a 100%); border-radius:16px; display:flex; align-items:center; justify-content:center;">
          <div style="text-align:center; padding:2rem;">
            <i class="fa-solid fa-scale-balanced" style="font-size:5rem; color:rgba(201,160,48,0.4);"></i>
            <p style="color:rgba(255,255,255,0.2); font-size:0.75rem; margin-top:1.5rem;">Justice. Integrity. Excellence.</p>
          </div>
        </div>
        <div class="why-quote-card">
          <div class="quote-text">"The strength of a lawyer lies not only in knowing the law, but in knowing when to fight and when to counsel."</div>
          <div class="quote-author">— Adv. Akash R. Chikate</div>
        </div>
      </div>

      <div class="reveal-right">
        <div class="section-label">Why Choose Me</div>
        <h2 class="section-title">Your Case Deserves <span>The Best Defence</span></h2>
        <p class="section-subtitle">Every client receives my personal attention, honest assessment, and relentless advocacy — not just a case number.</p>

        <div class="why-features">
          <div class="why-feature">
            <div class="why-feature-icon"><i class="fa-solid fa-user-tie"></i></div>
            <div>
              <h4>Personal Attention to Every Case</h4>
              <p>You deal directly with me — not a junior. Your case gets the focus it deserves at every stage.</p>
            </div>
          </div>
          <div class="why-feature">
            <div class="why-feature-icon"><i class="fa-solid fa-clock"></i></div>
            <div>
              <h4>Available When It Matters Most</h4>
              <p>Legal emergencies don't follow office hours. I'm reachable when you need me most, including bail emergencies.</p>
            </div>
          </div>
          <div class="why-feature">
            <div class="why-feature-icon"><i class="fa-solid fa-comments"></i></div>
            <div>
              <h4>Honest, Clear Communication</h4>
              <p>No legal jargon, no false promises. I give you straight answers about your case and realistic expectations.</p>
            </div>
          </div>
          <div class="why-feature">
            <div class="why-feature-icon"><i class="fa-solid fa-lock"></i></div>
            <div>
              <h4>Complete Confidentiality</h4>
              <p>Everything shared with me stays strictly confidential. Your trust is the foundation of our relationship.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ══ 4-STEP PROCESS ══ -->
<section class="process-section" id="process">
  <div class="container">
    <div class="process-header">
      <div class="section-label" style="color:var(--gold);">How It Works</div>
      <h2 class="section-title" style="color:var(--white);">Simple 4-Step <span>Legal Process</span></h2>
      <p class="section-subtitle" style="color:rgba(255,255,255,0.5);">Getting the right legal help should be straightforward. Here's how we work together.</p>
    </div>

    <div class="process-steps">
      <div class="process-step reveal">
        <div class="step-num"><span>01</span></div>
        <h4>Free Consultation</h4>
        <p>Share your situation in a confidential, no-obligation consultation. Online, phone, or in-person at my Pune office.</p>
      </div>
      <div class="process-step reveal delay-1">
        <div class="step-num"><span>02</span></div>
        <h4>Case Assessment</h4>
        <p>I review your case in detail, explain your legal position honestly, and outline the best strategy going forward.</p>
      </div>
      <div class="process-step reveal delay-2">
        <div class="step-num"><span>03</span></div>
        <h4>Legal Strategy</h4>
        <p>A customised legal plan is crafted for your specific case — from court filings to negotiation and representation.</p>
      </div>
      <div class="process-step reveal delay-3">
        <div class="step-num"><span>04</span></div>
        <h4>Vigorous Representation</h4>
        <p>I fight for your rights with full commitment — in court, in negotiations, and at every step of the legal process.</p>
      </div>
    </div>
  </div>
</section>

<!-- ══ TESTIMONIALS ══ -->
<section class="testimonials-section" id="testimonials">
  <div class="container">
    <div class="testimonials-header">
      <div class="section-label">Client Testimonials</div>
      <h2 class="section-title">Trusted by Clients <span>Across Pune</span></h2>
      <p class="section-subtitle" style="margin:0 auto;">Real experiences from individuals and families who trusted me with their most critical legal matters.</p>
    </div>

    <div class="testimonials-grid">
      <div class="testimonial-card reveal">
        <div class="testimonial-stars">
          <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
        </div>
        <p class="testimonial-text">"Advocate Akash secured my anticipatory bail within 24 hours when my family was in complete panic. His clarity, speed, and professionalism in the Sessions Court was remarkable. I will always be grateful."</p>
        <div class="testimonial-author">
          <div class="author-avatar">R</div>
          <div>
            <span class="author-name">Rahul M.</span>
            <span class="author-case">Anticipatory Bail · Pune Sessions Court</span>
          </div>
        </div>
      </div>

      <div class="testimonial-card reveal delay-1">
        <div class="testimonial-stars">
          <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
        </div>
        <p class="testimonial-text">"I was falsely accused under Section 498A and was devastated. Adv. Akash handled my case with exceptional skill and got me discharged. He was always available, always honest, and never let me lose hope."</p>
        <div class="testimonial-author">
          <div class="author-avatar">S</div>
          <div>
            <span class="author-name">Sanjay P.</span>
            <span class="author-case">498A Defence · Sessions Court, Pune</span>
          </div>
        </div>
      </div>

      <div class="testimonial-card reveal delay-2">
        <div class="testimonial-stars">
          <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
        </div>
        <p class="testimonial-text">"Our company faced a serious cybercrime complaint and we had no idea how to handle it. Adv. Akash's knowledge of the IT Act and cyber law was exceptional. He resolved the matter efficiently and professionally."</p>
        <div class="testimonial-author">
          <div class="author-avatar">P</div>
          <div>
            <span class="author-name">Priya Technologies Ltd.</span>
            <span class="author-case">Cybercrime Matter · Pune</span>
          </div>
        </div>
      </div>
    </div>

    <div style="text-align:center; margin-top:3rem;">
      <div style="display:inline-flex; align-items:center; gap:12px; background:var(--white); border:1px solid var(--gray-200); padding:14px 28px; border-radius:50px; box-shadow:var(--shadow-sm);">
        <i class="fa-brands fa-google" style="color:#4285f4; font-size:1.2rem;"></i>
        <div class="testimonial-stars" style="margin:0;">
          <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
        </div>
        <span style="font-size:0.88rem; font-weight:600; color:var(--navy);">4.9 on Google Reviews</span>
      </div>
    </div>
  </div>
</section>

<!-- ══ LATEST BLOG POSTS ══ -->
<section class="blog-section section-white">
  <div class="container">
    <div class="blog-header">
      <div>
        <div class="section-label">Legal Insights</div>
        <h2 class="section-title">Know Your <span>Legal Rights</span></h2>
        <p class="section-subtitle">Practical legal knowledge to help you understand your rights and options.</p>
      </div>
      <a href="<?php echo esc_url( home_url( '/blog' ) ); ?>" class="btn btn-outline-navy" style="flex-shrink:0;">
        All Articles <i class="fa-solid fa-arrow-right"></i>
      </a>
    </div>

    <div class="blog-grid">
      <?php
      $blog_query = new WP_Query( [
          'post_type'      => 'post',
          'posts_per_page' => 3,
          'post_status'    => 'publish',
          'orderby'        => 'date',
          'order'          => 'DESC',
      ] );
      $icons       = [ 'fa-gavel', 'fa-shield-halved', 'fa-wifi' ];
      $delay_cls   = [ '', 'delay-1', 'delay-2' ];
      $idx = 0;

      if ( $blog_query->have_posts() ) :
          while ( $blog_query->have_posts() ) :
              $blog_query->the_post();
              $cat = get_the_category();
              $cat_name = $cat ? $cat[0]->name : 'Legal';
              $dc  = $delay_cls[ $idx % 3 ];
              $ico = $icons[ $idx % 3 ];
              ?>
              <a href="<?php the_permalink(); ?>" class="blog-card reveal <?php echo esc_attr( $dc ); ?>">
                <div class="blog-img-wrap">
                  <?php if ( has_post_thumbnail() ) : ?>
                    <?php the_post_thumbnail( 'medium', [ 'style' => 'width:100%;height:100%;object-fit:cover;' ] ); ?>
                  <?php else : ?>
                    <div style="width:100%; height:100%; background:linear-gradient(135deg,#0d1b3e,#1a2f5a); display:flex; align-items:center; justify-content:center;">
                      <i class="fa-solid <?php echo esc_attr( $ico ); ?>" style="font-size:3rem; color:rgba(201,160,48,0.4);"></i>
                    </div>
                  <?php endif; ?>
                  <span class="blog-category"><?php echo esc_html( $cat_name ); ?></span>
                </div>
                <div class="blog-body">
                  <div class="blog-meta">
                    <span><i class="fa-regular fa-calendar"></i> <?php echo get_the_date( 'M j, Y' ); ?></span>
                    <span><i class="fa-regular fa-clock"></i> <?php echo ceil( str_word_count( get_the_content() ) / 200 ); ?> min read</span>
                  </div>
                  <h3><?php the_title(); ?></h3>
                  <p><?php echo wp_trim_words( get_the_excerpt(), 18 ); ?></p>
                  <span class="blog-read-more">Read Article <i class="fa-solid fa-arrow-right"></i></span>
                </div>
              </a>
              <?php
              $idx++;
          endwhile;
          wp_reset_postdata();
      else :
          // Static fallback if no posts yet
          $static_posts = [
              [ 'cat' => 'Criminal Law', 'date' => 'Nov 17, 2025', 'icon' => 'fa-gavel',
                'title' => 'What To Do Immediately After an FIR is Filed Against You in Pune',
                'desc' => 'An FIR doesn\'t mean conviction. Here\'s your step-by-step action guide if you or a family member faces an FIR in Maharashtra.',
                'delay' => '' ],
              [ 'cat' => 'Bail Law', 'date' => 'Nov 15, 2025', 'icon' => 'fa-shield-halved',
                'title' => 'Anticipatory Bail vs Regular Bail: What\'s the Difference and When Do You Need It?',
                'desc' => 'A plain-language breakdown of the difference between anticipatory bail (S.482 BNSS) and regular bail (S.483 BNSS) under Indian law.',
                'delay' => 'delay-1' ],
              [ 'cat' => 'Cyber Law', 'date' => 'Nov 10, 2025', 'icon' => 'fa-wifi',
                'title' => 'Cybercrime in India: Your Rights, the Law, and How to Defend Yourself',
                'desc' => 'Everything you need to know about cybercrime allegations in India — what the IT Act says, your defence options, and when to call a lawyer.',
                'delay' => 'delay-2' ],
          ];
          foreach ( $static_posts as $p ) :
          ?>
          <a href="<?php echo esc_url( home_url( '/blog' ) ); ?>" class="blog-card reveal <?php echo esc_attr( $p['delay'] ); ?>">
            <div class="blog-img-wrap">
              <div style="width:100%; height:100%; background:linear-gradient(135deg,#0d1b3e,#1a2f5a); display:flex; align-items:center; justify-content:center;">
                <i class="fa-solid <?php echo esc_attr( $p['icon'] ); ?>" style="font-size:3rem; color:rgba(201,160,48,0.4);"></i>
              </div>
              <span class="blog-category"><?php echo esc_html( $p['cat'] ); ?></span>
            </div>
            <div class="blog-body">
              <div class="blog-meta">
                <span><i class="fa-regular fa-calendar"></i> <?php echo esc_html( $p['date'] ); ?></span>
                <span><i class="fa-regular fa-clock"></i> 5 min read</span>
              </div>
              <h3><?php echo esc_html( $p['title'] ); ?></h3>
              <p><?php echo esc_html( $p['desc'] ); ?></p>
              <span class="blog-read-more">Read Article <i class="fa-solid fa-arrow-right"></i></span>
            </div>
          </a>
          <?php endforeach;
      endif; ?>
    </div>
  </div>
</section>

<!-- ══ CTA + CONSULTATION FORM ══ -->
<section class="cta-section" id="consultation">
  <div class="container">
    <div class="cta-inner">
      <div class="cta-content reveal-left">
        <div class="section-label" style="color:var(--gold);">Free Consultation</div>
        <h2>Don't Face the <em>Legal System</em> Alone.</h2>
        <p>Every legal matter has a solution. Get a free, confidential consultation and understand your options — with no pressure and no obligations.</p>

        <div class="cta-features">
          <div class="cta-feature"><i class="fa-solid fa-check-circle"></i> 100% Confidential Consultation</div>
          <div class="cta-feature"><i class="fa-solid fa-check-circle"></i> No Obligation — Just Honest Advice</div>
          <div class="cta-feature"><i class="fa-solid fa-check-circle"></i> Available for Bail Emergencies 24/7</div>
          <div class="cta-feature"><i class="fa-solid fa-check-circle"></i> WhatsApp, Phone, or In-Person</div>
        </div>

        <div style="margin-top:2rem; display:flex; gap:1rem; flex-wrap:wrap;">
          <a href="<?php echo esc_url( akc_wa_link() ); ?>" class="btn btn-primary" target="_blank" rel="noopener">
            <i class="fa-brands fa-whatsapp"></i> WhatsApp Now
          </a>
          <a href="<?php echo esc_url( akc_phone_link() ); ?>" class="btn btn-outline">
            <i class="fa-solid fa-phone"></i> <?php echo esc_html( AKC_PHONE_DISPLAY ); ?>
          </a>
        </div>
      </div>

      <div class="cta-form reveal-right">
        <h3>Book Your Consultation</h3>
        <p class="form-sub">Fill the form below — we'll call you back within 2 hours.</p>

        <?php
        // Contact Form 7 integration
        if ( function_exists( 'wpcf7_contact_form' ) ) :
            echo do_shortcode( '[contact-form-7 id="3acb990" title="Consultation Form"]' );
        else :
        ?>
        <form class="consult-form" autocomplete="off" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
          <?php wp_nonce_field( 'akc_consultation_form', 'akc_form_nonce' ); ?>
          <input type="hidden" name="action" value="akc_consultation_submit">
          <div class="form-row">
            <div class="form-group">
              <label>Full Name</label>
              <input type="text" name="akc_name" placeholder="Your full name" required>
            </div>
            <div class="form-group">
              <label>Phone Number</label>
              <input type="tel" name="akc_phone" placeholder="+91 XXXXX XXXXX" required>
            </div>
          </div>
          <div class="form-group">
            <label>Legal Matter</label>
            <select name="akc_matter">
              <option value="">Select type of matter...</option>
              <option>Criminal Defence / Bail</option>
              <option>Anticipatory Bail</option>
              <option>FIR Quashing</option>
              <option>Cybercrime</option>
              <option>Divorce / Family Law</option>
              <option>Corporate / Business</option>
              <option>Intellectual Property</option>
              <option>POSH / Workplace</option>
              <option>Other</option>
            </select>
          </div>
          <div class="form-group">
            <label>Brief Description</label>
            <textarea name="akc_message" placeholder="Briefly describe your situation (kept strictly confidential)..." rows="3"></textarea>
          </div>
          <button type="submit" class="btn btn-primary w-full">
            <i class="fa-solid fa-paper-plane"></i> Submit — We'll Call You Back
          </button>
          <p class="form-disclaimer"><i class="fa-solid fa-lock"></i> Your information is strictly confidential and protected by attorney-client privilege.</p>
        </form>
        <div class="form-success" style="display:none;">
          <i class="fa-solid fa-circle-check"></i>
          <h4>Message Received!</h4>
          <p style="color:var(--gray-600); font-size:0.9rem;">We'll call you back within 2 hours. For urgent matters, WhatsApp us directly.</p>
        </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>

<?php get_footer(); ?>
