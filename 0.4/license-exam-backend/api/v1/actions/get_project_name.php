<?php


require_once 'config.php';
require_once 'db/db.php';
require_once 'utils/tasks.php';
require_once 'utils/general.php';
require_once 'utils/security.php';


requireLogin();

if (isset($_POST['project_id'])) {
    $project_id = $_POST['project_id'];
}

$sql = "SELECT name FROM projects WHERE id = $project_id;";


if ($rs = $db->query($sql)) {
    $array['project_name'] = $rs->fetch_assoc()['name'];
    $array['success'] = true;
    die(json_encode($array));
} else {
    $array['success'] = false;
    die(json_encode($array));
}



