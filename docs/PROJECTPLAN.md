# Prorijschool

**Volledig projectplan en technische architectuur**
Versie 1.0

---

## Projectdoel

Prorijschool wordt een moderne rijschoolwebsite met later een eigen digitaal platform voor leerlingen, instructeurs en beheer. De ontwikkeling verloopt bewust in fases. Eerst komt de publieke website. Daarna volgen leerlingomgeving, instructeursomgeving, planning, administratie, voortgang, theorie en betalingen.

De publieke website draait op WordPress met Elementor. De portaalomgeving wordt later als aparte webapp gebouwd. De volledige omgeving wordt eerst lokaal ontwikkeld op een Windows-laptop met Docker Desktop. Productiehosting komt op shared hosting van Cloud86.

De technische keuzes moeten passen binnen shared hosting. De software krijgt dus geen verplichte afhankelijkheid van een eigen VPS, permanent draaiende Node-server, Redis-server, Docker op productie of andere serverdiensten waarvoor root-toegang nodig is.

---

## 1. Hoofddoelen

Prorijschool moet bezoekers snel laten begrijpen:

- Welke rijopleidingen beschikbaar zijn
- Wat lessen en pakketten kosten
- Welke soorten lessen beschikbaar zijn
- In welke regio Prorijschool actief is
- Welke talen beschikbaar zijn
- Hoe een proefles aangevraagd wordt
- Hoe iemand zich inschrijft
- Hoe contact via WhatsApp verloopt
- Hoe bestaande leerlingen inloggen

De uitstraling wordt premium, rustig en professioneel. Veel fotografie. Korte teksten. Ruime vlakken. Duidelijke knoppen.

Niet: drukke rijschoolstijl, overmatig gebruik van iconen, lange tekstblokken op de homepage. Mobiele bezoekers staan centraal.

## 2. Bedrijfsnaam

Prorijschool

## 3. Primaire regio

- Badhoevedorp
- Hoofddorp
- Vijfhuizen

Deze locaties krijgen een prominente rol binnen website, SEO en lokale landingspagina's.

## 4. Talen

Website en portaal ondersteunen Nederlands, Engels en Turks. Standaardtaal is Nederlands.

URL-structuur website:

- `prorijschool.nl/`
- `prorijschool.nl/en/`
- `prorijschool.nl/tr/`

De Nederlandse website wordt als eerste volledig gebouwd. Pas na goedkeuring volgt vertaling naar Engels en Turks.

## 5. Diensten

- Autorijles met handgeschakelde auto
- Automaat rijles
- Taxilessen
- Aanhangwagenrijlessen
- Fysieke theoriecursussen
- Online theorie
- Rijlessen in het Nederlands
- Rijlessen in het Engels
- Rijlessen in het Turks

## 6. Lesduur

Leerlingen krijgen keuze uit 60, 90 en 120 minuten.

Administratief wordt lestegoed bij voorkeur in minuten opgeslagen.

Voorbeeld: een pakket bevat 1.200 minuten. Een les duurt 90 minuten. Na afronding blijft 1.110 minuten over. Hierdoor ontstaan geen problemen wanneer een leerling verschillende lesduren combineert.

## 7. Producten en pakketten

Drie commerciële hoofdvormen: losse rijles, rittenkaart, compleet pakket.

Voor ieder type opleiding zijn aparte producten mogelijk. Voorbeelden:

- Losse autorijles
- Losse automaatles
- 10 uur rijles
- 20 uur rijles
- 30 uur rijles
- Compleet rijlespakket
- Taxipakket
- Aanhangwagenpakket
- Theoriepakket
- Combinatiepakket praktijk en theorie

## 8. Transparante prijzen

Prijzen worden vooraf duidelijk getoond. Geen kortingscodes. Geen tijdelijke acties achteraf. Geen willekeurige kortingen vanuit instructeur.

Wanneer een pakket een financieel voordeel bevat, staat dit vooraf bij het pakket.

Voorbeeld:

| Onderdeel | Bedrag |
| --- | --- |
| Waarde losse onderdelen | € 2.150 |
| Pakketprijs | € 1.995 |
| Pakketvoordeel | € 155 |

De bezoeker ziet vooraf: prijs, aantal lesuren, lesduur, inbegrepen examen, inbegrepen theorie, eventuele tussentijdse toets, eventuele gezondheidsverklaring, eventuele CBR-kosten, betaalmogelijkheden en aantal termijnen.

## 9. Betalingen

Eerste versie ondersteunt bankoverschrijving en contante betaling. Online betaling volgt later.

