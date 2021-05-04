# Cryptpad

## Überblick
https://cryptpad.fr bietet verschiedene Online-Tools zur Zusammenarbeit. Hierbei werden sämtliche Dateien Ende-zu-Ende verschlüsselt gespeichert, so dass kein Fremder auf die Daten Zugriff hat, nichtmal der Serverbetreiber. Das Ganze ist auch open-source und kann somit auch auf einem eigenen Server installiert werden.

Das Cryptpad soll unter `cryptpad.example.com` erreichbar sein. **Achtung:** zusätzlich muss auch die Domain `sandbox.example.com` angelegt werden!

## Installation
1. Kopiere den `cryptpad`-Ordner nach `/app/cryptpad`
2. Passe die `docker-compose.yml` an
   ```
   - CPAD_MAIN_DOMAIN=cryptpad.example.com                 # HIER DOMAIN EINGEBEN
   - CPAD_SANDBOX_DOMAIN=sandbox.example.com               # HIER DOMAIN EINGEBEN
   - traefik.http.routers.cpad-http.rule=Host(`cryptpad.example.com`, `sandbox.example.com`)    # HIER DOMAINS EINGEBEN
   - traefik.http.routers.cpad-https.rule=Host(`cryptpad.example.com`, `sandbox.example.com`)   # HIER DOMAINS EINGEBEN
   ```
3. Ordner anlegen
   ```
   mkdir -p /app/cryptpad/data/{blob,block,customize,data,files}
   ```
4. Die Datei `/app/cryptpad/data/config.js` anpassen
   ```
   httpUnsafeOrigin: 'https://cryptpad.example.com/'
   adminEmail: 'admin@example.com',
   ```
5. Zugriffsrechte anpassen
   ```
   chown 4001:4001 /app/cryptpad/data/* -R
   ```

## Starten
Im Ordner `/app/cryptpad` den Befehl `docker-compose up -d` aufrufen

**Hinweis:** Der Start dauert relativ lange, d.h. nicht wundern, wenn man nicht sofort die Webseite aufrufen kann.

## Testen
Nachdem der Container gestartet wurde, kann die Seite `https://cryptpad.example.com` aufgerufen werden.

## Aktuelle Probleme:
* Sheet funktioniert noch nicht
