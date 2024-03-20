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


if (!isset ($_POST['project_id'])) {
    die ('project_id is not set');
}

$pid = $db->escape_string($_POST['project_id']);
$user_id = $_SESSION['id'];

/*
if (!isProjectMember($pid)) {
    die('not a member');
}
*/

$project_sql = "SELECT name, due_date from projects where id = '$pid'";

if (
    !$project_name = $db->query($project_sql)->fetch_assoc()['name'] or
    !$due_date = $db->query($project_sql)->fetch_assoc()['due_date']
) {

    $success = false;
    die (json_encode($success));
}

if ($_SESSION['position'] < 11) {
    $sql = "SELECT t.id, t.title, t.description,  t.other_info, t.projects_id, t.start, t.finish
    from tasks t
    where t.projects_id = '$pid' and active = 1;";

} else {

    $sql = "SELECT t.id, t.title, t.description,  t.other_info, t.projects_id, t.start, t.finish
    from tasks t, works_on_task wot, users u 
    where   t.projects_id = '$pid' and 
            t.id = wot.tasks_id and 
            wot.users_id = u.id and
            u.id = '$user_id' and 
            t.active = 1;";

}


if (!$rs = $db->query($sql)) {
    die ('{"success": false, "message": "Error executing query"}');
}



$finalArray = array();

$tasks = array();

while ($row = $rs->fetch_assoc()) {

    $res = array();
    $res['id'] = $row['id'];
    $res['title'] = $row['title'];
    $res['description'] = $row['description'];


    $res['start'] = dateFormat($row['start']);

    if ($res['finish'] != '') {
        $res['finish'] = dateFormat($row['finish']);
    } else {
        $res['finish'] = '';
    }

    $res['other_info'] = $row['other_info'];
    $res['projects_id'] = $row['projects_id'];


    $tasks[] = $res;

    $finalArray['tasks'] = $tasks;
}

if (empty ($finalArray)) {
    $finalArray['succes'] = false;
}

$finalArray['succes'] = true;
$finalArray['project_name'] = $project_name;
$finalArray['due_date'] = dateFormat($due_date);

die (json_encode($finalArray));