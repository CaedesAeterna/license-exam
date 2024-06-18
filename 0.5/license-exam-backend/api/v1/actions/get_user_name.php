<?php


require_once 'config.php';
require_once 'db/db.php';
require_once 'utils/tasks.php';
require_once 'utils/general.php';
require_once 'utils/security.php';

requireLogin();


if (isset($_POST['user_id'])) {
    $user_id = $db->escape_string($_POST['user_id']);
}
$sql = "SELECT name FROM users WHERE id = '$user_id'";
if ($rs = $db->query($sql)) {
    $array = $rs->fetch_assoc();
    $array['success'] = true;
    die(json_encode($array));

} else {
    $array['success'] = false;
    die(json_encode($array));
    
}