<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Menu</title>
        <script src="http://localhost:8082/_helper.js"></script>
        <style>
            * {
                font-family: C059;
            }
            td {
                padding: 5px;
            }
        </style>
    </head>
    <body>
        <h1>Menu</h1>
        <?php
            require_once 'helper.php';
            $mysqli = openMysqli();
            $result = $mysqli->query("select * from " . menu);
        ?>
        <table border="2">
            <?php if ($result->num_rows > 0) foreach ($result as $product) echo <<<A
            <tr>
                <td><a href="/view.php?id={$product[id]}">{$product[name]}</a></td>
                <td>{$product[description]}</td>
                <td>{$product[price]}</td>
            </tr>
        A; else echo 'Empty'; ?></table>
    </body>
</html>
