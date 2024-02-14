<?php


require_once 'config.php';
require_once 'db/db.php';
require_once 'utils/tasks.php';
require_once 'utils/general.php';
require_once 'utils/security.php';



requireLogin();

$raw_tid = $_POST['task_id'];
$tid = $db->escape_string($raw_tid);



//echo $tid;

if (isset($_POST['editTaskTitle'], $_POST['editDescription'])) {

    $task_title = $db->escape_string($_POST['editTaskTitle']);
    $task_description = $db->escape_string($_POST['editDescription']);


} else {
    $success = 'false';

    die(json_encode($success));
}

$uid = $db->escape_string($_SESSION['id']);

if (!isTaskAssignedToUser($uid, $tid)) {
    die('not assigned');
}



$sql = "update tasks set title = '$task_title', description = '$task_description' where id = '$tid';";


if ($db->query($sql)) {

    //echo "Record updated successfully";
    $success = 'true';

} else {
    //echo "Error updating record: " . $db->error;
    $success = 'false';
}

$get_project_sql = "SELECT t.projects_id from tasks t where t.id='$tid'";

if ($result = $db->query($get_project_sql)) {
    $row = $result->fetch_assoc();
    $project_id = $row['projects_id'];
} else {
    die('could not get project_id');
}

$array = array();
$array['success'] = $success;
$array['project_id'] = $project_id;
$array['task_id'] = $tid;

die(json_encode($array));


?>