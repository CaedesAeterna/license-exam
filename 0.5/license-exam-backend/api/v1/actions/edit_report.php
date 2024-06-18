<?php

require_once 'config.php';
require_once 'db/db.php';
require_once 'utils/tasks.php';
require_once 'utils/general.php';
require_once 'utils/security.php';

requireLogin();

// Check if 'task_id' is set in the POST request
if (!isset($_POST['task_id'])) {
    die('no task id');
}

// Escape and assign the values
$uid = $db->escape_string($_SESSION['id']);
$tid = $db->escape_string($_POST['task_id']);
$rid = $db->escape_string($_POST['reports_id']);

// Check if the task is assigned to the user
if (!isTaskAssignedToUser($uid, $tid)) {
    die('not assigned');
}

// Check if the required data is set in the POST request
if (!isset($_POST['summary'], $_POST['comments'], $_POST['hours'], $_POST['startDateTime'])) {
    die('no data');
}

// Escape special characters
$summary = $db->escape_string($_POST['summary']);
$comments = $db->escape_string($_POST['comments']);
$hours = $db->escape_string($_POST['hours']);
$date_time_start = $db->escape_string($_POST['startDateTime']);

// Convert the startDateTime to a Unix timestamp
$date_time_start_unix = strtotime($date_time_start);

// Handle hours and minutes from input
if (strpos($hours, ":") !== false) {
    list($h, $m) = explode(":", $hours);
    $h = trim($h);
    $m = trim($m);
} else {
    $h = trim($hours);
    $m = 0;
}

// Ensure hours and minutes are numeric
if (!is_numeric($h) || !is_numeric($m)) {
    die('{"success":false,"error":"invalid hours"}');
}

// Calculate the new end time
$new_end_time_unix = $date_time_start_unix + ($h * 3600) + ($m * 60);

// Check if the duration exceeds the start day
if (date('Y-m-d', $new_end_time_unix) != date('Y-m-d', $date_time_start_unix)) {
    die('{"success":false,"error":"Duration exceeds the allowed 24-hour cycle"}');
}

//the new duration calculation starts here --

$hoursPart = intval($hours);
$minutesPart = intval(($hours - $hoursPart) * 60);

// Format the duration as HH:MM:SS
$duration = sprintf("%02d:%02d:00", $hoursPart, $minutesPart);


//the new duration calculation ends here --



// Calculate the duration in the format H:i
//$duration = sprintf('%02d:%02d', (int) ($h), (int) ($m));



// Prepare the SQL update statement
$update_report_sql = "UPDATE reports 
                      SET summary = '$summary', 
                          comments = '$comments', 
                          hours = '$hours', 
                          start_date = '" . date('Y-m-d', $date_time_start_unix) . "',
                          start_hour = '" . date('H:i:s', $date_time_start_unix) . "', 
                          duration = '$duration',
                          user_id = '" . $_SESSION['id'] . "'
                      WHERE id = '$rid'";

// Execute the SQL update
if ($db->query($update_report_sql)) {
    // Prepare the array with the response data
    $finalArray = [
        'success' => true,
        'task_id' => $tid,
        'summary' => $summary,
        'comments' => $comments,
        'hours' => $hours,
        'sqlDate' => date('Y-m-d', $date_time_start_unix),
        'sqlTime' => date('H:i:s', $date_time_start_unix),
        'duration' => $duration,
    ];
} else {
    // Prepare the array with the error response
    $finalArray = [
        'success' => false,
        'error' => $db->error
    ];
}

// Output the final JSON result
die(json_encode($finalArray));
