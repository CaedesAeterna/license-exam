<?php


/*

{
 
    succes:true,
    tasks:[
        {   
            id:"...",
            title:"...",
            description:"...",
            hours:"...",
            other_info:"...",
            projects_id:"..."
        }
    ]

}

*/

require_once 'config.php';
require_once 'db/db.php';
require_once 'utils/security.php';



requireLogin();

$raw_pid = $_POST['project_id'];

$pid = $db->escape_string($raw_pid);


if (!isset($_POST['project_id'])) {
    die('project_id is not set');
}

/*
if (!isProjectMember($pid)) {
    die('not a member');
}
*/

$sql = "SELECT t.id, t.title, t.description,  t.other_info, t.projects_id
    from tasks t
    where t.projects_id='$pid' and active=1;";

$rs = $db->query($sql);
if ($rs->num_rows === 0) {
    die('no task found');
}


$finalArray = array();

$tasks = array();

while ($row = $rs->fetch_assoc()) {

    $res = array();
    $res['id'] = $row['id'];
    $res['title'] = $row['title'];
    $res['description'] = $row['description'];

    //$res['hours'] = $row['hours'];
    $res['other_info'] = $row['other_info'];
    $res['projects_id'] = $row['projects_id'];


    $tasks[] = $res;

    $finalArray['tasks'] = $tasks;
}

if (empty($finalArray)) {
    $finalArray['succes'] = false;
}

$finalArray['succes'] = true;

die(json_encode($finalArray));