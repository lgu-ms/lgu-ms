<?php
include("config.php");
include("dbcon.php");

if ($debug) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
} else {
    error_reporting(0);
}

$sessionTime = 365 * 24 * 60 * 60;
$sessionName = "PHPSNAME";
session_set_cookie_params($sessionTime);
session_name($sessionName);

if (is_session_started() === FALSE) session_start();

if (isset($_COOKIE[$sessionName])) {
    setcookie($sessionName, $_COOKIE[$sessionName], time() + $sessionTime, "/");
}

function isLogin()
{
    return !empty($_SESSION['user_login']);
}

function is_session_started()
{
    if (php_sapi_name() !== 'cli') {
        if (version_compare(phpversion(), '5.4.0', '>=')) {
            return session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
        } else {
            return session_id() === '' ? FALSE : TRUE;
        }
    }
    return FALSE;
}
