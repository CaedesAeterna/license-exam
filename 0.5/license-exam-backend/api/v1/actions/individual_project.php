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


if (!isset($_POST['project_id'])) {
    die('project_id is not set');
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
    die(json_encode($success));
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
    die('{"success": false, "message": "Error executing query"}');
}



$finalArray = array(); // Holds the final array to be returned
$tasks = array(); // Holds the tasks for a project

/**
 * Loops through the results from the database and populates the tasks array
 * with the data. Each task is an associative array with the following keys:
 *  - id
 *  - title
 *  - description
 *  - start (date formatted)
 *  - finish (date formatted, or empty string if null)
 *  - other_info
 *  - projects_id
 *
 * @throws None
 * @return None
 */
while ($row = $rs->fetch_assoc()) {

    // Temporary array to hold task data
    $res = array();

    // Populate the temporary array with data
    $res['id'] = $row['id'];
    $res['title'] = $row['title'];
    $res['description'] = $row['description'];

    // Format the start date
    $res['start'] = dateFormat($row['start']);

    // Format the finish date, or set it to an empty string if null
    if ($res['finish'] != '') {
        $res['finish'] = dateFormat($row['finish']);
    } else {
        $res['finish'] = '';
    }

    $res['other_info'] = $row['other_info'];
    $res['projects_id'] = $row['projects_id'];

    // Add the temporary array to the tasks array
    $tasks[] = $res;

    // Add the tasks array to the final array
    $finalArray['tasks'] = $tasks;
}

/**
 * Checks if the final array is empty. If so, it sets the success key to false.
 *
 * @throws None
 * @return None
 */
if (empty($finalArray)) {
    $finalArray['succes'] = false;
}


//calculate remaining days in project until due date starting now
// Create DateTime objects for now and the target date
$now = new DateTime(); // Today's date
$target_date = new DateTime($due_date);

// Calculate the difference
$diff = $now->diff($target_date);

// Get the number of days remaining
$days_remaining = $diff->days;

if ($due_date < date('Y-m-d')) {
    $finalArray['due_date'] = dateFormat($due_date);
    $finalArray['days_remaining'] = -$days_remaining;
}else{
    $finalArray['due_date'] = dateFormat($due_date);
    $finalArray['days_remaining'] = $days_remaining;
    
}

$finalArray['succes'] = true;
$finalArray['project_name'] = $project_name;

die(json_encode($finalArray));