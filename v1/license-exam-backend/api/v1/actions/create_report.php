<?php


require_once 'config.php';
require_once 'db/db.php';
require_once 'utils/tasks.php';
require_once 'utils/general.php';


$uid = $db->escape_string($_SESSION['id']);
$tid = $db->escape_string($_POST['task_id']);

$finalArray = array();


if (!isTaskAssignedToUser($uid, $tid)) {
    die('not assigned');
}

if (!isset($_POST['summary'], $_POST['comments'], $_POST['hours'], $_POST['date_time_start'])) {
    die('no data');
}


$summary = $db->escape_string($_POST['summary']);
$comments = $db->escape_string($_POST['comments']);
$hours = $db->escape_string($_POST['hours']);

$date_time_start = $db->escape_string($_POST['date_time_start']);


$date_time_date = strtotime($date_time_start);
$old_time_date = $date_time_date;

$old_day = date('d', strtotime($date_time_date));
$old_hour = date('H:i', strtotime($date_time_date));

if ($hours > 24)
    die('{"success":false,"error":"invalid hours TODO"}');


$hours = trim($hours, " ");

if (strpos($hours, ":")) {
    $t = explode(":", $hours);
    // t[0] - 3
    // t[1] - 30
    $h = trim($t[0], " ");
    $m = trim($t[1], " ");
} else {
    $h = $hours;
    $m = 0;
}

if (!is_numeric($h) || !is_numeric($m))
    die('{"success":false,"error":"invalid hours"}');



$date_time_date += $h * 3600 + $m * 60;



$new_day = date('d', strtotime($date_time_date));
$new_hour = date('H:i', strtotime($date_time_date));


if ($new_day != $old_day) {
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

$duration = $hours_diff . ":" . $minutes_diff;


$insert_report_sql = "INSERT INTO reports (tasks_id, summary, comments, hours, start, 
                        projects_id, start_date, start_hour, duration) VALUES 
        ('$tid', '$summary', '$comments', '$hours', CURDATE(), 
        '$projects_id', '$sqlDate', '$sqlTime','$duration');";

if (
    !$db->query($insert_report_sql)
) {
    die($db->error);
}



$finalArray['task_id'] = $tid;
$finalArray['summary'] = $summary;
$finalArray['comments'] = $comments;
$finalArray['hours'] = $hours;
$finalArray['sqlDate'] = $sqlDate;
$finalArray['sqlTime'] = $sqlTime;
$finalArray['duration'] = $duration;

$finalArray['success'] = true;



die(json_encode($finalArray));
















