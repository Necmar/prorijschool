const {chromium}=require('C:/Users/Necip/.cache/codex-runtimes/codex-primary-runtime/dependencies/node/node_modules/playwright');
const fs=require('node:fs');
(async()=>{
 const b=await chromium.launch({headless:true,executablePath:'C:/Program Files/Google/Chrome/Application/chrome.exe'});const p=await b.newPage();
 await p.goto('https://prorijschool.necmardemo.nl/',{waitUntil:'networkidle'});await p.locator('#intro').waitFor();
 const results=[];
 for(const width of [320,390,768,1024,1440]){
  await p.setViewportSize({width,height:1000});await p.evaluate(()=>document.fonts.ready);
  const r=await p.evaluate(()=>({width:innerWidth,scrollWidth:document.documentElement.scrollWidth,h1:[...document.querySelectorAll('h1')].filter(e=>e.getBoundingClientRect().height).map(e=>e.innerText),sections:['intro','opleidingen','werkwijze','pakketten','theorie','regio','vragen','aanvraag'].filter(id=>document.getElementById(id)),htmlWidgets:document.querySelectorAll('.elementor-10 .elementor-widget-html').length,form:!!document.querySelector('#aanvraag form'),brokenImages:[...document.querySelectorAll('#intro img')].filter(i=>!i.complete||!i.naturalWidth).length,overflow:[...document.querySelectorAll('.elementor-10 *')].filter(e=>e.getBoundingClientRect().width&& (e.getBoundingClientRect().right>innerWidth+1||e.getBoundingClientRect().left< -1)).map(e=>e.className).slice(0,12)}));results.push(r);
  await p.screenshot({path:`artifacts/homepage-${width}.png`,fullPage:true});
  for(const sel of ['intro','opleidingen','aanvraag'])await p.locator('#'+sel).screenshot({path:`artifacts/homepage-${sel}-${width}.png`});
 }
 fs.writeFileSync('artifacts/homepage-checks.json',JSON.stringify(results,null,2));console.log(JSON.stringify(results));await b.close();
 if(results.some(r=>r.scrollWidth>r.width||r.h1.length!==1||r.sections.length!==8||r.htmlWidgets||!r.form||r.brokenImages||r.overflow.length))process.exitCode=1;
})().catch(e=>{console.error(e);process.exitCode=1});
