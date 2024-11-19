<?php
require_once("includes/config.php");
// code user email availablity
if (!empty($_POST["emailid"])) {
	$email = $_POST["emailid"];
	if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {

		echo "ошибка: Вы ввели недействительный адрес электронной почты.";
	} else {
		$sql = "SELECT email FROM employees WHERE email=:email";
		$query = $dbh->prepare($sql);
		$query->bindParam(':email', $email, PDO::PARAM_STR);
		$query->execute();
		$results = $query->fetchAll(PDO::FETCH_OBJ);
		$cnt = 1;
		if ($query->rowCount() > 0) {
			echo "<span style='color:red'> Пользователь с таким адресом электронной почты уже зарегестрирован .</span>";
			echo "<script>$('#submit').prop('disabled',true);</script>";
		} else {

			echo "<span style='color:green'> Адрес электронной почты доступен для регистрации .</span>";
			echo "<script>$('#submit').prop('disabled',false);</script>";
		}
	}
}
