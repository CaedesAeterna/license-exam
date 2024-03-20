<?php



require_once 'config.php';
require_once 'db/db.php';
require_once 'utils/tasks.php';
require_once 'utils/general.php';
require_once 'utils/security.php';



if (!isset($_SESSION['id']) or !isset($_SESSION['position'])) {
    $array = array();

    $array['success'] = false;
    die(json_encode($array));
}


$position = $db->escape_string($_SESSION['position']);



$array = array();

$array['success'] = true;
$array['position'] = $position;

die(json_encode($array));