## 10. Termijnbetalingen

Een pakket wordt indien gewenst verdeeld over maximaal vier termijnen, met een maximale looptijd van vier maanden.

Voorbeeld: pakketprijs € 2.000, vier termijnen van € 500.

Leerling ziet vooraf: totaalbedrag, betaald bedrag, openstaand bedrag, termijnbedrag, vervaldatum, betaaldatum, betaalmethode en betaalstatus.

## 11. Wero

Wanneer online betalingen later toegevoegd worden, krijgt Wero voorkeur. De betaalarchitectuur wordt provider-onafhankelijk opgezet.

Interne betaalmethodes krijgen codes zoals `CASH`, `BANK_TRANSFER`, `WERO`. Hierdoor blijft de administratie gelijk wanneer later een betaalprovider toegevoegd of vervangen wordt.

## 12. Online inschrijven

Bezoekers krijgen een aparte inschrijfpagina. Een bezoeker kiest eerst een opleiding: autorijles, automaat, taxi, aanhanger of theorie. Daarna verschijnen relevante invoervelden.

Basisgegevens: voornaam, achternaam, geboortedatum, e-mailadres, telefoonnummer, adres, postcode, woonplaats, voorkeurstaal, gewenste opleiding, voorkeursdagen, voorkeurstijden, eventuele rijervaring, opmerkingen, akkoord privacyvoorwaarden.

Na verzending ontvangt Prorijschool een melding. De toekomstige portaalomgeving maakt vervolgens een leerlingprofiel aan na goedkeuring door beheer.

## 13. Proefles

Naast volledige inschrijving komt een eenvoudiger proeflesformulier.

Velden: naam, telefoonnummer, e-mailadres, woonplaats, type rijles, handgeschakeld of automaat, voorkeurstaal, voorkeursdag, voorkeursmoment, opmerking.

Bezoeker krijgt twee duidelijke mogelijkheden: proefles aanvragen via formulier, of contact opnemen via WhatsApp.

## 14. WhatsApp

WhatsApp wordt prominent aangeboden.

Desktop: WhatsApp-knop in header of duidelijke CTA, contactgedeelte, contactpagina.

Mobiel: vaste WhatsApp-actie binnen mobiele navigatie of onderste actiebalk.

Tijdens de eerste fase dient WhatsApp vooral voor persoonlijk contact. Automatische WhatsApp-berichten volgen eventueel later.

## 15. E-mail

E-mail wordt gebruikt voor belangrijke gebeurtenissen:

- Nieuwe inschrijving ontvangen
- Proeflesaanvraag ontvangen
- Les bevestigd, gewijzigd of geannuleerd
- Nieuwe afspraak ingepland
- Betaling geregistreerd
- Termijn nadert of is verlopen
- Pakket toegewezen
- Lestegoed raakt laag
- Theoriecursus geboekt
- Account aangemaakt
- Wachtwoord herstellen

Geen e-mail bij iedere kleine interne wijziging.

## 16. Planning

De hoofdwerkwijze rond rijlessen is persoonlijk. Instructeur en leerling plannen tijdens of na de rijles samen de volgende afspraak.

De instructeur opent planning, kiest leerling, datum, tijd, lesduur en voertuig. De afspraak wordt opgeslagen en de leerling ziet die direct terug in het portaal.

## 17. Lesaanvraag door leerling

Leerling krijgt daarnaast de mogelijkheid zelf een nieuwe les aan te vragen door datum, beschikbaar tijdstip, lesduur en eventueel gewenste instructeur te selecteren.

De aanvraag krijgt status **Aangevraagd**. Instructeur of admin beoordeelt de aanvraag en kan bevestigen, een ander moment voorstellen of afwijzen. Pas na bevestiging krijgt de afspraak definitieve status.

## 18. Instructeur plannen

Admin en sub-admin zien beschikbaarheid van instructeurs. Bij het plannen worden gecontroleerd: beschikbaarheid instructeur, beschikbaarheid voertuig, beschikbaarheid leerling, lesduur en reistijd indien dit later nodig blijkt.

Dubbele planning wordt geblokkeerd.

## 19. Annuleringsregel

Leerling heeft recht op kosteloze annulering tot 24 uur voor de geplande les.

- **24 uur of langer vooraf:** geen kosten, lestegoed blijft gelijk
- **Binnen 24 uur:** les wordt volgens ingestelde regel berekend

Admin krijgt mogelijkheid voor uitzondering, bijvoorbeeld bij ziekte, overmacht of een afspraak die vanuit Prorijschool gewijzigd is.

