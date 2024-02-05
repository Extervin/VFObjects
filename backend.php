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
                <th>Тагове</th>
                <th>IT</th>
                <th>Архив</th>
                <th>Смяна на версия</th>
              </tr>
          </thead>
          <tbody>';

          while ($row = mysqli_fetch_assoc($result)) {

            $rowClasses = array();
            $dbString = $row['mode'];

            for ($i = 0; $i < strlen($dbString); $i++) {
              $char = $dbString[$i];
              switch ($char) {
                case 'c':
                    $rowClasses[] = 'click-object';
                    break;
                case 'o':
                    $rowClasses[] = 'unusual';
                    break;
                case 'n';
                    $rowClasses[] = 'new';
                    break;
                case 's';
                    $rowClasses[] = 'closed';
                    break;
              }
            }

            echo "<tr class='" . implode(' ', $rowClasses) . "'>
                    <td>$index</td>
                    <td>
                      <div class='connection-icon-container'>
                        <div class='connection-icon red'></div>
                      </div>
                    </td>
                    <td>{$row['Obekt']}</td>
        
                    <td class='tag-container'>";
        
            $taggedString = '';
        
            for ($i = 0; $i < strlen($dbString); $i++) {
                $char = $dbString[$i];
        
                switch ($char) {
                    case 'f':
                        $taggedString .= "<span class='tag mt'>МТ</span>";
                        break;
                    case 'h':
                        $taggedString .= "<span class='tag mtmx'>МТ</span>";
                        break;
                    case 'w':
                        $taggedString .= "<span class='tag mtout'>МТ</span>";
                        break;
                    case 'v':
                        $taggedString .= "<div class='tag hitV'>
                        <svg width='24' height='20' viewBox='0 0 24 20' fill='none' xmlns='http://www.w3.org/2000/svg'>
                        <path d='M12 19.0267L17.5333 22.3733C18.5467 22.9867 19.7867 22.08 19.52 20.9333L18.0533 14.64L22.9467 10.4C23.84 9.62667 23.36 8.16 22.1867 8.06667L15.7467 7.52L13.2267 1.57334C12.7733 0.493336 11.2267 0.493336 10.7733 1.57334L8.25334 7.50667L1.81334 8.05334C0.640005 8.14667 0.160005 9.61334 1.05334 10.3867L5.94667 14.6267L4.48001 20.92C4.21334 22.0667 5.45334 22.9733 6.46667 22.36L12 19.0267Z' fill='#00ADF7'/>
                        </svg>
                        </div>";
                        break;
                    case 'm':
                        $taggedString .= "<span class='tag NZOK'>НЗОК</span>";
                        break;
                    case 'p':
                        $taggedString .= "<span class='tag three-percents'>3%</span>";
                        break;
                }
            }
        
            // выводим результат внутри td
            echo $taggedString;
        
            // продолжаем вывод остальной части строки
            echo "</td>
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