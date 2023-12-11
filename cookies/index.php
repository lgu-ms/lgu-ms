<?php
include("../include/session.php");

$page_publisher = "https://facebook.com/melvinjonesrepol";
$page_modified_time = "2023-11-22T13:37:36+00:00";
$page_title = "Cookies Policy - Digital Barangay";
$page_description = "";
$page_keywords = "digital barangay, lgu, lgu management system";
$page_image = "https://digitalbarangay.com/images/ogimage.png";
$page_author = "Melvin Jones Repol";
$page_canonical = "https://digitalbarangay.com/privacy/";
$page_url = $page_canonical;
$directory = "../";
$directory_img = $directory;

include("../include/header.php");

?>

<body class="d-flex flex-column min-vh-100">

    <?php include("../include/nav.php"); ?>

    <main>
        <div class="container pt-4 pt-xl-5">
            <h1 class="border-bottom">
                <?php echo $getString["cookies_policy"]; ?>
            </h1>
            <p>
                <?php echo $getString["cookies_policy_description"]; ?>
            </p>
            <ol>
                <li>
                    <h3>
                        <?php echo $getString["cookies_header_1"]; ?>
                    </h3>
                    <p>
                        <?php echo $getString["cookies_header_1_desription"]; ?>
                    </p>
                </li>
                <li>
                    <h3>
                        <?php echo $getString["cookies_header_2"]; ?>
                    </h3>
                    <p>
                    <ul>
                        <li>
                            <?php echo $getString["cookies_header_2_option_1"]; ?>
                        </li>
                        <li>
                            <?php echo $getString["cookies_header_2_option_2"]; ?>
                        </li>
                        <li>
                            <?php echo $getString["cookies_header_2_option_3"]; ?>
                        </li>
                    </ul>
                    </p>
                </li>
                <li>
                    <h3>
                        <?php echo $getString["cookies_header_3"]; ?>
                    </h3>
                    <p>
                    <ul>
                        <li>
                            <?php echo $getString["cookies_header_3_option_1"]; ?>
                        </li>
                        <li>
                            <?php echo $getString["cookies_header_3_option_2"]; ?>
                        </li>
                        <li>
                            <?php echo $getString["cookies_header_3_option_3"]; ?>
                        </li>
                    </ul>
                    </p>
                </li>
                <li>
                    <h3><?php echo $getString["cookies_header_4"]; ?></h3>
                    <p><?php echo $getString["cookies_header_4_description"]; ?></p>
                </li>
                <li>
                    <h3><?php echo $getString["cookies_header_5"]; ?></h3>
                    <p>
                    <ul>
                        <li><?php echo $getString["cookies_header_5_option_1"]; ?></li>
                        <li><?php echo $getString["cookies_header_5_option_2"]; ?></li>
                    </ul>
                    </p>
                </li>
                <li>
                    <h3><?php echo $getString["cookies_header_6"]; ?></h3>
                    <p><?php echo $getString["cookies_header_6_description"]; ?></p>
                </li>
                <li>
                    <h3><?php echo $getString["cookies_header_7"]; ?></h3>
                    <p><?php echo sprintf($getString["cookies_header_7_description"], "<a href=\"mailto:support@digitalbarangay.com\">support@digitalbarangay.com</a>"); ?></p>
                </li>
            </ol>
            <p class="h4 mt-5"><?php echo $getString["cookies_footer"]; ?></p>

        </div>
    </main>

    <?php include("../include/footer.php"); ?>
</body>

</html>