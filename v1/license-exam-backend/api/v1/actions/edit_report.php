<?php


require_once 'config.php';
require_once 'db/db.php';
require_once 'utils/tasks.php';
require_once 'utils/general.php';



function myErrorHandler($errno, $errstr, $errfile, $errline) {
    echo "<b>Error:</b> [$errno] $errstr<br />";
}

set_error_handler('myErrorHandler');


if(!isset($_POST['task_id'])) {
    die('no task id');
}

$uid = $db->escape_string($_SESSION['id']);
$tid = $db->escape_string($_POST['task_id']);
$rid = $db->escape_string($_POST['reports_id']);

$finalArray = array();


if(!isTaskAssignedToUser($uid, $tid)) {
    die('not assigned');
} else {
    $finalArray['success'] = true;
}

if(!isset($_POST['summary'], $_POST['comments'], $_POST['hours'], $_POST['startDateTime'])) {
    die('no data');
} else {
    $finalArray['success'] = true;
}


$summary = $db->escape_string($_POST['summary']);
$comments = $db->escape_string($_POST['comments']);
$hours = $db->escape_string($_POST['hours']);

$date_time_start = $db->escape_string($_POST['startDateTime']);


$date_time_date = strtotime($date_time_start);
$old_time_date = $date_time_date;

$old_day = date('d', strtotime($date_time_date));
$old_hour = date('H:i', strtotime($date_time_date));

if($hours > 24)
    die('{"success":false,"error":"invalid hours TODO"}');


$hours = trim($hours, " ");

if(strpos($hours, ":")) {
    $t = explode(":", $hours);
    // t[0] - 3
    // t[1] - 30
    $h = trim($t[0], " ");
    $m = trim($t[1], " ");
} else {
    $h = $hours;
    $m = 0;
}


//todo: old day and new day not matching


if(!is_numeric($h) || !is_numeric($m))
    die('{"success":false,"error":"invalid hours TODO"}');



$date_time_date += $h * 3600 + $m * 60;



$new_day = date('d', strtotime($date_time_date));
$new_hour = date('H:i', strtotime($date_time_date));

var_dump($old_day);
var_dump($new_day);

if($new_day != $old_day) {
    die('{"success":false,"error":"overlapping dates TODO"}');
}



$projects_id = $db->escape_string($_POST['projects_id']);


$sqlDate = date('Y-m-d', $date_time_date);
$sqlTime = date('H:i:s', $date_time_date);


$oldDateTime = new DateTime();
$oldDateTime->setTimestamp($old_time_date);

$newDateTime = new DateTime();
$newDateTime->setTimestamp($date_time_date);

$interval = $oldDateTime->diff($newDateTime);

$hours_diff = $interval->format('%h');
$minutes_diff = $interval->format('%i');

$duration = $hours_diff.":".$minutes_diff;


$update_report_sql = "UPDATE reports 
                        SET summary = '$summary', comments = '$comments', hours = '$hours' , 
                        start_date = '$old_time_date', duration = '$duration'
                        WHERE id = '$rid';";

$finalArray = array();



$finalArray['task_id'] = $tid;
$finalArray['summary'] = $summary;
$finalArray['comments'] = $comments;
$finalArray['hours'] = $hours;
$finalArray['sqlDate'] = $sqlDate;
$finalArray['sqlTime'] = $sqlTime;
$finalArray['duration'] = $duration;


if($db->query($update_report_sql)) {
    $finalArray['success'] = true;
} else {
    $finalArray['success'] = false;
}



die(json_encode($finalArray));
