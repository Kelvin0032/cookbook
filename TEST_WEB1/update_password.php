<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $password = $_POST['password'];
    $email = $_SESSION['recovery_email'];

    // Database connection details
    $db_host = "localhost";
    $db_user = "root";
    $db_pass = "rootbatan";
    $db_name = "cookbook_db";

    // Create a connection
    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Update password
    $sql = "UPDATE users SET password = ? WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $password, $email);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) > 0) {
        echo "Password has been updated successfully.";
    } else {
        echo "Failed to update password.";
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    // Clear session variables
    session_unset();
    session_destroy();
}
?>