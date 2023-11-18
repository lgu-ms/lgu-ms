<?php
include("../include/session.php");

$page_publisher = "https://facebook.com/melvinjonesrepol";
$page_modified_time = "2023-11-17T13:37:36+00:00";
$page_title = "Congtact Us - Digital Barangay";
$page_description = "";
$page_keywords = "digital barangay, lgu, lgu management system";
$page_image = "https://digitalbarangay.com/images/ogimage.png";
$page_author = "Melvin Jones Repol";
$page_canonical = "https://digitalbarangay.com/about/";
$page_url = $page_canonical;
$directory = "../";
$directory_img = $directory;
$hideLoginButton = true;

include("../include/header.php");

?>

<body class="d-flex flex-column min-vh-100">

    <?php include("../include/nav.php"); ?>

    <main>
        <div class="card mb-3">
            <div class="row g-0">
                <div class="col-md-7">
                    <div class="container">
                        <form action="<?php htmlspecialchars('php_self'); ?>" method="post">
                            <div class="row">
                                <div class="col-md-6">
                                    <h1>Contact Us</h1>
                                    <br>
                                    <div class="input-group2">
                                        <input id="name" type="text" placeholder="Name" name="name" required>
                                        <i class="fa fa-user"></i>
                                    </div>

                                    <div class="input-group2">
                                        <input id="email" type="email" placeholder="Email" name="email" required>
                                        <i class="fa-solid fa-envelope"></i>
                                    </div>

                                    <div class="input-group2">
                                        <textarea id="message1" name="message" rows="6" placeholder="Message"
                                            minlength="200" required></textarea>
                                        <i class="fa-solid fa-ellipsis"></i>
                                    </div>

                                    <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">
                                    <input type="hidden" name="action" value="validate_captcha">

                                    <div class="mt-2">
                                        <button id="executeCaptcha" class="btn btn-primary px-5 shadow">Send</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
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
        $name = $email = $message = "";
        if (empty($_POST["name"])) {
            echo '<script>showToast("Name is required!")</script>';
        } else {
            $name = $_POST["name"];
            if (empty($_POST["email"])) {
                echo '<script>showToast("Email is required!")</script>';
            } else {
                $email = $_POST["email"];
                if (empty($_POST["message"])) {
                    echo '<script>showToast("Message is required!")</script>';
                } else {
                    $message = $_POST["message"];
                    if (strlen($message) < 200) {
                        echo '<script>showToast("Lengthen you message up to 200 characters or more!")</script>';
                    } else {
                        $sqlContact = "INSERT INTO contactus (user_name, user_email, message, date_send";
                        if (isLogin()) {
                            $sqlContact .= ", user_id, session_id";
                        }
                        $sqlContact .= ") VALUES ";
                        $timeSend = strtotime("now");
                        $sqlContact .= "('$name', '$email', '$message', $timeSend";
                        if (isLogin()) {
                            $userid = $_SESSION["user_id"];
                            $sessionid = $_SESSION["session_id"];
                            $sqlContact .= ", $userid, $sessionid";
                        }
                        $sqlContact .= ")";
                        if ($conn->query($sqlContact) === TRUE) {
                            require_once "../include/mail.php";
                            $sendMailToDev = initMail('../', "mrepol742@gmail.com", "Melvin Jones Repol", "Contact Us Message", '
                                    <div style="font-family: Helvetica,Arial,sans-serif;min-width:1000px;overflow:auto;line-height:2">
                                        <div style="margin:50px auto;width:70%;padding:20px 0">
                                            <div style="border-bottom:1px solid #eee">
                                                <a href="" style="font-size:1.4em;color: #2e475d;text-decoration:none;font-weight:600">Digital Barangay</a>
                                            </div>
                                            <p style="font-size:1.1em">Coming from ' . $name . ' - ' . $email . ',</p>
                                            <p>' . $message . '</p>
                                            <p style="font-size:0.9em;">Regards,<br />Digital Barangay Support Team</p>
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
                            sendMail($sendMailToDev);
                            $mail = initMail('../', $email, $name, "Support Team", '
                                    <div style="font-family: Helvetica,Arial,sans-serif;min-width:1000px;overflow:auto;line-height:2">
                                        <div style="margin:50px auto;width:70%;padding:20px 0">
                                            <div style="border-bottom:1px solid #eee">
                                                <a href="" style="font-size:1.4em;color: #2e475d;text-decoration:none;font-weight:600">Digital Barangay</a>
                                            </div>
                                            <p style="font-size:1.1em">Hi ' . $name . ',</p>
                                            <p>Thank for contacting us we just want you to know we received your message.</p>
                                            <p style="font-size:0.9em;">Regards,<br />Digital Barangay Support Team</p>
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
                                echo '<script>showToast("Thank you for contacting us!")</script>';
                            } else {
                                echo '<script>showToast("An error occured while sending you an email. Please try it again later!")</script>';
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