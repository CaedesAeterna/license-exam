<?php


require_once 'config.php';
require_once 'db/db.php';

function isTaskAssignedToUser($uid, $tid)
{
    global $db;
    $sql = "SELECT * FROM works_on_task WHERE users_id = '$uid' AND tasks_id = '$tid';";

    $rs = $db->query($sql);

    if ($rs->num_rows === 0) {
        return false;
    }

    return true;



}





?>