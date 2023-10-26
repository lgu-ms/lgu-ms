<?php
include("../include/session.php");


if (!isLogin()) {
    echo '<script>window.location.href = "../"</script>';
    die();
}


include("../include/dbcon.php");

$user_id = $_SESSION["user_id"];
$deleteSessionID = "DELETE FROM account_session where _id = " . $_SESSION["session_id"];
if ($conn->query($deleteSessionID) === TRUE) {

    $check_email = mysqli_query($conn, "SELECT * FROM account where _id = $user_id");
    if (mysqli_num_rows($check_email) > 0) {
        while ($row = mysqli_fetch_assoc($check_email)) {
            $sessionList = json_decode($row["session_ids"]);
            $index = array_search($_SESSION["session_id"], $sessionList);
            if ($index !== FALSE) {
                unset($sessionList[$index]);
            }
            $sessionList = json_encode($sessionList);
            $updateQuery = "UPDATE account SET session_ids = '$sessionList' where _id = $user_id";
            if ($conn->query($updateQuery) === TRUE) {
                session_destroy();
                echo '<script>window.location.href = "../"</script>';
                die();
            }
        }
    }
}
