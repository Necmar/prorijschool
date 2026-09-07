const fs = require('node:fs');
const path = require('node:path');

const root = path.join('wp-content', 'themes', 'prorijschool-child', 'assets', 'templates', 'pages');
const manifest = JSON.parse(fs.readFileSync(path.join(root, 'manifest.json'), 'utf8'));
const errors = [];
const report = [];

for (const definition of manifest.pages) {
  const file = path.join(root, definition.template);
  if (!fs.existsSync(file)) {
    errors.push(`${definition.slug}: template ontbreekt`);
    continue;
  }
  const template = JSON.parse(fs.readFileSync(file, 'utf8'));
  const elements = [];
  const walk = (items) => items.forEach((element) => { elements.push(element); walk(element.elements || []); });
  walk(template.content || []);
  const headings = elements.filter((element) => element.widgetType === 'heading');
  const h1 = headings.filter((element) => element.settings.header_size === 'h1');
  const htmlWidgets = elements.filter((element) => element.widgetType === 'html');
  const forms = elements.filter((element) => element.widgetType === 'form');
  const mobileWidths = elements.filter((element) => element.elType === 'container' && element.settings.width && !element.settings.width_mobile);

  if ((template.content || []).length < 2) errors.push(`${definition.slug}: te weinig secties`);
  if (h1.length !== 1) errors.push(`${definition.slug}: verwacht 1 H1, gevonden ${h1.length}`);
  if (htmlWidgets.length) errors.push(`${definition.slug}: HTML-widget gevonden`);
  if (mobileWidths.length) errors.push(`${definition.slug}: ${mobileWidths.length} kolommen zonder mobiele breedte`);
  if (['proefles', 'inschrijven', 'contact'].includes(definition.slug) && forms.length !== 1) errors.push(`${definition.slug}: verwacht 1 formulier`);

  report.push({ slug: definition.slug, sections: template.content.length, elements: elements.length, h1: h1.length, forms: forms.length, htmlWidgets: htmlWidgets.length });
}

const expected = ['autorijles', 'automaat-rijles', 'taxilessen', 'aanhangwagenrijlessen', 'theorie', 'online-theorie', 'theoriecursus', 'pakketten', 'proefles', 'inschrijven', 'over-prorijschool', 'contact', 'veelgestelde-vragen', 'blog', 'inloggen', 'rijschool-badhoevedorp', 'rijschool-hoofddorp', 'rijschool-vijfhuizen', 'privacyverklaring', 'algemene-voorwaarden', 'cookiebeleid'];
for (const slug of expected) if (!manifest.pages.some((page) => page.slug === slug)) errors.push(`${slug}: ontbreekt in manifest`);

fs.mkdirSync('artifacts', { recursive: true });
fs.writeFileSync('artifacts/site-pages-checks.json', JSON.stringify({ manifestVersion: manifest.version, pages: report, errors }, null, 2));
console.log(JSON.stringify({ pages: report.length, errors }, null, 2));
if (errors.length) process.exitCode = 1;
