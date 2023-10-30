<?php
include("include/session.php");

$page_publisher = "https://facebook.com/melvinjonesrepol";
$page_modified_time = "2023-10-08T13:37:36+00:00";
$page_title = "Digital Barangay - A LGU Management System";
$page_description = "";
$page_keywords = "digital barangay, lgu, lgu management system";
$page_image = "http://localhost/lgu-ms/images/ogimage.png";
$page_author = "Melvin Jones Repol";
$page_canonical = "http://localhost/lgu-ms/";
$page_url = $page_canonical;
$directory = "";
$directory_img = "../";
$isForm = false;

include("include/header.php");
?>

<body class="d-flex flex-column min-vh-100">
  <div class="video-background">
    <video autoplay muted loop playsinline class="video" class="lazy">
      <source src="videos/intro.compressed.webm" type="video/webm">
      <source src="videos/intro.compressed.mp4" type="video/mp4">
    </video>

    <div class="header">
      <?php include("include/nav.php"); ?>
      <header>
        <div class="card mb-3" style="background: transparent">
          <div class="card-body">
            <div class="row">
              <div class="col-md-4 mb-5" id="mobile">
                <img class="rounded mx-auto d-block img-fluid" src="images/cover.png" width="270">
              </div>
              <div class="col-md-8">
                <h5 style="color: #4285f4;">#quezoncity</h5>
                <h1 class="card-title"><strong>Digital Barangay</strong></h1>
                <p class="card-text sub-title">
                  A proposed Local Government Unit Management<br>System Project</p>
                <br>
                <a type="button" class="btn btn-primary shadow px-4" href="learnmore">Learn more</a>
                <a type="button" class="btn btn-outline-primary px-4" href="milestone">Milestone</a>
              </div>
              <div class="col-md-4" id="desktop">
                <img class="rounded mx-auto d-block img-fluid" src="images/cover.png" width="270">
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
          <div class="text-center">
            <h4 style="color: #4285f4;">Lorem Ipsum Dolor</h4>
            <p class="fw-bold">Nunc quis neque id libero bibendum posuere a ut nunc.</p>
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
    <br>
    <div class="container pt-4 pt-xl-5">
      <div class="text-center">
        <h4>The Lorem Ipsum Dolor</h4>
      </div>
      <div class="card-group">
        <div class="card mb-3">
          <img src="https://source.unsplash.com/1080x700?support" class="card-img-top">
          <div class="card-body">
            <h5 class="card-title">Lorem Ipsum Dolor</h5>
            <p class="card-text">Nunc quis neque id libero bibendum posuere a ut nunc. Nam egestas dictum velit, eu lacinia nulla ultricies nec.</p>
            <p class="card-text"><small class="text-muted">10-2023</small></p>
          </div>
        </div>
        <div class="card mb-3">
          <img src="https://source.unsplash.com/1080x700?support" class="card-img-top">
          <div class="card-body">
            <h5 class="card-title">Lorem Ipsum Dolor</h5>
            <p class="card-text">Nunc quis neque id libero bibendum posuere a ut nunc. Nam egestas dictum velit, eu lacinia nulla ultricies nec.</p>
            <p class="card-text"><small class="text-muted">10-2023</small></p>
          </div>
        </div>
        <div class="card mb-3">
          <img src="https://source.unsplash.com/1080x700?support" class="card-img-top">
          <div class="card-body">
            <h5 class="card-title">Lorem Ipsum Dolor</h5>
            <p class="card-text">Nunc quis neque id libero bibendum posuere a ut nunc. Nam egestas dictum velit, eu lacinia nulla ultricies nec.</p>
            <p class="card-text"><small class="text-muted">10-2023</small></p>
          </div>
        </div>
      </div>
    </div>
    <div class="container pt-4 pt-xl-5">
      <div class="card mb-3">
        <div class="row g-0">
          <div class="col-md-6 p-3">
            <img class="img-fluid shadow" data-bss-parallax="" data-bss-parallax-speed="0.8" src="https://source.unsplash.com/1080x700?support">
          </div>
          <div class="col-md-6 p-1">
            <h2>Lorem Ipsum Dolor</h2>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quis neque id libero bibendum posuere a ut nunc. Nam egestas dictum velit, eu lacinia nulla ultricies nec.
          </div>
        </div>
      </div>
      <div class="card mb-3">
        <div class="row g-0">
          <div class="col-md-6 p-1">
            <h2>Lorem Ipsum Dolor</h2>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quis neque id libero bibendum posuere a ut nunc. Nam egestas dictum velit, eu lacinia nulla ultricies nec.
          </div>
          <div class="col-md-6 p-3">
            <img class="img-fluid shadow" data-bss-parallax="" data-bss-parallax-speed="0.8" src="https://source.unsplash.com/1080x700?support">
          </div>
        </div>
      </div>
      <div class="card mb-3 ">
        <div class="row g-0">
          <div class="col-md-6 p-3">
            <img class="img-fluid shadow" data-bss-parallax="" data-bss-parallax-speed="0.8" src="https://source.unsplash.com/1080x700?support">
          </div>
          <div class="col-md-6 p-1">
            <h2>Lorem Ipsum Dolor</h2>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quis neque id libero bibendum posuere a ut nunc. Nam egestas dictum velit, eu lacinia nulla ultricies nec.
          </div>
        </div>
      </div>
    </div>
  </main>

  <?php include("include/footer.php"); ?>
</body>

</html>