<?php
include("../../include/session.php");

$page_publisher = "https://facebook.com/melvinjonesrepol";
$page_modified_time = "2023-10-08T13:37:36+00:00";
$page_title = "Citizen Services and Engagement Module";
$page_description = "";
$page_keywords = "digital barangay, lgu, lgu management system";
$page_image = "http://localhost/lgu-ms/images/ogimage.png";
$page_author = "Melvin Jones Repol";
$page_canonical = "http://localhost/lgu-ms/modules/citizen-services-and-engagement-module/";
$page_url = $page_canonical;
$directory = "../../";
$directory_img = "../../";
$isForm = false;

include("../../include/header.php");

?>

<body class="d-flex flex-column min-vh-100 ">
    <?php include("../../include/nav.php"); ?>

    <header>
        <div class="container pt-4 pt-xl-5">
            <div class="row pt-5">
                <div class="col-md-8 col-xl-6 text-center text-md-start mx-auto">
                    <div class="text-center">
                        <h4 style="color: #4285f4;">Digital Barangay</h4>
                        <h1 class="fw-bold">Users</h1>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main class="text-center">
        <div class="container">
            <div class="row align-items-center g-lg-5 py-5">
                <div class="col-lg-7 text-center text-lg-start">
                    <h1 class="display-4 fw-bold lh-1 mb-3">Register a Profile</h1>
                    <p class="col-lg-10 fs-5"> It is designed to enhance citizen-government interactions, improve service delivery, and foster civic engagement. This module leverages technology to provide citizens with easy access to government services, information, and resources, while also encouraging their active participation in community affairs.</p>
                </div>
                <div class="col-md-10 mx-auto col-lg-5">
                    <form class="p-4 p-md-5 bg-body-auto" id="register" method="post">
                        <h3>Citizen
                            <hr>
                        </h3>
                        <div class="input-group2">
                            <input id="fname" type="text" placeholder="First Name" name="fname" required>
                            <i class="fa fa-user"></i>
                        </div>
                        <div class="input-group2">
                            <input id="lname" type="text" placeholder="Last Name" name="lname" required>
                            <i class="fa fa-user"></i>
                        </div>
                        <div class="input-group2">
                            <input id="email" type="email" placeholder="Email" name="email" required>
                            <i class="fa fa-envelope"></i>
                        </div>
                        <div class="input-group2">
                            <input id="contact" type="text" placeholder="Contact No." name="contact" required>
                            <i class="fa fa-phone"></i>
                        </div>
                        <button class="btn btn-primary shadow px-4" type="submit" name="regBtn">Register</button>

                    </form>
                </div>
            </div>
        </div>
    </main>

    <div class="p-5 text-center">
        <div class="container py-5">
            <h1>Be one with us.</h1>
            <p class="col-lg-8 mx-auto lead">
                Shape your experience with <code>Citizen and Services and Engagement</code> . Share feedback to enhance our services - your thoughts matter. Have a service in mind? Let us know, your requests guide our improvements. Be a part of this growth!
            </p>
        </div>
    </div>

    <!-- FORM -->
    <div class="container">
        <div class="col-md-10 mx-auto col-lg-10" id="form">
            <div class="row">
                <div class="col-md-6">
                    <form class="p-4 p-md-1" id="comment" method="post">
                        <h3 class="text-center">Feedback
                            <hr>
                        </h3>
                        <div class="input-group2">
                            <textarea id="feedback" type="text" style="resize: none;" placeholder="Feedback Comment" name="feedback" required></textarea>
                            <i class="fa fa-comments"></i>
                        </div>
                        <div class="container ">
                            <h3 class="text-center">Select Rating</h3>
                            <div class="form-check m-2">
                                <input type="radio" class="form-check-input" id="radio1" name="rating" value="5" checked> 5 - Excellent
                                <label class="form-check-label" for="radio1"></label>
                            </div>
                            <div class="form-check m-2">
                                <input type="radio" class="form-check-input" id="radio2" name="rating" value="4"> 4 - Good
                                <label class="form-check-label" for="radio2"></label>
                            </div>
                            <div class="form-check m-2">
                                <input type="radio" class="form-check-input" id="radio3" name="rating" value="3" checked> 3 - Average
                                <label class="form-check-label" for="radio3"></label>
                            </div>
                            <div class="form-check m-2">
                                <input type="radio" class="form-check-input" id="radio4" name="rating" value="2"> 2 - Below Average
                                <label class="form-check-label" for="radio4"></label>
                            </div>
                            <div class="form-check m-2">
                                <input type="radio" class="form-check-input" id="radio5" name="rating" value="1"> 1 - Poor
                                <label class="form-check-label" for="radio5"></label>
                            </div>

                        </div>

                        <div class="center">
                            <button class="btn btn-primary shadow px-4" type="submit" name="feedbackBtn" href="#form">Submit Feedback & Rating</button>
                        </div>
                    </form>
                </div>

                <div class="col-md-6">
                    <form class="p-4 p-md-1 text-center" id="service" method="post">
                        <h3>Services
                            <hr>
                        </h3>
                        <div class="input-group2">
                            <input id="name" type="text" placeholder="Service Name" name="name" required>
                            <i class="fa fa-bell-concierge"></i>
                        </div>
                        <div class="input-group2">
                            <input id="desc" type="text" placeholder="Service Description" name="desc" required>
                            <i class="fa fa-file-lines"></i>
                        </div>
                        <button class="btn btn-primary shadow px-4" type="submit" name="serviceBtn" href="#form">Submit Services</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- FORM -->

    <div class="center">
        <a href="index.php" class="active text-center">Return to main page.</a>
    </div>

    <?php include("../../include/footer.php"); ?>
</body>

</html>

<?php

include("process.php");

if (isset($_POST['regBtn'])) {
    register();
}

if (isset($_POST['feedbackBtn'])) {
    submitFeedback();
}

if (isset($_POST['serviceBtn'])) {
    submitServices();
}

?>