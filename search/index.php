<?php
include("../include/session.php");

$page_publisher = "https://facebook.com/melvinjonesrepol";
$page_modified_time = "2023-11-22T13:37:36+00:00";
$page_title = "Search - A LGU Management System";
$page_description = "";
$page_keywords = "digital barangay, lgu, lgu management system";
$page_image = "https://digitalbarangay.com/images/ogimage.png";
$page_author = "Melvin Jones Repol";
$page_canonical = "https://digitalbarangay.com/search";
$page_url = $page_canonical;
$directory = "../";
$directory_img = $directory;
$hideSearchBar = true;

include("../include/header.php");

?>

<body class="d-flex flex-column min-vh-100">

    <?php include("../include/nav.php"); ?>

    <main>

        <div class="container  mb-5">
            <h1>Digital Barangay Search</h1>
            <h4>Find information quickly...</h4>
            <script async src="https://cse.google.com/cse.js?cx=265058b6096cd42bf"></script>
            <div class="gcse-search"></div>
        </div>


    </main>
    <?php include("../include/footer.php"); ?>
</body>

</html>