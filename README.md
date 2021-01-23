## Installation

### Lade die Reposetory per command herunter

`git clone git@github.com:LelilolZH/Webseite-Forlage.git`
oder
`git clone https://github.com/LelilolZH/Webseite-Forlage.git`

### Lade die Reposetory per Zip herunter

Lade die Datei als Zip herunter und entpacke sie anschliessend in den gewünschten Projektordner.
`https://codeload.github.com/LelilolZH/Webseite-Forlage/zip/main`

### Anforderungen

Damit diese Webseite funktioniert wird ein Apacheserver benötigt sowie Mysqli für die Datenbank.
Wenn man beispielsweise XAMPP nutzt so müssen diese Reposetory in den Ordner `htdocs` geclont werden.

## Funktionen

### Wie werden dateien abgerufen

Normalerweise würde man das css file so abrufen:
<br>
`<link rel="stylesheet" type="text/css" href="/css/main.css"); ?>">`
<br>
für mehr Sicherheit und Kontrolle kann das file nur durch einen Token-Link abgefragt werden der mit
`generate_Link();` generiert wird. Am ende könnte das etwa so aussehen:
<br>
`<link rel="stylesheet" type="text/css" href="<?php echo generate_Link("/css/main.css"); ?>">`
<br>
Wird das file nicht gefunden so wird ein error 404 aufgerufen.

### Die Datenbank

#### Datenbankverbindung

Unterstützt wird MySqli.<br>
Öffne die Datei `/php/connect.php`
<br>
Nun ändere die Zeilen

```
$db_host = "localhost";
$db_user = "root";
$db_passw = "";
$db_bank = "anisenpai";
```

auf deine gewünschten Daten um.

#### Datenbankstruktur

Benötigt wird eine Tabelle mit dem Namen `file-token`.
Diese soll folgende Struktur aufweisen:
<br>

```
id -- int(11) -- utf8_unicode_ci -- AUTO_INCREMENT
path -- text -- utf8_unicode_ci --
token -- text -- utf8_unicode_ci --
ip -- varchar(120) -- utf8_unicode_ci --
expire -- int(11) -- utf8_unicode_ci --
```

<br>
Diese struktur kann auch mit folgendem comman Importiert werden:

```
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `file-token` (
  `id` int(11) NOT NULL,
  `path` text COLLATE utf8_unicode_ci NOT NULL,
  `token` text COLLATE utf8_unicode_ci NOT NULL,
  `ip` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `expire` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

ALTER TABLE `file-token`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `file-token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1204;
COMMIT;
```

### Das Menu editieren

Um das Menu zu ersetzen können können muss man das file `/ajax/modules/navigation.php` öffnen.
Dort kann beliebig das neue Menu bzw. der Header generiert werden.

### Eine neue Seite verknüpfen

#### Datei erstellen

Um eine neue Seite hinzuzufügen muss man zuerst der Datei einen namen geben.
In diesem Beispiel würden wir kontakt.php hinzufügen wollen.
<br>
Dazu öffnet man den Ordner `/ajax/req/` und erstellt dort das neue File `kontakt.php`. Somit befindet sich nun das file `/ajax/req/kontakt.php` hier.
<br>
Möchte man jedoch nicht die Endung `.php` haben, so muss man in `/ajax/req/` einen neue Ordner erstellen mit dem namen `kontakt` und darin das File als `index.php` abspeichern. Somit würde das File sich nun hier `/ajax/req/kontakt/index.php` befinden.

#### Datei verifizieren

Noch ist die Datei nicht aktiv. Dazu muss zuerst die Datei in verifiziert werden.
<br>
Dazu öffnen man die Datei `/js/settings.js` und fügt dort in die Array die neue Datei hinzu.
<br>

```
var links = ["home.php", "info.php"];

//wird zu

var links = ["home.php", "info.php", "kontakt.php"];
```

<br>
Hatte man zuvor die option ohne `.php` gewählt so muss man nur die Ordnerstrucktur angeben, weil die `Index.php` darin anschliessend automatisch ausgewählt wird.

```
var links = ["home.php", "info.php"];

//wird zu

var links = ["home.php", "info.php", "kontakt/"];
```
