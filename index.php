<?php
include("include/session.php");

$page_publisher = "https://facebook.com/melvinjonesrepol";
$page_modified_time = "2023-11-22T13:37:36+00:00";
$page_title = "Digital Barangay - A LGU Management System";
$page_description = "A comprehensive software solution designed to streamline and enhance the efficiency of LGU operations. This system integrates digital tools to facilitate transparent communication, automate administrative processes, and manage community resources, fostering a more responsive and connected governance structure.";
$page_keywords = "digital barangay, lgu, lgu management system";
$page_image = "https://digitalbarangay.com/images/ogimage.png";
$page_author = "Melvin Jones Repol";
$page_canonical = "https://digitalbarangay.com/";
$page_url = $page_canonical;
$directory = "";
$directory_img = "../";
$home = true;

include("include/header.php");
?>


<body class="d-flex flex-column min-vh-100">
    <style>
        .default-light {
            color: #90b8dd !important;
        }
    </style>
    <div class="video-background">
        <video autoplay muted loop playsinline class="video" class="lazy" poster="images/plain.jpeg">
            <source src="videos/intro.compressed.mp4" type="video/mp4">
            <source src="videos/intro.compressed.webm" type="video/webm">
        </video>

        <div class="header">
            <?php include("include/nav.php"); ?>
            <header>
                <img class="rounded mx-auto d-block img-fluid" src="images/dial122-web-banner-v2.jpg" alt="Banner"
                    width="500">

                <div class="card headerv5" style="background: transparent">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-4" id="mobile">
                                <img class="mx-auto d-block img-fluid" src="images/cover.png" width="320"
                                    alt="<?php echo $getString["site_name"]; ?>">
                            </div>
                            <div class="col-md-8">
                                <h5 class="txt-more default-light">#quezoncity</h5>
                                <h1 class="card-title"><strong class="default-light">
                                        <?php echo $getString["site_name"]; ?>
                                    </strong></h1>
                                <p class="card-text sub-title default-light">
                                    <?php echo $getString["site_description_1"]; ?> <small
                                        class="txt-more default-light">
                                        <?php echo $getString["site_description_2"]; ?>
                                    </small>
                                </p>
                                <br>
                                <a type="button" class="btn btn-primary shadow px-4" href="learnmore">
                                    <?php echo $getString["learn_more"]; ?>
                                </a>
                                <a type="button" class="btn btn-outline-primary px-4 default-light" href="milestone">
                                    <?php echo $getString["milestone"]; ?> <i class="fa-solid fa-chevron-right"></i>
                                </a>
                            </div>
                            <div class="col-md-4" id="desktop">
                                <img class="mx-auto d-block img-fluid" src="images/cover.png" width="320"
                                    alt="<?php echo $getString["site_name"]; ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </header>
        </div>
    </div>
    <main>
        <div class="container pt-4 pt-xl-5 mt-5">
            <div class="row pt-5">
                <div class="col-md-8 col-xl-6 text-center text-md-start mx-auto">
                    <div class="text-center mt-5">
                        <hr>
                        <h2 style="color: #4285f4;">
                            <?php echo $getString["qc_programs"]; ?>
                        </h2>
                    </div>
                </div>

                <div class="col-12 col-lg-10 mx-auto">
                    <div class="position-relative" style="display: flex;flex-wrap: wrap;justify-content: flex-end;">
                        <div style="position: relative;flex: 0 0 45%;transform: translate3d(-15%, 35%, 0);">
                            <img class="img-fluid shadow" data-bss-parallax="" data-bss-parallax-speed="0.8"
                                src="images/program1.jpg" title="<?php echo $getString["qc_programs_1"]; ?>">
                        </div>
                        <div style="position: relative;flex: 0 0 45%;transform: translate3d(-5%, 20%, 0);">
                            <img class="img-fluid shadow" data-bss-parallax="" data-bss-parallax-speed="0.4"
                                src="images/program2.jpg" title="<?php echo $getString["qc_programs_2"]; ?>">
                        </div>
                        <div style="position: relative;flex: 0 0 60%;transform: translate3d(0, 0%, 0);">
                            <img class="img-fluid shadow" data-bss-parallax="" data-bss-parallax-speed="0.25"
                                src="images/program3.webp" title="<?php echo $getString["qc_programs_3"]; ?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="container pt-4 pt-xl-5">
            <div class="col-md-8 col-xl-6 text-center text-md-start mx-auto">
                <div class="text-center">
                    <hr>
                    <h4>
                        <?php echo $getString["latest_news"]; ?>
                    </h4>
                </div>
            </div>
            <div class="card-group">
                <div class="card mb-3">
                    <img src="images/noimage.webp" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title">
                            <?php echo $getString["temp_news_header_1"]; ?>
                        </h5>
                        <p class="card-text">
                            <?php echo $getString["temp_news_description_1"]; ?>
                        </p>
                    </div>
                </div>
                <div class="card mb-3">
                    <img src="images/noimage.webp" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title">
                            <?php echo $getString["temp_news_header_2"]; ?>
                        </h5>
                        <p class="card-text">
                            <?php echo $getString["temp_news_description_2"]; ?>
                        </p>
                    </div>
                </div>
                <div class="card mb-3">
                    <img src="images/noimage.webp" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title">
                            <?php echo $getString["temp_news_header_3"]; ?>
                        </h5>
                        <p class="card-text">
                            <?php echo $getString["temp_news_description_3"]; ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div id="covidCaptions" class="carousel slide">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#covidCaptions" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#covidCaptions" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#covidCaptions" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner justify-content-center">
                <div class="carousel-item active">
                    <img src="images/cleaning_spray_closeup.jpg" class="d-block mx-auto w-50" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>
                            <?php echo $getString["test_carousel_header_1"]; ?>
                        </h5>
                        <p>
                            <?php echo $getString["test_carousel_sub_1"]; ?>
                        </p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="images/images.jpeg" class="d-block mx-auto w-50" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>
                            <?php echo $getString["test_carousel_header_2"]; ?>
                        </h5>
                        <p>
                            <?php echo $getString["test_carousel_sub_2"]; ?>
                        </p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="images/images (1).jpeg" class="d-block mx-auto w-50" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>
                            <?php echo $getString["test_carousel_header_3"]; ?>
                        </h5>
                        <p>
                            <?php echo $getString["test_carousel_sub_3"]; ?>
                        </p>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#covidCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">
                    <?php echo $getString["test_carousel_previous"]; ?>
                </span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#covidCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">
                    <?php echo $getString["test_carousel_next"]; ?>
                </span>
            </button>
        </div>
        <div class="container pt-4 pt-xl-5">
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-6 p-3">
                        <img class="img-fluid shadow" data-bss-parallax="" data-bss-parallax-speed="0.8"
                            src="images/qcmayor-2-1.png">
                    </div>
                    <div class="col-md-6 p-1">
                        <h2>
                            <?php echo $getString["container_bttm_header_1"]; ?>
                        </h2>
                        <?php echo $getString["container_bttm_sub_1"]; ?>
                    </div>
                </div>
            </div>
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-6 p-1">
                        <h2>
                            <?php echo $getString["container_bttm_header_2"]; ?>
                        </h2>
                        <?php echo $getString["container_bttm_sub_2"]; ?>
                    </div>
                    <div class="col-md-6 p-3">
                        <img class="img-fluid shadow" data-bss-parallax="" data-bss-parallax-speed="0.8"
                            src="images/The_Heart_of_Quezon_City.jpg">
                    </div>
                </div>
            </div>
            <div class="card mb-3 ">
                <div class="row g-0">
                    <div class="col-md-6 p-3">
                        <img class="img-fluid shadow" data-bss-parallax="" data-bss-parallax-speed="0.8"
                            src="images/cityhall.jpg">
                    </div>
                    <div class="col-md-6 p-1">
                        <h2><?php echo $getString["container_bttm_header_3"]; ?></h2>
                        <?php echo $getString["container_bttm_sub_3"]; ?>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php include("include/footer.php"); ?>
</body>

</html>