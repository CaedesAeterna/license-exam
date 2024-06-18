<?php

require_once 'config.php';
require_once 'db/db.php';
require_once 'utils/tasks.php';
require_once 'utils/general.php';
require_once 'utils/security.php';


requireLogin();


if (!checkAdminLogin()) {
    die ('{"success": false, "message": "Not allowed"}');
}

if (isset ($_POST['key'], $_POST['value'])) {

    $array = array();

    $key = $db->escape_string($_POST['key']);
    $value = $db->escape_string($_POST['value']);

    $uid = $_SESSION['id'];

    $bool = setOption($key, $value);

    if ($bool) {

        $array['success'] = true;
        $array['message'] = "Configuration changed";

        $_SESSION["$key"] = $value;

    } else {
        $array['success'] = false;
        $array['message'] = "Failed to update configuration";

    }

    die (json_encode($array));


}