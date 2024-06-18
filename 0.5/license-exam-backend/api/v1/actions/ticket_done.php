<?php


require_once 'config.php';
require_once 'db/db.php';
require_once 'utils/tasks.php';
require_once 'utils/general.php';
require_once 'utils/security.php';


requireLogin();

$ticket_id = $db->escape_string($_POST['ticket_id']);


if (!is_numeric($ticket_id)) {
    die('invalid ticket id');
}

if (!is_numeric($_SESSION["id"])) {
    die('invalid user id');
}

$sql = "UPDATE tickets SET active = 0 WHERE id = '" . $ticket_id . "' and users_id = '" . $_SESSION["id"] . "'";

//echo $sql;

if ($db->query($sql)) {
    $success = true;
    die(json_encode($success));

} else {
    $success = false;
    die(json_encode($success));
}
