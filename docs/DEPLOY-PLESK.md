# Deployment via Plesk

De server draait Plesk, niet cPanel. Twee aanwijzingen: de map `httpdocs`
in de home directory, en de groep `psacln` op alle bestanden.

Dat betekent dat `.cpanel.yml` in deze repo niets doet. Plesk kent geen
deployment-bestand in de repo; je stelt het doelpad in de interface in.

## Gegevens van deze server

| | |
| --- | --- |
| Systeemgebruiker | `necmar` |
| Documentroot site | `/home/necmar/prorijschool.necmardemo.nl` |
| Themamap | `wp-content/themes/prorijschool-child` |

## Eenmalig instellen

1. Plesk → **Websites & Domeinen** → `prorijschool.necmardemo.nl` → **Git**
2. **Repository toevoegen** → externe repository
3. URL: `https://github.com/Necmar/prorijschool.git`
4. Branch: `main`
5. Bij **Doelmap voor implementatie**, vul in:
   `wp-content/themes/prorijschool-child`
6. Implementatiemodus: **Automatisch** (bij elke push) of **Handmatig**

## Belangrijk: niet de hele repo publiceren

Plesk kopieert standaard de volledige repo naar de doelmap. Deze repo
bevat ook `docs/`, `design/` en het projectplan. Die horen niet op een
publieke webserver.

Twee manieren om dat te voorkomen:

**A. Losse deploy-branch (aanbevolen)**
Maak een branch `deploy` die alleen de inhoud van
`wp-content/themes/prorijschool-child/` bevat, in de root.
Koppel Plesk aan die branch. Dan komt er precies één ding op de server:
het thema.

**B. Extra bestandsregels**
Houd `main` gekoppeld en verwijder na elke deploy handmatig wat er niet
hoort. Foutgevoelig, niet aan te raden.

## Controle na de eerste implementatie

1. Plesk → Bestandsbeheer → `prorijschool.necmardemo.nl/wp-content/themes/`
2. Staat er een map `prorijschool-child` met daarin `style.css` en
   `functions.php`?
3. WordPress → Weergave → Thema's → **Prorijschool Child** activeren

Verschijnt het thema niet in de lijst, scroll dan naar beneden naar
"Beschadigde thema's". Staat het daar met de melding dat het bovenliggende
thema mist, dan moet **Hello Elementor** eerst geïnstalleerd worden.

## Openstaand

- [ ] `.cpanel.yml` verwijderen zodra Plesk bevestigd is; het bestand
      doet niets en wekt de indruk dat deployment geregeld is.
