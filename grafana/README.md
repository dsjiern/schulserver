# Grafana und Prometheus
[Quelle](https://goneuland.de/grafana-mit-docker-compose-und-traefik-installieren/)

## Überblick
Grafana bietet Dashboards zur Überwachung von Systemen und Datenauswertungen an und kann automatisiert auch Warnungen per E-Mail verschicken. Hierbei können verschiedene Datenquellen verwendet werden.

Für die einfache Systemüberwachung verwende ich Prometheus.

Das Grafana-Interface soll dann unter `stat.example.com` erreichbar sein. (Subdomain davor im DNS anlegen!)

## Einrichtung
1. Kopiere den `grafana`-Ordner nach `/app/grafana`
2. Passe Rechte an: `chmod 1000:1000 /app/grafana/grafana`
3. Passe die `docker-compose.yml` an
   1. Passe die Domains an:
   ```
   - "traefik.http.routers.grafana.rule=Host(`stat.example.com`)"        # HIER DOMAIN EINGEBEN
   - "traefik.http.routers.grafana-secure.rule=Host(`stat.example.com`)" # HIER DOMAIN EINGEBEN   
   ```

## Starten
Im Ordner `/app/grafana` den Befehl `docker-compose up -d` aufrufen

## Testen
Im Browser `https://stat.example.com` aufrufen. Die Zugangsdaten lauten:
* Name: **admin**
* Passwort: **admin**

## Frontend einrichten
1. Mit Prometheus-Datenquelle verbinden
   1. Auf `Add data source` klicken
   2. `Prometheus` auswählen
   3. Bei URL `http://mon_prometheus:9090` eingeben
   4. Mit `Save & Test` bestätigen
2. Dashboard hinzufügen
   1. Links auf `+` und dann auf `Import` klicken
   2. Dort den Code aus der Datei `grafana/dashboard.json` einfügen
   3. Mit `Load` und anschließend mit `Import` bestätigen
