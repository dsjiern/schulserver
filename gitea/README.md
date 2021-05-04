# Gitea

## Überblick
Mit Gitea kann auf einem eigenen Server ein GIT-System ähnlich https://www.github.com installiert werden. Der Vorteil für die Schule liegt klar auf der Hand: Da es auf einem eigenen Server betrieben wird, ist man nicht abhängig von amerikanischen Anbietern und ist somit datenschutzkonform.

Gitea bitet dabei sowohl die Möglichkeit über `git`-Befehle als auch per Webfrontend zuzugreifen.

Das GIT soll unter `git.example.com` erreichbar sein.

## Installation
1. Kopiere den `gitea`-Ordner nach `/app/gitea`
2. Passe die `docker-compose.yml` an
   ```
   - "traefik.http.routers.gitea.rule=Host(`git.example.com`)"                  # HIER DOMAIN EINGEBEN
   - "traefik.http.routers.gitea-secure.rule=Host(`git.example.com`)"           # HIER DOMAIN EINGEBEN
   ```

## Starten
Im Ordner `/app/gitea` den Befehl `docker-compose up -d` aufrufen

## Testen
Nachdem der Container gestartet wurde, kann die Seite `https://git.example.com` aufgerufen werden.

## Einrichtung Frontend
Mit einem Klick auf "Anmelden" wird man automatisch auf die Erstkonfiguration weitergeleitet:
1. Datenbankeinstellungen belassen! Diese wurden schon in der `docker-compose.yml` hinterlegt
2. Allgemeine Einstellungen
   * Seitentitel anpassen
   * Pfade belassen!
   * SSH-Server-Domain: `git.example.com` (SSH funktioniert zwar noch nicht, ist später aber umständlich zu ändern)
   * SSH-Server-Port entfernen (SSH funktioniert noch nicht)
   * Gitea-HTTP-Listen-Port auf `3000` lassen
   * Gitea-Basis-URL: `https://git.example.com` eintragen
