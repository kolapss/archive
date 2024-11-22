<?php
require_once("includes/config.php");
if (!empty($_POST["studentid"])) {
  $studentid = intval($_POST["studentid"]);

  $sql = "SELECT FullName,Status FROM employees WHERE ID=:studentid";
  $query = $dbh->prepare($sql);
  $query->bindParam(':studentid', $studentid, PDO::PARAM_STR);
  $query->execute();
  $results = $query->fetchAll(PDO::FETCH_OBJ);
  $cnt = 1;
  if ($query->rowCount() > 0) {
    foreach ($results as $result) {
      if ($result->Status == "Деактивирован") {
        echo "<span style='color:red'> Пользователь заблокирован </span>" . "<br />";
        echo "<b>ФИО пользователя-</b>" . $result->FullName;
        echo "<script>$('#submit').prop('disabled',true);</script>";
      } else {
?>


<?php
        echo htmlentities($result->FullName);
        echo "<script>$('#submit').prop('disabled',false);</script>";
      }
    }
  } else {

    echo "<span style='color:red'> Неправильный ID. Пожалуйста, введите верный ID .</span>";
    echo "<script>$('#submit').prop('disabled',true);</script>";
  }
}



?>
