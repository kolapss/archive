<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['login']) == 0) {
    header('location:index.php');
} else {
    if (isset($_GET['del'])) {
        $id = $_GET['del'];
        $sql = "delete from tblbooks  WHERE id=:id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_STR);
        $query->execute();
        $_SESSION['delmsg'] = "Category deleted scuccessfully ";
        header('location:manage-books.php');
    }


?>
    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Система управления архива | Просмотр выданных документов</title>
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
            <div class="container">
                <div class="row pad-botm">
                    <div class="col-md-12">
                        <h4 class="header-line">Просмотр выданных документов</h4>
                    </div>


                    <div class="row">
                        <div class="col-md-12">
                            <!-- Advanced Tables -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Выданные документы
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Документ</th>
                                                    <th>Дата</th>
                                                    <th>ФИО архивариуса </th>
                                                    <th>ФИО абонента</th>
                                                    <th>Примечание</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sql = "SELECT 
                                                        o.ID AS OperationID,
                                                        o.opType AS OperationType,
                                                        o.opDate AS OperationDate,
                                                        o.description AS OperationDescription,
                                                        a.FullName AS OperationByEmployee,         -- Имя работника из opID
                                                        e.FullName AS EmployeeName,  -- Имя работника из opID
                                                        d.DocumentName AS DocumentName,
                                                        d.Status
                                                    FROM 
                                                        operations o
                                                    JOIN 
                                                        admin a ON o.opID = a.id       -- Связь по opID
                                                    JOIN 
                                                        employees e ON o.emID = e.ID       -- Связь по emID
                                                    JOIN 
                                                        documents d ON o.docId = d.ID       -- Связь по docId
                                                    WHERE o.emID=:emID;";
                                                $query = $dbh->prepare($sql);
                                                $query->bindParam(':emID', $_SESSION['stdid'], PDO::PARAM_INT);
                                                $query->execute();
                                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                if ($query->rowCount() > 0) {
                                                    foreach ($results as $result) {
                                                        if ($result->Status == "Выдан") {        ?>
                                                            <tr class="odd gradeX">
                                                                <td class="center"><?php echo htmlentities($result->OperationID); ?></td>
                                                                <td class="center"><?php echo htmlentities($result->DocumentName); ?></td>
                                                                <td class="center"><?php echo htmlentities($result->OperationDate); ?></td>
                                                                <td class="center"><?php echo htmlentities($result->OperationByEmployee); ?></td>
                                                                <td class="center"><?php echo htmlentities($result->EmployeeName); ?></td>
                                                                <td class="center"><?php echo htmlentities($result->OperationDescription); ?></td>

                                                            </tr>
                                                <?php
                                                        }
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