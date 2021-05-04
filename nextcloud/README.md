# Nextcloud
[Quelle](https://goneuland.de/nextcloud-server-mit-docker-compose-und-traefik-installieren/)

## Überblick
Nextcloud ist eine kostenlose Alternative zu kommerziellem Cloud-Speicherplatz wie iCloud, OneDrive,...

Die Nextcloud soll unter `nextcloud.example.com` erreichbar sein.

## Installation
1. Kopiere den `grafana`-Ordner nach `/app/nextcloud`
2. Passe die `docker-compose.yml` an
   1. Passe die Domains an:
   ```
   - "traefik.http.routers.nextcloud-app.rule=Host(`nextcloud.example.com`)"           # HIER DOMAIN EINGEBEN
   - "traefik.http.routers.nextcloud-app-secure.rule=Host(`nextcloud.example.com`)"    # HIER DOMAIN EINGEBEN
   ```
   2. Ggf. MySQL-Passwörter anpassen:
   ```
   - MYSQL_ROOT_PASSWORD=MySQL-rootpwd             # ggf. Passwort anpassen
   - MYSQL_PASSWORD=MySQL-userpwd                  # ggf. Passwort anpassen
   ```
   3. Bei Bedarf die maximale Dateigröße anpassen:
   ```
   PHP_UPLOAD_LIMIT: 4096M                       # ggf. max. erlaubte Dateigröße anpassen
   ```

## Starten
Im Ordner `/app/nextcloud` den Befehl `docker-compose up -d` aufrufen

Hinweis: beim ersten Start werden die Nextcloud-Daten erst automatisch nach `/app/nextcloud/app` heruntergeladen (ca. 600MB). Deswegen kann es hierbei einige Zeit dauern, bis das Frontend erreichbar ist!

## Testen
Nachdem die nötigen Daten heruntergeladen wurden kann das Frontend über `https://nextcloud.example.com` aufgerufen werden und man landet direkt auf der Installations-Oberfläche.

## Frontend einrichten
1. Administrator-Nutzername und beliebiges Passwort dazu eingeben
2. Bei "Speicher & Datenbank" folgendes eingeben:
   1. Datenverzeichnis: `/var/www/html/data` (Standardwert)
   2. Datenbank: `MySQL/MariaDB`
   3. Nutzer: `nextcloud` (oder alternativ was man bei `MYSQL_USER` in der `docker-compose.yml` eingegeben hat)
   4. Passwort: `MySQL-userpwd` (oder alternativ was man bei `MYSQL_PASSWORD` in der `docker-compose.yml` eingegeben hat)
   5. Datenbank: `nextcloud` (oder alternativ was man bei `MYSQL_DATABASE` in der `docker-compose.yml` eingegeben hat)
   6. Host: `nextcloud-db`
3. Bei Bedarf die "empfohlenen Apps" installieren lassen oder den Haken entfernen
4. Mit dem Button bestätigen
