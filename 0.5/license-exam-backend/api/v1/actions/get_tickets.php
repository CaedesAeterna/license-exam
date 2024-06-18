<?php


require_once 'config.php';
require_once 'db/db.php';
require_once 'utils/tasks.php';
require_once 'utils/general.php';
require_once 'utils/security.php';


requireLogin();


$project_id = $db->escape_string($_POST['project_id']);


$sql = "SELECT t.id, t.name, t.description FROM tickets t 
        WHERE projects_id = '$project_id' AND active = 1 and users_id is null";



if ($rs = $db->query($sql)) {
    $array['tickets'] = $rs->fetch_all(MYSQLI_ASSOC);
    $array['success'] = true;
    die(json_encode($array));
} else {
    $array['success'] = false;
    die(json_encode($array));
}