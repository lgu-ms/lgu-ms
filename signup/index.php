<?php
include("../include/session.php");

$page_publisher = "https://facebook.com/melvinjonesrepol";
$page_modified_time = "2023-10-08T13:37:36+00:00";
$page_title = "Signup or login - Digital Barangay";
$page_description = "";
$page_keywords = "digital barangay, lgu, lgu management system";
$page_image = "http://localhost/lgu/images/cover.png";
$page_author = "Melvin Jones Repol";
$page_canonical = "http://localhost/lgu/signup/";
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
                <div class="form-group">
                  <input type="text" class="" id="email" required> 
                  <label for="email">Email</label>
                </div>
                <div class="form-group">
                  <input type="text" class="" id="fullname" required>
                  <label for="email">Full Name</label>
                </div>
                <div class="form-group">
                  <input type="password" class="" id="password" required>
                  <label for="email">Password</label>
                </div>
                <div class="form-group">
                  <input type="password" class="" id="cpassword" required>
                  <label for="email">Confirm Password</label>
                </div>
                <small>By clicking Signup, you agree to our <u><a href="/terms">Terms</a></u>, <u><a
                      href="/privacy">Privacy</a></u> and <u><a href="/cookies">Cookie Policy</a></u>.</small>
                <div class="mt-2">
                  <button id="create" class="btn btn-primary px-4">Signup</button>
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