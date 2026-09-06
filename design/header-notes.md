# Header — 7 september 2026

Live toegepast via WordPress Customizer > Extra CSS, op het bestaande
Prorijschool Child-thema en Elementor-header 23. De CSS is beperkt tot deze header.
`header-responsive.css` is een kopie van de gepubliceerde Extra CSS.
Geen automatische deployment: deze repository loopt nog niet gelijk met de online installatie.

Wijziging: lichte achtergrond, donkerblauwe tekst, contrasterende proeflesknop,
responsive menubediening en inloggen op tweede regel onder 1101px. De taalwisselaar
is als Elementor-knoppen verwijderd; taalkeuze komt later in de footer.

Gecontroleerd in browser: 320, 390, 768, 1024, 1101 en 1440px zonder horizontale
overloop. Mobiel menu opent/sluit; Enter sluit het menu via de gefocuste toggle.
Witte SVG-icoonkleur gecorrigeerd naar donkerblauw.

Bestaande beperking: homepage bevat nog geen secties voor de navigatieankers
of proeflesaanvraag. Die bestemmingen zijn met deze stijlwijziging niet gebouwd.

Herstel: verwijder dit afgebakende CSS-blok in Extra CSS; bestaande Elementor-
elementen en de oorspronkelijke stijlen zijn intact gebleven.

Aanpassing: taalwisselaar verborgen t/m 1100px; footer volgt later. Gecontroleerd op 320, 390, 768, 1024 en 1256px zonder overloop.

Laatste correctie: taalwisselaar op ALLE apparaten verborgen. Getest op 320, 768 en 1440px.
