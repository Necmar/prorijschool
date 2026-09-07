# Nederlandse publieke pagina's

De sitegenerator maakt 21 losse Elementor-pagina's. Elke pagina gebruikt native containers en widgets, één H1, eigen inhoud en mobiele kolominstellingen. Er worden geen HTML-widgets gebruikt.

## Paginastructuur

- Diensten: Autorijles, Automaat rijles, Taxilessen en Aanhangwagenrijlessen.
- Theorie: overzicht, Online theorie en Fysieke theoriecursus.
- Conversie: Pakketten en prijzen, Proefles, Online inschrijven en Contact.
- Vertrouwen: Over Prorijschool en Veelgestelde vragen.
- Vindbaarheid: Blog en unieke pagina's voor Badhoevedorp, Hoofddorp en Vijfhuizen.
- Service: Inloggen, Privacyverklaring, Algemene voorwaarden en Cookiebeleid.

De bron staat in `scripts/build-site-pages.cjs`. Uitvoer staat onder `wp-content/themes/prorijschool-child/assets/templates/pages/`. Het manifest bepaalt welke pagina's de eenmalige, idempotente WordPress-migratie aanmaakt of bijwerkt.

## Elementor en performance

Alle zichtbare inhoud blijft via Elementor bewerkbaar. De templates gebruiken Flexbox-containers, Heading, Button en Elementor Pro Form. Gedeelde kleuren, typografie, knoppen en kaarten komen uit het child theme. Een pagina laadt alleen zijn eigen Elementor-data; de 21 JSON-bronbestanden worden niet naar bezoekers gestuurd.

## Tijdelijke inhoud

Prijzen, contactgegevens, cursusdata, reviews en voorwaarden zijn ontwerpgegevens. Formulieren bewaren inzendingen in Elementor. E-mailacties worden pas geactiveerd nadat afzender, ontvanger en SMTP zijn getest. De inlogpagina beschrijft de toekomstige CRM-omgeving zonder functies als beschikbaar te presenteren.

## Publicatie

Na deploy voert het child theme de migratie uit bij het eerstvolgende beheerdersbezoek. Bestaande pagina's met dezelfde slug worden bijgewerkt; ontbrekende pagina's worden gepubliceerd. Ook worden de hoofdnavigatie en blogcategorieën aangemaakt. HomepageV2 blijft afzonderlijk bestaan en wordt niet automatisch als voorpagina ingesteld.

De demosite krijgt via het child theme altijd `noindex, nofollow`. Op het latere productiedomein blijven de normale WordPress- en SEO-plugininstellingen leidend.
