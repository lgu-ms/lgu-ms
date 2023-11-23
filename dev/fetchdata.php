<?php
include("../include/dbcon.php");

print_db("account", $conn);
print_db("account_session", $conn);
print_db("error", $conn);
print_db("otp", $conn);
print_db("password_changed", $conn);
print_db("profilepic", $conn);

function print_db($name, $conn)
{
    $result = $conn->query("SELECT * FROM $name;");
    echo "<h2>$name</h2>";
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            foreach ($row as $key => $val) {
                echo ($key . ': ' . $val . " | ");
                if ($key == "user_email") {
                    echo "<br><br>";
                }
            }
        }
    } else {
        echo "0 results";
    }
}

?>