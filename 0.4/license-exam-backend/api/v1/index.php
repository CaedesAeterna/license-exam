<?php
session_start();

define('API_DIR', dirname(__FILE__) . '/');


require_once 'config.php';
require_once 'db/db.php';
require_once 'utils/general.php';


if (!isset($_REQUEST['q']))
    die;

$request = $_REQUEST['q'];

$request = rtrim($request, '/');

/*$splitedpath = explode('/', $request);

$action = $splitedpath[0];
*/

/* 

profile, 
login, 
all project
indivdual project = all task
individual task 
logout
individual ticket
all tickets
dashboard
edit task
create task

*/

$routes = array(

    'login' => 'actions/login.php',
    'create_salt' => 'actions/create_salt.php',
    'logout' => 'actions/logout.php',

    'check_session' => 'actions/check_session.php',

    'profile' => 'actions/profile.php',
    'edit_profile' => 'actions/edit_profile.php',

    'all_projects' => 'actions/all_projects.php',
    'individual_task' => 'actions/individual_task.php',
    'all_users' => 'actions/all_users.php',
    'individual_ticket' => 'actions/individual_ticket.php',
    'all_tickets' => 'actions/all_tickets.php',
    'dashboard' => 'actions/dashboard.php',

    'get_user_name' => 'actions/get_user_name.php',
    'get_project_name' => 'actions/get_project_name.php',

    'archive_project' => 'actions/archive_project.php',
    'individual_project' => 'actions/individual_project.php',
    'create_project' => 'actions/create_project.php',
    'edit_project' => 'actions/edit_project.php',

    'check_free_task' => 'actions/check_free_task.php',
    'create_task' => 'actions/create_task.php',
    'archive_task' => 'actions/archive_task.php',
    'edit_task' => 'actions/edit_task.php',
    'task_done' => 'actions/task_done.php',

    'create_report' => 'actions/create_report.php',
    'edit_report' => 'actions/edit_report.php',
    'delete_report' => 'actions/delete_report.php',

    'show_reports' => 'actions/show_reports.php',
    'calculate_project_hours' => 'actions/calculate_project_hours.php',
    'calculate_task_hours' => 'actions/calculate_task_hours.php',

    'get_users_for_project' => 'actions/get_users_for_project.php',
    'get_users_for_task' => 'actions/get_users_for_task.php',
    'get_users_for_addition' => 'actions/get_users_for_addition.php',
    'get_position' => 'actions/get_position.php',
    'get_statistics' => 'actions/get_statistics.php',


    'add_user_to_project' => 'actions/add_user_to_project.php',
    'add_user_to_task' => 'actions/add_user_to_task.php',

    'remove_user_from_project' => 'actions/remove_user_from_project.php',
    'remove_user_from_task' => 'actions/remove_user_from_task.php',

    'individual_user' => 'actions/individual_user.php',
    'all_user' => 'actions/all_user.php',
    'add_new_user' => 'actions/add_new_user.php',

    'get_tickets' => 'actions/get_tickets.php',
    'create_ticket' => 'actions/create_ticket.php',
    'ticket_done' => 'actions/ticket_done.php',
    'work_on_ticket' => 'actions/work_on_ticket.php',

    'generate_pdf' => 'actions/generate_pdf.php',

    'edit_option' => 'actions/edit_option.php',
    
    'get_option' => 'actions/get_option.php',
);


// 8.2 php routes


foreach ($routes as $key => $value) {
    if (str_starts_with($request, $key)) {
        $file = $value;
        require_once($file);
        die();
    }
}

/*

live 7.4 php routes

foreach ($routes as $key => $value) {
    // Use substr to get the start of $request and compare it with $key
    if (substr($request, 0, strlen($key)) === $key) {
        $file = $value;
        require_once($file);
        die();
    }
}

*/








// for ($i = 0; $i < count($routes); $i++) {
//     if (str_starts_with($request, $routes[$i])) {
//         $file = $routes[$i];
//         require_once($file);
//         die();
//     }
// }

// switch (true) {

//     case str_starts_with($request, 'profile'):
//         require_once('actions/profile.php');
//         break;      

//     case str_starts_with($request, 'student/courses'):
//         break;

//     case str_starts_with($request, 'teacher/courses'):
//         break;

//     default:
//         StopWith404();

// }

/*

switch ($action) {
    case 'profile':
        require_once 'actions/profile.php'; 
        break;
    case 'student':
        case 'modules':
            require_once 'actions/modules.php'; 
            break;
        case 'courses';
            require_once 'actions/courses.php';
    default:
        echo'Baj van';
        break;
} */

// var_dump($action);

// echo '<pre>'.print_r($splitedpath, true).'</pre>'
