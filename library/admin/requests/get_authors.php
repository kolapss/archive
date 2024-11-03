<?php
require_once("includes/config.php");

$search = $_GET['search'] ?? '';
$sql = "SELECT id, AuthorName FROM authors WHERE AuthorName LIKE :search LIMIT 20";
$query = $dbh->prepare($sql);
$query->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
$query->execute();
$results = $query->fetchAll(PDO::FETCH_OBJ);

header('Content-Type: application/json');
if ($query->rowCount() > 0) {
    echo json_encode($results);
} else {
    // Если данных нет, возвращаем пустой массив
    echo json_encode([]);
}
