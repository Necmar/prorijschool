# Prorijschool

Maatwerkcode voor de website `prorijschool.nl`.
Testomgeving: https://prorijschool.necmardemo.nl/

## Wat staat er in deze repo

```
.cpanel.yml                              Deployment naar de server
.gitignore
README.md
docs/
  PROJECTPLAN.md                         Volledig projectplan
  FASE-1A.md                             Checklist huidige fase
design/
  templates/                             Elementor-exports (JSON)
db/                                      Databasedumps (niet in Git)
wp-content/
  themes/
    prorijschool-child/                  Child theme
```

## Wat staat er NIET in

WordPress core, Elementor, Elementor Pro en andere plugins van derden.
Ook `wp-config.php` en `wp-content/uploads/` blijven buiten de repo.

Belangrijk: Elementor slaat pagina-ontwerpen op in de database, niet in
bestanden. Het bouwwerk van fase 1C tot 1F zit dus **niet** automatisch in
Git. Exporteer per afgeronde fase de templates naar `design/templates/`.

## Werkwijze

Volgens projectplan 90:

1. Wijziging maken
2. Committen op `develop`
3. Pushen naar GitHub
4. In cPanel Git Version Control op **Pull or Deploy** klikken
5. Testen op de demo-site, desktop en mobiel
6. Pas na goedkeuring mergen naar `main`

## Branches

| Branch | Doel |
| --- | --- |
| `develop` | Actieve ontwikkeling |
| `main` | Goedgekeurde stand, gekoppeld aan cPanel |

## Eenmalige opzet

Vervang in `.cpanel.yml` de placeholder `GEBRUIKERSNAAM` en controleer of
het pad klopt met de documentroot van de demo-site.
