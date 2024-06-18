<?php


require_once 'config.php';
require_once 'db/db.php';
require_once 'utils/tasks.php';
require_once 'utils/general.php';
require_once 'utils/security.php';


$email = $db->escape_string($_POST['email']);
$email = 'zoldcsirke0@gmail.com';
$email = trim($email);

$little_letters = 'abcdefghijklmnopqrstuvwxyz';
$big_letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

$password = '';

for ($i = 0; $i < 5; $i++) {
    $password .= $little_letters[rand(0, 25)];
    $password .= $big_letters[rand(0, 25)];
    $password .= rand(0, 9);
}


$array = array();

$get_user_sql = "SELECT name  FROM `users` WHERE `email` = '$email' and `active` = 1";
if ($rs = $db->query($get_user_sql)) {
    $data = $rs->fetch_assoc();
    $name = $data['name'];

    $hpassword = sha1($password);
    $set_password_sql = "UPDATE `users` SET `hpassword` = '$hpassword' WHERE `email` = '$email'";
    if ($db->query($set_password_sql)) {

        SendEmail("$email", "$name", 'New password', "<p> Your new password is: <br> <br> $password <br> <br> be very careful with it</p>");
        $array['success'] = true;
    } else {
        $array['success'] = false;
    }
} else {
    $array['success'] = false;
}

die(json_encode($array));








