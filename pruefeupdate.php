<?php
session_start();
include("functions.php");
include("connect.php");
header_temp('Änderung');
$id = $_SESSION["id"];
$plzalt = $_SESSION["plzalt"]; //Die alte PLZ wird ebenfalls als Session übertragen, damit diese, falls sie nicht mehr benutzt wird, aus der Datenbank entfernt werden kann.
if (!empty($_POST["Name"]) && !empty($_POST["Vorname"]) && !empty($_POST["Strasse"]) && !empty($_POST["Haus-Nr"]) //Verhindern von Leeringaben 
 && !empty($_POST["PLZ"]) && !empty($_POST["Ort"]) && !empty($_POST["Abteilungsnr"]) && is_numeric($_POST['PLZ']) && 
 is_numeric($_POST['Haus-Nr'])) {

    $name = htmlspecialchars($_POST["Name"]); 
    $vorname = htmlspecialchars($_POST["Vorname"]);
    $strasse = htmlspecialchars($_POST["Strasse"]);
    $hausnr = htmlspecialchars($_POST["Haus-Nr"]);
    $plz = htmlspecialchars($_POST["PLZ"]);
    $ort = htmlspecialchars($_POST["Ort"]);
    $abteilungsnr = htmlspecialchars($_POST["Abteilungsnr"]);

    $plz_check_query = $pdo->prepare("SELECT * FROM orte WHERE PLZ = :plz AND WOHNORT = :ort"); //Prüfe ob PLZ bereits vorhanden ist
    $plz_check_query->execute(array(":plz" => $plz, ":ort" => $ort));

    if ($plz_check_query->rowCount() == 0) { //Wenn nicht neu hinzufügen

        $plz_insert_query = $pdo->prepare("INSERT INTO orte (PLZ, Wohnort) VALUES (:plz, :ort)");
        $plz_insert_query->execute(array(":plz" => $plz, ":ort" => $ort));

    }

    $sql = "UPDATE `mitarbeiter` SET `Name` = '$name', `Vorname` = '$vorname', `Straße` = '$strasse', `Haus-Nr.` = '$hausnr', `PLZ` = '$plz',
             `Abteilungsnr.` = '$abteilungsnr' WHERE `Personal-Nr.` = $id;";
    $abfrage = $pdo->prepare(($sql));
    $abfrage->execute();
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM mitarbeiter WHERE PLZ = :plzalt"); //Prüfen ob alte PLZ noch von anderen Mitarbeitern genutzt wird
    $stmt->bindParam(':plzalt', $plzalt, PDO::PARAM_INT);
    $stmt->execute();
    $count = $stmt->fetchColumn();



    if ($count == 0) { // Wenn nicht, wird sie gelöscht
        $loeschen = $pdo->prepare("DELETE FROM `orte` WHERE `PLZ` = :plzalt");
        $loeschen->bindParam(':plzalt', $plzalt, PDO::PARAM_INT);
        $loeschen->execute();

    }

    echo "<p class=warning>Daten wurden erfolgreich aktualisiert</p>"; // Der User bekommt eine Meldung ob die aktualisierung der Daten erfolgreich war oder nicht.
} else {
    die("<p class=warning>Es gab einen Eingabefehler. Bitte Eingabe erneut durchführen. Bitte achten Sie darauf, dass alle Eingabefelder ausgefüllt sind</p>");
}

?>