<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];

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

    // Check if email exists
    $sql = "SELECT email FROM users WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) == 1) {
        // Generate a random code
        $code = rand(100000, 999999);

        // Store the code and email in session
        session_start();
        $_SESSION['recovery_email'] = $email;
        $_SESSION['recovery_code'] = $code;

        // Send the code to user's email 
        $subject = "Password Recovery Code";
        $message = "Your password recovery code is: $code";
        $headers = "From: no-reply@cookbook.com";
        mail($email, $subject, $message, $headers);

        echo "A recovery code has been sent to your email address.";
    } else {
        echo "Email address not found.";
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>