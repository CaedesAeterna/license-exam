<?php

/*

{
    "success":....,
    "projects":[
    
    {
        "name":"...",
        "description":"...",
        "owner":"...",
        "status":"...",
        "start":"...",
        "finish":"...",
    },
    {
        "name":"...",
        "description":"...",
        "owner":"...",
        "status":"...",
        "start":"...",
        "finish":"...",

    }
   ]
}

*/
require_once 'utils/security.php';

//echo "$_SESSION[position]";

requireLogin();
$uid = $_SESSION['id'];


if ($_SESSION['position'] != '10') {

    $sql = "SELECT p.id, p.name, p.description, p.free_task_creating, p.active, p.start, p.finish 
    FROM projects p, works_on_project wop WHERE wop.user_id = '$uid' AND p.id = wop.project_id AND p.active = 1;";

} else {
    $sql = "SELECT p.id, p.name, p.description, p.free_task_creating, p.active, p.start, p.finish 
    FROM projects p;";
}


/*
$sql = "SELECT p.id, p.name, p.description, p.free_task_creating, p.owner, p.status, p.start, p.finish 
    FROM projects p, works_on_project wop WHERE wop.user_id = '$uid' AND p.id = wop.project_id;";

*/

$rs = $db->query($sql);
if ($rs->num_rows == 0) {
    die ('no projects');
}

$finalArray = array();

$finalArray['succes'] = true;

require_once 'config.php';
require_once 'db/db.php';
require_once 'utils/tasks.php';
require_once 'utils/general.php';



requireLogin();

$projectsList = array();

while ($row = $rs->fetch_assoc()) {

    $res = array();


    //echo date('Y-m-d');

    $res['project_id'] = $row['id'];
    $res['name'] = $row['name'];

    $res['description'] = $row['description'];
    $res['active'] = $row['active'];


    $res['start'] = $row['start'];
    $res['finish'] = $row['finish'];


    $res['start'] = dateFormat($res['start']);

    if ($res['finish'] != '') {
        $res['finish'] = dateFormat($res['finish']);
    } else {
        $res['finish'] = '';
    }


    $projectsList[] = $res;


}

$finalArray['projects'] = $projectsList;

die (json_encode($finalArray));