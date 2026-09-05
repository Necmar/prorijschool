# Fase 1 — GitHub en frontendpublicatie

Publieke website: WordPress + Elementor. Toekomstig CRM: aparte Laravel-app.
Eerste publicatiedoel: https://prorijschool.necmardemo.nl/.

## Inventarisatie en voorbereiding

De lokale map had geen Git-repository. Git en PHP zijn beschikbaar. GitHub is in
de browser niet aangemeld. Hostingprovider, documentroot, actieve online thema's,
Elementor-inhoud en verschillen tussen online en lokaal zijn nog niet geverifieerd.
De publieke demosite is via de browser bereikbaar met HTTPS en toont een standaard
WordPress-blog met Hello world, Sample Page en Twenty Twenty-Five in de footer.
Dat bevestigt nog geen geïnstalleerde Elementor-versie of beheerconfiguratie.

De bestaande README en installatiescripts beschrijven de oude Laragon/XAMPP,
WooCommerce/Mollie-portaalopzet. Deze zijn lokaal behouden maar uitgesloten van Git.
Ook de oude WordPress-portaalplugin blijft lokaal bewaard. Het thema gebruikt
`prp_*`-opties: online plugin-afhankelijkheden eerst onderzoeken, niets zomaar uitzetten.

Git bevat uitsluitend het maatwerkthema, deze documentatie en releasecontrole.
`main` is voor releases, `develop` voor ontwikkeling. Na een commit maakt
`./scripts/build-release.ps1` een ZIP met SHA256-bestand in `artifacts/`.
De workflow controleert PHP en bewaart dat pakket; hij publiceert nog niet.

## GitHub aansluiten

1. Aanmelden bij het gekozen GitHub-account.
2. Private repository `prorijschool` maken zonder gegenereerde bestanden.
3. Remote koppelen en `main` en `develop` pushen; `main` als standaardbranch.
4. Actions uitvoeren en het releasepakket controleren.

## Hosting, vergelijking en back-up

1. Hostingpaneel, HTTPS, documentroot en SSH/SFTP/FTPS-mogelijkheden vaststellen.
2. Online WordPress, actieve plugins, thema, menu's en Elementor-inhoud inventariseren.
3. Online maatwerk downloaden naar een uitgesloten map; vergelijken en nieuwere
   online wijzigingen behouden voordat lokaal maatwerk gepubliceerd wordt.
4. Volledige bestandenback-up inclusief uploads en database-export maken, buiten Git
   opslaan en herstel op een geïsoleerde omgeving controleren.

## Publicatie implementeren na toegang

Gebruik uitsluitend het geverifieerde hostingpad en gecontroleerde serveridentiteit.
Credentials komen in GitHub environment secrets, nooit in code of chat.
Publicatie mag alleen `wp-content/themes/necmar-rijschool` vervangen, zonder
automatische thema-activatie. Geen root-synchronisatie, database-import of demoseeder.
Releases na elkaar uitvoeren en een lopende overdracht niet afbreken.
Maak vóór vervanging een herstelkopie van het actuele thema buiten de webroot.

Elementor-content afzonderlijk exporteren/importeren na databaseback-up; nooit de
volledige lokale database over de online database zetten. Daarna cache/CSS vernieuwen.

## Acceptatie en hersteltest

- Uitgangscommit, back-uplocatie en actieve online themaversie vastleggen.
- Kleine herkenbare frontendwijziging committen en publiceren.
- Homepage, dienstpagina, mobiel menu en bestaande formulieren controleren.
- Vorig thema herstellen en controleren dat de wijziging verdwenen is.
- Geteste release opnieuw publiceren en resultaat vastleggen.
- Demo-indexering controleren en uitschakelen.

Fase 1 is pas klaar wanneer private GitHub-remote, hostingoverdracht, volledige
back-up en daadwerkelijke publicatie- en hersteltest zijn geslaagd.
