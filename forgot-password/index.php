<?php
include("../include/session.php");

if (isLogin()) {
    header('Location: ../');
    die();
}

$page_publisher = "https://facebook.com/melvinjonesrepol";
$page_modified_time = "2023-11-22T13:37:36+00:00";
$page_title = "";
if (isset($_GET["r"])) {
    $page_title = "Email Verification - Digital Barangay";
} else {
    $page_title = "Forgot Password - Digital Barangay";
}
$page_description = "";
$page_keywords = "digital barangay, lgu, lgu management system";
$page_image = "https://digitalbarangay.com/images/ogimage.png";
$page_author = "Melvin Jones Repol";
$page_canonical = "https://digitalbarangay.com/forgot-password/";
$page_url = $page_canonical;
$directory = "../";
$directory_img = $directory;
$recaptcha = true;

include("../include/header.php");

$page = '
<div class="card mb-3">
<div class="row g-0">
    <div class="col-md-4" id="mobile">
        <img class="rounded mx-auto d-block img-fluid" src="../images/dial122-web-banner-v2.jpg"
            alt="Banner" width="500">
        <img class="mt-3 mb-5 rounded mx-auto d-block img-fluid"
            src="../images/coronavirus-safety-tw.jpg.img.jpeg" alt="Banner" width="500">
    </div>
    <div class="col-md-7">
        <div class="container">
            <form action method="post" id="form">
                <div class="row">
                    <div class="col-md-6">
                        <h1>Forgot Password</h1>
                        <br>
                        <div class="input-group2">
                            <input type="email" placeholder="Email" name="email" required>
                            <i class="fa fa-user"></i>
                        </div>

                        <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">
                        <input type="hidden" name="action" value="validate_captcha">

                        <div class="form-group mt-2">
                            <button id="executeCaptcha" class="btn btn-primary shadow px-5"
                                type="forgot" name="forgot">Forgot</button>
                            <a type="button" class="btn btn-outline-primary px-4"
                                href="../login?ref=forgot-password">Login</a>
                            <br><br>
                            <a class="fpass" href="../signup?ref=forgot-password">No account yet?</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-4" id="desktop">
        <img class="rounded mx-auto d-block img-fluid" src="../images/dial122-web-banner-v2.jpg"
            alt="Banner" width="500">
        <img class="mt-3 rounded mx-auto d-block img-fluid"
            src="../images/coronavirus-safety-tw.jpg.img.jpeg" alt="Banner" width="500">
    </div>
</div>

</div>
';
?>


<body class="d-flex flex-column min-vh-100">
    <?php include("../include/nav.php"); ?>

    <main>
        <?php

        if (isset($_GET["r"]) && isset($_SESSION["fp_temp_user_email"])) {
            $otl = $_GET["r"];
            $fp_temp_user_email = $_SESSION["fp_temp_user_email"];
            $getOtlFromDB = mysqli_query($conn, "SELECT * FROM otp WHERE code= '$otl' AND temp_id= '$fp_temp_user_email'");
            if (mysqli_num_rows($getOtlFromDB) > 0) {
                while ($row = mysqli_fetch_assoc($getOtlFromDB)) {
                    if (time() - $row["created_time"] > 15 * 60) {
                        echo $page;
                        echo '<script>showToast("Invalid One Time URL!")</script>';
                    } else {
                        echo '
                          <div class="card mb-3">
            <div class="row g-0">
                <div class="col-md-4" id="mobile">
                    <img class="rounded mx-auto d-block img-fluid" src="../images/dial122-web-banner-v2.jpg"
                        alt="Banner" width="500">
                    <img class="mt-3 mb-5 rounded mx-auto d-block img-fluid"
                        src="../images/coronavirus-safety-tw.jpg.img.jpeg" alt="Banner" width="500">
                </div>
                <div class="col-md-7">
                    <div class="container">
                        <form action method="post" id="form">
                            <div class="row">
                                <div class="col-md-6">
                                    <h1>Update your password</h1>
                                    <br>

                                    <div class="input-group2">
                                        <input type="password" placeholder="New Password" name="password" id="password" required>
                                        <i class="fa fa-key"></i>
                                    </div>

                                    <div class="input-group2">
                                        <input type="password" placeholder="Confirm New Password" name="cpassword" id="cpassword"
                                            required>
                                        <i class="fa fa-arrows-rotate"></i>
                                    </div>

                                    <input class="form-check-input" type="checkbox" value="" id="showPassword">
                                    <label class="form-check-label" for="showPassword">
                                        Show password
                                    </label>

                                    <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">
                                    <input type="hidden" name="action" value="validate_captcha">

                                    <div class="form-group mt-2">
                                        <button id="executeCaptcha" class="btn btn-primary px-5 shadow" type="submit"
                                            name="submit">Update</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-4" id="desktop">
                    <img class="rounded mx-auto d-block img-fluid" src="../images/dial122-web-banner-v2.jpg"
                        alt="Banner" width="500">
                    <img class="mt-3 rounded mx-auto d-block img-fluid"
                        src="../images/coronavirus-safety-tw.jpg.img.jpeg" alt="Banner" width="500">
                </div>
            </div>

        </div>
                        ';
                    }
                }
            } else {
                echo $page;
                echo '<script>showToast("Invalid One Time URL!")</script>';
            }
        } else {
            echo $page;
        }

        ?>
    </main>

    <?php include("../include/footer.php"); ?>
</body>

