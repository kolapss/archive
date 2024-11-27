<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {

    // code for block student    
    if (isset($_GET['inid'])) {
        $id = intval($_GET['inid']);
        $status = "Деактивирован";
        $sql = "update employees set Status=:status  WHERE ID=:id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->execute();
        header('location:reg-students.php');
    }



    //code for active students
    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);
        $status = "Активный";
        $sql = "update employees set Status=:status  WHERE ID=:id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->execute();
        header('location:reg-students.php');
    }


?>
    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Система управления архива | Управление абонентами</title>
        <!-- BOOTSTRAP CORE STYLE  -->
        <link href="assets/css/bootstrap.css" rel="stylesheet" />
        <!-- FONT AWESOME STYLE  -->
        <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- DATATABLE STYLE  -->
        <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
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
            <div class="container-fluid " style="padding-left: 100px; padding-right: 100px;">
                <div class="row pad-botm">
                    <div class="col-md-12">
                        <h4 class="header-line">Управление абонентами</h4>
                    </div>


                </div>
                <div class="row">
                    <div class="col-md-12">
                        <!-- Advanced Tables -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Зарегистрированные абоненты
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>ФИО</th>
                                                <th>Email</th>
                                                <th>Телефон </th>
                                                <th>Отдел</th>
                                                <th>Должность</th>
                                                <th>Дата регистрации</th>
                                                <th>Статус</th>
                                                <th>Действия</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $vwEmployees = "SELECT employees.*, departments.depName
                                                    FROM employees
                                                    INNER JOIN departments ON employees.DepID = departments.ID;";
                                            $queryVwEmployees = $dbh->prepare($vwEmployees);
                                            $queryVwEmployees->execute();
                                            $results = $queryVwEmployees->fetchAll(PDO::FETCH_OBJ);
                                            if ($queryVwEmployees->rowCount() > 0) {
                                                foreach ($results as $result) {               ?>
                                                    <tr class="odd gradeX">
                                                        <td class="center"><?php echo htmlentities($result->ID); ?></td>
                                                        <td class="center"><?php echo htmlentities($result->FullName); ?></td>
                                                        <td class="center"><?php echo htmlentities($result->email); ?></td>
                                                        <td class="center"><?php echo htmlentities($result->phone); ?></td>
                                                        <td class="center"><?php echo htmlentities($result->depName); ?></td>
                                                        <td class="center"><?php echo htmlentities($result->Position); ?></td>
                                                        <td class="center"><?php echo htmlentities($result->RegDate); ?></td>
                                                        <td class="center"><?php if ($result->Status == "Активный") {
                                                                                echo htmlentities("Активен");
                                                                            } else {


                                                                                echo htmlentities("Деактивирован");
                                                                            }
                                                                            ?></td>
                                                        <td class="center">
                                                            <?php if ($result->Status == "Активный") { ?>
                                                                <a href="reg-students.php?inid=<?php echo htmlentities($result->ID); ?>" onclick="return confirm('Are you sure you want to block this user?');"" >  <button class=" btn btn-danger"> Inactive</button>
                                                                <?php } else { ?>

                                                                    <a href="reg-students.php?id=<?php echo htmlentities($result->ID); ?>" onclick="return confirm('Are you sure you want to active this user?');""><button class=" btn btn-primary"> Active</button>
                                                                    <?php } ?>

                                                        </td>
                                                    </tr>
                                            <?php $cnt = $cnt + 1;
                                                }
                                            } ?>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                        <!--End Advanced Tables -->
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
        <!-- DATATABLE SCRIPTS  -->
        <script src="assets/js/dataTables/jquery.dataTables.js"></script>
        <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
        <!-- CUSTOM SCRIPTS  -->
        <script src="assets/js/custom.js"></script>
    </body>

    </html>
<?php } ?>