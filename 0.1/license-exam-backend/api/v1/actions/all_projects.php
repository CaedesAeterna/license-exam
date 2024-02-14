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

$uid = $_SESSION['id'];




$sql = "SELECT p.id, p.name, p.description, p.free_task_creating, p.owner, p.status, p.start, p.finish 
    FROM projects p, works_on_project wop WHERE wop.user_id = '$uid' AND p.id = wop.project_id;";

$rs = $db->query($sql);
if ($rs->num_rows == 0) {
    die('no projects');
}

$finalArray = array();

$finalArray['succes'] = true;
$projectsList = array();

while ($row = $rs->fetch_assoc()) {

    $res = array();
    $res['project_id'] = $row['id'];
    $res['name'] = $row['name'];
    $res['description'] = $row['description'];
    $res['status'] = $row['status'];
    $res['start'] = $row['start'];
    $res['finish'] = $row['finish'];

    $projectsList[] = $res;

}

$finalArray['projects'] = $projectsList;

die(json_encode($finalArray));