Iedere annulering wordt opgeslagen met: datum, tijd, leerling, les, reden, wie annuleerde, wel of niet berekend, en wie eventuele uitzondering heeft toegevoegd.

## 20. Voertuigen

Per voertuig wordt opgeslagen: kenteken, merk, model, type, handgeschakeld of automaat, gebruik voor auto/taxi/aanhanger, actief of niet actief, eventuele vaste instructeur, notities en agenda.

Een voertuig mag tijdens hetzelfde tijdslot slechts één actieve afspraak hebben.

## 21. Website-architectuur

Publieke website: `prorijschool.nl`

Techniek: WordPress, Elementor, Elementor Pro, MySQL of MariaDB, meertalige WordPress-oplossing, SEO-plugin, caching, beveiliging, back-up.

De website blijft technisch gescheiden van het toekomstige portaal.

## 22. Portaal-architectuur

Portaal: `mijn.prorijschool.nl`

Voorkeursrichting: Laravel, PHP, MySQL of MariaDB, HTML, CSS en moderne JavaScript waar nodig. Geen verplichte Node-server op productie.

Laravel wordt vooral gekozen vanwege aansluiting op shared hosting en geschiktheid voor authenticatie, rollen, planning, facturatie, pakketten, theorie, voortgang, administratie en API-koppelingen.

## 23. Toekomstige API

Later krijgt het project een interne API-structuur, bijvoorbeeld `api.prorijschool.nl` of API-routes binnen Laravel.

De API dient onder andere voor website-inschrijvingen, planning, betalingen, theorie, e-mail, WhatsApp, Wero, externe theoriebedrijven en toekomstige mobiele toepassingen.

## 24. Lokale ontwikkelomgeving

Ontwikkeling vindt eerst plaats op de lokale laptop. Docker Desktop verzorgt lokale services.

Voor WordPress: WordPress-container, MariaDB-container, eventueel phpMyAdmin, lokale bestanden, lokale uploads, lokale database.

Voor het portaal later: Laravel, PHP, Composer, MySQL of MariaDB, mail-testomgeving, Git.

## 25. Productiehosting

Productie komt op shared hosting van Cloud86. De architectuur houdt rekening met shared-hostingbeperkingen:

- Geen verplichte root-toegang
- Geen verplichte Docker-runtime op server
- Geen permanente Node-service
- Geen Redis als verplichte component
- Geen WebSocket-server als basis
- Geen queue-worker die permanent actief blijft

Achtergrondtaken lopen waar nodig via cron. Database via MySQL of MariaDB. Bestandsopslag binnen hostingomgeving. E-mail via SMTP of externe maildienst. WordPress en Laravel krijgen gescheiden mappen en subdomeinen.

## 26. Voorgestelde productiestructuur

| Domein | Doel |
| --- | --- |
| `prorijschool.nl` | Publieke WordPress-site |
| `www.prorijschool.nl` | Doorverwijzing naar hoofddomein |
| `mijn.prorijschool.nl` | Laravel portaal |
| `api.prorijschool.nl` | Interne API (later) |
| `theorie.prorijschool.nl` | Alleen wanneer theorie later technisch losgekoppeld wordt |

## 27. Git

Alle maatwerkcode wordt via Git beheerd. Minimaal een development branch, een production branch en versiehistorie. Geen directe wijzigingen in productie zonder versiebeheer.

WordPress-content zelf blijft in de database. Maatwerkthema, child theme, snippets en eigen plugins komen in Git.

## 28. Website-designrichting

Premium, rustig, modern. Veel fotografie, weinig tekst, grote visuele vlakken, sterke typografie, duidelijke prijsweergave, heldere CTA's, goede witruimte, professionele mobiele versie.

Niet: goedkope template-uitstraling, overmatig gebruik van felle kleuren, lange rijen kleine iconen, overvolle navigatie.

## 29. Beeldstijl

Voorkeur voor werkelijke instructeurs, werkelijke lesauto's en de werkelijke omgeving in Badhoevedorp, Hoofddorp en Vijfhuizen.

Foto's tijdens rijles, foto's vanuit voertuig, theorielokaal, instructeur samen met leerling. Geen onpersoonlijke stockbeelden wanneer eigen fotografie beschikbaar is.

## 30. Homepage

**Header:** logo, Rijlessen, Pakketten, Theorie, Taxi, Aanhanger, Over ons, Contact, Login. Primaire knop: Proefles boeken.

