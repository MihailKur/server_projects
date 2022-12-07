<?php
require_once '../controllers/menu.php';
require_once '../helper.php';
function change_prices(): void
{
    $data = json_decode(file_get_contents("php://input"), true);
    if (array_key_exists('multiplier', $data)
        && array_key_exists('mode', $data))
    {
        $multiplier = $data['multiplier'];
        $mode = $data['mode'];
    }

    if (!isset($multiplier)
        || !is_numeric($multiplier)
        || !isset($mode)
        || !is_numeric($mode))
    {
        bad_query(400);
        return;
    }
    //mode - отвечает за операцию с ценами, 0 - умножить цену на коэффициент, иначе разделить
    $tmp_mode = intval($mode) == 0 ? '*' : '/';
    $mysqli = openMysqli();
    $statement = $mysqli->prepare(sprintf('update menu set price = price %s ?', $tmp_mode));
    $statement->bind_param('i', $multiplier);
    $statement->execute() ? success(200) : bad_query(404);
    $mysqli->close();
}
