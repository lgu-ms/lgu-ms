<?php

if (isset($_FILES["changePhoto"]) && isLogin()) {
    $theFile = $_FILES["changePhoto"];
    $check = getimagesize($theFile["tmp_name"]);
    if ($check) {
        if ($theFile["size"] > 6000000) {
            echo '<script>window.addEventListener("DOMContentLoaded", () => { showToast("' . $getString["err_too_large_image"] . '"); });</script>';
        } else {
            $target_dir = $directory . "avatar/";
            $target_file = $target_dir . basename($theFile["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $filename = $target_dir . $_SESSION["user_id"] . '.png';
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "webp") {
                echo '<script>window.addEventListener("DOMContentLoaded", () => { showToast("' . sprintf($getString["err_unsupported_image"], $imageFileType) . '"); });</script>';
            } else {
                if (!move_uploaded_file($theFile["tmp_name"], $filename)) {
                    echo '<script>window.addEventListener("DOMContentLoaded", () => { showToast("' . $getString["err_invalid_image"] . '"); });</script>';
                }
            }
        }
    } else {
        echo '<script>window.addEventListener("DOMContentLoaded", () => { showToast("' . $getString["err_invalid_image"] . '"); });</script>';
    }
}

?>