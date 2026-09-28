<?php
/**
 * About Page Template
 * Template Name: About Page
 */
get_header();
?>

<!-- Page Hero -->
<section class="page-hero">
  <div class="page-hero-grid"></div>
  <div class="container">
    <div class="page-hero-content">
      <nav class="breadcrumb" aria-label="Breadcrumb">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
        <span class="sep"><i class="fa-solid fa-chevron-right"></i></span>
        <span class="current">About</span>
      </nav>
      <h1>About <span>Advocate Akash</span><br>R. Chikate</h1>
      <p class="page-desc">Criminal defence attorney in Pune with 8+ years of practice at Bombay High Court. Dedicated to justice, honesty, and results.</p>
    </div>
  </div>
</section>

<!-- MAIN ABOUT SECTION -->
<section class="section-py section-white">
  <div class="container">
    <div class="grid-2">
      <div class="reveal-left">
        <div style="position:relative;">
          <div style="width:100%; height:520px; background:linear-gradient(135deg,#0d1b3e,#1a2f5a); border-radius:16px; display:flex; align-items:center; justify-content:center;">
            <?php
            $photo = get_option( 'akc_about_photo' ) ?: get_option( 'akc_advocate_photo' );
            if ( $photo ) :
            ?>
              <img src="<?php echo esc_url( $photo ); ?>" alt="Advocate Akash R. Chikate — Criminal Defence Lawyer in his Law Office, Pune" style="width:100%; height:520px; object-fit:cover; border-radius:16px;">
            <?php else : ?>
              <div style="text-align:center;">
                <i class="fa-solid fa-user-tie" style="font-size:6rem; color:rgba(201,160,48,0.35);"></i>
                <p style="color:rgba(255,255,255,0.1); margin-top:1rem; font-size:0.7rem; letter-spacing:0.05em; text-transform:uppercase;">Adv. Akash R. Chikate</p>
              </div>
            <?php endif; ?>
          </div>
          <div style="position:absolute; bottom:-20px; left:50%; transform:translateX(-50%); background:var(--gold); padding:16px 32px; border-radius:8px; text-align:center; white-space:nowrap; box-shadow:0 8px 24px rgba(201,160,48,0.4);">
            <div style="font-family:var(--font-serif); font-size:2rem; font-weight:800; color:var(--navy-dark); line-height:1;">8+</div>
            <div style="font-size:0.65rem; font-weight:700; letter-spacing:0.15em; text-transform:uppercase; color:var(--navy-dark);">Years of Legal Practice</div>
          </div>
        </div>
      </div>

      <div class="reveal-right" style="padding-top:1rem;">
        <div class="section-label">My Story</div>
        <h2 class="section-title">Akash R. <span>Chikate</span><br>Criminal Defence Attorney</h2>

        <p style="font-size:1.05rem; color:var(--gray-600); line-height:1.8; margin-bottom:1.25rem;">
          I am Advocate Akash R. Chikate, a criminal defence attorney enrolled at the Bombay High Court and practicing before the District &amp; Sessions Court, Family Court, and Consumer Court in Pune. Over the course of 8+ years, I have represented individuals, families, and businesses in matters ranging from bail applications and FIR quashing to cybercrime defence, divorce proceedings, and corporate legal disputes.
        </p>
        <p style="font-size:1.05rem; color:var(--gray-600); line-height:1.8; margin-bottom:2rem;">
          My approach to law is rooted in three principles: <strong style="color:var(--navy);">Honesty</strong> — I give you the real picture of your case from day one. <strong style="color:var(--navy);">Clarity</strong> — I explain the law in plain language so you always know where you stand. <strong style="color:var(--navy);">Commitment</strong> — I fight for your rights with everything I have, in court and beyond.
        </p>

        <div class="about-stats-grid" style="display:grid; grid-template-columns:repeat(3,1fr); gap:1rem; margin-bottom:2rem;">
          <div style="text-align:center; padding:20px; background:var(--cream); border-radius:8px;">
            <div style="font-family:var(--font-serif); font-size:2.2rem; font-weight:800; color:var(--navy);">99<span style="color:var(--gold);">+</span></div>
            <div style="font-size:0.72rem; letter-spacing:0.1em; text-transform:uppercase; color:var(--gray-400); font-weight:600;">Cases</div>
          </div>
          <div style="text-align:center; padding:20px; background:var(--cream); border-radius:8px;">
            <div style="font-family:var(--font-serif); font-size:2.2rem; font-weight:800; color:var(--navy);">5</div>
            <div style="font-size:0.72rem; letter-spacing:0.1em; text-transform:uppercase; color:var(--gray-400); font-weight:600;">Courts</div>
          </div>
          <div style="text-align:center; padding:20px; background:var(--cream); border-radius:8px;">
            <div style="font-family:var(--font-serif); font-size:2.2rem; font-weight:800; color:var(--navy);">10<span style="color:var(--gold);">+</span></div>
            <div style="font-size:0.72rem; letter-spacing:0.1em; text-transform:uppercase; color:var(--gray-400); font-weight:600;">Awards</div>
          </div>
        </div>

        <div style="display:flex; gap:1rem; flex-wrap:wrap;">
          <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn btn-primary"><i class="fa-regular fa-calendar"></i> Book Free Consultation</a>
          <a href="<?php echo esc_url( home_url( '/practice-areas' ) ); ?>" class="btn btn-outline-navy"><i class="fa-solid fa-arrow-right"></i> View Practice Areas</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- CREDENTIALS SECTION -->
