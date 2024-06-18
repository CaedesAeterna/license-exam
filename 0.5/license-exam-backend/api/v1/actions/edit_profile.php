<?php

require_once 'config.php';
require_once 'db/db.php';
require_once 'utils/tasks.php';
require_once 'utils/general.php';
require_once 'utils/security.php';


requireLogin();


if (isset($_POST['name'])) {

    $name = $db->escape_string($_POST['name']);

    if ($name == 'Total Hours') { {
            $success = false;
            die(json_encode($success));
        }
    }
    if (isset($_POST['profilePicLink'])) {
        $profilePicLink = $db->escape_string($_POST['profilePicLink']);
    }
    if (isset($_POST['new_email'])) {
        $new_email = $db->escape_string($_POST['new_email']);
    }
    if (isset($_POST['new_password'])) {
        $new_password = $db->escape_string($_POST['new_password']);
    }

    $uid = $_SESSION['id'];

    $updates = [];

    $sql = 'UPDATE `users` SET ';

    if (!empty($name)) {
        $updates[] = "name = '$name'";
    }
    if (!empty($profilePicLink)) {
        $updates[] = "img = '$profilePicLink'";
    }
    if (!empty($new_email)) {
        $updates[] = "email = '$new_email'";
    }
    if (!empty($new_password)) {
        $updates[] = "hpassword = '$new_password'";
    }

    $sql .= implode(', ', $updates);
    $sql .= " WHERE id = '$uid'";

    //echo $sql;

    if ($db->query($sql)) {
        $success = true;
        die(json_encode($success));

    } else {
        $success = false;
        die(json_encode($success));

    }
}