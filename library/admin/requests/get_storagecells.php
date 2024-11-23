<?php
require_once("../includes/config.php");

if (isset($_POST['rackId'])) {
    $rackId = intval($_POST['rackId']);
    $sql = "SELECT 
            CASE 
                WHEN sc.CellStatus = 'Свободно' THEN 'Пусто'
                ELSE d.DocumentName
            END AS DocumentName,
            sc.ID,
            s.ShelfNumber,
            sc.CellNumber,
            sc.CellStatus
        FROM 
            documents d
        RIGHT JOIN 
            storagecells sc ON d.LocationID = sc.ID
        JOIN 
            shelves s ON sc.ShelfID = s.ID
        WHERE 
            s.RackID = :rackID";

    // Подготовка и выполнение запроса
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(":rackID", $rackId, PDO::PARAM_INT); // связываем RackID с параметром запроса
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_OBJ);
    if ($stmt->rowCount() > 0) {
        foreach ($results as $result) {
            echo '<tr>';
            echo '<td>' . htmlentities($result->ID) . '</td>';
            echo '<td>' . htmlentities($result->DocumentName) . '</td>';
            echo '<td>' . htmlentities($result->CellNumber) . '</td>';
            echo '<td>' . htmlentities($result->ShelfNumber) . '</td>';
            echo '<td>' . htmlentities($result->CellStatus) . '</td>';
            echo '</tr>';
        }
    } else {
        echo '<tr><td colspan="4">Нет данных</td></tr>';
    }
}
