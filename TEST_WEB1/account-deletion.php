<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include 'database.php';

$username = $_SESSION['username'];

// Check if the delete request is made

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Prepare the SQL statement to delete the user
    $sql = "DELETE FROM users WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        
        // Check if the account was deleted successfully
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            // Account deleted, destroy the session
            session_destroy();
            header("Location: welcome.html"); // Redirect to a confirmation page
            exit();
        } else {
            echo "Error deleting account. Please try again.";
        }
        
        mysqli_stmt_close($stmt);
    } else {
        echo "Error preparing statement: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Account</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        .navbar {
            background-color: #e27aff;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);        }

        .navbar .logo {
            color: white;
            font-size: 24px;
        }

        .nav-links {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
        }

        .nav-links li {
            margin-left: 20px;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
        }

        .nav-links a:hover {
            text-decoration: underline;
        }

        .delete-account-box {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #f9f9f9;
            width: 300px;
            margin: 50px auto;
        }

        .delete-account-box h1 {
            margin: 0 0 10px;
        }

        .delete-account-box p {
            margin: 0 0 20px;
        }

        .delete-account-box button {
            padding: 10px 20px;
            background-color: #d9534f;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .delete-account-box button:hover {
            background-color: #c9302c;
        }

        .delete-account-box a {
            margin-top: 10px;
            text-decoration: none;
            color: #007bff;
        }

        .delete-account-box a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="logo">CookBook</div>
            <ul class="nav-links">
                <li><a href="homepage.php">Home</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="account.html">Account</a></li>
            </ul>
        </nav>
    </header>

    <div class="delete-account-box">
        <h1>Account Deletion</h1>
        <p>Are you sure you want to delete your account? This action cannot be undone.</p>
        <form method="POST" action="">
            <button type="submit">Delete Account</button>
        </form>
        <a href="your-information.php">Cancel</a>
    </div>
</body>
</html>

