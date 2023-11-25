<?php
    $mysql_address = "localhost";
    $mysql_user = "root";
    $mysql_password = "";
    $mysql_db = "citizen_services";
    $debug = true;
    $conn = new mysqli($mysql_address, $mysql_user, $mysql_password, $mysql_db);
    /*
      DO NOT ATTEMPT TO CHANGE THE VALUES AND COMMIT IT,
      AFTERWARDS YOUR CHANGES WILL BE AUTOMATICALLY GET IGNORED,
      IN THE DEPLOYMENT SERVER
    */
?>