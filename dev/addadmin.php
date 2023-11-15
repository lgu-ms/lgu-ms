<?php
include("../include/dbcon.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST["email"];
    $fullname = $_POST["fullname"];
    $password = hash("sha512", $_POST["password"]);
    $usertype = $_POST["type"];

    $sql = "INSERT INTO account (user_name, user_fullname, user_email, user_password, user_type, created_at, updated_at) VALUES ";
    $today = date("Y-m-d H:i:s");
    $default_username = explode("@", $email);
    $sql .= "('$default_username[0]', '$fullname', '$email', '$password', '$usertype', '$today', '$today')";
    if ($conn->query($sql) === TRUE) {
        echo 'Done';
    } else {
        echo 'Failed';
    }
}
?>

<form action="<?php htmlspecialchars('php_self'); ?>" method="post">
    <input id="email" type="email" placeholder="Email" name="email" required>
    <input type="text" placeholder="Fullname" name="fullname" required>
    <input type="password" placeholder="Password" name="password" required>
    <input list="usertype" name="type" required>
    <datalist id="usertype">
        <option value="User">
        <option value="Admin">
        <option value="Super Admin">
        <option value="Staff">
    </datalist>
    <input type="submit" name="submit" required>
</form>