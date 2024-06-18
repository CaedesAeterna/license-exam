<?php



require_once 'config.php';
require_once 'db/db.php';
require_once 'utils/tasks.php';
require_once 'utils/general.php';
require_once 'utils/security.php';


requireLogin();

if (!checkAdminLogin() and !checkManagerLogin()) {
    die('{"success": false, "message": "Not allowed"}');
}


$email = $db->escape_string($_POST['email']);
$hpassword = $db->escape_string($_POST['password']);
$name = $db->escape_string($_POST['name']);
$position = $db->escape_string($_POST['position']);


//echo ($email . ' ' . $hpassword . ' ' . $name . ' ' . $position);



switch ($position) {
    case 'Admin':
        $position = 10;
        break;
    case 'Manager':
        $position = 20;
        break;
    case 'Client':
        $position = 40;
        break;
    default:
        $position = 30;
}

$insert_new_user_sql = "INSERT INTO `users` (`email`, `hpassword`, `name`, `position`, `active`) 
                        VALUES ('$email', '$hpassword', '$name', '$position', 1)";

//echo ($insert_new_user_sql);


if ($db->query($insert_new_user_sql)) {
    $success = true;
} else {
    $success = false;
}

die(json_encode($success));