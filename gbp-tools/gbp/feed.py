"""Read the WordPress RSS feed so new articles can become GBP posts."""

from __future__ import annotations

import html
import re
import xml.etree.ElementTree as ET

import requests

DEFAULT_FEED = "https://advocateakashchikate.com/feed/"
NS = {"content": "http://purl.org/rss/1.0/modules/content/"}


def _text(el, path: str) -> str:
    node = el.find(path, NS)
    return (node.text or "").strip() if node is not None else ""


def strip_html(s: str) -> str:
    return html.unescape(re.sub(r"<[^>]+>", " ", s or ""))


def first_image(content_html: str) -> str | None:
    m = re.search(r'<img[^>]+src="([^"]+)"', content_html or "")
    return html.unescape(m.group(1)) if m else None


def parse_feed(xml_text: str) -> list[dict]:
    root = ET.fromstring(xml_text)
    items = []
    for item in root.iter("item"):
        content = _text(item, "content:encoded")
        items.append({
            "title": html.unescape(_text(item, "title")),
            "url": _text(item, "link"),
            "published": _text(item, "pubDate"),
            "excerpt": strip_html(_text(item, "description")),
            "image": first_image(content),
        })
    return items


def fetch_feed(url: str = DEFAULT_FEED) -> list[dict]:
    resp = requests.get(url, timeout=30, headers={"User-Agent": "gbp-tools/1.0"})
    resp.raise_for_status()
    return parse_feed(resp.text)
