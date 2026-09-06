const {chromium} = require('C:/Users/Necip/.cache/codex-runtimes/codex-primary-runtime/dependencies/node/node_modules/playwright');
const fs = require('node:fs');
(async()=>{
 const browser=await chromium.launch({headless:true,executablePath:'C:/Program Files/Google/Chrome/Application/chrome.exe'});
 const page=await browser.newPage();
 await page.goto('https://prorijschool.necmardemo.nl/',{waitUntil:'networkidle'});
 await page.locator('.elementor-36.elementor-location-footer').waitFor();
 const results=[];
 for (const width of [320,390,600,768,1024,1440]){
  await page.setViewportSize({width,height:1000});
  await page.evaluate(()=>document.fonts.ready);
  const result=await page.evaluate(()=>{
   const f=document.querySelector('.elementor-36.elementor-location-footer');
   const cta=[...f.querySelectorAll('a')].find(a=>a.textContent.includes('Plan mijn proefles'));
   return {width:innerWidth,documentWidth:document.documentElement.scrollWidth,footerWidth:f.getBoundingClientRect().width,ctaHeight:cta?.getBoundingClientRect().height||0,oldPlaces:/Badhoevedorp|Hoofddorp|Vijfhuizen/.test(f.innerText),htmlWidgets: f.querySelectorAll('.elementor-widget-html').length,overflow:[...f.querySelectorAll('*')].filter(e=>e.getBoundingClientRect().right>innerWidth+.5||e.getBoundingClientRect().left<-.5).map(e=>e.className)};
  });
  results.push(result);
  await page.locator('.elementor-36.elementor-location-footer').screenshot({path:`artifacts/footer-native-${width}.png`});
 }
 await page.getByRole('link',{name:/Terug naar boven/}).click();
 const backToTop=await page.evaluate(()=>scrollY===0);
 fs.writeFileSync('artifacts/footer-checks.json',JSON.stringify({results,backToTop},null,2));
 console.log(JSON.stringify({results,backToTop}));
 await browser.close();
 if(results.some(r=>r.width!==r.documentWidth||r.oldPlaces||r.htmlWidgets||r.overflow.length||r.ctaHeight<44)||!backToTop)process.exitCode=1;
})().catch(e=>{console.error(e);process.exitCode=1});
