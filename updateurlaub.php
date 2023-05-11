<?php
session_start();
include("functions.php");
header_temp('Alle Mitarbeiter anzeigen');
// Hier wird nun die entsprechende Logik für die Berechnung des neuen Urlaubs implementiert.
// Wir beginnen damit, dass wir uns zunächst unsere übertrageneen Sessionvariablen in normale Variablen speichern, um diese besser verarbeiten zu können.
$urlaub = $_SESSION["urlaubstage"];
$id = $_SESSION["id"];

if (!empty($_POST['urlaub']) && is_numeric($_POST['urlaub'])) {
    $urlaub_neu = $_POST['urlaub']; // Der neue Urlaub, welcher über Post Methode übertragen wurde 
    $resturlaubneu = $urlaub - $urlaub_neu; // Neue Variable berechnet Differenz zwischen alten und neuen Urlaub
    if ($urlaub_neu > 30) { // Hier wird noch einmal geprüft ob die derzeitige Eingabe zu hoch ist.
        echo "<p class=warning>Zu viele Tage! Maximal 30 Tage möglich!</p>";
    } else if ($resturlaubneu < 0) { // Ist die Eingabe nicht größer als 30, geht es weiter mit unserer neuen Variable, der Differenz zwischen neuen und alten Urlaub. Wenn dieser Unter 0 fällt, dann Ende

        if ($urlaub == 0) { // Wenn der Mitarbeiter oder Mitarbeiterin 0 Tage Urlaub hat, dann ist heir auch Ende. 
            echo "<p class=warning>Gesamter Urlaub bereits aufgebraucht</p>";
        } else {
            echo "<p class=warning>Zu viele Tage! Maximal " . $urlaub . " Tage möglich!</>"; //Sind die Urlaubstage größer als 0, dann sind einfach die eingegebenen neuen Urlaubstage zu hoch. 
        }

    } else {

        include("connect.php");

        $sql = "UPDATE `mitarbeiter` SET `Resturlaub` = $resturlaubneu WHERE `mitarbeiter`.`Personal-Nr.` = $id"; // Urlaubstage werden aktualisiert. Die vorhin oben berechnete Differenz als Variable wird nun als neuer Wert gesetzt.
        $abfrage = $pdo->prepare($sql);
        $abfrage->execute([$resturlaubneu]);

        //Zum Schluss bekommt der Anwender noch eine Info darüber wie viele Tage Resturlaub es noch gibt. Sind die Tage 0, wird dies entsprechend vermerkt.
        echo "<p class=warning>Resturlaub erfolgreich aktualisiert</p>";
        if ($resturlaubneu == 0) {
            echo "<p class=warning>Der Mitarbeiter mit der Personal-Nr.: " . $id . " hat keinen Resturlaub mehr<p>";
        } else {
            echo "<p class=warning>Der Mitarbeiter mit der Personal-Nr.: " . $id . " hat noch " . $resturlaubneu . " Tage Resturlaub</p>";
        }
    }

} else {
    die("<p class=warning>Da hat etwas nicht geklappt. Entweder wurde keine oder eine falsche Eingabe gemacht. Bitte beachten Sie, dass in dieses Feld nur Zahlen eingegeben werden können.</p>"); //Üblicke Fehlermeldung, falls falsche oder keine Eingaben gemacht werden
}



footer_temp();