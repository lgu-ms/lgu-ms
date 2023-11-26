<?php
include("../../include/session.php");
include("../../include/time_elapse_str.php");

if (!isAdmin()) {
    http_response_code(403);
    die();
}

try {
    if ($debug) {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    }
    
    $dm_r = new mysqli($mysql_address, $mysql_dm_r_user, $mysql_dm_r_pass, $mysql_dm_r_db);

    $dm_r->connect_error;

} catch (Exception $a) {
    if ($debug) {
        echo '<!DOCTYPE html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"><title>Houston! Database Error</title></head><body><style>* {transition: all 0.6s;}html {height: 100%;}body {font-family: "Lato", sans-serif;color: #888;margin: 0;}#main {display: table;width: 100%;height: 100vh;text-align: center;}.fof {display: table-cell;vertical-align: middle;}.fof h1 {font-size: 50px;display: inline-block;padding-right: 12px;animation: type 0.5s alternate infinite;}@keyframes type {from {box-shadow: inset -3px 0px 0px #888;}to {box-shadow: inset -3px 0px 0px transparent;}}</style><div id="main"><div class="fof"><h1>OOPS!</h1><h3>looks like there is a database issue.</h3><p>' . str_replace("\n", "<br>", $a) . '</p></div></div></body><html>';
    } else {
        http_response_code(500);
    }
    die();
}

$page_publisher = "https://facebook.com/melvinjonesrepol";
$page_modified_time = "2023-11-22T13:37:36+00:00";
$page_title = "Document Management and Records";
$page_description = "";
$page_keywords = "digital barangay, lgu, lgu management system";
$page_image = "https://digitalbarangay.com/images/cover.png";
$page_author = "Melvin Jones Repol";
$page_canonical = "https://digitalbarangay.com/modules/document-management-and-records-module/";
$page_url = $page_canonical;
$directory = "../../";
$directory_img = "../";
$recaptcha = true;
$masonry = true;

include("../../include/header.php");


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST["edit"])) {
        require_once '../../vendor/autoload.php';
        require_once '../../include/recaptcha.php';
        $token = $_POST["g-recaptcha-response"];

        if (verifyResponse($captcha_secret_key, $token)) {
            if (!isset($_POST["description"])) {
                echo '<script>window.addEventListener("DOMContentLoaded", () => { showToast("Description is required!"); });</script>';
            } else {
                $item_id = $_POST["id"];
                $item_name = $_POST["name"];
                $item_description = $_POST["description"];
                $session_id = $_SESSION["session_id"];
                $updateFile = "UPDATE dm_r SET file_description = '$item_description', updated_by = $session_id  WHERE _did = $item_id";
                $dm_r->query($updateFile);
                $split_name = explode(".", $item_name);
                echo '<script>window.addEventListener("DOMContentLoaded", () => { showToast("The file ' . $item_name . ' has been updated!"); });</script>';
            }
        } else {
            echo '<script>window.addEventListener("DOMContentLoaded", () => { showToast("Seems like you failed in I am not a robot test."); });</script>';
        }
    }

    if (isset($_POST["delete"])) {
        require_once '../../vendor/autoload.php';
        require_once '../../include/recaptcha.php';
        $token = $_POST["g-recaptcha-response"];

        if (verifyResponse($captcha_secret_key, $token)) {
            $item_id = $_POST["id"];
            $item_name = $_POST["name"];
            $session_id = $_SESSION["session_id"];
            $updateFile = "UPDATE dm_r SET file_status = 'DELETED', updated_by = $session_id WHERE _did = $item_id";
            $dm_r->query($updateFile);
            $split_name = explode(".", $item_name);
            unlink("../../uploads/" . hash("sha1", $split_name[0] . '.' . $split_name[1]) . '.' . $split_name[1]);
            echo '<script>window.addEventListener("DOMContentLoaded", () => { showToast("The file ' . $item_name . ' has been deleted!"); });</script>';
        } else {
            echo '<script>window.addEventListener("DOMContentLoaded", () => { showToast("Seems like you failed in I am not a robot test."); });</script>';
        }
    }

    if (isset($_POST["upload"])) {
        require_once '../../vendor/autoload.php';
        require_once '../../include/recaptcha.php';
        $token = $_POST["g-recaptcha-response"];

        if (verifyResponse($captcha_secret_key, $token)) {
            if (isset($_FILES["fileToUpload"])) {
                if (isLogin()) {
                    $target_dir = "../../uploads/";
                    $filename = basename($_FILES["fileToUpload"]["name"]);
                    $filesize = $_FILES["fileToUpload"]["size"];
                    $target_file = $target_dir . $filename;
                    $target_file_hash = $target_dir . hash("sha1", $filename);
                    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                    $today = strtotime("now");
                    $loc = $target_file_hash . '.' . $fileType;

                    if (file_exists($loc)) {
                        echo '<script>window.addEventListener("DOMContentLoaded", () => { showToast("File is already exists!"); });</script>';
                    } else if ($filesize > 3125000) {
                        echo '<script>window.addEventListener("DOMContentLoaded", () => { showToast("File is too large. Max is 25MB!"); });</script>';
                    } else {
                        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $loc)) {
                            $fileUpload = "INSERT INTO dm_r (file_name, file_type, file_size, file_added_date, file_status, created_by, updated_by) VALUES ";
                            $timeAdded = strtotime("now");
                            $session_id = $_SESSION["session_id"];
                            $fileUpload .= "('$filename', '$fileType', $filesize, $timeAdded, 'EXISTS', $session_id, $session_id)";
                            if ($dm_r->query($fileUpload) === TRUE) {
                                echo '<script>window.addEventListener("DOMContentLoaded", () => { showToast("The file <u>' . basename($_FILES["fileToUpload"]["name"]) . '</u> has been uploaded."); });</script>';
                            }
                        } else {
                            echo '<script>window.addEventListener("DOMContentLoaded", () => { showToast("There was an error while uploading your file!"); });</script>';
                        }
                    }
                } else {
                    echo '<script>window.addEventListener("DOMContentLoaded", () => { showToast("You need to login before uploading a file!."); });</script>';
                }
            } else {
                echo '<script>window.addEventListener("DOMContentLoaded", () => { showToast("Please select a file!"); });</script>';
            }
        } else {
            echo '<script>window.addEventListener("DOMContentLoaded", () => { showToast("Seems like you failed in I am not a robot test."); });</script>';
        }
    }
}

