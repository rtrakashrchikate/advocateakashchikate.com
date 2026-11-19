const { chromium } = require('playwright'); const fs=require('fs');
const P=JSON.parse(fs.readFileSync('products.json','utf8'));
(async()=>{const b=await chromium.launch();const p=await b.newPage({viewport:{width:1200,height:1200},deviceScaleFactor:1});
await p.goto('file://'+process.cwd()+'/card.html',{waitUntil:'networkidle'});await p.evaluate(()=>document.fonts.ready);
const issues=[];
for(const [i,x] of P.entries()){await p.evaluate(x=>fill(x),x);await p.waitForTimeout(120);
 const m=await p.evaluate(()=>{const r=e=>e.getBoundingClientRect();const mid=(()=>{const els=[...document.querySelectorAll('.mid > *')];return {bottom:Math.max(...els.map(e=>e.getBoundingClientRect().bottom))}})(),foot=r(document.querySelector('.foot'));
  return {overlap:mid.bottom>foot.top-20,midBottom:Math.round(mid.bottom),footTop:Math.round(foot.top),fs:getComputedStyle(document.getElementById('t')).fontSize}});
 if(m.overlap) issues.push([x.slug,m]);
 await p.screenshot({path:`out/${String(i+1).padStart(2,'0')}-${x.slug}.jpg`,type:'jpeg',quality:88});}
console.log('issues',JSON.stringify(issues));await b.close();})();
