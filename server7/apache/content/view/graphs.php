<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Graphs</title>
</head>
<body>
<?php
require '../../vendor/autoload.php';
require '../entity/Cafe.php';
$array = Cafe::get_data_set();
foreach ($array as $human) {
    $chart_type = array_rand([1, 2, 3]);
    echo <<<graphs
            <img src="/model/image_graph.php?type=$chart_type&data=$human">
        graphs;
}
?>
</body>
</html>
