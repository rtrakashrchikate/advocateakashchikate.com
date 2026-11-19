const { chromium } = require('playwright');
(async()=>{const b=await chromium.launch();const p=await b.newPage({viewport:{width:1200,height:900},deviceScaleFactor:2});
await p.goto('file://'+process.cwd()+'/poster.html',{waitUntil:'networkidle'}); await p.evaluate(()=>document.fonts.ready); await p.waitForTimeout(800);
const o=await p.evaluate(()=>{const r=[];for(const e of document.querySelectorAll('.l *,.tag *,.foot *')){const b=e.getBoundingClientRect();if(b.right>1200||b.bottom>900)r.push(e.className||e.tagName)};return {over:r,fonts:[...document.fonts].filter(f=>f.status==='loaded').map(f=>f.family).filter((v,i,a)=>a.indexOf(v)===i)}});
console.log(JSON.stringify(o));
await p.screenshot({path:'gbp-fir-poster.png'});await p.screenshot({path:'check-fir-online-maharashtra-poster.jpg',type:'jpeg',quality:90});await b.close();})();
