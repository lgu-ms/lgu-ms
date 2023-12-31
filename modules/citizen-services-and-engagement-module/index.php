<?php
include("../../include/session.php");

if (!isAdmin()) {
    http_response_code(403);
    die();
}

$page_publisher = "https://github.com/reyes-9";
$page_modified_time = "2023-10-08T13:37:36+00:00";
$page_title = "Citizen Services and Engagement Module";
$page_description = "";
$page_keywords = "digital barangay, lgu, lgu management system";
$page_image = "https://digitalbarangay.com/images/cover.png";
$page_author = "Enzo Reyes";
$page_canonical = "https://digitalbarangay.com/modules/citizen-services-and-engagement-module/";
$page_url = $page_canonical;
$directory = "../../";
$directory_img = "../../";
$isForm = false;

include("../../include/header.php");
?>

<body class="d-flex flex-column min-vh-100">

    <div class="main vh-100">
        <?php include("../../include/nav.php"); ?>

        <header>
            <div class="container pt-4 pt-xl-5">
                <div class="row pt-5">
                    <div class="col-md-8 col-xl-6 text-center text-md-start mx-auto">
                        <div class="text-center">
                            <h4 style="color: #4285f4;">Digital Barangay</h4>
                            <h1 class="fw-bold">Citizen Services and Engagement Module</h1>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div class="container mt-5" id="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <img src="../../images/citizen.jpg" class="rounded mx-auto d-block img-fluid" alt="Hero Image">
                </div>
                <div class="col-md-6">
                    <p>It is designed to enhance citizen-government interactions, improve service delivery, and foster civic engagement. This module leverages technology to provide citizens with easy access to government services, information, and resources, while also encouraging their active participation in community affairs. </p>
                    <a href="#sub" class="btn btn-primary shadow px-4">Get Started</a>
                    <a class="accnt px-3" href="../../login/index.php" style="margin: 10px;">Login</a>
                </div>
            </div>
        </div>
    </div>

    <!-- user management -->
    <div class="container" id="sub">
        <div class="container px-3 py-5">
            <h2 class="pb-2 border-bottom">Citizen Services and Engagement Module</h2>

            <div class="row row-cols-1 row-cols-md-2 align-items-md-center g-5 py-5">
                <div class="col d-flex flex-column align-items-start gap-2">
                    <h2>What it is?</h2>
                    <p> It is designed to enhance citizen-government interactions, improve service delivery, and foster civic engagement. This module leverages technology to provide citizens with easy access to government services, information, and resources, while also encouraging their active participation in community affairs.</p>
                </div>

                <div class="col">
                    <div class="row row-cols-1 row-cols-sm-2 g-4">
                        <div class="col d-flex flex-column gap-2">
                            <a href="staff.php" class="btn btn-primary shadow px-4" id="staffBtn">Staff</a>
                            <h4 class="fw-semibold mb-0">Staff</h4>
                            <p>People who intends to view the web application</p>
                        </div>

                        <div class="col d-flex flex-column gap-2">
                            <a href="admin.php" class="btn btn-primary shadow px-4" id="adminBtn">Admin</a>
                            <h4 class="fw-semibold mb-0">Admin</h4>
                            <p>People who manages the web application.</p>
                        </div>

                        <div class="col d-flex flex-column gap-2">
                            <a href="index.php" class="btn btn-primary shadow px-4 " id="user">User</a>
                            <h4 class="fw-semibold mb-0">User</h4>
                            <p>People who intends to view the web application.</p>
                        </div>

                        <div class="col d-flex flex-column gap-2">
                            <a href="super_admin.php" class="btn btn-primary shadow px-4" id="superAdminBtn">SuperAdmin</a>
                            <h4 class="fw-semibold mb-0">Super Administrator</h4>
                            <p>People who manages and administrate the web application</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- user management -->
    <?php include("../../include/footer.php"); ?>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

</html>

<?php

include("../../include/config.php");

$conn = new mysqli($mysql_address, $mysql_user, $mysql_password, $mysql_db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isLogin()) {
    echo '<script> alert("Please login to continue...");</script>';
    echo '<script>window.location.href = "../../login"</script>';
}


$id = $_SESSION["login_temp_user_id"];
$sql = "SELECT user_type FROM account WHERE _id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();


if ($result) {

    $row = $result->fetch_assoc();
    $userType = $row["user_type"];

    switch ($userType) {
        case "User":
            echo "<script>document.getElementById('adminBtn').classList.add('disabled');</script>";
            echo "<script>document.getElementById('superAdminBtn').classList.add('disabled');</script>";
            echo "<script>document.getElementById('staffBtn').classList.add('disabled');</script>";
            break;
        case "Staff":
            echo "<script>document.getElementById('adminBtn').classList.add('disabled');</script>";
            echo "<script>document.getElementById('superAdminBtn').classList.add('disabled');</script>";
            break;
        case "Admin":
            echo "<script>document.getElementById('staffBtn').classList.add('disabled');</script>";
            echo "<script>document.getElementById('superAdminBtn').classList.add('disabled');</script>";
            break;
        case "Super Admin":
            echo "<script>document.getElementById('adminBtn').classList.add('disabled');</script>";
            echo "<script>document.getElementById('staffBtn').classList.add('disabled');</script>";
            break;
        default:
            // Handle default case (if needed)
            break;
    }

    $result->free();
} else {
    echo "<script> alert('Error: Invalid Action'); </script>";
}

?>