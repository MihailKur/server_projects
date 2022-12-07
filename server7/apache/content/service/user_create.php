<?php include_once '../helper.php';
include_once '../entity/user_class.php';
include_once '../controllers/users.php';;
function create(): void
{
    $tmp_user = new user_class(null, null, null);
    $data = json_decode(file_get_contents("php://input"), true);
    if (array_key_exists("login", $data) && array_key_exists("password", $data)) {
        if (isset($data['login']) && isset($data['password'])) {
            $tmp_user->setName($data['login']);
            $tmp_user->setPassword($data['password']);
            $mysqli = openMysqli();
            $statement = $mysqli->prepare('insert into auth(login, password) values(?, ?)');
            $_password = $tmp_user->getPassword();
            $_name = $tmp_user->getName();
            $statement->bind_param('ss', $_name, $_password);
            $statement->execute() ? success(201) : bad_query(503);
            $mysqli->close();
        } else {
            bad_query(400);
            return;
        }
    } else {
        bad_query(400);
    }
}
