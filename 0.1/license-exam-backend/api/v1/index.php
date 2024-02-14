<?php
session_start();


require_once 'config.php';
require_once 'db/db.php';
require_once 'utils/general.php';


if(!isset($_REQUEST['q']))
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
    'logout' => 'actions/logout.php',
    'profile' => 'actions/profile.php',
    'all_projects' => 'actions/all_projects.php',
    'individual_project' => 'actions/individual_project.php',
    'individual_task' => 'actions/individual_task.php',
    'all_users' => 'actions/all_users.php',
    'individual_user' => 'actions/individual_user.php',
    'individual_ticket' => 'actions/individual_ticket.php',
    'all_tickets' => 'actions/all_tickets.php',
    'dashboard' => 'actions/dashboard.php',
    'edit_task' => 'actions/edit_task.php',
    'create_task' => 'actions/create_task.php',
    'delete_task' => 'actions/delete_task.php',
    'show_reports' => 'actions/show_reports.php',
    'create_report' => 'actions/create_report.php',
    'edit_report' => 'actions/edit_report.php',
    'delete_report' => 'actions/delete_report.php',
    'create_project' => 'actions/create_project.php',
    'create_salt' => 'actions/create_salt.php',
);


foreach($routes as $key => $value) {
    if(str_starts_with($request, $key)) {
        $file = $value;
        require_once($file);
        die();
    }
}

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

?>