<?php require "../entity/plot_graph.php";
$type = null;
$data = null;
if (array_key_exists('type', $_GET)) $type = $_GET['type'];
if (array_key_exists('data', $_GET)) $data = $_GET['data'];
$plot_graph = new plot_graph($type, $data);