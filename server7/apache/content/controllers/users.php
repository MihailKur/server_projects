<?php require_once '../helper.php';
require_once '../service/user_read.php';
require_once '../service/user_create.php';
require_once '../service/user_update.php';
require_once '../service/user_delete.php';
require_once '../entity/user_class.php';
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
const columns = ['ID', 'login', 'password'];
function bad_query($code)
{
    http_response_code($code);
    echo json_encode(array("message" => "Bad query for users with code " . $code));
}

function success($code)
{
    http_response_code($code);
    echo json_encode(array("message" => "Users query execute success"));
}

//Если пришел GET запрос, то выводим метод чтения одного пользователя
$method = $_SERVER['REQUEST_METHOD'];
//Для POST запроса выбираем метод согласно параметру
switch ($method) {
    case 'GET':
        read();
        break;
    case 'POST':
        create();
        break;
    case 'PUT':
        update();
        break;
    case 'DELETE':
        delete();
        break;
    default:
        bad_query(400);
        break;
}


