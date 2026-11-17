#!/usr/bin/env python3
"""Apply the v2 hero + situations to a saved copy of the live homepage, for local preview only.

usage: build_preview.py <saved-live-home.html> <out.html>
The same replacement is done on the live site by the PHP snippet (see akc-homepage-v2.php).
"""
import re
import sys
from pathlib import Path

here = Path(__file__).parent
live = Path(sys.argv[1]).read_text(encoding="utf-8", errors="ignore")
hero = (here / "hero.html").read_text(encoding="utf-8")
css = (here / "home.css").read_text(encoding="utf-8")
js = (here / "home.js").read_text(encoding="utf-8")

start = live.index("<!-- ══ HERO SECTION ══ -->")
end = live.index("</section>", live.index('<section class="hero">', start)) + len("</section>")
out = live[:start] + hero + live[end:]

fonts = ('<link rel="stylesheet" href="https://fonts.googleapis.com/css2?'
         'family=Tiro+Devanagari+Marathi:ital@0;1&display=swap">')
out = out.replace("</head>", fonts + "<style id=\"akc-home-v2-css\">" + css + "</style></head>", 1)
out = out.replace("</body>", "<script id=\"akc-home-v2-js\">" + js + "</script></body>", 1)
# the live page has a <base>-less relative layout; make asset URLs absolute is not needed (they already are)
Path(sys.argv[2]).write_text(out, encoding="utf-8")
print("wrote", sys.argv[2], len(out))