<section class="section-py section-cream">
  <div class="container">
    <div style="text-align:center; max-width:700px; margin:0 auto 3rem;">
      <div class="section-label">Qualifications</div>
      <h2 class="section-title">Education &amp; <span>Credentials</span></h2>
    </div>
    <div class="grid-3">
      <div class="reveal" style="background:var(--white); border-radius:16px; padding:32px; border:1px solid var(--gray-200);">
        <div style="width:48px; height:48px; background:var(--navy); border-radius:50%; display:flex; align-items:center; justify-content:center; margin-bottom:1rem;">
          <i class="fa-solid fa-graduation-cap" style="color:var(--gold);"></i>
        </div>
        <h4 style="color:var(--navy); margin-bottom:0.5rem;">LLM — Science &amp; Technology Laws</h4>
        <p style="font-size:0.88rem; color:var(--gray-600);">First Class Distinction — SCLC/SPPU Pune</p>
      </div>
      <div class="reveal delay-1" style="background:var(--white); border-radius:16px; padding:32px; border:1px solid var(--gray-200);">
        <div style="width:48px; height:48px; background:var(--navy); border-radius:50%; display:flex; align-items:center; justify-content:center; margin-bottom:1rem;">
          <i class="fa-solid fa-laptop-code" style="color:var(--gold);"></i>
        </div>
        <h4 style="color:var(--navy); margin-bottom:0.5rem;">Diploma in Cyber Laws</h4>
        <p style="font-size:0.88rem; color:var(--gray-600);">Specialization in IT Act, digital evidence &amp; cybercrime</p>
      </div>
      <div class="reveal delay-2" style="background:var(--white); border-radius:16px; padding:32px; border:1px solid var(--gray-200);">
        <div style="width:48px; height:48px; background:var(--navy); border-radius:50%; display:flex; align-items:center; justify-content:center; margin-bottom:1rem;">
          <i class="fa-solid fa-scale-balanced" style="color:var(--gold);"></i>
        </div>
        <h4 style="color:var(--navy); margin-bottom:0.5rem;">Bar Council of India</h4>
        <p style="font-size:0.88rem; color:var(--gray-600);">Licensed Advocate — Bar Council of Maharashtra &amp; Goa</p>
      </div>
    </div>

    <div style="margin-top:2rem;" class="grid-3">
      <div class="reveal" style="background:var(--white); border-radius:16px; padding:32px; border:1px solid var(--gray-200);">
        <div style="width:48px; height:48px; background:var(--navy); border-radius:50%; display:flex; align-items:center; justify-content:center; margin-bottom:1rem;">
          <i class="fa-solid fa-pills" style="color:var(--gold);"></i>
        </div>
        <h4 style="color:var(--navy); margin-bottom:0.5rem;">Legal Advisor — Chemist Association</h4>
        <p style="font-size:0.88rem; color:var(--gray-600);">Official Legal Advisor, Chemist Association Pune</p>
      </div>
      <div class="reveal delay-1" style="background:var(--white); border-radius:16px; padding:32px; border:1px solid var(--gray-200);">
        <div style="width:48px; height:48px; background:var(--navy); border-radius:50%; display:flex; align-items:center; justify-content:center; margin-bottom:1rem;">
          <i class="fa-solid fa-landmark" style="color:var(--gold);"></i>
        </div>
        <h4 style="color:var(--navy); margin-bottom:0.5rem;">27+ Bombay High Court Orders</h4>
        <p style="font-size:0.88rem; color:var(--gray-600);">Published on Indian Kanoon — verifiable HC orders</p>
      </div>
      <div class="reveal delay-2" style="background:var(--white); border-radius:16px; padding:32px; border:1px solid var(--gray-200);">
        <div style="width:48px; height:48px; background:var(--navy); border-radius:50%; display:flex; align-items:center; justify-content:center; margin-bottom:1rem;">
          <i class="fa-solid fa-user-tie" style="color:var(--gold);"></i>
        </div>
        <h4 style="color:var(--navy); margin-bottom:0.5rem;">10+ HC Judges Appeared Before</h4>
        <p style="font-size:0.88rem; color:var(--gray-600);">Wide experience across Bombay High Court benches</p>
      </div>
    </div>
  </div>
