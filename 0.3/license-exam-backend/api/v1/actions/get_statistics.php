<?php


require_once 'config.php';
require_once 'db/db.php';
require_once 'utils/tasks.php';
require_once 'utils/general.php';
require_once 'utils/security.php';


if (!isset($_SESSION['id'])) {
    die();
}


$project_id = $db->escape_string($_POST['project_id']);
$type = $db->escape_string($_POST['type']);



$array = array();


if ($type == 'workers') {

    //todo

    $names = array();
    $hours = array();
    $names = ['worker1', 'worker2', 'worker3', 'worker4', 'worker5', 'worker6'];
    $hours = [10, 20, 30, 40, 50, 60];

    $array['data'] = array_combine($names, $hours);

    $array['success'] = true;

    die(json_encode($array));

} else if ($type == 'tasks') {

    //todo

    $names = array();
    $hours = array();


    $names = ['task1', 'task2', 'task3', 'task4', 'task5'];
    $hours = [10, 20, 30, 40, 50];

    $array['data'] = array_combine($names, $hours);



    $array['success'] = true;

    die(json_encode($array));

} else {

    die('{"success":false,"error":"invalid type"}');

}





