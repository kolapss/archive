<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {

    if (isset($_POST['update'])) {
        //Подготовить запрос на добавление документа
        $documentName = $_POST['docName'];
        $creationDate = $_POST['creationDate'];
        $status = $_POST['status'];
        $description = $_POST['description'];
        $archiveDate = date('Y-m-d');
        $docID = intval($_POST['docID']);
        $addDoc = "UPDATE documents 
                    SET DocumentName = :documentName, 
                        CreationDate = :creationDate, 
                        ArchiveDate = :archiveDate,
                        Status = :status, 
                        Description = :description 
                    WHERE ID = :documentId";
        $queryAddDoc = $dbh->prepare($addDoc);
        $queryAddDoc->bindParam(':documentName', $documentName, PDO::PARAM_STR);
        $queryAddDoc->bindParam(':creationDate', $creationDate, PDO::PARAM_STR);
        $queryAddDoc->bindParam(':archiveDate', $archiveDate, PDO::PARAM_STR);
        $queryAddDoc->bindParam(':status', $status, PDO::PARAM_STR);
        $queryAddDoc->bindParam(':description', $description, PDO::PARAM_STR);
        $queryAddDoc->bindParam(':documentId', $docID, PDO::PARAM_INT);
        //Выполнить запрос на удаление авторов документа 
        $delAuthor = "DELETE FROM document_authors WHERE DocumentID = :documentId";
        $queryDelAuthor = $dbh->prepare($delAuthor);
        $queryDelAuthor->bindParam(':documentId', $docID, PDO::PARAM_INT);
        $queryDelAuthor->execute();
        //Подготовить запрос на добавление авторов в таблицу document_authors
        $authors = $_POST['authors'];
        $addAuthors = "INSERT INTO document_authors (DocumentID, AuthorID) VALUES (:documentId, :authorId)";
        $queryAddAuthors = $dbh->prepare($addAuthors);
        //Выполнить запрос на удаление категорий документа
        $delCategory = "DELETE FROM document_categories WHERE DocumentID = :documentId";
        $queryDelCategory = $dbh->prepare($delCategory);
        $queryDelCategory->bindParam(':documentId', $docID, PDO::PARAM_INT);
        $queryDelCategory->execute();
        //Подготовить запрос на добавление категорий в таблицу document_categories
        $categories = $_POST['categories'];
        $addCat = "INSERT INTO document_categories (DocumentID, CategoryID) 
                VALUES (:documentID, :categoryID)";
        $queryAddCat = $dbh->prepare($addCat);
        //Выполнить вышеперечисленные запросы
        try {
            $queryAddDoc->execute();
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
            $_SESSION['msg'] = "Документ успешно обновлен";
            header('location:manage-documents.php');
        } catch (PDOException $e) {
            $_SESSION['error'] = "Что-то пошло не так, попробуйте снова";
            header('location:manage-documents.php');
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
                        <h4 class="header-line">Изменить документ</h4>

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
                                <?php
                                $docid = intval($_GET['docid']);
                                $scDocument = "SELECT *
                                                    FROM documents d
                                                    WHERE d.ID = :docID";
                                $queryScDocument = $dbh->prepare($scDocument);
                                $queryScDocument->bindParam(':docID', $docid, PDO::PARAM_INT);
                                $queryScDocument->execute();
                                $document = $queryScDocument->fetch(PDO::FETCH_OBJ);

                                ?>
                                <div class="form-group">
                                    <label>Имя документа<span style="color:red;">*</span></label>
                                    <input class="form-control" type="text" name="docName" value="<?php echo $document->DocumentName; ?>" autocomplete="off" required />
                                </div>

                                <div class="form-group">
                                    <label>Дата создания<span style="color:red;">*</span></label>
                                    <input class="form-control" type="date" name="creationDate" value="<?php echo $document->CreationDate; ?>" required="required" />
                                </div>

                                <div class="form-group">
                                    <label>Авторы<span style="color:red;">*</span></label>
                                    <select id="authorSelect" name="authors[]" class="form-control" multiple="multiple" required>
                                        <?php
                                        $docID = $document->ID;
                                        //Получение списка авторов
                                        $sql = "SELECT id, AuthorName FROM authors";
                                        $query = $dbh->prepare($sql);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        //Получение списка автора определенного документа
                                        $srAuthors = "SELECT a.AuthorName
                                                                    FROM document_authors da
                                                                    JOIN authors a ON da.AuthorID = a.id
                                                                    WHERE da.DocumentID = :docID";
                                        $querySrAuthors = $dbh->prepare($srAuthors);
                                        $querySrAuthors->bindParam(':docID', $docID, PDO::PARAM_INT);
                                        $querySrAuthors->execute();
                                        $authors = $querySrAuthors->fetchAll(PDO::FETCH_OBJ);
                                        if ($query->rowCount() > 0) {
                                            foreach ($results as $result) {
                                                $isAuthor = false;
                                                foreach ($authors as $author) {
                                                    if ($author->AuthorName == $result->AuthorName) {
                                                        $isAuthor = true;
                                                    }
                                                }
                                                if ($isAuthor == true) {
                                                    echo "<option selected=\"true\" value=" . $result->id . ">" . $result->AuthorName . "</option>";
                                                } else {
                                                    echo "<option value=" . $result->id . ">" . $result->AuthorName . "</option>";
                                                }
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Категории<span style="color:red;">*</span></label>
                                    <select id="categorySelect" name="categories[]" class="form-control" multiple="multiple" required>
                                        <?php
                                        //Получение списка категорий
                                        $sql = "SELECT id, CategoryName FROM category";
                                        $query = $dbh->prepare($sql);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        //Получение категорий конкретного документа
                                        $srCategories = "SELECT c.CategoryName
                                                                        FROM document_categories dc
                                                                        JOIN category c ON dc.CategoryID = c.id
                                                                        WHERE dc.DocumentID = :docID";
                                        $querysrCategories = $dbh->prepare($srCategories);
                                        $querysrCategories->bindParam(':docID', $docID, PDO::PARAM_INT);
                                        $querysrCategories->execute();
                                        $categories = $querysrCategories->fetchAll(PDO::FETCH_OBJ);
                                        if ($query->rowCount() > 0) {
                                            foreach ($results as $result) {
                                                $isCategory = false;
                                                foreach ($categories as $category) {
                                                    if ($category->CategoryName == $result->CategoryName) {
                                                        $isCategory = true;
                                                    }
                                                }
                                                if ($isCategory == true) {
                                                    echo "<option selected=\"true\" value=" . $result->id . ">" . $result->CategoryName . "</option>";
                                                } else {
                                                    echo "<option value=" . $result->id . ">" . $result->CategoryName . "</option>";
                                                }
                                            }
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
                                            if ($document->Status == $value) {
                                                echo "<option selected=\"true\" value='$value'>" . htmlentities($value) . "</option>";
                                            } else {
                                                echo "<option value='$value'>" . htmlentities($value) . "</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <?php if (isset($docID)) { ?>
                                    <input type="hidden" name="docID" value="<?php echo htmlentities($docID); ?>">
                                <?php } ?>
                                <div class="form-group">
                                    <label>Описание</label>
                                    <textarea class="form-control" name="description" rows="4" maxlength="1000" placeholder="Введите описание"><?php echo $document->Description; ?></textarea>
                                </div>

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