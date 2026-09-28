<?php
/**
 * Contact Page Template
 * Template Name: Contact Page
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
        <span class="current">Contact</span>
      </nav>
      <h1>Get in <span>Touch</span></h1>
      <p class="page-desc">Book a free, confidential consultation. Available for emergencies including bail matters. Call, WhatsApp, or fill the form — we respond within 2 hours.</p>
    </div>
  </div>
</section>

<!-- QUICK CONTACT STRIP -->
<div style="background:var(--gold); padding:20px 0;">
  <div class="container">
    <div style="display:flex; align-items:center; justify-content:center; gap:3rem; flex-wrap:wrap;">
      <a href="<?php echo esc_url( akc_phone_link() ); ?>" style="display:flex; align-items:center; gap:10px; color:var(--navy-dark); font-weight:700; font-size:1rem;">
        <i class="fa-solid fa-phone"></i> <?php echo esc_html( AKC_PHONE_DISPLAY ); ?>
      </a>
      <span style="width:1px; height:24px; background:rgba(0,0,0,0.15);"></span>
      <a href="<?php echo esc_url( akc_wa_link() ); ?>" target="_blank" rel="noopener" style="display:flex; align-items:center; gap:10px; color:var(--navy-dark); font-weight:700; font-size:1rem;">
        <i class="fa-brands fa-whatsapp"></i> WhatsApp Now
      </a>
      <span style="width:1px; height:24px; background:rgba(0,0,0,0.15);"></span>
      <a href="mailto:<?php echo esc_attr( AKC_EMAIL ); ?>" style="display:flex; align-items:center; gap:10px; color:var(--navy-dark); font-weight:700; font-size:1rem;">
        <i class="fa-solid fa-envelope"></i> <?php echo esc_html( AKC_EMAIL ); ?>
      </a>
    </div>
  </div>
</div>

<!-- CONTACT MAIN SECTION -->
<section class="section-py section-white" id="contact">
  <div class="container">
    <div class="contact-grid">

      <!-- Left: Info -->
      <div class="reveal-left">
        <div class="section-label">Reach Out</div>
        <h2 class="section-title">Let's Discuss <span>Your Case</span></h2>
        <p style="color:var(--gray-600); font-size:0.95rem; line-height:1.8; margin-bottom:2rem;">Every legal situation is unique. Reach out for a confidential conversation — I will give you an honest assessment and clear guidance with no pressure.</p>

        <div class="contact-item">
          <div class="contact-item-icon"><i class="fa-solid fa-phone"></i></div>
          <div>
            <h5>Phone</h5>
            <a href="<?php echo esc_url( akc_phone_link() ); ?>" class="contact-link" style="color:var(--navy); font-weight:600;"><?php echo esc_html( AKC_PHONE_DISPLAY ); ?></a>
            <p style="font-size:0.78rem; color:var(--gray-400); margin-top:2px;">Monday – Saturday · 10 AM – 7 PM</p>
            <p style="font-size:0.78rem; color:var(--gold); margin-top:2px; font-weight:600;">Emergency bail matters: available 24/7</p>
          </div>
        </div>

        <div class="contact-item">
          <div class="contact-item-icon"><i class="fa-brands fa-whatsapp" style="color:#25d366;"></i></div>
          <div>
            <h5>WhatsApp</h5>
            <a href="<?php echo esc_url( akc_wa_link() ); ?>" target="_blank" rel="noopener" style="color:var(--navy); font-weight:600;"><?php echo esc_html( AKC_WHATSAPP_DISPLAY ); ?></a>
            <p style="font-size:0.78rem; color:var(--gray-400); margin-top:2px;">Preferred for quick queries &amp; emergencies</p>
          </div>
        </div>

        <div class="contact-item">
          <div class="contact-item-icon"><i class="fa-solid fa-envelope"></i></div>
          <div>
            <h5>Email</h5>
            <a href="mailto:<?php echo esc_attr( AKC_EMAIL ); ?>" style="color:var(--navy); font-weight:600;"><?php echo esc_html( AKC_EMAIL ); ?></a>
            <p style="font-size:0.78rem; color:var(--gray-400); margin-top:2px;">For detailed queries and document sharing</p>
          </div>
        </div>

        <div class="contact-item">
          <div class="contact-item-icon"><i class="fa-solid fa-location-dot"></i></div>
          <div>
            <h5>Office 1 — Shivajinagar (Primary)</h5>
            <p style="color:var(--navy); font-weight:600;">Office No. 202-203, Ekbote Complex</p>
            <p style="font-size:0.85rem; color:var(--gray-600);">Above Dr. Gajanan Ekbote Hospital,<br>Revenue Colony, Shivajinagar, Pune – 411005</p>
            <a href="https://maps.google.com/?q=Ekbote+Complex+Shivajinagar+Pune" target="_blank" rel="noopener" style="font-size:0.78rem; color:var(--gold); font-weight:600; margin-top:6px; display:inline-block;">
              <i class="fa-solid fa-map-location-dot"></i> Get Directions
            </a>
          </div>
        </div>

        <div class="contact-item">
          <div class="contact-item-icon"><i class="fa-solid fa-location-dot"></i></div>
          <div>
            <h5>Office 2 — Pimple Gurav</h5>
            <p style="color:var(--navy); font-weight:600;">Ravikaran Heights</p>
            <p style="font-size:0.85rem; color:var(--gray-600);">Shivdatta Nagar, Pimple Gurav, Pune</p>
          </div>
        </div>

        <div class="contact-item">
          <div class="contact-item-icon"><i class="fa-solid fa-clock"></i></div>
          <div>
            <h5>Office Hours</h5>
            <p style="color:var(--navy); font-weight:600;">Mon – Sat: 10:00 AM – 7:00 PM</p>
            <p style="font-size:0.78rem; color:var(--gray-400); margin-top:2px;">Sunday: By prior appointment only</p>
          </div>
        </div>

        <div style="margin-top:2rem; padding:24px; background:var(--cream); border-radius:12px;">
          <h5 style="font-size:0.72rem; font-weight:700; letter-spacing:0.15em; text-transform:uppercase; color:var(--gold); margin-bottom:1rem;">Courts Practiced In</h5>
          <div style="display:flex; flex-direction:column; gap:8px;">
            <div style="display:flex; align-items:center; gap:10px; font-size:0.88rem; color:var(--navy); font-weight:500;"><i class="fa-solid fa-landmark" style="color:var(--gold); width:16px;"></i> Bombay High Court</div>
            <div style="display:flex; align-items:center; gap:10px; font-size:0.88rem; color:var(--navy); font-weight:500;"><i class="fa-solid fa-gavel" style="color:var(--gold); width:16px;"></i> District &amp; Sessions Court, Pune</div>
            <div style="display:flex; align-items:center; gap:10px; font-size:0.88rem; color:var(--navy); font-weight:500;"><i class="fa-solid fa-heart" style="color:var(--gold); width:16px;"></i> Family Court, Pune</div>
            <div style="display:flex; align-items:center; gap:10px; font-size:0.88rem; color:var(--navy); font-weight:500;"><i class="fa-solid fa-users" style="color:var(--gold); width:16px;"></i> Consumer Court &amp; JMFC</div>
          </div>
        </div>
      </div>

      <!-- Right: Form -->
      <div class="reveal-right">
        <div class="contact-form-wrap">
          <h2 style="font-size:1.6rem; color:var(--navy); margin-bottom:0.5rem;">Book Your Free Consultation</h2>
          <p class="form-intro">Fill the form below and we'll call you back within 2 business hours. All information is completely confidential.</p>

          <?php
          if ( function_exists( 'wpcf7_contact_form' ) ) :
              echo do_shortcode( '[contact-form-7 id="3acb990" title="Consultation Form"]' );
          else :
          ?>
          <form class="contact-form consult-form" autocomplete="off" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
            <?php wp_nonce_field( 'akc_consultation_form', 'akc_form_nonce' ); ?>
            <input type="hidden" name="action" value="akc_consultation_submit">

            <div class="form-row">
              <div class="form-group">
                <label for="name">Full Name *</label>
                <input type="text" id="name" name="akc_name" placeholder="Your full name" required>
              </div>
              <div class="form-group">
                <label for="phone">Phone Number *</label>
                <input type="tel" id="phone" name="akc_phone" placeholder="+91 XXXXX XXXXX" required>
              </div>
            </div>

            <div class="form-group">
              <label for="email">Email Address</label>
              <input type="email" id="email" name="akc_email" placeholder="your@email.com">
            </div>

            <div class="form-group">
              <label for="service">Type of Legal Matter *</label>
              <select id="service" name="akc_matter" required>
                <option value="">Select legal matter...</option>
                <optgroup label="Criminal Law">
                  <option>Bail Application</option>
                  <option>Anticipatory Bail</option>
                  <option>FIR Quashing</option>
                  <option>Criminal Trial Defence</option>
                  <option>498A / Domestic Violence Defence</option>
                  <option>NDPS / Drug Offence</option>
                  <option>POCSO Matter</option>
                  <option>Cheque Bounce (NI Act)</option>
                </optgroup>
                <optgroup label="Other Areas">
                  <option>Cybercrime Defence</option>
                  <option>Divorce / Family Law</option>
                  <option>Child Custody</option>
                  <option>Corporate / Business Law</option>
                  <option>Intellectual Property</option>
                  <option>POSH Compliance</option>
                  <option>Other Legal Matter</option>
                </optgroup>
              </select>
            </div>

            <div class="form-group">
              <label for="court">Relevant Court (if known)</label>
              <select id="court" name="akc_court">
                <option value="">Select court (optional)...</option>
                <option>Bombay High Court</option>
                <option>District &amp; Sessions Court, Pune</option>
                <option>Family Court, Pune</option>
                <option>Consumer Court, Pune</option>
                <option>JMFC Court</option>
                <option>Not sure / Not yet filed</option>
              </select>
            </div>

            <div class="form-group">
              <label for="preferred">Preferred Consultation Mode</label>
              <select id="preferred" name="akc_preferred">
                <option>Phone Call</option>
                <option>WhatsApp</option>
                <option>In-Person at Office</option>
                <option>Video Call</option>
              </select>
            </div>

            <div class="form-group">
              <label for="message">Brief Description of Your Matter *</label>
              <textarea id="message" name="akc_message" rows="4" placeholder="Please briefly describe your legal situation. All information shared is strictly confidential..." required></textarea>
            </div>

            <button type="submit" class="btn btn-primary w-full" style="font-size:0.95rem; padding:16px;">
              <i class="fa-solid fa-paper-plane"></i> Submit Consultation Request
            </button>

            <p class="form-disclaimer mt-2">
              <i class="fa-solid fa-lock"></i> Your information is protected by strict attorney-client confidentiality. We do not share your details with any third parties.
            </p>
          </form>

          <div class="form-success" style="display:none;">
            <i class="fa-solid fa-circle-check" style="color:var(--success);"></i>
            <h4 style="color:var(--navy); margin-bottom:0.5rem;">Consultation Request Received!</h4>
            <p style="color:var(--gray-600);">We'll call you back within 2 business hours. For urgent bail matters, please WhatsApp directly.</p>
            <a href="<?php echo esc_url( akc_wa_urgent() ); ?>" class="btn btn-primary mt-3" target="_blank" rel="noopener"><i class="fa-brands fa-whatsapp"></i> WhatsApp for Urgent Help</a>
          </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- MAP SECTION -->
<section class="section-py section-cream" id="map">
  <div class="container">
    <div style="text-align:center; margin-bottom:2.5rem;">
      <div class="section-label">Find Us</div>
      <h2 class="section-title">Office <span>Location</span></h2>
      <p style="color:var(--gray-600);">Conveniently located in Shivajinagar — Pune's prime legal district, near all major courts.</p>
    </div>
    <div class="map-wrap reveal">
      <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3782.8753066734!2d73.8530!3d18.5195!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bc2c080b5e54e05%3A0x6e3e7f3e3e3e3e3e!2sShivajinagar%2C%20Pune%2C%20Maharashtra!5e0!3m2!1sen!2sin!4v1700000000000!5m2!1sen!2sin"
        width="100%"
        height="380"
        style="border:0;"
        allowfullscreen=""
        loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"
        title="Office location — Ekbote Complex, Shivajinagar, Pune">
      </iframe>
    </div>
  </div>
</section>

<!-- EMERGENCY CTA -->
<section style="background:var(--navy-dark); padding:60px 0;">
  <div class="container" style="text-align:center;">
    <h2 style="color:var(--white); font-size:1.8rem; margin-bottom:0.75rem;">
      <em style="color:var(--gold);">Emergency?</em> Bail Matter? Need Immediate Help?
    </h2>
    <p style="color:rgba(255,255,255,0.55); margin-bottom:2rem;">For urgent criminal matters including bail emergencies — call or WhatsApp immediately. Available outside office hours for critical situations.</p>
    <div style="display:flex; gap:1rem; justify-content:center; flex-wrap:wrap;">
      <a href="<?php echo esc_url( akc_phone_link() ); ?>" class="btn btn-primary btn-lg"><i class="fa-solid fa-phone"></i> Call <?php echo esc_html( AKC_PHONE_DISPLAY ); ?></a>
      <a href="<?php echo esc_url( akc_wa_urgent() ); ?>" class="btn btn-outline btn-lg" target="_blank" rel="noopener"><i class="fa-brands fa-whatsapp"></i> Emergency WhatsApp</a>
    </div>
  </div>
</section>

<?php get_footer(); ?>