$page = null;
$query = "SELECT * FROM dm_r";
if (isset($_GET["q"]) && !empty($_GET["q"])) {
    $query .= " WHERE file_name LIKE '%" . $_GET["q"] . "%' OR file_description LIKE '%" . $_GET["q"] . "%' OR file_type LIKE '" . $_GET["q"] . "' AND NOT file_status ='DELETED'";
}
$getDmR = mysqli_query($dm_r, $query);
if (mysqli_num_rows($getDmR) > 0) {
    $page .= '<div class="row row-cols-1 row-cols-md-5 g-4" data-masonry="{&quot;percentPosition&quot;: true }">';
    while ($row = mysqli_fetch_assoc($getDmR)) {
        if ($row["file_status"] != "DELETED") {
            $page .= '
        <div class="col">
                    <div class="card">
                    ';

            if ($row["file_type"] == "png" || $row["file_type"] == "jpeg" || $row["file_type"] == "jpg" || $row["file_type"] == "gif") {
                $page .= '<img src="' . $directory . 'uploads/' . hash("sha1", $row["file_name"]) . '.' . $row["file_type"] . '" class="card-img-top" alt="' . $row["file_name"] . '">';
            }

            $page .= '
                        <div class="card-body">
                            <h5 class="card-title">' . $row["file_name"] . '</h5>';
            if ($row["file_description"] != null) {
                $page .= ' <p class="card-text">' . $row["file_description"] . '</p>';
            }
            $page .= '
                            <div class="d-flex">
                            <div class="ml-auto"><small class="text-muted">' . time_elapsed_string('@' . $row["file_added_date"]) . '</small></div>
                            <div class="ms-auto">
                            <i class="fa-solid fa-download" onclick="download(\'' . hash("sha1", $row["file_name"]) . '.' . $row["file_type"] . '\', \'' . $row["file_name"] . '\')"></i> &nbsp; <i class="fa-regular fa-pen-to-square edit"  data-id="' . $row["_did"] . '"></i> &nbsp; <i class="fa-solid fa-trash delete" data-id="' . $row["_did"] . '"></i>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
        ';
        }
    }
    $page .= '</div>';
} else {
    if (isset($_GET["q"]) && !empty($_GET["q"])) {
        $page = '<h1>No data found for query <u>' . $_GET["q"] . '</u>.';
    } else {
        $page = '<h1>No data available.</h1>';
    }
}

?>

<body class="d-flex flex-column min-vh-100">

    <?php include("../../include/nav.php"); ?>

    <main>
        <div class="container pt-4 pt-xl-5 mb-5">
            <h1>Document Management and Records</h1>
            <p class="h5 mb-5">Storage, retrieval of documents and records. Efficient collaboration, version
                control,<br>
                and secure access to important information, reducing reliance on traditional paper-based filing systems.
            </p>
            <div class="row g-0">
                <div class="col-md-6 p-3">
                    <form action="<?php htmlspecialchars('php_self'); ?>" method="get">
                        <div class="search-container mt-5">
                            <?php
                            if (isset($_GET["q"]) && !empty($_GET["q"])) {
                                echo ' <input id="search" placeholder="Search documents/records..." type="text" name="q" value="' . $_GET["q"] . '">';
                            } else {
                                echo ' <input id="search" placeholder="Search documents/records..." type="text" name="q">';
                            }
                            ?>

                            <i class="fa-solid fa-magnifying-glass" id="but"></i>
                        </div>
                    </form>
                </div>
                <div class="col-md-6 p-1">
                    <div class="mb-3">
                        <form action="<?php htmlspecialchars('php_self'); ?>" method="post"
                            enctype="multipart/form-data">
                            <label for="fileToUpload" class="form-label">Upload File</label>
                            <input class="form-control" type="file" name="fileToUpload" id="fileToUpload" required>
                            <button type="submit" name="upload" id="executeCaptcha"
                                class="btn btn-primary px-5 mt-2">Upload</button>
                            <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">
                            <input type="hidden" name="action" value="validate_captcha">
                        </form>
                    </div>
                </div>
            </div>

            <?php
            echo $page;
            ?>
        </div>
    </main>

    <?php
    $loadCustomJS = '<script src="../../js/dm_r.js"></script>';
    include("../../include/footer.php");
    ?>
</body>

</html>