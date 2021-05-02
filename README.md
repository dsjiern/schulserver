# schulserver
Verschiedene Dienste als Docker-Container um selbst einen Server für den Schuleinsatz zu betreiben

# Vorbemerkungen
Das GIT-Repository soll ein paar vorbereitete Docker-Container anbieten, womit man selbst schnell verschiedene Dienste für die Schule betreiben kann. An unserer Schule haben wir hierzu einen externen Server bei Hetzner angemietet. Je nach Bedarf und verfügbarer Internetleitung kann hier natürlich auch ein Server in der Schule dafür herhalten.

Der Server sollte über eine Domain, z.B. `server.example.com` erreichbar sein. Für jeden Dienst wird außerdem je eine Subdomain angelegt. Hierfür bietet sich im DNS jeweils ein CNAME-Eintrag an.

# Grundinstallation
## System
Ich nutze als Grundsystem ein Debian 10 minimal, Docker funktioniert aber auf anderen Distributionen identisch.

## Dateistruktur
Ich werde alle Docker-Container in einem Unterverzeichnis von `/app` ablegen. Außerdem alle Volumes ebenfalls darin in einem Unterverzeichnis `data`. Das erleichtert ein Backup, da hierfür dann lediglich der komplette Ordner kopiert werden muss.

## Installation Docker und Docker-Compose
Als Grundvoraussetzung muss `docker` und `docker-compose` installiert werden.
Unter Debian: ([Quelle](https://docs.docker.com/engine/install/debian/))
```
sudo apt-get remove docker docker-engine docker.io containerd runc
sudo apt-get update
sudo apt-get install apt-transport-https ca-certificates curl gnupg lsb-release
curl -fsSL https://download.docker.com/linux/debian/gpg | sudo gpg --dearmor -o /usr/share/keyrings/docker-archive-keyring.gpg
echo "deb [arch=amd64 signed-by=/usr/share/keyrings/docker-archive-keyring.gpg] https://download.docker.com/linux/debian $(lsb_release -cs) stable" | sudo tee /etc/apt/sources.list.d/docker.list > /dev/null
sudo apt-get update
sudo apt-get install docker-ce docker-ce-cli containerd.io
```

Anschließend noch `docker-compose` ([Quelle](https://docs.docker.com/compose/install/))
```
sudo curl -L "https://github.com/docker/compose/releases/download/1.29.1/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose
sudo chmod +x /usr/local/bin/docker-compose
```

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

# Prometheus + Grafana

# LDAP

# Mailcow

# Moodle

# Nextcloud

# BigBlueButton

# Jitsi

# Gitea

# CollaboraOffice

# OnlyOffice

# Cryptpad

# LimeSurvey

# YOURLS

# Zammad

# Planka
