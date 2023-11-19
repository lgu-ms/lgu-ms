<?php
include("../include/config.php");
include("../include/dbcon.php");

if ($debug) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
} else {
    error_reporting(0);
}

$getSessionState = mysqli_query($conn, "SELECT * FROM account_session");
if (mysqli_num_rows($getSessionState) > 0) {
    while ($row = mysqli_fetch_assoc($getSessionState)) {
        $today = strtotime("now");
        $session_id = $row["_sid"];
        if ($today - $row["last_accessed"] > (3 * 1440) * 60) {
            $updateSession = "UPDATE account_session SET session_ended = $today, session_status = 'inactive' WHERE _sid = $session_id";
            $conn->query($updateSession);
        }
    }
}
?>