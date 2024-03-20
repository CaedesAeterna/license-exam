<?php

function requireLogin()
{
    if (!isset ($_SESSION['id'])) {
        die ('{"success": false, "redirect": "login"}');
    }
    ;
}


// 0-10 - admin
// 11-20 - manager
// 21-30 - worker
// 31-40 - client

function checkAdminLogin()
{
    if (!isset ($_SESSION['position']) || $_SESSION['position'] > 10)
        return false;

    return true;
}

function checkManagerLogin()
{
    if (!isset ($_SESSION['position']) || $_SESSION['position'] > 20)
        return false;
    return true;

}
function checkWorkerLogin()
{
    if (!isset ($_SESSION['position']) || $_SESSION['position'] > 30)
        return false;
    return true;

}
function checkClientLogin()
{
    if (!isset ($_SESSION['position']) || $_SESSION['position'] > 40)
        return false;
    return true;

}


function requireAdminLogin()
{
    if (!isset ($_SESSION['position']) || $_SESSION['position'] != 10) {
        redirectToLogin();
    }
}

function requireManagerLogin()
{
    if (!isset ($_SESSION['position']) || $_SESSION['position'] != 20) {
        redirectToLogin();
    }
}

function requireWorkerLogin()
{
    if (!isset ($_SESSION['position']) || $_SESSION['position'] != 30) {
        redirectToLogin();
    }
}

function requireClientLogin()
{
    if (!isset ($_SESSION['position']) || $_SESSION['position'] != 40) {
        redirectToLogin();
    }
}


function redirectToLogin()
{
    die ('{"success": false, "redirect": "login"}');
}