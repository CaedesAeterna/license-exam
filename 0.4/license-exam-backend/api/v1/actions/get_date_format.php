<?php

require_once 'config.php';
require_once 'db/db.php';
require_once 'utils/tasks.php';
require_once 'utils/general.php';
require_once 'utils/security.php';


requireLogin();

$uid = $_SESSION['id'];

$array = array();

$sql = "SELECT `date_format` FROM `users` WHERE `id` = '$uid';";


if ($rs = $db->query($sql)) {

    $row = $rs->fetch_assoc();
    $array['success'] = true;
    $array['date_format'] = $row['date_format'];
    $array['message'] = 'Successfully got date format';

    die(json_encode($array));
} else {

    $array['success'] = false;
    $array['message'] = 'Error getting date format';

    die(json_encode($array));
}