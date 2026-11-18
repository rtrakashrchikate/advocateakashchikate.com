/**
 * AKC Homepage title/description sync (Nov 2026).
 * Something else on the site forces an old title and old sharing text on the homepage.
 * This makes the homepage <title>, og:/twitter: title and og:/twitter: description
 * follow the Rank Math title/description saved on the homepage itself (edit them in
 * the page's Rank Math box). Deactivate this snippet to undo.
 */
add_action( 'template_redirect', function () {
	if ( is_admin() || is_feed() || is_preview() || ! is_front_page() ) {
		return;
	}
	$page_id = (int) get_queried_object_id();
	if ( ! $page_id ) {
		return;
	}
	$title = trim( (string) get_post_meta( $page_id, 'rank_math_title', true ) );
	$desc  = trim( (string) get_post_meta( $page_id, 'rank_math_description', true ) );
	if ( '' === $title || false !== strpos( $title, '%' ) ) {
		return;
	}

	ob_start( function ( $html ) use ( $title, $desc ) {
		if ( ! is_string( $html ) || false === stripos( $html, '</head>' ) ) {
			return $html;
		}
		$t = esc_html( $title );
		$a = esc_attr( $title );
		$d = esc_attr( $desc );

		$html = preg_replace_callback( '#<title>.*?</title>#is', function () use ( $t ) {
			return '<title>' . $t . '</title>';
		}, $html, 1 );

		$pairs = array( 'og:title' => $a, 'twitter:title' => $a );
		if ( '' !== $desc ) {
			$pairs['og:description']      = $d;
			$pairs['twitter:description'] = $d;
		}
		foreach ( $pairs as $key => $val ) {
			$html = preg_replace_callback(
				'#(<meta\s+(?:property|name)=(["\'])' . preg_quote( $key, '#' ) . '\2\s+content=)(["\'])(.*?)\3#is',
				function ( $m ) use ( $val ) {
					return $m[1] . '"' . $val . '"';
				},
				$html
			);
		}
		return $html;
	} );
}, 30 );
