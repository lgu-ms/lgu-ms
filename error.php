<?php
include("include/session.php");

$code = $_GET["code"];
$uri = $_GET["uri"];

if (!isset($code) || is_numeric($code) != 1 || (is_numeric($code) == 1 && ($code != 400 && $code != 401 && $code != 403 && $code != 404 && $code != 500)) && !isset($uri)) {
    echo "<script>window.location.href = '/?ref=eeeeeeeeeeeeerrr';</script>";
    die();
}

class ErrorCodes
{
    public $code;
    public $name;
    public $description;
}

$err = array();

$err[0] = new ErrorCodes();
$err[0]->code = 400;
$err[0]->name = 'Bad Request';
$err[0]->description = '';

$err[1] = new ErrorCodes();
$err[1]->code = 401;
$err[1]->name = 'Authorization Required';
$err[1]->description = '';

$err[2] = new ErrorCodes();
$err[2]->code = 403;
$err[2]->name = 'Forbidden';
$err[2]->description = '';

$err[3] = new ErrorCodes();
$err[3]->code = 404;
$err[3]->name = 'File Not Found';
$err[3]->description = '';

$err[4] = new ErrorCodes();
$err[4]->code = 500;
$err[4]->name = 'Internal Server Error';
$err[4]->description = '';

$main = null;
$page_title = "Digital Barangay";
$page_description = "";
$errorCode = 0;
$errorName = null;

foreach ($err as $error) {
    if ($error->code == $code) {
        $errorCode = $error->code;
        $errorName = $error->name;
        $main = '

    <header>
    <div class="card mb-3 ">
      <div class="card-body">
        <div class="row">
          <div class="col-md-4">
            <img class="rounded mx-auto d-block img-fluid" src="https://i.imgur.com/ks9WhlU.gif"
              width="300" alt="error">
          </div>
          <div class="col-md-8">
            <h1 class="display-1" style="font-weight: 900;"><strong>' . $error->code . '</strong></h1>
            <h1 class="display-6">This is not the webpage youre looking for.</h1>
            <p>' . $error->description . '</p>  
            <form action="search" method="get">
            <div class="search-container">
                <input id="search" placeholder="Search anything..." type="text" name="q">
                <i class="fa-solid fa-magnifying-glass" id="but"></i>
            </div>
        </form>
        <small class="text-muted"><a href="contact">Contact Us</a> — <a href="https://stats.uptimerobot.com/n0EyAslx3A">Digital Barangay Status</a> </small>
          </div>
        </div>
      </div>
    </div>
  </header> ';
        $page_title = $error->name . " - Digital Barangay";
        $page_description = $error->description;
        break;
    }
}

$page_publisher = "https://facebook.com/melvinjonesrepol";
$page_modified_time = "2023-11-22T13:37:36+00:00";
$page_keywords = "digital barangay, lgu, lgu management system";
$page_image = "https://digitalbarangay.com/images/ogimage.png";
$page_author = "Melvin Jones Repol";
$page_canonical = "https://digitalbarangay.com/";
$page_url = $page_canonical;
$directory = '';
$directory_img = '';

include("include/header.php");

?>

<body class="d-flex flex-column min-vh-100">

    <?php include("include/nav.php"); ?>

    <main>
        <?php echo $main; ?>
    </main>

    <?php
    echo '<script>window.history.pushState("object", "title", "http://' . $_SERVER['HTTP_HOST'] . $uri . '")</script>';
    include("include/footer.php"); ?>
</body>

</html>

<?php


$insertError = "INSERT INTO error (error_code, error_name, error_date";

if (isLogin()) {
    $insertError .= ", session_id, user_id";
}

$today = strtotime("now");
$insertError .= ") VALUES ($errorCode, '$errorName', $today";

if (isLogin()) {
    $insertError .= ", " . $_SESSION["session_id"];
    $insertError .= ", " . $_SESSION["user_id"];
}

$insertError .= ")";

$conn->query($insertError);

?>