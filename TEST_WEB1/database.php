<?php
// database.php
$db_host = "127.0.0.1"; // localhost
$db_user = "root";
$db_pass = "rootbatan";
$db_name = "cookbook_db";

// Create a connection
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>