<?php
include("../include/session.php");

$page_publisher = "https://facebook.com/melvinjonesrepol";
$page_modified_time = "2023-10-08T13:37:36+00:00";
$page_title = "Changed Password - Digital Barangay";
$page_description = "";
$page_keywords = "digital barangay, lgu, lgu management system";
$page_image = "http://localhost/lgu/images/cover.png";
$page_author = "Melvin Jones Repol";
$page_canonical = "http://localhost/lgu/";
$page_url = "http://localhost/lgu/change-pasword";
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
                <h1>Change Password</h1>
                <br>
                <div class="form-group">
                  <input type="password" class="" id="password" required>
                  <label for="password">New Password</label>
                </div>
                <div class="form-group">
                  <input type="password" class="" id="repassword" required>
                  <label for="password">Re-type Password</label>
                </div>
                <div class="form-group mt-2">
                  <button id="changep" class="btn btn-primary px-5">Change</button>
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