</html>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    require_once '../vendor/autoload.php';
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
        if (!isset($_POST["forgot"])) {
            $email = "";
            if (!isset($_POST["email"])) {
                echo '<script>showToast("Email is required!")</script>';
            } else {
                $email = $_POST["email"];
                $isRegister = mysqli_query($conn, "SELECT * FROM account WHERE user_email = '$email'");
                if (mysqli_num_rows($isRegister) > 0) {
                    while ($row = mysqli_fetch_assoc($isRegister)) {
                        $_SESSION["fp_temp_user_email"] = $email;
                        $_SESSION["fp_temp_user_fullname"] = $row["user_fullname"];
                        $otp = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
                        $temp_id = hash("sha512", $otp);
                        $sqlOtp = "INSERT INTO otp (code, created_time, action_type, temp_id) VALUES ";
                        $timeGenerated = strtotime("now");
                        $sqlOtp .= "('$temp_id', $timeGenerated, 'FORGOT-PASSWORD', '$email')";
                        if ($conn->query($sqlOtp) === TRUE) {
                            require_once "../include/mail.php";
                            $mail = initMail('../', $email, $row["user_fullname"], "Password Reset", '
        <div style="font-family: Helvetica,Arial,sans-serif;min-width:1000px;overflow:auto;line-height:2">
            <div style="margin:50px auto;width:70%;padding:20px 0">
                <div style="border-bottom:1px solid #eee">
                    <a href="" style="font-size:1.4em;color: #2e475d;text-decoration:none;font-weight:600">Digital Barangay</a>
                </div>
                <p style="font-size:1.1em">Hi ' . $row["user_fullname"] . ',</p>
                <p>Thank you for trusting Digital Barangay. Use the following LINK to complete your password reset. The LINK is valid for 15 minutes only</p>
                <a style="background: #2e475d;margin: 0 auto;width: max-content;padding: 0 10px;color: #fff;border-radius: 4px;" href="https://digitalbarangay.com/forgot-password?r=' . $temp_id . '">https://digitalbarangay.com/forgot-password?r=' . $temp_id . '</a>
                <p style="font-size:0.9em;">Regards,<br />Digital Barangay Security Team</p>
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
                            if (sendMail($mail)) {
                                echo '<script>showToast("Please check your email for the reset url.")</script>';
                            } else {
                                echo '<script>showToast("An error occured while sending you an email. Please try it again later!")</script>';
                            }
                        }
                    }
                } else {
                    echo '<script>showToast("No account registered with that email.")</script>';
                }
            }
        } else {
            $password = $cpassword = "";
            if (!isset($_POST["password"])) {
                echo '<script>showToast("Password is required!")</script>';
            } else {
                $password = $_POST["password"];
                if (strlen($password) <= '8') {
                    echo '<script>showToast("Your Password Must Contain At Least 8 Characters!")</script>';
                } else if (!preg_match("#[0-9]+#", $password)) {
                    echo '<script>showToast("Your Password Must Contain At Least 1 Number!")</script>';
                } else if (!preg_match("#[A-Z]+#", $password)) {
                    echo '<script>showToast("Your Password Must Contain At Least 1 Uppercase Letter!")</script>';
                } else if (!preg_match("#[a-z]+#", $password)) {
                    echo '<script>showToast("Your Password Must Contain At Least 1 Lowercase Letter!")</script>';
                } else if (!preg_match("@[^\w]@", $password)) {
                    echo '<script>showToast("Your Password Must Contain At Least 1 Special Characters!")</script>';
                } else if (!isset($_POST["cpassword"])) {
                    echo '<script>showToast("You need to retype your password again!")</script>';
                } else {
                    $cpassword = $_POST["cpassword"];
                    if ($password != $cpassword) {
                        echo '<script>showToast("Password did not match!")</script>';
                    } else {
                        $hashpassword = hash("sha512", $password);
                        $fp_temp_user_email = $_SESSION["fp_temp_user_email"];
                        $fp_temp_user_fullname = $_SESSION["fp_temp_user_fullname"];
                        $setPassword = "UPDATE account SET user_password = '$hashpassword' WHERE user_email = '$fp_temp_user_email'";
                        if ($conn->query($setPassword)) {
                            $setChangePassword = "INSERT INTO passwordchanged (date_accessed, event_type, user_email) VALUES ";
                            $today = strtotime("now");
                            $setChangePassword .= "($today, 'forgot-password', '$fp_temp_user_email')";
                            if ($conn->query($setChangePassword) === TRUE) {
                                $_SESSION["fp_temp_user_email"] = null;
                                $_SESSION["fp_temp_user_fullname"] = null;
                                require_once "../include/mail.php";
                                $notifyPasswordChange = initMail("../", $fp_temp_user_email, $fp_temp_user_fullname, "Your account password has been reset.", '
                                <div style="font-family: Helvetica,Arial,sans-serif;min-width:1000px;overflow:auto;line-height:2">
                                    <div style="margin:50px auto;width:70%;padding:20px 0">
                                        <div style="border-bottom:1px solid #eee">
                                            <a href="" style="font-size:1.4em;color: #2e475d;text-decoration:none;font-weight:600">Digital Barangay</a>
                                        </div>
                                        <p style="font-size:1.1em">Hi ' . $fp_temp_user_fullname . ',</p>
                                        <p>You received this email to let you know that your account password has been reset. If you did not do it please contact us immediately.</p>
                                        <p style="font-size:0.9em;">Regards,<br />Digital Barangay Security Team</p>
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
                                sendMail($notifyPasswordChange);
                                echo '<script>showPopup("Change Password", "Successfully changed your password", "../login?ref=forgot_password&status=success", "Log in")</script>';
                            }
                        }
                    }
                }
            }
        }
    } else {
        echo '<script>showToast("Seems like you failed in I am not a robot test.")</script>';
    }
}
?>