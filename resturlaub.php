<?php
session_start();                                                
include("functions.php");
header_temp('Alle Mitarbeiter anzeigen');

if (isset($_GET['urlaub']) && isset($_GET['id'])) {             // Entsprechend werden also Personal-Nr. und der aktuelle Resturlaub mit der GET Methode aus der Datenbank geholt.

  $_SESSION["urlaubstage"] = $_GET['urlaub'];                   // Diese werden nun als Session Variable gespeichert, damit ich sie auf die nächste Seite übertragen kann. Hier wird dann die entsprechende Logik implementiert.
  $_SESSION["id"] = $_GET['id'];
} else {
  die("Keine gültige Eingabe");                                 // Kurze Sicherheitsbafrage, ob die Variablen richtig gesetzt und vorhanden sind. Ansonsten kommt eine Fehlermeldung.
}

?>

  <form class="new" method="post" action="updateurlaub.php">
    <label for="suchfeld">Wie viel Urlaubstage sollen eingetragen werden?</label>
    <input class="newinput" type="text" name="urlaub" placeholder="Tage eingeben" id="urlaub">
    <input class="submit" type="submit" name="speichern" value="Eingabe bestätigen">
  </form>
  <?php

  

  footer_temp();
  ?>