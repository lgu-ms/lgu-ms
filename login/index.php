<?php
include("../include/session.php");

if (isLogin()) {
  header('Location: ../');
  die();
}

$page_publisher = "https://facebook.com/melvinjonesrepol";
$page_modified_time = "2023-10-08T13:37:36+00:00";
$page_title = "Login or signup - Digital Barangay";
$page_description = "";
$page_keywords = "digital barangay, lgu, lgu management system";
$page_image = "http://localhost/lgu-ms/images/ogimage.png";
$page_author = "Melvin Jones Repol";
$page_canonical = "http://localhost/lgu-ms/login/";
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
            <form action="<?php htmlspecialchars('php_self'); ?>" method="post">
              <div class="row">
                <div class="col-md-6">
                  <h1>Login to continue</h1>
                  <br>
                  <div class="input-group2">
                    <input id="email" type="email" placeholder="Email" name="email" required>
                    <i class="fa fa-user"></i>
                  </div>

                  <div class="input-group2">
                    <input type="password" placeholder="Password" name="password" required>
                    <i class="fa fa-key"></i>
                  </div>

                  <div class="mt-2">
                    <button id="login" class="btn btn-primary px-5 shadow">Login</button>
                    <a type="button" class="btn btn-outline-primary px-4" href="../signup?utm_source=login">Signup</a>
                    <br><br>
                    <a class="fpass" href="../forgot-password?utm_source=login">Forgot password?</a>
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
include("../include/dbcon.php");

$email = $password = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (empty($_POST["email"])) {
    echo '<script>showErr("Email is required!")</script>';
  } else {
    $email = $_POST["email"];
    if (empty($_POST["password"])) {
      echo '<script>showErr("Password is required!")</script>';
    } else {
      $password = $_POST["password"];
      $check_email = mysqli_query($conn, "SELECT * FROM account WHERE user_email = '$email'");
      if (mysqli_num_rows($check_email) > 0) {
        while ($row = mysqli_fetch_assoc($check_email)) {

          $db_password = $row["user_password"];
          $user_id = $row["_id"];

          if ($db_password == hash("sha512", $password)) {

            $sql = "INSERT INTO account_session (user_agent, session_started, session_status, user_id) VALUES ";
            $device_id = hash("sha512", $_SERVER['HTTP_USER_AGENT']);
            $today = date("Y-m-d H:i:s");
            $sql .= "('$device_id', '$today', 'active', $user_id)";
            if ($conn->query($sql) === TRUE) {
              $getSessionID = mysqli_query($conn, "SELECT * FROM account_session WHERE session_started = '$today' AND user_id = $user_id");

              if (mysqli_num_rows($getSessionID) > 0) {
                while ($row1 = mysqli_fetch_assoc($getSessionID)) {
                  $_SESSION['user_login'] = true;
                  $_SESSION["session_id"] = $row1["_sid"];
                  $_SESSION["user_id"] = $user_id;
                  
                  echo '<script>window.location.href = "../"</script>';
                  die();
                }
              }
            }
          } else {
            echo '<script>showErr("Email or Password incorrect!")</script>';
          }
        }
      } else {
        echo '<script>showErr("Email is not registered! Please create an account first.")</script>';
      }
    }
  }
}
?>