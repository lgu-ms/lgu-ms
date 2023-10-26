<?php
include("../include/session.php");

$page_publisher = "https://facebook.com/melvinjonesrepol";
$page_modified_time = "2023-10-08T13:37:36+00:00";
$page_title = "Changed Password - Digital Barangay";
$page_description = "";
$page_keywords = "digital barangay, lgu, lgu management system";
$page_image = "http://localhost/lgu-ms/images/ogimage.png";
$page_author = "Melvin Jones Repol";
$page_canonical = "http://localhost/lgu-ms/";
$page_url = "http://localhost/lgu-ms/change-pasword";
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
                <div class="input-group2">
                  <input type="password" placeholder="New Password" name="password" required>
                  <i class="fa fa-key"></i>
                </div>
                <div class="input-group2">
                  <input type="password" placeholder="Confirm New Password" name="cpassword" required>
                  <i class="fa fa-arrows-rotate"></i>
                </div>
                <div class="form-group mt-2">
                  <button id="changep" class="btn btn-primary px-5 shadow">Change</button>
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