**Hero:** grote foto of korte achtergrondvideo. Headline bijvoorbeeld "Zelfverzekerd naar jouw rijbewijs." Subtekst: "Rijles in Badhoevedorp, Hoofddorp en Vijfhuizen. Nederlands, English en Türkçe." Knoppen: Proefles boeken, Bekijk pakketten.

**Diensten:** visuele kaarten voor autorijles, automaat rijles, taxilessen, aanhangwagenrijles, fysieke theorie en online theorie. Iedere kaart verwijst naar een eigen pagina.

**USP-sectie:** persoonlijke begeleiding, handgeschakeld en automaat, rijles in drie talen, 60/90/120 minuten, eigen leerlingomgeving, online en fysieke theorie.

**Proefles:** grote visuele sectie, korte uitleg, CTA Proefles aanvragen, secundaire CTA WhatsApp.

**Pakketten:** losse les, rittenkaart, compleet pakket. Prijs en belangrijkste inhoud direct zichtbaar. Link: Bekijk alle pakketten.

**Werkwijze:** 1. Proefles of inschrijving. 2. Persoonlijk lesplan. 3. Rijlessen volgen. 4. Voortgang volgen. 5. Examen.

**Leerlingportaal preview:** visuele mock-up met volgende les, lestegoed, voortgang, betalingen, aantekeningen en theorie. Knop: Leerling login.

**Theorie:** online theorie, fysieke cursus, oefenvragen, oefenexamens, cursusdata. CTA: Bekijk theorie.

**Talen:** Nederlands, English, Türkçe.

**Google reviews:** gemiddelde beoordeling en recente reviews.

**Regio:** Badhoevedorp, Hoofddorp, Vijfhuizen. Iedere locatie verwijst naar een eigen SEO-landingspagina.

**FAQ:** hoe lang duurt een rijles, bieden jullie automaatrijles, welke talen spreken instructeurs, hoe werkt annuleren, is betaling in termijnen mogelijk, hoe werkt een proefles.

**Contact CTA:** WhatsApp, bellen, e-mail, contactformulier.

**Footer:** diensten, pakketten, theorie, locaties, contact, login, privacyverklaring, algemene voorwaarden, cookie-instellingen.

## 31. Hoofdnavigatie

Rijlessen, Pakketten, Theorie, Over Prorijschool, Blog, Contact, Login.

Onder Rijlessen: autorijles, automaat rijles, taxiles, aanhanger.

## 32. Websitepagina's

Homepage, autorijles, automaat rijles, taxilessen, aanhangwagenrijlessen, theorie, online theorie, fysieke theoriecursus, pakketten en prijzen, proefles, inschrijven, over Prorijschool, contact, veelgestelde onderwerpen, blog, login, rijschool Badhoevedorp, rijschool Hoofddorp, rijschool Vijfhuizen, privacyverklaring, algemene voorwaarden, cookiebeleid.

## 33. Lokale SEO

Drie centrale lokale landingspagina's: rijschool Badhoevedorp, rijschool Hoofddorp, rijschool Vijfhuizen.

Iedere pagina krijgt unieke inhoud. Geen automatische kopie waarbij uitsluitend de plaatsnaam verandert.

Onderwerpen per locatiepagina: rijles in betreffende plaats, beschikbare opleidingen, handgeschakeld, automaat, theorie, proefles, talen, werkwijze, pakketten, FAQ, contact.

## 34. Blog

Onderwerpen: hoeveel rijlessen heb je gemiddeld nodig, automaat of handgeschakeld, wat kost een rijbewijs, hoe werkt een proefles, wat gebeurt er tijdens de eerste rijles, rijles in het Engels, rijles in het Turks, rijschool kiezen in Hoofddorp/Badhoevedorp/Vijfhuizen, aanhangwagenrijbewijs halen, taxirijbewijs en taxilessen, theorie-examen voorbereiden, online theorie versus klassikale theorie.

## 35. Mobiele website

Mobiele versie krijgt eigen aandacht. Geen simpele verkleining van het desktopontwerp.

Belangrijke mobiele CTA's blijven snel bereikbaar, bijvoorbeeld een onderste navigatie met bellen, WhatsApp, proefles en menu.

Formulieren krijgen grote invoervelden. Knoppen krijgen voldoende hoogte. Teksten blijven kort. Afbeeldingen krijgen aparte mobiele uitsnede. Navigatie blijft overzichtelijk. Prijzen blijven goed leesbaar. Pakketvergelijkingen worden onder elkaar geplaatst.

## 36. Meertaligheid

Eerst wordt de Nederlandse versie volledig afgerond. Daarna volgt de Engelse vertaling, daarna de Turkse.

