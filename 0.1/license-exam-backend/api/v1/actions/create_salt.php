<?php



$salt = '';


for ($i = 0; $i < 25; $i++) {

    $salt .= chr(mt_rand(33, 126));

}



//echo $salt;
$_SESSION['salt'] = $salt;

die($salt);



