<?php
// connection of database
$db_host = "localhost";
$db_username = "root";
$db_pass = "";
$db_name = "inventory";

$con = mysqli_connect($db_host, $db_username, $db_pass, $db_name);

// checking

if (!$con) {
    die("connection failed: " . mysqli_connect_error());
} else {
    ("Sucessful");
}

?>