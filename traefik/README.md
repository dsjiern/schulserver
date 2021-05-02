# Traefik
[Quelle](https://goneuland.de/traefik-v2-reverse-proxy-fuer-docker-unter-debian-10-einrichten/)

## Überblick
Traefik bietet die Funktion eines Reverse-Proxy um mehrere Docker-Dienste auf einem Server anzubieten. Hierbei werden die nötigen SSL-Zertifikate automatisch per Let's Encrypt eingerichtet.

Das Traefik-Interface soll dann unter `traefik.example.com` erreichbar sein. (Die Subdomain muss natürlich wie alle folgenden zuerst im DNS angelegt werden!)

## Einrichtung
1. Installiere `apache2-utils` um das Passwort zu generieren: `apt-get install apache2-utils`
2. Generiere das Zugangspasswort `echo $(htpasswd -nb user password) | sed -e s/\\$/\\$\\$/g` (Benutzername `user`, Passwort `password` anpassen)
3. Kopiere den `traefik`-Ordner nach `/app/traefik`
4. Passe Rechte an: `chmod 600 /app/traefik/data/acme.json`
5. Passe die `docker-compose.yml` an
   1. Füge das oben generierte Passwort nach dem "=" ein:
   ```
   - "traefik.http.middlewares.traefik-auth.basicauth.users="               # HIER PASSWORT EINTRAGEN
   ```
   2. Passe die Domains an:
   ```
   - "traefik.http.routers.traefik.rule=Host(`traefik.example.com`)"        # HIER DOMAIN EINTRAGEN
   - "traefik.http.routers.traefik-secure.rule=Host(`traefik.example.com`)" # HIER DOMAIN EINTRAGEN
   ```
6. Passe die `data/traefik.yml` an
   1. Füge für Let's Encrypt eine E-Mail-Adresse ein:
   ```
   email:                # HIER E-MAIL EINTRAGEN
   ```

## Starten
Im Ordner `/app/traefik` den Befehl `docker-compose up -d` aufrufen.

## Testen
Im Browser `https://traefik.example.com` aufrufen. Wenn alles funktioniert hat, dann sollte hier - nach der Anmeldung mit den unter Schritt 2 generierten Zugangsdaten - das Traefik-Webinterface erscheinen.
