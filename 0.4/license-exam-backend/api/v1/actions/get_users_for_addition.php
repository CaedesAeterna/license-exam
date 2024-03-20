<?php



require_once 'config.php';
require_once 'db/db.php';
require_once 'utils/tasks.php';
require_once 'utils/general.php';
require_once 'utils/security.php';


requireLogin();


$searchedUser = $db->escape_string($_POST['searchedUserString']);


$sql = "SELECT u.id, u.name
    FROM `users` u
    where u.name like '$searchedUser%'
    limit 10
    ";


$res = $db->query($sql);

if ($res->num_rows === 0) {
    die('could not get users for project');
}


$finalArray = array();

while ($row = $res->fetch_assoc()) {
    $users[] = array("id" => $row['id'], "value" => $row['name']);
}

$finalArray['users'] = $users;

$finalArray['success'] = true;


die(json_encode($finalArray));



