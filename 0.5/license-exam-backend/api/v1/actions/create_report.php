<?php

require_once 'config.php';
require_once 'db/db.php';
require_once 'utils/tasks.php';
require_once 'utils/general.php';
require_once 'utils/security.php';

requireLogin();

$uid = $db->escape_string($_SESSION['id']);
$tid = $db->escape_string($_POST['task_id']);
$pid = $db->escape_string($_POST['projects_id']);


$finalArray = array();

if (!isTaskAssignedToUser($uid, $tid)) {
    die('not assigned');
}

if (!isset($_POST['summary'], $_POST['comments'], $_POST['hours'], $_POST['date_time_start'])) {
    die('{"success":false,"message":"Missing data"}');
}

$summary = $db->escape_string($_POST['summary']);
$comments = $db->escape_string($_POST['comments']);
$hours = $db->escape_string($_POST['hours']);
$date_time_start = $db->escape_string($_POST['date_time_start']);

if ($summary == 'Total Hours') {
    die('{"success":false,"message":"Invalid summary you cannot give total hours as summary"}');
}

// Parse the date and time from the input
$date_time_start_unix = strtotime($date_time_start);
if ($date_time_start_unix === false) {
    die('{"success":false,"message":"Invalid date format"}');
}

// Parse the hours and minutes from the input
list($h, $m) = array_map('trim', explode(':', $hours . ":0"));
if (!is_numeric($h) || !is_numeric($m) || $h < 0 || $m < 0 || $h >= 24 || ($h == 23 && $m > 0)) {
    die('{"success":false,"message":"Invalid hours"}');
}

// Add hours and minutes to the start time
$new_end_time_unix = $date_time_start_unix + $h * 3600 + $m * 60;

// Check if the new end time exceeds the 24-hour period from the start time
if (date('Y-m-d', $new_end_time_unix) != date('Y-m-d', $date_time_start_unix)) {
    die('{"success":false,"message":"Duration exceeds the allowed 24-hour cycle"}');
}

//the new duration calculation starts here --
$hoursPart = intval($hours);
$minutesPart = intval(($hours - $hoursPart) * 60);

// Format the duration as HH:MM:SS
$duration = sprintf("%02d:%02d:00", $hoursPart, $minutesPart);

//the new duration calculation ends here --

// Prepare the SQL date and time for insertion
$sqlDate = date('Y-m-d', $date_time_start_unix);
$sqlTime = date('H:i:s', $date_time_start_unix);

//$duration = sprintf("%02d:%02d", $h, $m);

$worker_id = $_SESSION["id"];

// Prepare the SQL insertion statement
$insert_report_sql = "INSERT INTO reports (user_id ,tasks_id, summary, comments, hours, start, 
                        projects_id, start_date, start_hour, duration) VALUES 
        ('$worker_id','$tid', '$summary', '$comments', '$hours', '$sqlDate',
        '$pid', '$sqlDate', '$sqlTime','$duration');";

// Execute the SQL insertion
if (!$db->query($insert_report_sql)) {
    die($db->error);
}


// Prepare the response data
$finalArray['task_id'] = $tid;
$finalArray['summary'] = $summary;
$finalArray['comments'] = $comments;
$finalArray['hours'] = $hours;
$finalArray['sqlDate'] = $sqlDate;
$finalArray['sqlTime'] = $sqlTime;
$finalArray['duration'] = $duration;
$finalArray['success'] = true;

// Output the final JSON result
die(json_encode($finalArray));

