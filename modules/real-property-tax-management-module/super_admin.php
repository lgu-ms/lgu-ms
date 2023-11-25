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
if (isLogin()) {
    $user_id = $_SESSION["user_id"];
    $isNotUser = mysqli_query($conn, "SELECT * FROM account WHERE _id = $user_id");
    if (mysqli_num_rows($isNotUser) > 0) {
        while ($row = mysqli_fetch_assoc($isNotUser)) {
            if ($row["user_type"] == "User") {
                http_response_code(403);
                die();
            }
        }
    }
} else {
    http_response_code(403);
    die();
}
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
            <h2 class="text-center mb-4">Property Owner</h2>
            <div class="table-responsive">
                <?php
                if (isset($_POST['findOwnerBtn'])) {
                    printModOwner();
                }
                getTables("property_owner", "0");
                ?>
            </div>
            <button class="btn btn-primary shadow px-4" style="align-items:center;" type="button" data-bs-toggle="modal" data-bs-target="#modRecordModal" onclick="changeType('Property Owner', 'findOwnerBtn')">Select Record</button>

            <h2 class="text-center mb-4" style="margin-top: 100px">Property</h2>
            <div class="table-responsive">
                <?php
                if (isset($_POST['findPropertyBtn'])) {
                    printModProperty();
                }
                getTables("property", "0");
                ?>
            </div>
            <button class="btn btn-primary shadow px-4" style="align-items:center;" type="button" data-bs-toggle="modal" data-bs-target="#modRecordModal" onclick="changeType('Property', 'findPropertyBtn')">Select Record</button>
            <h2 class="text-center mb-4" style="margin-top: 100px">Tax Record</h2>
            <div class="table-responsive">
                <?php
                getTables("tax_record", "display");
                ?>
            </div>

            <h2 class="text-center mb-4" style="margin-top: 100px">Transactions</h2>
            <div class="table-responsive">
                <?php
                getTables("transactions", "0");
                ?>
            </div>
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
                        <form class="p-4 p-md-5 bg-body-auto text-center" method="post">
                            <input id="find" type="number" placeholder="Enter Citizen Id:" name="find" required>
                            <button type="button" class="btn btn-secondary shadow px-4" data-bs-dismiss="modal">Close</button>
                            <button class="btn btn-primary shadow px-4 m-3" name="" id="findBtn">Select</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODIFY RECORD MODAL -->
    <div class="container">
        <div class="modal" id="modifyOwnerModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true" data-bs-backdrop="static">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modifyModalLabel">Modify Record <code>Property Owner</code></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
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
                                <button class="btn btn-primary shadow px-4" type="submit" name="modifyOwnerBtn">Modify</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END OF MODIFY RECORD MODAL -->

    <!-- MODIFY PROPERTY MODAL -->
    <div class="container">
        <div class="modal" id="modifyPropertyModal" tabindex="-1" aria-labelledby="feedbackModalLabel" aria-hidden="true" data-bs-backdrop="static">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modifyModalLabel">Modify Record <code>Property</code></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
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
                                    <li class="list-group-item list-group-item-secondary bg-transparent border-0">
                                        <input class="form-check-input me-1" type="radio" name="listGroupRadio" value="Single-Family Home" id="firstRadio" checked>
                                        <label class="form-check-label" for="firstRadio">Single-Family Home</label>
                                    </li>
                                    <li class="list-group-item list-group-item-secondary bg-transparent border-0">
                                        <input class="form-check-input me-1" type="radio" name="listGroupRadio" value="Condominium" id="secondRadio">
                                        <label class="form-check-label" for="secondRadio">Condominium (Condo) </label>
                                    </li>
                                    <li class="list-group-item list-group-item-secondary bg-transparent border-0">
                                        <input class="form-check-input me-1" type="radio" name="listGroupRadio" value="Apartment" id="thirdRadio">
                                        <label class="form-check-label" for="thirdRadio">Apartment</label>
                                    </li>
                                    <li class="list-group-item list-group-item-secondary bg-transparent border-0">
                                        <input class="form-check-input me-1" type="radio" name="listGroupRadio" value="Townhouse" id="fourthRadio">
                                        <label class="form-check-label" for="thirdRadio">Townhouse</label>
                                    </li>
                                    <li class="list-group-item list-group-item-secondary bg-transparent border-0">
                                        <input class="form-check-input me-1" type="radio" name="listGroupRadio" value="Duplex/Triplex" id="fifthRadio">
                                        <label class="form-check-label" for="thirdRadio">Duplex/Triplex</label>
                                    </li>
                                    <li class="list-group-item list-group-item-secondary bg-transparent border-0">
                                        <input class="form-check-input me-1" type="radio" name="listGroupRadio" value="Mobile/Manufactured Home" id="sixthRadio">
                                        <label class="form-check-label" for="thirdRadio">Mobile/Manufactured Home</label>
                                    </li>
                                    <li class="list-group-item list-group-item-secondary bg-transparent border-0">
                                        <input class="form-check-input me-1" type="radio" name="listGroupRadio" value="Vacant Land" id="seventhRadio">
                                        <label class="form-check-label" for="thirdRadio">Vacant Land</label>
                                    </li>
                                    <li class="list-group-item list-group-item-secondary bg-transparent border-0">
                                        <input class="form-check-input me-1" type="radio" name="listGroupRadio" value="Commercial Property" id="eightRadio">
                                        <label class="form-check-label" for="thirdRadio">Commercial Property</label>
                                    </li>
                                </ul>
                            </div>
                            <div class="text-center">
                                <button type="button" class="btn btn-secondary shadow px-4" data-bs-dismiss="modal">Close</button>
                                <button class="btn btn-primary shadow px-4" type="submit" name="modifyPropertyBtn">Modify</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END OF PROPERTY MODAL -->

    <div class="text-center">
        <a href="index.php" class="active text-center">Return to main page.</a>
    </div>
    <?php include("../../include/footer.php"); ?>
</body>

</html>

<?php
if (isset($_POST['modifyOwnerBtn'])) {
    modifyOwner();
}
if (isset($_POST['modifyPropertyBtn'])) {
    modifyProperty();
}
if (isset($_POST['deleteOwnerBtn'])) {
    deleteOwner();
}
if (isset($_POST['deletePropertyBtn'])) {
    deleteProperty();
}
?>