Vertalingen omvatten menu, pagina's, knoppen, formulieren, bevestigingen, SEO-titels, meta descriptions, pakketten, FAQ en e-mails waar relevant. Portaalteksten volgen later eveneens per taal. De leerling kiest voorkeurstaal in het profiel.

## 37. Theorie op publieke website

Website toont online theorie, fysieke theoriecursus, cursusdata, inschrijven, beschrijving van mogelijkheden en login naar theorieomgeving.

## 38. Eigen theorieomgeving

Later komt theorie binnen het leerlingportaal: hoofdstukken, lessen, teksten, afbeeldingen, video's, PDF-bestanden, oefenvragen, meerkeuzevragen, oefenexamens, resultaten, voortgang, fout beantwoorde onderdelen, cursusdata, inschrijvingen en beschikbare plaatsen.

## 39. Externe theorieaanbieder

Het systeem blijft voorbereid op een externe aanbieder. Admin krijgt instellingen voor externe URL, eigen theorieomgeving, eventuele iframe en eventuele single sign-on wanneer de leverancier ondersteuning biedt.

Hierdoor blijft Prorijschool vrij om later een theoriepartner toe te voegen.

## 40. Gebruikersrollen

Admin, sub-admin, instructeur, leerling.

## 41. Admin

Volledige rechten: leerlingen, instructeurs en sub-admins beheren, voertuigen beheren, agenda bekijken, lessen plannen/wijzigen/annuleren, pakketten en prijzen beheren, betalingen en termijnen beheren, theorie beheren, voortgang bekijken, notities bekijken, instellingen beheren, e-mailinstellingen beheren, rapportages bekijken.

## 42. Sub-admin

Vrijwel alle dagelijkse administratieve rechten, instelbaar per recht: leerlingen beheren, planning beheren, betalingen bekijken, pakketten toewijzen, voertuigen beheren, instructeurs plannen.

Geen toegang tot gevoelige systeeminstellingen wanneer admin dit uitschakelt.

## 43. Instructeur

**Ziet:** eigen agenda, eigen leerlingen, leerlinggegevens, volgende lessen, historie, lestegoed, voortgang, pakketinformatie, relevante betalingen, voertuigen.

**Voert in:** lesduur, lesstatus, lesverslag, voortgang, openbare notitie, privénotitie, volgende afspraak.

## 44. Leerling

Ziet dashboard, volgende les, leshistorie, lestegoed, pakket, voortgang, aantekeningen, betalingen, termijnen, facturen, theorie, profiel en contact. Kan een les aanvragen en annuleren binnen de geldende voorwaarden.

## 45. Leerlingdashboard

Welkom met voornaam, volgende les (datum, tijd, instructeur, voertuig, lesduur), resterend lestegoed, voortgang, openstaand bedrag, volgende termijn, laatste lesnotitie, theorievoortgang. Knop: Nieuwe les aanvragen.

## 46. Instructeurdashboard

Lessen vandaag, volgende leerling, dagplanning, openstaande lesaanvragen, leerlingen zonder volgende afspraak, recente notities, voertuig vandaag. Snelle knop: Les afronden.

## 47. Admin dashboard

Aantal actieve leerlingen, lessen vandaag, lessen deze week, openstaande lesaanvragen, openstaande betalingen, termijnen, leerlingen met laag lestegoed, voertuigbezetting, instructeurbezetting, nieuwe inschrijvingen, theorie-inschrijvingen.

## 48. Voortgangsmodule

Instructeur beoordeelt leerling op vaste onderdelen: voertuigbediening, kijkgedrag, plaats op de weg, snelheid, bochten, kruispunten, rotondes, invoegen, uitvoegen, snelweg, parkeren, achteruitrijden, bijzondere verrichtingen, zelfstandig rijden, gevaarherkenning, examenvoorbereiding.

Scoremodel wordt later exact vastgesteld, bijvoorbeeld: nog oefenen, in ontwikkeling, voldoende, zelfstandig.

## 49. Notities

**Openbare notitie:** zichtbaar voor leerling, instructeur en beheer.

**Privénotitie:** alleen zichtbaar voor instructeur, sub-admin indien toegestaan, en admin.

Iedere notitie krijgt auteur, datum, tijd en lesreferentie.

## 50. Les afronden

Na de les voert de instructeur in: werkelijke lesduur, voortgang, lesverslag, openbare aantekening, eventuele privénotitie, status afgerond.

Na afronding wordt het lestegoed bijgewerkt.

## 51. Pakketinhoud

