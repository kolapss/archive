<?php
session_start();
include('includes/config.php');
error_reporting(0);
if (strlen($_SESSION['login']) == 0) {
    header('location:index.php');
} else {
    if (isset($_POST['update'])) {
        $sid = $_SESSION['stdid'];
        $fname = $_POST['fullanme'];
        $mobileno = $_POST['mobileno'];

        $sql = "update employees set FullName=:fname,Phone=:mobileno where ID=:sid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':sid', $sid, PDO::PARAM_STR);
        $query->bindParam(':fname', $fname, PDO::PARAM_STR);
        $query->bindParam(':mobileno', $mobileno, PDO::PARAM_STR);
        $query->execute();

        echo '<script>alert("Ваш профиль был обновлен")</script>';
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

    </head>

    <body>
        <!------MENU SECTION START-->
        <?php include('includes/header.php'); ?>
        <!-- MENU SECTION END-->
        <div class="content-wrapper">
            <div class="container">
                <div class="row pad-botm">
                    <div class="col-md-12">
                        <h4 class="header-line">Мой профиль</h4>

                    </div>

                </div>
                <div class="row">

                    <div class="col-md-9 col-md-offset-1">
                        <div class="panel panel-danger">
                            <div class="panel-heading">
                                Мой профиль
                            </div>
                            <div class="panel-body">
                                <form name="signup" method="post">
                                    <?php
                                    $sid = $_SESSION['stdid'];
                                    $sql = "SELECT * from  employees  where ID=:sid ";
                                    $query = $dbh->prepare($sql);
                                    $query->bindParam(':sid', $sid, PDO::PARAM_STR);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    if ($query->rowCount() > 0) {
                                        foreach ($results as $result) {               ?>

                                            <div class="form-group">
                                                <label>ФИО : </label>
                                                <?php echo htmlentities($result->FullName); ?>
                                            </div>

                                            <div class="form-group">
                                                <label>Дата регистрации: </label>
                                                <?php echo htmlentities($result->RegDate); ?>
                                            </div>


                                            <div class="form-group">
                                                <label>Статус профиля : </label>
                                                <?php if ($result->Status == "Активный") { ?>
                                                    <span style="color: green">Активен</span>
                                                <?php } else { ?>
                                                    <span style="color: red">Деактивирован</span>
                                                <?php } ?>
                                            </div>


                                            <div class="form-group">
                                                <label>Введите ФИО</label>
                                                <input class="form-control" type="text" name="fullanme" value="<?php echo htmlentities($result->FullName); ?>" autocomplete="off" required />
                                            </div>


                                            <div class="form-group">
                                                <label>Мобильный телефон :</label>
                                                <input class="form-control" type="text" name="mobileno" maxlength="12" value="<?php echo htmlentities($result->phone); ?>" autocomplete="off" required />
                                            </div>

                                            <div class="form-group">
                                                <label>Введите email</label>
                                                <input class="form-control" type="email" name="email" id="emailid" value="<?php echo htmlentities($result->email); ?>" autocomplete="off" required readonly />
                                            </div>
                                    <?php }
                                    } ?>

                                    <button type="submit" name="update" class="btn btn-primary" id="submit">Обновить </button>

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
<?php } ?>