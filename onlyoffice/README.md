# OnlyOffice

## Überblick
OnlyOffice ist wie CollaboraOffice ein kostenloses Office-Paket, das auch online genutzt und in anderen Systemen (z.B. Nextcloud oder Moodle) eingebunden werden kann. Dieses ist noch verhältnismäßig jung und hat aber eine äußerst gute MS-Office-Dateiunterstützung. Der größte Nachteil daran ist meiner Meinung nach aktuell noch, dass Präsentationen noch keine Animationen unterstützen. Optisch ist OnlyOffice allerdings sehr an das MS-Office angelehnt.

Offline als Programm/App auf allen Systemen kann man das kostenlos nutzen, online ist der kostenlose Umfang jedoch etwas eingeschränkt:
* Maximal 20 gleichzeitige Nutzer (auf dem ganzen Server, nicht pro Dokument)
* Auf Mobilgeräten lediglich lesender Zugriff

Eine Lizenz kann jedoch gekauft und sehr einfach eingebunden werden. Bildungseinrichtungen erhalten einen ordentlichen Rabatt!

Das Office soll unter `onlyoffice.example.com` erreichbar sein.

## Installation
1. Kopiere den `onlyoffice`-Ordner nach `/app/onlyoffice`
2. Passe die `docker-compose.yml` an
   1. Passe das Secret an:
   ```
   - "JWT_SECRET=ganzgeheimesSECRET"         # HIER SECRET EINGEBEN
   ```
      **Hinweis:** dieses dient später als Zugriffsschutz.
   2. Passe die Domains an:
   ```
   - "traefik.http.routers.onlyoffice.rule=Host(`onlyoffice.example.com`)"         # HIER DOMAIN EINGEBEN
   - "traefik.http.routers.onlyoffice-secure.rule=Host(`onlyoffice.example.com`)"  # HIER DOMAIN EINGEBEN
   ```
3. Erstelle Ordner
   ```
   mkdir /app/onlyoffice/data
   ```

## Starten
Im Ordner `/app/collabora` den Befehl `docker-compose up -d` aufrufen

## Testen
Nachdem der Container gestartet wurde, kann die Seite `https://onlyoffice.example.com` aufgerufen werden. Man sollte als Bestätigung eine Willkommensseite angezeigt bekommen.

## Verknüpfung mit Moodle
1. Das Plugin unter https://github.com/logicexpertise/moodle-mod_onlyoffice herunterladen (ganzes Repository als ZIP-Datei)
2. Die ZIP-Datei in Moodle hochladen/installieren
3. Als Administrator auf Website-Administration -> Plugins -> Aktivitäten -> Onlyoffice document
4. Bei Service Address `onlyoffice.example.com` eingeben, bei Secret oben konfiguriertes Secret eintragen

## Verknüpfung mit Nextcloud
1. Als Administrator die App "ONLYOFFICE" aktivieren/installieren
2. In den Einstellungen "ONLYOFFICE" auswählen
3. Als "Serviceadresse" `https://onlyoffice.example.com` und als "Geheimen Schlüssel" das Secret von oben eingeben