Admin bepaalt per pakket welke onderdelen inbegrepen zijn: aantal rijlesminuten, praktijkexamen, tussentijdse toets, theorie, gezondheidsverklaring, CBR-kosten, aanhangwagenexamen, taxiexamen, extra diensten.

Leerling ziet het eigen pakket volledig binnen het portaal.

## 52. Betalingsstatussen

Openstaand, deels betaald, betaald, verlopen, geannuleerd, terugbetaald.

Betaalmethodes: bankoverschrijving, contant, later Wero.

## 53. Facturen

Later ondersteunt het systeem facturen met: factuurnummer, leerling, factuurdatum, vervaldatum, omschrijving, bedrag exclusief btw waar relevant, btw, totaal, betaalstatus en PDF.

## 54. Theoriecursussen op locatie

Admin maakt een cursus aan met titel, datum, starttijd, eindtijd, locatie, docent, maximum aantal deelnemers, prijs, beschrijving en status.

Leerling schrijft online in. Het systeem bewaakt beschikbare plaatsen.

## 55. E-mailflow

| Gebeurtenis | Naar Prorijschool | Naar leerling |
| --- | --- | --- |
| Nieuwe proefles | Melding | Bevestiging |
| Nieuwe inschrijving | Melding | Ontvangstbevestiging |
| Account geactiveerd | | Logininformatie |
| Nieuwe les | | Afspraakbevestiging |
| Les gewijzigd | | Wijziging |
| Les geannuleerd | | Annulering |
| Betaling | | Betaalbevestiging indien ingesteld |
| Termijn | | Herinnering voor vervaldatum |
| Theorie | | Cursusbevestiging |

## 56. Privacy

Website en portaal worden AVG-gericht opgebouwd. Alleen benodigde persoonsgegevens worden opgeslagen.

Belangrijke onderdelen: privacyverklaring, cookiebeheer, toestemming voor marketing afzonderlijk, beveiligde accounts, wachtwoorden gehasht, rolgebaseerde toegang, logging van belangrijke beheeracties, beperkte toegang tot privénotities, back-ups, verwijder- en bewaarbeleid.

## 57. Beveiliging website

Sterke beheerdersaccounts, tweestapsverificatie waar beschikbaar, beperkt aantal plugins, regelmatige updates, back-ups, loginbeveiliging, spamfilter op formulieren, SSL, beveiligde formulieren.

## 58. Beveiliging portaal

Veilige wachtwoordhashing, CSRF-bescherming, inputvalidatie, rol- en rechtencontrole, rate limiting, veilige sessies, SSL, auditlog, geen gevoelige informatie in publieke logs, bescherming tegen directe objecttoegang, beveiligde uploads, databaseback-ups.

## 59. Performance

WebP of AVIF waar passend, afbeeldingen op juiste afmeting, lazy loading, beperkt aantal plugins, beperkt gebruik van zware Elementor-effecten, caching, minimale externe scripts, goede Core Web Vitals.

Mobiele performance heeft prioriteit.

## 60. SEO

**Technisch:** schone URL's, XML sitemap, canonical URL's, schema markup, Open Graph, meta titles, meta descriptions, interne links, breadcrumbs waar nuttig, alt-teksten, lokale bedrijfsgegevens, meertalige hreflang.

**Lokaal:** Badhoevedorp, Hoofddorp, Vijfhuizen. Diensten krijgen aparte zoekgerichte pagina's.

## 61. Analytics

Later toevoegen: Google Analytics, Google Tag Manager, Search Console, conversiemeting.

Belangrijke events: proeflesformulier verzonden, inschrijving verzonden, WhatsApp klik, telefoonklik, e-mailklik, pakket bekeken, contactformulier verzonden, login klik.

## 62. Back-ups

**WordPress:** bestanden, database, uploads.

**Portaal:** applicatiecode via Git, databaseback-up, uploads, belangrijke documenten.

Onderscheid tussen lokale ontwikkeling, testomgeving en productie.

## 63. Omgevingen

| Omgeving | Adres |
| --- | --- |
| Local | Ontwikkeling op laptop |
| Staging | `staging.prorijschool.nl` (later eventueel) |
| Production | `prorijschool.nl` en `mijn.prorijschool.nl` |

---

# Fasering

## 64. Fase 1A: lokale technische basis

**Doel:** werkende lokale WordPress-omgeving.

Docker Desktop installeren en configureren, WordPress lokaal draaien, MariaDB lokaal draaien, Elementor installeren, Elementor Pro installeren, basis WordPress-instellingen, permalinks, SSL lokaal indien nodig, Git-opzet voor maatwerk, basis back-up.

