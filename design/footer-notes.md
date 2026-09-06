# Footer — Prorijschool

## Live implementatie

- Elementor footertemplate: `Footer – Prorijschool` (template ID 36).
- Weergavevoorwaarde: gehele site.
- Taalkeuze staat bewust niet meer in de header; de footer is voorbereid als vaste plek voor NL/EN/TR.
- De footer gebruikt de bestaande hoofdnavigatie en verwijst naar de bestaande ankers `#opleidingen`, `#pakketten`, `#theorie`, `#regio` en `#vragen`.
- Regiovermelding: Badhoevedorp, Hoofddorp en Vijfhuizen.

## Styling

De live styling staat in WordPress Customizer → Extra CSS en is gescopeerd op `.elementor-36.elementor-location-footer`.

- Donkerblauwe achtergrond (`#162c3b`) met lichte tekst.
- Desktop: navigatie en regio naast elkaar; copyright en sociale links op een gescheiden onderste rij.
- Mobiel: één kolom, verticale navigatie en geen horizontale overflow.
- Focus states gebruiken een contrasterende warme accentkleur (`#f2a35b`).

## Controle

De gepubliceerde homepage is na publicatie opnieuw geladen. De footer is zichtbaar, bevat de navigatielinks, regiotekst en copyrightregel. Desktop is visueel gecontroleerd; de mobiele media-query is vastgelegd op maximaal 767px.
