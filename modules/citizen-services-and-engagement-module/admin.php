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
<script>
    function changeType(newType, newName) {
        document.getElementById("typeLabel").innerText = newType;
        document.getElementById("findBtn").name = newName;
        document.getElementById("find").placeholder = "Enter " + newType + " Id";
    }
</script>

<body class="d-flex flex-column">
    <?php include("../../include/nav.php");
    include("process.php")
    ?>

    <div class="main">

        <header>
            <div class="container pt-4 pt-xl-5">
                <div class="row pt-5">
                    <div class="col-md-8 col-xl-6 text-center text-md-start mx-auto">
                        <div class="text-center">
                            <h4 style="color: #4285f4;">Digital Barangay</h4>
                            <h1 class="fw-bold">Admin</h1>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div class="container mt-5">
            <h2 class="text-center mb-4">Citizens</h2>
            <div class="table-responsive">
                <?php
                if (isset($_POST['findCitizenBtn'])) {
                    printModCitizen();
                }
                getTables("citizen", "0");

                ?>
            </div>
            <button class="btn btn-primary shadow px-4" style="align-items:center;" type="button" data-bs-toggle="modal" data-bs-target="#modRecordModal" onclick="changeType('Citizen', 'findCitizenBtn')">Select Record</button>


            <h2 class="text-center mb-4" style="margin-top: 100px">Feedbacks</h2>
            <div class="table-responsive">
                <?php
                if (isset($_POST['findFeedbackBtn'])) {
                    printModFeedback();
                }
                getTables("citizen_feedback", "0");
                ?>
            </div>
            <button class="btn btn-primary shadow px-4" style="align-items:center;" type="button" data-bs-toggle="modal" data-bs-target="#modRecordModal" onclick="changeType('Feedback', 'findFeedbackBtn')">Select Record</button>


            <h2 class="text-center mb-4" style="margin-top: 100px">Service Requests</h2>
            <div class="table-responsive">
                <?php
                if (isset($_POST['findServiceBtn'])) {
                    printModService();
                }
                getTables("services", "display");
                ?>
            </div>
            <button class="btn btn-primary shadow px-4" style="align-items:center;" type="button" data-bs-toggle="modal" data-bs-target="#modRecordModal" onclick="changeType('Service Request', 'findServiceBtn')">Select Record</button>

        </div>
    </div>

    <div class="container">
        <div class="modal" id="modRecordModal" tabindex="-1" aria-labelledby="requestModalLabel" aria-hidden="true" data-bs-backdrop="static">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="requestModalLabel">Modify Records: <code><span id="typeLabel"></span></code> </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-1">
                        <form class="p-4 p-md-5 bg-body-auto text-center" id="find_service" method="post">
                            <input id="find" type="number" placeholder="Enter Citizen Id:" name="find" required>
                            <button type="button" class="btn btn-secondary shadow px-4" data-bs-dismiss="modal">Close</button>
                            <button class="btn btn-primary shadow px-4 m-3" name="" id="findBtn">Select User</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODIFY RECORD MODAL -->
    <div class="container">
        <div class="modal" id="modifyCitizenModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true" data-bs-backdrop="static">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modifyModalLabel">Modify Record <code>Citizen</code></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Login Form -->
                        <form class="p-4 p-md-5 bg-body-auto" id="modifyCitizen" method="post">
                            <h3>Modify Record</h3>
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

                            <div class="center">
                                <button type="button" class="btn btn-secondary shadow px-4" data-bs-dismiss="modal">Close</button>
                                <button class="btn btn-primary shadow px-4" type="submit" name="modifyCitizenBtn">Modify</button>
                            </div>
                        </form>
                        <!-- End Login Form -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END OF MODIFY RECORD MODAL -->

    <!-- MODIFY FEEDBACK MODAL -->
    <div class="container">
        <div class="modal" id="modifyFeedbackModal" tabindex="-1" aria-labelledby="feedbackModalLabel" aria-hidden="true" data-bs-backdrop="static">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modifyModalLabel">Modify Record <code>Feedback</code></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="p-4 p-md-1" id="comment" method="post">
                            <h3 class="text-center">Feedback</h3>
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
                                <button type="button" class="btn btn-secondary shadow px-4" data-bs-dismiss="modal">Close</button>
                                <button class="btn btn-primary shadow px-4" type="submit" name="modifyFeedbackBtn">Modify</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END OF FEEDBACK MODAL -->

    <!--MODIFY SERVICE MODAL -->
    <div class="container">
        <div class="modal" id="modifyServiceModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true" data-bs-backdrop="static">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modifyModalLabel">Modify Record <code>Services</code></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="p-4 p-md-1 text-center" id="service" method="post">
                            <h3>Services</h3>
                            <div class="input-group2">
                                <input id="name" type="text" placeholder="Service Name" name="name" required>
                                <i class="fa fa-bell-concierge"></i>
                            </div>
                            <div class="input-group2">
                                <input id="desc" type="text" placeholder="Service Description" name="desc" required>
                                <i class="fa fa-file-lines"></i>
                            </div>
                            <div class="center">
                                <button type="button" class="btn btn-secondary shadow px-4" data-bs-dismiss="modal">Close</button>
                                <button class="btn btn-primary shadow px-4" type="submit" name="modifyServiceBtn">Modify</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END OF SERVICE MODAL -->

    <div class="center">
        <a href="index.php" class="active text-center">Return to main page.</a>
    </div>
    <?php include("../../include/footer.php"); ?>
</body>

</html>

<?php
if (isset($_POST['modifyCitizenBtn'])) {
    modifyCitizen();
}
if (isset($_POST['modifyFeedbackBtn'])) {
    modifyFeedback();
}
if (isset($_POST['modifyServiceBtn'])) {
    modifyService();
}
if (isset($_POST['deleteCitizenBtn'])) {
    deleteCitizen();
}
if (isset($_POST['deleteFeedbackBtn'])) {
    deleteFeedback();
}
if (isset($_POST['deleteServiceBtn'])) {
    deleteService();
}
?>