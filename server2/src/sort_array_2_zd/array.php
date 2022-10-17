<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Select sort</title>
</head>
<body>
<?php
include 'sort_select.php';
$params = 0;
//isset — Определяет, была ли установлена переменная значением, отличным от null
if (!isset($_GET["array"])) {
    echo "Введите параметры";
} else {
    $params = $_GET["array"]; //Возвращает строку с параметрами
    echo "Исходный массив: " . $params . "<br/>";
        }
    //Преобразует строку в массив чисел
    $numbers = array_map('floatval', explode(',', $params));
    $numbers = sort_select($numbers);
    echo "Отсортированный массив: " . implode(" ", $numbers) . "<br/>";
?>
</body>
</html>