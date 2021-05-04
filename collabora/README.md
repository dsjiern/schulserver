# Collabora Office

## Überblick
Collabora ist das Schwesterprodukt von LibreOffice. Dieses kann dabei auf einem Server installiert und online genutzt werden, indem man die Funktion in verschiedene andere Systeme (z.B. Nextcloud oder Moodle) einbindet.

Das Office soll unter `collabora.example.com` erreichbar sein.

## Installation
1. Kopiere den `collabora`-Ordner nach `/app/collabora`
2. Passe die `docker-compose.yml` an
   1. Passe die Domains an, die Zugriff erhalten sollen:
   ```
   - "domain=moodle.example.com|nextcloud.example.com"          # HIER DOMAINS EINGEBEN
   ```
      **Hinweis:** hier müssen alle Domains mit | getennt angegeben werden, von wo aus überall auf das Collabora-Office zugegriffen werden kann. Das dient als Zugriffsschutz, dass keine Fremden Seiten den Server misbrauchen.
   2. Passe die Domains an:
   ```
   - "traefik.http.routers.collabora.rule=Host(`collabora.example.com`)"              # HIER DOMAIN EINGEBEN
   - "traefik.http.routers.collabora-secure.rule=Host(`collabora.example.com`)"       # HIER DOMAIN EINGEBEN
   ```

## Starten
Im Ordner `/app/collabora` den Befehl `docker-compose up -d` aufrufen

## Testen
Nachdem der Container gestartet wurde, kann die Seite `https://collabora.example.com` aufgerufen werden. Man sollte als Bestätigung lediglich "OK" angezeigt bekommen.

## Verknüpfung mit Moodle
1. Das Plugin `mod_collabora` installieren
2. Als Administrator auf Website-Administration -> Plugins -> Aktivitäten -> Kollaboratives Dokument
3. Bei Collabora-URL `collabora.example.com` eingeben

## Verknüpfung mit Nextcloud
1. Als Administrator die App "Collabora Online" aktivieren/installieren
2. In den Einstellungen "Collabora Online" auswählen
3. "Verwende Deinen eigenen Server" auswählen und die URL `https://collabora.example.com` eingeben
