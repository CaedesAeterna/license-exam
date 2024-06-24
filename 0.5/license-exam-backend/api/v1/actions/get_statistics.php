<?php


require_once 'config.php';
require_once 'db/db.php';
require_once 'utils/tasks.php';
require_once 'utils/general.php';
require_once 'utils/security.php';

require_once 'get_hours.php';


requireLogin();


if (isset($_POST['project_id'], $_POST['type'])) {
    $project_id = $db->escape_string($_POST['project_id']);
    $type = $db->escape_string($_POST['type']);

} else {
    die('{"success":false,"message":"no project id or type"}');
}


/*
itt több opció kell legyen (annak függvényében számolod):
1, Projekt
2. Task
3. kiválasztott User


akár lehet 3 külön oldal is

Projekt vagy Projekt és idő intervallum
Task vagy task és időintervallum
Felhasználó vagy felhasználó és időintervallum

kétféle képpen számlázhatsz, vagy havonta, vagy azt mondod a kliensnek, hogy a projekt vagy task végén

*/

$array = array();

if ($type == 'workers') {

    if (!empty($_POST['start_date']) and !empty($_POST['end_date'])) {
        $start_date = $db->escape_string($_POST['start_date']);
        $end_date = $db->escape_string($_POST['end_date']);

        $array = getWorkerHours($worker_id, $start_date, $end_date);
    } else {
        $array = getWorkerHours($worker_id);
    }

    die($array);

    //-------------------------------------------------------------------------------------------------------------------------
} else if ($type == 'tasks') {

    if (!empty($_POST['start_date']) and !empty($_POST['end_date'])) {

        $start_date = $db->escape_string($_POST['start_date']);
        $end_date = $db->escape_string($_POST['end_date']);

        $array = getTaskHours($worker_id, $project_id, $start_date, $end_date);
    } else {
        $array = getTaskHours($worker_id, $project_id);
    }

    die($array);

} else {

    die('{"success":false,"message":"invalid type"}');

}





