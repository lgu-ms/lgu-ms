<?php
include("../../include/session.php");

$page_publisher = "https://facebook.com/melvinjonesrepol";
$page_modified_time = "2023-10-08T13:37:36+00:00";
$page_title = "Digital Barangay - A LGU Management System";
$page_description = "";
$page_keywords = "digital barangay, lgu, lgu management system";
$page_image ="https://digitalbarangay.com/images/ogimage.png";
$page_author = "Melvin Jones Repol";
$page_canonical = "https://digitalbarangay.com/modules/land-use-and-zoning-module/";
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
                    <h1 class="display-4 fw-bold lh-1 mb-3">Register for Land Use and Zoning</h1>
                    <p class="col-lg-10 fs-5">Zoning districts are often created based on comprehensive community planning efforts. These plans take into account factors such as transportation needs, environmental conservation, housing requirements, and economic development goals.</p>
                </div>
                <div class="col-md-10 mx-auto col-lg-5">
                    <form class="p-4 p-md-5 bg-body-auto" id="register1">
                        <h3>Prperty Owner</h3>
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
                        <a href="#form" class="btn btn-primary shadow px-4" id="reduced">Proceed</a>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <!-- FORM -->
    <div class="col-md-10 mx-auto col-lg-10" id="form">
        <div class="row">
            <div class="col-md-6">
                <!-- Content for the first column goes here -->
                <form class="p-4 p-md-5 bg-body-auto" id="reg-stall">
                    <h3>Land Parcel</h3>
                    <div class="input-group2">
                        <input id="parcel-address" type="text" placeholder="Parcel Address" name="parcel-address" required>
                        <i class="fa fa-map"></i>
                    </div>
                    <div class="input-group2">
                        <input id="land-use" type="text" placeholder="Land Use" name="land-use" required>
                        <i class="fa fa-building"></i>
                    </div>
                </form>
            </div>

            <div class="col-md-6">
                <!-- Content for the second column goes here -->
                <form class="p-4 p-md-5 bg-body-auto" id="regProd">
                    <h3>Zoning District</h3>
                    <div class="input-group2">
                        <input id="district-name" type="text" placeholder="District Name" name="district-name" required>
                        <i class="fa fa-user"></i>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-6">
            <!-- Content for the first column goes here -->
            <form class="p-4 p-md-5 bg-body-auto" id="reg-stall">
                <h3>Land Use Permit</h3>
                <div class="input-group2">
                    <input id="permit-type" type="text" placeholder="Permit Type" name="permit-type" required>
                    <i class="fa fa-tag"></i>
                </div>
            </form>
        </div>
        <div class="center">
            <button id="register" class="btn btn-primary px-5 shadow mx-auto my-auto">Register</button>
        </div>

    </div>

    <!-- FORM -->
    <div class="center">
        <a href="index.php" class="active text-center">Return to main page.</a>
    </div>
    <?php include("../../include/footer.php"); ?>
</body>

</html>