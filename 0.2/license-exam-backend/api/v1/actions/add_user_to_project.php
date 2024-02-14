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

if (!isset($_POST['project_id'])) {
    die('could not get project id');
}

$project_id = $db->escape_string($_POST['project_id']);

if ($user_id_sql == null || $project_id == null) {
    die('could not get users for project');
}

$res = $db->query($user_id_sql);

if ($res->num_rows === 0) {
    die('could not get user id ');
}

$row = $res->fetch_assoc();

$uid = $row['id'];

$insert_into_wop_sql = "INSERT INTO `works_on_project` (`project_id`, `user_id`) VALUES ('$project_id', '$uid');";

if ($db->query($insert_into_wop_sql)) {
    $success = true;
} else {
    $success = false;
}

die(json_encode($success));