<?php
include("functions.php");

header_temp('Startseite');

// Wegen der Übersichtlichkeit habe ich die Funktion um einen neuen Eintrag zu erstellen nicht in die functions.php gepackt sondern diese direkt über dem zugehörigen HTML Code gelassen.
function mitarbeiter_erstellen()
{

	
	if (!empty($_POST)) {
		$name = htmlspecialchars($_POST["Name"]);  //Aus Sicherheitsgründen wird zu Beginn geprüft, ob die Werte gesetzt sind und zur Vermeidung von Schadcode, werden alle Nutzereingaben mit htmlspecialchars() gesäubert.
		$vorname = htmlspecialchars($_POST["Vorname"]);
		$strasse = htmlspecialchars($_POST["Strasse"]);
		$hausnr = htmlspecialchars($_POST["Haus-Nr"]);
		$plz = htmlspecialchars($_POST["PLZ"]);
		$ort = htmlspecialchars($_POST["Ort"]);
		$abteilungsnr = htmlspecialchars($_POST["Abteilungsnr"]);
		$resturlaub = 30; // Da jeder neu erstellte Mitarbeiter automatisch 30 Tage Urlaub erhält, wurde hier ein fixer Wert festgelegt.
	}
	// Hier soll überprüft werden, ob PLZ und Ort bereits existieren.
	

	//Kurze Anmerkung. Es ist wahrscheinlich unnötig diese Abfrage zu machen, da ja normalerweise die Verbindung durch den Fremdschlüssel besteht. Das hatte ja wie ebreits erwähnt nicht so ganz geklappt
	
	include("connect.php");
	$plz_check_query = $pdo->prepare("SELECT * FROM orte WHERE PLZ = :plz AND WOHNORT = :ort"); // Hier soll überprüft werden, ob PLZ und Ort bereits existieren.
	$plz_check_query->execute(array(":plz" => $plz, ":ort" => $ort));

	
	if ($plz_check_query->rowCount() == 0) { 		// Wenn beide noch nicht existieren, werden sie als neue Werte in die Tabelle 'ort' eingefügt.

		$plz_insert_query = $pdo->prepare("INSERT INTO orte (PLZ, Wohnort) VALUES (:plz, :ort)");
		$plz_insert_query->execute(array(":plz" => $plz, ":ort" => $ort));
	}

	$sql = "INSERT INTO `mitarbeiter` (`Personal-Nr.`, `Name`, `Vorname`, `Straße`, `Haus-Nr.`, `PLZ`, `Abteilungsnr.`, `Resturlaub`)
			VALUES (NULL, '$name', '$vorname', '$strasse', $hausnr, $plz, $abteilungsnr, $resturlaub)";

	$abfrage = $pdo->prepare($sql);
	$abfrage->execute();
	
	if ($abfrage->rowCount() > 0) {   		// Hier habe ich noch eine kleine if-Abfrage implementiert, damit der Nutzer weiß ob seine Eingaben korrekt waren und der Mitarbeiter erfolgreich angelegt werden konnte.
		echo "<p class=warning>Mitarbeiter erfolgreich angelegt.</p>";
	} else {
		echo "<p class=warning>Es ist ein Fehler beim Anlegen des Mitarbeiters aufgetreten. Bitte achten Sie darauf, alle Felder mit validen Eingaben auszufüllen!</p>";
	}

}

if (isset($_POST["speichern"])) { //Wird der submit Button gedrückt und die EIngaben übertragen, wird die entsprechende Funktion zum Erstellen des Mitarbeiters aufgerufen
	mitarbeiter_erstellen();
}
?>

<form class="new" action="anlegen.php" method="post">
	<label for="Name">Name</label>
	<input class="newinput" type="text" name="Name" placeholder="Bitte Namen eingeben.." id="Name">
	<label for="Vorname">Vorname</label>
	<input class="newinput" type="text" name="Vorname" placeholder="Bitte Vornamen eingeben.." value="" id="Vorname">
	<label for="Strasse">Straße</label>
	<input class="newinput" type="text" name="Strasse" placeholder="Bitte Straße eingeben.." id="Strasse">
	<label for="Haus-Nr">Haus-Nr.</label>
	<input class="newinput" type="text" name="Haus-Nr" placeholder="Bitte Hausnr. eingeben.." id="Haus-Nr">
	<label for="Abteilungsnr">Abteilung</label>
	<div class="select">
	<select name="Abteilungsnr" id="Abteilungsnr">
		<option value="1">Einkauf</option>
		<option value="2">Verkauf</option>
		<option value="3">Versand</option>
		<option value="4">Lohnbuchhaltung</option>
	</select>
</div>
	<label for="PLZ">PLZ</label>
	<input class="newinput" type="text" name="PLZ" placeholder="Bitte Postleitzahl eingeben.." id="PLZ">
	<label for="Ort">Ort</label>
	<input class="newinput" type="text" name="Ort" placeholder="Bitte Ort eingeben.." id="Haus-Nr">
	<div class="formsubmit">
	<input  class="submit" type="submit" name="speichern" value="Mitarbeiter anlegen">
	<input  class="reset" type="reset" value="Eingaben zurücksetzen">
</div>
	
</form>

