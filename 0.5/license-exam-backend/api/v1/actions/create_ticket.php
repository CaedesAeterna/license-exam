<?php


require_once 'config.php';
require_once 'db/db.php';
require_once 'utils/tasks.php';
require_once 'utils/general.php';
require_once 'utils/security.php';

requireLogin();


if (!isset($_POST['project_id']) || !isset($_POST['ticketName']) || !isset($_POST['ticketDescription'])) {
    die('{"success": false}');
}


$project_id = $db->escape_string($_POST['project_id']);

$ticket_name = $db->escape_string($_POST['ticketName']);
$ticket_description = $db->escape_string($_POST['ticketDescription']);


$sql = "INSERT INTO tickets (name, description, active, projects_id) 
        VALUES ( '$ticket_name', '$ticket_description',1 ,'$project_id' );";


if ($rs = $db->query($sql)) {

    $array['success'] = true;
    die(json_encode($array));

} else {

    $array['success'] = false;
    die(json_encode($array));

}