## 65. Fase 1B: designsysteem

Eerst ontwerpregels vastleggen: primaire kleur, secundaire kleur, achtergrondkleuren, tekstkleur, accentkleur, lettertypen, H1, H2, H3, bodytekst, buttons, formuliervelden, cards, border radius, afbeeldingsstijl, spacing, desktop breedte, tablet breedte, mobiele breedte, header, mobiele header, footer, CTA-stijl.

## 66. Fase 1C: homepage Nederlands

Volledige Nederlandse homepage bouwen voor desktop, tablet en mobiel. Alle secties, CTA's, formulieren, interne links, reviews, regio, pakketten, diensten, theorie en login-preview.

## 67. Fase 1D: dienstpagina's

Autorijles, automaat rijles, taxilessen, aanhangwagenrijles, theorie, online theorie, fysieke theorie.

Iedere pagina krijgt eigen hero, uitleg, voordelen, werkwijze, prijsverwijzing, FAQ en CTA.

## 68. Fase 1E: commerciële pagina's

Pakketten en prijzen, proefles, online inschrijven, contact, over Prorijschool, loginpagina.

## 69. Fase 1F: lokale SEO-pagina's

Rijschool Badhoevedorp, rijschool Hoofddorp, rijschool Vijfhuizen.

## 70. Fase 1G: blog en SEO-basis

Blogstructuur, categorieën, SEO-plugin configureren, sitemap, meta templates, schema. Search Console later bij livegang.

## 71. Fase 1H: mobiele optimalisatie

Iedere pagina afzonderlijk testen op mobiel: navigatie, knoppen, forms, lettergrootte, spacing, afbeeldingen, sticky CTA's, snelheid, geen horizontale scroll.

## 72. Fase 1I: Engels en Turks

Pas na goedkeuring van de Nederlandse website. Volledige vertaling naar Engels en Turks, met controle op mobiele lay-out per taal.

## 73. Fase 1J: livegang

Migratie lokale WordPress naar Cloud86, database importeren, bestanden uploaden, domein instellen, SSL, e-mail, caching, formulieren testen, WhatsApp testen, mobiel testen, SEO controleren, analytics toevoegen, back-up instellen.

## 74. Fase 2: portaalfundering

Laravel project, database, login, wachtwoord herstellen, gebruikersrollen, rechten, admin, sub-admin, instructeur, leerling, profielen, basis dashboards, auditlog.

## 75. Fase 3: leerlingen en instructeurs

Leerlingbeheer, instructeurbeheer, contactgegevens, statussen, taal, toegewezen instructeur, historie, profielbeheer.

## 76. Fase 4: voertuigen en planning

Voertuigen, beschikbaarheid, instructeursagenda, leerlingenagenda, 60/90/120 minuten, les aanvragen, les bevestigen, les wijzigen, les annuleren, 24-uursregeling, dubbele boeking voorkomen.

## 77. Fase 5: pakketten en lestegoed

Losse lessen, rittenkaarten, complete pakketten, minutensaldo, pakketinhoud, praktijkexamen, CBR-gerelateerde onderdelen, historie.

## 78. Fase 6: betalingen en termijnen

Bankoverschrijving, contant, maximaal vier termijnen, maximaal vier maanden, betaalstatus, betaalhistorie, openstaande bedragen, facturen.

## 79. Fase 7: voortgang

Lesverslag, vaardigheden, scores, openbare notities, privénotities, historie, leerlingweergave, instructeurweergave.

## 80. Fase 8: theorieplatform

Hoofdstukken, lessen, video, afbeeldingen, PDF, vragen, antwoorden, examens, resultaten, voortgang, cursussen, inschrijvingen, externe theorielink.

## 81. Fase 9: e-mailautomatisering

Lesbevestigingen, annuleringen, wijzigingen, betalingen, termijnen, theorie, accountmeldingen.

## 82. Fase 10: Wero

Online betalen, betaalprovider integreren, Wero toevoegen, webhookverwerking, automatische betaalstatus, termijnbetalingen.

## 83. Fase 11: WhatsApp-automatisering

Indien gewenst later: lesbevestiging, lesherinnering, annulering, betalingsherinnering, theoriebevestiging. Alleen via officiële zakelijke integratie.

## 84. Fase 12: rapportage

Adminrapportages: actieve leerlingen, nieuwe leerlingen per maand, aantal lessen, lesuren, omzet, openstaande bedragen, pakketten, instructeurbezetting, voertuigbezetting, annuleringen, theoriecursussen.

