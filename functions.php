<?php
//Einige wenige Funktionen habe ich für eine bessere Übersichtlichkeit in eine extra Datei ausgelagert. Dazu zählen vor allem der Header sowie der Footer, da diese auf jeder Seite angezeigt werden sollen.
function header_temp($title)
{
	echo <<<EOT
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>$title</title>
		<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>  
		<link href="style.css" rel="stylesheet" type="text/css">
	</head>
	<body>
    <nav class="navmenu">
	<a href="index.php"> <img class="logo" src="img/logo.png" alt="CS Works Logo"></a>
			<a href="anlegen.php" class ="menubuttons">Neuer Mitarbeiter</a>
			<a href="index.php" class= "menubuttons">Alle Mitarbeiter anzeigen</a>
    </nav>
EOT;
}

function footer_temp()
{
	echo <<<EOT
    </body>
</html>
EOT;
}
?>
<?php

//Diese Funktion dient zur Ausgabe der Mitarbeiterdaten. 


function arrayAusgeben($ergebnismenge) // Der Funktion soll ein Parameter übergeben werden, welcher die entsprechenden Datensätze der Datenbank enthält
{

	foreach ($ergebnismenge as $zeile) { // Die Daten werden als foreach Schleife ausgegeben.  ?> 
		<tr>
			<td>
				<?= $zeile["Personal-Nr."] ?>
			</td>
			<td><?= $zeile["Name"] ?></td>
			<td>
				<?= $zeile["Vorname"] ?>
			</td>
			<td><?= $zeile["Straße"] ?></td>
			<td>
				<?= $zeile["Haus-Nr."] ?>
			</td>
			<td><?= $zeile["PLZ"] ?></td>
			<td>
				<?= $zeile["Resturlaub"] ?>
			</td>
			<td class="operations">
				<a alt="Urlaub" href="resturlaub.php?urlaub=<?= $zeile['Resturlaub'] ?>&id=<?= $zeile['Personal-Nr.'] ?>"
					class='fa fa-plane'></a>
				<a alt="Bearbeiten" href="updatemitarbeiter.php?id=<?= $zeile['Personal-Nr.'] ?>&plzalt=<?= $zeile["PLZ"] ?>"><i
						class='fa fa-edit'></i>
					<a alt=""Löschen href="loeschen.php?id=<?= $zeile['Personal-Nr.'] ?>&name=<?= $zeile['Name'] ?>&vorname=<?= $zeile['Vorname'] ?>"
						class='fa fa-trash-o'></a>
			</td>

			<!--Hier befinden sich auch die Buttons um die Mitarbeiter einzeln anzuwählen und entweder zu löschen, die Daten zu bearbeiten oder neuen Urlaub einzutragen.-->


		<?php }
}

//Eine einfache Funktion, welche bloß reines HTML ausgibt, dass die Tabellenspalten anzeigt. Aufgrund der Übersichtlichkeit wurde diese hier her ausgelagert.
function tabelle_anzeigen()
{

	?>
		<table class="table">
			<thead>
				<tr>
					<th>Personal-Nr.</th>
					<th>Name</th>
					<th>Vorname</th>
					<th>Straße</th>
					<th>Haus-Nr.</th>
					<th>PLZ</th>
					<th>Resturlaub</th>
					<th>Daten verarbeiten</th>
				</tr>
			</thead>
			<tbody>

			<?php } ?>