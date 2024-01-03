<?php
/**
 * This script retrieves user information from the database and returns it as a JSON response.
 * If the user is not found, it redirects to the login page.
 */
require_once 'utils/security.php';



requireLogin();

$uid = $_SESSION['id'];

// Query the database for user information
$sql = "SELECT * FROM `users` WHERE `id`='$uid';";

$rs = $db->query($sql);
if ($rs->num_rows === 0) {
    redirectToLogin();
}

$finalArray = array();

$row = $rs->fetch_assoc();

$res = array();

$res['succes'] = true;
$res['name'] = $row['name'];
$res['img'] = $row['img'];

switch ($row['position']) {
    case 10:
        $res['position'] = 'Admin';
        break;
    case 20:
        $res['position'] = 'User';
        break;
    case 30:
        $res['position'] = 'Manager';
        break;
    case 40:
        $res['position'] = 'Client';
}



// Return the user information as a JSON response
die(json_encode($res));

?>