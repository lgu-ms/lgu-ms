<?php
include("../../include/session.php");
include("../../include/time_elapse_str.php");

try {
    if ($debug) {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    }
    
    $swm = new mysqli($mysql_address, $mysql_swm_user, $mysql_swm_pass, $mysql_swm_db);

    $swm->connect_error;

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
$page_title = "Solid Waste Management";
$page_description = "";
$page_keywords = "digital barangay, lgu, lgu management system";
$page_image = "https://digitalbarangay.com/images/cover.png";
$page_author = "Melvin Jones Repol";
$page_canonical = "https://digitalbarangay.com/modules/solid-waste-management-module/";
$page_url = $page_canonical;
$directory = "../../";
$directory_img = "../";
$recaptcha = true;

include("../../include/header.php");


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isAdmin()) {

    if (isset($_POST["delete"])) {
        require_once '../../vendor/autoload.php';
        require_once '../../include/recaptcha.php';
        $token = $_POST["g-recaptcha-response"];

        if (verifyResponse($captcha_secret_key, $token)) {
            if (isLogin()) {
                $item_id = $_POST["id"];
                $item_name = $_POST["name"];
                $deleteData = "DELETE FROM swm WHERE _sid = $item_id";
                $swm->query($deleteData);
                echo '<script>window.addEventListener("DOMContentLoaded", () => { showToast("The data ' . $item_name . ' has been deleted!"); });</script>';
            } else {
                echo '<script>window.addEventListener("DOMContentLoaded", () => { showToast("You need to login before deleting a data!."); });</script>';
            }
        } else {
            echo '<script>window.addEventListener("DOMContentLoaded", () => { showToast("Seems like you failed in I am not a robot test."); });</script>';
        }
    }

    if (isset($_POST["add"]) || isset($_POST["edit"])) {
        $actionType = isset($_POST["add"]) ? true : (isset($_POST["edit"]) ? false : false);
        require_once '../../vendor/autoload.php';
        require_once '../../include/recaptcha.php';
        $token = $_POST["g-recaptcha-response"];

        if (verifyResponse($captcha_secret_key, $token)) {
            $collection_area = $no_trucks = $solid_waste_weight = $collection_date = $transport_to = $solid_waste_processing_type = $solid_waste_type = "";
            if (isLogin()) {
                if (!isset($_POST["collection_area"])) {
                    echo '<script>window.addEventListener("DOMContentLoaded", () => { showToast("Collection area is required!"); });</script>';
                } else {
                    $collection_area = $_POST["collection_area"];
                    if (!isset($_POST["no_trucks"])) {
                        echo '<script>window.addEventListener("DOMContentLoaded", () => { showToast("No of trucks is required!"); });</script>';
                    } else {
                        $no_trucks = $_POST["no_trucks"];
                        if (!isset($_POST["solid_waste_weight"])) {
                            echo '<script>window.addEventListener("DOMContentLoaded", () => { showToast("Solid waste weight is required!"); });</script>';
                        } else {
                            $solid_waste_weight = $_POST["solid_waste_weight"];
                            if (!isset($_POST["collection_date"])) {
                                echo '<script>window.addEventListener("DOMContentLoaded", () => { showToast("Collection date is required!"); });</script>';
                            } else {
                                $collection_date = $_POST["collection_date"];
                                if (!isset($_POST["transport_to"])) {
                                    echo '<script>window.addEventListener("DOMContentLoaded", () => { showToast("Transport to is required!"); });</script>';
                                } else {
                                    $transport_to = $_POST["transport_to"];
                                    if (!isset($_POST["waste_processing_type"])) {
                                        echo '<script>window.addEventListener("DOMContentLoaded", () => { showToast("Solid waste processing type is required!"); });</script>';
                                    } else {
                                        $solid_waste_processing_type = $_POST["waste_processing_type"];
                                        if (!isset($_POST["waste_type"])) {
                                            echo '<script>window.addEventListener("DOMContentLoaded", () => { showToast("Solid waste type is required!"); });</script>';
                                        } else {
                                            $solid_waste_type = $_POST["waste_type"];
                                            if ($actionType) {
                                                $sql = "INSERT INTO swm (collection_area, no_trucks, solid_waste_weight, collection_date, transport_to, waste_processing_type, waste_type, created_on, updated_on, created_by, updated_by) VALUES ";
                                                $today = strtotime("now");
                                                $session_id = $_SESSION["session_id"];
                                                $sql .= "('$collection_area', $no_trucks, '$solid_waste_weight', '$collection_date', '$transport_to', '$solid_waste_processing_type', '$solid_waste_type', $today, $today, $session_id, $session_id)";
                                                if ($swm->query($sql) === TRUE) {
                                                    echo '<script>window.addEventListener("DOMContentLoaded", () => { showToast("Data has been added."); });</script>';
                                                }
                                            } else {
                                                $today = strtotime("now");
                                                $sid = $_POST["id"];
                                                $session_id = $_SESSION["session_id"];
                                                $updateItemData = "UPDATE swm SET collection_area = '$collection_area', no_trucks = $no_trucks, solid_waste_weight = $solid_waste_weight, collection_date = '$collection_date', transport_to = '$transport_to', waste_processing_type = '$solid_waste_processing_type', waste_type = '$solid_waste_type', updated_on = $today, updated_by = $session_id WHERE _sid = $sid";
                                                if ($swm->query($updateItemData) === TRUE) {
                                                    echo '<script>window.addEventListener("DOMContentLoaded", () => { showToast("Data has been updated."); });</script>';
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }

                }
            } else {
                echo '<script>window.addEventListener("DOMContentLoaded", () => { showToast("You need to login before adding a data!."); });</script>';
            }
        } else {
            echo '<script>window.addEventListener("DOMContentLoaded", () => { showToast("Seems like you failed in I am not a robot test."); });</script>';
        }
    }
}

$page = null;
$query = "SELECT * FROM swm";
if (isset($_GET["q"]) && !empty($_GET["q"])) {
    $query .= " WHERE collection_area LIKE '%" . $_GET["q"] . "%' OR collection_date LIKE '%" . $_GET["q"] . "%' OR transport_to LIKE '%" . $_GET["q"] . "%' OR waste_processing_type LIKE '%" . $_GET["q"] . "%' OR waste_type LIKE '%" . $_GET["q"] . "%'";
}
$getSwm = mysqli_query($swm, $query);
if (mysqli_num_rows($getSwm) > 0) {
    $page .= '<div class="row row-cols-1 row-cols-md-3 g-2" data-masonry="{&quot;percentPosition&quot;: true }">';
    while ($row = mysqli_fetch_assoc($getSwm)) {
        $base64F = base64_encode('{"collection_area": "' . $row["collection_area"] . '", "no_trucks": ' . $row["no_trucks"] . ', "solid_waste_weight": ' . $row["solid_waste_weight"] . ', "collection_date": "' . $row["collection_date"] . '", "transport_to": "' . $row["transport_to"] . '", "waste_processing_type": "' . $row["waste_processing_type"] . '", "waste_type": "' . $row["waste_type"] . '"}');
        $page .= '
        <div class="col">
                    <div class="card">
                        <div class="card-body">
                        <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1 swm-title">' . $row["collection_area"] . '</h5>
                                <small>' . time_elapsed_string('@' . $row["created_on"]) . '</small>
                            </div>
                        <ul class="mb-1">
                            <li>No. truck(s): ' . $row["no_trucks"] . '</li>
                            <li>Solid Waste Weight (Tons): ' . $row["solid_waste_weight"] . '</li>
                            <li>Collection Date: ' . $row["collection_date"] . '</li>
                            <li>Transport to: ' . $row["transport_to"] . '</li>
                            <li>Solid Waste Processing Type: ' . $row["waste_processing_type"] . '</li>
                            <li>Solid Waste Type: ' . $row["waste_type"] . '</li>
                        </ul>
                            <div class="d-flex">';

        if ($row["created_on"] != $row["updated_on"]) {
            $page .= '<div class="ml-auto"><small class="text-muted">edited ' . time_elapsed_string('@' . $row["updated_on"]) . '</small></div>';
        }
        if (isAdmin()) {
            $page .= '<div class="ms-auto">
                               <i class="fa-regular fa-pen-to-square edit" data-res="' . $base64F . '"  data-id="' . $row["_sid"] . '"></i> 
                               &nbsp; 
                               <i class="fa-solid fa-trash delete" data-id="' . $row["_sid"] . '"></i>
                            </div>';
        }
        $page .= '
                            </div>
                        </div>
                    </div>
                </div>
        ';
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
            <h1>Solid Waste Management</h1>
            <p class="h5 mb-5">Optimize and streamline the management of solid waste. Waste collection scheduling, <br>
                tracking, and reporting, ultimately enhancing efficiency and transparency in waste management processes.
            </p>
            <div class="row g-0">
                <?php
                if (isAdmin()) {
                    echo '
                    <div class="col-md-4 p-3">
                    <button class="btn btn-primary px-5" id="addData">Add Data</button>
                </div>
                    ';
                }
                ?>
                <div class="col-md-8 p-3">

                    <form action="<?php htmlspecialchars('php_self'); ?>" method="get">
                        <div class="search-container">
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
            </div>

            <?php
            echo $page;
            ?>
        </div>
    </main>

    <?php
    $loadCustomJS = '<script src="../../js/swm.js"></script>';
    include("../../include/footer.php");
    ?>
</body>

</html>