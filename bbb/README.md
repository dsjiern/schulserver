# BigBlueButton
[Quelle](https://github.com/bigbluebutton/docker/)

## Überblick
BigBlueButton ist ein kostenloses Web-Videokonferenzsystem, das optimale Funktionen für den Schuleinsatz bietet.

Das System soll unter `bbb.example.com` erreichbar sein.

## Installation
1. In den Ordner `/app` wechseln:
   ```
   cd /app
   ```
2. Falls noch nicht passiert `git` installieren:
   ```
   apt install git
   ```
3. BBB-Repository klonen und in den Ordner wechseln:
   ```
   git clone -b main --recurse-submodules https://github.com/bigbluebutton/docker.git bbb
   cd bbb
   ```
4. Setup-Skript ausführen:
   ```
   ./scripts/setup
   ```
   1. `Should greenlight be included?` -> Soll Greenlight mitinstalliert werden? Bietet sich an, um BBB auch unabhängig von Moodle/... nutzen zu können -> mit `y` bestätigen
   2. `Should an automatic HTTPS Proxy be included?` -> unbedingt `n` auswählen, denn das übernimmt Traefik!
   3. `Should a Prometheus exporter be included?` -> kann mit `y` bestätigt werden, wenn Statistiken über Grafana angezeigt werden sollen
   4. `Please enter the domain name:` -> Domain `bbb.example.com` angeben
   5. `Should the recording feature be included?` -> Aus Datenschutzgründen muss die Aufzeichnungsfunktion für Schulen deaktiviert systemweit deaktiviert werden! (s. [hier im Abschnitt "Problem - Aufzeichnung von Videokonferenzen"](https://datenschutz-schule.info/datenschutz-check/bigbluebutton-videokonferenzen/))
   6. `Is ... your external IPv4 address?` -> mit `y` bestätigen
   7. `Is ... your external IPv6 address?` -> mit `y` bestätigen (Abfrage komt nur, wenn eine IPv6-Adresse erkannt wurde)
5. **Wichtig:** da Traefik benutzt wird, muss die `docker-compose.tmpl.yml` angepasst werden: In Zeile 130 im Abschnitt `nginx` muss die Zeile `network_mode: host` entfernt werden.
6. Generiere die `docker-compose.yml` auf Basis des geänderten Templates neu:
   ```
   ./scripts/generate-compose
   ```
   **Hinweis:** dieser Schritt muss auch nach jeder Änderung an den Einstellungen in der Datei `.env` passieren!
7. Kopiere die `docker-compose.override.yml` nach `/app/bbb/`

## Starten
Im Ordner `/app/bbb` den Befehl `docker-compose up -d` aufrufen.

**Hinweis:** Beim ersten Start werden die Container erstellt. Dieser Vorgang dauert ca. 30 Minuten!

## Admin-Nutzer anlegen
Wenn Greenlight mitinstalliert wurde muss hierfür ein Admin-Nutzer angelegt werden: [Quelle](https://docs.bigbluebutton.org/greenlight/gl-admin.html#creating-an-administrator-account)
```
docker exec bbb_greenlight_1 bundle exec rake user:create["name","email","password","admin"]
```

## Testen
Das Frontend kann jetzt unter `https://bbb.example.com` aufgerufen worden. Es sollte automatisch zum Greenlight-Frontend weitergeleitet werden, wo man sich mit oben angelegten Admin-Nutzerdaten anmelden kann.

## Secret
Soll BigBlueButton mit externen Systemen, wie z.B. Moodle, gekoppelt werden, braucht man das Secret, das am Anfang der Datei `.env` eingetragen wurde.
