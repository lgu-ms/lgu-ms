<?php
include("../../include/session.php");

$page_publisher = "https://facebook.com/melvinjonesrepol";
$page_modified_time = "2023-11-17T13:37:36+00:00";
$page_title = "GIS and Mapping";
$page_description = "";
$page_keywords = "digital barangay, lgu, lgu management system";
$page_image = "https://digitalbarangay.com/images/cover.png";
$page_author = "Melvin Jones Repol";
$page_canonical = "https://digitalbarangay.com/modules/gis-and-mapping-module/";
$page_url = $page_canonical;
$directory = "../../";
$directory_img = "../";

if (!$debug) {
  if (isLogin()) {
    $user_id = $_SESSION["user_id"];
    $isNotUser = mysqli_query($conn, "SELECT * FROM account WHERE _id = $user_id");
    if (mysqli_num_rows($isNotUser) > 0) {
      while ($row = mysqli_fetch_assoc($isNotUser)) {
        if ($row["user_type"] == "User") {
          http_response_code(403);
          die();
        }
      }
    }
  } else {
    http_response_code(403);
    die();
  }
}
?>