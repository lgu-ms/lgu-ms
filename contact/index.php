<?php
include("../include/session.php");

$page_publisher = "https://facebook.com/melvinjonesrepol";
$page_modified_time = "2023-10-08T13:37:36+00:00";
$page_title = "About - Digital Barangay";
$page_description = "";
$page_keywords = "digital barangay, lgu, lgu management system";
$page_image = "https://digitalbarangay.com/images/ogimage.png";
$page_author = "Melvin Jones Repol";
$page_canonical = "https://digitalbarangay.com/about/";
$page_url = $page_canonical;
$directory = "../";
$directory_img = $directory;
$isForm = false;

include("../include/header.php");

?>

<body class="d-flex flex-column min-vh-100">

  <?php include("../include/nav.php"); ?>

  <main>
    <div class="card mb-3">
      <div class="row g-0">
        <div class="col-md-7">
          <div class="container">
            <form action="<?php htmlspecialchars('php_self'); ?>" method="post">
              <div class="row">
                <div class="col-md-6">
                  <h1>Contact Us</h1>
                  <br>
                  <div class="input-group2">
                    <input id="name" type="text" placeholder="Name" name="name" required>
                    <i class="fa fa-user"></i>
                  </div>

                  <div class="input-group2">
                    <input id="email" type="email" placeholder="Email" name="email" required>
                    <i class="fa-solid fa-envelope"></i>
                  </div>

                  <div class="input-group2">
                  <textarea id="message1" name="message" rows="6" placeholder="Message" required></textarea>
                  <i class="fa-solid fa-ellipsis"></i>
                  </div>

                  <div class="mt-2">
                    <button id="sendmail" class="btn btn-primary px-5 shadow">Send</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

    </div>
  </main>

  <?php include("../include/footer.php"); ?>
</body>

</html>