#!/usr/bin/env python3
"""Final homepage build.

  build.py preview <saved-live-home.html> <out.html>    local preview of the final homepage
  build.py snippet                                       writes akc-homepage-final.php (Code Snippets body)

The page is rebuilt from the hero comment up to (not including) the "AREAS WE SERVE" comment. The areas-served block,
the consultation form (Contact Form 7), the footer and the floating buttons stay exactly as the theme renders them.
FAQ questions are defined once in faq.json and feed both the visible FAQ and the FAQPage JSON-LD.
"""
import html, json, sys
from pathlib import Path

here = Path(__file__).parent
faq = json.loads((here / "faq.json").read_text(encoding="utf-8"))


def faq_items():
    out = []
    for i, f in enumerate(faq):
        link = ""
        if f.get("link"):
            link = '<p><a href="%s">%s</a></p>' % (f["link"][1], html.escape(f["link"][0]))
        out.append(
            '      <details name="faq2"%s><summary>%s</summary><div class="faq2-a"><p>%s</p>%s</div></details>'
            % (" open" if i == 0 else "", html.escape(f["q"]), html.escape(f["a"]), link)
        )
    return "\n".join(out)


hero = (here / "hero.html").read_text(encoding="utf-8").strip()
sections = (here / "sections.html").read_text(encoding="utf-8").replace("{{FAQ_ITEMS}}", faq_items()).strip()
css = (here / "home.css").read_text(encoding="utf-8").strip()
js = (here / "home.js").read_text(encoding="utf-8").strip()
new_block = hero + "\n\n" + sections + "\n\n"
START = "<!-- ══ HERO SECTION ══ -->"
END = "<!-- ══ AREAS WE SERVE ══ -->"
FONTS = ('<link rel="stylesheet" href="https://fonts.googleapis.com/css2?'
         'family=Tiro+Devanagari+Marathi:ital@0;1&display=swap">')


def faq_jsonld():
    return {
        "@type": "FAQPage",
        "mainEntity": [
            {"@type": "Question", "name": f["q"],
             "acceptedAnswer": {"@type": "Answer", "text": f["a"]}} for f in faq
        ],
    }


if sys.argv[1] == "preview":
    import re
    live = Path(sys.argv[2]).read_text(encoding="utf-8", errors="ignore")
    a = live.index(START)
    b = live.index(END)
    out = live[:a] + new_block + live[b:]
    out = out.replace("</head>", FONTS + '<style id="akc-home-final-css">' + css + "</style></head>", 1)
    out = out.replace("</body>", '<script id="akc-home-final-js">' + js + "</script></body>", 1)
    Path(sys.argv[3]).write_text(out, encoding="utf-8")
    print("wrote", sys.argv[3], len(out))
