<?php
session_start();
include 'database.php';
$error = "";
$successMessage = "";

if (!isset($_SESSION['username'])) {
  die("You must be logged in to update your password.");
}

$username = $_SESSION['username'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $currentPassword = $_POST['password'];
  $newPassword = $_POST['newpassword'];
  $confirmPassword = $_POST['confirm'];

  $sql = "SELECT password FROM users WHERE username = ?";
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_bind_param($stmt, "s", $username);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_bind_result($stmt, $storedPassword);
  mysqli_stmt_fetch($stmt);
  mysqli_stmt_close($stmt);

  if ($currentPassword === $storedPassword) {
    if ($newPassword === $confirmPassword) {
      $updateSql = "UPDATE users SET password = ? WHERE username = ?";
      $updateStmt = mysqli_prepare($conn, $updateSql);
      mysqli_stmt_bind_param($updateStmt, "ss", $newPassword, $username);
      mysqli_stmt_execute($updateStmt);
      mysqli_stmt_close($updateStmt);

      $successMessage = "Password updated successfully!";
      header("Location: password-changed.php");
    } else {
      $error = "The passwords do not match.";
    }
  } else {
    $error = "Current password is incorrect.";
  }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="password.css" />
  <title>Updating Password</title>
</head>

<body>
  <div class="cont">
    <form action="" method="post">
      <div class="current">
        <input type="password" name="password" id="current" placeholder="Current Password" required />
      </div>
      <div class="new">
        <input type="password" name="newpassword" id="new" placeholder="New Password" required />
      </div>
      <div class="confirm">
        <input type="password" name="confirm" id="confirm" placeholder="Confirm Password" required />
      </div>
      <div class="btn">
        <button type="submit">Save</button>
      </div>
      <?php if (!empty($error)): ?>
        <div style="color: red; font-size: small; width: 250px; text-align: center; margin-top: 10px;">
          <?php echo $error; ?>
        </div>
      <?php elseif (!empty($successMessage)): ?>
        <div style="color: green; font-size: small; width: 250px; text-align: center; margin-top: 10px;">
          <?php echo $successMessage; ?>
        </div>
      <?php endif; ?>
    </form>
  </div>
</body>

</html>