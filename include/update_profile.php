<?php

if (isset($_FILES["changePhoto"]) && isLogin()) {
    $theFile = $_FILES["changePhoto"];
    $check = getimagesize($theFile["tmp_name"]);
    if ($check) {
        if ($theFile["size"] > 6000000) {
            echo '<script>window.addEventListener("DOMContentLoaded", () => { showToast("The selected image file is too large!"); });</script>';
        } else {
            $target_dir = $directory . "avatar/";
            $target_file = $target_dir . basename($theFile["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $filename = $target_dir . $_SESSION["user_id"] . '.png';
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "webp") {
                echo '<script>window.addEventListener("DOMContentLoaded", () => { showToast("Unsupported file format .' . $imageFileType . '!"); });</script>';
            } else {
                if (!move_uploaded_file($theFile["tmp_name"], $filename)) {
                    echo '<script>window.addEventListener("DOMContentLoaded", () => { showToast("Failed! An error occured."); });</script>';
                }
            }
        }
    } else {
        echo '<script>window.addEventListener("DOMContentLoaded", () => { showToast("Invalid image format selected!"); });</script>';
    }
}

?>