<?php
//Verbindung zur Datenbank aufbauen, falls nötig. Wurde ausgelagert, damit die Funktion immer wieder aufgerufen werden kann
try {
    $dburl = 'mysql:host=localhost;dbname=mitarbdb';
    $pdo = new PDO($dburl, 'root', '');

} catch (PDOException $exception) {
    // Wenn die Verbindung zur Datenbank fehlschlägt, wird ERROR-Meldung ausgegeben. 
    include("functions.php");
    header_temp("Verbindungsaufbau");
    exit('<p class=warning>Verbindung zur Datenbank fehlgeschlagen, bitte zuerst <a href="initdb.php">Tabelle initialisieren</a></p>');
}

?>