<!-- ══ FOOTER ══ -->
<footer>
  <div class="container">
    <div class="footer-grid">

      <div class="footer-brand">
        <span class="logo-name">Adv. Akash R. Chikate</span>
        <span class="logo-tag">Criminal Defence Attorney · Pune</span>
        <p>Providing trusted, ethical, and effective legal representation across criminal, civil, family, and corporate matters in Pune and Maharashtra since 2017.</p>
        <div class="footer-social">
          <?php if ( AKC_SOCIAL_LINKEDIN ) : ?>
          <a href="<?php echo esc_url( AKC_SOCIAL_LINKEDIN ); ?>" class="social-btn" aria-label="LinkedIn" target="_blank" rel="noopener"><i class="fa-brands fa-linkedin-in"></i></a>
          <?php endif; ?>
          <?php if ( AKC_SOCIAL_FACEBOOK ) : ?>
          <a href="<?php echo esc_url( AKC_SOCIAL_FACEBOOK ); ?>" class="social-btn" aria-label="Facebook" target="_blank" rel="noopener"><i class="fa-brands fa-facebook-f"></i></a>
          <?php endif; ?>
          <?php if ( AKC_SOCIAL_TWITTER ) : ?>
          <a href="<?php echo esc_url( AKC_SOCIAL_TWITTER ); ?>" class="social-btn" aria-label="Twitter / X" target="_blank" rel="noopener"><i class="fa-brands fa-x-twitter"></i></a>
          <?php endif; ?>
          <a href="<?php echo esc_url( akc_wa_link() ); ?>" class="social-btn" aria-label="WhatsApp" target="_blank" rel="noopener"><i class="fa-brands fa-whatsapp"></i></a>
        </div>
      </div>

      <div class="footer-col">
        <h5>Practice Areas</h5>
        <ul class="footer-links">
          <li><a href="<?php echo esc_url( home_url( '/practice-areas/criminal-defence' ) ); ?>"><i class="fa-solid fa-chevron-right"></i> Criminal Defence</a></li>
          <li><a href="<?php echo esc_url( home_url( '/practice-areas/cyber-it-law' ) ); ?>"><i class="fa-solid fa-chevron-right"></i> Cyber &amp; IT Law</a></li>
          <li><a href="<?php echo esc_url( home_url( '/practice-areas/family-law' ) ); ?>"><i class="fa-solid fa-chevron-right"></i> Family Law</a></li>
          <li><a href="<?php echo esc_url( home_url( '/practice-areas/corporate-law' ) ); ?>"><i class="fa-solid fa-chevron-right"></i> Corporate Law</a></li>
          <li><a href="<?php echo esc_url( home_url( '/practice-areas/intellectual-property' ) ); ?>"><i class="fa-solid fa-chevron-right"></i> Intellectual Property</a></li>
          <li><a href="<?php echo esc_url( home_url( '/practice-areas/posh-workplace-law' ) ); ?>"><i class="fa-solid fa-chevron-right"></i> POSH Advisory</a></li>
        </ul>
      </div>

      <div class="footer-col">
        <h5>Quick Links</h5>
        <ul class="footer-links">
          <li><a href="<?php echo esc_url( home_url( '/about' ) ); ?>"><i class="fa-solid fa-chevron-right"></i> About the Advocate</a></li>
          <li><a href="<?php echo esc_url( home_url( '/practice-areas' ) ); ?>"><i class="fa-solid fa-chevron-right"></i> All Services</a></li>
          <li><a href="<?php echo esc_url( home_url( '/blog' ) ); ?>"><i class="fa-solid fa-chevron-right"></i> Legal Insights Blog</a></li>
          <li><a href="<?php echo esc_url( home_url( '/contact' ) ); ?>"><i class="fa-solid fa-chevron-right"></i> Book Consultation</a></li>
          <li><a href="<?php echo esc_url( home_url( '/case-results' ) ); ?>"><i class="fa-solid fa-chevron-right"></i> Case Results</a></li>
        </ul>
      </div>

      <div class="footer-col">
        <h5>Contact</h5>
        <div class="footer-contact-item">
          <i class="fa-solid fa-phone"></i>
          <div>
            <a href="<?php echo esc_url( akc_phone_link() ); ?>" style="display:block; color:rgba(255,255,255,0.55);"><?php echo esc_html( AKC_PHONE_DISPLAY ); ?></a>
            <span style="font-size:0.72rem; color:rgba(255,255,255,0.25);">Mon–Sat · 10 AM – 7 PM</span>
          </div>
        </div>
        <div class="footer-contact-item">
          <i class="fa-solid fa-envelope"></i>
          <a href="mailto:<?php echo esc_attr( AKC_EMAIL ); ?>"><?php echo esc_html( AKC_EMAIL ); ?></a>
        </div>
        <div class="footer-contact-item">
          <i class="fa-solid fa-location-dot"></i>
          <span>Shivajinagar, Pune,<br>Maharashtra – 411005</span>
        </div>
        <div class="footer-contact-item">
          <i class="fa-brands fa-whatsapp" style="color:#25d366;"></i>
          <a href="<?php echo esc_url( akc_wa_link() ); ?>" target="_blank" rel="noopener">WhatsApp for Quick Query</a>
        </div>
      </div>

    </div>

    <div class="footer-bottom">
      <p>© <?php echo date( 'Y' ); ?> Advocate Akash R. Chikate. All Rights Reserved.</p>
      <div class="footer-bottom-links">
        <a href="<?php echo esc_url( home_url( '/privacy-policy' ) ); ?>">Privacy Policy</a>
        <a href="<?php echo esc_url( home_url( '/disclaimer' ) ); ?>">Disclaimer</a>
        <a href="<?php echo esc_url( home_url( '/bar-council-compliance' ) ); ?>">Bar Council Compliance</a>
      </div>
    </div>
  </div>
</footer>

<!-- ══ FLOATING BUTTONS ══ -->
<div class="float-btns">
  <button class="float-btn float-scroll" aria-label="Scroll to top">
    <i class="fa-solid fa-arrow-up"></i>
    <span class="float-label">Top</span>
  </button>
  <a href="<?php echo esc_url( akc_phone_link() ); ?>" class="float-btn float-call" aria-label="Call Now">
    <i class="fa-solid fa-phone"></i>
    <span class="float-label">Call</span>
  </a>
  <a href="<?php echo esc_url( akc_wa_link() ); ?>" class="float-btn float-whatsapp" target="_blank" rel="noopener" aria-label="WhatsApp">
    <i class="fa-brands fa-whatsapp"></i>
    <span class="float-label">WhatsApp</span>
  </a>
</div>

<?php wp_footer(); ?>
</body>
</html>
