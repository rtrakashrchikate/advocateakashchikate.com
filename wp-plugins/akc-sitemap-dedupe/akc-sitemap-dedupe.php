/**
 * AKC: list /practice-areas/ only once in the Rank Math sitemap (Nov 2026).
 * The "Practice Areas" page and the practice_area archive share the same URL, so the
 * page entry is dropped from the page sitemap. Deactivate this snippet to undo.
 */
add_filter( 'rank_math/sitemap/entry', function ( $url, $type, $object ) {
	if ( 'post' === $type && is_object( $object ) && 'page' === $object->post_type && 'practice-areas' === $object->post_name ) {
		return false;
	}
	return $url;
}, 10, 3 );
