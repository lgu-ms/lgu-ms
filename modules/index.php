<?php
include("../include/session.php");

$page_publisher = "https://facebook.com/melvinjonesrepol";
$page_modified_time = "2023-11-22T13:37:36+00:00";
$page_title = "Modules - Digital Barangay";
$page_description = "";
$page_keywords = "digital barangay, lgu, lgu management system";
$page_image = "https://digitalbarangay.com/images/ogimage.png";
$page_author = "Melvin Jones Repol";
$page_canonical = "https://digitalbarangay.com/modules/";
$page_url = $page_canonical;
$directory = "../";
$directory_img = $directory;

include("../include/header.php");

$modules = array("Citezen Services and Engagement", "Real Property Tax Managemet", "Business Permit and Licensing", "Land Use and Zoning", "Public Market and Vendors Management", "Financial Management and Budgeting", "Human Resources and Payroll", "Election and Voter Management", "Emergency Response and Disaster Management", "Solid Waste Management", "Infrastracture and Public Works", "Social Welfare and Community Development", "Health Services and Sanitation", "Document Management and Records", "GIS and Mapping", "Community Engagement and Communication", "Accessibility and Inclusion", "Analytics and Reporting", "Integration and Data Sharing");
$modulesIcon = array("fa-people-group", "fa-building-user", "fa-id-card", "fa-mountain-sun", "fa-shop", "fa-money-bill-wave", "fa-file-invoice", "fa-square-poll-vertical", "fa-truck-medical", "fa-dumpster", "fa-road", "fa-user", "fa-hand-holding-droplet", "fa-record-vinyl", "fa-map", "fa-people-roof", "fa-brands fa-accessible-icon", "fa-chart-pie", "fa-database");
$page = '
<div class="container pt-4 pt-xl-5" id="modulesList">
            <h1>Modules</h1>
            <p class="mb-4 h5">Integrate Digital Tools fostering a more responsive, connected and transparent governance structure.</p>
            <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <ul class="list-group mt-2 mb-2">
';

$count = 1;
foreach ($modules as $module) {

    $page .= '
    <li class="list-group-item d-flex justify-content-between align-items-start module-item">
    <i class="fa-solid ' . $modulesIcon[$count - 1] . '"></i>
    <div class="ms-2 me-auto module-742">
        <div class="fw-bold">Module ' . $count . '</div>
        ' . $module . '
    </div>
</li>
    ';
    if ($count % 5 == 0) {
        $page .= '
</ul>
</div>
<div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-xs-12">
<ul class="list-group mt-2 mb-2">
';
    }
    $count++;
}

$page .= '
</div>
</div>
'
    ?>

<body class="d-flex flex-column min-vh-100">

    <?php include("../include/nav.php"); ?>

    <main>
        <?php echo $page; ?>
    </main>

    <?php include("../include/footer.php"); ?>
</body>

</html>