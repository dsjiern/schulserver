# schulserver
Verschiedene Dienste als Docker-Container um selbst einen Server für den Schuleinsatz zu betreiben

**Anmerkung:** Die auf dieser Übersicht aufgelisteten Dienste/Docker sollen in naher Zukunft noch beschrieben werden. Weiteren Ideen und Anmerkungen bitte gerne melden.

**Anmerkung 2:** Aktuell wird lediglich die Installation der Dienste beschrieben, es sollen weitere Informationen und Tipps für verschiedene Einstellungen folgen.

# Vorbemerkungen
Das GIT-Repository soll ein paar vorbereitete Docker-Container anbieten, womit man selbst schnell verschiedene Dienste für die Schule betreiben kann. An unserer Schule haben wir hierzu einen externen Server bei Hetzner angemietet. Je nach Bedarf und verfügbarer Internetleitung kann hier natürlich auch ein Server in der Schule dafür herhalten.

Der Server sollte über eine Domain, z.B. `server.example.com` erreichbar sein. Für jeden Dienst wird außerdem je eine Subdomain angelegt. Hierfür bietet sich im DNS jeweils ein CNAME-Eintrag an.

Die Installationshinweise und nötigen Anpassungen sind in den jeweiligen Unterordnern hier im Repository.

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
Traefik bietet die Funktion eines Reverse-Proxy um mehrere Docker-Dienste auf einem Server anzubieten. Hierbei werden die nötigen SSL-Zertifikate automatisch per Let's Encrypt eingerichtet.

# Grafana
Grafana bietet Dashboards zur Überwachung von Systemen und Datenauswertungen an und kann automatisiert auch Warnungen per E-Mail verschicken. Hierbei können verschiedene Datenquellen verwendet werden.

# LDAP

# Mailcow

# Moodle
Moodle ist ein kostenloses open-source Lernmanagement-System, das an vielen Schulen und Hochschulen weltweit eingesetzt wird.

# Nextcloud
Nextcloud ist eine kostenlose Alternative zu kommerziellem Cloud-Speicherplatz wie iCloud, OneDrive,...

# BigBlueButton
BigBlueButton ist ein kostenloses Web-Videokonferenzsystem, das optimale Funktionen für den Schuleinsatz bietet.

# Jitsi

# Gitea
Mit Gitea kann auf einem eigenen Server ein GIT-System ähnlich https://www.github.com installiert werden. Der Vorteil für die Schule liegt klar auf der Hand: Da es auf einem eigenen Server betrieben wird, ist man nicht abhängig von amerikanischen Anbietern und ist somit datenschutzkonform.

Gitea bitet dabei sowohl die Möglichkeit über `git`-Befehle als auch per Webfrontend zuzugreifen.

# Collabora Office
Collabora ist das Schwesterprodukt von LibreOffice. Dieses kann dabei auf einem Server installiert und online genutzt werden, indem man die Funktion in verschiedene andere Systeme (z.B. Nextcloud oder Moodle) einbindet.

# OnlyOffice
OnlyOffice ist wie CollaboraOffice ein kostenloses Office-Paket, das auch online genutzt und in anderen Systemen (z.B. Nextcloud oder Moodle) eingebunden werden kann. Dieses ist noch verhältnismäßig jung und hat aber eine äußerst gute MS-Office-Dateiunterstützung. Der größte Nachteil daran ist meiner Meinung nach aktuell noch, dass Präsentationen noch keine Animationen unterstützen. Optisch ist OnlyOffice allerdings sehr an das MS-Office angelehnt.

# Cryptpad
https://cryptpad.fr bietet verschiedene Online-Tools zur Zusammenarbeit. Hierbei werden sämtliche Dateien Ende-zu-Ende verschlüsselt gespeichert, so dass kein Fremder auf die Daten Zugriff hat, nichtmal der Serverbetreiber. Das Ganze ist auch open-source und kann somit auch auf einem eigenen Server installiert werden.

# LimeSurvey

# YOURLS

# OpenSlides

# Zammad

# Planka

# ProFormA

# TYPO3 für Homepage

# Joomla für Homepage

# WordPress für Homepage

# pures PHP/MySQL für Homepage

# open | Schulportfolio
