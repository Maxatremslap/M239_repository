
||
| :- |
||

![Bildergebnis für tbz Logo technische berufsschule]Technische Berufsschule Zürich TBZ



Abteilung![](Aspose.Words.af13f091-b9fe-44fc-9d7e-da8a9a9c3370.002.png) IT
M182 - Dokumentation
# <a name="_toc182902242"></a>M182 – IPERKA
Projekt SQL Injection – Linux

|Vorname|Max, Cédric, Nicola|
| :- | :- |
|Nachname|Lämmler, Soti, Mäder|
|Klasse|Bi22a|
|Version|1\.0.0|












**Inhaltsverzeichnis**

[**M182 – Informieren	1****](#_toc182902243)

[Kursstruktur	1](#_toc182902244)

[Lernziele	1](#_toc182902246)

[**M182 – Planung / Tasks	2****](#_toc182902247)

[Milestones	2](#_toc182902248)

[**M182 – Entscheidung	3****](#_toc182902259)

[**M182 – Realisieren	4****](#_toc182902260)

[**M182 – Kontrollieren / Testen	5****](#_toc182902261)

[**M182 – Auswerten	6****](#_toc182902262)

[**M182 – Schlusswort	7****](#_toc182902263)







**	


7


# <a name="_toc182902243"></a>M182 – Informieren
### <a name="_toc182902244"></a>**Projektstruktur**
- **Themenauswahl: SQL Injection**
- **Was ist eine SQL Injection?**
  - Eine SQL Injection ist ein modifizierter Input, den man bei SQL basierten Systemen benutzt, meist bei Input-Felder wie Benutzernamen, um Daten zu stehlen oder um es zu sabotieren**.**
- **Wie sieht eine SQL Injection aus?**
  - Eine einfache SQL-Injection sieht zum Beispiel so aus:
    Admin’ OR ‘1’=’1
- **Wie verteidigt man sich dagegen?**
  - Man kann sich mit vorbereiteten Statements beschützen, die wenig Spielraum ermöglichen, für Statements, die nicht vorhergesehen waren. Ebenso kann man sensible Charakter verbieten wie zum Beispiel Quote und Leerzeichen. 
### <a name="_toc182902246"></a> **Lernziele**
- Schwerpunktthema, Doku-Draft und Vorgehensweise festlegen
- Lernprodukt erstellen 
- Massnahmen zur Prävention erstellen
- Präsentation vorbereiten & durchführen
### **Passwörter**
- **Kali – Linux:**
  - Username: kali
  - Password: kali
- **Metasploit:**
  - Username: max
  - Password: root

# <a name="_toc182902247"></a>M182 – Planung / Tasks
## <a name="_toc182902248"></a>**Milestone 1 - 18.03.2025**
**Thema verstehen:**
### **Projektstart:**
- Rollen und Aufgabenverteillung
- Aufgaben plannen

## <a name="_toc182902252"></a>**Milestone 2 - 01.04.2025**
**SQL Injections:**
### **Verstehen und durchführen:**
- Verschiedene Methoden auflisten
- Verstehen und durchführen
- Dokumentieren

## <a name="_toc182902255"></a>**Milestone 3 - 15.04.2025**
**Fehler beheben:**
### **SQL Blind Injection:**
- Fehler finden
- SQL blind injection erfolgreich durchführen.
- Plannung für weiteres vorgehen
- Teambesrpechung, um die Aufgaben erneut zu verteilen.

## **Milestone 4 - 04.05.2025**
**Abschluss:**
### **Fertigstellen:**
- Video schneiden und Voice-Over
- Dokumentation fertigstellen
- Kriterien überprüfen
- Projekt abgeben.


# <a name="_toc182902259"></a>M182 – Entscheidung
## **Auswahl: Hacking Themen**
### **Pro SQL Injection:**
- **Hohe Relevanz –** SQL-Injection ist eine der häufigsten Sicherheitslücken, daher ein wichtiges Thema.
- **Technische Tiefe –** Du kannst verschiedene Schutzmassnahmen wie vorbereitete Statements und Input-Validierung untersuchen.
- **Ethical Hacking-Aspekt –** Ein gutes Verständnis hilft bei der Entwicklung sicherer Anwendungen und Schutzmassnahmen.
### **Contra SQL Injection:**
- **Komplexität –** Erfordert solide Kenntnisse über Datenbanken und SQL.
- **Rechtliche Sensibilität –** Die Demonstration von SQL-Injection kann ethische und rechtliche Risiken bergen.
- **Wenig Originalität –** Es gibt bereits viele Studien und Projekte dazu, was es schwierig machen kann, sich abzuheben.
### **Pro Keylogger:**
- **Cybersecurity-Relevanz –** Keylogger werden oft für Hacking und Überwachung genutzt, ein spannendes Thema.
- **Bewusstseinsbildung –** Ein Projekt könnte Menschen über die Risiken und Schutzmassnahmen aufklären.
- **Praktische Demonstrationen –** Du könntest Test-Szenarien erstellen, die zeigen, wie Keylogger funktionieren.
### **Contra Keylogger:**
- **Ethische Bedenken –** Keylogger haben oft einen negativen Ruf und erfordern eine sorgfältige ethische Betrachtung.
- **Gesetzliche Einschränkungen –** Das Vorführen von Keylogger-Tools könnte rechtliche Risiken mit sich bringen.
- **Geringere technische Tiefe –** Im Vergleich zu SQL-Injection sind Keylogger eher auf das Abfangen von Tastatureingaben fokussiert.

## **Auswahlbegründung**   
Wir haben uns für SQL Injection entschieden, da wir den Begriff immer wieder gehört haben, jedoch nicht wirklich wussten, wie so etwas funktioniert. Es ist wie mit dem Internet: Jeder kennt das Internet und weiss, was es ist, jedoch können es nur ganz wenige wirklich gründlich erklären. Mit diesem Gedanken haben wir uns dann auf SQL Injection geeinigt.

# <a name="_toc182902260"></a>M182 – Realisieren
## **Vorbereitung**
**Als erstes haben wir mit Kali Linux und Metasploitable gearbeitet, um eine SQL Injection zu machen, die von Metasploit bereitgestellt wird. Dies verlief nicht ganz wie erhofft, da der Zugriff auf die Metasploit VM nicht funktionierte.**
## **Fehler Behebung**
**Da wir nicht weiter kamen mit der Metasploit VM, haben wir nach Lösungen gesucht, woran das Problem liegen könnte. Währenddessen ist uns aufgefallen, dass wir nicht dringend Metasploit benutzen müssen, weshalb wir auf diese Methode verzichtet und nach einer anderen gesucht haben.**
## **Testumgebung**
**Danach sind wir auf eine Website gestossen, die dies bereitgestellt hat und so konnten wir dann auch schon die erste SQL Injection durchführen. Diese war jedoch ziemlich einfach, weshalb wir uns darauf geeinigt haben, dass wir noch eine 2 Methode antreten, die etwas anspruchsvoller ist.**
## **Blind SQL Injection**
**Nachdem wir über weitere Methoden recherchiert haben, sind wir dann auch Blind SQL Injection gestossen und fanden dies eine zufriedenstellende Herausforderung. Aus diesem Grund mussten wir erstmals lernen, wie diese Methode funktioniert und sie dann auch durchführen.**
## **Portswinger Testumgebung**
**Dann sind wir auf eine Testumgebung gestossen, die dies bereitstellt. Nachdem wir alles bereit hatten, haben wir uns dran gemacht und haben die Blind SQL Injection erfolgreich durchgeführt.**
## **Aufnahme**
**Nachdem wir beide Methoden hatten, haben wir sie nochmals durchgeführt und sie dann auch aufgenommen, um es später vorzeigen zu können.**
## **Voice Over**
**Als die Aufnahmen fertig waren, wurden die Videos noch zusammengeschnitten und editiert, als auch noch ein Voice Over hinzugefügt, um das vollständige Produkt zu haben.**




# <a name="_toc182902261"></a>M182 – Kontrollieren / Testen
**Testfall:**
### **Ziel:** Überprüfung, ob Benutzereingaben auf schädliche SQL-Befehle geprüft werden. 
### **Aufgaben:**
- **A:** Eingabe eines normalen Benutzernamens und Passworts
- **B:** Eingabe von ' OR '1'='1' -- als Benutzername
- **C:** Überprüfung, ob die Anwendung unerwartete Eingaben blockiert
### **Status: Pass**

**Testfall 2:** 
### **Ziel:** Auf Blind SQL Injection Lücke testen.
### **Aufgaben:** 
- **A: Simple SQL Injection ist nicht verfügbar.**
- **B: Kleine Message, die auftaucht, wenn man erfolgreich eingeloggt ist.**
- **C: SQL Injection mit Burpsuite durchführen und das Passwort des Admins erraten.**
### **Status: Pass**


# <a name="_toc182902262"></a>M182 – Auswerten
**SQL Injection:** 
### SQL Injection ist ein sehr umfangreiches Thema, da es verschiedenste Methoden gibt, um es durchzuführen. In diesem Projekt haben wir nur zwei von vielen abgedeckt, und es gibt noch viele weitere, die man lernen kann, solange Interesse besteht. Dennoch war es ein sehr gutes Thema, da wir so lernen konnten, wie man sich gegen eine so weitverbreitete Hacking-Methode schützt und wie sie durchgeführt wird.

### **Schwierigkeitsgrad:**
- ### **Simple SQL Injection:** einfach
- ### **Blind SQL Injection:** mittel
### **Lerninhalte:**
- Simple SQL Injection: 
  - **Durchführung**
  - **Verteidigung**
  - **Schnell und einfach**
- Blind SQL Injection
  - **Durchführung mit Burpsuite**
  - **Verhinderung solcher Attacken** 
  - **Analyse für Schwachstellen, die für Blind SQL Injection nützlich sind.**
### **Dauer:**
- **Simple SQL Injection: Sehr schnell**
- **Blind SQL Injection: 2-5h Je nach Länge des Passworts.**

# <a name="_toc182902263"></a>M182 – Schlusswort

## **FAZIT**
### Es hat viel Spass gemacht, über die verschiedenen Arten von SQL Injection zu lernen und diese dann auch in der Praxis anzuwenden. Ein Spruch, den ich besonders oft gehört habe, wenn es darum ging, warum eine solch veraltete Methode noch immer eingesetzt wird, ist, dass Leute faul sind. Manchmal muss man gar nicht so lange nach einem Grund suchen, ausser man will es selbst nicht wahrhaben. Wer zu faul ist, sich zu schützen, wird die Konsequenzen früher oder später selbst erfahren. Natürlich gibt es auch immer neue Variationen, jedoch ist es grundsätzlich nicht allzu schwer, sich davor zu schützen.

[Bildergebnis für tbz Logo technische berufsschule]: Aspose.Words.af13f091-b9fe-44fc-9d7e-da8a9a9c3370.001.png
