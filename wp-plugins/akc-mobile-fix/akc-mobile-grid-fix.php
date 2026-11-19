/**
 * AKC mobile fix (Nov 2026): on phones the blog post grid column grew to its widest unbreakable
 * content (400px on a 390px screen), so the right edge of every paragraph was cut off.
 * minmax(0,1fr) + min-width:0 lets the single column shrink to the screen. Deactivate to undo.
 */
add_action( 'wp_head', function () {
	if ( is_admin() ) {
		return;
	}
	echo '<style id="akc-mobile-grid-fix">@media (max-width:900px){.content-sidebar-grid,.location-grid{grid-template-columns:minmax(0,1fr)!important}.content-sidebar-grid>*,.location-grid>*{min-width:0}.article-body{overflow-wrap:break-word}.article-body a{overflow-wrap:anywhere}}</style>' . "\n";
}, 99 );
