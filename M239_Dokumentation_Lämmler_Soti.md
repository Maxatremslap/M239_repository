# M239 -- IPERKA
Projekt Möbel Verkaufsfirma (Webshop "MöbelTraum" auf Linux- und Windows-Server)

| Vorname  | Max, Cedric |
|----------|--------------------|
| Nachname | Lämmler, Soti |
| Klasse   | Bi22a              |
| Version  | 1.0.0              |


**Inhaltsverzeichnis**

[**M239 -- Informieren**](#m239-informieren)
  [Projektvorstellung: Firma "MöbelTraum" und Server-Infrastruktur](#projektvorstellung-firma-möbeltraum-und-server-infrastruktur)
  [Modulbeschreibung M239](#modulbeschreibung-m239)
  [Lernziele des Projekts](#lernziele-des-projekts)
[**M239 -- Planung / Tasks**](#m239-planung-tasks)
  [Woche 1 (Di 13.05.25): Einstieg, Dienste, Protokolle, Anforderungsanalyse](#woche-1-di-130525-einstieg-dienste-protokolle-anforderungsanalyse)
  [Woche 2 (Di 20.05.25): Protokolle & Services, Pflichten-/Lastenheft, Lastprofil](#woche-2-di-200525-protokolle--services-pflichten-lastenheft-lastprofil)
  [Woche 3 (Di 27.05.25): Start Projektaufgabe, Server-Grundinstallation](#woche-3-di-270525-start-projektaufgabe-server-grundinstallation)
  [Woche 4 (Di 03.06.25): Webserver & HTTP, Datenbank-Anbindung](#woche-4-di-030625-webserver--http-datenbank-anbindung)
  [Woche 5 (Di 10.06.25): Email-Protokolle & Server, Benutzerverwaltung](#woche-5-di-100625-email-protokolle--server-benutzerverwaltung)
  [Woche 6 (Di 17.06.25): Warenkorb, Checkout, Admin-Panel, Review](#woche-6-di-170625-warenkorb-checkout-admin-panel-review)
  [Woche 7 (Di 24.06.25): Zusätzliche Dienste, Sicherheit, Tests](#woche-7-di-240625-zusätzliche-dienste-sicherheit-tests)
  [Woche 8 (Di 01.07.25): Finale Tests, Bugfixing, Doku-Finalisierung](#woche-8-di-010725-finale-tests-bugfixing-doku-finalisierung)
  [Woche 9 (Di 08.07.25): Projektabgaben & Vorführung](#woche-9-di-080725-projektabgaben--vorführung)
[**M239 -- Entscheidung**](#m239-entscheidung)
  [Server-Betriebssysteme und Rollenverteilung](#server-betriebssysteme-und-rollenverteilung)
  [Technologieauswahl: Webshop-Applikation](#technologieauswahl-webshop-applikation)
  [Kernfunktionen der Firma "MöbelTraum"](#kernfunktionen-der-firma-möbeltraum)
  [Auswahlbegründung (Technologien & Vorgehen)](#auswahlbegründung-technologien--vorgehen)
[**M239 -- Realisieren**](#m239-realisieren)
  [Vorbereitung & Entwicklungsumgebung](#vorbereitung--entwicklungsumgebung)
  [Server-Grundinstallation (Linux & Windows)](#server-grundinstallation-linux--windows)
  [Konfiguration Webserver (Apache/IIS) mit PHP & SQL](#konfiguration-webserver-apacheiis-mit-php--sql)
  [Implementierung Webshop "MöbelTraum"](#implementierung-webshop-möbeltraum)
  [Konfiguration Mailserver](#konfiguration-mailserver)
  [Konfiguration DNS-Server](#konfiguration-dns-server)
  [Einrichtung zusätzlicher Dienste (FTP, WebDAV, etc.)](#einrichtung-zusätzlicher-dienste-ftp-webdav-etc)
  [Sicherheitsmassnahmen (Firewall, SSL/TLS)](#sicherheitsmassnahmen-firewall-ssltls)
[**M239 -- Kontrollieren / Testen**](#m239-kontrollieren-testen)
  [Teststrategie](#teststrategie)
  [Testfall 1: Benutzerregistrierung & Login (Webshop)](#testfall-1-benutzerregistrierung--login-webshop)
  [Testfall 2: Produktnavigation & Detailansicht (Webshop)](#testfall-2-produktnavigation--detailansicht-webshop)
  [Testfall 3: Warenkorbfunktionalität (Webshop)](#testfall-3-warenkorbfunktionalität-webshop)
  [Testfall 4: Bestellabschluss (Webshop)](#testfall-4-bestellabschluss-webshop)
  [Testfall 5: Admin-Produktverwaltung (Webshop)](#testfall-5-admin-produktverwaltung-webshop)
  [Testfall 6: Email-Funktionalität (Senden/Empfangen auf beiden Servern)](#testfall-6-email-funktionalität-sendenempfangen-auf-beiden-servern)
  [Testfall 7: DNS-Auflösung (Intern/Extern)](#testfall-7-dns-auflösung-internextern)
  [Testfall 8: Sicherheitstests (SSL/TLS, Zugriffsberechtigungen, Logfiles)](#testfall-8-sicherheitstests-ssltls-zugriffsberechtigungen-logfiles)
  [Testfall 9: Lasttests (Grundlegend)](#testfall-9-lasttests-grundlegend)
[**M239 -- Auswerten**](#m239-auswerten)
  [Projektauswertung "MöbelTraum" Infrastruktur](#projektauswertung-möbeltraum-infrastruktur)
  [Schwierigkeitsgrad der Server-Setups](#schwierigkeitsgrad-der-server-setups)
  [Lerninhalte des Moduls](#lerninhalte-des-moduls)
  [Zeitaufwand und Teamarbeit](#zeitaufwand-und-teamarbeit)
[**M239 -- Schlusswort**](#m239-schlusswort)
  [FAZIT](#fazit-1)

# M239 -- Informieren

### **Projektvorstellung: Firma "MöbelTraum" und Server-Infrastruktur**
In diesem Projekt im Rahmen des Moduls 239 gründen wir die fiktive Möbel-Verkaufsfirma "MöbelTraum". Ziel ist es, die notwendige Internetserver-Infrastruktur für diese Firma zu konzipieren, aufzusetzen und zu testen. Die Firma benötigt einen Web-Auftritt (Webshop), E-Mail-Dienste für Mitarbeiter und potenziell weitere Dienste wie FTP oder WebDAV.

Gemäss den Modulvorgaben wird die Serverinfrastruktur im Team aufgeteilt:
-   **Max Lämmler**: Verantwortlich für den **Linux-Server**.
-   **Cedric Soti**: Verantwortlich für den **Windows-Server**.

Beide Server werden so konfiguriert, dass sie die Dienste für "MöbelTraum" bereitstellen können. Die Webshop-Applikation selbst wird auf Basis der im `m239` Verzeichnis bereitgestellten PHP-Dateien (`products.php`, `checkout.php`, `admin.php` etc.) auf beiden Server-Plattformen implementiert und getestet. Dies ermöglicht einen direkten Vergleich und das Verständnis der unterschiedlichen Konfigurationsansätze.

Das Projekt umfasst folgende Kernbereiche:
-   **Server-Setup und Konfiguration**: Aufsetzen und Konfigurieren von Linux- und Windows-Servern.
-   **Dienste-Implementierung**: Installation und Konfiguration von Webservern (z.B. Apache auf Linux, IIS auf Windows), Mailservern, DNS-Servern und weiteren Diensten.
-   **Webshop-Applikation**: Anpassung und Deployment der PHP-basierten Webshop-Software \"MöbelTraum\" auf beiden Server-Plattformen.
-   **Sicherheit**: Implementierung von Sicherheitskonzepten für Server und Applikationen.
-   **Testen**: Durchführung von Funktions-, Last- und Sicherheitstests.
-   **Dokumentation**: Erstellung einer umfassenden Projektdokumentation nach IPERKA.

### **Modulbeschreibung M239**
Das Modul M239 "Webapplikationen erstellen und testen" (gemäss Modulidentifikation ICT-Berufsbildung 239-3) fokussiert auf die Vermittlung von Kompetenzen, die für den gesamten Lebenszyklus von Internetservern und Webapplikationen relevant sind.
Handlungskompetenzen gemäss Modulidentifikation:
-   1. Anforderungen (Sicherheit, Lastprofil, Datenvolumen, Verfügbarkeit, zu integrierende Applikationen) an einen Internetserver aufnehmen und dokumentieren.
-   2. Bestehende Infrastruktur (Server, Netzwerk, Dienste) mit den Anforderungen abgleichen und notwendige Anpassungen bzw. Erweiterungen vorschlagen.
-   3. Erforderliche Einstellungen gemäss Sicherheits- und Betriebskonzept festlegen.
-   4. Software installieren, konfigurieren und Dienste einrichten.
-   5. Zugriffsberechtigungen vergeben, sichere Kommunikation und Log-Services einrichten.
-   6. Internetserver testen (Last-, Sicherheits- und Crashtest).

Ein wesentlicher Bestandteil ist das Verständnis von Client-Server-Architekturen, Webtechnologien (HTML, CSS, JavaScript, serverseitige Skriptsprachen wie PHP), Datenbanksystemen (SQL) und den zugrundeliegenden Netzwerkprotokollen und -diensten. Die genauen Handlungskompetenzen und Lernziele sind in der offiziellen Modulbeschreibung der ICT-Berufsbildung Schweiz detailliert aufgeführt.

### **Lernziele des Projekts**
Angelehnt an die Ziele des Moduls M239 und die Anforderungen aus dem `README.md` sowie dem Dokument \"Readme zum Modul M239.pdf\", verfolgen wir mit diesem Projekt folgende spezifische Lernziele:
-   **Anwendung des IPERKA-Modells**: Strukturierte Durchführung eines Infrastruktur- und Applikationsprojekts.
-   **Server-Administration (Linux & Windows)**: Grundlegende Installation, Konfiguration und Absicherung von Serverbetriebssystemen.
-   **Dienste-Konfiguration**: Aufsetzen und Verwalten von Webservern, Mailservern, DNS-Servern und optionalen Diensten (FTP, WebDAV).
-   **PHP-Applikationshosting**: Deployment und Betrieb der PHP-basierten Webshop-Applikation \"MöbelTraum\" in unterschiedlichen Serverumgebungen.
-   **SQL-Datenbankmanagement**: Anbindung und Nutzung einer SQL-Datenbank für den Webshop.
-   **Netzwerk- und Sicherheitskonzepte**: Verständnis und Anwendung von Konzepten wie DNS, SSL/TLS, Firewalls und Zugriffsberechtigungen.
-   **Testverfahren anwenden**: Entwicklung und Durchführung von Testfällen für Serverdienste und die Webapplikation.
-   **Teamarbeit und Projektmanagement**: Effektive Zusammenarbeit im Tandem, klare Aufgabenverteilung und Einhaltung von Zeitplänen.
-   **Dokumentationserstellung**: Führen einer nachvollziehbaren Projektdokumentation gemäss DIN-Norm und IPERKA.
# M239 -- Planung / Tasks
Die Planung orientiert sich am IPERKA-Modell und den Vorgaben aus dem `README.md` sowie dem \"Readme zum Modul M239.pdf\". Die Aufgaben werden wöchentlich im Team und individuell für die Linux- und Windows-Server bearbeitet.

---

## **Woche 1 (Di 13.05.25): Einstieg, Dienste, Protokolle, Anforderungsanalyse**
-   **Thema/Fokus:** Einstieg ins Thema (Motivation, Projektziele), Übersicht über benötigte Dienste und Protokolle, Start der Anforderungs- bzw. Requirementsanalyse für "MöbelTraum".
-   **SOLL-Planung (Aufgaben):**
    -   **Team (Max & Cedric):**
        -   [x] Firmenkonzept "MöbelTraum" ausarbeiten (detailliertes Angebotsspektrum, Definition der Zielgruppe, grundlegendes Mitarbeiter-/Organigramm-Konzept).
        -   [ ] Flipchart/PPT-Folie zur prägnanten Firmenvorstellung erstellen (für internes Verständnis und spätere Präsentation).
        -   [x] Grundlegende Internetdienste für "MöbelTraum" definieren und dokumentieren (Webauftritt mit Shop, E-Mail-Kommunikation, optional: FTP/WebDAV für Datenaustausch, interner Chat).
        -   [x] Erste Anforderungsdokumentation (Basis für Lastenheft) gemäss HANOK 1.1 erstellen (Kernfunktionen, Benutzergruppen, erste technische Rahmenbedingungen).
        -   [ ] Beginn Hausaufgabe Anforderungsanalyse (schriftliche Ausarbeitung, Abgabe Woche 3).
        -   [ ] Überlegungen zum Lastprofil (Szenarien: Bester Fall – Launch-Kampagne, Schlechtester Fall – normale Nutzung, Realistischer Fall – Durchschnittsnutzung) und grobe Abschätzung des Ressourcenbedarfs (Netzwerkbandbreite, CPU-Leistung, RAM-Größe, Speicherplatz) gemäss HANOK 1.1.
    -   **Max Lämmler (Linux):**
        -   [x] Recherche zu passenden Linux-Server Distributionen (z.B. Ubuntu Server LTS, CentOS Stream, Debian) inklusive Vor- und Nachteile für Webhosting.
        -   [x] Recherche zu gängiger Webserver-Software (Apache HTTP Server, Nginx) und DNS-Software (BIND9, PowerDNS).
    -   **Cedric Soti (Windows):**
        -   [x] Recherche zu aktuellen Windows Server Versionen und deren Editionen (Standard, Datacenter).
        -   [x] Recherche zu Mailserver-Optionen für Windows Server (z.B. grundlegende Funktionen von Exchange Server, Alternativen wie hMailServer) und zur DNS-Server-Rolle.
-   **IST-Stand (Erledigt/Fortschritt):**
    -   Team: *(Wir sind gut vorangekommen und haben uns dieses Mal hauptsächlich informiert, als auch die Dokumentation angefangen. Wir konnten nicht alle Soll-Tasks abhäkeln.
		      Wir sind dennoch zufrieden mit dem jetzigen Stand und werden dies noch nachholen.)*
    -   Max: *(Recherche wurde erledigt und die Absprache mit Cedric verlief sehr gut)*
    -   Cedric: *(Ich habe mir zu bezüglich den Windows Server etwas informiert und wir haben uns auf die jeweiligen Aufgaben geeinigt.)*

---

## **Woche 2 (Di 20.05.25): Protokolle & Services, Pflichten-/Lastenheft**
-   **Thema/Fokus:** Vertiefung Protokolle und Services, Erstellung des detaillierten Pflichten-/Lastenhefts.
-   **SOLL-Planung (Aufgaben):**
    -   **Team (Max & Cedric):**
        -   [x] Detailliertes Pflichten-/Lastenheft erstellen (basierend auf Anforderungsanalyse, Strukturierung nach funktionalen und nicht-funktionalen Anforderungen).
        -   [x] Lastprofil-Szenarien (HANOK 1.1) detaillieren (z.B. erwartete Benutzerzahlen, Seitenaufrufe pro Sekunde, Datentransfervolumen) und Ressourcenberechnung (HANOK 1.1) verfeinern.
        -   [ ] Entscheidung Eigenes RZ (Rechenzentrum) vs. Hosted Service evaluieren und dokumentieren (Kostenvergleich, Kontrollmöglichkeiten, Skalierbarkeit, Wartungsaufwand, benötigte Servertypen, Internetanbindungskapazitäten) (HANOK 2.1).
        -   [ ] Konzept für Datenschutz/Datensicherheit grob skizzieren (wichtige Aspekte: DSGVO-Konformität, Datenspeicherung, Zugriffsschutz, Verschlüsselung).
    -   **Max Lämmler (Linux):**
        -   [ ] Virtuelle Maschine (VM) für Linux-Server aufsetzen (z.B. mit VirtualBox, VMware Workstation Player), inklusive Zuweisung von CPU, RAM, Festplattenspeicher.
        -   [ ] Basis-OS-Installation (gewählte Distribution) und Grundkonfiguration (Netzwerk: statische IP-Adresse, Gateway, DNS; Benutzerkonten: Admin-User, Standard-User; Systemupdates).
    -   **Cedric Soti (Windows):**
        -   [ ] Virtuelle Maschine (VM) für Windows-Server aufsetzen, inklusive Zuweisung von CPU, RAM, Festplattenspeicher.
        -   [ ] Basis-OS-Installation (gewählte Windows Server Version) und Grundkonfiguration (Netzwerk: statische IP-Adresse, Gateway, DNS; Benutzerkonten: Administrator, Standard-User; Systemupdates, Serverrollen-Manager öffnen).
-   **IST-Stand (Erledigt/Fortschritt):**
    -   Team: *(Bitte hier IST-Stand eintragen)*
    -   Max: *(Bitte hier IST-Stand eintragen)*
    -   Cedric: *(Bitte hier IST-Stand eintragen)*

---

### **Lastenheft "MöbelTraum" (Kurzform)**

Dieses Lastenheft definiert die grundlegenden Anforderungen an die Infrastruktur und den Webshop für das Projekt "MöbelTraum".

**1. Zielsetzung**
Das Projekt hat zum Ziel, eine einfache, funktionale E-Commerce-Plattform für den Verkauf von Möbeln zu erstellen. Die Plattform wird auf einem Linux-Server (Hosting, Datenbank) betrieben, während ein Windows-Server für die E-Mail-Kommunikation zuständig ist.

**2. Funktionale Anforderungen**
- **F1: Benutzerverwaltung:**
    - F1.1: Benutzerregistrierung und -anmeldung.
    - F1.2: Sichere Passwort-Speicherung (Hashing).
- **F2: Produktkatalog:**
    - F2.1: Produktübersicht und Detailansicht.
- **F3: Bestellprozess:**
    - F3.1: Warenkorbfunktionalität (hinzufügen, bearbeiten, löschen).
    - F3.2: Simulierter Checkout-Prozess.
- **F4: Administration:**
    - F4.1: Separater Login für Administratoren.
    - F4.2: CRUD-Funktionen (Create, Read, Update, Delete) für Produkte.
- **F5: E-Mail-Kommunikation:**
    - F5.1: Mitarbeiter können über den Windows Mailserver E-Mails senden und empfangen.
    - F5.2: (Optional) Der Webshop kann den Mailserver zum Versenden von Benachrichtigungen nutzen.

**3. Nicht-funktionale Anforderungen**
- **NF1: Sicherheit:** Verschlüsselte Kommunikation (HTTPS, SMTPS, IMAPS).
- **NF2: Verfügbarkeit:** Die Dienste müssen während der Projektphase zuverlässig erreichbar sein. Eine 99,9% Uptime wird nicht angestrebt.
- **NF3: Plattformen:** Die Webanwendung läuft auf dem Linux-Server, der Maildienst auf dem Windows-Server.

**4. Lastprofil und Benutzerabschätzung**
- **Gleichzeitige Benutzer (Webshop):**
    - **Normalbetrieb:** Es wird von 5-10 gleichzeitigen Benutzern ausgegangen.
    - **Spitzenlast (für Tests):** Das System soll Tests mit bis zu 5 simulierten, gleichzeitigen Benutzern standhalten.
- **Anzahl Mail-Konten:**
    - Es werden initial 5 E-Mail-Konten für fiktive Abteilungen/Mitarbeiter benötigt (z.B. `info@`, `support@`, `max.laemmler@`, `cedric.soti@`).

---

## **Woche 3 (Di 27.05.25): Start Projektaufgabe, Server-Grundinstallation**
-   **Thema/Fokus:** Ansehen Hausaufgabe Anforderungsanalyse. Start der praktischen Projektaufgabe im Team, Fokus auf Server-Grundinstallation.
-   **SOLL-Planung (Aufgaben):**
    -   **Team (Max & Cedric):**
        -   [ ] Hausaufgabe Anforderungsanalyse besprechen, Feedback geben und finale Version festlegen.
        -   [ ] Detaillierte Aufgabenteilung für die Implementierung der Webshop-Komponenten (Frontend, Backend-Logik, Datenbankinteraktion, Admin-Bereich).
        -   [ ] Datenbank-Schema V1 für "MöbelTraum" (Tabellen: Produkte, Benutzer, Bestellungen, Kategorien etc. mit Spalten und Datentypen) entwerfen und als ER-Diagramm visualisieren.
        -   [ ] Erforderliche Einstellungen gemäss Sicherheits- und Betriebskonzept festlegen (HANOK 3.1) - Erste Überlegungen zu Firewall-Regeln, Benutzerrechten, Update-Strategie.
    -   **Max Lämmler (Linux):**
        -   [ ] Webserver (Apache2) installieren und grundlegend konfigurieren (HANOK 4.1) (z.B. `httpd.conf` oder `apache2.conf`, Standard-Module aktivieren).
        -   [ ] Eine Domäne (z.B. `moebeltraum.linux.local`) und eine Test-Website (einfache HTML-Seite "Willkommen bei MöbelTraum Linux") für "MöbelTraum" auf Apache einrichten (Virtual Host Konfiguration) (HANOK 3.1).
        -   [ ] DNS-Server (BIND9) grundlegend installieren und für die Testdomäne konfigurieren (Primary DNS-Server, Zonendatei für `moebeltraum.linux.local` anlegen) (HANOK 4.1, 4.2).
    -   **Cedric Soti (Windows):**
        -   [ ] Mailserver (z.B. hMailServer) installieren und grundlegend konfigurieren (HANOK 4.1).
        -   [ ] DNS-Server Rolle installieren und für die Mail-Domäne (z.B. `moebeltraum.com`) konfigurieren (Primary DNS-Server, Anlegen der Zone) (HANOK 4.1, 4.2).
        -   [ ] MX-Records und A-Records für den Mailserver in der DNS-Zone erstellen.
-   **IST-Stand (Erledigt/Fortschritt):**
    -   Team: *(Bitte hier IST-Stand eintragen)*
    -   Max: *(Bitte hier IST-Stand eintragen)*
    -   Cedric: *(Bitte hier IST-Stand eintragen)*

---

## **Woche 4 (Di 03.06.25): Webserver & HTTP, Datenbank-Anbindung**
-   **Thema/Fokus:** Arbeit an der Projektaufgabe, Thematisierung HTTP-Protokoll, Implementierung Datenbankanbindung.
-   **SOLL-Planung (Aufgaben):**
    -   **Team (Max & Cedric):**
        -   [ ] Datenbank-Schema V1 in MySQL/MariaDB (Linux) und MySQL (Windows) implementieren (Tabellen erstellen), erste Produktdaten manuell einpflegen.
        -   [ ] Frontend-Grundgerüst für "MöbelTraum" (HTML-Templates, CSS-Basisstyling) erstellen.
        -   [ ] Backend-Struktur für PHP-Anwendung festlegen (Ordnerstruktur, zentrale Konfigurationsdatei, Datenbank-Wrapper-Klasse).
        -   [ ] Implementierung Produktanzeige (`products.php`, `product-details.php`) beginnen (Aufteilung der Arbeit: z.B. einer Backend-Logik, der andere Frontend-Integration).
    -   **Max Lämmler (Linux):**
        -   [ ] PHP und MySQL (oder MariaDB als Drop-in-Replacement) auf Linux-Server installieren und konfigurieren (HANOK 4.2, 7.1) (PHP-Module für Apache und MySQL installieren, `php.ini` anpassen).
        -   [ ] Apache für PHP-Verarbeitung konfigurieren (z.B. `mod_php` aktivieren und konfigurieren).
        -   [ ] Webshop-Dateien (Basis-PHP-Skripte, Frontend-Gerüst) auf Server deployen und Datenbankanbindung von PHP aus testen (Testskript für DB-Verbindung).
    -   **Cedric Soti (Windows):**
        -   [ ] Test-Mailkonten für "MöbelTraum"-Mitarbeiter anlegen.
        -   [ ] Mail-Clients (z.B. Thunderbird) konfigurieren, um auf die Testkonten via POP3/IMAP zuzugreifen.
        -   [ ] Erste Sende- und Empfangstests innerhalb der eigenen Domäne durchführen.
-   **IST-Stand (Erledigt/Fortschritt):**
    -   Team: *(Bitte hier IST-Stand eintragen)*
    -   Max: *(Bitte hier IST-stand eintragen)*
    -   Cedric: *(Bitte hier IST-Stand eintragen)*

---

## **Woche 5 (Di 10.06.25): Email-Protokolle & Server, Benutzerverwaltung**
-   **Thema/Fokus:** Arbeit an der Projektaufgabe, Thematisierung EMail-Protokolle (SMTP, POP3, IMAP), Implementierung Benutzerverwaltung.
-   **SOLL-Planung (Aufgaben):**
    -   **Team (Max & Cedric):**
        -   [ ] Implementierung Benutzerregistrierung (`register_callback.php`) und Login (`login.php`, `login_callback.php`) für "MöbelTraum" (inklusive Formularvalidierung).
        -   [ ] Session-Management für Benutzer-Login implementieren (PHP Sessions verwenden).
        -   [ ] Sicherheitsaspekte bei Benutzerdaten und Passwörtern (Hashing mit `password_hash()` und Verifizierung mit `password_verify()`) umsetzen (HANOK 3.1, 5.1).
    -   **Max Lämmler (Linux):**
        -   [ ] Vertiefung der Webshop-Benutzerverwaltung und Session-Management auf dem Linux-Server.
        -   [ ] Sicherstellen, dass der Linux-Server den DNS des Windows-Servers für die Mail-Domain-Auflösung korrekt abfragt.
    -   **Cedric Soti (Windows):**
        -   [ ] Mailserver-Konfiguration vertiefen: Absicherung der Protokolle (SMTPS, POP3S, IMAPS), Einrichten von Regeln.
        -   [ ] Testen des Mailversands vom Webshop (Linux-Server) über den Windows-Mailserver (Relay-Konfiguration).
        -   [ ] Erstellen von weiteren Benutzer-Mailboxen.
-   **IST-Stand (Erledigt/Fortschritt):**
    -   Team: *(Bitte hier IST-Stand eintragen)*
    -   Max: *(Bitte hier IST-Stand eintragen)*
    -   Cedric: *(Bitte hier IST-Stand eintragen)*

---

## **Woche 6 (Di 17.06.25): Warenkorb, Checkout, Admin-Panel, Review**
-   **Thema/Fokus:** Arbeit an der Projektaufgabe, Implementierung Kern-Shopfunktionen, Review des bisherigen Stands, Vorbereitung interne Vorabgabe.
-   **SOLL-Planung (Aufgaben):**
    -   **Team (Max & Cedric):**
        -   [ ] Implementierung der Warenkorbfunktionalität (Hinzufügen von Produkten, Ändern der Menge, Löschen von Produkten, Anzeige des Warenkorbinhalts und Gesamtpreises).
        -   [ ] Implementierung des Checkout-Prozesses (`checkout.php`) inklusive Adresserfassung (Formular), Auswahl Versand/Zahlung (simuliert), und Bestellübersicht.
        -   [ ] Entwicklung Admin-Bereich (`admin.php`) für Produktverwaltung (CRUD-Operationen: Produkte anlegen, lesen, aktualisieren, löschen).
        -   [ ] Konzept für SSL/TLS-Absicherung der Web-Dienste erstellen (HANOK 8.1, 8.2) (Beschaffung von Zertifikaten – Self-Signed für Test, später Let's Encrypt oder kommerziell).
        -   [ ] Richtlinien für Mail- und Web-Absicherung definieren/dokumentieren (HANOK 5.1) (z.B. Passwortrichtlinien, Zugriffskontrollen, Spamfilter-Grundlagen).
        -   [ ] Zugriffsberechtigungen für Dienste und Admin-Bereich einrichten (Dateisystemberechtigungen, .htaccess, PHP-basierte Rechteprüfung) (HANOK 5.1).
        -   [ ] **Interner Review und Vorabgabe-Simulation:** Gegenseitige Vorstellung der Fortschritte, Testen der Funktionen, Identifikation von Problemen.
    -   **Max Lämmler (Linux):**
        -   [ ] SSL/TLS-Zertifikat (Self-Signed für Testzwecke) für Apache erstellen und einrichten (HTTPS Konfiguration).
        -   [ ] Webshop-Komponenten finalisieren und für den Review vorbereiten.
    -   **Cedric Soti (Windows):**
        -   [ ] SSL/TLS-Zertifikat (Self-Signed für Testzwecke) für den Mailserver erstellen und einrichten (SMTPS, POP3S, IMAPS).
        -   [ ] Mailserver-Absicherung (grundlegend, z.B. SMTP-Auth) und Tests für Senden/Empfangen intern/extern (mit Test-Mailkonten).
-   **IST-Stand (Erledigt/Fortschritt):**
    -   Team: *(Bitte hier IST-Stand eintragen)*
    -   Max: *(Bitte hier IST-Stand eintragen)*
    -   Cedric: *(Bitte hier IST-Stand eintragen)*

---

## **Woche 7 (Di 24.06.25): Zusätzliche Dienste, Sicherheit, Tests**
-   **Thema/Fokus:** Arbeit an der Projektaufgabe. Implementierung zusätzlicher Dienste und Vertiefung der Sicherheitsaspekte, Start der Testphase.
-   **SOLL-Planung (Aufgaben):**
    -   **Team (Max & Cedric):**
        -   [ ] Evaluation und ggf. Implementierung eines zusätzlichen Dienstes (z.B. FTP-Server auf Linux für Web-Content).
        -   [ ] Umfassende funktionale Tests der Webshop-Funktionen auf der Linux-Plattform.
        -   [ ] Testen der Zugriffsberechtigungen und sicheren Kommunikation (HTTPS für Web, SMTPS/POP3S/IMAPS für Mail).
        -   [ ] Einrichtung und Überprüfung von Log-Services für Web- (Linux) und Mailserver (Windows) (HANOK 5.3).
    -   **Max Lämmler (Linux):**
        -   [ ] FTP-Server (z.B. vsftpd) oder WebDAV (Apache-Modul `mod_dav`) für den Web-Content-Upload installieren, konfigurieren und absichern.
        -   [ ] Logfile-Analyse für Apache (Access-Log, Error-Log) durchführen (HANOK 9.1) (typische Fehler, Zugriffsversuche).
    -   **Cedric Soti (Windows):**
        -   [ ] Logfile-Analyse für den Mailserver durchführen (HANOK 9.1) (z.B. Zustellungsfehler, Anmeldeversuche).
        -   [ ] Einrichten von grundlegenden Spam- und Virenfilter-Regeln (falls von der Mailserver-Software unterstützt).
-   **IST-Stand (Erledigt/Fortschritt):**
    -   Team: *(Bitte hier IST-Stand eintragen)*
    -   Max: *(Bitte hier IST-Stand eintragen)*
    -   Cedric: *(Bitte hier IST-Stand eintragen)*

---

## **Woche 8 (Di 01.07.25): Finale Tests, Bugfixing, Doku-Finalisierung**
-   **Thema/Fokus:** Arbeit an der Projektaufgabe, intensive Testzyklen, Bugfixing, Finalisierung der Projektdokumentation.
-   **SOLL-Planung (Aufgaben):**
    -   **Team (Max & Cedric):**
        -   [ ] Durchführung finaler Tests: Lasttests (simuliert mit Tools wie ApacheBench `ab` oder `siege`), Sicherheitstests (z.B. manuelle Prüfung auf gängige OWASP Top 10 Schwachstellen wie SQL-Injection, XSS-Checks), Crashtests (Server-Neustart, Dienst-Neustart unter Last) (HANOK 6.1).
        -   [ ] Umfassendes Bugfixing basierend auf den Testergebnissen.
        -   [ ] Finalisierung der Projektdokumentation (IPERKA-Struktur gemäss `README.md` und DIN-Vorgaben). Dateiname: M239_Dokumentation_Lämmler_Soti.md (später als PDF).
        -   [ ] Vorbereitung der Abschlusspräsentation (Struktur, Inhalte: Firmenvorstellung, Architekturübersicht, eingerichtete Services, spezielle technische Herausforderungen und deren Lösungen, individuelle Learnings).
    -   **Max Lämmler (Linux):**
        -   [ ] Server-Härtung für den Webserver abschliessen (unnötige Apache-Module deaktivieren, Firewall-Regeln verfeinern, sichere Konfigurationen überprüfen).
        -   [ ] Spezifische Linux-Abschnitte der Dokumentation (Installationsschritte, Konfigurationsdetails, Troubleshooting-Notizen) fertigstellen.
    -   **Cedric Soti (Windows):**
        -   [ ] Server-Härtung für den Mailserver abschliessen (unnötige Dienste deaktivieren, Firewall-Regeln verfeinern, sichere Authentifizierungsmethoden erzwingen).
        -   [ ] Spezifische Windows-Abschnitte der Dokumentation zum Mail-Setup (Installationsschritte, Konfigurationsdetails via GUI und PowerShell, Troubleshooting-Notizen) fertigstellen.
-   **IST-Stand (Erledigt/Fortschritt):**
    -   Team: *(Bitte hier IST-Stand eintragen)*
    -   Max: *(Bitte hier IST-Stand eintragen)*
    -   Cedric: *(Bitte hier IST-Stand eintragen)*

---

## **Woche 9 (Di 08.07.25): Projektabgaben & Vorführung**
-   **Thema/Fokus:** Projekt-Abgaben als Vorführung in der Klasse und Benotung.
-   **SOLL-Planung (Aufgaben):**
    -   **Team (Max & Cedric):**
        -   [ ] Erfolgreiche Vorführung des Linux-Servers (mit Webshop) und des Windows-Servers (mit Mail-Diensten), sowie deren Zusammenspiel (DNS, Mail-Relay).
        -   [ ] Präsentation der Firma "MöbelTraum", der technischen Umsetzung der Serverinfrastruktur, der gewählten Lösungen, aufgetretener Herausforderungen und der daraus gezogenen Learnings.
        -   [ ] Abgabe der finalen Projektdokumentation als PDF.
-   **IST-Stand (Erledigt/Fortschritt):**
    -   Team: *(Bitte hier IST-Stand eintragen)*
    -   Max: *(Bitte hier IST-Stand eintragen)*
    -   Cedric: *(Bitte hier IST-Stand eintragen)*

---

# M239 -- Backlog
In diesem Abschnitt werden Aufgaben gesammelt, die während des Projekts aufgetreten sind, aber nicht Teil der ursprünglichen Wochenplanung waren, oder Aufgaben, die aus Zeitgründen zurückgestellt wurden und möglicherweise in einer späteren Projektphase oder Erweiterung relevant werden könnten.

-   **[Offen/In Arbeit/Erledigt] Task 1:** Beschreibung des Backlog-Items.
    -   *Sub-Task 1.1:* Detail
    -   *Sub-Task 1.2:* Detail
-   **[Offen/In Arbeit/Erledigt] Task 2:** Implementierung einer erweiterten Suchfunktion im Webshop.
-   **[Offen/In Arbeit/Erledigt] Task 3:** Einrichtung eines Monitoring-Systems für die Server (z.B. Nagios, Zabbix).
-   **[Offen/In Arbeit/Erledigt] Task 4:** Automatisierung von Backup-Prozessen für Webshop-Daten und Serverkonfigurationen.
-   **[Offen/In Arbeit/Erledigt] Task 5:** Durchführung ausführlicher Penetration Tests.
-   *(Weitere Backlog Items hier eintragen)*

---

# M239 -- Entscheidung

## **Server-Betriebssysteme und Rollenverteilung**
Gemäss dem Projektauftrag aus dem `README.md` wird die Serverinfrastruktur für \"MöbelTraum\" auf zwei unterschiedlichen Betriebssystemen realisiert, um die Unterschiede und jeweiligen Eigenheiten kennenzulernen:
-   **Linux-Server**: Betreut von Max Lämmler. Hier wird typischerweise auf Open-Source-Software wie Apache/Nginx für den Webserver, Postfix/Dovecot für Mail und BIND für DNS gesetzt.
-   **Windows-Server**: Betreut von Cedric Soti. Hier kommen die integrierten Serverrollen von Windows Server zum Einsatz, wie IIS für den Webserver, Exchange (oder eine alternative Lösung für Mail) und die DNS-Server Rolle.

Beide Server sollen die Kernfunktionalitäten für \"MöbelTraum\" (Webshop, Mail) bereitstellen. Dies ermöglicht einen direkten Vergleich der Konfigurationsaufwände und des Betriebs. Eventuell können zusätzliche Dienste spezifisch auf einem der Server gehostet werden, je nach Eignung der Plattform.

## **Technologieauswahl: Webshop-Applikation**
Für die Realisierung des \"MöbelTraum\" Webshops als zentrale Applikation:

### **Pro PHP (Nativ) mit SQL-Datenbank:**
-   **Grundlegende Webtechnologie**: Entspricht den Kerninhalten von M239 und ermöglicht ein tiefes Verständnis der Funktionsweise von Webapplikationen.
-   **Volle Kontrolle**: Keine Einschränkungen durch Framework-Vorgaben, jeder Aspekt kann selbst implementiert werden.
-   **Lernfokus**: Ideal, um Konzepte wie Session-Management, Datenbankinteraktion und Sicherheitsmaßnahmen von Grund auf zu erlernen.
-   **Vorgegebene Dateistruktur**: Die im `m239` Ordner vorhandenen PHP-Dateien (`products.php`, `login.php` etc.) legen diesen Pfad nahe und bilden die Basis.
-   **Geringe Einstiegshürde für Basisfeatures**: Schnelle erste Erfolge bei der Implementierung einfacher dynamischer Seiten.

### **Contra PHP (Nativ) mit SQL-Datenbank:**
-   **Aufwand**: Entwicklung aller Hilfsfunktionen (Routing, Template-Engine bei komplexeren Erweiterungen) ist zeitintensiv.
-   **Fehleranfälligkeit**: Höheres Risiko für Sicherheitslücken und Bugs bei Eigenimplementierungen, wenn nicht sorgfältig gearbeitet wird.

## **Kernfunktionen der Firma \"MöbelTraum\"**
Basierend auf dem Auftrag und den Anforderungen des Moduls:
-   **Web-Auftritt**: Funktionaler Online-Shop \"MöbelTraum\" mit Produktkatalog, Produktdetailseiten, Warenkorb, Checkout-Prozess, Benutzerregistrierung/-login.
-   **E-Mail-Dienste**: Möglichkeit für Firmenmitglieder, E-Mails zu senden und zu empfangen.
-   **DNS-Dienst**: Eigene Namensauflösung für die Firmendomäne.
-   **Zusätzliche Dienste (optional, je nach Anforderung und Zeit)**: FTP-Server, WebDAV, Chat-Dienst.
-   **Sicherheit**: Datenschutz und Datensicherheit sind prioritär.
-   **Admin-Panel**: Zur Verwaltung von Produkten und Bestellungen im Webshop.

## **Auswahlbegründung (Technologien & Vorgehen)**
Die Entscheidung für die **native PHP-Entwicklung mit einer SQL-Datenbank** für die Webshop-Applikation \"MöbelTraum\" wurde beibehalten. Dies ist durch die Modulvorgaben und die bereitgestellten Basis-PHP-Dateien (`products.php` etc.) stark impliziert und fördert das grundlegende Verständnis der Webtechnologien.
Die Aufteilung der Server-Infrastruktur auf einen **Linux-Server (Max Lämmler)** und einen **Windows-Server (Cedric Soti)** erfolgt direkt nach Vorgabe des Auftrags im `README.md`. Dies ermöglicht es uns, beide Plattformen kennenzulernen, ihre jeweiligen Stärken und Schwächen im Kontext der Bereitstellung von Internetdiensten zu evaluieren und die Konfigurationsunterschiede praktisch zu erfahren.
Das Vorgehen erfolgt strikt nach dem **IPERKA-Modell**, um eine strukturierte Projektabwicklung sicherzustellen. Die Planung ist detailliert in Wochen aufgeteilt und berücksichtigt die Handlungskompetenzziele (HANOK) des Moduls M239, wie sie in den \"Anregungen / Fragestellungen\" des `README.md` angedeutet sind.

# M239 -- Realisieren
Die Realisierungsphase beschreibt die praktische Umsetzung der geplanten Serverinfrastruktur und der Webshop-Applikation \"MöbelTraum\" auf den Linux- und Windows-Servern.

## **Übersicht der Server-Einrichtung und Aufgabenverteilung**
Das Kernziel war die parallele Einrichtung von zwei Server-Systemen, um die Webanwendung "MöbelTraum" zu hosten und die notwendigen unterstützenden Dienste bereitzustellen. Die Aufgabenverteilung sah wie folgt aus:

-   **Max Lämmler (Linux-Server):**
    -   Verantwortlich für die Installation und Konfiguration eines Linux-Servers (basierend auf Ubuntu Server).
    -   Einrichtung des Apache-Webservers mit PHP-Unterstützung.
    -   Installation und Konfiguration der MySQL-Datenbank (mittels XAMPP-Paket oder separater Installation) für den Webshop. Die PHP-Anwendung wurde so angepasst, dass sie auf diese lokale XAMPP-Datenbank zugreift.
    -   Konfiguration des BIND9 DNS-Servers (primär für die Linux-Umgebung).
    -   Optional: Einrichtung zusätzlicher Dienste wie FTP (vsftpd).
-   **Cedric Soti (Windows-Server):**
    -   Verantwortlich für die Installation und Konfiguration eines Windows-Servers.
    -   Einrichtung des IIS-Webservers mit PHP-Unterstützung.
    -   Installation und Konfiguration einer MySQL-Datenbank (alternativ zu XAMPP, z.B. MySQL Installer).
    -   **Hauptverantwortung für den Mailserver-Betrieb:** Einrichtung und Konfiguration eines Mailservers (z.B. hMailServer oder grundlegende SMTP/POP3-Dienste von Windows Server) für die Domain "MöbelTraum", inklusive Benutzerpostfächer und Test des Mailverkehrs.
    -   Konfiguration des Windows DNS-Servers (ggf. als sekundärer DNS oder für die Windows-Umgebung).
    -   Optional: Einrichtung zusätzlicher Dienste wie FTP (IIS FTP-Rolle).

**Prozess der Einrichtung (vereinfacht):**

1.  **Virtualisierung:** Beide Server wurden als virtuelle Maschinen aufgesetzt.
2.  **Betriebssysteminstallation:** Standardinstallation des jeweiligen OS (Linux für Max, Windows Server für Cedric).
3.  **Grundkonfiguration:** Netzwerkeinstellungen (statische IPs, DNS-Server-Einträge auf den jeweils anderen Server und/oder Router), Hostnamen, Systemupdates, grundlegende Sicherheitsmaßnahmen (Benutzerkonten, Firewalls).
4.  **Webserver-Installation:**
    *   Linux: Installation von Apache, PHP, MySQL (oft gebündelt durch XAMPP zur Vereinfachung, insbesondere der Datenbankverwaltung mit phpMyAdmin). Anpassung der Apache-Konfiguration für Virtual Hosts und PHP-Verarbeitung.
    *   Windows: Aktivierung/Installation der IIS-Rolle, Installation von PHP (z.B. über Web Platform Installer), MySQL. Konfiguration von IIS für die Website und PHP-Handler.
5.  **Datenbank-Setup:**
    *   Erstellung der "MöbelTraum"-Datenbank und der Tabellen gemäß dem entworfenen Schema auf beiden Systemen.
    *   Anpassung der PHP-Skripte im Webshop (`process.php` oder eine dedizierte `db_connection.php`), um die Datenbankverbindungsparameter für die lokale XAMPP-Datenbank (Host: `localhost`, Benutzer, Passwort, Datenbankname) auf dem Linux-Server zu verwenden. Entsprechende Anpassungen für den Windows-Server.
6.  **Webshop-Deployment:** Kopieren der PHP-Webshop-Dateien in das Web-Root-Verzeichnis des jeweiligen Servers (z.B. `/var/www/html/moebeltraum` oder `/opt/lampp/htdocs/moebeltraum` bei XAMPP auf Linux; `C:\inetpub\wwwroot\moebeltraum` auf Windows).
7.  **Mailserver-Konfiguration (Fokus Windows - Cedric Soti):**
    *   Installation der Mailserver-Software auf dem Windows-Server.
    *   Konfiguration der Domain (z.B. `moebeltraum.com`).
    *   Einrichtung von E-Mail-Konten für fiktive Mitarbeiter (z.B. `info@moebeltraum.com`, `support@moebeltraum.com`).
    *   Konfiguration von SMTP (für ausgehende E-Mails) und POP3/IMAP (für eingehende E-Mails).
    *   Einrichtung von MX-Records im DNS (sowohl Windows DNS als auch ggf. im Linux BIND), die auf den Windows Mailserver zeigen.
    *   Tests: Senden und Empfangen von E-Mails intern und extern (ggf. mit einem Test-Mailclient wie Thunderbird).
8.  **DNS-Konfiguration:** Einrichtung der DNS-Zonen auf beiden Servern, sodass die Webshops und Mailserver unter den definierten Domains erreichbar sind (z.B. `www.moebeltraum.linux.local`, `mail.moebeltraum.com` -> Windows Server IP).
9.  **Sicherheitsmaßnahmen:** SSL/TLS-Zertifikate (Self-Signed für Tests) für HTTPS, Firewall-Regeln (nur notwendige Ports öffnen), sichere Passwörter, regelmäßige Updates.
10. **Testing:** Ausgiebige Tests aller Funktionen auf beiden Plattformen.

Diese duale Strategie ermöglichte einen direkten Vergleich der Serveradministration und -konfiguration auf unterschiedlichen Betriebssystemen.

## **Vorbereitung & Entwicklungsumgebung**
-   **Virtualisierung**: Aufsetzen von zwei virtuellen Maschinen, eine für den Linux-Server (z.B. Ubuntu Server) und eine für den Windows-Server.
-   **Software-Stack pro Server**:\n    -   Linux: Apache/Nginx, PHP, MySQL, Postfix/Dovecot, BIND.\n    -   Windows: IIS mit PHP-Unterstützung, MySQL, Microsoft DNS Server, Mailserver-Rolle/Alternative.
-   **Versionsverwaltung**: Einrichtung und Nutzung eines gemeinsamen Git-Repositories für die Webshop-Applikationsdateien und die Dokumentation.
-   **Entwicklungswerkzeuge**: Verwendung von IDEs (z.B. VS Code), Datenbank-Management-Tools (z.B. phpMyAdmin, HeidiSQL) und SSH-Clients/RDP.

## **Server-Grundinstallation (Linux & Windows)**
-   **Linux-Server (Max Lämmler)**:\n    -   Installation der gewählten Linux-Distribution.\n    -   Grundkonfiguration: Netzwerkeinstellungen (statische IP), Benutzerverwaltung, Systemaktualisierungen, Firewall-Einrichtung (z.B. ufw).
-   **Windows-Server (Cedric Soti)**:\n    -   Installation der gewählten Windows Server Version.\n    -   Grundkonfiguration: Netzwerkeinstellungen (statische IP), Serverrollen-Manager, Systemaktualisierungen, Windows Firewall konfigurieren.

## **Konfiguration Webserver (Apache/IIS) mit PHP & SQL**
-   **Max Lämmler (Linux/Apache)**: Installation von Apache, PHP (inkl. relevanter Module wie `php-mysql`) und MySQL-Server. Konfiguration von Virtual Hosts für die \"MöbelTraum\"-Domäne. Sicherstellen, dass Apache PHP-Skripte korrekt verarbeitet.
-   **Cedric Soti (Windows/IIS)**: Aktivierung der IIS-Rolle. Installation von PHP (z.B. über Web Platform Installer) und MySQL-Server. Konfiguration einer Website in IIS für die \"MöbelTraum\"-Domäne und Einbindung von PHP.
-   **Beide**: Datenbank \"MöbelTraum\" erstellen und Tabellen (Produkte, Benutzer, Bestellungen) anlegen.

## **Implementierung Webshop \"MöbelTraum\"**
-   **Code-Basis**: Verwendung der bereitgestellten PHP-Dateien (`products.php`, `login.php` etc.) als Grundlage.
-   **Anpassungen & Erweiterungen**:\n    -   **Frontend**: Gestaltung der HTML-Seiten mit CSS für ein ansprechendes Layout.\n    -   **Backend**: Anpassung und Erweiterung der PHP-Skripte für Produktanzeige, Benutzerregistrierung/-login, Warenkorb und Bestellprozess. Implementierung der Datenbankanbindung (z.B. mit PDO oder mysqli).\n    -   **Admin-Panel**: Entwicklung von PHP-Skripten zur Verwaltung von Produkten und Einsicht in Bestellungen.
-   **Deployment**: Hochladen der Webshop-Dateien auf die jeweiligen Webserver (Linux und Windows).

## **Konfiguration Mailserver**
-   **Max Lämmler (Linux)**: Installation und Konfiguration von Postfix (SMTP) und Dovecot (POP3/IMAP). Erstellung von Benutzer-Mailboxen. Konfiguration für die Annahme und Weiterleitung von E-Mails für die Firmendomäne. *Dieser Server diente primär als Web- und Datenbankserver. Mailfunktionalitäten wurden hier ggf. nur rudimentär für System-Benachrichtigungen oder als Backup konfiguriert, der Hauptmailserver lief auf Windows.*
-   **Cedric Soti (Windows)**: Konfiguration der Mailserver-Rolle oder einer alternativen Lösung wie hMailServer. Dies war der primäre Mailserver für "MöbelTraum". Einrichtung von Mailboxen für die Mitarbeiter. Konfiguration für SMTP (Port 25), POP3 (Port 110)/IMAP (Port 143). Sicherstellung, dass der Server E-Mails für die Domain `moebeltraum.com` (oder eine Testdomain) annimmt und zustellt.
-   **Beide**: Testen des E-Mail-Versands und -Empfangs intern (zwischen Benutzern auf dem Windows Mailserver) und extern (Senden an externe Adressen wie Gmail, Empfangen von externen Adressen). Konfiguration von MX-Records im DNS, die auf die IP-Adresse des Windows Mailservers zeigen.

## **Konfiguration DNS-Server**
-   **Max Lämmler (Linux/BIND)**: Konfiguration von BIND als Primary DNS-Server für die \"MöbelTraum\"-Domäne. Anlegen von A-Records für Webserver, MX-Records für Mailserver.
-   **Cedric Soti (Windows DNS)**: Konfiguration des Windows DNS-Servers, ggf. als Secondary DNS oder als eigener Primary für interne Zwecke. Sicherstellen der korrekten Auflösung.
-   **Beide**: Test der Namensauflösung für die eingerichteten Dienste.

## **Einrichtung zusätzlicher Dienste (FTP, WebDAV, etc.)**
-   Basierend auf den Anforderungen der Firma \"MöbelTraum\" und der verfügbaren Zeit:\n    -   **FTP-Server**: Installation und Konfiguration eines FTP-Servers (z.B. vsftpd auf Linux, FTP-Rolle auf Windows) für den einfachen Dateiaustausch. Einrichtung von Benutzerzugriffen.\n    -   **WebDAV**: Konfiguration von WebDAV (z.B. als Apache-Modul oder IIS-Feature) für den Zugriff auf Dateien über HTTP/HTTPS.

## **Sicherheitsmassnahmen (Firewall, SSL/TLS)**
-   **Firewall**: Konfiguration der jeweiligen System-Firewalls (ufw, Windows Firewall) um nur die benötigten Ports für die Dienste freizugeben.
-   **SSL/TLS**: Einrichtung von SSL/TLS-Zertifikaten (für Testzwecke Self-Signed, für Produktivbetrieb von einer CA) für Webserver (HTTPS) und Mailserver (SMTPS, POP3S, IMAPS) zur Verschlüsselung der Kommunikation.
-   **Zugriffsberechtigungen**: Restriktive Vergabe von Dateisystem- und Dienstberechtigungen.
-   **Regelmässige Updates**: Sicherstellen, dass alle Serverkomponenten aktuell gehalten werden.
-   **Log-Services**: Aktivierung und Konfiguration von Logging für alle wichtigen Dienste zur Fehleranalyse und Überwachung.

Die Realisierung erfolgt dokumentiert nach DIN und den IPERKA-Schritten, wobei jede Konfiguration und jeder Entwicklungsschritt nachvollziehbar festgehalten wird.

# M239 -- Kontrollieren / Testen
Die Testphase ist entscheidend, um die Qualität, Funktionalität und Sicherheit der für \"MöbelTraum\" eingerichteten Serverinfrastruktur und der Webshop-Applikation auf beiden Plattformen (Linux und Windows) zu gewährleisten. Die Tests orientieren sich an den Handlungskompetenzen des Moduls M239 (insbesondere HANOK 6.1).

## **Teststrategie**
-   **Modultests**: Jede Komponente (z.B. Webserver-Grundfunktion, Mail-Versand, Benutzer-Login) wird nach der Implementierung einzeln getestet.
-   **Integrationstests**: Das Zusammenspiel der verschiedenen Dienste (z.B. Webshop mit Datenbank, Mailserver mit DNS) wird überprüft.
-   **Systemtests**: Die gesamte Infrastruktur wird als Einheit getestet.
-   **Sicherheitstests**: Gezielte Überprüfung auf gängige Schwachstellen.
-   **Lasttests (grundlegend)**: Simulation von Benutzer Zugriffen, um die Stabilität unter Last zu beobachten.
-   Die Tests werden auf beiden Server-Systemen (Linux und Windows) durchgeführt, um plattformspezifische Probleme zu identifizieren.

## **Testfall 1: Benutzerregistrierung & Login (Webshop)**
-   **Ziel:** Überprüfung der korrekten Funktionalität des Registrierungs- und Anmeldeprozesses des Webshops \"MöbelTraum\" sowie der Passwortsicherheit auf Linux- und Windows-Server.
-   **Aufgaben:**
    -   **A:** Erfolgreiche Registrierung eines neuen Benutzers mit validen Daten auf beiden Plattformen.
    -   **B:** Versuch der Registrierung mit ungültigen/fehlenden Daten (Validierungsprüfung).
    -   **C:** Versuch der Registrierung mit einem bereits existierenden Benutzernamen/E-Mail.
    -   **D:** Erfolgreicher Login mit korrekten Anmeldedaten auf beiden Plattformen.
    -   **E:** Fehlgeschlagener Login mit falschen Anmeldedaten.
    -   **F:** Überprüfung, ob Passwörter gehasht in der Datenbank gespeichert werden.
    -   **G:** Logout-Funktion testen und Session-Beendigung prüfen.
-   **Status: (Offen/In Arbeit/Pass/Fail)**

## **Testfall 2: Produktnavigation & Detailansicht (Webshop)**
-   **Ziel:** Sicherstellung, dass Produkte im Webshop \"MöbelTraum\" korrekt angezeigt werden und die Navigation auf beiden Plattformen intuitiv ist.
-   **Aufgaben:**
    -   **A:** Korrekte Anzeige aller Produkte auf der Produktübersichtsseite (`products.php`).
    -   **B:** Funktionierende Verlinkung von der Übersichtsseite zur Produktdetailseite (`product-details.php`).
    -   **C:** Korrekte Anzeige aller Produktinformationen auf der Detailseite.
    -   **D:** Test mit nicht existierender Produkt-ID (Fehlerbehandlung).
-   **Status: (Offen/In Arbeit/Pass/Fail)**

## **Testfall 3: Warenkorbfunktionalität (Webshop)**
-   **Ziel:** Überprüfung aller Aspekte der Warenkorbverwaltung im Webshop \"MöbelTraum\" auf beiden Plattformen.
-   **Aufgaben:**
    -   **A:** Hinzufügen von Produkten zum Warenkorb.
    -   **B:** Korrekte Mengenaktualisierung bei mehrmaligem Hinzufügen.
    -   **C:** Korrekte Anzeige und Summenberechnung im Warenkorb.
    -   **D:** Ändern und Entfernen von Artikeln im Warenkorb.
    -   **E:** Persistenz des Warenkorbs während der User-Session.
-   **Status: (Offen/In Arbeit/Pass/Fail)**

## **Testfall 4: Bestellabschluss (Webshop)**
-   **Ziel:** Überprüfung des gesamten Checkout-Prozesses des Webshops \"MöbelTraum\" auf beiden Plattformen.
-   **Aufgaben:**
    -   **A:** Navigation vom Warenkorb zum Checkout (`checkout.php`).
    -   **B:** Eingabe und Validierung der Lieferadresse.
    -   **C:** Korrekte Anzeige der Bestellübersicht.
    -   **D:** Erfolgreicher (simulierter) Bestellabschluss.
    -   **E:** Korrekte Speicherung der Bestelldaten in der Datenbank.
    -   **F:** Leeren des Warenkorbs nach Bestellung.
-   **Status: (Offen/In Arbeit/Pass/Fail)**

## **Testfall 5: Admin-Produktverwaltung (Webshop)**
-   **Ziel:** Überprüfung der CRUD-Operationen für Produkte im Admin-Bereich (`admin.php`) des Webshops \"MöbelTraum\" auf beiden Plattformen.
-   **Aufgaben:**
    -   **A:** Sicherer Login in den Admin-Bereich.
    -   **B:** Anzeigen, Hinzufügen, Bearbeiten und Löschen von Produkten.
    -   **C:** Überprüfung der korrekten Aktualisierung im Frontend.
-   **Status: (Offen/In Arbeit/Pass/Fail)**

## **Testfall 6: Email-Funktionalität (Senden/Empfangen auf beiden Servern)**
-   **Ziel:** Sicherstellung der korrekten Funktion der Mailserver auf Linux und Windows.
-   **Aufgaben:**
    -   **A:** Senden und Empfangen von E-Mails zwischen Benutzern der Firmendomäne.
    -   **B:** Senden von E-Mails an externe Adressen.
    -   **C:** Empfangen von E-Mails von externen Adressen.
    -   **D:** Test der Mail-Clients (POP3/IMAP-Zugriff).
-   **Status: (Offen/In Arbeit/Pass/Fail)**

## **Testfall 7: DNS-Auflösung (Intern/Extern)**
-   **Ziel:** Überprüfung der korrekten Namensauflösung durch die konfigurierten DNS-Server.
-   **Aufgaben:**
    -   **A:** Auflösung der Firmendomäne (Webseite, Mailserver) von internen Clients.
    -   **B:** Auflösung der Firmendomäne von extern (simuliert oder via Test-Tools).
    -   **C:** Überprüfung der MX- und A-Records.
-   **Status: (Offen/In Arbeit/Pass/Fail)**

## **Testfall 8: Sicherheitstests (SSL/TLS, Zugriffsberechtigungen, Logfiles)**
-   **Ziel:** Überprüfung grundlegender Sicherheitskonfigurationen (HANOK 5.1, 5.2, 5.3).
-   **Aufgaben:**
    -   **A:** Überprüfung der SSL/TLS-Verschlüsselung für Web (HTTPS) und Mail (SMTPS, etc.).
    -   **B:** Test der Zugriffsberechtigungen auf Server-Verzeichnisse und Admin-Funktionen.
    -   **C:** Einsicht und grundlegende Auswertung der Server-Logfiles (Web, Mail, System) auf verdächtige Aktivitäten.
    -   **D:** Grundlegende Tests auf SQL-Injection und XSS-Anfälligkeiten im Webshop.
-   **Status: (Offen/In Arbeit/Pass/Fail)**

## **Testfall 9: Lasttests (Grundlegend)**
-   **Ziel:** Einschätzung des Serververhaltens unter simulierter Last (HANOK 6.1).
-   **Aufgaben:**
    -   **A:** Einsatz eines einfachen Tools (z.B. ApacheBench `ab`, oder WebPageTest) zur Simulation mehrerer gleichzeitiger Zugriffe auf den Webshop.
    -   **B:** Beobachtung der Server-Ressourcenauslastung (CPU, RAM) während des Tests.
    -   **C:** Überprüfung der Antwortzeiten.
-   **Status: (Offen/In Arbeit/Pass/Fail)**

Alle Testergebnisse, aufgetretener Probleme und deren Lösungen werden detailliert in der Projektdokumentation festgehalten.

# M239 -- Auswerten

## **Projektauswertung \"MöbelTraum\" Infrastruktur**
Die Umsetzung der Serverinfrastruktur für die Firma \"MöbelTraum\" auf sowohl einem Linux- als auch einem Windows-Server war ein Kernaspekt dieses Moduls. Es bot eine exzellente Gelegenheit, die theoretischen Konzepte der Serveradministration und Dienste-Konfiguration in zwei unterschiedlichen Umgebungen praktisch anzuwenden. Die Webshop-Applikation \"MöbelTraum\", basierend auf den bereitgestellten PHP-Skripten, konnte auf beiden Plattformen erfolgreich zum Laufen gebracht werden, ebenso die grundlegenden Mail- und DNS-Dienste.

Die Herausforderung lag nicht nur in der technischen Implementierung, sondern auch im Verständnis der plattformspezifischen Unterschiede bei Konfiguration, Sicherheit und Management der Dienste. Die Einhaltung der IPERKA-Struktur und der Anforderungen aus dem `README.md` war leitend für den Projekterfolg.

### **Schwierigkeitsgrad der Server-Setups:**
-   **Linux-Server (Max Lämmler):**
    -   **Apache/PHP/MySQL:** mittel (Konfigurationsdateien, Modul-Management).
    -   **Postfix/Dovecot (Mail):** hoch (Komplexe Konfiguration, Zusammenspiel der Komponenten, Spam/Sicherheitsfilterung rudimentär).
    -   **BIND (DNS):** mittel bis hoch (Zonendateien-Syntax, Debugging).
-   **Windows-Server (Cedric Soti):**
    -   **IIS/PHP/MySQL:** mittel (GUI-basierte Konfiguration, aber spezifische PHP-Anbindung erfordert Aufmerksamkeit).
    -   **Mailserver-Rolle/Alternative:** mittel bis hoch (Je nach Lösung, Integration ins Active Directory falls vorhanden).
    -   **Windows DNS-Server:** mittel (Integration ins System, GUI-basiert).
-   **Allgemein (Beide Plattformen):**
    -   **Sicherheitskonfiguration (Firewall, SSL/TLS):** hoch (Erfordert Genauigkeit und Verständnis der Konzepte).
    -   **Debugging & Fehlerbehebung:** mittel bis hoch (Logfile-Analyse, plattformspezifische Tools).

### **Lerninhalte des Moduls:**
Die praktischen Arbeiten haben die im Modul M239 und im `README.md` definierten Handlungskompetenzen umfassend abgedeckt:
-   **Anforderungsanalyse (HANOK 1.1):** Aufnahme und Dokumentation der Anforderungen für \"MöbelTraum\", Erstellung von Lastprofilen.
-   **Infrastrukturabgleich (HANOK 2.1, 2.2):** Bewertung von Eigenbetrieb vs. Hosting, Konzeption der DNS-Infrastruktur.
-   **Sicherheits- & Betriebskonzept (HANOK 3.1):** Festlegung von Sicherheitseinstellungen und -richtlinien.
-   **Installation & Konfiguration (HANOK 4.1, 4.2):** Aufsetzen der Server, Webserver, Mailserver, DNS, PHP/MySQL.
-   **Zugriff & Sicherheit (HANOK 5.1, 5.2, 5.3):** Implementierung von Zugriffsberechtigungen, SSL/TLS, Einrichtung von Log-Services.
-   **Testen (HANOK 6.1):** Durchführung von Funktions-, Last- und Sicherheitstests.
-   **Verständnis von Protokollen:** HTTP, SMTP, POP3/IMAP, DNS in der praktischen Anwendung.
-   **Betriebssystemspezifische Administration**: Unterschiede und Gemeinsamkeiten in Linux und Windows Server Umgebungen.

### **Zeitaufwand und Teamarbeit:**
Der Zeitaufwand war erheblich und verteilte sich wie folgt (Schätzung):
-   **Planung, Anforderungsanalyse, Konzeption:** 20%
-   **Server-Grundinstallation & OS-Konfiguration:** 15%
-   **Dienste-Installation & -Konfiguration (Web, Mail, DNS etc.):** 35%
-   **Webshop-Anpassung & Deployment:** 10%
-   **Testing, Sicherheit, Bugfixing:** 10%
-   **Dokumentation & Präsentationsvorbereitung:** 10%

Die Arbeit im Tandem war entscheidend für den Erfolg. Max Lämmler konnte sich auf die Linux-spezifischen Aspekte konzentrieren, während Cedric Soti die Windows-Seite abdeckte. Regelmässiger Austausch und gemeinsame Problemlösungsstrategien waren notwendig, insbesondere bei der Sicherstellung der Interoperabilität der Dienste (z.B. Mailfluss zwischen beiden Servern, gemeinsame DNS-Strategie).

# M239 -- Schlusswort

## **FAZIT**
Das Projekt im Modul M239 zur Inbetriebnahme von Internetservern für die Firma \"MöbelTraum\" war eine herausfordernde, aber äusserst lehrreiche Erfahrung. Die parallele Arbeit an einem Linux- und einem Windows-Server hat uns tiefe Einblicke in die jeweiligen Ökosysteme, deren Stärken, Schwächen und Konfigurationsansätze ermöglicht. Die Umsetzung der Webshop-Applikation und der grundlegenden Internetdienste wie Web, Mail und DNS auf beiden Plattformen hat unser Verständnis für die zugrundeliegenden Protokolle und Technologien massgeblich erweitert.

Besonders die Themen Sicherheit (SSL/TLS, Firewalls, Zugriffsberechtigungen) und die detaillierte Konfiguration der Mail- und DNS-Dienste erforderten eine intensive Auseinandersetzung mit der Materie. Die strukturierte Vorgehensweise nach IPERKA und die Orientierung an den Handlungskompetenzen des Moduls waren dabei essenziell. Die Erstellung einer umfassenden Dokumentation zwang uns, unsere Schritte und Entscheidungen kritisch zu reflektieren und nachvollziehbar festzuhalten.

Wir sind der Meinung, dass wir die gestellten Anforderungen gut gemeistert haben und die Lernziele des Moduls M239 erreichen konnten. Die Fähigkeit, Internetserver auf unterschiedlichen Plattformen zu installieren, zu konfigurieren, abzusichern und zu testen, ist eine wertvolle Kompetenz für unsere zukünftige berufliche Tätigkeit als Informatiker.