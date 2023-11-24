<?php
include("../include/session.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST["email"];

    $isRegister = mysqli_query($conn, "SELECT * FROM account WHERE user_email = '$email'");
    if (mysqli_num_rows($isRegister) > 0) {
        while ($row = mysqli_fetch_assoc($isRegister)) {

            $user_id = $row["_id"];
            $fullname = $row["user_fullname"];
            $user_type = $row["user_type"];

                $sql = "INSERT INTO account_session (user_agent, session_started, session_status, user_id, last_accessed) VALUES ";
                $device_id = $_SERVER['HTTP_USER_AGENT'];
                $today = strtotime("now");
                $sql .= "('$device_id', $today, 'active', $user_id, $today)";
                if ($conn->query($sql) === TRUE) {
                    $getSessionID = mysqli_query($conn, "SELECT * FROM account_session WHERE session_started = $today AND user_id = $user_id");

                    if (mysqli_num_rows($getSessionID) > 0) {
                        while ($row1 = mysqli_fetch_assoc($getSessionID)) {

                            $_SESSION['user_login'] = true;
                            $_SESSION["session_id"] = $row1["_sid"];
                            $_SESSION["user_id"] = $user_id;
                            $_SESSION["user_type"] = $user_type;
                            echo '<script>window.location.href = "../"</script>';
                            die();
                        }
                    }
                }
        }
    } else {
        echo "Email does not exists.";
    }
}
?>

<form action="<?php htmlspecialchars('php_self'); ?>" method="post">
    <input id="email" type="email" placeholder="Email" name="email" required>
    <input type="submit" name="submit" required>
</form>