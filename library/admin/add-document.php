<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {

    if (isset($_POST['add'])) {
        $rackId = intval($_POST['rackID']);
        $shelfNum = $_POST['shelfNum'];
        $cellNum = $_POST['cellNum'];
        $date = $_POST['date'];
        $description = $_POST['description'];
        $capacity = $shelfNum * $cellNum;
        $rackStatus = 'В работе';
        $sql = "INSERT INTO  racks(RackNumber,deliveryDate,Capacity,RackStatus,Description) VALUES(:rackID,:date,:capacity,:RackStatus,:description)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':rackID', $rackId, PDO::PARAM_INT);
        $query->bindParam(':date', $date, PDO::PARAM_STR);
        $query->bindParam(':capacity', $capacity, PDO::PARAM_INT);
        $query->bindParam(':RackStatus', $rackStatus, PDO::PARAM_STR);
        $query->bindParam(':description', $description, PDO::PARAM_STR);
        $query->execute();
        //запросить ID из таблицы Racks
        $IDINDB = $dbh->lastInsertId();
        //Подготовить запрос на заполнение таблицы shelves
        $inShelf = "INSERT INTO shelves(ShelfNumber, Capacity, RackID) VALUES(:i,:cellNum,:IDINDB)";
        $i = 1;
        $query = $dbh->prepare($inShelf);
        $query->bindParam(':i', $i, PDO::PARAM_INT);
        $query->bindParam(':cellNum', $cellNum, PDO::PARAM_INT);
        $query->bindParam(':IDINDB', $IDINDB, PDO::PARAM_INT);
        //Подготовить запрос на заполнение таблицы storagecell
        $j = 1;
        $shelfID = 0;
        $cellStatus = 'Свободно';
        $inCell = "INSERT INTO storagecells(CellNumber, ShelfID, CellStatus) VALUES(:j,:shelfID,:cellStatus)";
        $queryInCell = $dbh->prepare($inCell);
        $queryInCell->bindParam(':j', $j, PDO::PARAM_INT);
        $queryInCell->bindParam(':shelfID', $shelfID, PDO::PARAM_INT);
        $queryInCell->bindParam(':cellStatus', $cellStatus, PDO::PARAM_STR);
        //Выполнить вышеперечисленные запросы
        for ($i = 1; $i <= $shelfNum; $i++) {
            $query->execute();
            $shelfID = $dbh->lastInsertId();
            for ($j = 1; $j <= $cellNum; $j++) {
                $queryInCell->execute();
            }
        }
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