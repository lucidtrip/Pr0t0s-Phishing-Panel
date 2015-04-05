# ![Pr0t0s Phishing Panel v 1.0](http://www0.xup.in/exec/ximg.php?fid=12947185)


## Info

Das Phishig Panel auf der grundlage von dem Toolstore Panel programmiert.
Das Panel ist auf Benutzerfreundlichkeit und Umfang ausgelegt.
100 % Der Fehler im Panel enstehen NUR durch falsche Einstellung.
Das Panel selber hat KEINE Elemente mehr vom Toolstore Panel die nicht mehr als 80% verändert wurden.


## Funktionen

- E-Mail Benachrichtigung an jede beliebige E-Mail Adresse über jeden SMTP Server. (Siehe Config.php)
- Multi Tasking (Mehr als nur eine Phishing Website auf einem Externen Server einsehbar)
- Export Funktion (Export in 2 verschiedenen Formaten)
- IP Auto Trace + Länder Flagge als 16x16 .gif
- 100% Stable.
- Keine Fehlerausgabe ausserhalb des Internen Bereichs des Panels.
- Volle Konfigurations Möglichkeit.
- Das erstellen von spezifischen Required Hosts.
- Auswählen der zu speichernden GET&POST Parameter.
- 100 % SQLi sicher.
- Fremdnutzung ausgeschlossen durch Non Database Login.
- Verschiedene Statistiken.
- ....


## Tutorial

!0. Die Config.php&MySQL.php einstellen!
Öffnen und lesen Sie die Datei : "inc/config.php" und tragen Sie dort alle Infos ein.
Sie können dort auch die E-Mail Optionen einstellen.
Danach öffnen Sie die Datei : "connect/mysql.php" und tragen Sie dort alle MYSQL Daten ein.


1. Das erstellen und Benutzen eines Hosts.
Zum erstellen eines Hosts unter dem Tab "Hosts" geben Sie in das erste Feld ein Icon Pfad an.
Diese Bilder sind hochzuladen unter /img/Pictures/. Wenn Sie in den Ordner zb Amazon.ico hochgeladen haben,
tragen Sie in das erste Feld : "Amazon.ico" (Mit groß&klein) ein. In das Zweite Feld kommt dann Ihr Persöhnliches Kommentar zum Host zb "Amazon Phishing Site".

2. Das einstellen der GET&POST Parameter.
Zum einstellen der Parameter unter "Settings" wählen Sie Ihren gewünschten Host aus, danach tragen Sie den Namen des Parameters ein z.B. "User" danach den Parameternamen
des nächsten Operaten z.B. "Passwort" und als letzes die Website auf die das Opfer weitergeleited werden soll zb "http://www.google.de/" ("http://" & "www." werden benötigt).
Dann bestätigen Sie ihre Angaben und Ihre Phishing Website ist eingetragen.

3. Nutzung
Sie erstellen eine Phishing Website und tragen als Ziel für die Daten folgende Datei an : "http://www.IHREDOMAIN.de/gate.php?HostID=" Dann die Host ID von ihrers zuvor erstellen
Hosts unter "Hosts" im Panel z.B. "1". Der fertige Link sieht dann so aus : "http://www.IHREDOMAIN.de/gate.php?HostID=1". Dass ist alles, natürlich müssen die übergebenen Parameter
mit den angegebenen Parametern übereinstimmen.

4. Service
Falls Sie sachliche und begründete Fragen haben können Sie den Nutzer "Pr0t0s" im Forum "Hackbase.cc" diese Fragen zukommen lassen.


## Screenshots

Index
![index](http://www0.xup.in/exec/ximg.php?fid=16297381)

Stats
![Stats](http://www0.xup.in/exec/ximg.php?fid=18567161)

Logs
![Logs](http://www0.xup.in/exec/ximg.php?fid=18191059)

Hosts
![Hosts](http://www0.xup.in/exec/ximg.php?fid=17300056)

Settings
![Settings](http://www0.xup.in/exec/ximg.php?fid=65429879)

Export
![Export](http://www0.xup.in/exec/ximg.php?fid=10990488)

Credits
![Credits](http://www0.xup.in/exec/ximg.php?fid=17482988)

~~Thread @ Hackbase.cc~~
~~https://hackbase.cc/showthread.php?38870-Script-Pr0t0s-Phishing-Panel&p=216634~~


## Zukunft
Geplant sind keine neuen Features aber ich bin offen für Ideen.

## Änderungen von LucidTrip

Folgende Änderungen die vorgenommen wurden:

- Die gate.php wurde um den $_GET["ip"] erweitert damit der user nicht unbedingt auf das Panel weiter geleitet werden muss, so kann das Phising skript
einfach die nötigen Parameter übermitteln und selbst sich drum kümmern wohin der Vic weitergeleitet werden soll. Ist aber optional, also es kann auch wie
gehabt verwendet werden.
- ein Backup Skript was die Datenbank via crontab immer mal auf uploaded.to hochläd, um für den fall eine Bust/Own/Hack noch die Datenbank zu haben.
- hier und da wurden paar Bilder falsch angezeigt, wurde gefixxt.
- das hinzufügen von Hosts hat auch nicht functioniert, wurde gefixxt.
- die host.php musste auch aufgeräumt werden, glaub das hätte so wenn überhaupt nur im IE funktioniert.
- das wars auch erst mal, weitere Ideen folgen.


## Credits
1. Pr0t0s @ ~~Hackbase.cc~~ (Coding,GFX und alles andere)
~~Hackbase.cc~~

2. mod: LucidTrip
date: 05.04.2015
