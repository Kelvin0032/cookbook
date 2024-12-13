<?php
session_start();
include 'database.php';

$username = $_SESSION['username'] ?? '@Guest';
$profilePicture = $_SESSION['profilePicture'] ?? 'default_profile_picture.jpg';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account</title>
    <link rel="stylesheet" href="account-settings.css">
    <style>
        .line-through {
            text-decoration: line-through;
        }

        .color {
            color: red;
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar">
            <div class="logo">CookBook</div>
            <div class="home"><a href="homepage.php">Home</a></div>
        </nav>
    </header>

    <div class="page">
        <div class="head">
            <h1>Account Settings</h1>
        </div>
        <div class="account-content">
            <div class="profile-section">
                <div class="profile-contain">
                    <div class="image">
                        <img src="<?php echo htmlspecialchars($profilePicture); ?>" alt="Profile Picture"
                            class="profile-pic">
                    </div>
                    <div class="user">
                        <h1><?php echo htmlspecialchars($username); ?></h1>
                    </div>
                </div>
            </div>

            <nav class="account-subnav">
                <ul>
                    <li class="box-1">
                        <?php if ($username === '@Guest'): ?>
                            <span class="line-through">Edit Your Profile </span><span class="color">(Login required)</span>
                        <?php else: ?>
                            <a href="edit-profile.php">Edit Your Profile</a>
                        <?php endif; ?>
                    </li>
                    <li class="box-2">
                        <?php if ($username === '@Guest'): ?>
                            <span class="line-through">Your Information</span><span class="color">(Login required)</span>
                        <?php else: ?>
                            <a href="your-information.php">Your Information</a>
                        <?php endif; ?>
                    </li>
                    <li class="box-3">
                        <?php if ($username === '@Guest'): ?>
                            <span class="line-through">Your Recipes</span><span class="color">(Login required)</span>
                        <?php else: ?>
                            <a href="your-recipes.php">Your Recipes</a>
                        <?php endif; ?>
                    </li>
                    <li class="logout box-4">
                        <?php if ($username === '@Guest'): ?>
                            <a href="register.php">Register</a> or <a href="login.php">Sign In</a>
                        <?php else: ?>
                            <a href="logout.php">Log Out</a>
                        <?php endif; ?>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</body>

</html>