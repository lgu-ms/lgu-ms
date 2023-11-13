<?php
include("../../include/session.php");

if (isLogin() || !isset($_SESSION["signup_temp"])) {
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
                                    <input type="number" placeholder="One Time Password" name="password" required>
                                </div>

                                <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">
                                <input type="hidden" name="action" value="validate_captcha">

                                <button id="executeCaptcha" class="btn btn-primary px-5 mt-3" type="submit" name="otp">Submit</button>

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

?>