</section>

<!-- PHILOSOPHY SECTION -->
<section class="section-py section-white">
  <div class="container">
    <div style="text-align:center; max-width:700px; margin:0 auto 4rem;">
      <div class="section-label">My Philosophy</div>
      <h2 class="section-title">Vision, Mission &amp; <span>Values</span></h2>
      <p class="section-subtitle" style="margin:0 auto;">The guiding principles that define how I serve each client who trusts me with their case.</p>
    </div>

    <div class="grid-3">
      <div class="reveal" style="background:var(--white); border-radius:16px; padding:40px 32px; border:1px solid var(--gray-200); text-align:center;">
        <div style="width:64px; height:64px; background:var(--navy); border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto 1.5rem;">
          <i class="fa-solid fa-eye" style="color:var(--gold); font-size:1.3rem;"></i>
        </div>
        <h3 style="font-size:1.3rem; color:var(--navy); margin-bottom:0.75rem;">My Vision</h3>
        <p>To be the most trusted criminal defence attorney in Pune — known for unwavering integrity, exceptional courtroom skills, and genuine care for every client I represent.</p>
      </div>

      <div class="reveal delay-1" style="background:var(--navy); border-radius:16px; padding:40px 32px; text-align:center;">
        <div style="width:64px; height:64px; background:rgba(201,160,48,0.15); border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto 1.5rem;">
          <i class="fa-solid fa-bullseye" style="color:var(--gold); font-size:1.3rem;"></i>
        </div>
        <h3 style="font-size:1.3rem; color:var(--white); margin-bottom:0.75rem;">My Mission</h3>
        <p style="color:rgba(255,255,255,0.6);">To provide fearless, ethical legal representation that protects the rights and dignity of every individual — regardless of the complexity or sensitivity of the matter.</p>
      </div>

      <div class="reveal delay-2" style="background:var(--white); border-radius:16px; padding:40px 32px; border:1px solid var(--gray-200); text-align:center;">
        <div style="width:64px; height:64px; background:var(--navy); border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto 1.5rem;">
          <i class="fa-solid fa-heart" style="color:var(--gold); font-size:1.3rem;"></i>
        </div>
        <h3 style="font-size:1.3rem; color:var(--navy); margin-bottom:0.75rem;">My Commitment</h3>
        <p>Every client receives my direct attention, honest counsel, and complete confidentiality. I am accessible when you need me — not just during court hours.</p>
      </div>
    </div>
  </div>
</section>

