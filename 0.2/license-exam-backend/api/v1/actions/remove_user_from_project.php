<?php



require_once 'config.php';
require_once 'db/db.php';
require_once 'utils/tasks.php';
require_once 'utils/general.php';
require_once 'utils/security.php';


requireLogin();

$user_id = $db->escape_string($_POST['user_id']);
$project_id = $db->escape_string($_POST['project_id']);


$delete_from_wop_sql = "DELETE FROM `works_on_project` WHERE project_id = $project_id AND user_id = $user_id";



if ($db->query($delete_from_wop_sql)) {
    $success = true;
} else {
    $success = false;
}

die(json_encode($success));