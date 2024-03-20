<?php

require_once 'config.php';
require_once 'db/db.php';
require_once 'utils/tasks.php';
require_once 'utils/general.php';
require_once 'utils/security.php';


requireLogin();



if (isset($_POST['date_format'])) {

    $date_format = $db->escape_string($_POST['date_format']);
    $uid = $_SESSION['id'];
    $sql = "UPDATE `users` SET `date_format` = '$date_format' WHERE `id` = '$uid';";

    if ($db->query($sql)) {
        $array = array();
        $array['success'] = true;
        $array['message'] = 'Date format changed';

        die(json_encode($array));
    } else {
        $array = array();
        $array['success'] = true;
        $array['message'] = 'Error changing date format';

        die(json_encode($array));
    }
}