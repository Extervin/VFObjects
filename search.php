<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "dev";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Ошибка подключения: " . mysqli_connect_error());
}

$sql = "SELECT * FROM acc_1906";
$result = mysqli_query($conn, $sql);

$data = array();

while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

mysqli_close($conn);

// Отправляем данные в формате JSON на клиент
header('Content-Type: application/json');
echo json_encode($data);
?>
