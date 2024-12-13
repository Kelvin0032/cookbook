<?php
session_start();
include 'database.php';

$error = "";
$successMessage = "";

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$currentUsername = $_SESSION['username'];
$currentUserSql = "SELECT email, firstname, lastname, birthdate FROM users WHERE username = ?";
$stmt = $conn->prepare($currentUserSql);
$stmt->bind_param("s", $currentUsername);
$stmt->execute();
$stmt->bind_result($currentEmail, $currentFirstname, $currentLastname, $currentBirthdate);
$stmt->fetch();
$stmt->close();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $newUsername = trim($_POST['username']);
    $name = trim($_POST['name']);
    $birthdate = trim($_POST['birthdate']);
    $nameParts = explode(' ', $name, 2);
    $firstname = trim($nameParts[0]);
    $lastname = isset($nameParts[1]) ? trim($nameParts[1]) : '';

    // Debugging output
    error_log("Current Email: $currentEmail, New Email: $email");
    error_log("Current Username: $currentUsername, New Username: $newUsername");
    error_log("Current Firstname: $currentFirstname, New Firstname: $firstname");
    error_log("Current Lastname: $currentLastname, New Lastname: $lastname");
    error_log("Current Birthdate: $currentBirthdate, New Birthdate: $birthdate");

    if (
        $email === $currentEmail &&
        $newUsername === $currentUsername &&
        $firstname === $currentFirstname &&
        $lastname === $currentLastname &&
        $birthdate === $currentBirthdate
    ) {
        // No changes made, redirect to account-settings.php
        header("Location: account-settings.php");
        exit();
    }

    // Check for duplicates only if there are changes
    $checkSql = "SELECT COUNT(*) FROM users WHERE (email = ? OR username = ?) AND username <> ?";
    $stmt = $conn->prepare($checkSql);
    $stmt->bind_param("sss", $email, $newUsername, $currentUsername);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    if ($count > 0) {
        $error = "duplicate";
        header("Location: edit-profile.php?error=duplicate");
        exit();
    } else {
        // Update the user information
        $updateSql = "UPDATE users SET email=?, username=?, firstname=?, lastname=?, birthdate=? WHERE username=?";
        $stmt = $conn->prepare($updateSql);
        $stmt->bind_param("ssssss", $email, $newUsername, $firstname, $lastname, $birthdate, $currentUsername);

        if ($stmt->execute()) {
            $_SESSION['username'] = $newUsername;
            $_SESSION['email'] = $email;
            $_SESSION['firstname'] = $firstname;
            $_SESSION['lastname'] = $lastname;
            $_SESSION['birthdate'] = $birthdate;

            $successMessage = "Profile updated successfully!";
            header("Location: your-information.php?update=success");
            exit();
        } else {
            echo "Error updating record: " . $stmt->error;
        }

        $stmt->close();
    }

    $conn->close();
} else {
    echo "Invalid request method.";
}
?>