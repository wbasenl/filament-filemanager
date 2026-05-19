# Wbasenl File Manager

Dit package biedt een robuuste en flexibele bestandsbeheeroplossing voor Laravel-applicaties, geïntegreerd met Filament. Het stelt gebruikers in staat om bestanden te uploaden, organiseren en beheren binnen de applicatie, met ondersteuning voor verschillende opslagadapters en bestandstypen.

## Installatie

Installeer het package via Composer:

```bash
composer require wbasenl/filemanager
```

Publiceer de configuratiebestanden en migraties:

```bash
php artisan vendor:publish --provider="Wbasenl\FileManager\FileManagerServiceProvider"
php artisan migrate
```

Voeg de plugin toe aan je Filament Panel Provider:

```php
// app/Providers/Filament/AdminPanelProvider.php

use Wbasenl\FileManager\FileManagerPlugin;

public function panel(Panel $panel): Panel
{
    return $panel
        // ...
        ->plugins([
            FileManagerPlugin::make(),
        ]);
}
```

## Folderstructuur

Hieronder volgt een overzicht van de belangrijkste mappen en hun functie binnen dit package.

-   **`config/`**: Bevat de configuratiebestanden voor het package. Hier kun je instellingen aanpassen zoals de standaard opslagdisk, toegestane bestandstypen en andere specifieke opties.
    -   `filemanager.php`: Het hoofdbestand voor de configuratie van de bestandsbeheerder.

-   **`database/`**: Bevat de migraties voor de database tabellen die nodig zijn voor het bestandsbeheer.
    -   `migrations/`: Database migraties voor het aanmaken van tabellen zoals `files` of `file_folders`.

-   **`resources/`**: Bevat assets zoals views, vertalingen en eventuele styling of scripts die specifiek zijn voor de bestandsbeheerder.
    -   `views/`: Blade templates voor de weergave van de bestandsbeheerder in Filament.
    -   `lang/`: Taalbestanden voor vertalingen.

-   **`routes/`**: Web- of API-routes die specifiek zijn voor de functionaliteit van de bestandsbeheerder.

-   **`src/`**: De kern van het package, met alle PHP-code.
    -   **`Adapters/`**: Bevat implementaties voor verschillende opslagmethoden of integraties met externe services.
    -   **`Console/`**: Artisan commando's die gerelateerd zijn aan het bestandsbeheer.
    -   **`Contracts/`**: Interfaces die de contracten definiëren voor de verschillende componenten van het package.
    -   **`Enums/`**: Enumeraties die gebruikt worden voor vaste waardes, zoals bestandstypen, statussen of configuratie-opties.
    -   **`Filament/`**: Filament-specifieke componenten en integraties.
        -   `Resources/`: Filament Resources voor het beheren van bestanden en mappen via het admin panel.
        -   `Pages/`: Filament Pages voor specifieke functionaliteit, zoals de hoofd bestandsbeheerpagina.
        -   `Widgets/`: Filament Widgets voor dashboards of overzichten.
    -   **`FileTypes/`**: Definities en logica voor het omgaan met specifieke bestandstypen (bijv. afbeeldingen, documenten).
    -   **`Http/`**: HTTP-gerelateerde klassen.
        -   `Controllers/`: Controllers die de logica afhandelen voor HTTP-verzoeken.
        -   `Middleware/`: Middleware voor het afhandelen van HTTP-verzoeken, zoals authenticatie of autorisatie.
        -   `Requests/`: Form Request-klassen voor validatie van inkomende verzoeken.
    -   **`Livewire/`**: Livewire-componenten die gebruikt worden voor interactieve elementen in de bestandsbeheerder.
    -   **`Models/`**: Eloquent modellen die de interactie met de database tabellen van het package verzorgen.
        -   `File.php`: Het model voor individuele bestanden.
        -   `Folder.php`: Het model voor mappenstructuren.
    -   **`Policies/`**: Autorisatie policies die bepalen welke gebruikers toegang hebben tot welke bestandsbeheeracties.
    -   **`Schemas/`**: Definities voor Filament Schemas, gebruikt voor formulieren en tabellen.
    -   **`Services/`**: Service-klassen die specifieke bedrijfslogica bevatten, zoals het uploaden, verplaatsen of verwijderen van bestanden.
    -   **`Traits/`**: Herbruikbare traits die functionaliteit toevoegen aan modellen of andere klassen.
    -   `FileManagerPlugin.php`: De Filament Plugin-klasse die het package integreert in Filament.
    -   `FileManagerServiceProvider.php`: De Service Provider van het package, verantwoordelijk voor het registreren van services, routes, views, etc.
    -   `FileTypeRegistry.php`: Een register voor het beheren van verschillende bestandstypen.
    -   `helpers.php`: Een bestand met helperfuncties die globaal beschikbaar zijn binnen het package.

-   **`tests/`**: Bevat de unit- en feature-tests voor het package.
    -   `Feature/`: Tests die de functionaliteit van het package testen vanuit een gebruikersperspectief.
    -   `Unit/`: Tests die individuele eenheden van code testen.

-   **`CHANGELOG.md`**: Houdt alle wijzigingen en nieuwe versies van het package bij.
-   **`composer.json`**: Het Composer-configuratiebestand voor het package, inclusief afhankelijkheden en autoloading-regels.
-   **`LICENSE`**: Het licentiebestand voor het package.
-   **`README.md`**: Dit bestand.
-   **`.gitignore`**: Specificeert welke bestanden en mappen genegeerd moeten worden door Git.
-   **`phpunit.xml`**: Configuratiebestand voor PHPUnit tests.
-   **`package.json`**: Configuratiebestand voor Node.js afhankelijkheden (indien van toepassing voor frontend assets).
