<?php
include("../include/session.php");

if (!isLogin()) {
    echo '<script>window.location.href = "../"</script>';
    die();
}

$user_id = $_SESSION["user_id"];
$session_id = $_SESSION["session_id"];
$today = date("Y-m-d H:i:s");

$updateSession = "UPDATE account_session SET session_ended = '$today', session_status = 'end' WHERE user_id = $user_id AND _sid = $session_id";

if ($conn->query($updateSession) === TRUE) {

    session_destroy();
    echo '<script>window.location.href = "../"</script>';
    die();
}
