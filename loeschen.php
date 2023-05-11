<?php
include("functions.php");
include("connect.php");
header_temp('Mitarbeiter löschen'); ?>



<?php
$msg = "";


if (isset($_GET['id'])) {  // Es wird geprüft ob die ID übertragen wurde.
    $id = $_GET['id'];

}


if (isset($_GET['check'])) {  //Mit dieser Abfrage soll der User gefragt werden, ob er den Mitarebiter wirklichg löschen möchte
    $check = $_GET['check']; // Die Antwort wird mit GET übermittelt, falls diese yes ist, wird der Löschvorgang eingeleitet
    if ($check == "yes") {
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM mitarbeiter WHERE PLZ = (SELECT PLZ FROM mitarbeiter WHERE `Personal-Nr.` = :id)");   //Mit diesrr Abfrage wird überprüft, ob die PLZ deszu löschenden Mitarbeiters noch von anderen Mitarbeitern benutzt
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);           
        $stmt->execute();
        $count = $stmt->fetchColumn();


        if ($count == 1) {
            $loeschen = $pdo->prepare("DELETE FROM `orte` WHERE `PLZ` = (SELECT `PLZ` FROM `mitarbeiter` WHERE `Personal-Nr.` = :id)");
            $loeschen->bindParam(':id', $id, PDO::PARAM_INT);
            $loeschen->execute();
        }

        $sql = ("DELETE FROM `mitarbeiter` WHERE `Personal-Nr.` = :id;");
        $loeschen = $pdo->prepare($sql);
        $loeschen->bindParam(':id', $id, PDO::PARAM_INT);
        $loeschen->execute();

        $msg = "<p class=warning>Mitarbeiter erfolgreich gelöscht</p>";

    }

    if ($check == "no") {
        header("location: index.php");
    }

}


if (isset($_GET['name'])) {
    $name = $_GET['name'];

}

if (isset($_GET['vorname'])) {
    $vorname = $_GET['vorname'];

}


?>

<?php if ($msg): ?>
    <p>
        <?= $msg ?>
    </p>
<?php else: ?>
    <p class="warning">Mitarbeiter
        <?= $vorname ?>
        <?= $name ?> wirklich löschen?
    </p>
    <?php if($msg) ?>

    <div class="check">
        <a href="loeschen.php?id=<?= $id ?>&check=yes">Ja</a>
        <a href="loeschen.php?check=no">Nein</a>
    </div>

<?php endif;

footer_temp(); ?>