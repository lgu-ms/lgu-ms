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


<body class="d-flex flex-column ">
    <?php include("../../include/nav.php");
    include("process.php");
    ?>

    <header>
        <div class="container pt-4 pt-xl-5">
            <div class="row pt-5">
                <div class="col-md-8 col-xl-6 text-center text-md-start mx-auto">
                    <div class="text-center">
                        <h4 style="color: #4285f4;">Digital Barangay</h4>
                        <h1 class="fw-bold">Managers</h1>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container mt-5">
        <h2 class="text-center mb-4">Property Owner</h2>
        <div class="table-responsive">

            <?php
            getTables("property_owner", "0");
            ?>

        </div>

        <h2 class="text-center mb-4" style="margin-top: 100px">Property</h2>
        <div class="table-responsive">
            <?php
            getTables("property", "0");
            ?>
        </div>

        <h2 class="text-center mb-4" style="margin-top: 100px">Tax Records</h2>
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


    <!-- MODAl -->
    <div class="text-center m-2">
        <button type="button" class="btn btn-primary shadow px-4 m-3" data-bs-toggle="modal" data-bs-target="#serviceModal">
            Pay Taxes
        </button>
    </div>

    <!-- TAX PAYMENT -->
    <div class="container">
        <div class="modal" id="serviceModal" tabindex="-1" aria-labelledby="requestModalLabel" aria-hidden="true" data-bs-backdrop="static">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="requestModalLabel">Pay Taxes</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-1">
                        <form class="p-md-4 bg-body-auto text-center" id="find_tax_record" method="post">
                            <input id="find" type="number" placeholder="Enter Tax Id:" name="find" required>
                            <button type="button" class="btn btn-secondary shadow px-4 m-2" data-bs-dismiss="modal">Close</button>
                            <button class="btn btn-primary shadow px-4 m-2" name="findBtn" id="findBtn">Find Record</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- END OF MODAl -->
    <div class="container text-center">
        <div class="table-responsive">
            <?php
            getTables("tax_record", "manage");
            ?>
        </div>
    </div>
    <div class="text-center m-5">
        <a href="index.php" class="active text-center">Return to main page.</a>
    </div>
    <?php include("../../include/footer.php"); ?>
</body>

</html>

<?php
if (isset($_POST['paymentBtn'])) {
    paytax();
}

?>