<?php


require_once 'config.php';
require_once 'db/db.php';
require_once 'utils/tasks.php';
require_once 'utils/general.php';
require_once 'utils/security.php';



requireLogin();

$uid = $db->escape_string($_SESSION['id']);
$tid = $db->escape_string($_POST['task_id']);


if (!isTaskAssignedToUser($uid, $tid)) {
    die ('not assigned');
}

$reports_sql = "SELECT r.id, r.user_id, r.summary, r.comments, r.hours, r.start 
                FROM reports r 
                where r.tasks_id = '$tid';";

$reports = $db->query($reports_sql)
    or die ('could not get reports');


$finalArray = array();
$finalArray['success'] = true;
$reports_array = array();



while ($row = $reports->fetch_assoc()) {
    $array = array();

    $get_user_name_sql = "SELECT u.name FROM users u WHERE u.id = '$row[user_id]';";

    if ($rs = $db->query($get_user_name_sql)) {
        $name = $rs->fetch_assoc();
        $name = $name['name'];
    }

    $array['worker_name'] = $name;
    $array['worker_id'] = $row['user_id'];
    $array['id'] = $row['id'];
    $array['summary'] = $row['summary'];
    $array['comments'] = $row['comments'];
    $array['hours'] = $row['hours'];
    $array['start'] = dateFormat($row['start']);

    $reports_array[] = $array;
}
$finalArray["reports"] = $reports_array;


die (json_encode($finalArray));
















