<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
$accountName = $_SESSION['accountName']; 

date_default_timezone_set('Europe/Sofia');
$current_time = date('d-m-y H:i');

$servername = "localhost";
$username = "root";
$password = "";
$database = "dev";
$index = 1;

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Ошибка подключения: " . mysqli_connect_error());
}

// Проверка, был ли передан запрос на обновление данных
if (isset($_POST['action']) && isset($_POST['column']) && isset($_POST['id'])) {
  $action = $_POST['action'];
  $col = $_POST['column'];
  $id = $_POST['id'];

  // Проверка наличия значения для обновления (можете добавить свои собственные условия)
  if ($action === 'changeText') {
      // Проверка текущего значения в базе данных
      $sqlCheck = "SELECT $col FROM acc_1906 WHERE Nkod = ?";
      $stmtCheck = $conn->prepare($sqlCheck);
      $stmtCheck->bind_param('s', $id);
      $stmtCheck->execute();
      $stmtCheck->bind_result($currentValue);
      $stmtCheck->fetch();
      $stmtCheck->close();

      // Если текущее значение не равно NULL, не производим обновление
      if ($currentValue !== NULL) {
          echo "error"; // Или любой другой код/сообщение об ошибке
          exit();
      }

      // Генерация нового значения для обновления
      $newValue = $accountName . "|" . $current_time;
  } elseif ($action === 'clearText') {
      $newValue = NULL;
  }

  // Обновление значения в базе данных
  $columnName = $col;
  $sqlUpdate = "UPDATE acc_1906 SET $columnName = ? WHERE Nkod = ?";
  $stmtUpdate = $conn->prepare($sqlUpdate);
  $stmtUpdate->bind_param('ss', $newValue, $id);
  $stmtUpdate->execute();
  $stmtUpdate->close();

  // Возвращаем ответ клиенту (можете настроить свой ответ)
  echo "success";
  exit();
}


$sql = "SELECT * FROM acc_1906";
$result = mysqli_query($conn, $sql);

echo '<table id="databaseTable">
          <thead>
              <tr>
                <th id="id-column">#</th>
                <th id="connection-column">Connection</th>
                <th>Object Name</th>
                <th>IT</th>
                <th>Архив</th>
                <th>Смяна на версия</th>
              </tr>
          </thead>
          <tbody>';

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>
            <td>$index</td>
            <td>
              <div class='connection-icon-container'>
                <div class='connection-icon red'></div>
              </div>
            </td>
            <td>{$row['Obekt']}</td>
            <td>{$row['IT']}</td>
            <td>";

    // Генерируем уникальные идентификаторы для a1
    $a1_id = "a1_" . $index;
    $a1_button_id = "a1_button_" . $index;
    $a1_span_id = "a1_span_" . $row['Nkod'];
    if ($row['a1'] !== NULL) {
      $insert = explode("|", $row['a1']);
    }


    // Проверяем, если значение a1 равно NULL
    if ($row['a1'] === null) {
      echo "<div id='$a1_id'>
      <span id='$a1_span_id' class='click' onclick='changeText(\"$a1_span_id\", \"$a1_button_id\")'>Click</span>
      <button id='$a1_button_id' class='clear-button hidden' onclick='clearText(\"$a1_span_id\", \"$a1_button_id\")'>Clear</button>
      </div>";
    } else {
      echo "<div id='$a1_id'>
      <span id='$a1_span_id' class='' onclick='changeText(\"$a1_span_id\", \"$a1_button_id\")'>$insert[0]</span>
      <button id='$a1_button_id' class='clear-button hidden' onclick='clearText(\"$a1_span_id\", \"$a1_button_id\")'>Clear</button>
      </div>";
    }

    echo "</td>
          <td>";

    // Генерируем уникальные идентификаторы для a2
    $a2_id = "a2_" . $index;
    $a2_button_id = "a2_button_" . $index;
    $a2_span_id = "a2_span_" . $row['Nkod'];
    if ($row['a2'] !== NULL) {
      $insert = explode("|", $row['a2']);
    }

    // Проверяем, если значение a2 равно NULL
    if ($row['a2'] === null) {
      echo "<div id='$a2_id'>
      <span id='$a2_span_id' class='click' onclick='changeText(\"$a2_span_id\", \"$a2_button_id\")'>Click</span>
      <button id='$a2_button_id' class='clear-button hidden' onclick='clearText(\"$a2_span_id\", \"$a2_button_id\")'>Clear</button>
      </div>";
    } else {
      echo "<div id='$a2_id'>
      <span id='$a2_span_id' class='' onclick='changeText(\"$a2_span_id\", \"$a2_button_id\")'>$insert[0]</span>
      <button id='$a2_button_id' class='clear-button hidden' onclick='clearText(\"$a2_span_id\", \"$a2_button_id\")'>Clear</button>
      </div>";
    }

    echo "</td>
          </tr>";

    $index++;
}

echo "</tbody>
      </table>";

mysqli_close($conn);
?>
