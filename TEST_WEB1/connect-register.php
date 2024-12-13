<?php
session_start();
include 'database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and validate inputs
    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $email = trim($_POST['email']);
    $username = trim($_POST['username']);
    $birthdate = trim($_POST['birthdate']);
    $password = $_POST['password']; // Use the password directly

    // Check if the password is strong enough (optional)
    if (strlen($password) < 8) {
        $_SESSION['register_error'] = "Password must be at least 8 characters long.";
        header("Location: register.php");
        exit();
    }

    // Check if the account already exists
    $check_sql = "SELECT * FROM users WHERE email = ? OR username = ?";
    $stmt = mysqli_prepare($conn, $check_sql);
    mysqli_stmt_bind_param($stmt, "ss", $email, $username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        $_SESSION['register_error'] = "Account already exists with the provided details.";
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        header("Location: register.php");
        exit();
    }

    mysqli_stmt_close($stmt);

    // Insert new user with plain text password
    $sql = "INSERT INTO users (firstname, lastname, email, username, birthdate, password) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssssss", $firstname, $lastname, $email, $username, $birthdate, $password); // Use $password directly
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        // Set session variables for the new user
        $_SESSION['firstname'] = $firstname;
        $_SESSION['username'] = $username;

        mysqli_stmt_close($stmt);
        mysqli_close($conn);

        // Redirect to homepage
        header("Location: homepage.php");
        exit();
    } else {
        // Handle error during insertion
        $_SESSION['register_error'] = "Error during registration. Please try again.";
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        header("Location: register.php");
        exit();
    }
}
?>