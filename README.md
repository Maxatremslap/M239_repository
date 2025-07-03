# M239 - Internetserver in Betrieb nehmen

[> **Modulidentifikation**](https://www.modulbaukasten.ch/module/239/3/de-DE?title=Internetserver-in-Betrieb-nehmen)

- 1. Anforderungen (Sicherheit, Lastprofil, Datenvolumen, Verfügbarkeit, zu integrierende Applikationen) an einen Internetserver aufnehmen und dokumentieren.
- 2. Bestehende Infrastruktur (Server, Netzwerk, Dienste) mit den Anforderungen abgleichen und notwendige Anpassungen bzw. Erweiterungen vorschlagen.
- 3. Erforderliche Einstellungen gemäss Sicherheits- und Betriebskonzept festlegen.
- 4. Software installieren, konfigurieren und Dienste einrichten.
- 5. Zugriffsberechtigungen vergeben, sichere Kommunikation und Log-Services einrichten.
- 6. Internetserver testen (Last-, Sicherheits- und Crashtest).

[TOC]

## Leistungsbeurtielung Bewertung/Benotung:

- 100% gemäss [**M239_Kompetenz-und-Bewertungsraster.pdf**](00%20-%20Admin/2023-MUH_M239_Kompetenz-und-Bewertungsraster.pdf) und die Dokumentation, lauffähige Server im Team. 

Updates 2024-04-30 MUH

<br>

## Ablaufplan 2025-Q4

### Klasse <mark>BI22a</mark> am Dienstag

Nachmittagsmodul [--> M239](https://gitlab.com/harald.mueller/aktuelle.kurse/-/blob/master/m239/README.md#klasse-bi22a-am-dienstag)

|Tag |Datum|Thema, Auftrag, Übung |
|----|-----|--------------------- |
|  1 | Di 13.05.25 | Einstieg ins Thema, <br>Wozu?, Dienste, Protokolle <br>[Anforderungs- bzw. Requirementsanalyse](03%20-%20Anforderungs-%20Requirementsanalyse) <br> [Hausaufgabe Anforderungsanalyse **auf Tag 3**](03%20-%20Anforderungs-%20Requirementsanalyse/M239_Hausaufgabe_Anforderungsanalyse.pdf) |
|  2 | Di 20.05.25 | Protokolle und Services, <br>[Pflichten-/Lastenheft](04%20-%20Lastenheft-Pflichtenheft), <br> Lastprofil  |
|  3 | Di 27.05.25 | Ansehen Hausaufgabe <br> Start Projektaufgabe im Team zu 2 Pers.  |
|  4 | Di 03.06.25 | Arbeit an der Projektaufgabe<br>Thematisierung **HTTP**rotokoll  |
|  5 | Di 10.06.25 | Arbeit an der Projektaufgabe<br>Thematisierung **EMail**-Protokolle  |
|  6 | Di 17.06.25 | Arbeit an der Projektaufgabe<br> **Review, Zwischenstand, Vorabgabe**  |
|  7 | Di 24.06.25 | Arbeit an der Projektaufgabe |
|  8 | Di 01.07.25 | Arbeit an der Projektaufgabe |
|  9 | Di 08.07.25 | **Projekt-Abgaben** <br>als Vorführung in der Klasse<br>und Benotung  |


<br>
<hr>
<br>

## Auftrag für das Lernprodukt

### 1.) Inhalt

Für den Nachweis der Kompetenzen aus dem Modul 239 wird eine fiktive Firma gegründet. Diese Firma benötigt diverse Internetserver-Dienste. 


### 2.) Auftrag

Sie arbeiten im Zweier-Team (Tandem).

- Jemand macht ein **Linux**-Server
- Jemand macht ein **Windows**-Server


#### 2.1 Gründung der Firma

Sie gründen mit Ihrer Tandempartnerin/Ihrem Tandempartner zusammen eine Firma. Überlegen Sie sich, 
was diese Firma anbietet und geben Sie Ihr einen treffenden Namen. 

Erstellen Sie ein Flipchart (evtl ppt-Blatt -> Papier), auf welcher Sie Ihre Firma kurz vorstellen (Name, Angebot, Mitarbeiter/Organigramm, etc.) 

#### 2.2 Technische Anforderungen

- Die Firma soll einen Web-Auftritt erhalten 
- Die Firmenmitglieder sollen E-Mails versenden und empfangen können 
- Zusätzliche Dienste (bspw. FTP, WebDAV, Chat) gemäss Anforderung der Firma sollen bereitgestellt werden 
- Es gibt sowohl ein **Linux-** wie auch ein **Windows-Server**
- Datenschutz/Datensicherheit ist wichtig 

#### 2.3 Auftrag

Sie sind zuständig, dass die Firma die gewünschten Internetdienste erhält. Für die Erledigung dieses Auftrags gehen Sie nach **IPERKA** vor. 

Erstellen Sie ein Dokument, in welchem Sie alle nötigen Schritte nachvollziehbar aufzeichnen. Berücksichtigen Sie dazu die Anregungen und Fragestellungen unter Punkt 5. 

#### 2.4 Erwartetes Ergebnis

- Die notwendigen Server stehen bereit (Demo am letzten Modultag) 
- Ein Dokument, in welchem alle nötigen Schritte nachvollziehbar aufgezeichnet sind, werden in TEAMS hochgeladen.
<br>Dateiname: **M239_Dokumentation_[Nachname_1]_[Nachname_2].pdf**) 


### 3.) Zeitrahmen

Für die Umsetzung stehen Ihnen an jedem Modultag mindestens drei Stunden Zeit zur Verfügung. 

Der letzte Modultag ist für die Präsentation der Ergebnisse vorgesehen.


### 4.) Abschluss-Präsentation 

Am letzten Modultag präsentieren Sie Ihre Firma der Klasse. 

Sie zeigen beispielsweise: 
- was Ihre Firma macht 
- welche Services Sie eingerichtet haben (bspw. Homepage anzeigen, CMS-Einsatz zeigen, etc.) 
- was bei Ihrer Firma speziell beachtet werden musste 
- wo es Probleme gab und welche Lösungen Sie gefunden haben 
- was gut lief und was Sie anders lösen würden

 
Anmerkung: Die Abschlusspräsentation gilt als Beitrag zum Nachweis der Kompetenz "Kooperation".

### 5.) Anregungen / Fragestellungen  

Die folgende Aufstellung soll Ihnen Anregungen geben und Sie bei der Umsetzung unterstützen. 

- 1. Machen Sie sich zuerst Gedanken darüber, wie viele Benutzer die Dienste voraussichtlich verwenden werden. Erstellen Sie dazu ein Lastprofil (bspw. über einen Tag/Woche/Jahr). <br>Entnehmen Sie dem Lastprofil die Anzahl gleichzeitiger Benutzer. <br>Arbeiten Sie im Folgenden mit drei Szenarien: 
	- Bester Fall (Geschäft läuft sehr gut, viele Benutzer) 
	- Schlechtester Fall (Geschäft läuft sehr schlecht, wenige Benutzer) 
	- Realistischer Fall 
Berechnen Sie die Anforderungen (Netzwerk, CPU, RAM) für diese drei Szenarien. Dazu evaluieren Sie den Bedarf für einen Benutzer und rechnen diesen auf die zu erwartenden Benutzer hoch. (HANOK 1.1). 

- 2. Die Firma setzt dies entweder bei sich im RZ auf oder benutzt einen Hosted Service beim Provider. Welche Variante ist unter welchen Gegebenheiten sinnvoll? Welche Server werden benötigt? Internetzugänge? Kapazitäten? Vor- und Nachteile? (HANOK1.1)

- 3. Es soll ein Apache Server aufgesetzt werden mit einer Domäne und einer Test-Website. Wie geht man vor? Wie plant man so etwas? Welche Ressourcen werden benötigt? (HANOK 2.1)

- 4. Die Firma entscheidet sich dafür, einen eigenen DNS aufzusetzen. <br>Warum macht das Sinn? Primary/Secondary? Stellen Sie das Konzept des DNS grafisch dar. <br>Welchen Einfluss hat dieser eigene DNS auf Mailservices (MX-Records), virtuelle Web-Hosts? (HANOK 2.2)

- 5. Wie soll Mail und Web abgesichert werden? Welche Richtlinien sind zu befolgen? (HANOK 3)

- 6. Setzen Sie den Web-Server, den DNS, den Mailserver korrekt auf. 
Benutzen Sie dafür eine virtuelle Umgebung. Es wird eine vollständige und nachvollziehbare Dokumentation nach DIN erwartet. (HANOK 4.1 und 4.2)

- 7. Was muss getan werden, wenn der Apache Server noch mit PHP und MySQL als zusätzliche Ressource ausgestattet wird? Wozu dienen diese Elemente? (HANOK 4.2)

- 8. Wie kann ich die Zugriffe auf die Server sicher machen? Wie funktioniert SSL/TLS in diesem Zusammenhang? HANOK 5.1 und 5.2

- 9. Testen Sie ihre Installation und werten Sie die Logfiles der Server aus. (HANOK 5.3 und 6.1)


<br>
<br>
<br>


## Vorgabe für das Dokument

### A. Titelblatt

- Titel (evtl. Untertitel) 
- Autoren 
- Datum der Erstellung / Datum des Drucks. 
- Firma, Schule

### B. Weitere Seiten

- Revisionshistory 
- Inhaltsverzeichnis bei mehr als 10 Seiten 
- Seitennummerierung 
- Kopf / Fusszeile 
- Dezimalklassierte Titel 


### C. Wichtiges

- Kurze, klare Sätze 
- Rechtschreibung 
- Kommasetzung

### D. Beispiel für den Aufbau des Dokuments nach IPERKA

	1. Information 
	1.1. Analyse des Auftrages 
	1.2. Ist-Situation 
	1.3. Ziele und Soll-Situation

	2. Planung 
	2.1. Zeitplan 
	2.2. Ressourcenplan 
	2.3. Eingesetztes Material 

	3. Entscheiden 
	3.1. Variante 1 
	3.2. Variante 2 
	3.3. Evaluation der Umsetzungsvariante 

	4. Realisieren 
	4.1. Vorgehen (Schritt für Schritt) 
	4.2. Resultate 

	5. Kontrolle (Tests) 
	5.1. Testfälle 
	5.2. Testdurchführung 
	5.3. Testresultate 
	5.4. Massnahmen 

	6. Auswertung 
	6.1. Zielerreichung 
	6.2. Ausblick


<br>
<br>
<br>
<br>
<br>
<hr>
<br>
<br>
<br>



## Unterrichtskonzept

Die ersten beiden Tage sind **geführter Unterricht** um die Thematik,
die Requirements, die Lasten-/Pflichtenheftproblematik kennen zu lernen.
Und dann wird tiefer in die Materie eingestiegen wo die verschiedenen
Internetprotokolle und -services angeschaut werden.

Im darauf folgenden Teil wird eine Projektaufgabe **im 2-er Team** bearbeitet.
Die eine Person macht ein **Internetserver** in **Windows** und die andere Person in 
**Linux**. Die Idee ist, dass das Team gleichzeitig beide Welten und deren Unterschiede 
verstehen und anwenden/aufsetzen lernen.

Die ganze Projektarbeit wird mit einer **Dokumentation** so begleitet, dass am 
Schluss eine Beleuchtung der theoretischen Hintergründe und die 
praktische Anwendungen und Umsetzung vorliegt.

Die Bewertung erfolgt gemäss einem Kompetenzraster.

[Ablauf_MUH2018/M239_UNTERRICHTSPLANUNG_L01-L10](Ablauf_MUH2018/M239_UNTERRICHTSPLANUNG_L01-L10(vorSOL).pdf)

![./Ablauf_MUH2018/Uebersicht-und-Bedeutung.jpg](./Ablauf_MUH2018/Uebersicht-und-Bedeutung.jpg)


## Konzept Tag 1 und Tag 2

- 4.3	Einbau von Übungs-Sequenzen
Der Einbau von Übungssequenzen kommt schon ganz zum Anfang in der zweiten Lektion (L2) zum Zuge wo in der präinstruktiven Vorwissensabholung die Vorgehensweise IPERKA wiederholt wird. 
Das wichtige Vorgehen IPERKA wird zu Beginn und zum Start in den zweiten Tag erneute geübt und wiederholt.

- 4.4	Einbau von Lernaufgaben
Hier in diesem Abschnitt gilt es nun Lernaufgaben einzubauen. Das kann man tun, indem das Dreieck der Wissensrepräsentation herbeigezogen wird. Hier wird von symbolischer S (textlich), ikonischer I (bildlich) und enaktiver E (handelnd) Wissensrepräsentationen gesprochen. Es gilt dabei möglichst Übergänge der Wissensrepräsentationen von S, I und E auch mal zu kombinieren. Nicht immer von Sprache-zu-Sprache oder von Text-zu-Text (S-S). Sondern es sind auch Lernaufgaben darzulegen, die an den spannenden Übergängen liegen. (Man kann sich einfach mal die 3 Buchstaben S, I, E mal permutieren und kommt auf 9 Möglichkeiten).
Die Aufgabe ist es in diesem Spiel, als Pantomime den zugewiesenen Server-Dienst zu spielen und die Gruppe errät den Dienst. Der Lernende muss ich überlegen, was die zentrale Aktivität des Dienstes ist und muss sich eine darstellbare Abbildung und Präsentation überlegen und ohne Worte ausführen.
Für eine Lernaufgabe, bei der es um die bewusste Adaption des Lerngegenstandes geht, habe ich mir dieses Spiel ausgesucht, das die textuelle Wissensrepräsentation (symbolische) in eine handelnde (enaktive) überträgt. Dies für den jeweiligen Akteur. Für die ratende Gruppe der Spielrunde ist es die Übertagung vom bildlich Gesehenem (ikonisch), wenn der Akteur etwas Statisches zeigt, und wenn der Akteur etwas Bewegliches zeigt (enaktiv) gilt es das Gesehene zu benennen (symbolisch).
Gleichzeitig ist dieses Spiel auch ein Transfer über eine erhöhte Distanz, siehe 4.5.2 Entfernter Transfer.

- 4.5	Einbau von Anwendungsaufgaben
Es geht nun darum, hier Anwendungsaufgaben als «Transfer»-Aufgaben zu machen. Jede Anwendung ist ja ein Transfer vom Lernort weg zur Anwendung in der Praxis. Man spricht auch von der Dekontextualisierung. Also das wegbringen von der warmen Stube in die raue Praxis oder das Verschieben von Erkenntnis- und Wissensgegenständen, weg von der Schulbank, hin an die Werkbank

 - 4.5.1	Naher Transfer
Der nahe Transfer ist derjenige Lernschritt, dessen Umsetzung, bzw. Anwendung sehr nahe beim neu gelernten Wissensgegenstand liegt. 
Ein naher Transfer wurde mit der Aufgabe realisiert, wo die Lernenden die verschiedenen beschriebenen Anforderungserhebungs-Methoden als Bilder ohne Text auf ein A3-Papier zu übertragen haben. 

 - 4.5.2	Entfernter Transfer
Im Spiel «Stirnraten» bekommen die Spiel-Akteure eine Karte an die Stirn geklebt. Durch gezieltes Fragen soll der Akteur herausfinden, wofür er zuständig ist. Sein Gegenüber verrät den «Dienst» nicht, sondern gibt nur Ja/nein-Antworten. 
Das ist eine Dislozierung und eine Dekontextierung von Diensten, die sonst auf den Server laufen. Es geschieht eine Übertragung von einem technischen Gerät auf einen menschlichen Körper. 
Ein weiterer Transfer ist die Hausaufgabe, in der es darum geht, die Fragen der Anforderungen in die Tat umzusetzen. Im Schulzimmer werden die Fragen entworfen und müssen dann im Lehrbetrieb realisiert und umgesetzt werden.
Der dritte Transfer ist, dass die eigene Firma, bzw. aber deren Erweiterung nicht auf einem physischen Server installiert werden wird, sondern auf virtualisierten Umgebungen auf dem eigenen Rechner.



