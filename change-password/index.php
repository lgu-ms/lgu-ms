<?php
include("../include/session.php");

$page_publisher = "https://facebook.com/melvinjonesrepol";
$page_modified_time = "2023-10-08T13:37:36+00:00";
$page_title = "Changed Password - Digital Barangay";
$page_description = "";
$page_keywords = "digital barangay, lgu, lgu management system";
$page_image = "https://digitalbarangay.com/images/ogimage.png";
$page_author = "Melvin Jones Repol";
$page_canonical = "https://digitalbarangay.com/";
$page_url = "https://digitalbarangay.com/change-pasword";
$directory = "../";
$directory_img = $directory;

include("../include/header.php");

?>


<body class="d-flex flex-column min-vh-100">
  <?php include("../include/nav.php"); ?>

  <main>
    <div class="card mb-3">
      <div class="row g-0">
        <div class="col-md-7">
          <div class="container">
            <form action="<?php htmlspecialchars('php_self'); ?>" method="post" id="form">
              <div class="row">
                <div class="col-md-6">
                  <h1>Change Password</h1>
                  <br>
                  <div class="input-group2">
                    <input type="password" placeholder="Previous Password" name="ppassword" required>
                    <i class="fa fa-backward"></i>
                  </div>
                  <div class="input-group2">
                    <input type="password" placeholder="New Password" name="password" required>
                    <i class="fa fa-key"></i>
                  </div>
                  <div class="input-group2">
                    <input type="password" placeholder="Confirm New Password" name="cpassword" required>
                    <i class="fa fa-arrows-rotate"></i>
                  </div>
                  <div class="form-group mt-2">
                    <button id="executeCaptcha" class="btn btn-primary px-5 shadow">Update</button>
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
<?php

$ppassword = $password = $cpassword = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (empty($_POST["ppassword"])) {
    echo '<script>showErr("You need to type your previous password!")</script>';
  } else {
    $ppassword = hash("sha512", $_POST["ppassword"]);
    $user_id = $_SESSION["user_id"];
    $session_id = $_SESSION["session_id"];

    $checkID = mysqli_query($conn, "SELECT * FROM account where _id = $user_id");
    if (mysqli_num_rows($checkID) > 0) {
      while ($row = mysqli_fetch_assoc($checkID)) {

        $db_password = $row["user_password"];

        if (empty($_POST["password"])) {
          echo '<script>showErr("You need to enter your new password!")</script>';
        } else {
          $password = hash("sha512", $_POST["password"]);
          if (empty($_POST["cpassword"])) {
            echo '<script>showErr("You need to retype your password again!")</script>';
          } else {
            $cpassword = hash("sha512", $_POST["cpassword"]);
            if (strcasecmp($password, $cpassword) == 0) {
              if (strcasecmp($db_password, $ppassword) == 0) {
                $setPassword = "UPDATE account SET user_password = '$password' WHERE _id = $user_id";
                if ($conn->query($setPassword)) {
                  $setChangePassword = "INSERT INTO passwordchanged (date_accessed, session_id, user_id, event_type) VALUES ";
                  $today = date("Y-m-d H:i:s");
                  $setChangePassword .= "('$today', $session_id, $user_id, 'change-password')";
                  if ($conn->query($setChangePassword) === TRUE) {
                    echo '<script>showPopup("Change Password", "Successfully changed your password", "' . $directory . '")</script>';
                  }
                }
              } else {
                echo '<script>showErr("Please type again your password!")</script>';
              }
            } else {
              echo '<script>showErr("Please type again your new password!")</script>';
            }
          }
        }
      }
    }
  }
}
?>