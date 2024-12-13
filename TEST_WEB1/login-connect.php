<?php
session_start();
include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $enteredPassword = trim($_POST['password']);

    $stmt = $conn->prepare("SELECT email, firstname, lastname, birthdate, password FROM users WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($email, $firstname, $lastname, $birthdate, $storedPassword);
    $stmt->fetch();
    $stmt->close();

    if ($enteredPassword === $storedPassword) {
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
        $_SESSION['firstname'] = $firstname;
        $_SESSION['lastname'] = $lastname;
        $_SESSION['birthdate'] = $birthdate;

        header("Location: homepage.php");
        exit();
    } else {
        $_SESSION['login_error'] = "Invalid username or password.";
        header("Location: login.php");
        exit();
    }
}
?>