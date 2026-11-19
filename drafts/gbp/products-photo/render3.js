const { chromium } = require('playwright'); const fs=require('fs');
const P=JSON.parse(fs.readFileSync(process.env.PRODUCTS||'../products/products.json','utf8'));
const CROP={'07':{l:.129,t:.2,s:.742},'08':{l:.03,t:.03,s:.94},'16':{l:.1,t:0,s:.8},'23':{l:0,t:0,s:.82}};
const only=process.argv[2]?process.argv[2].split(','):null;
(async()=>{const b=await chromium.launch();const p=await b.newPage({viewport:{width:1200,height:1200}});
await p.goto('file://'+process.cwd()+'/card3.html',{waitUntil:'networkidle'});await p.evaluate(()=>document.fonts.ready);
const report=[];
for(const [i,x] of P.entries()){const n=String(i+1).padStart(2,'0'); if(only&&!only.includes(n))continue;
 await p.evaluate(async x=>{await fill(x)},{...x,img:'img/'+n+'.png',crop:CROP[n]});await p.waitForTimeout(80);
 const m=await p.evaluate(()=>{const r=e=>document.querySelector(e).getBoundingClientRect();const h=document.getElementById('t');
  return {top:Math.round(r('.txt').top),bot:Math.round(r('.txt').bottom),foot:Math.round(r('.foot').top),fs:parseInt(getComputedStyle(h).fontSize),lines:Math.round(h.scrollHeight/(parseFloat(getComputedStyle(h).fontSize)*1.04))}});
 report.push(n+' '+x.slug+' '+JSON.stringify(m)+((m.bot>m.foot-20||m.lines>2)?' <<BAD':''));
 await p.screenshot({path:`out/${n}-${x.slug}.jpg`,type:'jpeg',quality:90});}
console.log(report.join('\n'));await b.close();})();
