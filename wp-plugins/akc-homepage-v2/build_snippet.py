#!/usr/bin/env python3
"""Generate akc-homepage-v2.php: the Code Snippets body (no opening php tag) that swaps in the v2 hero + situations.

The snippet:
  * runs only on the front page, buffers the page, and replaces everything from the hero comment to the end of the
    first <section class="hero"> with the new markup;
  * returns the original page untouched if any marker is missing (safe fallback);
  * optionally applies the copy fixes in COPY_FIXES when AKC_HOME_COPY_FIXES is true (default false).
"""
from pathlib import Path

here = Path(__file__).parent
hero = (here / "hero.html").read_text(encoding="utf-8").strip()
css = (here / "home.css").read_text(encoding="utf-8").strip()
js = (here / "home.js").read_text(encoding="utf-8").strip()

COPY_FIXES = [
    ("Available for Bail Emergencies 24/7", "Phone and WhatsApp, Mon–Sat 10 AM–7 PM"),
    ("Fill the form below — messages are answered the same day.", "Fill the form below. The office replies during working hours."),
    ("<p>Every legal matter has a solution. Get a confidential consultation", "<p>Get a confidential consultation"),
    ("<h4>Vigorous Representation</h4>", "<h4>Representation in Court</h4>"),
    ("I fight for your rights with full commitment — in court, in negotiations, and at every step of the legal process.",
     "Your matter is presented before the court at each stage, on your instructions and on the facts of the case."),
    ("<h4>Available When It Matters Most</h4>", "<h4>Contact Hours</h4>"),
    ("Legal emergencies don't follow office hours. I'm reachable when you need me most, including bail emergencies.",
     "The office is open Monday to Saturday, 10 AM to 7 PM. Call or WhatsApp to arrange a consultation."),
    ("You deal directly with me — not a junior. Your case gets the focus it deserves at every stage.",
     "You deal directly with the advocate handling your matter, and each stage is explained in plain language."),
    ("Every client receives my personal attention, honest assessment, and relentless advocacy — not just a case number.",
     "Every matter is handled personally, with an honest assessment of the legal position and a clear explanation at each stage."),
    ('<div class="section-label">Why Choose Me</div>', '<div class="section-label">How the Practice Works</div>'),
    ("Emergency bail at Sessions Court &amp; Bombay High Court. S.483 BNSS bail applications handled urgently for all offences.",
     "Regular bail after arrest at the Sessions Court, Pune and the Bombay High Court, Mumbai. Sections 480 and 483 BNSS."),
]


def php_str(s):
    return "'" + s.replace("\\", "\\\\").replace("'", "\\'") + "'"


fixes_php = ",\n        ".join("array(%s, %s)" % (php_str(a), php_str(b)) for a, b in COPY_FIXES)

for tag, body in (("AKC_HERO_HTML", hero), ("AKC_CSS", css), ("AKC_JS", js)):
    assert tag not in body

php = f"""/**
 * AKC Homepage v2: new hero + "Where do you stand today?" situations section.
 * Scope: front page only. Safe fallback: if the hero markers are not found, the page is returned unchanged.
 * To switch the optional copy fixes on, change AKC_HOME_COPY_FIXES to true (they are OFF by default).
 * To revert completely: deactivate this snippet.
 */
if ( ! defined( 'AKC_HOME_COPY_FIXES' ) ) {{
    define( 'AKC_HOME_COPY_FIXES', false );
}}

if ( ! function_exists( 'akc_home_v2_filter' ) ) {{
    function akc_home_v2_filter( $html ) {{
        $marker = '<!-- ══ HERO SECTION ══ -->';
        $start  = strpos( $html, $marker );
        if ( false === $start ) {{ return $html; }}
        $open = strpos( $html, '<section class="hero">', $start );
        if ( false === $open ) {{ return $html; }}
        $close = strpos( $html, '</section>', $open );
        if ( false === $close ) {{ return $html; }}
        $end = $close + strlen( '</section>' );

        $hero = <<<'AKC_HERO_HTML'
{hero}
AKC_HERO_HTML;
        $css = <<<'AKC_CSS'
{css}
AKC_CSS;
        $js = <<<'AKC_JS'
{js}
AKC_JS;

        $out = substr( $html, 0, $start ) . $hero . substr( $html, $end );

        $fonts = '<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Tiro+Devanagari+Marathi:ital@0;1&display=swap">';
        $out   = str_replace( '</head>', $fonts . '<style id="akc-home-v2-css">' . $css . '</style></head>', $out, $c1 );
        $out   = str_replace( '</body>', '<script id="akc-home-v2-js">' . $js . '</script></body>', $out, $c2 );
        if ( ! $c1 || ! $c2 ) {{ return $html; }}

        if ( AKC_HOME_COPY_FIXES ) {{
            $fixes = array(
        {fixes_php}
            );
            foreach ( $fixes as $f ) {{
                if ( substr_count( $out, $f[0] ) === 1 ) {{
                    $out = str_replace( $f[0], $f[1], $out );
                }}
            }}
        }}
        return $out;
    }}
}}

add_action( 'template_redirect', function () {{
    if ( is_admin() || is_feed() || is_preview() || ! is_front_page() ) {{ return; }}
    ob_start( 'akc_home_v2_filter' );
}}, 20 );
"""
(here / "akc-homepage-v2.php").write_text(php, encoding="utf-8")
print("wrote akc-homepage-v2.php", len(php), "bytes")
