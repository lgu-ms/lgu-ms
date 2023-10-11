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
$directory_img = "../";
$isForm = false;

include("include/header.php");

?>

<body class="d-flex flex-column min-vh-100">
    <?php include("include/nav.php"); ?>

    <header>
    <div class="card mb-3">
      <div class="row g-0">
        <div class="col-md-4" id="mobile">
          <img class="rounded mx-auto d-block img-fluid shadow"
            src="images/cover.png">
        </div>
        <div class="col-md-8">
          <div class="card-body">
            <h5 style="color: #4285f4;">Welcome to</h5>
            <h1 class="card-title"><strong>Digital Barangay</strong></h1>
            <p class="card-text sub-title">
              A proposed Local Government Unit Management<br>System Project</p>
              <br>
              <button type="button" class="btn btn-primary shadow">Learn more</button>
            <a class="accnt px-3">Procurement</a>
          </div>
        </div>
        <div class="col-md-4" id="desktop">
          <img class="rounded mx-auto d-block img-fluid shadow"
            src="images/cover.png">
        </div>
      </div>

    </div>
  </header>

  <main class="text-center">
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-xl-6  mx-auto">
          <h3 class="fw-bold">Here some info</h3>
        </div>
      </div>
      <div class="py-5 p-lg-5">
        and more info here...
      </div>
    </div>
  </main>
    <?php include("include/footer.php");?>
</body>
</html>
