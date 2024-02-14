<?php



$salt = '';

$lenght = rand(100, 150);


for ($i = 0; $i < $lenght; $i++) {

    $salt .= chr(mt_rand(33, 126));

}



//echo $salt;
$_SESSION['salt'] = $salt;

die($salt);



