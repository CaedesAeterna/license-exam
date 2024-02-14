<?php



require_once 'config.php';
require_once 'db/db.php';
require_once 'utils/tasks.php';
require_once 'utils/general.php';
require_once 'utils/security.php';


requireLogin();


$pid = $db->escape_string($_POST['project_id']);




$sql = "SELECT u.id, u.name, u.email
    FROM `users` u, `projects` p, `works_on_project` wop
   	where p.id = $pid and p.id = wop.project_id and wop.user_id = u.id";







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





