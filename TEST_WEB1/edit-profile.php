<?php
session_start();
include 'database.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$currentUsername = isset($_SESSION['username']) ? $_SESSION['username'] : '';
$email = isset($_SESSION['email']) ? $_SESSION['email'] : '';
$firstname = isset($_SESSION['firstname']) ? $_SESSION['firstname'] : '';
$lastname = isset($_SESSION['lastname']) ? $_SESSION['lastname'] : '';
$birthdate = isset($_SESSION['birthdate']) ? $_SESSION['birthdate'] : '';
$fullName = trim($firstname . ' ' . $lastname);
$error = isset($_GET['error']) ? $_GET['error'] : '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="edit-profile.css">
    <link rel="stylesheet" href="user-val.css">
    <title>UPDATE PROFILE</title>
</head>

<body>
    <?php include "includes/header.html"; ?>
    <div class="head">
        Update Profile
    </div>
    <div class="main-cont">
        <div class="cont-1" id="box">
            <div class="prfl-area">
                <div class="prfl-pic">
                    <img src="#" alt="profile picture">
                </div>
                <div class="prfl-user">
                    <?php echo htmlspecialchars($currentUsername); ?>
                </div>
            </div>
        </div>
        <div class="cont-2" id="box">
            <div class="info">
                <h1 class="desc">User Information</h1>
                <p class="desc">This is where you can edit your public information about yourself.</p>
            </div>
            <hr>
            <form action="db_edit-info.php" method="post">
                <div class="email">
                    <label for="email">Email Address:</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>"
                        placeholder="<?php echo htmlspecialchars($email); ?>" required>
                </div>
                <div class="username">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username"
                        class="<?php echo $error === 'username_taken' ? 'error-border' : ''; ?>"
                        value="<?php echo htmlspecialchars($currentUsername); ?>"
                        placeholder="<?php echo htmlspecialchars($currentUsername); ?>" required>
                </div>
                <div class="name">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($fullName); ?>"
                        placeholder="<?php echo htmlspecialchars($fullName); ?>" required>
                </div>
                <div class="birthdate">
                    <label for="birthdate">Birthdate </label>
                    <input type="date" id="birthdate" name="birthdate"
                        value="<?php echo htmlspecialchars($birthdate); ?>" min="1900-01-01"
                        max="<?php echo date('Y-m-d', strtotime('-18 years')); ?>" required>
                    <button type="submit" class="saveButton" id="btn">Save</button>
                </div>
                <hr>
                <div class="password">
                    <label for="password">Password: </label>
                    <a href="password.php"><button type="button" id="btn">Change</button></a>
                </div>
            </form>
        </div>
    </div>
    <div class="nav">
        <?php include "includes/navbar.php"; ?>
    </div>
    <?php include "includes/footer.html"; ?>
</body>

</html>