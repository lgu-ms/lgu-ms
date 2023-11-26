<?php
include("config.php");

try {
    $conn = new mysqli($mysql_address, $mysql_user, $mysql_password, $mysql_db);

    $conn->connect_error;

} catch (Exception $a) {
    if ($debug) {
        echo '<!DOCTYPE html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"><title>Houston! Database Error</title></head><body><style>* {transition: all 0.6s;}html {height: 100%;}body {font-family: "Lato", sans-serif;color: #888;margin: 0;}#main {display: table;width: 100%;height: 100vh;text-align: center;}.fof {display: table-cell;vertical-align: middle;}.fof h1 {font-size: 50px;display: inline-block;padding-right: 12px;animation: type 0.5s alternate infinite;}@keyframes type {from {box-shadow: inset -3px 0px 0px #888;}to {box-shadow: inset -3px 0px 0px transparent;}}</style><div id="main"><div class="fof"><h1>OOPS!</h1><h3>looks like there is a database issue.</h3><p>' . str_replace("\n", "<br>", $a) . '</p></div></div></body><html>';
    } else {
        http_response_code(500);
    }
    die();
}

$_GET = (filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS));
$_POST = (filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS));

function xss_clean($data)
{
    $data = str_replace(array('&amp;', '&lt;', '&gt;'), array('&amp;amp;', '&amp;lt;', '&amp;gt;'), $data);
    $data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);
    $data = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);
    $data = html_entity_decode($data, ENT_COMPAT, 'UTF-8');

    $data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $data);

    $data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $data);
    $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $data);
    $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $data);

    $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
    $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
    $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>', $data);

    $data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);

    do {
        $old_data = $data;
        $data = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);
    }
    while ($old_data !== $data);
    return $data;
}
?>