<?php

require_once 'config.php';
require_once 'db/db.php';
require_once 'utils/tasks.php';
require_once 'utils/general.php';



if (!isset($_POST['task_id'])) {
    die('task_id is not set');
}

$task_id = $db->escape_string($_POST['task_id']);

$get_project_sql = "SELECT t.projects_id from tasks t where t.id='$task_id';";

if ($result = $db->query($get_project_sql)) {
    $row = $result->fetch_assoc();
    $project_id = $row['projects_id'];
} else {
    die('could not get project_id');
}


$uid = $db->escape_string($_SESSION['id']);

if (!isTaskAssignedToUser($uid, $task_id)) {
    die('not assigned');
}


$assignment_delete = "delete from works_on_task where tasks_id='$task_id' and users_id='$uid'; ";

$task_delete = "delete from tasks where id='$task_id';";



if ($db->query($assignment_delete)) {
    if ($db->query($task_delete)) {
        //echo "Record deleted successfully";
        $success = "true";
    } else {
        //echo "Error: " . $sql . "<br>" . $db->error;
        $success = "false";
    }
} else {
    //echo "Error: " . $sql . "<br>" . $db->error;
    $success = "false";
}




$array = array();
$array['success'] = $success;
$array['project_id'] = $project_id;


die(json_encode($array));


