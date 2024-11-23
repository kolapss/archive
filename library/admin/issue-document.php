<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {

    if (isset($_POST['issue'])) {
        $emId = strtoupper($_POST['studentid']);
        $docID = $_POST['document'];
        $description = $_POST['description'];
        $opType = "Выдача";
        $opId=$_SESSION['aID'];
        $sql = "INSERT INTO  operations(opType,opID,emID,docId,description) VALUES(:opType,:opId,:emId,:docId, :description)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':opType', $opType, PDO::PARAM_STR);
        $query->bindParam(':opId', $opId, PDO::PARAM_INT);
        $query->bindParam(':emId', $emId, PDO::PARAM_INT);
        $query->bindParam(':docId', $docID, PDO::PARAM_INT);
        $query->bindParam(':description', $description, PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $dbh->lastInsertId();
        //Изменить статус ячейки
        $sql="UPDATE documents SET Status = 'Выдан', rOpId = :rOpId WHERE documents.ID = :docID";
        $query = $dbh->prepare($sql);
        $query->bindParam(':docID', $docID, PDO::PARAM_INT);
        $query->bindParam(':rOpId', $lastInsertId, PDO::PARAM_INT);
        $query->execute();
        if ($lastInsertId) {
            $_SESSION['msg'] = "Документ успешно выдан";
            header('location:manage-issued-documents.php');
        } else {
            $_SESSION['error'] = "Что-то пошло не так. Попробуйте еще раз";
            header('location:manage-issued-documents.php');
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
        <title>Online Library Management System | Issue a new Book</title>
        <!-- BOOTSTRAP CORE STYLE  -->
        <link href="assets/css/bootstrap.css" rel="stylesheet" />
        <!-- FONT AWESOME STYLE  -->
        <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLE  -->
        <link href="assets/css/style.css" rel="stylesheet" />
        <!-- GOOGLE FONT -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
        <script>
            // function for get student name
            function getstudent() {
                $("#loaderIcon").show();
                jQuery.ajax({
                    url: "get_student.php",
                    data: 'studentid=' + $("#studentid").val(),
                    type: "POST",
                    success: function(data) {
                        $("#get_student_name").html(data);
                        $("#loaderIcon").hide();
                    },
                    error: function() {}
                });
            }

            //function for book details
            function getbook() {
                $("#loaderIcon").show();
                jQuery.ajax({
                    url: "get_book.php",
                    data: 'bookid=' + $("#bookid").val(),
                    type: "POST",
                    success: function(data) {
                        $("#get_book_name").html(data);
                        $("#loaderIcon").hide();
                    },
                    error: function() {}
                });
            }
        </script>
        <style type="text/css">
            .others {
                color: red;
            }
        </style>


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
                        <h4 class="header-line">Выдать документ</h4>

                    </div>

                </div>
                <div class="row">
                    <div class="col-md-10 col-sm-6 col-xs-12 col-md-offset-1"">
<div class=" panel panel-info">
                        <div class="panel-heading">
                            Выдать документ
                        </div>
                        <div class="panel-body">
                            <form role="form" method="post">

                                <div class="form-group">
                                    <label>id абонента<span style="color:red;">*</span></label>
                                    <input class="form-control" type="text" name="studentid" id="studentid" onBlur="getstudent()" autocomplete="off" required />
                                </div>

                                <div class="form-group">
                                    <span id="get_student_name" style="font-size:16px;"></span>
                                </div>

                                <div class="form-group">
                                    <label>Документ<span style="color:red;">*</span></label>
                                    <select id="documentSelect" name="document" class="form-control" required>
                                        <?php
                                        $sql = "SELECT ID, DocumentName FROM documents";
                                        $query = $dbh->prepare($sql);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        if ($query->rowCount() > 0) {
                                            foreach ($results as $result) { ?>
                                                <option value="<?php echo htmlentities($result->ID); ?>"><?php echo htmlentities($result->DocumentName); ?></option>
                                        <?php }
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Описание</label>
                                    <textarea class="form-control" name="description" rows="4" maxlength="1000" placeholder="Введите описание"></textarea>
                                </div>

                                <button type="submit" name="issue" id="submit" class="btn btn-info">Выдать документ </button>

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
        <!-- SELECT2  -->
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            $(document).ready(function() {
                // Инициализация select2 с поиском
                $('#documentSelect').select2({
                    placeholder: "Выберите документ"
                });
            });
        </script>
        <!-- CUSTOM SCRIPTS  -->
        <script src="assets/js/custom.js"></script>

    </body>

    </html>
<?php } ?>