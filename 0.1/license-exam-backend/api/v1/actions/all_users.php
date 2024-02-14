<?php


/*

{
    "succes":true,
    "users":[
        {
            "succes":true,
            "id":  ... ,
            "name": ... ,
            "position": ...,
            "active": ...

        },
        {
            "succes":true,
            "id":  ... ,
            "name": ... ,
            "position": ...,
            "active": ...
        
        }


    ]


    

}

*/


$_SESSION['id'] = 2;

$uid = $_SESSION['id'];

$sql = "SELECT * FROM users  ;";
$rs = $db->query($sql);

if ($rs->num_rows === 0) {
    die('no users found');
}


$finalArray = array();

$finalArray['succes'] = true;

while ($row = $rs->fetch_assoc()) {

    $res = array();

    $res['id'] = $row['id'];
    $res['name'] = $row['name'];
    $res['email'] = $row['email'];
    $res['position'] = $row['position'];
    $res['active'] = $row['active'];

    $finalArray[] = $res;

}

die(json_encode($finalArray));