elif sys.argv[1] == "snippet":
    for tag, body in (("AKC_HERO_HTML", new_block), ("AKC_CSS", css), ("AKC_JS", js)):
        assert tag not in body
    faq_json = json.dumps(faq_jsonld(), ensure_ascii=False)
    assert "AKC_FAQ_JSON" not in faq_json
    php = """/**
 * AKC Homepage (final): new hero, situations, courts, about, method, services, process, guides and FAQ.
 * Scope: front page only. Safe fallback: if the START or END marker is missing, the page is returned unchanged.
 * Also corrects the homepage structured data: the FAQPage JSON-LD is replaced with the visible FAQ, and the
 * priceRange field is removed from the LegalService nodes.
 * Copy fixes for the kept consultation/footer blocks (Rule 36 wording) are ON; define AKC_HOME_COPY_FIXES as false to turn them off.
 * To revert completely: deactivate this snippet.
 */
if ( ! defined( 'AKC_HOME_COPY_FIXES' ) ) {
    define( 'AKC_HOME_COPY_FIXES', true );
}

if ( ! function_exists( 'akc_home_final_filter' ) ) {
    function akc_home_final_filter( $html ) {
        $start_marker = '<!-- ══ HERO SECTION ══ -->';
        $end_marker   = '<!-- ══ AREAS WE SERVE ══ -->';
        $a = strpos( $html, $start_marker );
        if ( false === $a ) { return $html; }
        $b = strpos( $html, $end_marker, $a );
        if ( false === $b ) { return $html; }

        $block = <<<'AKC_HERO_HTML'
@@NEW_BLOCK@@
AKC_HERO_HTML;
        $css = <<<'AKC_CSS'
@@CSS@@
AKC_CSS;
        $js = <<<'AKC_JS'
@@JS@@
AKC_JS;

        $out = substr( $html, 0, $a ) . $block . substr( $html, $b );

        $fonts = '<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Tiro+Devanagari+Marathi:ital@0;1&display=swap">';
        $out   = str_replace( '</head>', $fonts . '<style id="akc-home-final-css">' . $css . '</style></head>', $out, $c1 );
        $out   = str_replace( '</body>', '<script id="akc-home-final-js">' . $js . '</script></body>', $out, $c2 );
        if ( ! $c1 || ! $c2 ) { return $html; }

        $out = akc_home_final_schema( $out );

        if ( AKC_HOME_COPY_FIXES ) {
            $fixes = array(
                array( 'Fill the form below — messages are answered the same day.', 'Fill the form below. The office replies during working hours.' ),
                array( 'Available for Bail Emergencies 24/7', 'Phone and WhatsApp, Mon–Sat 10 AM–7 PM' ),
                array( 'No Obligation — Just Honest Advice', 'In person, by phone or on video' ),
                array( '100% Confidential Consultation', 'Confidential consultation' ),
                array( "<h2>Don't Face the <em>Legal System</em> Alone.</h2>", '<h2>Contact the <em>Office</em></h2>' ),
                array( '<p>Every legal matter has a solution. Get a confidential consultation and understand your options — with no pressure and no obligations.</p>', '<p>Get a confidential consultation and understand your options.</p>' ),
                array( 'value="Submit — We&#039;ll Call You Back"', 'value="Send message"' ),
                array( '</i> WhatsApp, Phone, or In-Person</div>', '</i> Marathi, Hindi and English</div>' ),
                array( '</i> WhatsApp Now', '</i> WhatsApp' ),
                array( 'aria-label="Call Now"', 'aria-label="Call"' ),
                array( '<span>Call Now</span>', '<span>Call</span>' ),
                array( 'Providing ethical legal representation across criminal, civil, family, and corporate matters in Pune and Maharashtra since 2020.', 'Criminal, civil, family and corporate legal practice in Pune and Maharashtra. Enrolled 2020.' ),
            );
            foreach ( $fixes as $f ) {
                if ( substr_count( $out, $f[0] ) === 1 ) {
                    $out = str_replace( $f[0], $f[1], $out );
                }
            }
        }
        return $out;
    }
}

if ( ! function_exists( 'akc_home_final_schema' ) ) {
    function akc_home_final_schema( $html ) {
        $faq = json_decode( <<<'AKC_FAQ_JSON'
@@FAQ_JSON@@
AKC_FAQ_JSON
        , true );
        if ( ! is_array( $faq ) ) { return $html; }

        return preg_replace_callback(
            '#(<script[^>]*type="application/ld\+json"[^>]*>)(.*?)(</script>)#s',
            function ( $m ) use ( $faq ) {
                $data = json_decode( $m[2], true );
                if ( ! is_array( $data ) ) { return $m[0]; }
                $changed = false;
                $walk = function ( &$node ) use ( &$walk, $faq, &$changed ) {
                    if ( ! is_array( $node ) ) { return; }
                    $types = isset( $node['@type'] ) ? (array) $node['@type'] : array();
                    if ( in_array( 'FAQPage', $types, true ) ) {
                        $node['mainEntity'] = $faq['mainEntity'];
                        $changed = true;
                    }
                    if ( in_array( 'LegalService', $types, true ) && isset( $node['priceRange'] ) ) {
                        unset( $node['priceRange'] );
                        $changed = true;
                    }
                    foreach ( $node as $k => &$child ) { if ( is_array( $child ) ) { $walk( $child ); } }
                };
                $walk( $data );
                if ( ! $changed ) { return $m[0]; }
                return $m[1] . wp_json_encode( $data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . $m[3];
            },
            $html
        );
    }
}

add_action( 'template_redirect', function () {
    if ( is_admin() || is_feed() || is_preview() || ! is_front_page() ) { return; }
    ob_start( 'akc_home_final_filter' );
}, 20 );
"""
    for _k, _v in (("@@NEW_BLOCK@@", new_block), ("@@CSS@@", css), ("@@JS@@", js), ("@@FAQ_JSON@@", faq_json)):
        php = php.replace(_k, _v)

    (here / "akc-homepage-final.php").write_text(php, encoding="utf-8")
    print("wrote akc-homepage-final.php", len(php), "bytes")
