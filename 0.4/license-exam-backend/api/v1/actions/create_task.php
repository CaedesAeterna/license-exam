<?php


require_once 'config.php';
require_once 'db/db.php';
require_once 'utils/security.php';



requireLogin();
$new_task_title = $db->escape_string($_POST['task_title']);
$new_task_description = $db->escape_string($_POST['task_description']);

$project_id = $db->escape_string($_POST['project_id']);

if ($new_task_title == 'Total Hours') {
    die ('{"success":false,"message":"Invalid summary you cannot give total hours as title"}');
}

$date = date('Y-m-d');

$sql = "INSERT INTO tasks (title, description, start,  active, projects_id) VALUES 
('$new_task_title', '$new_task_description', '$date', 1 ,'$project_id');";




if ($db->query($sql)) {
    //echo "Record inserted successfully";
} else {
    //echo "Error: " . $sql . "<br>" . $db->error;
    die ("Not inserted record");
}


$get_new_task = "select t.id from tasks t 
where t.title = '$new_task_title' and 
t.description = '$new_task_description' and 
 t.projects_id = '$project_id'";


$result = $db->query($get_new_task);

if ($result) {
    $row = $result->fetch_assoc();
    if ($row) {
        $task_id = $row['id'];
    } else {
        //echo "No rows found";
    }
} else {
    //die("Error: " . $sql . "<br>" . $db->error);
}

$user_id = $db->escape_string($_SESSION['id']);

$works_on_sql = "INSERT INTO works_on_task (tasks_id,users_id) VALUES ('$task_id','$user_id');";

if ($db->query($works_on_sql)) {

    //echo "Record inserted successfully";
    $success = true;
} else {
    //echo "Error: " . $sql . "<br>" . $db->error;
    $success = false;
}

$array = array();
$array['success'] = $success;
$array['project_id'] = $project_id;

die (json_encode($array));
?>