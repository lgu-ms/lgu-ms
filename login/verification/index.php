<?php
include("../../include/session.php");

if (isLogin() || !isset($_SESSION["login_temp"])) {
    header('Location: ../');
    die();
}

$page_publisher = "https://facebook.com/melvinjonesrepol";
$page_modified_time = "2023-10-08T13:37:36+00:00";
$page_title = "Email Verification - Digital Barangay";
$page_description = "";
$page_keywords = "digital barangay, lgu, lgu management system";
$page_image = "https://digitalbarangay.com/images/ogimage.png";
$page_author = "Melvin Jones Repol";
$page_canonical = "https://digitalbarangay.com/";
$page_url = $page_canonical;
$directory = "../../";
$directory_img = $directory;
$hideLoginButton = true;

include("../../include/header.php");

?>


<body class="d-flex flex-column min-vh-100">
    <?php include("../../include/nav.php"); ?>

    <main>
        <div class="container" style="margin-top:3em;">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12">
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <form action="<?php htmlspecialchars('php_self'); ?>" method="post" id="form">
                        <div class="card mb-3 shadow ">
                            <div class="card-body">
                                <h3>Enter OTP</h3>

                                <div class="input-group2 mt-5">
                                    <input type="number" placeholder="One Time Password" name="otp" required>
                                </div>

                                <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">
                                <input type="hidden" name="action" value="validate_captcha">

                                <button id="executeCaptcha" class="btn btn-primary px-5 mt-3" type="submit"
                                    name="submit">Submit</button>

                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                </div>
            </div>
        </div>
    </main>
    <?php include("../../include/footer.php"); ?>
</body>

</html>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login_temp_email = $_SESSION["login_temp_email"];
    $login_temp_password = $_SESSION["login_temp_password"];
    $login_temp_id = $_SESSION["login_temp_otp"];
    $login_user_id = $_SESSION["login_user_id"];
    $otp = hash("sha512", $_POST["otp"]);

    $getOtpFromDB = mysqli_query($conn, "SELECT * FROM otp WHERE temp_id= '$login_temp_id'");
    if (mysqli_num_rows($getOtpFromDB) > 0) {
        while ($row = mysqli_fetch_assoc($getOtpFromDB)) {
            if ($otp == hash("sha512", $row["code"])) {
                if (time() - $row["created_time"] > 15 * 60) {
                    echo '<script>showErr("Invalid One Time Password! Please Login again.")</script>';
                    session_destroy();
                } else {
                    session_destroy();
                    // initiate a new season after the previous one being destroyed
                    if (is_session_started() === FALSE) session_start();
                    $sql = "INSERT INTO account_session (user_agent, session_started, session_status, user_id, last_accessed) VALUES ";
                    $device_id = hash("sha512", $_SERVER['HTTP_USER_AGENT']);
                    $today = date("Y-m-d H:i:s");
                    $sql .= "('$device_id', '$today', 'active', $login_user_id, '$today')";
                    if ($conn->query($sql) === TRUE) {
                        $getSessionID = mysqli_query($conn, "SELECT * FROM account_session WHERE session_started = '$today' AND user_id = $login_user_id");

                        if (mysqli_num_rows($getSessionID) > 0) {
                            while ($row1 = mysqli_fetch_assoc($getSessionID)) {
                                $_SESSION['user_login'] = true;
                                $_SESSION["session_id"] = $row1["_sid"];
                                $_SESSION["user_id"] = $login_user_id;

                                echo '<script>window.location.href = "../../"</script>';
                                die();
                            }
                        }
                    }
                }
            } else {
                echo '<script>showErr("Invalid One Time Password!")</script>';
            }
        }
    }
}
?>