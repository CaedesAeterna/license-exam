<?php


require_once 'config.php';
require_once 'db/db.php';
require_once 'utils/tasks.php';
require_once 'utils/general.php';
require_once 'utils/security.php';




if (isset($_SESSION['id'])) {

    $success = true;


    die(json_encode($success));

} else {

    $success = false;

    die(json_encode($success));

}