<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>COOKBOOK | LOGIN</title>
  <link rel="stylesheet" href="log-val.css" />
</head>

<body>
  <div class="page"></div>

  <div class="log-container">
    <div class="login">
      <h1>Login</h1>
    </div>

    <?php
    session_start();
    $temp_username = isset($_SESSION['temp_username']) ? $_SESSION['temp_username'] : '';
    if (isset($_SESSION['login_error'])): ?>
      <div class="error">
        <p><?php echo $_SESSION['login_error']; ?></p>
        <?php unset($_SESSION['login_error']); ?>
      </div>
    <?php endif; ?>

    <form action="login-connect.php" method="post">
      <div class="box1">
        <label for="username">Username</label>
        <br />
        <input type="text" name="username" id="username" placeholder="Enter your username..." maxlength="20"
          pattern="^@[a-zA-Z0-9\-_.]+$"
          title="Must start with '@' followed by alphanumeric characters or symbols (_ - .)" required
          value="@<?php echo htmlspecialchars($temp_username); ?>" />
      </div>

      <div class="box2">
        <label for="password">Password</label>
        <br />
        <input type="password" name="password" id="password" placeholder="Enter your password..." minlength="6"
          pattern="^(?=.*[a-zA-Z])(?=.*[0-9])[0-9a-zA-Z@.-]+$"
          title="Must be at least 6 characters long and include at least one letter and one number." required />
        <p>Password must be at least 6 characters</p>
      </div>

      <div class="box3">
        <a href="forgot.html">
          <p>Forgot password?</p>
        </a>
      </div>

      <div class="box4">
        <button type="submit">Login</button>
      </div>

      <div class="box5">
        <a href="register.php">
          <button type="button">Register</button>
        </a>
      </div>
    </form>
  </div>

  <div class="img">
    <img src="images\logo.png" alt="Cookbook logo" />
  </div>

  <?php
  unset($_SESSION['temp_username']);
  ?>
</body>

</html>