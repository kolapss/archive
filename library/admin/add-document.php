<?php
$_POST['findPlace'] = 1;
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {

    if (isset($_POST['add'])) {

        //Подготовить запрос на добавление документа
        $documentName = $_POST['docName'];
        $creationDate = $_POST['creationDate'];
        $locationId = $_POST['cellNumber'];
        $status = $_POST['status'];
        $description = $_POST['description'];
        $archiveDate = date('Y-m-d');
        $addDoc = "INSERT INTO documents (DocumentName, CreationDate, ArchiveDate, LocationID, Status, Description) 
                VALUES (:documentName, :creationDate, :archiveDate, :locationId, :status, :description)";
        $queryAddDoc = $dbh->prepare($addDoc);
        $queryAddDoc->bindParam(':documentName', $documentName, PDO::PARAM_STR);
        $queryAddDoc->bindParam(':creationDate', $creationDate, PDO::PARAM_STR);
        $queryAddDoc->bindParam(':archiveDate', $archiveDate, PDO::PARAM_STR);
        $queryAddDoc->bindParam(':locationId', $locationId, PDO::PARAM_INT);
        $queryAddDoc->bindParam(':status', $status, PDO::PARAM_STR);
        $queryAddDoc->bindParam(':description', $description, PDO::PARAM_STR);
        //Подготовить запрос на изменения статуса ячейки
        $cellID = intval($_POST['cellNumber']);
        $chCell = "UPDATE storagecells SET CellStatus = 'Занято' WHERE ID = :id";
        $querychCell = $dbh->prepare($chCell);
        $querychCell->bindParam(':id', $cellID, PDO::PARAM_INT);
        //Подготовить запрос на добавление авторов в таблицу document_authors
        $authors = $_POST['authors'];
        $addAuthors = "INSERT INTO document_authors (DocumentID, AuthorID) VALUES (:documentId, :authorId)";
        $queryAddAuthors = $dbh->prepare($addAuthors);
        //Подготовить запрос на добавление категорий в таблицу document_categories
        $categories = $_POST['categories'];
        $addCat = "INSERT INTO document_categories (DocumentID, CategoryID) 
                VALUES (:documentID, :categoryID)";
        $queryAddCat = $dbh->prepare($addCat);
        //Выполнить вышеперечисленные запросы
        try {
            $queryAddDoc->execute();
            $docID = $dbh->lastInsertId();
            foreach ($authors as $author) {
                $queryAddAuthors->bindParam(':documentId', $docID, PDO::PARAM_INT);
                $queryAddAuthors->bindParam(':authorId', $author, PDO::PARAM_INT);
                $queryAddAuthors->execute();
            }
            foreach ($categories as $category) {
                $queryAddCat->bindParam(':documentID', $docID, PDO::PARAM_INT);
                $queryAddCat->bindParam(':categoryID', $category, PDO::PARAM_INT);
                $queryAddCat->execute();
            }
            $querychCell->execute();
            $_SESSION['msg'] = "Документ успешно добавлен";
            header('location:manage-documents.php');
        } catch (PDOException $e) {
            $_SESSION['error'] = "Что-то пошло не так, попробуйте снова";
            header('location:manage-documents.php');
        }
    }
    if (isset($_POST['findPlace'])) {
        $sql = "SELECT sc.ID AS CellID, sc.CellNumber AS CellNumber, s.ShelfNumber, r.RackNumber
            FROM storagecells sc
            JOIN shelves s ON sc.ShelfID = s.ID
            JOIN racks r ON s.RackID = r.ID
            WHERE sc.CellStatus = 'Свободно'
            ORDER BY sc.ID
            LIMIT 1";

        $query = $dbh->prepare($sql);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_OBJ);

        // Сохраняем результаты, если они найдены
        if ($result) {
            $cellID = $result->CellID;
            $cellNumber = $result->CellNumber;
            $shelfNumber = $result->ShelfNumber;
            $rackNumber = $result->RackNumber;
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
        <script>
            function showPlace() {
                document.getElementById('placeResult').style.display = 'block';
            }
        </script>

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
                        <h4 class="header-line">Добавить документ</h4>

                    </div>

                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3"">
<div class=" panel panel-info">
                        <div class="panel-heading">
                            Информация о документе
                        </div>
                        <div class="panel-body">
                            <form role="form" method="post">
                                <div class="form-group">
                                    <label>Имя документа<span style="color:red;">*</span></label>
                                    <input class="form-control" type="text" name="docName" autocomplete="off" required />
                                </div>

                                <div class="form-group">
                                    <label>Дата создания<span style="color:red;">*</span></label>
                                    <input class="form-control" type="date" name="creationDate" required="required" />
                                </div>

                                <div class="form-group">
                                    <label>Авторы<span style="color:red;">*</span></label>
                                    <select id="authorSelect" name="authors[]" class="form-control" multiple="multiple" required>
                                        <?php
                                        $sql = "SELECT id, AuthorName FROM authors";
                                        $query = $dbh->prepare($sql);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        if ($query->rowCount() > 0) {
                                            foreach ($results as $result) { ?>
                                                <option value="<?php echo htmlentities($result->id); ?>"><?php echo htmlentities($result->AuthorName); ?></option>
                                        <?php }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Категории<span style="color:red;">*</span></label>
                                    <select id="categorySelect" name="categories[]" class="form-control" multiple="multiple" required>
                                        <?php
                                        $sql = "SELECT id, CategoryName FROM category";
                                        $query = $dbh->prepare($sql);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        if ($query->rowCount() > 0) {
                                            foreach ($results as $result) { ?>
                                                <option value="<?php echo htmlentities($result->id); ?>"><?php echo htmlentities($result->CategoryName); ?></option>
                                        <?php }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <?php
                                // Получаем возможные значения ENUM для DocumentStatus
                                $enumSql = "SHOW COLUMNS FROM documents LIKE 'Status'";
                                $enumQuery = $dbh->prepare($enumSql);
                                $enumQuery->execute();
                                $enumResult = $enumQuery->fetch(PDO::FETCH_ASSOC);

                                // Извлекаем строку с ENUM значениями и удаляем ненужные части
                                preg_match("/^enum\(\'(.*)\'\)$/", $enumResult['Type'], $matches);
                                $enumValues = explode("','", $matches[1]);
                                ?>
                                <div class="form-group">
                                    <label>Статус<span style="color:red;">*</span></label>
                                    <select class="form-control" name="status" required>
                                        <?php
                                        foreach ($enumValues as $value) {
                                            echo "<option value='$value'>" . htmlentities($value) . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Местоположение<span style="color:red;">*</span></label>

                                    <!-- Блок для отображения результатов -->
                                    <?php if ($cellID !== null) { ?>
                                        <div id="placeResult">
                                            <div class="form-group">
                                                <div>
                                                    <label style="font-weight: normal;">Ячейка: <?php echo $cellNumber; ?>, Полка: <?php echo $shelfNumber; ?>, Стеллаж: <?php echo $rackNumber; ?></label>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } elseif (isset($_POST['findPlace'])) { ?>
                                        <div class="form-group">
                                            <label>Свободных ячеек не найдено</label>
                                        </div>
                                    <?php } ?>
                                </div>
                                <?php if (isset($cellID)) { ?>
                                    <input type="hidden" name="cellNumber" value="<?php echo htmlentities($cellID); ?>">
                                <?php } ?>
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
        <!-- SELECT2  -->
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            $(document).ready(function() {
                // Инициализация select2 с поиском
                $('#authorSelect').select2({
                    placeholder: "Выберите автора"
                });
                $('#categorySelect').select2({
                    placeholder: "Выберите категорию"
                });
            });
        </script>
        <!-- CUSTOM SCRIPTS  -->
        <script src="assets/js/custom.js"></script>


    </body>

    </html>
<?php } ?>