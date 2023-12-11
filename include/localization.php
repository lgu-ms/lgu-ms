<?php
$lang = null;

if (isset($_GET["hl"]) && !empty($_GET["hl"])) {
    $lang = $_GET['hl'] ?? "en";
    if ($lang != "en" && $lang != "fil") {
        $lang = "en";
    }
    $_SESSION["lang"] = $lang;
} else {
    if (isset($_SESSION["lang"])) {
        $lang = $_SESSION["lang"];
    } else {
        $lang = "en";
        $_SESSION["lang"] = $lang;
    }
}

$getString = require($directory . 'locale/' . $lang . '.php');

?>