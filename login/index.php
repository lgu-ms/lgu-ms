<?php
include("../include/session.php");

$page_publisher = "https://facebook.com/melvinjonesrepol";
$page_modified_time = "2023-10-08T13:37:36+00:00";
$page_title = "Login or signup - Digital Barangay";
$page_description = "";
$page_keywords = "digital barangay, lgu, lgu management system";
$page_image = "http://localhost/lgu/images/cover.png";
$page_author = "Melvin Jones Repol";
$page_canonical = "http://localhost/lgu/login/";
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
                <h1>Login to continue</h1>
                <br>
                <div class="form-group">
                  <input type="text" class="" id="email" required> 
                  <label for="email">Email</label>
                </div>
                <div class="form-group">
                  <input type="password" class="" id="password" required>
                  <label for="email">Password</label>
                </div>
                <div class="mt-2">
                  <button id="login" class="btn btn-primary px-4">Login</button>
                  <a class="accnt px-3" href="../signup?utm_source=login">Signup</a>
                  <br><br>
                  <a class="fpass" href="../forgot-password?utm_source=login">Forgot password?</a>
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