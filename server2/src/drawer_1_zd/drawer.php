<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Drawer</title>
</head>
<body>
<?php

include_once 'drawer_helper.php';
if (isset($_GET['drawer'])) {
    $url_parameter = $_GET['drawer'];
    //Параметр должен быть 8-и битным числом
    if (!is_numeric($url_parameter) || $url_parameter < 0 || $url_parameter > (1 << 8))
        echo 'Bad parameter';
    else new drawer_helper($url_parameter);
}
?>
</body>
</html>