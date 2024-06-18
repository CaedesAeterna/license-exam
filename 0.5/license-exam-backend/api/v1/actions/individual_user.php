<?php


require_once 'config.php';
require_once 'db/db.php';
require_once 'utils/tasks.php';
require_once 'utils/general.php';
require_once 'utils/security.php';


requireLogin();

$user_id = $db->escape_string($_POST['user_id']);



$get_projects_sql = "SELECT p.id, p.name, p.description 
from projects p, works_on_project wop
where p.id = wop.project_id and wop.user_id=$user_id;";


$get_tasks_sql = "SELECT t.id, t.title, t.description, t.projects_id
from tasks t, works_on_task wot
where t.id = wot.tasks_id and wot.users_id=$user_id;";

$array = array();

$array['success'] = false;

if ($db->query($get_projects_sql)) {
    $array['projects'] = $db->query($get_projects_sql)->fetch_all(MYSQLI_ASSOC);
} else {
    die(json_encode($array));
}


if ($row = $db->query($get_tasks_sql)) {
    $array['tasks'] = $db->query($get_tasks_sql)->fetch_all(MYSQLI_ASSOC);
} else {
    die(json_encode($array));
}


$array['success'] = true;


die(json_encode($array));

