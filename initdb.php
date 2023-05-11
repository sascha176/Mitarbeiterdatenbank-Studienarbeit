<!-- Das folgende Skript sorgt für das Anlegen und Initialisieren der Datenbank mitarbdb -->
<?php
include("functions.php");
header_temp("Datenbank intialisieren");
$server = "localhost";
$user = "root";
$passwort = "";
$database = "mitarbdb";

// Mit MySQL verbinden
$connection = new PDO("mysql:host=$server", "$user", "$passwort");
//Datenbank erstellen, falls sie noch nicht existiert
$createdb = "CREATE DATABASE IF NOT EXISTS $database";
$connection->query($createdb);

//Datenbank benutzen
$usedb = "USE $database";
$connection->query($usedb);

$createTableAbteilung =
  "CREATE TABLE IF NOT EXISTS `abteilung` (
        `Abteilungsnr.` int(255) UNSIGNED NOT NULL,
        `Abteilung` varchar(255) NOT NULL,
        PRIMARY KEY (`Abteilungsnr.`)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

$connection->query($createTableAbteilung);

$insertIntoAbteilung =
  "INSERT INTO `abteilung` (`Abteilungsnr.`, `Abteilung`) VALUES
    (1, 'Einkauf'),
    (2, 'Verkauf'),
    (3, 'Versand'),
    (4, 'Lohnbuchhaltung');";

$connection->query($insertIntoAbteilung);

$createTableMitarbeiter =
  "CREATE TABLE IF NOT EXISTS `mitarbeiter` (
        `Personal-Nr.` int(255) UNSIGNED NOT NULL AUTO_INCREMENT,
        `Name` varchar(255) NOT NULL,
        `Vorname` varchar(255) NOT NULL,
        `Straße` varchar(255) NOT NULL,
        `Haus-Nr.` int(255) UNSIGNED NOT NULL,
        `PLZ` int(255) UNSIGNED NOT NULL,
        `Abteilungsnr.` int(255) UNSIGNED NOT NULL,
        `Resturlaub` int(255) UNSIGNED NOT NULL,
        PRIMARY KEY (`Personal-Nr.`),
        KEY `mitarbeiter_ibfk_1` (`PLZ`),
        KEY `mitarbeiter_ibfk_2` (`Abteilungsnr.`)
      ) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;";

$connection->query($createTableMitarbeiter);

$insertIntoMitarbeiter =
  "INSERT INTO `mitarbeiter` (`Personal-Nr.`, `Name`, `Vorname`, `Straße`, `Haus-Nr.`, `PLZ`, `Abteilungsnr.`, `Resturlaub`) VALUES
        (1, 'Müller', 'Rainer', 'Am Stein', 8, 91448, 2, 22),
        (2, 'Frosch', 'Walther', 'Jahnstraße', 61, 90522, 1, 3),
        (3, 'Stark', 'Arya', 'Schneeweg', 12, 90122, 4, 28),
        (4, 'Stark', 'Eddard', 'Schneeweg ', 12, 90122, 3, 24),
        (5, 'Maus', 'Micky', 'Hauptstraße', 1, 90235, 3, 12),
        (6, 'Maus', 'Minnie', 'Hauptstraße', 1, 90235, 4, 11),
        (7, 'Grundig', 'Maximilian', 'Amalienstraße ', 2, 90762, 2, 19),
        (8, 'Schneider', 'Alexander', 'Hauptstraße', 12, 91522, 3, 21),
        (9, 'Bollenz', 'Jakob', 'Sackgasse ', 120, 90762, 1, 12),
        (10, 'Roderus', 'Helmut', 'Alpakaweg', 19, 90235, 3, 29),
        (11, 'Griffin', 'Peter', 'Müllerweg', 23, 91522, 4, 1),
        (12, 'Griffin', 'Lois', 'Müllerweg', 23, 90122, 1, 30),
        (13, 'Griffin', 'Stewie', 'Müllerweg', 23, 91522, 3, 5),
        (14, 'Fenix', 'Marcus', 'Höllenweg', 666, 90768, 2, 16),
        (15, 'Super', 'Mario', 'Pilzstraße', 18, 90768, 1, 17),
        (16, 'Croft', 'Lara', 'Waldstraße', 24, 90556, 4, 28),
        (17, 'Riva', 'Geralt', 'Weideweg', 3, 90122, 1, 0),
        (18, 'Vengerberg', 'Yennefer', 'Weideweg', 4, 90122, 3, 1),
        (19, 'Karlsson', 'Robert', 'Konfusionsstraße', 120, 90235, 2, 30),
        (20, 'Schäfer', 'Udo', 'Serverweg', 124, 90427, 4, 3),
        (21, 'Man', 'Pac', 'Pillenweg', 4, 90556, 2, 12),
        (22, 'Aran', 'Samus', 'Talon', 4, 91522, 4, 4);";

$connection->query($insertIntoMitarbeiter);

$createTableOrte =
  "CREATE TABLE IF NOT EXISTS `orte` (
            `PLZ` int(255) UNSIGNED NOT NULL,
            `Wohnort` varchar(255) NOT NULL,
            PRIMARY KEY (`PLZ`)
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

$connection->query($createTableOrte);

$insertIntoOrte =
  "INSERT INTO `orte` (`PLZ`, `Wohnort`) VALUES
        (90122, 'Winterfell'),
        (90235, 'Entenhausen'),
        (90522, 'Oberasbach'),
        (90762, 'Fürth'),
        (91522, 'Ansbach'),
        (90768, 'Fürth-Dambach'),
        (90556, 'Cadolzburg'),
        (90427, 'Nürnberg'),
        (91448, 'Emskirchen');";

$connection->query($insertIntoOrte);




echo "<p class=warning>Datenbank " . $database . " wurde erfolgreich angelegt und mit Testdaten befüllt. </p>";

footer_temp();

?>
