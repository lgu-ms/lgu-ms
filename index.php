<?php
include("include/session.php");

$page_publisher = "https://facebook.com/melvinjonesrepol";
$page_modified_time = "2023-10-08T13:37:36+00:00";
$page_title = "Digital Barangay - A LGU Management System";
$page_description = "";
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
  <div class="video-background">
    <video autoplay muted loop playsinline class="video" class="lazy">
      <source src="videos/intro.compressed.webm" type="video/webm">
      <source src="videos/intro.compressed.mp4" type="video/mp4">
    </video>

    <div class="header">
      <?php include("include/nav.php"); ?>
      <header>
        <img class="rounded mx-auto d-block img-fluid" src="images/dial122-web-banner-v2.jpg" alt="Banner" width="500">

        <div class="card headerv5" style="background: transparent">
          <div class="card-body">

            <div class="row">
              <div class="col-md-4" id="mobile">
                <img class="mx-auto d-block img-fluid" src="images/cover.png" width="320" alt="Digital Barangay">
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
                <img class="mx-auto d-block img-fluid" src="images/cover.png" width="320" alt="Digital Barangay">
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
            <h2 style="color: #4285f4;">Quezon City Programs</h2>
          </div>
        </div>

        <div class="col-12 col-lg-10 mx-auto">
          <div class="position-relative" style="display: flex;flex-wrap: wrap;justify-content: flex-end;">
            <div style="position: relative;flex: 0 0 45%;transform: translate3d(-15%, 35%, 0);">
              <img class="img-fluid shadow" data-bss-parallax="" data-bss-parallax-speed="0.8" src="images/program1.jpg"
                title="QC ID">
            </div>
            <div style="position: relative;flex: 0 0 45%;transform: translate3d(-5%, 20%, 0);">
              <img class="img-fluid shadow" data-bss-parallax="" data-bss-parallax-speed="0.4" src="images/program2.jpg"
                title="Covid Response">
            </div>
            <div style="position: relative;flex: 0 0 60%;transform: translate3d(0, 0%, 0);">
              <img class="img-fluid shadow" data-bss-parallax="" data-bss-parallax-speed="0.25"
                src="images/program3.webp" title="QC Bus">
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
          <h4>Latest News</h4>
        </div>
      </div>
      <div class="card-group">
        <div class="card mb-3">
          <img src="images/noimage.webp" class="card-img-top">
          <div class="card-body">
            <h5 class="card-title">REAL PROPERTY TAX DISCOUNTS ON EARLY FULL PAYMENTS</h5>
            <p class="card-text">MAHALAGANG ANUNSYO MULA SA CITY TREASURER’S OFFICE QCitizens, magbayad nang maaga para
              maka-DISKWENTO sa inyong REAL PROPERTY TAX (amilyar)! ADVANCE...</p>
          </div>
        </div>
        <div class="card mb-3">
          <img src="images/noimage.webp" class="card-img-top">
          <div class="card-body">
            <h5 class="card-title">TRAFFIC ADVISORY – OCTOBER 27, 2023</h5>
            <p class="card-text">MAHALAGANG ABISO SA MGA MOTORISTA Asahan ang pagbagal ng daloy ng trapiko sa paligid ng
              Amoranto Sports Complex at sa...</p>
          </div>
        </div>
        <div class="card mb-3">
          <img src="images/noimage.webp" class="card-img-top">
          <div class="card-body">
            <h5 class="card-title">Q CITY BUS SERVICE ADVISORY – OCTOBER 28, 2023 TO NOVEMBER 2, 2023</h5>
            <p class="card-text">Narito ang schedule ng operasyon ng Q City Bus mula October 28, 2023 (Saturday)
              hanggang November 2, 2023 (Thursday).</p>
          </div>
        </div>
      </div>
    </div>
    <div id="covidCaptions" class="carousel slide">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#covidCaptions" data-bs-slide-to="0" class="active" aria-current="true"
          aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#covidCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#covidCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner justify-content-center">
        <div class="carousel-item active">
          <img src="images/cleaning_spray_closeup.jpg" class="d-block mx-auto w-50" alt="...">
          <div class="carousel-caption d-none d-md-block">
            <h5>Disinfect Surfaces</h5>
            <p>in your home and at work</p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="images/images.jpeg" class="d-block mx-auto w-50" alt="...">
          <div class="carousel-caption d-none d-md-block">
            <h5>Wash Hands</h5>
            <p>atleast for 20 seconds</p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="images/images (1).jpeg" class="d-block mx-auto w-50" alt="...">
          <div class="carousel-caption d-none d-md-block">
            <h5>Cover Mouth</h5>
            <p>use hands or elbow before sneezing or coughing</p>
          </div>
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#covidCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#covidCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
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
            <h2>FROM THE MAYOR’S DESK</h2>
            “Ang lahat ng ating nagawa at gagawin pa sa mga susunod na taon ay bunga ng hindi nagbabagong pangako natin
            sa isa’t isa – na lagi tayong magtutulungan para sa kabutihan ng lahat. I am proud of our accomplishments as
            a city, because these are the results of our collective efforts and commitment for positive change.”
          </div>
        </div>
      </div>
      <div class="card mb-3">
        <div class="row g-0">
          <div class="col-md-6 p-1">
            <h2>The Heart of Quezon City</h2>
            Nowadays, it was considered as the center of Quezon City and it serves as the people’s park. Its main
            feature is a mausoleum containing the remains of Manuel L. Quezon, the second President of the Philippines,
            and his wife, First Lady Aurora Quezon.
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
            <img class="img-fluid shadow" data-bss-parallax="" data-bss-parallax-speed="0.8" src="images/cityhall.jpg">
          </div>
          <div class="col-md-6 p-1">
            <h2>City Hall</h2>
            The Quezon City Hall is a government building which houses the office of the Mayor of Quezon City located
            along the Elliptical Road. The Quezon City Council is housed within the adjacent Legislative Wing.
          </div>
        </div>
      </div>
    </div>
  </main>

  <?php include("include/footer.php"); ?>
</body>

</html>