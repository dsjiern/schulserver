# Jitsi
[Quelle](https://goneuland.de/jitsi-kostenlose-online-videokonferenz-einrichten-mit-docker-und-traefik/)

## Überblick
Jitsi ist eine einfache Videokonferenz-Software.

Sie soll unter `jitsi.example.com` erreichbar sein.

## Installation
1. Installiere `git`:
   ```
   apt install git
   ```
2. Klone das Jitsi-Repository
   ```
   git clone https://github.com/jitsi/docker-jitsi-meet /app/jitsi
   ```
3. Kopiere die Datei `docker-compose.override.yml` nach `/app/jitsi`
4. Wechsle ins Verzeichnis und kopiere die Umgebungsvariablen:
   ```
   cd /app/jitsi
   cp env.example .env
   ```
5. Generiere Passwörter
   ```
   ./gen-passwords.sh
   ```
6. Lösche die Zeilen aus der `docker-compose.yml`:
   ```
   ports:
     - '${HTTP_PORT}:80'
     - '${HTTPS_PORT}:443'
   ```
7. Passe die `docker-compose.override.yml` an:
   ```
   - "traefik.http.routers.web.rule=Host(`jitsi.example.com`)"                 # HIER DOMAIN EINGEBEN
   - "traefik.http.routers.web-secure.rule=Host(`jitsi.example.com`)"          # HIER DOMAIN EINGEBEN
   ```
8. Passe die `.env` an:
   ```
   CONFIG=./data
   ENABLE_LETSENCRYPT=0
   PUBLIC_URL=https://jitsi.example.com
   ```

## Starten
Im Ordner `/app/jitsi` den Befehl `docker-compose up -d` aufrufen

## Testen
Das Frontend kann über `https://jitsi.example.com` aufgerufen werden. Abschließend lässt sich das System direkt nutzen.
