<?php
include("../include/session.php");

$page_publisher = "https://facebook.com/melvinjonesrepol";
$page_modified_time = "2023-11-17T13:37:36+00:00";
$page_title = "Digital Barangay - A LGU Management System";
$page_description = "";
$page_keywords = "digital barangay, lgu, lgu management system";
$page_image = "https://digitalbarangay.com/images/ogimage.png";
$page_author = "Melvin Jones Repol";
$page_canonical = "https://digitalbarangay.com/milestone";
$page_url = $page_canonical;
$directory = "../";
$directory_img = "../";

include("../include/header.php");
?>

<body class="d-flex flex-column min-vh-100">
  <?php include("../include/nav.php"); ?>

  <main>
    <div class="container pt-4 pt-xl-5 mt-5 mb-5">
      <div class="row pt-5">
        <div class="col-md-8 col-xl-6 text-center text-md-start mx-auto">
          <div class="text-center">
            <h4 style="color: #4285f4;">Our Milestone</h4>
          </div>
        </div>
        <div class="col-12 col-lg-10 mx-auto">
          <div class="position-relative" style="display: flex;flex-wrap: wrap;justify-content: flex-end;">
            <div style="position: relative;flex: 0 0 45%;transform: translate3d(-15%, 35%, 0);">
              <img class="img-fluid shadow" data-bss-parallax="" data-bss-parallax-speed="0.8" src="https://source.unsplash.com/1080x700?support">
            </div>
            <div style="position: relative;flex: 0 0 45%;transform: translate3d(-5%, 20%, 0);">
              <img class="img-fluid shadow" data-bss-parallax="" data-bss-parallax-speed="0.4" src="https://source.unsplash.com/1080x700?management">
            </div>
            <div style="position: relative;flex: 0 0 60%;transform: translate3d(0, 0%, 0);">
              <img class="img-fluid shadow" data-bss-parallax="" data-bss-parallax-speed="0.25" src="https://source.unsplash.com/1080x700?government">
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container mt-5">

      <div class="row">
        <div class="col-12">
          <div class="timeline-page position-relative">
          <div class="timeline-item">
              <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 order-sm-1 order-2 mt-4 mt-sm-0">
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 order-sm-2 order-1">
                  <div class="duration duration-right position-relative">
                  <i class="fa-solid fa-play fa-3x"></i>
                    <h5 class="my-2">Project Start</h5>
                    <small class="text-muted mb-0">8/10/2023</small>
                    <p class="timeline-subtitle mb-0 text-muted">This where it begins.</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="timeline-item mt-5 pt-4">
              <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                  <div class="duration date-label-left position-relative text-md-end">
                    <i class="fa-solid fa-magnifying-glass fa-3x"></i>
                    <h5 class="my-2">Requiremets Gathering</h5>
                    <small class="text-muted mb-0">8/11/2023</small>
                    <p class="timeline-subtitle mb-0 text-muted">All requirements for LGU Project must be determined before desinging the system.</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="timeline-item mt-5 pt-4">
              <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 order-sm-1 order-2 mt-4 mt-sm-0">
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 order-sm-2 order-1">
                  <div class="duration duration-right position-relative">
                  <i class="fa-solid fa-compass-drafting fa-3x"></i>
                    <h5 class="my-2">Complete Design</h5>
                    <small class="text-muted mb-0">9/16/2023</small>
                    <p class="timeline-subtitle mb-0 text-muted">This is the theoretical design for the website and mobile app with its functionality.</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="timeline-item mt-5 pt-4">
              <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 mt-4 mt-sm-0">
                  <div class="duration date-label-left position-relative text-md-end">
                  <i class="fa-solid fa-check fa-3x"></i>
                    <h5 class="my-2">Complete Coding</h5>
                    <small class="text-muted mb-0">10/30/2023</small>
                    <p class="timeline-subtitle mb-0 text-muted">All coding completed resulting in web-based and mobile prototype.</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="timeline-item mt-5 pt-4">
              <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 order-sm-1 order-2 mt-4 mt-sm-0">
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 order-sm-2 order-1">
                  <div class="duration duration-right position-relative">
                  <i class="fa-solid fa-check-double fa-3x"></i>
                    <h5 class="my-2">Complete Testing and Debugging</h5>
                    <small class="text-muted mb-0">11/10/2023</small>
                    <p class="timeline-subtitle mb-0 text-muted">All functionality tested and all identified errors corrected.</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="timeline-item mt-5 pt-4">
              <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 mt-4 mt-sm-0">
                  <div class="duration date-label-left position-relative text-md-end">
                    <i class="fa-solid fa-flag fa-3x"></i>
                    <h5 class="my-2">Project Closure of LGU Project</h5>
                    <small class="text-muted mb-0">11/30/2023</small>
                    <p class="timeline-subtitle mb-0 text-muted">Completed software and documentation transitioned to operations group to begin production.</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="timeline-item mt-5 pt-4">
              <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 order-sm-1 order-2 mt-4 mt-sm-0">
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 order-sm-2 order-1">
                  <div class="duration duration-right position-relative">
                  <i class="fa-solid fa-server fa-3x"></i>
                    <h5 class="my-2">Deployment</h5>
                    <small class="text-muted mb-0">11/31/2023</small>
                    <p class="timeline-subtitle mb-0 text-muted">The operation team will now deploy the project to production.</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="timeline-item mt-5 pt-4">
              <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 mt-4 mt-sm-0">
                  <div class="duration date-label-left position-relative text-md-end">
                  <i class="fa-solid fa-square-check fa-3x"></i>
                    <h5 class="my-2">Project Complete</h5>
                    <small class="text-muted mb-0">11/32/2023</small>
                    <p class="timeline-subtitle mb-0 text-muted">The End.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <?php include("../include/footer.php"); ?>
</body>

</html>