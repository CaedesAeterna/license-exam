<?php


require_once 'config.php';
require_once 'db/db.php';
require_once 'utils/tasks.php';
require_once 'utils/general.php';
require_once 'utils/security.php';



requireLogin();


$project_name = $db->escape_string($_POST['project_name']);
$project_description = $db->escape_string($_POST['project_description']);
$free_task_creating = $db->escape_string($_POST['free_task_creating']);
$due_date = $db->escape_string($_POST['due_date']);


if ($free_task_creating == 1) {
    if (!checkAdminLogin() and !checkManagerLogin() and !checkWorkerLogin()) {
        redirectToLogin();
    }
} else {
    if (!checkAdminLogin() and !checkManagerLogin()) {
        redirectToLogin();
    }
}




$uid = $_SESSION['id'];


$new_project_sql = "INSERT INTO projects (name, description, free_task_creating, start, active, due_date) 
                    VALUES ('$project_name', '$project_description','$free_task_creating', NOW(), 1, '$due_date');";

$insert_into_assigment_table = "INSERT INTO works_on_project (user_id, project_id) values ('$uid',LAST_INSERT_ID());";


if (!$db->query($new_project_sql)) {
    die ('{"succes":false, "message":"could not create project"}');
}
if (!$db->query($insert_into_assigment_table)) {
    die ('{"succes":false, "message":"could not create project"}');
}



$success = true;

die (json_encode($success));








