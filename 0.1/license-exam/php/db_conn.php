<?php

function OpenCon()
{
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $db = "users";
    $conn = new mysqli($dbhost, $dbuser, $dbpass, $db) or die("Connect failed: %s \n" . $conn->error);

    echo $dbhost . "\n";
    echo $dbuser . "\n";
    echo $dbpass . "\n";
    echo $db . "\n";
    return $conn;
}

function CloseCon($conn)
{
    $conn->close();
}



?>