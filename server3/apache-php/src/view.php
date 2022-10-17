<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Valuable details</title>
        <style>
            td{
                padding: 5px;}
        </style>
    </head>
    <body>
        <?php require_once 'helper.php'; $id = $_GET[strtolower(id)];
            if (!isset($id) || !is_numeric($id)) throw new Exception();

            $mysqli = openMysqli();
            $statement = $mysqli->prepare('select * from menu where ID = ?');
            $_id = intval($id);//приведение айди к целочисленному типу
            $statement->bind_param('i', $_id);//определение блюда
            $statement->execute();//выполнение запроса
            $product = $statement->get_result()->fetch_assoc();//получение рез в виде списка
            echo <<<A
            <table border="1">
                <tr>
                    <td>$product[name]</td>
                    <td>$product[description]</td>
                    <td>Price: <span>$product[price]</span></td>
                </tr>
            </table>
                
            A;
            $mysqli->close();
        ?>
    </body>
</html>
