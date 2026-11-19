# Product cards with photo backgrounds (Nov 2026)

28 Google Business Profile product cards. Each card uses an AI photo made with Porter Metrics (creative.generate, image.text.pro, 1:1). There is no portrait on the cards.

- `card3.html`: the card template, 1200 x 1200. It uses a full photo, a navy shade at the bottom, a gold frame, eyebrow, title, section pill and Marathi line, with name and website in the footer.
- `render3.js`: renders every card from `../products/products.json`. Photos go in `img/01.png` to `img/28.png` and cards are written to `out/`. It also reports any text that runs into the footer.
- Crops: 07 had white side bars, 08 a white frame, and 16 and 23 white patches at the bottom, so `render3.js` crops those four. Photo 11 was made a second time because the first one had white bars.
- Prompts: `../PRODUCT-IMAGE-PROMPTS.md`. Each prompt adds "full-bleed edge to edge with no borders or frames".

The photos and finished cards are not in the repo because of their size. The finished cards are on the products artifact page.
