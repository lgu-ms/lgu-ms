<?php
include("../../include/session.php");

$page_publisher = "https://github.com/reyes-9";
$page_modified_time = "2023-11-22T13:37:36+00:00";
$page_title = "Public Market And Vendors Management Module";
$page_description = "";
$page_keywords = "digital barangay, lgu, lgu management system";
$page_image = "https://digitalbarangay.com/images/cover.png";
$page_author = "Enzo Reyes, Melvin Jones Repol";
$page_canonical = "https://digitalbarangay.com/modules/public-market-and-vendors-management-module/";
$page_url = $page_canonical;
$directory = "../../";
$directory_img = "../";

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

include("../../include/header.php");
echo '<link rel="stylesheet" href="../../css/public-market-module.css">';
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
                            <h1 class="fw-bold">Public Market And Vendors Management Module</h1>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div class="container mt-5" id="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <img src="<?php echo $directory; ?>images/market.jpg" class="rounded mx-auto d-block img-fluid"
                        alt="Hero Image">
                </div>
                <div class="col-md-6">
                    <p>A Public Market and Vendors Management Module offers numerous advantages for a city. It ensures
                        efficient
                        vendor management, regulatory compliance, and fair stall allocation. By facilitating transparent
                        communication, providing valuable insights through data analysis, and enhancing the public
                        experience with
                        digital navigation and security measures, the module contributes to vibrant, well-organized
                        markets.
                        Additionally, it supports local businesses, promotes economic growth, and optimizes resource
                        usage,
                        ultimately enriching the city's development and public satisfaction.</p>
                    <a href="#sub" class="btn btn-primary shadow px-4" id="reduced">Get Started</a>
                    <a class="accnt px-3" href="<?php echo $directory; ?>login" style="margin: 10px;">Login</a>
                </div>
            </div>
        </div>
    </div>

    <!-- market management -->
    <div class="container" id="sub">
        <div class="container px-3 py-5">
            <h2 class="pb-2 border-bottom">Market And Vendors Management</h2>

            <div class="row row-cols-1 row-cols-md-2 align-items-md-center g-5 py-5">
                <div class="col d-flex flex-column align-items-start gap-2">
                    <h2>What it is?</h2>
                    <p> It is the process of overseeing and organizing the activities related to markets (physical or
                        online) and
                        the vendors who sell products or services within those markets. This function involves various
                        tasks and
                        responsibilities to ensure the smooth operation of the market and the success of the vendors.
                        Here are some
                        key aspects of Market and Vendors Management</p>
                </div>

                <div class="col">
                    <div class="row row-cols-1 row-cols-sm-2 g-4">
                        <div class="col d-flex flex-column gap-2">
                            <a href="users.php" class="btn btn-primary shadow px-4" id="reduced">Users</a>
                            <h4 class="fw-semibold mb-0">Users</h4>
                            <p>People who intends to use the web application</p>
                        </div>

                        <div class="col d-flex flex-column gap-2">
                            <a href="#sub" class="btn btn-primary shadow px-4" id="reduced">Managers</a>
                            <h4 class="fw-semibold mb-0">Managers</h4>
                            <p>People who manages the web application.</p>
                        </div>

                        <div class="col d-flex flex-column gap-2">
                            <a href="#sub" class="btn btn-primary shadow px-4" id="reduced">Visitors</a>
                            <h4 class="fw-semibold mb-0">Site Visitors</h4>
                            <p>People who intends to view the web application.</p>
                        </div>

                        <div class="col d-flex flex-column gap-2">
                            <a href="#sub" class="btn btn-primary shadow px-4" id="reduced">Admin</a>
                            <h4 class="fw-semibold mb-0">Administrator</h4>
                            <p>People who manages and administrate the web application</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- market management -->
</body>

<?php include("../../include/footer.php"); ?>

</html>
<?php
if (!isLogin()) {
    echo '<script> alert("Please login to continue...");</script>';
    echo '<script>window.location.href = "../../login"</script>';
  }
?>