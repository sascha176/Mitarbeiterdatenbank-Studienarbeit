<?php
include("connect.php");
include("functions.php");

header_temp('Alle Mitarbeiter anzeigen');
?>

<div class="filteropt">
    <form class="sort" method="post">
        <label for="Sortierung">Sortieren nach...</label>
        <select class="selectsort" name="Sortierung" id="Sortierung">
            <option value="1">Bitte wählen</option>
            <option value="2">Name aufsteigend</option>
            <option value="3">Name absteigend</option>
            <option value="4">Resturlaub aufsteigend</option>
            <option value="5">Resturlaub absteigend</option>
        </select>
        <label for="Abteilung">Abteilung...</label>
        <select name="Abteilung" id="Abteilung">
            <option value="0">Alle</option>
            <option value="1">Einkauf</option>
            <option value="2">Verkauf</option>
            <option value="3">Versand</option>
            <option value="4">Lohnbuchhaltung</option>
        </select>
        <input type="submit" value="Anzeigen" class="submit">
    </form>

    <form class="search" method="post">
        <label for="suchfeld">Mitarbeiter suchen...</label>
        <input class="searchbar" type="search" name="suchfeld" id="suchfeld" placeholder="Suchen...">
        <input type="submit" name="suche" value="Suchen" class="submit">
    </form>
</div>

<?php




$abteilung = isset($_POST["Abteilung"]) ? $_POST["Abteilung"] : 0; //Zunächst werden drei Variablen für die Funktionen zum Filtern, Sortieren und zum Suchen nach Mitarbeitern erstellt. 
$sort = isset($_POST["Sortierung"]) ? $_POST["Sortierung"] : ""; // Der Wert für die Sortierung kommt aus einem Dropdown Menü und wird per POST Methode übergeben
$suche = isset($_POST["suche"]) ? $_POST["suchfeld"] . "%" : ""; //Die Suche ist eine simple simple Wildcard Suche. Ein Buchstabe reicht bereits um Ergebnisse auszugeben.


$sql = "SELECT * FROM `mitarbeiter`"; // Anstatt die SQL Befehle alle doppelt zu schreiben, füge ich die entsprechenden Teile einfach per '.=' hinzu.

// Die erste Abfrage dient zum Filtern der Mitarbeiter nach ihren Abteilungen. Der Wert wird über ein Dropdown Menü gewählt und mittels POST-Methode gespeichert.
if ($abteilung != 0) {
    $sql .= "WHERE `Abteilungsnr.` = :abteilung "; // ':abteilung' stellt hier einen Platzhalter für die jeweiligen Wert aus dem Dropdown dar. Je nachdem welche Abteilungsnummer ausgewählt wurde, werden die entsprechenden Mitarbeiter mit diesem Wert ausgegeben.
}


if ($sort == 2) {

    $sql .= "ORDER BY `Name` ASC";
} else if ($sort == 3) {
    $sql .= "ORDER BY `Name` DESC";
} else if ($sort == 4) {
    $sql .= "ORDER BY `Resturlaub` ASC";
} else if ($sort == 5) {
    $sql .= "ORDER BY `Resturlaub` DESC";
}
if (!empty($suche)) {
    $sql .= "WHERE `Name` LIKE :suche OR `Vorname` LIKE :suche"; 
}

$abfrage = $pdo->prepare($sql); // Alle SQL Statements werden zum Schutz mit prepare() vorbereitet und nicht direkt in die query() geschickt
                                
if ($abteilung != 0) {
    $abfrage->bindParam(":abteilung", $abteilung); //Mit prepare() und bindParam() soll das Sicherheitsrisiko gesenkt werden
}
if (!empty($suche)) {
    $abfrage->bindParam(":suche", $suche);
}
$abfrage->execute();
$mitarbeiter = $abfrage->fetchAll(); // Die Abfragen werden ausgeführt und die Ergebnisse als Array in der Variable $mitarbeiter gespeichert

if (!$mitarbeiter) {
    echo "<p class=warning>Die Suche ergab keinen Treffer</p>";
} else {
    
    tabelle_anzeigen();  //Abschließend werden alle Ergebnisse je nach Parameter über die die Funktion arrayAusgeben() angezeigt. Die entsprechenden Spalten werden durch die Funktion tabelle_anzeigen() ausgegeben.
    arrayAusgeben($mitarbeiter);
}

?>


<?php
footer_temp();
?>