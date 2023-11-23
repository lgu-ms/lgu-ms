<?php
include("../include/session.php");

if (isLogin()) {
    header('Location: ../');
    die();
}

$page_publisher = "https://facebook.com/melvinjonesrepol";
$page_modified_time = "2023-11-22T13:37:36+00:00";
$page_title = "Signup or login - Digital Barangay";
$page_description = "";
$page_keywords = "digital barangay, lgu, lgu management system";
$page_image = "https://digitalbarangay.com/images/ogimage.png";
$page_author = "Melvin Jones Repol";
$page_canonical = "https://digitalbarangay.com/signup/";
$page_url = $page_canonical;
$directory = "../";
$directory_img = $directory;
$hideLoginButton = true;
$recaptcha = true;

include("../include/header.php");

?>


<body class="d-flex flex-column min-vh-100">
    <?php include("../include/nav.php"); ?>

    <main>
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
                        <form action="<?php htmlspecialchars('php_self'); ?>" method="post" id="form">
                            <div class="row">
                                <div class="col-md-6">
                                    <h1>Signup now</h1>
                                    <br>
                                    <div class="input-group2">
                                        <input id="email" type="email" placeholder="Email" name="email" required>
                                        <i class="fa fa-user"></i>
                                    </div>

                                    <div class="input-group2">
                                        <input type="text" placeholder="Fullname" name="fullname" required>
                                        <i class="fa fa-circle-info"></i>
                                    </div>

                                    <div class="input-group2">
                                        <input type="password" placeholder="Password" name="password" id="password"
                                            required>
                                        <i class="fa fa-key"></i>
                                    </div>

                                    <div class="input-group2">
                                        <input type="password" placeholder="Confirm Password" name="cpassword"
                                            id="cpassword" required>
                                        <i class="fa fa-arrows-rotate"></i>
                                    </div>

                                    <input class="form-check-input" type="checkbox" value="" id="showPassword">
                                    <label class="form-check-label" for="showPassword">
                                        Show password
                                    </label><br>

                                    <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">
                                    <input type="hidden" name="action" value="validate_captcha">

                                    <small>By clicking Signup, you agree to our <u><a href="/terms">Terms</a></u>, <u><a
                                                href="/privacy">Privacy</a></u> and <u><a href="/cookies">Cookie
                                                Policy</a></u>.</small>
                                    <div class="mt-4">
                                        <button id="executeCaptcha" class="btn btn-primary px-5 shadow" type="submit"
                                            name="submit">Signup</button>
                                        <a type="button" class="btn btn-outline-primary px-4"
                                            href="../login?ref=signup">Login</a>
                                        <br><br>
                                        <a class="fpass" href="../forgot-password?ref=signup">Forgot
                                            password?</a>
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
        $email = $fullname = $password = $cpassword = "";
        if (!isset($_POST["email"])) {
            echo '<script>showToast("Email is required!")</script>';
        } else {
            $email = $_POST["email"];
            if (!isset($_POST["fullname"])) {
                echo '<script>showToast("Fullname is required!")</script>';
            } else {
                $fullname = $_POST["fullname"];
                if (!isset($_POST["password"])) {
                    echo '<script>showToast("Password is required!")</script>';
                } else {
                    $password = $_POST["password"];
                    if (strlen($_POST["password"]) <= '8') {
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
                            $isRegister = mysqli_query($conn, "SELECT * FROM account WHERE user_email= '$email'");
                            if (mysqli_num_rows($isRegister) > 0) {
                                echo '<script>showToast("Email is already registered!")</script>';
                            } else {
                                $_SESSION["signup_temp"] = true;
                                $_SESSION["signup_temp_email"] = $email;
                                $_SESSION["signup_temp_fullname"] = $fullname;
                                $_SESSION["signup_temp_password"] = hash("sha512", $password);
                                $otp = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
                                $temp_id = hash("sha512", $otp);
                                $_SESSION["signup_temp_otp"] = $temp_id;
                                $sqlOtp = "INSERT INTO otp (code, created_time, action_type, temp_id) VALUES ";
                                $timeGenerated = strtotime("now");
                                $sqlOtp .= "('$otp', $timeGenerated, 'ACCOUNT_CREATION', '$temp_id')";
                                if ($conn->query($sqlOtp) === TRUE) {
                                    require_once "../include/mail.php";
                                    $mail = initMail('../', $email, $fullname, "OTP Verification", '
                                    <div style="font-family: Helvetica,Arial,sans-serif;min-width:1000px;overflow:auto;line-height:2">
                                        <div style="margin:50px auto;width:70%;padding:20px 0">
                                            <div style="border-bottom:1px solid #eee">
                                                <a href="" style="font-size:1.4em;color: #2e475d;text-decoration:none;font-weight:600">Digital Barangay</a>
                                            </div>
                                            <p style="font-size:1.1em">Hi ' . $fullname . ',</p>
                                            <p>Thank you for choosing Digital Barangay. Use the following OTP to complete your Sign Up procedures. OTP is valid for 15 minutes only.</p>
                                            <h2 style="background: #2e475d;margin: 0 auto;width: max-content;padding: 0 10px;color: #fff;border-radius: 4px;">' . $otp . '</h2>
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
                                        echo '<script>window.location.href = "verification?ref=signup"</script>';
                                        die();
                                    } else {
                                        echo '<script>showToast("An error occured while sending you an email. Please try it again later!")</script>';
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    } else {
        echo '<script>showToast("Seems like you failed the `I am not a robot test`.")</script>';
    }
}
?>