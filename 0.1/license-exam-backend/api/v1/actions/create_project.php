<?php


require_once 'config.php';
require_once 'db/db.php';
require_once 'utils/tasks.php';
require_once 'utils/general.php';

$uid = $_SESSION['id'];

$project_name = $db->escape_string($_POST['project_name']);
$project_description = $db->escape_string($_POST['project_description']);
$free_task_creating = $db->escape_string($_POST['free_task_creating']);

$new_project_sql = "INSERT INTO projects (name, description,free_task_creating, start,status) 
                    VALUES ('$project_name', '$project_description','$free_task_creating', NOW(),1);";

$insert_into_assigment_table = "INSERT INTO works_on_project (user_id, project_id) values ('$uid',LAST_INSERT_ID());";


if (!$db->query($new_project_sql)) {
    die('could not create project');
}
if (!$db->query($insert_into_assigment_table)) {
    die('could not create project');
}





$success = true;
die(json_encode($success));








