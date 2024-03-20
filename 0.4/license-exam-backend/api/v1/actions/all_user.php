<?php


require_once 'config.php';
require_once 'db/db.php';
require_once 'utils/tasks.php';
require_once 'utils/general.php';
require_once 'utils/security.php';


requireLogin();


$sql = "SELECT u.id, u.name, u.email, u.position FROM users u WHERE u.active = 1;";

if ($rs = $db->query($sql)) {

    $array['users'] = $rs->fetch_all(MYSQLI_ASSOC);

    $array['succes'] = true;

    die(json_encode($array));
} else {
    $array['succes'] = false;

    die(json_encode($array));
}