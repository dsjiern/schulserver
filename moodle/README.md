# Moodle
## Überblick
Moodle ist ein kostenloses open-source Lernmanagement-System, das an vielen Schulen und Hochschulen weltweit eingesetzt wird.

Das Moodle soll unter `moodle.example.com` erreichbar sein.

## Installation
1. Kopiere den `moodle`-Ordner nach `/app/moodle`
2. Passe die `docker-compose.yml` an
   1. Passe die Domains an:
      ```
      - "traefik.http.routers.moodle.rule=Host(`moodle.example.com`)"             # HIER DOMAIN EINGEBEN
      - "traefik.http.routers.moodle-secure.rule=Host(`moodle.example.com`)"      # HIER DOMAIN EINGEBEN
      ```
   2. Ggf. MySQL-Passwörter anpassen:
      ```
      - MYSQL_ROOT_PASSWORD=MySQL-rootpwd            # ggf. Passwort anpassen
      ```

## Moodle-System herunterladen
**Anmerkung:** anders als andere Container stellt der Moodle-Container lediglich die nötige Umgebung, nicht aber die HTML-Daten bereit. Diese müssen deshalb manuell heruntergeladen werden.

1. `git` installieren:
   ```
   apt install git
   ```
2. Moodle-Daten herunterladen:
   ```
   cd /app/moodle/moodle
   git clone git://git.moodle.org/moodle.git html
   ```
3. Ordner anlegen:
   ```
   mkdir /app/moodle/moodle/data
   mkdir /app/moodle/db/data
   ```

**Anmerkung:** Standardmäßig ist die aktuelle Entwicklerversion (aktuell 4.0dev) aktiv. Es empfiehlt sich, auf die letzte stabile Version zu wechseln:
1. Ins Verzeichnis wechseln: `cd /app/moodle/moodle/html`
2. Versionen/Branches auflisten: `git branch -a`, die aktuellste Version (Stand 4.5.2021) ist v3.10: `remotes/origin/MOODLE_310_STABLE` (**Anmerkung:** entgegen dem Namen ist die Version 3.11 aktuell noch in der vorläufigen Alpha-Version!)
3. zu diesem Branch wechseln:
   ```
   git branch --track MOODLE_310_STABLE origin/MOODLE_310_STABLE
   git checkout MOODLE_310_STABLE
   ```

Mit dem 3. Schritt kann jederzeit auch auf eine **höhere** Version gewechselt werden. (Ein Downgrade ist so zwar auch möglich, wird aber nicht empfohlen!)
Zukünftige Updates innerhalb derselben Versionsnummer führt man mit `git pull` aus.

**Anmerkung:** Durch die Installation per GIT erhält man die Version 3.10.3+, die wöchentlich Sicherheits-Updates erhält. D.h. der Update-Befehl `git pull` kann prinzipiell einmal wöchentlich aufgerufen werden falls großen Wert auf Sicherheit gelegt wird.

## Starten
Im Ordner `/app/moodle` den Befehl `docker-compose up -d` aufrufen

## Testen
Nachdem die nötigen Daten heruntergeladen wurden kann das Frontend über `https://moodle.example.com` aufgerufen werden und man landet direkt auf der Installations-Oberfläche.

## Frontend einrichten
1. Sprache auswählen
2. Pfade bestätigen (Datenverzeichnis `/var/www/moodledata` auf Standardwert belassen)
3. Datenbanktyp: "MariaDB"
4. Datenbank-Einstellungen:
   * Datenbank-Server: `mdl_mariadb`
   * Datenbank-Name: `moodle`
   * Datenbank-Nutzer: `root`
   * Datenbank-Kennwort: `MySQL-rootpwd`
   * Datenbank-Prefix: `mdl_`
   * Datenbank-Port: leer lassen
   * Unix Socket: leer lassen
5. Urheberrechtshinweis und alle weiteren Schritte bestätigen (**Hinweis:** Die Installation aller Module kann beim ersten Mal ggf. einige Zeit dauern.
6. Nach der Installation aller Module Daten des Admin-Nutzers eingeben
7. Seiteneinstellungen eingeben
