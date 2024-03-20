<?php


/*

{
    "succes":true,
    "id":  ... ,
    "description": ... ,
    "projects_id": ...

}

*/

require_once 'config.php';
require_once 'db/db.php';
require_once 'utils/security.php';


$ticket_id = $db->escape_string($_POST['ticket_id']);


requireLogin();


$uid = $_SESSION['id'];

$sql = "SELECT tickets.id, tickets.name, tickets.description, tickets.projects_id, tickets.active 
FROM tickets 
WHERE tickets.id= ' $ticket_id' ;";

$rs = $db->query($sql);

if ($rs->num_rows === 0) {
    die('no tickests found');
}

$row = $rs->fetch_assoc();

$res = array();

$res['succes'] = true;
$res['id'] = $row['id'];
$res['name'] = $row['name'];
$res['description'] = $row['description'];
$res['active'] = $row['active'];
$res['project_id'] = $row['projects_id'];


die(json_encode($res));

