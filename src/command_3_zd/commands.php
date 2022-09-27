<!doctype html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Work commands</title>
</head>
<body>
<?php
include 'commands_maker.php';

if (isset($_GET['command'])) {
    try {
        echo get_command($_GET['command']);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
} else {
    echo 'Выберите команду';
}
?>
</body>