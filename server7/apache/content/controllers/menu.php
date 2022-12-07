<?php require_once '../helper.php';
require_once '../service/sum_prices.php';
require_once '../service/change_prices.php';
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
function bad_query($code): void
{
    http_response_code($code);
    echo json_encode(array("message" => "Bad query for users with code " . $code));
}

function success($code): void
{
    http_response_code($code);
    echo json_encode(array("message" => "Users query execute success"));
}

//GET - запрос отвечает за
// суммиррование всех цен из таблицы меню
$method = $_SERVER['REQUEST_METHOD'];
switch ($method) {
    case 'GET':
        sum_all_prices();
        break;
    case 'POST':
        change_prices();
        break;
    default:
        bad_query(400);
        break;
}


