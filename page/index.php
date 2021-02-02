<?php
error_reporting(-1);
ini_set('display_errors',1);
header('Content-Type: text/html; charset=utf-8');
$page = (isset($_GET['page']) ? $_GET['page'] : 'main');
?>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <title>Тестовое задание - управление БД</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Favicons -->
  <link href="img/favicon.ico" rel="icon">

  <!-- Libraries -->
  <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
  <script src="https://code.jquery.com/ui/1.11.1/jquery-ui.min.js"></script>
  <script src="js/table-edit.js"></script>
  <script src="js/addrecord.js"></script>
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>


  <!-- Main Stylesheet File -->
  <link href="css/style.css" rel="stylesheet">
  <script>
    // Information dialog for upload
    $( function() {
      $( "#notify-comingsoon" ).dialog({
      autoOpen: false
    });
    
      $( "#btn-upload-csv" ).click(function() {
        $( "#notify-comingsoon" ).dialog( "open" );
      });
    });
  </script>
  
</head>
<body>
<div id="notify-comingsoon" title="Уведомление">
      <p>Здесь будет функция для загрузки CSV файла, чтобы заполнить им таблицу.</p>
    </div>
  <section class="main">
  <div class="container">
    <div class="header-wrapper">
      <h1 class="test-caption m-4">Управление базой данных</h1>
      <div class="manage-buttons">
        <ul class="list-inline m-3">
        <li class='list-inline-item btn-action'>
            <button id="create-record" class='btn btn-primary btn-lg rounded-0' type='button' data-toggle='tooltip' data-placement='top' title='Edit'><i class='fa fa-plus'></i></button>
          </li>
          <li class='list-inline-item btn-action'>
            <button class='btn btn-dark btn-lg rounded-0' type='button' data-toggle='tooltip' onClick="$(this).closest('.container').toggleClass('maximize');" data-placement='top' title='Edit'><i class='fa fa-expand'></i></button>
          </li>
          <li class='list-inline-item btn-action'>
            <button id="btn-upload-csv" class='btn btn-dark btn-lg rounded-0' type='button' data-toggle='tooltip' data-placement='top' title='Delete'><i class='fa fa-upload'></i></button>
          </li>
        </ul>
      </div>
    </div>

    <div id="dialog-form" title="Добавить запись">
      <form>
        <fieldset>
          <label for="partner_name">Наим. контрагента</label>
          <input type="text" name="partner_name" id="partner_name" value="Рога и Копыта 1" class="text ui-widget-content ui-corner-all">
          <label for="partner_type">Тип контрагента</label>
          <input type="text" name="partner_type" id="partner_type" value="Юр лицо" class="text ui-widget-content ui-corner-all">
          <label for="is_vip">ВИП клиент:</label>
          <input type="text" name="is_vip" id="is_vip" value="1" class="text ui-widget-content ui-corner-all">
          <label for="city">Нас. пункт*</label>
          <input type="text" name="city" id="city" value="Екатеринбург" class="text ui-widget-content ui-corner-all">
          <label for="service_type">Тип услуги*:</label>
          <input type="text" name="service_type" id="service_type" value="Vlan" class="text ui-widget-content ui-corner-all">
          <label for="base_address">Адрес VLAN От</label>
          <input type="text" name="base_address" id="base_address" value="Екатеринбург, Гагарина, 18" class="text ui-widget-content ui-corner-all">
          <label for="destination_address">До</label>
          <input type="text" name="destination_address" id="destination_address" value="Лесной, Дзержинского, 2" class="text ui-widget-content ui-corner-all">
          <label for="bandwidth">Ширина канала:</label>
          <input type="text" name="bandwidth" id="bandwidth" value="1 Гб/с" class="text ui-widget-content ui-corner-all">
          <label for="date_request_recieved">Дата заявки</label>
          <input type="text" name="date_request_recieved" id="date_request_recieved" value="текущая" class="text ui-widget-content ui-corner-all">
          <label for="traffic_source">Откуда узнали об услугах*:</label>
          <input type="text" name="traffic_source" id="traffic_source" value="от менеджера отдела продаж" class="text ui-widget-content ui-corner-all">
          <label for="personal_manager">Ответственный менеджер*:</label>
          <input type="text" name="personal_manager" id="personal_manager" value="Иванов Иван" class="text ui-widget-content ui-corner-all">
    
          <!-- Allow form submission with keyboard without duplicating the dialog button -->
          <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
        </fieldset>
      </form>
    </div>

    <?php
      // Block works with Php 5.5 and above
      $link = mysqli_connect("localhost", "ktelecom", "p@ssw0rd", "db_partners");

      if (!$link) {
        echo "Ошибка: Невозможно установить соединение с MySQL." . PHP_EOL;
        echo "Код ошибки errno: " . mysqli_connect_errno() . PHP_EOL;
        echo "Текст ошибки error: " . mysqli_connect_error() . PHP_EOL;
        exit;
      } else {
        $query = "SELECT * FROM table_partners";
        $result = mysqli_query($link, $query);
      }
    ?>

    <table class="table table-db" id="table-partners">
      <thead class="thead-dark">
        <tr>
          <th class="table-title" scope="col">Наименование контрагента</th>
          <th class="table-title" scope="col">Тип контрагента</th>
          <th class="table-title" scope="col">ВИП клиент:</th>
          <th class="table-title" scope="col">Нас. пункт*</th>
          <th class="table-title" scope="col">Тип услуги*:</th>
          <th class="table-title" scope="col">Адрес VLAN  От</th>
          <th class="table-title" scope="col">До</th>
          <th class="table-title" scope="col">Ширина канала:</th>
          <th class="table-title" scope="col">Дата заявки</th>
          <th class="table-title" scope="col">Откуда узнали об услугах*:</th>
          <th class="table-title" scope="col">Ответственный менеджер*:</th>
          <th class="table-title" scope="col">Действия</th>
        </tr>
      </thead>
      <?php
        echo "<tbody>";
        while ($row = mysqli_fetch_assoc($result)) {
          echo "<tr>";
          echo "<td class='table-row'>".$row["partner_name"]."</td>";
          echo "<td class='table-row'>".$row["partner_type"]."</td>";
          echo "<td class='table-row'>".$row["is_vip"]."</td>";
          echo "<td class='table-row'>".$row["city"]."</td>";
          echo "<td class='table-row'>".$row["service_type"]."</td>";
          echo "<td class='table-row'>".$row["base_address"]."</td>";
          echo "<td class='table-row'>".$row["destination_address"]."</td>";
          echo "<td class='table-row'>".$row["bandwidth"]."</td>";
          echo "<td class='table-row'>".$row["date_request_recieved"]."</td>";
          echo "<td class='table-row'>".$row["traffic_source"]."</td>";
          echo "<td class='table-row'>".$row["personal_manager"]."</td>";
          echo "
            <td class='no-editable'>
              <ul class='list-inline m-0'>
                <li class='list-inline-item btn-action'>
                  <button class='btn btn-success btn-sm rounded-0' type='button' data-toggle='tooltip' data-placement='top' title='Edit'><i class='fa fa-edit'></i></button>
                </li>
                <li class='list-inline-item btn-action'>
                  <button class='btn btn-danger btn-sm rounded-0' type='button' data-toggle='tooltip' onClick=\"$(this).closest('tr').remove();\" data-placement='top' title='Delete'><i class='fa fa-trash'></i></button>
                </li>
              </ul>
            </td>
          ";
          echo "</tr>";
        }
        echo "</tbody>";
      ?>
    </table>
    </div>
  </section>
</body>
</html>