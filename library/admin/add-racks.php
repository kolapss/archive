<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {

    if (isset($_POST['add'])) {
        $rackId = $_POST['rackID'];
        $shelfNum = $_POST['shelfNum'];
        $cellNum = $_POST['cellNum'];
        $date = $_POST['date'];
        $description = $_POST['description'];
        $capacity=$shelfNum*$cellNum;
        $rackStatus = 'действует';
        $sql = "INSERT INTO  racks(RackNumber,deliveryDate,Capacity,RackStatus,Description) VALUES(:rackID,:date,:capacity,:RackStatus,:description)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':rackID', $rackId, PDO::PARAM_INT);
        $query->bindParam(':date', $date, PDO::PARAM_STR);
        $query->bindParam(':capacity', $capacity, PDO::PARAM_INT);
        $query->bindParam(':RackStatus', $rackStatus, PDO::PARAM_STR);
        $query->bindParam(':description', $description, PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $dbh->lastInsertId();
        if ($lastInsertId) {
            $_SESSION['msg'] = "Стеллаж успешно добавлен";
            header('location:manage-racks.php');
        } else {
            $_SESSION['error'] = "Что-то пошло не так, попробуйте снова";
            header('location:manage-racks.php');
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
        <title>Online Library Management System | Add Racks</title>
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
        <div class="content-wra
    <div class=" content-wrapper">
            <div class="container">
                <div class="row pad-botm">
                    <div class="col-md-12">
                        <h4 class="header-line">Добавить стеллаж</h4>

                    </div>

                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3"">
<div class=" panel panel-info">
                        <div class="panel-heading">
                            Информация о стеллаже
                        </div>
                        <div class="panel-body">
                            <form role="form" method="post">
                                <div class="form-group">
                                    <label>Номер стеллажа<span style="color:red;">*</span></label>
                                    <input class="form-control" type="text" name="rackID" autocomplete="off" required />
                                </div>

                                <div class="form-group">
                                    <label>Количество полок<span style="color:red;">*</span></label>
                                    <input class="form-control" type="text" name="shelfNum" autocomplete="off" required="required" />
                                </div>

                                <div class="form-group">
                                    <label>Кол-во ячеек на каждой полке<span style="color:red;">*</span></label>
                                    <input class="form-control" type="text" name="cellNum" autocomplete="off" required="required" />
                                </div>
                                <div class="form-group">
                                    <label>Дата поступления<span style="color:red;">*</span></label>
                                    <input class="form-control" type="date" name="date" required />
                                </div>
                                <div class="form-group">
                                    <label>Описание</label>
                                    <textarea class="form-control" name="description" rows="4" maxlength="1000" placeholder="Введите описание"></textarea>
                                </div>

                                <button type="submit" name="add" class="btn btn-info">Добавить </button>

                            </form>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        </div>
        <!-- CONTENT-WRAPPER SECTION END-->
        <?php include('includes/footer.php'); ?>
        <!-- FOOTER SECTION END-->
        <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
        <!-- CORE JQUERY  -->
        <script src="assets/js/jquery-1.10.2.js"></script>
        <!-- BOOTSTRAP SCRIPTS  -->
        <script src="assets/js/bootstrap.js"></script>
        <!-- CUSTOM SCRIPTS  -->
        <script src="assets/js/custom.js"></script>
    </body>

    </html>
<?php } ?>