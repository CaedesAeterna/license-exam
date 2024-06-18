<?php


require_once 'config.php';
require_once 'db/db.php';
require_once 'utils/tasks.php';
require_once 'utils/general.php';
require_once 'utils/security.php';


requireLogin();

if (!isset ($_POST['project_id'])) {
    die ('{"success":false}');
}

$project_id = $db->escape_string($_POST['project_id']);


if (isset ($_POST['project_name'])) {
    $project_name = $db->escape_string($_POST['project_name']);

}
if (isset ($_POST['project_description'])) {
    $project_description = $db->escape_string($_POST['project_description']);

}
if (isset ($_POST['due_date'])) {
    $due_date = $db->escape_string($_POST['due_date']);
}

$sql = "UPDATE projects SET ";
// Prepare an update statement
$updates = [];

if (!empty ($project_name)) {
    $updates[] = "name = '$project_name'";
}

if (!empty ($project_description)) {
    $updates[] = "description = '$project_description'";
}

if (!empty ($due_date)) {
    $updates[] = "due_date = '$due_date'";
}

// Join all updates with a comma and add to the main SQL statement
$sql .= implode(', ', $updates);

$sql .= " WHERE id = '$project_id'";

//echo $sql;

if (!$db->query($sql)) {
    die ('{"success":false}');
}

die ('{"success":true}');



