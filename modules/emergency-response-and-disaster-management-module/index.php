<?php
include("../../include/session.php");

$page_publisher = "https://facebook.com/melvinjonesrepol";
$page_modified_time = "2023-11-22T13:37:36+00:00";
$page_title = "Emergency Response and Disaster Management";
$page_description = "";
$page_keywords = "digital barangay, lgu, lgu management system";
$page_image = "https://digitalbarangay.com/images/cover.png";
$page_author = "Melvin Jones Repol";
$page_canonical = "https://digitalbarangay.com/modules/emergency-response-and-disaster-management-module/";
$page_url = $page_canonical;
$directory = "../../";
$directory_img = "../";
$recaptcha = true;

include("../../include/header.php");

?>

<body class="d-flex flex-column min-vh-100">

    <?php include("../../include/nav.php"); ?>

    <main>

        <div class="container pt-4 pt-xl-5 mb-5">
            <h1>Emergency Response and Disaster Management</h1>
            <p class="h5 mb-5">Preparedness, response and recovery, with the aim of minimizing the damage<br> and ensuring the safety and well-being of affected populations.
            </p>
            <div class="row g-0">
                <?php
                if (isAdmin()) {
                    echo '
                    <div class="col-md-4 p-3">
                    <button class="btn btn-primary px-5" id="addData">Add Emergency/Disaster</button>
                </div>
                    ';
                }
                ?>
                <div class="col-md-8 p-3">

                    <form action="<?php htmlspecialchars('php_self'); ?>" method="get">
                        <div class="search-container">
                            <?php
                            if (isset($_GET["q"]) && !empty($_GET["q"])) {
                                echo ' <input id="search" placeholder="Find alerts, emergencies..." type="text" name="q" value="' . $_GET["q"] . '">';
                            } else {
                                echo ' <input id="search" placeholder="Find alerts, emergencies..." type="text" name="q">';
                            }
                            ?>

                            <i class="fa-solid fa-magnifying-glass" id="but"></i>
                        </div>
                    </form>
                </div>
            </div>

            <?php
           
            ?>
        </div>

    </main>

    <?php
    $loadCustomJS = '<script src="../../js/er_dm.js"></script>';
    include("../../include/footer.php");
    ?>
</body>

</html>