<?php

require_once 'config.php';
require_once 'db/db.php';
require_once 'utils/tasks.php';
require_once 'utils/general.php';
require_once 'utils/security.php';

requireLogin();


$searchedUser = $db->escape_string($_POST['searchedUser']);

$user_id_sql = "SELECT u.id
   FROM `users` u
   WHERE u.name like '$searchedUser%';";

if (!isset($_POST['task_id'])) {
    die('could not get task id');
}

$task_id = $db->escape_string($_POST['task_id']);

if ($user_id_sql == null || $task_id == null) {
    die('could not get users for task');
}

$res = $db->query($user_id_sql);

if ($res->num_rows === 0) {
    die('could not get user id ');
}

$row = $res->fetch_assoc();

$uid = $row['id'];

$insert_into_wot_sql = "INSERT ignore INTO  `works_on_task` (`tasks_id`, `users_id`) 
                        VALUES ('$task_id', '$uid');";

if ($db->query($insert_into_wot_sql)) {
    $success = $db->affected_rows > 0; // True if a row was inserted
} else {
    $success = false;
}


die(json_encode($success));