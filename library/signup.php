<?php
session_start();
include('includes/config.php');
error_reporting(0);
if (isset($_POST['signup'])) {
    //code for captach verification
    if ($_POST["vercode"] != $_SESSION["vercode"] or $_SESSION["vercode"] == '') {
        echo "<script>alert('Неправильный проверочный код');</script>";
    } else {
        $fname = $_POST['fullanme'];
        $mobileno = $_POST['mobileno'];
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $position = $_POST['position'];
        $depID = $_POST['depID'];
        $regDate = date('Y-m-d');
        $status = "Деактивирован";
        $sql = "INSERT INTO  employees(FullName,email,phone,Position,DepID, RegDate, password, Status) VALUES(:fname,:email,:mobileno,:position,:depID,:regDate,:password,:status)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':fname', $fname, PDO::PARAM_STR);
        $query->bindParam(':mobileno', $mobileno, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':position', $position, PDO::PARAM_STR);
        $query->bindParam(':depID', $depID, PDO::PARAM_INT);
        $query->bindParam(':regDate', $regDate, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $dbh->lastInsertId();
        if ($lastInsertId) {
            echo '<script>alert("Вы успешно зарегистрировались, учетная запись активируется после проверки администратором")</script>';
        } else {
            echo "<script>alert('Что-то пошло не так. Попробуйте еще раз.');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <title>Online Library Management System | Student Signup</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <script type="text/javascript">
        function valid() {
            if (document.signup.password.value != document.signup.confirmpassword.value) {
                alert("Password and Confirm Password Field do not match  !!");
                document.signup.confirmpassword.focus();
                return false;
            }
            return true;
        }
    </script>
    <script>
        function checkAvailability() {
            $("#loaderIcon").show();
            jQuery.ajax({
                url: "check_availability.php",
                data: 'emailid=' + $("#emailid").val(),
                type: "POST",
                success: function(data) {
                    $("#user-availability-status").html(data);
                    $("#loaderIcon").hide();
                },
                error: function() {}
            });
        }
    </script>

</head>

<body>
    <!------MENU SECTION START-->
    <?php include('includes/header.php'); ?>
    <!-- MENU SECTION END-->
    <div class="content-wrapper">
        <div class="container">
            <div class="row pad-botm">
                <div class="col-md-12">
                    <h4 class="header-line">Регистрация абонента</h4>

                </div>

            </div>
            <div class="row">

                <div class="col-md-9 col-md-offset-1">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            ФОРМА РЕГИСТРАЦИИ
                        </div>
                        <div class="panel-body">
                            <form name="signup" method="post" onSubmit="return valid();">
                                <div class="form-group">
                                    <label>Введите ФИО</label>
                                    <input class="form-control" type="text" name="fullanme" autocomplete="on" required />
                                </div>


                                <div class="form-group">
                                    <label>Мобильный телефон :</label>
                                    <input class="form-control" type="text" name="mobileno" maxlength="12" autocomplete="on" required />
                                </div>

                                <div class="form-group">
                                    <label>Введите Email</label>
                                    <input class="form-control" type="email" name="email" id="emailid" onBlur="checkAvailability()" autocomplete="on" required />
                                    <span id="user-availability-status" style="font-size:12px;"></span>
                                </div>
                                <div class="form-group">
                                    <label>Должность :</label>
                                    <input class="form-control" type="text" name="position" maxlength="100" autocomplete="on" required />
                                </div>

                                <div class="form-group">
                                    <label>Отдел</label>
                                    <select class="form-control" name="depID" required>
                                        <?php
                                        //Получение списка отделов
                                        $sql = "SELECT ID, depName FROM departments";
                                        $query = $dbh->prepare($sql);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        if ($query->rowCount() > 0) {
                                            foreach ($results as $result) {
                                                echo "<option value='$result->ID'>" . htmlentities($result->depName) . "</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Введите пароль</label>
                                    <input class="form-control" type="password" name="password" autocomplete="off" required />
                                </div>

                                <div class="form-group">
                                    <label>Подтверждение пароля </label>
                                    <input class="form-control" type="password" name="confirmpassword" autocomplete="off" required />
                                </div>
                                <div class="form-group">
                                    <label>Проверочный код : </label>
                                    <input type="text" name="vercode" maxlength="5" autocomplete="off" required style="width: 150px; height: 25px;" />&nbsp;<img src="captcha.php">
                                </div>
                                <button type="submit" name="signup" class="btn btn-danger" id="submit">Зарегистрироваться </button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- CONTENT-WRAPPER SECTION END-->
    <?php include('includes/footer.php'); ?>
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
    <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>
</body>

</html>