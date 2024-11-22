<?php
require_once("includes/config.php");
if (!empty($_POST["bookid"])) {
  $bookid = $_POST["bookid"];

  $sql = "SELECT DocumentName,ID FROM documents WHERE (ID=:bookid)";
  $query = $dbh->prepare($sql);
  $query->bindParam(':bookid', $bookid, PDO::PARAM_STR);
  $query->execute();
  $results = $query->fetchAll(PDO::FETCH_OBJ);
  $cnt = 1;
  if ($query->rowCount() > 0) {
    foreach ($results as $result) { ?>
      <option value="<?php echo htmlentities($result->ID); ?>"><?php echo htmlentities($result->DocumentName); ?></option>
      <b>Book Name :</b>
    <?php
      echo htmlentities($result->DocumentName);
      echo "<script>$('#submit').prop('disabled',false);</script>";
    }
  } else { ?>

    <option class="others"> Invalid ISBN Number</option>
<?php
    echo "<script>$('#submit').prop('disabled',true);</script>";
  }
}



?>