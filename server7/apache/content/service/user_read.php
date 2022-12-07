<?php include_once '../helper.php';
include_once '../entity/user_class.php';
include_once '../controllers/users.php';;
function read(): void
{
    $data = json_decode(file_get_contents("php://input"), true);
    if (array_key_exists('id', $data)) {
        $id = $data['id'];
        if (isset($id)) {
            $mysqli = openMysqli();
            $statement = $mysqli->prepare('select * from auth where ID = ?');
            $param = intval($id);
            $statement->bind_param('i', $param);
            if (!$statement->execute()) {
                bad_query(405);
            } else {
                $res = $statement->get_result()->fetch_assoc();
                if ($res == null) {
                    bad_query(405);
                    return;
                }
                $tmp_user = new user_class($res['ID'], $res['login'], $res['password']);
                http_response_code(200);
                echo json_encode($tmp_user->user_to_json());
            }

            $mysqli->close();
        } else {
            bad_query(400);
        }
    } else {
        bad_query(400);
    }
}
