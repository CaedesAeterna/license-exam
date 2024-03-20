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

    $uid = $_SESSION['id'];




    if ($profilePicLink && $name) {
        $sql = "UPDATE `users` SET `img` = '$profilePicLink', `name` = '$name' WHERE `id` = '$uid';";
    } else if ($name) {
        $sql = "UPDATE `users` SET `name` = '$name' WHERE `id` = '$uid';";
    } else if ($profilePicLink) {
        $sql = "UPDATE `users` SET `img` = '$profilePicLink' WHERE `id` = '$uid';";
    } else {

        $success = false;
        die(json_encode($success));
    }


    if ($db->query($sql)) {
        $success = true;


        die(json_encode($success));


    } else {
        $success = false;
        die(json_encode($success));

    }
}