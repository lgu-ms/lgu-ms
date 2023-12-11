<?php
include("../include/session.php");

$page_publisher = "https://facebook.com/melvinjonesrepol";
$page_modified_time = "2023-11-22T13:37:36+00:00";
$page_title = "Terms of Service - Digital Barangay";
$page_description = "";
$page_keywords = "digital barangay, lgu, lgu management system";
$page_image = "https://digitalbarangay.com/images/ogimage.png";
$page_author = "Melvin Jones Repol";
$page_canonical = "https://digitalbarangay.com/terms/";
$page_url = $page_canonical;
$directory = "../";
$directory_img = $directory;

include("../include/header.php");

?>

<body class="d-flex flex-column min-vh-100">

    <?php include("../include/nav.php"); ?>

    <main>
        <div class="container pt-4 pt-xl-5">
            <h1 class="border-bottom mb-5"><?php echo $getString["terms_of_service"]; ?></h1>
            <ol>
                <li>
                    <h3><?php echo $getString["terms_header_1"]; ?></h3>
                    <p><?php echo $getString["terms_header_1_description"]; ?></p>
                </li>
                <li>
                    <h3><?php echo $getString["terms_header_2"]; ?></h3>
                    <p>
                    <ul>
                        <li><?php echo $getString["terms_header_2_option_1"]; ?></li>
                        <li><?php echo $getString["terms_header_2_option_2"]; ?></li>
                    </ul>
                    </p>
                </li>
                <li>
                    <h3><?php echo $getString["terms_header_3"]; ?></h3>
                    <p>
                    <ul>
                        <li><?php echo $getString["terms_header_3_option_1"]; ?></li>
                        <li><?php echo $getString["terms_header_3_option_2"]; ?></li>
                    </ul>
                    </p>
                </li>
                <li>
                    <h3><?php echo $getString["terms_header_4"]; ?></h3>
                    <p>
                    <ul>
                        <li><?php echo $getString["terms_header_4_option_1"]; ?></li>
                        <li><?php echo $getString["terms_header_4_option_2"]; ?></li>
                    </ul>
                    </p>
                </li>
                <li>
                    <h3><li><?php echo $getString["terms_header_5"]; ?></li></h3>
                    <p>
                    <ul>
                        <li><?php echo $getString["terms_header_5_option_1"]; ?></li>
                        <li><?php echo $getString["terms_header_5_option_2"]; ?></li>
                    </ul>
                    </p>
                </li>
                <li>
                    <h3><?php echo $getString["terms_header_6"]; ?></h3>
                    <p><li><?php echo $getString["terms_header_6_description"]; ?></li></p>
                </li>
                <li>
                    <h3>Modification of Terms</h3>
                    <p>The System reserves the right to modify these Terms of Service at any time. Users will be
                        notified of changes, and continued use of the System constitutes acceptance of the modified
                        terms.</p>
                </li>
                <li>
                    <h3>Termination</h3>
                    <p>The System reserves the right to terminate or suspend access to the System for any user who
                        violates these Terms of Service.</p>
                </li>
                <li>
                    <h3>Governing Law</h3>
                    <p>These Terms of Service are governed by and construed in accordance with the laws of Quezon City,
                        Philippines.</p>
                </li>
            </ol>
            <p class="h4 mt-5">By using the Digital Barangay System, you acknowledge that you have read, understood, and
                agree to these Terms of Service. If you have any questions, please contact <a
                    href="mailto:support@digitalbarangay.com">support@digitalbarangay.com</a></p>

        </div>
    </main>

    <?php include("../include/footer.php"); ?>
</body>

</html>