const { chromium } = require('C:/Users/Necip/.cache/codex-runtimes/codex-primary-runtime/dependencies/node/node_modules/playwright');
const fs = require('node:fs');

(async () => {
  const browser = await chromium.launch({
    headless: true,
    executablePath: 'C:/Program Files/Google/Chrome/Application/chrome.exe',
  });
  const page = await browser.newPage();
  const results = [];

  for (const width of [320, 390, 768, 1024, 1440]) {
    await page.setViewportSize({ width, height: 1000 });
    await page.goto(`https://prorijschool.necmardemo.nl/homepagev2/?qa=${width}`, {
      waitUntil: 'networkidle',
    });
    await page.evaluate(() => document.fonts.ready);

    const result = await page.evaluate(() => {
      const content = document.querySelector('.elementor-72');
      const visibleH1 = [...document.querySelectorAll('h1')]
        .filter((element) => element.getBoundingClientRect().height > 0)
        .map((element) => element.innerText.trim());
      const requiredHeadings = [
        'Over drie maanden rij jij zelf.',
        'Kies je opleiding',
        'Pakketten en prijzen',
        'Veelgestelde vragen',
        'Klaar om te beginnen?',
      ];
      const pageText = content?.innerText || '';
      const overflow = content
        ? [...content.querySelectorAll('*')]
            .filter((element) => {
              const rect = element.getBoundingClientRect();
              return rect.width > 0 && (rect.right > innerWidth + 1 || rect.left < -1);
            })
            .map((element) => element.className || element.tagName)
            .slice(0, 12)
        : ['missing .elementor-72'];

      return {
        width: innerWidth,
        scrollWidth: document.documentElement.scrollWidth,
        h1: visibleH1,
        nativeV4Elements: content?.querySelectorAll('.elementor-element').length || 0,
        htmlWidgets: content?.querySelectorAll('.elementor-widget-html').length || 0,
        header: Boolean(document.querySelector('header, [data-elementor-type="header"]')),
        footer: Boolean(document.querySelector('footer, [data-elementor-type="footer"]')),
        requiredHeadings: requiredHeadings.filter((heading) => pageText.includes(heading)),
        overflow,
      };
    });

    results.push(result);
    await page.screenshot({ path: `artifacts/homepage-v2-${width}.png`, fullPage: true });
  }

  fs.writeFileSync('artifacts/homepage-v2-checks.json', JSON.stringify(results, null, 2));
  console.log(JSON.stringify(results, null, 2));
  await browser.close();

  const failed = results.some(
    (result) =>
      result.scrollWidth > result.width ||
      result.h1.length !== 1 ||
      result.h1[0] !== 'Over drie maanden rij jij zelf.' ||
      result.nativeV4Elements === 0 ||
      result.htmlWidgets !== 0 ||
      !result.header ||
      !result.footer ||
      result.requiredHeadings.length !== 5 ||
      result.overflow.length > 0,
  );
  if (failed) process.exitCode = 1;
})().catch((error) => {
  console.error(error);
  process.exitCode = 1;
});
