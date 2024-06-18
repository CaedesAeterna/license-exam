<?php


require_once 'config.php';
require_once 'db/db.php';
require_once 'utils/tasks.php';
require_once 'utils/general.php';
require_once 'utils/security.php';



requireLogin();

$uid = $db->escape_string($_SESSION['id']);
$tid = $db->escape_string($_POST['task_id']);

if (!isTaskAssignedToUser($uid, $tid)) {
    die('not assigned');
}

$reports_id = $db->escape_string($_POST['reports_id']);
$task_id = $db->escape_string($_POST['task_id']);
$projects_id = $db->escape_string($_POST['projects_id']);

//10 is admin
//20 is manager
//30 is worker
//40 is client

if ($_SESSION['position'] <= 10) {
    $delete_report_sql = "DELETE FROM `reports` WHERE `reports`.`id` = '$reports_id';";

} else {
    $sql = "select user_id from reports where id = '$reports_id'";

    if ($result = $db->query($sql)) {
        $row = $result->fetch_assoc();
        if ($row['user_id'] != $uid) {
            die('{"success": false, "message": "not your report"}');
        }
    }
}

if (!$db->query($delete_report_sql)) {
    $finalArray['success'] = false;
} else {
    $finalArray['success'] = true;
}


die(json_encode($finalArray));