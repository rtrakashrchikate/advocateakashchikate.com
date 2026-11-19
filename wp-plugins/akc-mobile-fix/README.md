# AKC mobile fix: post column width
Deployed 19 Nov 2026 as Code Snippet id 16 "AKC mobile fix: post column width (Nov 2026)".
Problem: on phones the blog-post grid column grew to 400px on a 390px screen, so the right edge of every paragraph was cut off.
Fix: grid-template-columns:minmax(0,1fr) and min-width:0 on the grid children under 900px. Revert: deactivate snippet 16.
Same day: 64 posts moved out of "Uncategorized" into existing categories (backup: advocateakashchikate.com-audit/backups/v5-before/uncategorized-posts-before.json);
post 2916 got an intent table, quick steps and an FAQ (backup: post-2916-before-intent-router.json).
