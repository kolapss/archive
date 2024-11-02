<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {

    if (isset($_POST['update'])) {
        $rackid = $_POST['rackID'];
        $rackStatus = $_POST['rackStatus'];
        $description = $_POST['description'];
        $ID = $_SESSION['rackID'];
        $sql = "update racks set RackNumber=:rackID,RackStatus=:rackStatus, Description=:description where ID=:ID";
        $query = $dbh->prepare($sql);
        $query->bindParam(':rackID', $rackid, PDO::PARAM_INT);
        $query->bindParam(':rackStatus', $rackStatus, PDO::PARAM_STR);
        $query->bindParam(':description', $description, PDO::PARAM_STR);
        $query->bindParam(':ID', $ID, PDO::PARAM_INT);
        $isError = $query->execute();
        if ($isError == true) {
            $_SESSION['msg'] = "Информация о стеллаже успешно обновлена";
        } else {
            $_SESSION['error'] = "Что-то пошло не так, попробуйте снова";
        }
        header('location:manage-racks.php');
    }
?>
    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Online Library Management System | Edit Book</title>
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
                        <h4 class="header-line">Изменить стеллаж</h4>

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
                                <?php
                                $rackid = intval($_GET['rackid']);
                                $sql = "SELECT ID, RackNumber, RackStatus, Description from racks WHERE ID=:rackid";
                                $query = $dbh->prepare($sql);
                                $query->bindParam(':rackid', $rackid, PDO::PARAM_STR);
                                $query->execute();
                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                $cnt = 1;
                                if ($query->rowCount() > 0) {
                                    foreach ($results as $result) {
                                        $_SESSION['rackID'] = $result->ID;              ?>

                                        <div class="form-group">
                                            <label>Номер стеллажа<span style="color:red;">*</span></label>
                                            <input class="form-control" type="text" name="rackID" value="<?php echo htmlentities($result->RackNumber); ?>" required />
                                            <p class="help-block">Номер стеллажа должен быть уникальным</p>
                                        </div>



                                        <?php
                                        // Получаем возможные значения ENUM для RackStatus
                                        $enumSql = "SHOW COLUMNS FROM racks LIKE 'RackStatus'";
                                        $enumQuery = $dbh->prepare($enumSql);
                                        $enumQuery->execute();
                                        $enumResult = $enumQuery->fetch(PDO::FETCH_ASSOC);

                                        // Извлекаем строку с ENUM значениями и удаляем ненужные части
                                        preg_match("/^enum\(\'(.*)\'\)$/", $enumResult['Type'], $matches);
                                        $enumValues = explode("','", $matches[1]);
                                        ?>
                                        <div class="form-group">
                                            <label>Статус<span style="color:red;">*</span></label>
                                            <select class="form-control" name="rackStatus" required>
                                                <?php
                                                foreach ($enumValues as $value) {
                                                    // Проверяем, является ли это значение текущим значением RackStatus
                                                    $selected = ($value == $result->RackStatus) ? 'selected' : '';
                                                    echo "<option value='$value' $selected>" . htmlentities($value) . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Описание</label>
                                            <textarea class="form-control" name="description" rows="4" maxlength="1000" placeholder="Введите описание" ><?php echo htmlentities($result->Description); ?></textarea>
                                        </div>

                                <?php }
                                } ?>
                                <button type="submit" name="update" class="btn btn-info">Обновить </button>

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