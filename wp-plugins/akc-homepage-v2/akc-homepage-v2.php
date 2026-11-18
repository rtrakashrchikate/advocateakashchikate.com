/**
 * AKC Homepage v2: new hero + "Where do you stand today?" situations section.
 * Scope: front page only. Safe fallback: if the hero markers are not found, the page is returned unchanged.
 * To switch the optional copy fixes on, change AKC_HOME_COPY_FIXES to true (they are OFF by default).
 * To revert completely: deactivate this snippet.
 */
if ( ! defined( 'AKC_HOME_COPY_FIXES' ) ) {
    define( 'AKC_HOME_COPY_FIXES', false );
}

if ( ! function_exists( 'akc_home_v2_filter' ) ) {
    function akc_home_v2_filter( $html ) {
        $marker = '<!-- ══ HERO SECTION ══ -->';
        $start  = strpos( $html, $marker );
        if ( false === $start ) { return $html; }
        $open = strpos( $html, '<section class="hero">', $start );
        if ( false === $open ) { return $html; }
        $close = strpos( $html, '</section>', $open );
        if ( false === $close ) { return $html; }
        $end = $close + strlen( '</section>' );

        $hero = <<<'AKC_HERO_HTML'
<!-- ══ HERO SECTION (v2) ══ -->
<section class="hero hero2" id="top" aria-labelledby="h2-title">
  <div class="h2-bg" aria-hidden="true">
    <span class="h2-grain"></span>
    <span class="h2-arches"></span>
    <span class="h2-mark" lang="mr">न्याय</span>
  </div>

  <div class="container h2-wrap">
    <div class="h2-copy">
      <p class="h2-status" id="h2-status" data-state="static">
        <span class="h2-dot" aria-hidden="true"></span>
        <span id="h2-status-text">Office hours: Mon–Sat, 10 AM – 7 PM</span>
      </p>

      <p class="h2-eyebrow">Pune Sessions Court <i aria-hidden="true">·</i> Bombay High Court, Mumbai</p>

      <h1 id="h2-title">Criminal Defence &amp; <em>Bail Lawyer</em> in Pune</h1>

      <p class="h2-deva" lang="mr">जामीन · अटकपूर्व जामीन · एफआयआर रद्द</p>

      <p class="h2-lede">An arrest, an FIR or a police notice changes things quickly. Start with clear information about your options, the court involved and the steps that come next.</p>

      <div class="hero-actions h2-actions"><a href="tel:+918411982241" class="btn btn-primary btn-lg"><i class="fa-solid fa-phone akc-i" aria-hidden="true"><svg viewBox="0 0 512 512" focusable="false"><use href="#akci-solid-phone"/></svg></i> Call 84119 82241</a> <a href="https://wa.me/918698400302" class="btn btn-outline btn-lg akc-hero-wa" target="_blank" rel="noopener"><svg class="akc-wa-ico" viewBox="0 0 448 512" aria-hidden="true"><path fill="currentColor" d="M380.9 97.1C339 55.1 283.2 32 223.9 32 101.5 32 2 131.5 2 253.9c0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.5 224.1-221.9 0-59.3-25.2-115-67.1-157zM223.9 438.7c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/></svg> WhatsApp 86984 00302</a></div>

      <a class="h2-find" href="#situations">Not sure where to start? Find your situation <span aria-hidden="true">↓</span></a>

      <ul class="h2-facts">
        <li><small>Enrolled</small><span>2020 · MAH/4681/2020</span></li>
        <li><small>Languages</small><span>Marathi · हिन्दी · English</span></li>
        <li><small>Consultation</small><span>In person, phone or video</span></li>
      </ul>
    </div>

    <figure class="h2-portrait">
      <div class="h2-frame">
        <img fetchpriority="high" decoding="async" width="847" height="1063" src="https://advocateakashchikate.com/wp-content/uploads/2026/07/akash-chikate-hero-desktop-847w.webp" alt="Advocate Akash R. Chikate, criminal lawyer in Pune">
        <figcaption class="h2-tag"><strong>Adv. Akash R. Chikate</strong><span>B.A. LL.B., LL.M.</span></figcaption>
      </div>
      <div class="h2-chip h2-chip-a"><small>Practises before</small><b>Pune District &amp; Sessions Court</b></div>
      <div class="h2-chip h2-chip-b"><small>Appears at</small><b>Bombay High Court, Mumbai</b></div>
    </figure>
  </div>
</section>

<!-- ══ SITUATIONS (v2) ══ -->
<section class="sit2" id="situations" aria-labelledby="sit2-title">
  <div class="container">
    <header class="sit2-head">
      <p class="sit2-kicker"><span></span>Where do you stand today?</p>
      <h2 id="sit2-title">Choose the situation <em>closest to yours</em></h2>
      <p class="sit2-sub">Each page explains the law, the court, the documents and the usual next steps in plain language, with the old CrPC section numbers beside the new BNSS ones.</p>
    </header>

    <div class="sit2-grid">
      <a class="sit2-card" href="https://advocateakashchikate.com/practice-areas/anticipatory-bail/">
        <span class="sit2-n">01</span>
        <h3>I may be arrested</h3>
        <p>A complaint, FIR or police call has come, and arrest is possible. Anticipatory bail and the police notice route.</p>
        <span class="sit2-go">Anticipatory bail <b aria-hidden="true">→</b></span>
        <small>Section 482 BNSS · old 438 CrPC</small>
      </a>

      <a class="sit2-card" href="https://advocateakashchikate.com/practice-areas/bail-application/">
        <span class="sit2-n">02</span>
        <h3>Someone has been arrested</h3>
        <p>Remand, regular bail, default bail and what to do after a refusal at the Sessions Court.</p>
        <span class="sit2-go">Bail after arrest <b aria-hidden="true">→</b></span>
        <small>Sections 480, 483 BNSS · old 437, 439 CrPC</small>
      </a>

      <a class="sit2-card" href="https://advocateakashchikate.com/practice-areas/fir-quashing/">
        <span class="sit2-n">03</span>
        <h3>An FIR is registered</h3>
        <p>When an FIR can be challenged in the Bombay High Court, and how to check what is registered against you.</p>
        <span class="sit2-go">FIR quashing <b aria-hidden="true">→</b></span>
        <small>Section 528 BNSS · old 482 CrPC</small>
      </a>

      <a class="sit2-card" href="https://advocateakashchikate.com/practice-areas/cheque-bounce-ni-act/">
        <span class="sit2-n">04</span>
        <h3>A cheque has bounced</h3>
        <p>Notice, reply, complaint and settlement under Section 138, for the payer or the person who was paid.</p>
        <span class="sit2-go">Cheque bounce <b aria-hidden="true">→</b></span>
        <small>Section 138 Negotiable Instruments Act</small>
      </a>
    </div>

    <p class="sit2-more">
      <span>Also useful:</span>
      <a href="https://advocateakashchikate.com/rights-when-arrested-india/">Your rights when arrested</a>
      <a href="https://advocateakashchikate.com/practice-areas/police-notice-section-35-bnss/">Police notice (Section 35 BNSS)</a>
      <a href="https://advocateakashchikate.com/how-to-check-fir-registered-against-you-maharashtra/">Check an FIR in Maharashtra</a>
      <a href="https://advocateakashchikate.com/yerwada-jail-mulakat-release-after-bail-pune/">Yerwada jail mulakat</a>
      <a href="https://advocateakashchikate.com/practice-areas/criminal-defence/">All criminal services</a>
    </p>
  </div>
</section>
AKC_HERO_HTML;
        $css = <<<'AKC_CSS'
/* AKC homepage v2: hero + situations. Scoped to .hero2 and .sit2 so the rest of the theme is untouched. */
.hero.hero2{
  --g:#c9a030; --gl:#e8c355; --n:#0d1b3e; --nd:#07112a; --paper:#f9f6f0;
  position:relative; display:block; min-height:min(100vh,1000px);
  padding:clamp(104px,14vh,150px) 0 clamp(80px,10vh,120px);
  background:radial-gradient(110% 85% at 80% 28%,#162c63 0%,#0d1b3e 44%,#07112a 100%);
  overflow:hidden; isolation:isolate; align-items:initial;
}
.hero2 .h2-bg{position:absolute; inset:0; z-index:-1; pointer-events:none}
.hero2 .h2-grain{position:absolute; inset:0; opacity:.2; mix-blend-mode:overlay;
  background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='160' height='160'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.85' numOctaves='2' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E")}
.hero2 .h2-arches{position:absolute; right:max(2vw,calc((100vw - 1200px)/2 - 70px)); top:50%; width:min(54vw,700px); aspect-ratio:3/4; transform:translateY(-52%); opacity:.9;
  background:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 600 800' fill='none' stroke='%23c9a030' stroke-width='1.2'%3E%3Cpath opacity='.42' d='M10 790V300a290 290 0 0 1 580 0v490'/%3E%3Cpath opacity='.3' d='M60 790V300a240 240 0 0 1 480 0v490'/%3E%3Cpath opacity='.2' d='M110 790V300a190 190 0 0 1 380 0v490'/%3E%3Cpath opacity='.12' d='M160 790V300a140 140 0 0 1 280 0v490'/%3E%3C/svg%3E") center/contain no-repeat}
.hero2 .h2-mark{position:absolute; left:-1.5vw; bottom:-5vw; font:400 clamp(190px,27vw,430px)/1 'Tiro Devanagari Marathi','Noto Serif Devanagari',serif; color:transparent; -webkit-text-stroke:1px rgba(201,160,48,.15); user-select:none; white-space:nowrap}

.hero2 .h2-wrap{display:grid; grid-template-columns:minmax(0,1.14fr) minmax(0,.86fr); gap:clamp(36px,5vw,84px); align-items:center}

/* status pill */
.hero2 .h2-status{display:inline-flex; align-items:center; gap:10px; margin:0; padding:9px 15px; border:1px solid rgba(201,160,48,.38); border-radius:999px; background:rgba(255,255,255,.035); backdrop-filter:blur(6px); -webkit-backdrop-filter:blur(6px);
  font:600 .7rem/1 'Inter',system-ui,sans-serif; letter-spacing:.14em; text-transform:uppercase; color:var(--gl)}
.hero2 .h2-dot{width:8px; height:8px; border-radius:50%; background:#d9a441; flex:none}
.hero2 .h2-status[data-state="open"] .h2-dot{background:#3ddc84; box-shadow:0 0 0 0 rgba(61,220,132,.55); animation:h2pulse 2.2s ease-out infinite}
@keyframes h2pulse{70%{box-shadow:0 0 0 9px rgba(61,220,132,0)}100%{box-shadow:0 0 0 0 rgba(61,220,132,0)}}

.hero2 .h2-eyebrow{margin:20px 0 14px; font:500 .76rem/1.4 'Inter',system-ui,sans-serif; letter-spacing:.22em; text-transform:uppercase; color:rgba(255,255,255,.6)}
.hero2 .h2-eyebrow i{font-style:normal; color:var(--g); margin:0 .35em}

.hero2 h1{margin:0; font:600 clamp(2.5rem,4.7vw,4.5rem)/1.04 'Playfair Display',Georgia,serif; letter-spacing:-.012em; color:#fff; text-wrap:balance}
.hero2 h1 em{position:relative; display:inline-block; font-style:italic; font-weight:600; color:var(--gl); white-space:nowrap}
.hero2 h1 em::after{content:""; position:absolute; left:2%; right:2%; bottom:.04em; height:.07em; border-radius:2px; background:linear-gradient(90deg,var(--g),rgba(232,195,85,.15)); transform-origin:left; animation:h2draw 1.1s .9s cubic-bezier(.2,.7,.2,1) both}
@keyframes h2draw{from{transform:scaleX(0)}to{transform:scaleX(1)}}

.hero2 .h2-deva{margin:16px 0 0; font:400 clamp(1.05rem,1.55vw,1.32rem)/1.5 'Tiro Devanagari Marathi','Noto Serif Devanagari',Georgia,serif; color:rgba(232,195,85,.92); letter-spacing:.02em}
.hero2 .h2-lede{max-width:33em; margin:18px 0 26px; font:400 clamp(1rem,1.22vw,1.16rem)/1.72 'Inter',system-ui,sans-serif; color:rgba(255,255,255,.82)}

.hero2 .h2-actions{display:flex; flex-wrap:wrap; gap:14px; margin:0}
.hero2 .h2-find{display:inline-flex; align-items:center; gap:10px; margin-top:24px; font:500 .95rem/1.3 'Inter',system-ui,sans-serif; color:var(--gl); text-decoration:underline; text-decoration-color:rgba(232,195,85,.4); text-decoration-thickness:1px; text-underline-offset:.4em; transition:text-decoration-color .25s,gap .25s}
.hero2 .h2-find span{display:inline-block; animation:h2nudge 1.8s ease-in-out infinite}
.hero2 .h2-find:hover{text-decoration-color:var(--gl); gap:14px}
@keyframes h2nudge{50%{transform:translateY(4px)}}

.hero2 .h2-facts{list-style:none; display:flex; flex-wrap:wrap; gap:16px 34px; margin:30px 0 0; padding:20px 0 0; border-top:1px solid rgba(255,255,255,.13)}
.hero2 .h2-facts li{display:flex; flex-direction:column; gap:5px}
.hero2 .h2-facts small{font:600 .64rem/1 'Inter',system-ui,sans-serif; letter-spacing:.2em; text-transform:uppercase; color:var(--g)}
.hero2 .h2-facts span{font:500 .86rem/1.3 'Inter',system-ui,sans-serif; color:rgba(255,255,255,.86)}

/* portrait in an arched "courtroom window" frame */
.hero2 .h2-portrait{position:relative; margin:0; width:min(100%,456px); justify-self:end}
.hero2 .h2-frame{position:relative; aspect-ratio:4/5; border-radius:50% 50% 16px 16px / 40% 40% 16px 16px; overflow:visible; box-shadow:0 46px 90px -30px rgba(0,0,0,.65)}
.hero2 .h2-frame::before{content:""; position:absolute; inset:0; border-radius:inherit; border:1px solid rgba(232,195,85,.6); transform:translate(18px,18px); z-index:-1}
.hero2 .h2-frame img{position:absolute; inset:0; width:100%; height:100%; object-fit:cover; object-position:50% 20%; border-radius:inherit; filter:saturate(.96) contrast(1.03)}
.hero2 .h2-frame::after{content:""; position:absolute; inset:0; border-radius:inherit; background:linear-gradient(to top,rgba(7,17,42,.9) 0%,rgba(7,17,42,.35) 26%,transparent 46%); pointer-events:none}
.hero2 .h2-tag{position:absolute; left:0; right:0; bottom:26px; z-index:2; display:flex; flex-direction:column; align-items:center; gap:4px; text-align:center}
.hero2 .h2-tag strong{font:600 1.28rem/1.2 'Playfair Display',Georgia,serif; color:#fff}
.hero2 .h2-tag span{font:500 .7rem/1 'Inter',system-ui,sans-serif; letter-spacing:.18em; text-transform:uppercase; color:var(--gl)}

.hero2 .h2-chip{position:absolute; z-index:3; padding:12px 16px; border-radius:10px; background:rgba(13,27,62,.82); border:1px solid rgba(201,160,48,.42); backdrop-filter:blur(10px); -webkit-backdrop-filter:blur(10px); box-shadow:0 18px 40px -16px rgba(0,0,0,.6); animation:h2float 7s ease-in-out infinite alternate}
.hero2 .h2-chip small{display:block; margin-bottom:5px; font:600 .6rem/1 'Inter',system-ui,sans-serif; letter-spacing:.18em; text-transform:uppercase; color:var(--g)}
.hero2 .h2-chip b{display:block; font:600 .95rem/1.25 'Playfair Display',Georgia,serif; color:#fff}
.hero2 .h2-chip-a{left:-62px; bottom:21%}
.hero2 .h2-chip-b{right:-34px; top:19%; animation-delay:-3.2s}
@keyframes h2float{from{transform:translateY(-5px)}to{transform:translateY(6px)}}

/* load-in sequence */
.hero2 .h2-copy > *{opacity:0; transform:translateY(18px); animation:h2up .8s cubic-bezier(.2,.7,.2,1) forwards}
.hero2 .h2-copy{--stagger:.09s}
@supports (animation-delay: calc(sibling-index() * 0.1s)) {
  .hero2 .h2-copy > *{animation-delay:calc(sibling-index() * var(--stagger))}
}
@supports not (animation-delay: calc(sibling-index() * 0.1s)) {
  .hero2 .h2-copy > :nth-child(1){animation-delay:.05s}
  .hero2 .h2-copy > :nth-child(2){animation-delay:.14s}
  .hero2 .h2-copy > :nth-child(3){animation-delay:.24s}
  .hero2 .h2-copy > :nth-child(4){animation-delay:.34s}
  .hero2 .h2-copy > :nth-child(5){animation-delay:.44s}
  .hero2 .h2-copy > :nth-child(6){animation-delay:.54s}
  .hero2 .h2-copy > :nth-child(7){animation-delay:.62s}
  .hero2 .h2-copy > :nth-child(8){animation-delay:.72s}
}
.hero2 .h2-portrait{opacity:0; animation:h2rise 1.1s .25s cubic-bezier(.2,.7,.2,1) forwards}
@keyframes h2up{to{opacity:1; transform:none}}
@keyframes h2rise{from{opacity:0; transform:translateY(34px) scale(.985)} to{opacity:1; transform:none}}

/* ───────── situations ───────── */
.sit2{--g:#c9a030; --n:#0d1b3e; background:#f9f6f0; padding:clamp(64px,9vw,112px) 0 clamp(60px,8vw,96px); position:relative}
.sit2::before{content:""; position:absolute; left:0; right:0; top:0; height:1px; background:linear-gradient(90deg,transparent,rgba(201,160,48,.7),transparent)}
.sit2-head{max-width:760px; margin:0 0 clamp(34px,5vw,56px)}
.sit2-kicker{display:flex; align-items:center; gap:14px; margin:0 0 16px; font:600 .74rem/1 'Inter',system-ui,sans-serif; letter-spacing:.22em; text-transform:uppercase; color:var(--g)}
.sit2-kicker span{width:34px; height:1px; background:var(--g)}
.sit2 h2{margin:0; font:600 clamp(2rem,4vw,3.3rem)/1.08 'Playfair Display',Georgia,serif; color:var(--n); letter-spacing:-.01em; text-wrap:balance}
.sit2 h2 em{font-style:italic; color:var(--g)}
.sit2-sub{margin:18px 0 0; max-width:40em; font:400 1.05rem/1.7 'Inter',system-ui,sans-serif; color:#4b5563}

.sit2-grid{display:grid; grid-template-columns:repeat(4,minmax(0,1fr)); gap:20px}
.sit2-card{position:relative; display:flex; flex-direction:column; padding:30px 26px 26px; background:#fff; border:1px solid rgba(13,27,62,.1); border-radius:14px; text-decoration:none; color:inherit; overflow:hidden;
  transition:transform .35s cubic-bezier(.2,.7,.2,1), box-shadow .35s, border-color .35s}
.sit2-card::before{content:""; position:absolute; left:0; top:0; height:3px; width:0; background:linear-gradient(90deg,var(--g),#e8c355); transition:width .45s cubic-bezier(.2,.7,.2,1)}
.sit2-card:hover,.sit2-card:focus-visible{transform:translateY(-6px); box-shadow:0 26px 50px -24px rgba(13,27,62,.35); border-color:rgba(201,160,48,.55)}
.sit2-card:hover::before,.sit2-card:focus-visible::before{width:100%}
.sit2-card:focus-visible{outline:2px solid var(--g); outline-offset:3px}
.sit2-n{font:italic 600 2.5rem/1 'Playfair Display',Georgia,serif; color:rgba(201,160,48,.85); margin-bottom:18px}
.sit2-card h3{margin:0 0 12px; font:600 1.38rem/1.22 'Playfair Display',Georgia,serif; color:var(--n)}
.sit2-card p{margin:0 0 20px; font:400 .95rem/1.65 'Inter',system-ui,sans-serif; color:#4b5563; flex:1}
.sit2-go{display:flex; align-items:center; justify-content:space-between; padding-top:16px; border-top:1px solid rgba(13,27,62,.1); font:600 .78rem/1 'Inter',system-ui,sans-serif; letter-spacing:.12em; text-transform:uppercase; color:var(--n)}
.sit2-go b{font-weight:600; font-size:1.1rem; color:var(--g); transition:transform .3s}
.sit2-card:hover .sit2-go b{transform:translateX(5px)}
.sit2-card small{margin-top:12px; min-height:2.8em; font:500 .72rem/1.4 'Inter',system-ui,sans-serif; color:#8a8f98; letter-spacing:.02em}

.sit2-more{display:flex; flex-wrap:wrap; align-items:center; gap:10px 22px; margin:clamp(30px,4vw,46px) 0 0; padding-top:24px; border-top:1px solid rgba(13,27,62,.12); font:400 .92rem/1.4 'Inter',system-ui,sans-serif; color:#4b5563}
.sit2-more span{font-weight:600; color:var(--n)}
.sit2-more a{color:var(--n); text-decoration:underline; text-decoration-color:rgba(201,160,48,.6); text-decoration-thickness:1px; text-underline-offset:.3em; transition:color .2s,text-decoration-color .2s}
.sit2-more a:hover{color:#a07820; text-decoration-color:#a07820}

/* scroll reveal: CSS scroll-driven animation where supported */
@supports (animation-timeline: view()) {
  .sit2-card{animation:sit2-in linear both; animation-timeline:view(); animation-range:entry 4% entry 38%}
  @keyframes sit2-in{from{opacity:0; transform:translateY(26px)}}
}
/* fallback (only when JS adds .h2-js because scroll-driven animations are unsupported) */
.h2-js .sit2-card{opacity:0; transform:translateY(24px)}
.h2-js .sit2-card.is-in{opacity:1; transform:none; transition:opacity .7s ease, transform .7s cubic-bezier(.2,.7,.2,1), box-shadow .35s, border-color .35s}
.h2-js .sit2-card.is-in:hover{transform:translateY(-6px)}

/* ───────── responsive ───────── */
@media (max-width:1280px){
  .hero2 .h2-chip-a{left:-34px}
  .hero2 .h2-chip-b{right:-6px}
}
@media (max-width:1100px){
  .sit2-grid{grid-template-columns:repeat(2,minmax(0,1fr))}
  .hero2 .h2-chip-a{left:-26px}
  .hero2 .h2-chip-b{right:-14px}
}
@media (max-width:900px){
  .hero.hero2{min-height:0; padding:112px 0 64px}
  .hero2 .h2-wrap{grid-template-columns:1fr; gap:46px}
  .hero2 .h2-portrait{justify-self:center; width:min(86%,380px); margin-top:4px}
  .hero2 .h2-arches{right:50%; transform:translate(50%,-30%); top:62%; width:min(120vw,620px); opacity:.55}
  .hero2 .h2-mark{font-size:clamp(150px,44vw,260px); bottom:-3vw}
  .hero2 .h2-chip-a{left:-12px; bottom:20%}
  .hero2 .h2-chip-b{right:-12px; top:16%}
}
@media (max-width:560px){
  .hero2 .h2-status{font-size:.62rem; letter-spacing:.1em; padding:8px 12px}
  .hero2 .h2-eyebrow{font-size:.68rem; letter-spacing:.16em; margin-top:20px}
  .hero2 h1{font-size:clamp(2.3rem,10.4vw,3rem)}
  .hero2 .h2-actions .btn{width:100%; justify-content:center}
  .hero2 .h2-facts{gap:14px 24px}
  .hero2 .h2-chip{padding:10px 12px}
  .hero2 .h2-chip b{font-size:.84rem}
  .sit2-grid{grid-template-columns:1fr}
  .sit2-card{padding:26px 22px 22px}
}
@media (prefers-reduced-motion:reduce){
  .hero2 *,.sit2 *{animation:none!important; transition:none!important}
  .hero2 .h2-copy > *,.hero2 .h2-portrait{opacity:1; transform:none}
  .h2-js .sit2-card{opacity:1; transform:none}
}
AKC_CSS;
        $js = <<<'AKC_JS'
(function () {
  'use strict';
  var root = document.documentElement;

  /* Office-hours pill: Mon-Sat 10:00-19:00 India time. Falls back to the static text if Intl is unavailable. */
  try {
    var pill = document.getElementById('h2-status');
    var txt = document.getElementById('h2-status-text');
    if (pill && txt && window.Intl && Intl.DateTimeFormat) {
      var parts = new Intl.DateTimeFormat('en-GB', {
        timeZone: 'Asia/Kolkata', weekday: 'short', hour: 'numeric', minute: 'numeric', hour12: false
      }).formatToParts(new Date());
      var get = function (t) { var p = parts.filter(function (x) { return x.type === t; })[0]; return p ? p.value : ''; };
      var day = get('weekday');
      var mins = (parseInt(get('hour'), 10) % 24) * 60 + parseInt(get('minute'), 10);
      var order = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
      var di = order.indexOf(day);
      if (di > -1) {
        var working = di <= 5;
        if (working && mins >= 600 && mins < 1140) {
          pill.setAttribute('data-state', 'open');
          txt.textContent = 'Office open now · until 7 PM';
        } else {
          pill.setAttribute('data-state', 'closed');
          var next;
          if (working && mins < 600) { next = 'today 10 AM'; }
          else if (di === 5 || di === 6) { next = 'Monday 10 AM'; }
          else { next = 'tomorrow 10 AM'; }
          txt.textContent = 'Office closed · opens ' + next;
        }
      }
    }
  } catch (e) { /* keep static text */ }

  /* Scroll reveal for the situation cards. Cards stay visible if JS or IntersectionObserver is missing. */
  try {
    var cards = document.querySelectorAll('.sit2-card');
    if (cards.length && 'IntersectionObserver' in window && !(window.CSS && CSS.supports && CSS.supports('animation-timeline: view()')) &&
        !(window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches)) {
      root.classList.add('h2-js');
      var io = new IntersectionObserver(function (entries) {
        entries.forEach(function (en) {
          if (en.isIntersecting) {
            var el = en.target;
            var i = Array.prototype.indexOf.call(cards, el);
            el.style.transitionDelay = (i % 4) * 90 + 'ms';
            el.classList.add('is-in');
            io.unobserve(el);
          }
        });
      }, { threshold: 0.15, rootMargin: '0px 0px -40px 0px' });
      cards.forEach(function (c) { io.observe(c); });
    }
  } catch (e) { /* cards remain visible */ }

  /* Smooth scroll to #situations, leaving room for the fixed navbar. */
  var find = document.querySelector('.h2-find');
  if (find) {
    find.addEventListener('click', function (ev) {
      var target = document.getElementById('situations');
      if (!target) { return; }
      ev.preventDefault();
      var y = target.getBoundingClientRect().top + window.pageYOffset - 70;
      window.scrollTo({ top: y, behavior: 'smooth' });
    });
  }
})();
AKC_JS;

        $out = substr( $html, 0, $start ) . $hero . substr( $html, $end );

        $fonts = '<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Tiro+Devanagari+Marathi:ital@0;1&display=swap">';
        $out   = str_replace( '</head>', $fonts . '<style id="akc-home-v2-css">' . $css . '</style></head>', $out, $c1 );
        $out   = str_replace( '</body>', '<script id="akc-home-v2-js">' . $js . '</script></body>', $out, $c2 );
        if ( ! $c1 || ! $c2 ) { return $html; }

        if ( AKC_HOME_COPY_FIXES ) {
            $fixes = array(
        array('Available for Bail Emergencies 24/7', 'Phone and WhatsApp, Mon–Sat 10 AM–7 PM'),
        array('Fill the form below — messages are answered the same day.', 'Fill the form below. The office replies during working hours.'),
        array('<p>Every legal matter has a solution. Get a confidential consultation', '<p>Get a confidential consultation'),
        array('<h4>Vigorous Representation</h4>', '<h4>Representation in Court</h4>'),
        array('I fight for your rights with full commitment — in court, in negotiations, and at every step of the legal process.', 'Your matter is presented before the court at each stage, on your instructions and on the facts of the case.'),
        array('<h4>Available When It Matters Most</h4>', '<h4>Contact Hours</h4>'),
        array('Legal emergencies don\'t follow office hours. I\'m reachable when you need me most, including bail emergencies.', 'The office is open Monday to Saturday, 10 AM to 7 PM. Call or WhatsApp to arrange a consultation.'),
        array('You deal directly with me — not a junior. Your case gets the focus it deserves at every stage.', 'You deal directly with the advocate handling your matter, and each stage is explained in plain language.'),
        array('Every client receives my personal attention, honest assessment, and relentless advocacy — not just a case number.', 'Every matter is handled personally, with an honest assessment of the legal position and a clear explanation at each stage.'),
        array('<div class="section-label">Why Choose Me</div>', '<div class="section-label">How the Practice Works</div>'),
        array('Emergency bail at Sessions Court &amp; Bombay High Court. S.483 BNSS bail applications handled urgently for all offences.', 'Regular bail after arrest at the Sessions Court, Pune and the Bombay High Court, Mumbai. Sections 480 and 483 BNSS.')
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

add_action( 'template_redirect', function () {
    if ( is_admin() || is_feed() || is_preview() || ! is_front_page() ) { return; }
    ob_start( 'akc_home_v2_filter' );
}, 20 );
