<?php include_once '../helper.php';
include_once '../entity/user_class.php';
include_once '../controllers/users.php';
function update(): void
{
    $data = json_decode(file_get_contents("php://input"), true);
    if (!array_key_exists('id', $data) || !array_key_exists('login', $data) || !array_key_exists('password', $data)) {
        bad_query(400);
    } else {
        $id = $data['id'];
        $login = $data['login'];
        $password = $data['password'];
        if (!isset($id)) {
            bad_query(400);
            return;
        }
        //для каждого набора параметров, подготавливаем свой sql запрос
        $tmp_user = new user_class(null, null, null);
        if (isset($password)) $tmp_user->setPassword($password);
        if (isset($login)) {
            $tmp_user->setName($login);
            $tmp_user->getPassword() != null
                ? $tmp_query = 'update auth set login = ?, password = ? where ID = ?' //Если меняем имя и пароль
                : $tmp_query = 'update auth set login = ? where ID = ?'; //Если меняем только имя
        } elseif (isset($password)) {
            $tmp_query = 'update auth set password = ? where ID = ?'; //Меняем только пароль
        } else {
            bad_query();
            return;
        }

        $tmp_user->setId(intval($id));
        $mysqli = openMysqli();
        $statement = $mysqli->prepare($tmp_query);
        $name1 = $tmp_user->getName();
        $password1 = $tmp_user->getPassword();
        $id1 = $tmp_user->getId();

        //Выбор набора параметров для выбранного запроса, в зависимости от переданных параметров
        $tmp_user->getPassword() !== null
            ? $tmp_user->getName() !== null
            ? $statement->bind_param("ssi", $name1, $password1, $id1)
            : $statement->bind_param('si', $password1, $id1)
            : $statement->bind_param('si', $name1, $id1);
        $statement->execute() ? success(200) : bad_query(400);
        $mysqli->close();
    }
}
