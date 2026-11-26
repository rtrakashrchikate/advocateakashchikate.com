/**
 * AKC WhatsApp page source (Nov 2026).
 * Every WhatsApp button that carries the generic greeting (or no message) is changed so the
 * pre-filled message names the page the visitor was reading, e.g.
 * "Hello Advocate Akash, I need legal help. I found you on your website: Anticipatory Bail in Pune".
 * Buttons that already carry a page-specific message are left alone.
 * Click tracking (phone_click / whatsapp_click) is unaffected. Deactivate this snippet to undo.
 */
add_action( 'wp_footer', function () {
	if ( is_admin() || is_feed() ) {
		return;
	}
	?>
<script id="akc-wa-page-source">
(function () {
	var GENERIC = [/^hello advocate akash,? i need legal assistance\.?$/i, /^hi advocate akash,? i need legal help with\.*$/i];
	function pageName() {
		if (location.pathname === '/' || location.pathname === '') { return ''; }
		var h = document.querySelector('h1');
		var t = ((h && h.textContent) || document.title || '').replace(/\s+/g, ' ').trim();
		t = t.split(' | ')[0];
		if (t.length > 90) { t = t.slice(0, 87).trim() + '...'; }
		return t;
	}
	function fix(a) {
		try {
			var u = new URL(a.href, location.href);
			if (!/(^|\.)wa\.me$|(^|\.)api\.whatsapp\.com$/i.test(u.hostname)) { return; }
			var cur = (u.searchParams.get('text') || '').trim();
			if (cur && !GENERIC.some(function (r) { return r.test(cur); })) { return; }
			var p = pageName();
			u.searchParams.set('text', 'Hello Advocate Akash, I need legal help. I found you on your website' + (p ? ': ' + p : '') + '.');
			a.href = u.toString();
		} catch (e) {}
	}
	function all() {
		var list = document.querySelectorAll('a[href*="wa.me"], a[href*="api.whatsapp.com"]');
		for (var i = 0; i < list.length; i++) { fix(list[i]); }
	}
	if (document.readyState === 'loading') { document.addEventListener('DOMContentLoaded', all); } else { all(); }
	document.addEventListener('click', function (e) {
		var a = e.target && e.target.closest ? e.target.closest('a') : null;
		if (a) { fix(a); }
	}, true);
})();
</script>
	<?php
}, 99 );
