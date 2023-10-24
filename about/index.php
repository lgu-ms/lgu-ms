<?php
include("../include/session.php");

$page_publisher = "https://facebook.com/melvinjonesrepol";
$page_modified_time = "2023-10-25T23:37:36+00:00";
$page_title = "About Digital Barangay - A LGU Management System";
$page_description = "";
$page_keywords = "digital barangay, lgu, lgu management system";
$page_image = "http://localhost/lgu-ms/images/cover.png";
$page_author = "Melvin Jones Repol";
$page_canonical = "http://localhost/lgu-ms/about";
$page_url = $page_canonical;
$directory = "../";
$directory_img = "../";
$isForm = false;

include("../include/header.php");

?>

<body class="d-flex flex-column min-vh-100">
  <?php include("../include/nav.php"); ?>

  <header>
    <div class="container pt-4 pt-xl-5">
      <div class="row pt-5">
        <div class="col-md-8 col-xl-6 text-center text-md-start mx-auto">
          <div class="text-center">
            <h4 style="color: #4285f4;">Digital Barangay</h4>
            <h1 class="fw-bold">A LGU Management System</h1>
          </div>
        </div>
        <div class="col-12 col-lg-10 mx-auto">
          <div class="position-relative" style="display: flex;flex-wrap: wrap;justify-content: flex-end;">
            <div style="position: relative;flex: 0 0 45%;transform: translate3d(-15%, 35%, 0);"><img class="img-fluid shadow" data-bss-parallax="" data-bss-parallax-speed="0.8" src="https://source.unsplash.com/1080x700?support"></div>
            <div style="position: relative;flex: 0 0 45%;transform: translate3d(-5%, 20%, 0);"><img class="img-fluid shadow" data-bss-parallax="" data-bss-parallax-speed="0.4" src="https://source.unsplash.com/1080x700?management"></div>
            <div style="position: relative;flex: 0 0 60%;transform: translate3d(0, 0%, 0);"><img class="img-fluid shadow" data-bss-parallax="" data-bss-parallax-speed="0.25" src="https://source.unsplash.com/1080x700?government"></div>
          </div>
        </div>
      </div>
    </div>
  </header>

  <main class="text-center">
    <div class="container py-5">
      <div class="row">
        <div class="col-md-8 col-xl-6 text-center mx-auto">
          <h3 class="fw-bold">What we can do for you</h3>
        </div>
      </div>
      <div class="py-5 p-lg-5">
        more info here...
      </div>
    </div>
  </main>

  <?php include("../include/footer.php"); ?>
</body>

</html>