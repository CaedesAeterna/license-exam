<?php


require_once 'config.php';
require_once 'db/db.php';
require_once 'utils/tasks.php';
require_once 'utils/general.php';


$uid = $db->escape_string($_SESSION['id']);
$tid = $db->escape_string($_POST['task_id']);

if (!isTaskAssignedToUser($uid, $tid)) {
    die('not assigned');
}

$reports_id = $db->escape_string($_POST['reports_id']);
$task_id = $db->escape_string($_POST['task_id']);
$projects_id = $db->escape_string($_POST['projects_id']);


$delete_report_sql = "DELETE FROM `reports` WHERE `reports`.`id` = '$reports_id';";



if (!$db->query($delete_report_sql)) {
    $finalArray['success'] = false;
} else {
    $finalArray['success'] = true;
}


die(json_encode($finalArray));