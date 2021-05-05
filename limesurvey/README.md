# LimeSurvey
[Quelle](https://github.com/martialblog/docker-limesurvey)

## Überblick
LimeSurvey ist ein professionelles Umfrage-Tool, welches open-source angeboten wird. Fertig gehostet kann es unter https://www.limesurvey.org angemietet werden oder als Docker-Container auf einem eigenen Server installiert werden.

Das Tool soll unter `umfrage.example.com` erreichbar sein.

## Installation
1. Installiere `git`:
   ```
   apt install git
   ```
2. Klone das Repository
   ```
   git clone https://github.com/martialblog/docker-limesurvey /app/limesurvey
   ```
3. Kopiere die Datei `docker-compose.yml` nach `/app/limesurvey` und überschreibe die alte Version
4. Passe die `docker-compose.yml` an:
   ```
   - "ADMIN_PASSWORD=foobar"         # HIER PASSWORT ANPASSEN
   - "traefik.http.routers.limesurvey.rule=Host(`umfrage.example.com`)"          # HIER DOMAIN EINGEBEN
   - "traefik.http.routers.limesurvey-secure.rule=Host(`umfrage.example.com`)"   # HIER DOMAIN EINGEBEN
   ```
5. Erstelle Ordner
   ```
   mkdir -p /app/limesurvey/data/{db,surveys}
   ```
6. Kopiere `config.php` nach `/app/limesurvey/data/`

## Starten
Im Ordner `/app/limesurvey` den Befehl `docker-compose up -d` aufrufen

## Testen
Das Frontend kann über `https://umfrage.example.com` aufgerufen werden. Um auf das Administrations-Interface zu kommen muss man `https://umfrage.example.com/admin` aufrufen.
