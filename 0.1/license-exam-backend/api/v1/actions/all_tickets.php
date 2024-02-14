<?php


/*

{
    "succes":true,
    "tickets":[
        {
            "id":  ... ,
            "description": ... ,
        
        },
        {
            "id":  ... ,
            "description": ... ,
        
        }


    ]


    

}

*/


$_SESSION['id'] = 2;

$uid = $_SESSION['id'];

$sql = "SELECT * FROM tickets  ;";
$rs = $db->query($sql);
if ($rs->num_rows === 0) {
    die('no tickests found');
}


$finalArray = array();

$finalArray['succes'] = true;

while ($row = $rs->fetch_assoc()) {

    $res = array();

    $res['ticketId'] = $row['id'];
    $res['projectDescription'] = $row['description'];
    $res['prticketStatus'] = $row['active'];
  

    $finalArray[] = $res;

}

die(json_encode($finalArray));
