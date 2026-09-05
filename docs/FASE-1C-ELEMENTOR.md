# Fase 1C — homepage bouwen in Elementor

Opmaak komt uit het child theme. Geen HTML-widget met een blok code erin.

---

## Vooraf: eenmalige instellingen

### Site Settings → Global Colors

| Naam | Waarde |
| --- | --- |
| Primary | `#E9C87F` |
| Secondary | `#D2A94F` |
| Text | `#14161F` |
| Accent | `#FF5A36` |
| Nacht diep | `#0C0E15` |
| Papier | `#FBF7EF` |
| Zand zacht | `#F7EBD2` |
| Grijs | `#6A6459` |

### Site Settings → Global Fonts

| Naam | Familie | Gewicht |
| --- | --- | --- |
| Primary | Sora | 800 |
| Secondary | Sora | 700 |
| Text | Public Sans | 400 |
| Accent | Public Sans | 600 |

### Site Settings → Layout

- Content width: **1220**
- Widgets space: **0**
- Breakpoints: mobile 767, tablet 1024, laptop 1366

### Elementor → Settings → Features

- **Flexbox Container: Active**
- **Grid Container: Active**
- Optimized Markup: aan
- Improved CSS Loading: aan

---

## Per sectie

### Header
Theme Builder → Header. Container, richting rij, verticaal gecentreerd.

| Onderdeel | Widget | Klasse |
| --- | --- | --- |
| Logo | Site Logo | — |
| Menu | Nav Menu | — |
| Taalwissel | Nav Menu of Button-groep, links `/`, `/en/`, `/tr/` | — |
| Inloggen | Button, tekstvariant | — |
| Proefles boeken | Button | `pro-btn pro-btn--koraal` |

Achtergrond `#0C0E15` met 92% dekking, Blur 14px. Container op **Sticky: Top**.

### Hero
Container, klasse `pro-hero pro-korrel`. Achtergrondafbeelding:
`assets/img/hero-polderweg.svg`, positie center, grootte cover.
De donkere sluier komt uit de CSS.

Twee kolommen (1.1fr / 0.9fr), stapelt onder 860px.

Links: Heading `pro-hero-titel`, Text Editor, container `pro-bewijs`
met drie containers `pro-bw` (Heading `pro-bw-cijfer` + Text `pro-bw-label`).

Rechts: **Form-widget** in een container `pro-formulier`.
Velden: naam, telefoon, woonplaats (select).
Acties na verzenden: Email, Email 2, Redirect naar bedankpagina.
Submit-knop: `pro-btn pro-btn--koraal pro-btn--vol`.
Daaronder Button `pro-btn pro-btn--wa pro-btn--vol` met `wa.me`-link.

> Het formulier uit het prototype werkt niet. Dit moet de Form-widget
> worden, anders komt er geen aanvraag binnen.

### Melding
Container `pro-melding`, richting rij. Icon met klasse `pro-puls`,
Text Editor met cursusdatum, Button tekstvariant naar `#theorie`.
Zet dit als **globale widget**, dan pas je de datum op een plek aan.

### Opleidingen
Container `pro-kop` (Divider `pro-streep` + Heading + Text `pro-leid`).
Daaronder **Container Grid**, 3 kolommen, klasse `pro-mozaiek`.

Zes containers `pro-kaart`. De eerste krijgt er
`pro-kaart--groot pro-kaart--nacht` bij, de vierde `pro-kaart--zand`.

### Rekenhulp
Container `pro-reken pro-korrel`, twee kolommen vanaf 760px.
Attribuut op de buitenste container: `data-reken-blok|`

Keuzeknoppen krijgen klasse `pro-keuze` en attributen:

```
data-groep|auto
data-waarde|1
aria-pressed|true
```

| Groep | Knop | Waarde |
| --- | --- | --- |
| `auto` | Handgeschakeld | `1` |
| `auto` | Automaat | `0.94` |
| `erv` | Geen ervaring | `34` |
| `erv` | Een beetje | `24` |
| `erv` | Veel | `16` |
| `duur` | 60 min | `60` |
| `duur` | 90 min | `90` |
| `duur` | 120 min | `120` |

Rechts: container `pro-uitkomst` met Text `pro-uitkomst-label`,
Heading `pro-uitkomst-bedrag` met attribuut `data-reken|bedrag`,
Text `pro-uitkomst-noot` met attribuut `data-reken|detail`,
en een Button `pro-btn pro-btn--zand pro-btn--vol`.

Tarieven staan in `functions.php`, niet in de opmaak.

### Pakketten
Container `pro-vlak-wit`. Grid van 3, gelijke hoogte.
Kaarten `pro-kaart pro-lijst`, de middelste erbij
`pro-kaart--nacht pro-pakket-uit pro-korrel`.
Opsomming via **Icon List** met klasse `pro-lijst`, iconen uit.

### Werkwijze
Grid van 5. Per stap container `pro-stap` (laatste `pro-stap pro-stap--slot`).

### Portaal
Container `pro-vlak-zand`, twee kolommen vanaf 820px.

### Theorie
Container `pro-vlak-wit`, twee kolommen.
Links `pro-kaart pro-kaart--nacht pro-lijst`, rechts `pro-kaart pro-lijst`.

### Regio
Twee kolommen vanaf 820px. Links drie containers `pro-plaats`.

### Reviews
Overweeg een Google Reviews-plugin in plaats van vaste tekst.
Anders Grid van 3 met kaarten `pro-kaart`.

### FAQ
**Accordion-widget** met klasse `pro-faq`. Zet FAQ-schema aan in de
SEO-plugin, dat levert rich results op (zie 60).

### Slot-CTA
Container `pro-vlak-nacht pro-korrel`, gecentreerd.
Twee Buttons: `pro-btn pro-btn--zand` en `pro-btn pro-btn--rand`.

### Mobiele actiebalk
Container `pro-mobbar`, zichtbaar op mobiel en tablet.
Vier links: bellen, WhatsApp (`pro-wa`), proefles, menu.
Losse desktopknop: container `pro-wa-zwevend`.

---

## Nog te regelen

- [ ] SVG-upload toestaan via de plugin **Safe SVG**, alleen voor beheerders.
      WordPress blokkeert SVG standaard, en terecht.
- [ ] Google Fonts Sora en Public Sans. Overweeg lokaal hosten voor AVG
      en snelheid (zie 56 en 59).
- [ ] Bedankpagina aanmaken, nodig voor conversiemeting.
- [ ] reCAPTCHA of honeypot op het formulier (zie 57).

## Acceptatie

- Geen enkele sectie gebruikt een HTML-widget voor opmaak
- Alle kleuren komen uit Global Colors
- Formulier verstuurt en bevestigt
- Rekenhulp rekent mee bij elke keuze
- Geen horizontale scroll op 360px
- Lighthouse mobiel: prestaties 85 of hoger
