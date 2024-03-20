<?php

require_once 'utils/tasks.php';
require_once 'utils/general.php';
require_once 'utils/security.php';



requireLogin();

/*

{
    "succes":true,
    "id":  ... ,
    "description": ... ,
    "projects_id": ...

}

*/

$uid = $_SESSION['id'];

if (!isset ($_POST['task_id']))
    StopWith404();



$tid = $_POST['task_id'];

$task_title = $db->escape_string($_POST['task_title']);
$task_description = $db->escape_string($_POST['task_description']);

$_SESSION['task_title'] = $task_title;
$_SESSION['task_description'] = $task_description;

if (!isTaskAssignedToUser($uid, $tid)) {
    die ('not assigned');
}

$sql = "SELECT t.id, t.title, t.description,  t.other_info, t.start
FROM `tasks` t
where active=1 and t.id='$tid';";

$rs = $db->query($sql);
if ($rs->num_rows === 0) {
    die ('no task found');
}
$get_project_sql = "SELECT t.projects_id from tasks t where t.id='$tid';";

if (!$result = $db->query($get_project_sql)) {
    die ('could not get project_id');
}
$project_row = $result->fetch_assoc();


$row = $rs->fetch_assoc();

$res = array();
//$res['tid'] = $tid;

$res['succes'] = true;

$res['id'] = $row['id'];
$res['title'] = $row['title'];
$res['description'] = $row['description'];
$res['other_info'] = $row['other_info'];


$res['start'] = timeStampDateFormat($row['start']);


$res['projects_id'] = $project_row['projects_id'];

die (json_encode($res));