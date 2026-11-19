const { chromium } = require('playwright');
(async()=>{const b=await chromium.launch();const p=await b.newPage({viewport:{width:1200,height:900},deviceScaleFactor:2});
for(const f of ['p1-hc','p2-sc','p3-office']){await p.goto('file://'+process.cwd()+'/'+f+'.html',{waitUntil:'networkidle'});await p.evaluate(()=>document.fonts.ready);await p.waitForTimeout(500);
const m=await p.evaluate(()=>({l:Math.round(document.querySelector('.l').getBoundingClientRect().bottom),f:Math.round(document.querySelector('.foot').getBoundingClientRect().top)}));console.log(f,JSON.stringify(m));
await p.screenshot({path:f+'.jpg',type:'jpeg',quality:90});}
await b.close();})();
