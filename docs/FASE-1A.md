# Fase 1A - Technische basis

Format volgens projectplan 89.

## Doel

Een werkende, schone WordPress-omgeving op
https://prorijschool.necmardemo.nl/ met versiebeheer via Git en
deployment via cPanel.

## Techniek

WordPress, Elementor 4.2.4, Elementor Pro, MySQL of MariaDB,
Git via GitHub, deployment via cPanel Git Version Control.

Geen lokale ontwikkelomgeving. De demo-site is de enige werkomgeving
tot livegang in fase 1J.

## Status

- [x] WordPress geinstalleerd
- [x] Elementor en Elementor Pro geinstalleerd en geactiveerd
- [ ] Repo koppelen in cPanel Git Version Control
- [ ] GEBRUIKERSNAAM en pad in `.cpanel.yml` invullen
- [ ] Branch `develop` aanmaken
- [ ] Child theme deployen en activeren
- [ ] Permalinks instellen op Berichtnaam
- [ ] Standaardcontent verwijderen: Hello world!, Voorbeeldpagina, standaardreactie
- [ ] Statische homepage instellen in plaats van berichtenarchief
- [ ] Sitetaal Nederlands, tijdzone Amsterdam, datumnotatie NL
- [ ] Zoekmachines blokkeren zolang de site in aanbouw is
- [ ] Sterk beheerdersaccount, standaard gebruikersnaam admin vermijden
- [ ] Back-upvoorziening controleren in cPanel

## Wat buiten scope blijft

Kleuren, lettertypen, buttons en spacing horen bij fase 1B.
Pagina-inhoud hoort bij fase 1C en verder.
Voeg in deze fase geen designkeuzes toe aan het child theme.

## Acceptatiecriteria

- Child theme is actief en de site laadt zonder fouten
- Een wijziging in `style.css` is na push en pull zichtbaar op de demo-site
- URL's zijn schoon, dus geen `?p=1` meer
- Geen standaard WordPress-content meer zichtbaar
- Site is niet indexeerbaar zolang hij in aanbouw is

## Beveiligingseisen

- `wp-config.php` staat niet in de repo
- Geen wachtwoorden, tokens of licentiesleutels in commits
- Beheerdersaccount met sterk wachtwoord

## Teststappen

1. Wijzig een regel in `style.css`
2. Commit en push
3. Pull of deploy vanuit cPanel
4. Controleer of de wijziging live is
5. Open de site op mobiel en controleer op fouten
