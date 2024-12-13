<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include 'database.php';

$username = $_SESSION['username'];
$sql = "SELECT firstname, lastname, email, username, birthdate, password FROM users WHERE username = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $firstname, $lastname, $email, $username, $birthdate, $password);
mysqli_stmt_fetch($stmt);

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Information</title>
    <link rel="stylesheet" href="your-information.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f5f5f5;
            color: #333;
        }

        .navbar {
            background-color: #e27aff;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }   

        .logo {
            font-size: 24px;
            font-weight: bold;
            color: white;
            text-transform: uppercase;
        }

        .nav-links {
            list-style: none;
            display: flex;
            gap: 20px;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            font-size: 18px;
            padding: 8px 16px;
        }

        .nav-links a:hover {
            background-color: #b94ed6;
            border-radius: 5px;
        }

        .account-settings-container {
            padding: 20px;
        }

        .profile-summary {
            margin-bottom: 20px;
        }

        .sub-nav {
            margin-top: 20px;
            text-align: center;
        }

        .sub-nav ul {
            list-style: none;
            display: flex;
            justify-content: center;
            gap: 30px;
            width: fit-content;
        }

        .sub-nav a {
            color: #622174;
            text-decoration: none;
            font-size: 18px;
            padding: 10px 20px;
        }

        .sub-nav a:hover {
            background-color: #f0baff;
            border-radius: 5px;
        }

        .logout-select {
            background-color: transparent;
            color: #622174;
            border: none;
            border-radius: 5px;
            padding: 10px;
            font-size: 18px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
        }

        .logout-select option {
            background-color: white;
            color: #622174;
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

    <div class="account-settings-container">
        <h1>Password Changed</h1>


        <p><strong>Current Password:</strong> <?php echo htmlspecialchars($password); ?></p>

        </section>

        <nav class="sub-nav">
            <ul>
                <li><a href="edit-profile.php">Edit Profile</a></li>
                <li><a href="your-information.php">Account Settings</a></li>
                <li>
                    <?php include "logout-pop.html"; ?>
                </li>
            </ul>
        </nav>
    </div>
    <?php include "includes/footer.html"; ?>
</body>

</html