/**
 * AKC trust signals (Nov 2026).
 * 1. A plain-text Google rating line linking to the Business Profile, near the top of
 *    service pages, area pages, blog posts and the homepage hero. No AggregateRating schema
 *    (self-served review markup is ignored by Google). Update AKC_TS_COUNT as reviews grow.
 * 2. A "Recent results at the Bombay High Court" strip from the case_result posts, at the end
 *    of service pages (matched to the topic where possible) and above the homepage FAQ.
 * Deactivate this snippet to remove both.
 */
if ( ! defined( 'AKC_TS_RATING' ) ) {
	define( 'AKC_TS_RATING', '5.0' );
	define( 'AKC_TS_COUNT', 20 );
	define( 'AKC_TS_URL', 'https://www.google.com/maps?cid=2771672946981232004' );
}

if ( ! function_exists( 'akc_ts_rating_html' ) ) {
	function akc_ts_rating_html( $extra_class = '' ) {
		return '<p class="akc-rating ' . esc_attr( $extra_class ) . '"><a href="' . esc_url( AKC_TS_URL ) . '" target="_blank" rel="noopener">'
			. '<span class="akc-stars" aria-hidden="true">&#9733;&#9733;&#9733;&#9733;&#9733;</span> '
			. esc_html( AKC_TS_RATING ) . ' on Google &middot; ' . intval( AKC_TS_COUNT ) . ' reviews</a></p>';
	}

	function akc_ts_results( $slug_hint = '' ) {
		$map = array(
			'anticipatory-bail'                       => array( 'anticipatory', 'interim-protection' ),
			'bail-application'                        => array( 'bail-granted', 'attempt-murder', 'trafficking' ),
			'mcoca-defence'                           => array( 'mcoca' ),
			'eow-financial-crimes-defence'            => array( 'eow' ),
			'pocso-defence'                           => array( 'pocso' ),
			'sc-st-atrocities-act-defence'            => array( 'sc-st' ),
			'criminal-appeals-suspension-of-sentence' => array( 'sentence', 'conviction' ),
			'sessions-trial-defence'                  => array( 'murder', 'attempt' ),
			'criminal-defence'                        => array( 'murder', 'attempt', 'anticipatory' ),
		);
		$posts = get_posts( array( 'post_type' => 'case_result', 'numberposts' => 30, 'post_status' => 'publish' ) );
		$posts = array_values( array_filter( $posts, function ( $p ) {
			return false === strpos( $p->post_name, 'rejected' );
		} ) );
		if ( ! $posts ) {
			return '';
		}
		$pick = array();
		if ( $slug_hint && isset( $map[ $slug_hint ] ) ) {
			foreach ( $posts as $p ) {
				foreach ( $map[ $slug_hint ] as $k ) {
					if ( false !== strpos( $p->post_name, $k ) ) {
						$pick[ $p->ID ] = $p;
						break;
					}
				}
			}
		}
		foreach ( $posts as $p ) {
			if ( count( $pick ) >= 3 ) {
				break;
			}
			$pick[ $p->ID ] = $p;
		}
		$pick = array_slice( $pick, 0, 3 );
		$li = '';
		foreach ( $pick as $p ) {
			$parts = preg_split( '/\s*[|\x{FF5C}\x{2223}\x{2502}]\s*/u', html_entity_decode( wp_strip_all_tags( $p->post_title ), ENT_QUOTES, 'UTF-8' ) );
			$li   .= '<li><a href="' . esc_url( get_permalink( $p ) ) . '">' . esc_html( $parts[0] ) . '</a>'
				. '</li>'; // Court and date already appear in the link text (another snippet expands case-result link titles).
		}
		return '<div class="akc-results"><h2 class="akc-results-h">Recent results at the Bombay High Court</h2><ul>' . $li . '</ul>'
			. '<p class="akc-results-all"><a href="' . esc_url( home_url( '/case-results/' ) ) . '">All case results</a></p></div>';
	}
}

add_action( 'wp_head', function () {
	echo '<style id="akc-ts-css">.akc-rating{margin:0 0 1rem;font-size:.95rem;font-weight:600}.akc-rating a{text-decoration:none;color:inherit;display:inline-flex;gap:.4rem;align-items:center}.akc-rating a:hover{text-decoration:underline}.akc-stars{color:#C9A227;letter-spacing:1px}.akc-rating.akc-hero{margin:.5rem 0 1rem;color:#f3e7c4}.akc-results{margin:2.5rem 0 1rem;padding:1.25rem 1.4rem;border:1px solid #e2ddd6;border-left:4px solid #C9A227;border-radius:10px;background:#faf8f4}.akc-results-h{font-size:1.2rem!important;margin:0 0 .75rem!important}.akc-results ul{margin:0;padding-left:1.1rem}.akc-results li{margin:.35rem 0}.akc-results li span{display:block;font-size:.85rem;opacity:.75}.akc-results-all{margin:.75rem 0 0;font-weight:600}.akc-results-home{padding:3rem 0}.akc-results-home .akc-results{max-width:860px;margin:0 auto}</style>';
}, 30 );

add_filter( 'the_content', function ( $content ) {
	if ( is_admin() || is_feed() || ! is_singular( array( 'practice_area', 'location_page', 'post' ) ) || ! in_the_loop() || ! is_main_query() ) {
		return $content;
	}
	if ( false !== strpos( $content, 'akc-rating' ) ) {
		return $content;
	}
	$out = akc_ts_rating_html() . $content;
	if ( is_singular( 'practice_area' ) ) {
		$out .= akc_ts_results( get_post_field( 'post_name', get_queried_object_id() ) );
	}
	return $out;
}, 20 );

add_action( 'template_redirect', function () {
	if ( is_admin() || is_feed() || is_preview() || ! is_front_page() ) {
		return;
	}
	ob_start( function ( $html ) {
		if ( ! is_string( $html ) || false === strpos( $html, 'h2-lede' ) || false !== strpos( $html, 'class="akc-rating' ) ) {
			return $html;
		}
		$html = preg_replace( '#(<p class="h2-lede")#', akc_ts_rating_html( 'akc-hero' ) . '$1', $html, 1 );
		$strip = akc_ts_results( 'criminal-defence' );
		if ( $strip ) {
			$html = preg_replace( '#(<section class="faq2")#', '<section class="akc-results-home"><div class="container">' . $strip . '</div></section>$1', $html, 1 );
		}
		return $html;
	} );
}, 1 ); // Priority 1: this buffer must wrap the homepage snippet's buffer so it sees the final HTML.
