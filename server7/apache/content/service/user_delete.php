<?php include_once '../helper.php';
include_once '../entity/user_class.php';
include_once '../controllers/users.php';
function delete(): void
{
    $data = json_decode(file_get_contents("php://input"), true);
    if (!array_key_exists("id", $data)) {
        bad_query(400);
    } else {
        $id = $data['id'];
        if (isset($id)) {
            $mysqli = openMysqli();
            $statement = $mysqli->prepare('DELETE FROM auth WHERE ID = ?');
            $param = intval($id);
            $statement->bind_param('i', $param);
            $statement->execute() ? success(201) : bad_query(503);
            $mysqli->close();
        }
    }

}
