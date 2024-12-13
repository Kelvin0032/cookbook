<?php
include 'database.php';

session_start();

if (!isset($_SESSION['username'])) {
    echo "You need to log in to access this page.";
    exit();
}

$username = $_SESSION['username'];

$query = "SELECT firstname, lastname, birthdate, username FROM users WHERE username = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $firstname, $lastname, $birthdate, $username);
mysqli_stmt_fetch($stmt);

mysqli_stmt_close($stmt);
mysqli_close($conn);

echo "<h1>Account Summary</h1>";
echo "<p>Name: " . htmlspecialchars($firstname) . " " . htmlspecialchars($lastname) . "</p>";
echo "<p>Username: " . htmlspecialchars($username) . "</p>";
echo "<p>Birthdate: " . htmlspecialchars($birthdate) . "</p>";
?>