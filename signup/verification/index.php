<?php
include("../../include/session.php");

if (isLogin() || !isset($_SESSION["signup_temp"])) {
    header('Location: ../');
    die();
}

$page_publisher = "https://facebook.com/melvinjonesrepol";
$page_modified_time = "2023-11-17T13:37:36+00:00";
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
        $signup_temp_email = $_SESSION["signup_temp_email"];
        $signup_temp_fullname = $_SESSION["signup_temp_fullname"];
        $signup_temp_password = $_SESSION["signup_temp_password"];
        $signup_temp_id = $_SESSION["signup_temp_otp"];
        $otp = hash("sha512", $_POST["otp"]);

        $getOtpFromDB = mysqli_query($conn, "SELECT * FROM otp WHERE temp_id= '$signup_temp_id'");
        if (mysqli_num_rows($getOtpFromDB) > 0) {
            while ($row = mysqli_fetch_assoc($getOtpFromDB)) {
                if ($otp == hash("sha512", $row["code"])) {
                    if (time() - $row["created_time"] > 15 * 60) {
                        echo '<script>
                            showToast("Invalid One Time Password! Please sign up again.");
                            function goBack() {
                                window.location.href = "../?ref=signup_v&res=time_out"
                            }
                            setTimeout(goBack, 5000);
                        </script>
                            </script>';
                        session_destroy();
                    } else {
                        session_destroy();
                        $sql = "INSERT INTO account (user_name, user_fullname, user_email, user_password, user_type, created_at, updated_at) VALUES ";
                        $today = strtotime("now");
                        $default_username = explode("@", $signup_temp_email);
                        $sql .= "('$default_username[0]', '$signup_temp_fullname', '$signup_temp_email', '$signup_temp_password', 'User', $today, $today)";
                        if ($conn->query($sql) === TRUE) {
                            require_once "../../include/mail.php";
                            $welcomeMail = initMail($signup_temp_email, $signup_temp_fullname, "Welcome aboard!", '
                                    <div style="font-family: Helvetica,Arial,sans-serif;min-width:1000px;overflow:auto;line-height:2">
                                        <div style="margin:50px auto;width:70%;padding:20px 0">
                                            <div style="border-bottom:1px solid #eee">
                                                <a href="" style="font-size:1.4em;color: #2e475d;text-decoration:none;font-weight:600">Digital Barangay</a>
                                            </div>
                                            <p style="font-size:1.1em">Hi ' . $signup_temp_fullname .  ',</p>
                                            <p>Thank you for choosing Digital Barangay you are in the right place. We are trilled you to welcome aboard! If you need further assistance don\'t hesitate to reach us.</p>
                                            <p style="font-size:0.9em;">Regards,<br />Digital Barangay Team</p>
                                            <hr style="border:none;border-top:1px solid #eee" />
                                            <div style="float:right;padding:8px 0;color:#aaa;font-size:0.8em;line-height:1;font-weight:300">
                                                <p>3W2+H2Q, Mayaman</p>
                                                <p>Diliman</p>
                                                <p>Lungsod Quezon</p>
                                                <p>Kalakhang Maynila</p>
                                            </div>
                                        </div>
                                    </div>
                                    ');
                            sendMail($welcomeMail);
                            echo '<script>window.location.href = "../../login?ref=signup&email=' . $signup_temp_email . '";</script>';
                            die();
                        } else {
                            echo '<script>showToast("An error occured please try again later!")</script>';
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
?>