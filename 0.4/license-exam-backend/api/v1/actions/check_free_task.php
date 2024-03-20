<?php


require_once 'config.php';
require_once 'db/db.php';
require_once 'utils/tasks.php';
require_once 'utils/general.php';
require_once 'utils/security.php';


requireLogin();

if (!isset($_POST['project_id'])) {
    die('{"success": "false", "message": "project_id is not set"}');
}

$project_id = $db->escape_string($_POST['project_id']);

$sql = "select p.free_task_creating from projects p where p.id = $project_id and p.active = 1";

if ($rs = $db->query($sql)) {
    $row = $rs->fetch_assoc();
    if ($row['free_task_creating']) {
        $array['free_task_creating'] = true;
        $array['success'] = true;
        die(json_encode($array));
    } else {
        $array['free_task_creating'] = false;
        $array['success'] = false;
        die(json_encode($array));
    }
} else {
    $array['free_task_creating'] = false;
    $array['success'] = false;
    die(json_encode($array));
}
