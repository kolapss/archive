<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
  header('location:index.php');
} else {
  // Обработка запроса отчета
  $reportData = "";
  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['reportType'])) {
    $reportType = $_POST['reportType'];

    // SQL запросы для каждого отчета
    switch ($reportType) {
      case 'report1':
        $query = "SELECT 
                  d.DocumentName AS `Название документа`,
                  COUNT(CASE WHEN o.opType = 'Выдача' THEN 1 END) AS `Количество выдач`,
                  d.Status AS `Статус документа`
                  FROM documents d
                  LEFT JOIN operations o ON d.ID = o.docId
                  GROUP BY d.ID
                  ORDER BY `Количество выдач` DESC";
        break;

      case 'report2':
        $query = "SELECT 
                  e.FullName AS `ФИО сотрудника`,
                  e.Position AS Должность,
                  d.depName AS Отдел,
                  COUNT(o.ID) AS `Кол-во выданных документов (всего)`
                  FROM employees e
                  LEFT JOIN operations o ON e.ID = o.emID
                  LEFT JOIN departments d ON e.DepID = d.ID
                  WHERE o.opType='Выдача'
                  GROUP BY e.ID
                  ORDER BY `Кол-во выданных документов (всего)` DESC";
        break;

      case 'report3':
        $query = "SELECT 
                      racks.RackNumber AS `Номер стеллажа`,
                      racks.RackStatus AS `Статус стеллажа`,
                      racks.Capacity AS `Вместимость стеллажа`,
                      ROUND(
                          (SUM(CASE WHEN storagecells.CellStatus = 'Занято' THEN 1 ELSE 0 END) / COUNT(storagecells.ID)) * 100, 
                          2
                      ) AS `Процент занятости`
                  FROM 
                      racks
                  LEFT JOIN 
                      shelves ON racks.ID = shelves.RackID
                  LEFT JOIN 
                      storagecells ON shelves.ID = storagecells.ShelfID
                  GROUP BY 
                      racks.ID, `Номер стеллажа`;
";
        break;

      case 'report4':
        $query = "SELECT 
                  c.CategoryName AS `Название категории`,
                  COUNT(dc.DocumentID) AS `Количество документов`
                  FROM category c
                  LEFT JOIN document_categories dc ON c.id = dc.CategoryID
                  GROUP BY c.id
                  ORDER BY `Количество документов` DESC";
        break;

      default:
        $query = "";
        break;
    }

    if (!empty($query)) {
      $result = $dbh->query($query);
      if ($result->rowCount() > 0) {
        switch ($reportType) {
          case 'report1':
            $txt = "Отчет популярности документов";
            break;
          case 'report2':
            $txt = "Статистика выданных документов (всего)";
            break;
          case 'report3':
            $txt = "Отчет заполненности стеллажей";
            break;

          case 'report4':
            $txt = "Отчет по количеству документов в категории";
            break;

          default:
            $txt = "";
            break;
        }
        $reportData = "<div class='panel-heading'>" .
          $txt
          . "</div><div class='panel-body'><div class='table-responsiv'><table class='table table-striped table-bordered table-hover' id='dataTables-report'><thead>";
        $columns = array_keys($result->fetch(PDO::FETCH_ASSOC)); // Заголовки таблицы
        foreach ($columns as $col) {
          $reportData .= "<th>" . htmlspecialchars($col) . "</th>";
        }
        $reportData .= "</tr></thead><tbody>";
        $result->execute(); // Повторно выполняем запрос для итерации
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
          $reportData .= "<tr class='odd gradeX'>";
          foreach ($row as $value) {
            $reportData .= "<td class='center'>" . htmlspecialchars($value) . "</td>";
          }
          $reportData .= "</tr>";
        }
        $reportData .= "</tbody></table></div></div>";
      } else {
        $reportData = "<div class='alert alert-warning'>Нет данных для отображения.</div>";
      }
    } else {
      $reportData = "<div class='alert alert-danger'>Выберите отчет.</div>";
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
    <!--[if IE]>
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
      <![endif]-->
    <title>Online Library Management System | Admin Dash Board</title>
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
        <h3 class="page-header">Отчеты</h3>
        <form method="POST" action="">
          <div class="form-group">
            <label for="reportType">Выберите отчет:</label>
            <select name="reportType" id="reportType" class="form-control">
              <option value="">--Выберите--</option>
              <option value="report1">Популярность документов</option>
              <option value="report2">Кол-во выданных документов по сотрудникам</option>
              <option value="report3">Заполненность стеллажей</option>
              <option value="report4">Количество документов в категории</option>
            </select>
          </div>
          <button type="submit" class="btn btn-primary">Сформировать</button>
        </form>

        <!-- Отображение данных отчета -->
        <div class='row'>
          <div class='col-md-12'>
            <div class='panel panel-default'>
              <?php echo $reportData; ?>
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