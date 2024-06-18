<?php



require_once 'config.php';
require_once 'db/db.php';
require_once 'utils/tasks.php';
require_once 'utils/general.php';
require_once 'utils/security.php';

requireLogin();

if (!isset($_POST['user_id']) || !isset($_POST['task_id'])) {
    die('could not get task id');
}


$user_id = $db->escape_string($_POST['user_id']);
$task_id = $db->escape_string($_POST['task_id']);

//echo $user_id . ' ' . $task_id;


$delete_from_wot_sql = "DELETE FROM `works_on_task` WHERE tasks_id = $task_id AND users_id = $user_id";

// todo check if this works why empty the result


if ($db->query($delete_from_wot_sql)) {
    $success = true;
} else {
    $success = false;
}


die(json_encode($success));