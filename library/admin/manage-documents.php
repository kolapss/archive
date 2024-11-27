<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {
    if (isset($_GET['del'])) {
        $id = $_GET['del'];
        $locationID = $_GET['cellID'];
        //Выполнить запрос на удаление документа из таблицы documents
        $sql = "delete from documents  WHERE ID=:id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_STR);
        $query->execute();
        //Выполнить запрос на освбождение занятой документом ячейкиы
        $status = 'Свободно';
        $upCell = "UPDATE storagecells 
                    SET CellStatus = :status
                    WHERE ID = :locationId";
        $queryUpCell = $dbh->prepare($upCell);
        $queryUpCell->bindParam(':locationId', $locationID, PDO::PARAM_INT);
        $queryUpCell->bindParam(':status', $status, PDO::PARAM_STR);
        $queryUpCell->execute();
        //Выполнить запрос на удаление соответствующих записей из document_authors
        $delDocAuth = "delete from document_authors WHERE DocumentID=:id";
        $queryDelDocAuth = $dbh->prepare($delDocAuth);
        $queryDelDocAuth->bindParam(':id', $id, PDO::PARAM_INT);
        $queryDelDocAuth->execute();
        //Выполнить запрос на удаление соответствующих записей из document_categories
        $delDocAuth = "delete from document_categories WHERE DocumentID=:id";
        $queryDelDocAuth = $dbh->prepare($delDocAuth);
        $queryDelDocAuth->bindParam(':id', $id, PDO::PARAM_INT);
        $queryDelDocAuth->execute();
        $_SESSION['delmsg'] = "Документ списан ";
        //header('location:manage-documents.php');
    }
    if (isset($_GET['return'])) {
        $id = $_GET['return'];
        $sql = "SELECT * FROM operations WHERE ID=:id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':id',$id,PDO::PARAM_INT);
        $query->execute();
        $opInf=$query->fetch(PDO::FETCH_OBJ);
        $docID=$opInf->docId;
        //Добавь новую операцию
        $opType="Возврат";
        $sql = "INSERT INTO  operations(opType,opID,emID,docId,description) VALUES(:opType,:opId,:emId,:docId, :description)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':opType', $opType, PDO::PARAM_STR);
        $query->bindParam(':opId', $opInf->opID, PDO::PARAM_INT);
        $query->bindParam(':emId', $opInf->emID, PDO::PARAM_INT);
        $query->bindParam(':docId', $opInf->docId, PDO::PARAM_INT);
        $query->bindParam(':description', $opInf->description, PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $dbh->lastInsertId();
        ////Изменить статус ячейки
        $sql="UPDATE documents SET Status = 'В наличии' WHERE documents.ID = :docID";
        $query = $dbh->prepare($sql);
        $query->bindParam(':docID', $docID, PDO::PARAM_INT);
        $query->execute();
        if ($lastInsertId) {
            $_SESSION['msg'] = "Документ успешно возвращен";
            //header('location:manage-documents.php');
        } else {
            $_SESSION['error'] = "Что-то пошло не так. Попробуйте еще раз";
            //header('location:manage-documents.php');
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
        <title>Система управления архива | Управление документами</title>
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
                        <h4 class="header-line">Управление документами</h4>
                    </div>
                    <div class="row">
                        <?php if ($_SESSION['error'] != "") { ?>
                            <div class="col-md-6">
                                <div class="alert alert-danger">
                                    <strong>Error :</strong>
                                    <?php echo htmlentities($_SESSION['error']); ?>
                                    <?php echo htmlentities($_SESSION['error'] = ""); ?>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if ($_SESSION['msg'] != "") { ?>
                            <div class="col-md-6">
                                <div class="alert alert-success">
                                    <strong>Success :</strong>
                                    <?php echo htmlentities($_SESSION['msg']); ?>
                                    <?php echo htmlentities($_SESSION['msg'] = ""); ?>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if ($_SESSION['updatemsg'] != "") { ?>
                            <div class="col-md-6">
                                <div class="alert alert-success">
                                    <strong>Success :</strong>
                                    <?php echo htmlentities($_SESSION['updatemsg']); ?>
                                    <?php echo htmlentities($_SESSION['updatemsg'] = ""); ?>
                                </div>
                            </div>
                        <?php } ?>


                        <?php if ($_SESSION['delmsg'] != "") { ?>
                            <div class="col-md-6">
                                <div class="alert alert-success">
                                    <strong>Success :</strong>
                                    <?php echo htmlentities($_SESSION['delmsg']); ?>
                                    <?php echo htmlentities($_SESSION['delmsg'] = ""); ?>
                                </div>
                            </div>
                        <?php } ?>

                    </div>


                </div>
                <div class="row">
                    <div class="col-md-12">
                        <!-- Advanced Tables -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Список документов
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Название</th>
                                                <th>Авторы</th>
                                                <th>Категории</th>
                                                <th>Дата создания</th>
                                                <th>Дата архивирования</th>
                                                <th>Статус</th>
                                                <th>Описание</th>
                                                <th>Местоположение</th>
                                                <th>Действия</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            //Выполнить запрос на извлечение данных из таблицы document и местоположения документа
                                            $sql = "SELECT 
                                                            d.ID,
                                                            d.DocumentName,
                                                            d.CreationDate,
                                                            d.ArchiveDate,
                                                            d.Status,
                                                            d.LocationID,
                                                            d.Description,
                                                            d.rOpId,
                                                            sc.CellNumber,
                                                            s.ShelfNumber,
                                                            r.RackNumber
                                                            FROM documents d
                                                            JOIN storagecells sc ON d.LocationID = sc.ID
                                                            JOIN shelves s ON sc.ShelfID = s.ID
                                                            JOIN racks r ON s.RackID = r.ID;
                                                            ";
                                            $query = $dbh->prepare($sql);
                                            $query->execute();
                                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                                            $cnt = 1;
                                            if ($query->rowCount() > 0) {
                                                foreach ($results as $result) {
                                                    $docID = $result->ID;
                                                    //Выполнить запрос на получение авторов            
                                                    $srAuthors = "SELECT a.AuthorName
                                                                    FROM document_authors da
                                                                    JOIN authors a ON da.AuthorID = a.id
                                                                    WHERE da.DocumentID = :docID";
                                                    $querySrAuthors = $dbh->prepare($srAuthors);
                                                    $querySrAuthors->bindParam(':docID', $docID, PDO::PARAM_INT);
                                                    $querySrAuthors->execute();
                                                    //Выполнить запрос на получении категорий
                                                    $srCategories = "SELECT c.CategoryName
                                                                        FROM document_categories dc
                                                                        JOIN category c ON dc.CategoryID = c.id
                                                                        WHERE dc.DocumentID = :docID";
                                                    $querysrCategories = $dbh->prepare($srCategories);
                                                    $querysrCategories->bindParam(':docID', $docID, PDO::PARAM_INT);
                                                    $querysrCategories->execute();
                                            ?>
                                                    <tr class="odd gradeX">
                                                        <td class="center"><?php echo htmlentities($cnt); ?></td>
                                                        <td class="center"><?php echo htmlentities($result->DocumentName); ?></td>
                                                        <td class="center"><?php
                                                                            $authors = $querySrAuthors->fetchAll(PDO::FETCH_OBJ);
                                                                            foreach ($authors as $author) {
                                                                                echo '<span>• </span>' . $author->AuthorName . '<br>';
                                                                            }
                                                                            ?></td>
                                                        <td class="center"><?php
                                                                            $categories = $querysrCategories->fetchAll(PDO::FETCH_OBJ);
                                                                            foreach ($categories as $category) {
                                                                                echo '<span>• </span>' . $category->CategoryName . '<br>';
                                                                            }
                                                                            ?></td>
                                                        <td class="center"><?php echo htmlentities($result->CreationDate); ?></td>
                                                        <td class="center"><?php echo htmlentities($result->ArchiveDate); ?></td>
                                                        <td class="center"><?php echo htmlentities($result->Status); ?></td>
                                                        <td class="center"><?php echo htmlentities($result->Description); ?></td>
                                                        <td class="center"><?php echo 'Стеллаж: ' . $result->RackNumber . ' <br>Полка: ' . $result->ShelfNumber . ' <br>Ячейка: ' . $result->CellNumber; ?></td>
                                                        <td class="center">
                                                            <a href="edit-document.php?docid=<?php echo htmlentities($result->ID); ?>"><button class="btn btn-primary"><i class="fa fa-edit "></i> Изменить</button>
                                                                <a href="manage-documents.php?del=<?php echo htmlentities($result->ID); ?>&cellID=<?php echo htmlentities($result->LocationID); ?>" onclick="return confirm('Are you sure you want to delete?');"" >  <button class=" btn btn-danger"><i class="fa fa-pencil"></i> Списать</button>
                                                                    <?php if ($result->Status == "Выдан") {
                                                                        echo "<a href=\"manage-documents.php?return=" . $result->rOpId . "\" onclick=\"return confirm('Are you sure you want to delete?');\"\" >  <button class=\" btn btn-primary\"><i class=\"fa fa-edit\"></i> Вернуть</button>";
                                                                    }
                                                                    ?>
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