<?php
include("../include/session.php");

if (isLogin()) {
  header('Location: ../');
  die();
}

$page_publisher = "https://facebook.com/melvinjonesrepol";
$page_modified_time = "2023-10-08T13:37:36+00:00";
$page_title = "Signup or login - Digital Barangay";
$page_description = "";
$page_keywords = "digital barangay, lgu, lgu management system";
$page_image = "https://digitalbarangay.com/images/ogimage.png";
$page_author = "Melvin Jones Repol";
$page_canonical = "https://digitalbarangay.com/signup/";
$page_url = $page_canonical;
$directory = "../";
$directory_img = $directory;
$hideLoginButton = true;

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
                  <h1>Signup for free</h1>
                  <br>
                  <div class="input-group2">
                    <input type="email" placeholder="Email" name="email" required>
                    <i class="fa fa-user"></i>
                  </div>
                  <div class="input-group2">
                    <input type="text" placeholder="Fullname" name="fullname" required>
                    <i class="fa fa-circle-info"></i>
                  </div>
                  <div class="input-group2">
                    <input type="password" placeholder="Password" name="password" required>
                    <i class="fa fa-key"></i>
                  </div>
                  <div class="input-group2">
                    <input type="password" placeholder="Confirm Password" name="cpassword" required>
                    <i class="fa fa-arrows-rotate"></i>
                  </div>
                  <small>By clicking Signup, you agree to our <u><a href="/terms">Terms</a></u>, <u><a href="/privacy">Privacy</a></u> and <u><a href="/cookies">Cookie Policy</a></u>.</small>
                  <div class="mt-2">
                    <button id="create" class="btn btn-primary px-5 shadow">Signup</button>
                    <a type="button" class="btn btn-outline-primary px-4" href="../login?utm_source=signup">Login</a>
                    <br><br>
                    <a class="fpass" href="../forgot-password?utm_source=signup">Forgot password?</a>
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

$email = $fullname = $password = $cpassword = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (empty($_POST["email"])) {
    echo '<script>showErr("Email is required!")</script>';
  } else {
    $email = $_POST["email"];
    if (empty($_POST["fullname"])) {
      echo '<script>showErr("Fullname is required!")</script>';
    } else {
      $fullname = $_POST["fullname"];
      if (empty($_POST["password"])) {
        echo '<script>showErr("Password is required!")</script>';
      } else {
        $password = $_POST["password"];
        if (empty($_POST["cpassword"])) {
          echo '<script>showErr("You need to retype your password again!")</script>';
        } else {
          $cpassword = $_POST["cpassword"];
          if ($password != $cpassword) {
            echo '<script>showErr("Password did not match!")</script>';
          } else {
            $isRegister = mysqli_query($conn, "SELECT * FROM account WHERE user_email= '$email'");
            if (mysqli_num_rows($isRegister) > 0) {
              echo '<script>showErr("Email is already registered!")</script>';
            } else {
              $sql = "INSERT INTO account (user_name, user_fullname, user_email, user_password, user_type, created_at, updated_at) VALUES ";
              $today = date("Y-m-d H:i:s");
              $default_username = explode("@", $email);
              $hash = hash("sha512", $password);
              $sql .= "('$default_username[0]', '$fullname', '$email', '$hash', 'User', '$today', '$today')";
              if ($conn->query($sql) === TRUE) {
                echo '<script>window.location.href = "../login?utm_source=account_created&email=' . $email . '";</script>';
                die();
              } else {
                echo '<script>showErr("An error occured please try again later!")</script>';
              }
            }
          }
        }
      }
    }
  }
}
?>