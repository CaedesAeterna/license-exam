<?php

function requireWorkerLogin()
{
    if (!isset($_SESSION['id'])) {
        die('{"success": false, "redirect": "login"}');
    }
    ;
}


function requireManagerLogin()
{
    if (!isset($_SESSION['id'])) {
        die('{"success": false, "redirect": "login"}');
    }
    ;
}


function requireClientLogin()
{
    if (!isset($_SESSION['id'])) {
        die('{"success": false, "redirect": "login"}');
    }
    ;
}

function requireAdminLogin()
{
    if (!isset($_SESSION['id'])) {
        die('{"success": false, "redirect": "login"}');
    }
    ;
}


function redirectToLogin()
{
    die('{"success": false, "redirect": "login"}');
}