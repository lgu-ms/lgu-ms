<?php
include("../include/session.php");

$page_publisher = "https://facebook.com/melvinjonesrepol";
$page_modified_time = "2023-10-08T13:37:36+00:00";
$page_title = "Signup or login - Digital Barangay";
$page_description = "";
$page_keywords = "digital barangay, lgu, lgu management system";
$page_image = "http://localhost/lgu-ms/images/cover.png";
$page_author = "Melvin Jones Repol";
$page_canonical = "http://localhost/lgu-ms/signup/";
$page_url = $page_canonical;
$directory = "../";
$directory_img = $directory;
$isForm = true;

include("../include/header.php");

?>


<body class="d-flex flex-column min-vh-100">
  <?php include("../include/nav.php"); ?>

  <main>
    <div class="card mb-3">
      <div class="row g-0">
        <div class="col-md-7">
          <div class="container">
            <div class="row">
              <div class="col-md-6">
                <h1>Signup for free</h1>
                <br>
                <div class="input-group2">
                  <input type="email" placeholder="Email" name="email" required>
                  <i class="fa fa-user fa-lg"></i>
                </div>
                <div class="input-group2">
                  <input type="text" placeholder="Full Name" name="fullname" required>
                  <i class="fa fa-circle-info fa-lg"></i>
                </div>
                <div class="input-group2">
                  <input type="password" placeholder="Password" name="password" required>
                  <i class="fa fa-key fa-lg"></i>
                </div>
                <div class="input-group2">
                  <input type="password" placeholder="Confirm Password" name="cpassword" required>
                  <i class="fa fa-arrows-rotate fa-lg"></i>
                </div>
                <small>By clicking Signup, you agree to our <u><a href="/terms">Terms</a></u>, <u><a
                      href="/privacy">Privacy</a></u> and <u><a href="/cookies">Cookie Policy</a></u>.</small>
                <div class="mt-2">
                  <button id="create" class="btn btn-primary px-5 shadow">Signup</button>
                  <a class="accnt px-3" href="../login?utm_source=signup">Login</a>
                  <br><br>
                  <a class="fpass" href="../forgot-password?utm_source=signup">Forgot password?</a>
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