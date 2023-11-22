<?php
include("../../include/session.php");

if (isLogin() || !isset($_SESSION["login_temp"])) {
    header('Location: ../');
    die();
}

$page_publisher = "https://facebook.com/melvinjonesrepol";
$page_modified_time = "2023-11-22T13:37:36+00:00";
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
                                <p>Please check your email for the 6 digit one time password.</p>

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
    require_once '../../vendor/autoload.php';
    $client = new GuzzleHttp\Client();
    $token = $_POST["g-recaptcha-response"];
    $response = $client->post('https://www.google.com/recaptcha/api/siteverify', [
        'form_params' => [
            'secret' => $captcha_secret_key,
            'response' => $token
        ]
    ]);
    $result = json_decode($response->getBody());
    if ($result->success) {
        $login_temp_session_id = $_SESSION["login_temp_session_id"];
        $login_temp_id = $_SESSION["login_temp_otp"];
        $login_temp_user_id = $_SESSION["login_temp_user_id"];
        $otp = hash("sha512", $_POST["otp"]);

        $getOtpFromDB = mysqli_query($conn, "SELECT * FROM otp WHERE temp_id= '$login_temp_id'");
        if (mysqli_num_rows($getOtpFromDB) > 0) {
            while ($row = mysqli_fetch_assoc($getOtpFromDB)) {
                if ($otp == hash("sha512", $row["code"])) {
                    if (time() - $row["created_time"] > 15 * 60) {
                        echo '<script>
                            showToast("Invalid One Time Password! Please Login again.");
                            function goBack() {
                                window.location.href = "../?ref=login_v&res=time_out"
                            }
                            setTimeout(goBack, 5000);
                        </script>';
                        nullifySession();
                    } else {
                        nullifySession();
                        $ray_id = $_SERVER['HTTP_CF_RAY'];
                        $sql = "INSERT INTO account_session (user_agent, session_started, session_status, user_id, last_accessed";
                        if (isset($ray_id)) {
                            $sql .= ", ray_id";
                        }
                        $sql .= ") VALUES ";
                        $device_id = $_SERVER['HTTP_USER_AGENT'];
                        $today = strtotime("now");
                        $sql .= "('$device_id', $today, 'active', $login_temp_user_id, $today";
                        if (isset($ray_id)) {
                            $sql .= ", '$ray_id'";
                        }
                        $sql .= ")";
                        if ($conn->query($sql) === TRUE) {
                            $_SESSION['user_login'] = true;
                            $_SESSION["session_id"] = $login_temp_session_id;
                            $_SESSION["user_id"] = $login_temp_user_id;

                            // TODO: Check if the device_id is new or not according to the past 
                            // sessions if new notify the user about the new device accessing his account
                            echo '<script>window.location.href = "../../"</script>';
                            die();
                        }
                    }
                } else {
                    echo '<script>showToast("Invalid One Time Password!")</script>';
                }
            }
        }
    } else {
        echo '<script>showToast("Seems like you failed the `I am not a robot test`.")</script>';
    }
}

function nullifySession()
{
    $_SESSION["login_temp"] = false;
    $_SESSION["login_temp_session_id"] = null;
    $_SESSION["login_temp_otp"] = null;
    $_SESSION["login_temp_user_id"] = null;
}
?>