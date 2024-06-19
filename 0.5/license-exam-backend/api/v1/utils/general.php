<?php
session_start();

function StopWith404()
{
    header("HTTP/1.0 404 Not Found");
    die();
}


function dateFormat($date)
{

    global $db;
    // session
    // 
    $dateFormatStr = "Y-m-d";

    if (isset($_SESSION['date_format'])) {

        $dateFormatStr = $_SESSION['date_format'];

    } else {
        //read from db

        $format = getOption("date_format");

        if ($format != null) {
            $dateFormatStr = $format;

            $_SESSION['date_format'] = $format;
        }

    }

    $time = strtotime($date);
    $myFormatForDisplay = date($dateFormatStr, $time);
    return $myFormatForDisplay;
}

function getOption($key)
{
    global $db;

    $key = $db->escape_string($key);

    $sql = "SELECT `value` FROM `config` where `key` = '$key'";

    if ($rs = $db->query($sql)) {
        if ($rs->num_rows > 0) {
            $row = $rs->fetch_assoc();
            return $row['value'];
        }
        return null;
    }
}

function setOption($key, $value)
{
    global $db;

    $key = $db->escape_string($key);
    $value = $db->escape_string($value);

    $sql = "SELECT `key` FROM `config` where `key` = '$key'";

    if ($rs = $db->query($sql)) {
        if ($rs->num_rows > 0) {
            $sql = "update `config` set `value` = '$value' where `key` = '$key'";
        } else {
            $sql = "insert into `config` (`key`,`value`) values ('$key','$value')";
        }
    }

    if ($db->query($sql)) {
        return true;
    }

}

function timeStampDateFormat($timestamp)
{

    $timestamp = strtotime($timestamp); // Convert to Unix timestamp if not already one
    $date = date("Y-m-d", $timestamp); // Extracts the date part
    $time = date("H:i:s", $timestamp); // Extracts the time part

    // If you need to use a specific date format that comes from dateFormat($date),
    // and assuming dateFormat($date) returns something like "Y-m-d" or any other date format
    $date = dateFormat($date); // This should be a string like "Y-m-d"

    // Format the timestamp according to the desired date format directly
    $fullDateTime = date($date . " " . $time);

    // Now, $fullDateTime contains both date and time in the desired format
    return $fullDateTime;

}




use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

function SendEmail($to, $toname, $subject, $body)
{

    if (!class_exists('PHPMailer')) {

        require_once __DIR__ . "/../../../vendor/autoload.php";

        // require 'lib/phpmailer/Exception.php';
        // require 'lib/phpmailer/PHPMailer.php';
        // require 'lib/phpmailer/SMTP.php';

    }

    $phpmailer = new PHPMailer();
    $phpmailer->isSMTP();

    $phpmailer->Host = '';
    $phpmailer->SMTPAuth = ;
    $phpmailer->Username = '';
    $phpmailer->Password = '';
    $phpmailer->Port = ;
    $phpmailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    //$phpmailer->SMTPDebug = SMTP::DEBUG_SERVER;

    //$phpmailer->setFrom('gellert@students.csik.sapientia.ro', 'Caedes Aeterna');
    $phpmailer->addAddress($to, $toname);
    $phpmailer->Subject = $subject;
    $phpmailer->isHTML(true);
    $phpmailer->Body = $body;



    try {
        return $phpmailer->send();
    } catch (Exception $ex) {
        //logmsg(L_CRITICAL, 'PHPMailer exception', $ex);
        return false;
    }
}





