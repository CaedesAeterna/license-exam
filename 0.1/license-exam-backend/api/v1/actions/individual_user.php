<?php

/*

{
    "succes":true,
    "id":  ... ,
    "name": ... ,
    "position": ...,
    "active": ...

}

*/


$_SESSION['id'] = 4;

$uid = $_SESSION['id'];

$sql = "SELECT * FROM users WHERE users.id='$uid';";


$rs = $db->query($sql);

if ($rs->num_rows === 0) {
    die('no user found');
}



$row = $rs->fetch_assoc();

$res = array();

$res['succes'] = true;
$res['id'] = $row['id'];
$res['name'] = $row['name'];
$res['email'] = $row['email'];
$res['position'] = $row['position'];
$res['active'] = $row['active'];


die(json_encode($res));