---

# Datamodel

## 85. Belangrijke databaseonderdelen

```
users                    packages
roles                    student_packages
permissions              package_items
students                 payments
instructors              payment_installments
vehicles                 invoices
lessons                  theory_courses
lesson_requests          theory_enrollments
lesson_notes             theory_lessons
lesson_progress          theory_chapters
skills                   theory_questions
                         theory_answers
notifications            theory_results
audit_logs
settings
```

## 86. Statussen voor lessen

Aangevraagd, bevestigd, gewijzigd, afgerond, geannuleerd door leerling, geannuleerd door Prorijschool, no-show, in afwachting.

## 87. Statussen voor leerlingen

Lead, proefles aangevraagd, ingeschreven, actief, tijdelijk gepauzeerd, examen gepland, geslaagd, gestopt.

## 88. Pakketstatus

Concept, actief, voltooid, verlopen, geannuleerd.

---

# Werkwijze

## 89. Principes voor Claude AI

Claude krijgt nooit opdracht om het volledige project in één keer te bouwen. Iedere fase krijgt een eigen opdracht.

Iedere opdracht bevat: doel, techniek, bestaande architectuur, bestanden waaraan gewerkt wordt, wat wel gebouwd wordt, wat buiten scope blijft, acceptatiecriteria, mobiele eisen, beveiligingseisen en teststappen.

Geen wijziging buiten de betreffende fase zonder noodzaak.

## 90. Werkwijze met Claude

1. Projectstructuur analyseren
2. Plan voor betreffende fase geven
3. Alleen betreffende fase uitvoeren
4. Lokaal testen
5. Fouten herstellen
6. Mobiel testen
7. Resultaat beoordelen
8. Commit in Git
9. Volgende fase

## 91. Acceptatie fase 1

Fase 1 is pas afgerond wanneer de Nederlandse website volledig werkt, desktop klopt, tablet klopt, mobiel klopt, alle diensten aanwezig zijn, alle knoppen werken, WhatsApp werkt, het proeflesformulier werkt, het inschrijfformulier werkt, het contactformulier werkt, pakketten duidelijk zijn, prijzen duidelijk zijn, Badhoevedorp/Hoofddorp/Vijfhuizen aanwezig zijn, login zichtbaar is, theorielogin voorbereid is, de website snel genoeg laadt en er geen zichtbare technische fouten aanwezig zijn.

## 92. Acceptatie portaal

Het portaal wordt pas als afgerond beschouwd wanneer rollen correct werken, leerling alleen eigen gegevens ziet, instructeur alleen toegestane leerlingen ziet, admin volledige controle heeft, planning dubbele afspraken blokkeert, voertuigen correct worden gecontroleerd, de annuleringsregeling werkt, lestegoed correct wordt bijgewerkt, betalingen correct worden opgeslagen, notities de juiste zichtbaarheid hebben, theorievoortgang correct wordt opgeslagen en de mobiele weergave bruikbaar is.

## 93. Projectprioriteit

1. Nederlandse publieke website
2. Mobiele optimalisatie
3. Engelse en Turkse website
4. Portaalbasis
5. Planning
6. Pakketten en lestegoed
7. Betalingen
8. Voortgang
9. Theorie
10. Automatisering
11. Wero
12. Rapportages

## 94. Eindarchitectuur

```
Bezoeker
   |
prorijschool.nl
   |
WordPress + Elementor
   |
Proefles / Inschrijving / Pakketten / Theorie / Contact / SEO
   |
mijn.prorijschool.nl
   |
Laravel
   |
Leerling / Instructeur / Sub-admin / Admin
   |
Planning, Voertuigen, Pakketten, Lestegoed, Betalingen,
Voortgang, Notities, Theorie, E-mail, later Wero
```

## 95. Kern van Prorijschool

Prorijschool wordt vanaf het begin opgezet als combinatie van een premium rijschoolwebsite en een eigen digitaal rijschoolplatform.

De website blijft gericht op nieuwe klanten. Het portaal blijft gericht op bestaande leerlingen, instructeurs en beheer. WordPress blijft verantwoordelijk voor marketing en content. Laravel wordt verantwoordelijk voor bedrijfsprocessen.

Deze scheiding houdt de website overzichtelijk en geeft ruimte om het portaal later uit te breiden zonder WordPress als administratieplatform te gebruiken.

De eerste concrete ontwikkelopdracht blijft fase 1: de Nederlandse frontend van prorijschool.nl in WordPress en Elementor. Pas na afronding daarvan volgen portaalfuncties.
