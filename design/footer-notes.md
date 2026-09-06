# Footer — Prorijschool

## Ontwerp, 7 september 2026

- Live Elementor-template `Footer – Prorijschool`, ID 36, voor de gehele site.
- Nieuwe HTML-widget met eigen CSS; bron en opmaak staan samen in `design/footer.html`, uit de gepubliceerde widget overgenomen.
- Warme uitnodigingsbalk met proeflesknop, gevolgd door een donkerblauw merkblok en twee duidelijk benoemde navigatiegroepen.
- Plaatsnamen, regiolink en niet-ingestelde sociale iconen verwijderd.
- Taalkeuze blijft voorlopig afwezig.
- Desktop: drie kolommen. Mobiel: merkblok over de volledige breedte, twee navigatiekolommen, proeflesknop over de volledige breedte.
- Copyright en werkende terug-naar-boven-link onder een enkele scheidingslijn.

## Linkstatus

De proefles- en informatielinks sluiten aan op de bestaande headerbestemmingen: `/#aanvraag`, `/#opleidingen`, `/#pakketten`, `/#theorie` en `/#vragen`. De homepage bevat deze secties nog niet. Deze links zijn dus voorbereid; een werkende aanvraagroute is geen onderdeel van deze footeroplevering. Er zijn geen contactgegevens, juridische pagina's of werkende CRM-functies verzonnen.

## Verificatie

De live homepage zonder ingelogde WordPress-sessie gecontroleerd met Chromium op 320, 390, 600, 768, 1024 en 1440 pixels breed. Op alle breedtes: geen horizontale overflow, geen plaatsnamen en een CTA van minimaal 55px hoog. Terug naar boven werkt. Screenshots op 320, 768 en 1440 pixels visueel beoordeeld; resultaten en screenshots staan lokaal onder `artifacts/footer-*`.

De eerdere verklaring dat de oorspronkelijke footer op 390px getest was, was niet onderbouwd: toen was de Customizer-interface gemeten. De huidige controles meten daadwerkelijk de gepubliceerde homepage en footer.
