<?php


/*

{
    "succes":true,
    "id":  ... ,
    "description": ... ,
    "projects_id": ...

}

*/



$uid = $_SESSION['id'];

$sql = "SELECT tickets.id, tickets.name, tickets.description, tickets.projects_id, tickets.active FROM tickets WHERE tickets.id= ' $uid' ;";
$rs = $db->query($sql);
if($rs->num_rows === 0) {
    die('no tickests found');
}

$row = $rs->fetch_assoc();

$res = array();

$res['succes'] = true;
$res['id'] = $row['id'];
$res['name'] = $row['name'];
$res['description'] = $row['description'];
$res['active'] = $row['active'];


die(json_encode($res));

