<?php
include("../../include/session.php");

$page_publisher = "https://github.com/reyes-9";
$page_modified_time = "2023-10-08T13:37:36+00:00";
$page_title = "Real Property Tax Module";
$page_description = "";
$page_keywords = "digital barangay, lgu, lgu management system";
$page_image = "https://digitalbarangay.com/images/ogimage.png";
$page_author = "Enzo Reyes";
$page_canonical = "https://digitalbarangay.com/modules/real-property-tax-management-module/";
$page_url = $page_canonical;
$directory = "../../";
$directory_img = "../../";
$isForm = false;

include("../../include/header.php");
?>

<style>
    .bg-transparent {
        background-color: transparent !important;
        border: none;
        color: grey;
    }
</style>

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
                    <h1 class="display-4 fw-bold lh-1 mb-3">Register Owner</h1>
                    <p class="col-lg-10 fs-5">Real Property Tax, also known as property tax, is a recurring fee imposed by local governments on property owners. It is typically based on the assessed value of real estate properties, including land, buildings, and sometimes personal property located on the premises..</p>
                </div>
                <div class="col-md-10 mx-auto col-lg-5">
                    <form class="p-4 p-md-5 bg-body-auto" method="post">
                        <h3>Property Owner
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

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="col-md-12">
                    <form class="p-4 p-md-5" method="post">
                        <h3 class="text-center">Register Property
                            <hr>
                        </h3>
                        <h4 class="text-center">Property Address</h4>
                        <div class="row g-3">
                            <div class="col-md-6" style="padding: 0; ">
                                <div class="input-group2 m-2">
                                    <input id="houseNo" type="text" placeholder="Unit / House Number" name="houseNo" required>
                                    <i class="fa fa-home"></i>
                                </div>
                            </div>
                            <div class="col-md-6" style="padding: 0;">
                                <div class="input-group2 m-2">
                                    <input id="street" type="text" placeholder="Street" name="street" required>
                                    <i class="fa fa-road"></i>
                                </div>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6" style="padding: 0;">
                                <div class="input-group2 m-2">
                                    <input id="barangay" type="text" placeholder="Barangay" name="barangay" required>
                                    <i class="fa fa-building"></i>
                                </div>
                            </div>
                            <div class="col-md-6" style="padding: 0;">
                                <div class="input-group2 m-2">
                                    <input id="city" type="text" placeholder="City / Municipality" name="city" required>
                                    <i class="fa fa-city"></i>
                                </div>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6" style="padding: 0;">
                                <div class="input-group2 m-2">
                                    <input id="province" type="text" placeholder="Province" name="province" required>
                                    <i class="fa fa-globe"></i>
                                </div>
                            </div>
                        </div>

                        <h4 class="text-center">Property Value</h4>
                        <div class="input-group2">
                            <input id="propertyValue" type="number" placeholder="$ Property Value" name="propertyValue" required>
                        </div>

                        <div class="input-group2">
                            <h4 class="text-center m-4">Property Types</h4>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item list-group-item-secondary bg-transparent">
                                    <input class="form-check-input me-1" type="radio" name="listGroupRadio" value="Single-Family Home" id="firstRadio" checked>
                                    <label class="form-check-label" for="firstRadio">Single-Family Home</label>
                                </li>
                                <li class="list-group-item list-group-item-secondary bg-transparent">
                                    <input class="form-check-input me-1" type="radio" name="listGroupRadio" value="Condominium" id="secondRadio">
                                    <label class="form-check-label" for="secondRadio">Condominium (Condo) </label>
                                </li>
                                <li class="list-group-item list-group-item-secondary bg-transparent">
                                    <input class="form-check-input me-1" type="radio" name="listGroupRadio" value="Apartment" id="thirdRadio">
                                    <label class="form-check-label" for="thirdRadio">Apartment</label>
                                </li>
                                <li class="list-group-item list-group-item-secondary bg-transparent">
                                    <input class="form-check-input me-1" type="radio" name="listGroupRadio" value="Townhouse" id="fourthRadio">
                                    <label class="form-check-label" for="thirdRadio">Townhouse</label>
                                </li>
                                <li class="list-group-item list-group-item-secondary bg-transparent">
                                    <input class="form-check-input me-1" type="radio" name="listGroupRadio" value="Duplex/Triplex" id="fifthRadio">
                                    <label class="form-check-label" for="thirdRadio">Duplex/Triplex</label>
                                </li>
                                <li class="list-group-item list-group-item-secondary bg-transparent">
                                    <input class="form-check-input me-1" type="radio" name="listGroupRadio" value="Mobile/Manufactured Home" id="sixthRadio">
                                    <label class="form-check-label" for="thirdRadio">Mobile/Manufactured Home</label>
                                </li>
                                <li class="list-group-item list-group-item-secondary bg-transparent">
                                    <input class="form-check-input me-1" type="radio" name="listGroupRadio" value="Vacant Land" id="seventhRadio">
                                    <label class="form-check-label" for="thirdRadio">Vacant Land</label>
                                </li>
                                <li class="list-group-item list-group-item-secondary bg-transparent">
                                    <input class="form-check-input me-1" type="radio" name="listGroupRadio" value="Commercial Property" id="eightRadio">
                                    <label class="form-check-label" for="thirdRadio">Commercial Property</label>
                                </li>
                            </ul>
                        </div>
                        <div class="text-center">
                            <button id="regPropertyBtn" name="regPropertyBtn" class="btn btn-primary px-4 shadow mx-auto my-auto">Register Property</button>
                        </div>

                    </form>
                </div>
            </div>

            <div class="col-md-6">
                <div class="col-md-12">
                    <form class="p-4 p-md-5" method="post">
                        <h3 class="text-center">View Tax Record
                            <hr>
                        </h3>
                        <h4 class="text-center m-4">Property Owner</h4>
                        <div class="input-group2">
                            <input id="fname" type="text" placeholder="First Name" name="fname" required>
                            <i class="fa fa-user"></i>
                        </div>
                        <div class="input-group2">
                            <input id="lname" type="text" placeholder="Last Name" name="lname" required>
                            <i class="fa fa-user"></i>
                        </div>

                        <h4 class="text-center m-4">Address</h4>
                        <div class="row g-3">
                            <div class="col-md-6" style="padding: 0; ">
                                <div class="input-group2 m-2">
                                    <input id="houseNo" type="text" placeholder="Unit / House Number" name="houseNo" required>
                                    <i class="fa fa-home"></i>
                                </div>
                            </div>
                            <div class="col-md-6" style="padding: 0;">
                                <div class="input-group2 m-2">
                                    <input id="street" type="text" placeholder="Street" name="street" required>
                                    <i class="fa fa-road"></i>
                                </div>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6" style="padding: 0;">
                                <div class="input-group2 m-2">
                                    <input id="barangay" type="text" placeholder="Barangay" name="barangay" required>
                                    <i class="fa fa-building"></i>
                                </div>
                            </div>
                            <div class="col-md-6" style="padding: 0;">
                                <div class="input-group2 m-2">
                                    <input id="city" type="text" placeholder="City / Municipality" name="city" required>
                                    <i class="fa fa-city"></i>
                                </div>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6" style="padding: 0;">
                                <div class="input-group2 m-2">
                                    <input id="province" type="text" placeholder="Province" name="province" required>
                                    <i class="fa fa-globe"></i>
                                </div>
                            </div>
                        </div>
                        <h4 class="text-center m-4">Property Types</h4>
                        <div class="input-group2">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item list-group-item-secondary bg-transparent">
                                    <input class="form-check-input me-1" type="radio" name="listGroupRadio" value="Single-Family Home" id="firstRadio" checked>
                                    <label class="form-check-label" for="firstRadio">Single-Family Home</label>
                                </li>
                                <li class="list-group-item list-group-item-secondary bg-transparent">
                                    <input class="form-check-input me-1" type="radio" name="listGroupRadio" value="Condominium" id="secondRadio">
                                    <label class="form-check-label" for="secondRadio">Condominium (Condo) </label>
                                </li>
                                <li class="list-group-item list-group-item-secondary bg-transparent">
                                    <input class="form-check-input me-1" type="radio" name="listGroupRadio" value="Apartment" id="thirdRadio">
                                    <label class="form-check-label" for="thirdRadio">Apartment</label>
                                </li>
                                <li class="list-group-item list-group-item-secondary bg-transparent">
                                    <input class="form-check-input me-1" type="radio" name="listGroupRadio" value="Townhouse" id="fourthRadio">
                                    <label class="form-check-label" for="thirdRadio">Townhouse</label>
                                </li>
                                <li class="list-group-item list-group-item-secondary bg-transparent">
                                    <input class="form-check-input me-1" type="radio" name="listGroupRadio" value="Duplex/Triplex" id="fifthRadio">
                                    <label class="form-check-label" for="thirdRadio">Duplex/Triplex</label>
                                </li>
                                <li class="list-group-item list-group-item-secondary bg-transparent">
                                    <input class="form-check-input me-1" type="radio" name="listGroupRadio" value="Mobile/Manufactured Home" id="sixthRadio">
                                    <label class="form-check-label" for="thirdRadio">Mobile/Manufactured Home</label>
                                </li>
                                <li class="list-group-item list-group-item-secondary bg-transparent">
                                    <input class="form-check-input me-1" type="radio" name="listGroupRadio" value="Vacant Land" id="seventhRadio">
                                    <label class="form-check-label" for="thirdRadio">Vacant Land</label>
                                </li>
                                <li class="list-group-item list-group-item-secondary bg-transparent">
                                    <input class="form-check-input me-1" type="radio" name="listGroupRadio" value="Commercial Property" id="eightRadio">
                                    <label class="form-check-label" for="thirdRadio">Commercial Property</label>
                                </li>
                            </ul>
                        </div>
                        <div class="text-center">
                            <button id="viewTaxBtn" name="viewTaxBtn" class="btn btn-primary px-4 shadow mx-auto my-auto">View Tax Record</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center">
        <a href="index.php" class="active text-center">Return to main page.</a>
    </div>

    <?php include("../../include/footer.php"); ?>
</body>

</html>

<?php
if (!isLogin()) {
    echo '<script> alert("Please login to continue...");</script>';
    echo '<script>window.location.href = "../../login"</script>';
}
include("process.php");
if (isset($_POST['regBtn'])) {
    register();
}
if (isset($_POST['regPropertyBtn'])) {
    submitProperty();
}
if (isset($_POST['viewTaxBtn'])) {
    viewTax();
}
?>