<!-- EDUCATION & CAREER TIMELINE -->
<section class="section-py section-cream">
  <div class="container">
    <div class="grid-2" style="gap:5rem; align-items:start;">
      <div class="reveal-left">
        <div class="section-label">Education &amp; Career</div>
        <h2 class="section-title">Professional <span>Journey</span></h2>
        <p class="section-subtitle" style="margin-bottom:3rem;">A foundation built on rigorous legal education and years of active courtroom practice.</p>

        <div class="timeline">
          <div class="timeline-item">
            <div class="timeline-year">2025 – Present</div>
            <h4>Senior Criminal Defence Advocate — Bombay High Court</h4>
            <p>Practicing in complex criminal matters including bail at HC level, FIR quashing, criminal appeals, and writ petitions.</p>
          </div>
          <div class="timeline-item">
            <div class="timeline-year">2020 – Present</div>
            <h4>Cyber Law &amp; IT Act Specialist</h4>
            <p>Advising individuals and corporates on IT Act violations, cybercrime FIRs, digital evidence challenges, and data privacy matters.</p>
          </div>
          <div class="timeline-item">
            <div class="timeline-year">2017 – 2020</div>
            <h4>Advocate — District &amp; Sessions Court, Pune</h4>
            <p>Criminal defence, bail applications, matrimonial disputes, and consumer court matters across Pune jurisdiction.</p>
          </div>
          <div class="timeline-item">
            <div class="timeline-year">2016 – 2017</div>
            <h4>Enrolled at Bar Council of Maharashtra &amp; Goa</h4>
            <p>Commenced independent legal practice after completing law degree and bar examination.</p>
          </div>
          <div class="timeline-item">
            <div class="timeline-year">2013 – 2016</div>
            <h4>LL.B. — Law Graduate</h4>
            <p>Completed three-year LL.B. programme with a focus on criminal law, civil procedure, and constitutional law.</p>
          </div>
        </div>
      </div>

      <div class="reveal-right">
        <div class="section-label">Courts &amp; Jurisdictions</div>
        <h2 class="section-title">Where I <span>Practice</span></h2>
        <p style="color:var(--gray-600); margin-bottom:2.5rem;">Active representation across multiple courts in Pune and Maharashtra.</p>

        <div style="display:flex; flex-direction:column; gap:1rem; margin-bottom:3rem;">
          <div class="why-feature">
            <div class="why-feature-icon"><i class="fa-solid fa-landmark"></i></div>
            <div>
              <h4>Bombay High Court</h4>
              <p>Bail, anticipatory bail, FIR quashing writs, criminal appeals, revision petitions.</p>
            </div>
          </div>
          <div class="why-feature">
            <div class="why-feature-icon"><i class="fa-solid fa-gavel"></i></div>
            <div>
              <h4>District &amp; Sessions Court, Pune</h4>
              <p>Sessions trial, bail applications, criminal defence, serious offences including NDPS, POCSO.</p>
            </div>
          </div>
          <div class="why-feature">
            <div class="why-feature-icon"><i class="fa-solid fa-heart"></i></div>
            <div>
              <h4>Family Court, Pune</h4>
              <p>Divorce petitions, child custody, maintenance, domestic violence cases, matrimonial disputes.</p>
            </div>
          </div>
          <div class="why-feature">
            <div class="why-feature-icon"><i class="fa-solid fa-users"></i></div>
            <div>
              <h4>Consumer Court &amp; JMFC</h4>
              <p>Consumer complaints, cheque bounce (NI Act S.138), summary trials, and Magistrate-level matters.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- CTA -->
<section style="background:var(--navy); padding:80px 0;">
  <div class="container" style="text-align:center; max-width:680px;">
    <div class="section-label">Start Today</div>
    <h2 style="color:var(--white); margin-bottom:1rem;">Ready to Discuss <em style="color:var(--gold);">Your Case?</em></h2>
    <p style="color:rgba(255,255,255,0.55); font-size:1.05rem; margin-bottom:2.5rem;">Book a free, confidential consultation. I'll give you an honest assessment and clear guidance — no obligations.</p>
    <div style="display:flex; gap:1rem; justify-content:center; flex-wrap:wrap;">
      <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn btn-primary btn-lg"><i class="fa-regular fa-calendar-check"></i> Book Free Consultation</a>
      <a href="<?php echo esc_url( akc_wa_link() ); ?>" class="btn btn-outline btn-lg" target="_blank" rel="noopener"><i class="fa-brands fa-whatsapp"></i> WhatsApp Now</a>
    </div>
  </div>
</section>

<?php get_footer(); ?>
