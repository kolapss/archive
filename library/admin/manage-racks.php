<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {
    if (isset($_GET['del'])) {
        $id = $_GET['del'];
        // SQL-запрос для подсчета количества занятых ячеек для заданного стеллажа
        $sql = "
            SELECT COUNT(*) AS OccupiedCellCount
            FROM storagecells sc
            INNER JOIN shelves s ON sc.ShelfID = s.ID
            WHERE s.RackID = :rackID AND sc.CellStatus = 'Занято';";
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':rackID', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        if ($result->OccupiedCellCount == 0) {
            $sql = "delete from racks  WHERE ID=:id";
            $query = $dbh->prepare($sql);
            $query->bindParam(':id', $id, PDO::PARAM_STR);
            $query->execute();
            $_SESSION['delmsg'] = "Стеллаж подготовлен к списанию ";
        } else {
            $_SESSION['error'] = "Сначала освободите ячейки стеллажа ";
        }
        //header('location:manage-racks.php');
    }


?>
    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Система управления архива | Управлять стеллажами</title>
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
                        <h4 class="header-line">Управлять стеллажами</h4>
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
                                Список стеллажей
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Дата поступления</th>
                                                <th>Вместимость</th>
                                                <th>% занятости</th>
                                                <th>Статус</th>
                                                <th>Описание</th>
                                                <th>Действия</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $sql = "SELECT * 
                                            from  racks";
                                            $query = $dbh->prepare($sql);
                                            $query->execute();
                                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                                            if ($query->rowCount() > 0) {
                                                foreach ($results as $result) {               ?>
                                                    <tr class="odd gradeX">
                                                        <td class="center"><?php echo htmlentities($result->RackNumber); ?></td>
                                                        <td class="center"><?php echo htmlentities($result->deliveryDate); ?></td>
                                                        <td class="center"><?php echo htmlentities($result->Capacity); ?></td>
                                                        <?php
                                                        $sql = "
                                                        SELECT COUNT(*) AS OccupiedCellCount
                                                        FROM storagecells sc
                                                        INNER JOIN shelves s ON sc.ShelfID = s.ID
                                                        WHERE s.RackID = :rackID AND sc.CellStatus = 'Занято';";
                                                        $stmt = $dbh->prepare($sql);
                                                        $stmt->bindParam(':rackID', $result->ID, PDO::PARAM_INT);
                                                        $stmt->execute();
                                                        $numOcupiedCells = $stmt->fetch(PDO::FETCH_OBJ)->OccupiedCellCount;
                                                        $perOccu=round($numOcupiedCells/$result->Capacity*100,1);
                                                        ?>
                                                        <td class="center"><?php echo htmlentities($perOccu); ?></td>
                                                        <td class="center"><?php echo htmlentities($result->RackStatus); ?></td>
                                                        <td class="center"><?php echo htmlentities($result->Description); ?></td>
                                                        <td class="center">
                                                            <a href="edit-racks.php?rackid=<?php echo htmlentities($result->ID); ?>">
                                                                <button class="btn btn-primary"><i class="fa fa-edit "></i> Изменить</button>
                                                            </a>
                                                            <a href="manage-racks.php?del=<?php echo htmlentities($result->ID); ?>" onclick="return confirm('Are you sure you want to delete?');">
                                                                <button class="btn btn-danger"><i class="fa fa-pencil"></i> Списать</button>
                                                            </a>
                                                            <button class="btn btn-info view-details" data-id="<?php echo htmlentities($result->ID); ?>">
                                                                <i class="fa fa-info-circle"></i> Подробнее
                                                            </button>
                                                        </td>

                                                    </tr>
                                            <?php
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

        <!-- JAVASCRIPT ДЛЯ КНОПКИ "ПОДРОБНЕЕ" -->
        <script>
            $(document).ready(function() {
                $('.view-details').on('click', function() {

                    $('#dataTables-modal').DataTable().destroy();
                    const rackId = $(this).data('id');
                    $.ajax({
                        url: 'requests/get_storagecells.php',
                        type: 'POST',
                        data: {
                            rackId: rackId
                        },
                        success: function(data) {
                            $('#cellDetails').html(data);
                            $('#dataTables-modal').dataTable();
                            $('#detailsModal').modal('show');
                        }
                    });
                });

                $('#toggle-free').on('click', function() {
                    $('#cellDetails tr').each(function() {
                        const status = $(this).find('td').eq(3).text();
                        if (status !== 'Свободно') {
                            $(this).toggle();
                        }
                    });
                });
            });
        </script>
        <!-- Модальное окно-->
        <div class="modal fade" id="detailsModal" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailsModalLabel">Детали ячеек</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <button id="toggle-free" class="btn btn-secondary">Показать только свободные ячейки</button>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Список ячеек
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-modal">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Название документа</th>
                                                <th>Номер ячейки</th>
                                                <th>ID полки</th>
                                                <th>Статус ячейки</th>
                                            </tr>
                                        </thead>
                                        <tbody id="cellDetails"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                        </div>
                    </div>
                </div>
            </div>

    </body>

    </html>
<?php } ?>