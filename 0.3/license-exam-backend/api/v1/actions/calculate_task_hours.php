<?php

require_once 'config.php';
require_once 'db/db.php';
require_once 'utils/tasks.php';
require_once 'utils/general.php';
require_once 'utils/security.php';

requireLogin();

if (!isset($_POST['task_id']))
    die('no task id');

$tid = $db->escape_string($_POST['task_id']);
$totalMinutes = 0;

$get_tasks_sql = "SELECT r.duration from reports r where r.tasks_id = '$tid';";

if (!$result = $db->query($get_tasks_sql)) {
    die('could not get reports');
}

while ($row = $result->fetch_assoc()) {
    //echo 'duration: ' . $row['duration'] . "\n";
    $temp_hour = $row['duration'];

    // Split the duration into hours and minutes
    list($hours, $minutes) = explode(':', $temp_hour);

    // Convert hours to minutes and add to total
    $totalMinutes += ($hours * 60) + $minutes;
}

// Convert total minutes back to hours and minutes
$hours = floor($totalMinutes / 60);
$minutes = $totalMinutes % 60;

$array['hours'] = sprintf("%02d:%02d", $hours, $minutes);
$array['success'] = true;

die(json_encode($array));