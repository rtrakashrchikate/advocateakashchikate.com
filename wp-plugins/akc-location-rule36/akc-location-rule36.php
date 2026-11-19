/**
 * AKC Location pages: Bar Council Rule 36 wording (Nov 2026).
 * Scope: single location_page posts only (the 15 "Criminal Lawyer in <area>" pages).
 * The theme template still prints experience claims, "free consultation", "24/7" and "specialist".
 * This rewrites those fixed phrases on the final page output. Anything it does not find is left alone.
 * Deactivate this snippet to undo.
 */
if ( ! function_exists( 'akc_loc_rule36_filter' ) ) {
	function akc_loc_rule36_filter( $html ) {
		if ( ! is_string( $html ) || false === stripos( $html, '</body>' ) ) {
			return $html;
		}

		// Plain, exact phrases.
		$plain = array(
			'10+ Years Experience'                       => 'Enrolled 2020 · MAH/4681/2020',
			'6+ Years Experience'                        => 'Enrolled 2020 · MAH/4681/2020',
			'Available for Bail Emergencies'             => 'Office hours: Mon–Sat, 10 AM – 7 PM',
			'>Bail Emergency?<'                          => '>Contact the office<',
			'Call Now — Available 24/7'                  => 'Call or WhatsApp the office',
			'WhatsApp Emergency'                         => 'WhatsApp',
			'WhatsApp Now'                               => 'WhatsApp',
			'You speak directly with Advocate Akash Chikate — not a junior or clerk. Clear updates at every stage.'
				=> 'You speak directly with Advocate Akash Chikate. Updates are shared at each stage.',
			'<h3>Proven Track Record</h3>'               => '<h3>Practice areas</h3>',
			'<h3>Practice Experience</h3>'               => '<h3>Practice areas</h3>',
			'10+ years of criminal defence, bail, and High Court matters across Pune, PCMC and Maharashtra.'
				=> 'Criminal law practice: bail, anticipatory bail, FIR quashing, trials and appeals in Pune, Pimpri-Chinchwad and the Bombay High Court.',
			'6+ years of criminal defence, bail, and High Court matters across Pune, PCMC and Maharashtra.'
				=> 'Criminal law practice: bail, anticipatory bail, FIR quashing, trials and appeals in Pune, Pimpri-Chinchwad and the Bombay High Court.',
			'Criminal defence, bail, cybercrime, family law — first consultation is free and completely confidential.'
				=> 'Criminal defence, bail, cybercrime, family law. Enquiries to the office are treated as confidential.',
			'Experienced criminal defence'               => 'Criminal defence',
		);
		$html = str_replace( array_keys( $plain ), array_values( $plain ), $html );

		// Phrases that include the area name.
		$html = preg_replace(
			'#<h3>Fast Response</h3>\s*<p>Bail emergencies handled same day\. WhatsApp and phone available for urgent matters from ([^<]*?)\.</p>#u',
			'<h3>Reaching the office</h3><p>Phone and WhatsApp are open for enquiries from $1 during office hours, Mon–Sat, 10 AM – 7 PM.</p>',
			$html
		);
		$html = preg_replace( '#Get Legal Help in [^<]*#u', 'Contact the office', $html );
		$html = preg_replace( '#Need a Lawyer in (<em[^>]*>[^<]*</em>)\?#u', 'Matters from $1', $html );

		return $html;
	}
}

add_action( 'template_redirect', function () {
	if ( is_admin() || is_feed() || is_preview() || ! is_singular( 'location_page' ) ) {
		return;
	}
	ob_start( 'akc_loc_rule36_filter' );
}, 25 );
