<?php


require_once 'config.php';
require_once 'db/db.php';
require_once 'utils/tasks.php';
require_once 'utils/general.php';
require_once 'utils/security.php';

requireLogin();

function getWorkerHours($worker_id, $start_date = '', $end_date = '')
{
    global $db;

    $names = array();
    $hours = array();
    $total_seconds = 0; // Use total seconds for accurate calculation

    if (!empty($start_date) and !empty($end_date)) {
        $start_date = $db->escape_string($_POST['start_date']);
        $end_date = $db->escape_string($_POST['end_date']);

        $query = "SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(r.duration))) AS total_time, user_id 
              FROM reports r 
              WHERE r.start BETWEEN '$start_date' AND '$end_date'
              GROUP BY user_id";
    } else {
        $query = "SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(r.duration))) AS total_time, user_id 
              FROM reports r 
              GROUP BY user_id";
    }

    if ($result = $db->query($query)) {
        while ($row = $result->fetch_assoc()) {
            $get_user_name = "SELECT name FROM users WHERE id = '{$row['user_id']}'";

            if ($user_name_result = $db->query($get_user_name)) {
                $names[] = $user_name_result->fetch_row()[0];
            } else {
                $names[] = 'Unknown';
            }

            $hours[] = $row['total_time'];

            // Calculate total seconds directly from TIME_TO_SEC
            $duration_seconds = $db->query("SELECT TIME_TO_SEC('{$row['total_time']}') AS seconds")->fetch_object()->seconds;
            $total_seconds += $duration_seconds;
        }
    }

    // Calculate total hours, minutes, and seconds from total seconds
    $total_hours = floor($total_seconds / 3600);
    $total_minutes = floor(($total_seconds % 3600) / 60);
    $total_seconds %= 60; // Remaining seconds

    $true_total_hours = sprintf("%02d:%02d:%02d", $total_hours, $total_minutes, $total_seconds);

    // Append 'Total Hours' and the calculated total duration to the arrays
    $names[] = 'Total Hours';
    $hours[] = $true_total_hours;

    $array = [
        'total_hours' => $true_total_hours,
        'data' => array_combine($names, $hours),
        'success' => true
    ];

    return json_encode($array);
}


function getTaskHours($worker_id, $project_id, $start_date = '', $end_date = '')
{
    global $db;

    $names = array();
    $hours = array();

    $total_hours = 0;


    $sql_tasks = "select t.id, t.title from tasks t where t.projects_id = '$project_id';";


    if ($tasks = $db->query($sql_tasks)) {

        $tasks_array = $tasks->fetch_all(MYSQLI_ASSOC);

        //echo ($tasks_array);
        //var_dump($tasks_array);

        foreach ($tasks_array as $task) {

            $names[] = $task['title'];

            $tid = $task['id'];
            $totalMinutes = 0;


            //$get_tasks_sql = "SELECT r.duration from reports r where r.tasks_id = '$tid' 
            //and r.start between '$start_date' and '$end_date';";

            if (!empty($start_date) and !empty($end_date)) {

                $start_date = $db->escape_string($_GET['start_date']);
                $end_date = $db->escape_string($_GET['end_date']);

                $get_reports_sql = "SELECT r.duration 
                                    from reports r 
                                    where r.tasks_id = '$tid'
                                    and r.start 
                                        between '$start_date' and '$end_date' ;";

            } else {

                $get_reports_sql = "SELECT r.duration 
                                    from reports r 
                                    where r.tasks_id = '$tid';";

            }

            //echo $get_tasks_sql;

            if (!$result = $db->query($get_reports_sql)) {
                die('could not get reports');
            }

            while ($row = $result->fetch_assoc()) {
                //echo 'duration: ' . $row['duration'] . "\n";
                $temp_hour = $row['duration'];

                // Split the duration into hours and minutes
                list($hours_var, $minutes_var) = explode(':', $temp_hour);

                // Convert hours to minutes and add to total
                $totalMinutes += ($hours_var * 60) + $minutes_var;

                $total_hours = $total_hours + ($hours_var * 60) + $minutes_var;

            }

            // Convert total minutes back to hours and minutes
            $hours_var = floor($totalMinutes / 60);
            $minutes_var = $totalMinutes % 60;

            $hours[] = sprintf("%02d:%02d:00", $hours_var, $minutes_var);

            //echo "ID: " . $task['id'] . ", Title: " . $task['title'] . "<br>";
        }

    }

    $names[] = 'Total Hours';

    $total_minutes = $total_hours % 60;
    $total_hours = $total_hours / 60;


    $true_total_hours = sprintf("%02d:%02d:00", $total_hours, $total_minutes);
    $hours[] = $true_total_hours;

    $array['total_hours'] = $true_total_hours;

    $array['data'] = array_combine($names, $hours);


    $array['success'] = true;

    return json_encode($array);


}