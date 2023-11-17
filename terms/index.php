<?php
include("../include/session.php");

$page_publisher = "https://facebook.com/melvinjonesrepol";
$page_modified_time = "2023-11-17T13:37:36+00:00";
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
            <h1 class="border-bottom mb-5">Terms of Service</h1>
            <ol>
                <li>
                    <h3>Acceptance of Terms</h3>
                    <p>By accessing or using the Digital Barangay System ("the System"), you agree to comply with and be
                        bound by these Terms of Service. If you do not agree with these terms, please refrain from using
                        the System.</p>
                </li>
                <li>
                    <h3>Account Registration and Security</h3>
                    <p>
                    <ul>
                        <li>Users must provide accurate and complete information during registration.</li>
                        <li>Users are responsible for maintaining the confidentiality of their account credentials
                            and are liable for all activities conducted through their account.</li>
                    </ul>
                    </p>
                </li>
                <li>
                    <h3>Use of the System</h3>
                    <p>
                    <ul>
                        <li>Users agree not to engage in any activity that may disrupt the functionality of the System
                            or compromise its security.</li>
                        <li>Users must comply with all applicable laws and regulations while using the System.</li>
                    </ul>
                    </p>
                </li>
                <li>
                    <h3>Data Privacy</h3>
                    <p>
                    <ul>
                        <li>The System collects and processes personal information in accordance with our <a
                                href="../privacy/">Privacy Policy</a>.</li>
                        <li>Users have the right to access, correct, or delete their personal information as outlined in
                            the Privacy Policy.</li>
                    </ul>
                    </p>
                </li>
                <li>
                    <h3>Content and Intellectual Property</h3>
                    <p>
                    <ul>
                        <li>Users retain ownership of their content but grant the System a non-exclusive license to use,
                            display, and distribute the content within the System.</li>
                        <li>The System's content, including but not limited to logos, text, and graphics, is protected
                            by intellectual property laws and is the property of the System.</li>
                    </ul>
                    </p>
                </li>
                <li>
                    <h3>Limitation of Liability</h3>
                    <p>The System is provided "as is" without any warranty, and users use it at their own risk. The
                        System is not liable for any direct, indirect, incidental, consequential, or punitive damages
                        arising out of the use or inability to use the System.</p>
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