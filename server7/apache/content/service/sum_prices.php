<?php require_once '../controllers/menu.php';
require_once '../helper.php';
function sum_all_prices(): void
{
    $mysqli = openMysqli();
    $result = $mysqli->query('select sum(price) from menu');

    //Если совпадений не нашлось
    if ($result->num_rows != 1) {
        bad_query(501);
    } else{
        http_response_code(200);
        echo json_encode(array("Sum of all dishes" => array_values($result->fetch_assoc())[0]));
    }
    $mysqli->close();
}