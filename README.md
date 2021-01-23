## Installation

### Lade die Reposetory per command herunter

`git clone git@github.com:LelilolZH/Webseite-Forlage.git`
oder
`git clone https://github.com/LelilolZH/Webseite-Forlage.git`

### Lade die Reposetory per Zip herunter

Lade die Datei als Zip herunter und entpacke sie anschliessend in den gewünschten Projektordner.
`https://codeload.github.com/LelilolZH/Webseite-Forlage/zip/main`

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
