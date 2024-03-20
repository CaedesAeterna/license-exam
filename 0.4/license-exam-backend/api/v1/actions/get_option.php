<?php

require_once 'config.php';
require_once 'db/db.php';
require_once 'utils/tasks.php';
require_once 'utils/general.php';
require_once 'utils/security.php';


requireLogin();


$array = array();

$key = $db->escape_string($_POST['key']);
$value = $db->escape_string($_POST['value']);


$sql = "select `$value` from `config` where `key` = '$key'";

if ($rs = $db->query($sql)) {

    $row = $rs->fetch_assoc();
    $array['success'] = true;
    $array['$value'] = $row['value'];

    $array['message'] = "Successfully got '$key'";

    die (json_encode($array));
} else {

    $array['success'] = false;
    $array['message'] = 'Error getting date format';

    die (json_encode($array));
}