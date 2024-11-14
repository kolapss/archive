<?php
require_once("../includes/config.php");

if (isset($_POST['rackId'])) {
    $rackId = intval($_POST['rackId']);
    $sql = "SELECT * FROM storagecells";
    $query = $dbh->prepare($sql);
    //$query->bindParam(':rackId', $rackId, PDO::PARAM_INT);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);

    if ($query->rowCount() > 0) {
        foreach ($results as $result) {
            echo '<tr>';
            echo '<td>' . htmlentities($result->ID) . '</td>';
            echo '<td>' . htmlentities($result->CellNumber) . '</td>';
            echo '<td>' . htmlentities($result->ShelfID) . '</td>';
            echo '<td>' . htmlentities($result->CellStatus) . '</td>';
            echo '</tr>';
        }
    } else {
        echo '<tr><td colspan="4">Нет данных</td></tr>';
    }
}
?>
