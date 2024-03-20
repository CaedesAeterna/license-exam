<?php

require_once 'config.php';
require_once 'db/db.php';
require_once 'utils/tasks.php';
require_once 'utils/general.php';
require_once 'utils/security.php';



requireLogin();



if (!isset($_POST['project_id'])) {
    die('{"success":false}');
}

$project_id = $db->escape_string($_POST['project_id']);

$sql = "update projects set active = 0, finish = now() where id='$project_id'";
if ($db->query($sql)) {
    die('{"success":true}');
} else {
    die('{"success":false}');
}


