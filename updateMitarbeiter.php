<?php
session_start();
include("functions.php");
include("connect.php");
header_temp('Änderung');

if (isset($_GET['id']) && isset($_GET['plzalt']) ) { // Es wird überprüft ob alle Variablen vorhanden sind
    $_SESSION["id"] = $_GET['id'];
    $id = $_SESSION["id"];

    $_SESSION["plzalt"] = $_GET['plzalt'];
    $plzalt = $_SESSION["plzalt"];

} else {
    die("Etwas hat nicht funktioniert.");
}


$stmt = $pdo->prepare("SELECT `Name`, `Vorname`, `Straße`, `Haus-Nr.`, `PLZ` FROM `mitarbeiter` WHERE `Personal-Nr.` = :id"); // Die Einträge welche verändert werden sollen werden in ein SQL Statement gepackt
$stmt->bindParam(":id", $id);
$stmt->execute();
$mitarbeiter = $stmt->fetch(PDO::FETCH_ASSOC);

$name = $mitarbeiter['Name']; //Die Datensätze welche geändert werden sollen, werden per GET übertragen und in Variablen zum verarbeiten gepackt.
$vorname = $mitarbeiter['Vorname'];
$straße = $mitarbeiter['Straße'];
$hausnr = $mitarbeiter['Haus-Nr.'];
$plz = $mitarbeiter['PLZ'];


$stmt = $pdo->prepare("SELECT Wohnort FROM orte WHERE PLZ = (SELECT PLZ FROM mitarbeiter WHERE `Personal-Nr.` = :id)"); // Da der Ort nicht angezeigt wird, muss hier über die PLZ mit einer extra Abfrage auch der passende Wohnort dazugeholt werden
$stmt->bindParam(":id", $id);
$stmt->execute();
$ort = $stmt->fetchColumn();

?>

<form class="new" action="pruefeupdate.php" method="post">
<label for="Name">Name</label>
<input class="newinput"  type="text" name="Name" value="<?=$name?>" id="Name">
<label for="Vorname">Vorname</label>
<input class="newinput" type="text" name="Vorname"  value="<?=$vorname?>" id="Vorname">
<label for="Strasse">Straße</label>
<input class="newinput" type="text" name="Strasse"  value="<?=$straße?>" id="Strasse">
<label for="Haus-Nr">Haus-Nr.</label>
<input class="newinput" type="text" name="Haus-Nr" value="<?=$hausnr?>" id="Haus-Nr">
<label for="Abteilungsnr">Abteilung</label>
<select class="formselect" name="Abteilungsnr" id="Abteilungsnr">
  <option value="1">Einkauf</option>
  <option value="2">Verkauf</option>
  <option value="3">Versand</option>
  <option value="4">Lohnbuchhaltung</option>
</select>
<label for="PLZ">PLZ</label>
<input class="newinput" type="text" name="PLZ" value="<?=$plz?>" id="PLZ">
<label for="Ort">Ort</label>
<input class="newinput" type="text" name="Ort" value="<?=$ort?>" id="Ort">
<div class="formsubmit">
<input class="reset" type="reset" value="Änderung rückgängig machen">
<input class="submit" type="submit" name ="speichern" value="Änderung speichern">
</form>
</div>
<?php

footer_temp();
?>