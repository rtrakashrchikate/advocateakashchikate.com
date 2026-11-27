/**
 * AKC: stop Site Kit printing the Google Tag Manager container (Nov 2026).
 * GTM-KHJB7M88 contains no tags (checked 27 Nov 2026), so it only added ~334 KB of script.
 * Google Analytics, Google Ads and the phone/WhatsApp click events load through the Site Kit
 * Google tag (GT-M3SMZ4NS) and are not affected. Deactivate this snippet to restore GTM.
 */
add_filter( 'googlesitekit_tagmanager_tag_blocked', '__return_true' );
