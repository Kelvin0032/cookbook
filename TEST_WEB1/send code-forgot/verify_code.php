<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $code = $_POST['code'];

    if ($code == $_SESSION['recovery_code']) {
        // Code matches, proceed to password reset page
        header("Location: reset_password.php");
        exit();
    } else {
        echo "Invalid recovery code.";
    }
}
?>