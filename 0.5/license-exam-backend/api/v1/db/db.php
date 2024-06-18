<?php


$db = new mysqli($db_host, $db_user, $db_password, $db_name);

if ($db->connect_errno) {
    echo 'Error connecting to';
    die();
}

