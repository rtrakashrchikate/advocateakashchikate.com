#!/bin/bash
# Installs the Lightpanda headless browser (https://github.com/lightpanda-io/browser)
# so sessions can render advocateakashchikate.com pages for SEO audits.
set -euo pipefail

if [ "${CLAUDE_CODE_REMOTE:-}" != "true" ]; then
  exit 0
fi

bin=/usr/local/bin/lightpanda
url=https://github.com/lightpanda-io/browser/releases/download/nightly/lightpanda-x86_64-linux

# Skip when already installed and runnable
if [ -x "$bin" ] && "$bin" version >/dev/null 2>&1; then
  exit 0
fi

if [ "$(uname -m)" != "x86_64" ]; then
  echo "lightpanda: no build for $(uname -m), skipping" >&2
  exit 0
fi

tmp=$(mktemp)
trap 'rm -f "$tmp"' EXIT
curl -fsSL --retry 3 --max-time 300 -o "$tmp" "$url"
chmod 755 "$tmp"
"$tmp" version >/dev/null
mv "$tmp" "$bin"
trap - EXIT
echo "lightpanda installed: $("$bin" version)" >&2
