<?php
include("include/session.php");

$page_publisher = "https://facebook.com/melvinjonesrepol";
$page_modified_time = "2023-10-08T13:37:36+00:00";
$page_title = "Digital Barangay - A LGU Management System";
$page_description = "";
$page_keywords = "digital barangay, lgu, lgu management system";
$page_image = "http://localhost/lgu/images/cover.png";
$page_author = "Melvin Jones Repol";
$page_canonical = "http://localhost/lgu/";
$page_url = $page_canonical;
$directory = "";

include("include/header.php");

?>

<body class="d-flex flex-column min-vh-100">
    <?php include("include/nav.php"); ?>
    
    <main class="text-center">
        This is a test

        <h1 style="font-family: Poppins;">This is a poppins font</h1>
        <h1 style="font-family: Montserrat;">This is a montserrat font</h1>
    </main>
</body>

<?php
include("include/footer.php");
?>