<?php


require_once 'config.php';
require_once 'db/db.php';
require_once 'utils/tasks.php';
require_once 'utils/general.php';
require_once 'utils/security.php';



requireLogin();

/*
function myErrorHandler($errno, $errstr, $errfile, $errline)
{
    echo "<b>Error:</b> [$errno] $errstr<br />";
}

set_error_handler('myErrorHandler');
*/


// Check if 'task_id' is set in the POST request
if (!isset($_POST['task_id'])) {
    die('no task id');
}

$uid = $db->escape_string($_SESSION['id']); // Escape and assign the value of $_SESSION['id'] to $uid
$tid = $db->escape_string($_POST['task_id']); // Escape and assign the value of $_POST['task_id'] to $tid
$rid = $db->escape_string($_POST['reports_id']); // Escape and assign the value of $_POST['reports_id'] to $rid

$finalArray = array(); // Create an empty array to store the final result

// Check if the task is assigned to the user
if (!isTaskAssignedToUser($uid, $tid)) {
    die('not assigned'); // If not assigned, terminate and display an error message
}

// Check if the required data is set in the POST request
if (!isset($_POST['summary'], $_POST['comments'], $_POST['hours'], $_POST['startDateTime'])) {
    die('no data'); // If any of the required data is missing, terminate and display an error message
}

// Escape special characters in the summary field
$summary = $db->escape_string($_POST['summary']);

// Escape special characters in the comments field
$comments = $db->escape_string($_POST['comments']);

// Escape special characters in the hours field
$hours = $db->escape_string($_POST['hours']);

// Escape special characters in the startDateTime field
$date_time_start = $db->escape_string($_POST['startDateTime']);

echo 'date_time_start 1: ' . $date_time_start . "\n";


// Convert the startDateTime to a Unix timestamp
$date_time_date = strtotime($date_time_start);

// Store the original Unix timestamp
$old_time_date = $date_time_date;

// Extract the day from the Unix timestamp
$old_day = date('d', strtotime($date_time_date));

// Extract the hour and minute from the Unix timestamp
$old_hour = date('H:i', strtotime($date_time_date));

// Check if the hours value is greater than 24
if ($hours > 24) {
    // If so, return an error message
    die('{"success":false,"error":"invalid hours TODO"}');
}

// Remove leading and trailing spaces from the hours value
$hours = trim($hours, " ");

// Check if the $hours string contains a colon
if (strpos($hours, ":")) {
    // Split the $hours string by colon
    $t = explode(":", $hours);

    // Assign the first part of the split string to $h variable
    $h = trim($t[0], " ");

    // Assign the second part of the split string to $m variable
    $m = trim($t[1], " ");
} else {
    // If $hours does not contain a colon, assign the whole string to $h variable
    $h = $hours;

    // Assign 0 to $m variable
    $m = 0;
}

//todo: old day and new day not matching


// Check if $h and $m are not numeric
if (!is_numeric($h) || !is_numeric($m)) {
    // If they are not numeric, return an error message
    die('{"success":false,"error":"invalid hours TODO"}');
}

$date_time_date += $h * 3600 + $m * 60;



// Extract the day from the given date and time
$new_day = date('d', strtotime($date_time_date));

// Extract the hour and minute from the given date and time
$new_hour = date('H:i', strtotime($date_time_date));

// var_dump($old_day);
// var_dump($new_day);

// Check if the new day is different from the old day
if ($new_day != $old_day) {
    die('{"success":false,"error":"overlapping dates TODO"}');
}

// Get the projects_id from the POST data and sanitize it
$projects_id = $db->escape_string($_POST['projects_id']);

// Convert the $date_time_date to SQL date format
$sqlDate = date('Y-m-d', $date_time_date);

// Convert the $date_time_date to SQL time format
$sqlTime = date('H:i:s', $date_time_date);

$oldDateTime = new DateTime(); // Create a new DateTime object for the old time
$oldDateTime->setTimestamp($old_time_date); // Set the timestamp of the old DateTime object to the provided old time

$newDateTime = new DateTime(); // Create a new DateTime object for the new time
$newDateTime->setTimestamp($date_time_date); // Set the timestamp of the new DateTime object to the provided new time

$interval = $oldDateTime->diff($newDateTime); // Calculate the interval between the old and new DateTime objects

$hours_diff = $interval->format('%h'); // Get the hours difference from the interval
$minutes_diff = $interval->format('%i'); // Get the minutes difference from the interval

$duration = $hours_diff . ":" . $minutes_diff; // Combine the hours and minutes difference into a duration string


// Update the reports table with the provided information
$update_report_sql = "UPDATE reports 
                        SET summary = '$summary', comments = '$comments', hours = '$hours' , 
                        start_date = '$old_time_date', duration = '$duration'
                        WHERE id = '$rid';";
$finalArray = array();

//echo $update_report_sql;

$finalArray['task_id'] = $tid;
$finalArray['summary'] = $summary;
$finalArray['comments'] = $comments;
$finalArray['hours'] = $hours;
$finalArray['sqlDate'] = $sqlDate;
$finalArray['sqlTime'] = $sqlTime;
$finalArray['duration'] = $duration;


if ($db->query($update_report_sql)) {
    $finalArray['success'] = true;
} else {
    $finalArray['success'] = false;
}



die(json_encode($finalArray));
