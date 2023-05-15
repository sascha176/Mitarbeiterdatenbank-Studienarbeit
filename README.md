Thema: Mitarbeiterdatenbank mit Verwaltung der Urlaubstage


Funktionsumfang der Anwendung
Die folgende Anwendung ist eine einfache CRUD (create, read, update, delete) Anwendung, welche ich mit PDO erstellt habe.

Der Funktionsumfang umfasst also die klassischen Operationen einer CRUD Anwendung, wie das Anlegen eines neuen Mitarbeiters,
das Löschen eines Mitarbeiters sowie das Aktualisieren der Daten und einer Anzeige der kompletten Datenbankinhalte.

Zusätzlich implementiert, habe ich eine einfache Wildcardsuche, wo gezielt nach einzelnen Mitarbeitern gesucht werden kann.
Diese werden mit allen Daten ausgegeben. Weiterhin gibt es die Möglichkeit, die Mitarbeiteranzeige nach Abteilungen zu filtern.

Auch für die Sortierung habe ich verschiedene Optionen als Dropdown hinzugefügt. Es ist möglich die Ausgabe nach Alphabet sowie nach Anzahl 
der Urlaubstage anzeigen zu lassen.

Da es sich um eine Mitarbeiterverwaltung, welche zum Eintragen von Urlaubstagen gedacht ist, gibt es natürlich eine Funktion, mit welcher diese
Urlaubstage eingetragen werden können. Jeder Mitarbeiter bekommt nach dem Anlegen direkt 30 Urlaubstage. Sind die 30 Tage Urlaub aufgebraucht, 
kann kein Urlaub mehr eingetragen werden.

Anleitung zur  Installation

Um die vorliegende Projektarbeit zum laufen zu bringen, sind folgende Schritte notwendig:

1. Einen lokalen Webserver wie XAMPP installieren und einrichten.
2. Wenn XAMPP genutzt wird beispielsweise den Ordner "mitarbeiterdatenbank" und seinen vollständigen Inhalt in den Ordner "htdocs" hineinkopieren (standardmäßig zu finden unter: C:\xampp\htdocs).
3. Den lokalen Webserver starten und im Browser über den localhost folgende URL aufrufen: http://localhost/mitarbeiterdatenbank/index.php.
4. Da höchstwahrscheinlich die benötigte Datenbank "mitarbdb" noch nicht existiert, wird nun eine Fehlermeldung erscheinen.
5. In der Fehlermeldung ist der Hinweis, dass die Datenbank erst initialisiert werden muss, dazu den entsprechenden Link "Bitte erst Datenbank initialisieren" anklicken.
6. Der Link ruft die beiligende "initdb.php" auf welche die benötigte Datenbank erstellt und mit einigen Testdaten befüllt. Mit einem Klick auf "Zur Anwendung" gelangt man nun zur eingericheten Anwendung.

Zur Bedienung des Tools gibt es eigentlich nicht viel zu sagen. Das kleine Menü im Headbereich der Anwendung hat nur zwei menüpunkte, auf einem wird ein neuer
Mitarbeiter angelegt, auf dem anderen werden alle Mitarbeiter, also quasi die Startseite angezeigt. Auch bei einem Klick auf das Logo rechts in der Ecke gelangt man wieder dort hin.

Die Beiden Dropdowns dienen zum sortieren und filtern der Einträge und rechts daneben ist die Suchleiste zum Suchen nach spezifischen Mitarbeitern.

Die rechte Spalte der Tabelle beinhaltet zudem die möglichen Operatoren, dargestellt durch kleine Icons.

Das Flugzeug Icon ruft das Menü zum Eintragen von Urlaubstagen, das Stift-Icon zum bearbeiten und der Mülleimer zum löschen von Mitarbeitern auf.
Das Menü in der Kopfleiste wird immer angezeigt, sodass man jederzeit auf die Startseite zurückkehren kann.



Wichtiger Hinweis beim Aktualisieren der Mitarbeiterdaten!

Wenn beispielsweise nur ein Feld wie der Nachname geändert wurde, kann man dies natürlich ändern und dann die Eingabe bestätigen.
Die nicht veränderten Daten bleiben sowie sie waren. Mit Ausnahme der Abteilungsauswahl. Hier befindet sich ein Dropdown, welches 
leider immer wieder auf die Abteilung "Einkauf" springt. Hier bitte darauf achten, dass die Abteilung immer entsprechend manuell gesetzt
werden muss, auch wenn diese nicht verändert wurde. Leider hatte ich keine Zeit mehr, das entsprechend anzupassen.


Anmerkung zur Bildschirmdarstellung:
 Die Anwendung zeigt bis zu einer Auflösung von 1280x720 Pixeln alles soweit fehlerfrei an. 
 Bei kleineren Bildschirmen kann es zu Anzeigefehlern kommen. Es handelt sich um keine responsive Anwendung!
