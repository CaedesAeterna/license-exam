<?php


require_once 'config.php';
require_once 'db/db.php';
require_once 'utils/tasks.php';
require_once 'utils/general.php';
require_once 'utils/security.php';


requireLogin();


$tid = $db->escape_string($_POST['task_id']);




$sql = "SELECT u.id, u.name, u.email
    FROM `users` u, `tasks` t, `works_on_task` wot
   	where t.id = $tid and t.id = wot.tasks_id and wot.users_id = u.id";

$rs = $db->query($sql);
if ($rs->num_rows === 0) {
    die('could not get users for project');
}


$finalArray = array();
$users = array();

while ($row = $rs->fetch_assoc()) {
    $users[] = $row;
}


$finalArray['users'] = $users;


$success = true;

$finalArray['success'] = $success;

die(json_encode($finalArray));
