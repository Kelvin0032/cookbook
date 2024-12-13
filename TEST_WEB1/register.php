<?php
session_start();
if (isset($_SESSION['register_error'])) {
  echo '<div class="error-message">' . $_SESSION['register_error'] . '</div>';
  unset($_SESSION['register_error']);
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>COOKBOOK - REGISTER</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="reg-val.css" />
  <style>
    .error-message {
      color: red;
      text-align: center;
      position: relative;
      top: 360px;
      width: fit-content;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="register">
      <h1>Register</h1>
    </div>

    <form action="connect-register.php" method="POST">
      <div class="box box1">
        <label for="first-name">First name</label><br />
        <input type="text" id="first-name" name="firstname" placeholder="Write your given name..." pattern="^[A-Za-z]+$"
          title="Please enter a valid first name (letters only)." required /><br />
      </div>

      <div class="box box2">
        <label for="last-name">Last name</label><br />
        <input type="text" id="last-name" name="lastname" placeholder="Write your surname..." pattern="^[A-Za-z]+$"
          title="Please enter a valid last name (letters only)." required /><br />
      </div>

      <div class="box box3">
        <label for="email">Email</label><br />
        <input type="email" id="email" name="email" placeholder="Write your email address..."
          pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" title="Please enter a valid email address."
          required /><br />
      </div>

      <div class="box box4">
        <label for="username">Username</label><br />
        <input type="text" id="username" name="username" maxlength="20" placeholder="@username" pattern="^@[\w]+"
          title="Must start with '@' followed by alphanumeric characters." value="@" required /><br />
      </div>

      <div class="box box5">
        <label for="birthdate">Birthdate</label><br />
        <input type="date" id="birthdate" name="birthdate" required min="1900-01-01"
          max="<?php echo date('Y-m-d', strtotime('-18 years')); ?>">
      </div>

      <div class="box box6">
        <label for="password">Password</label><br />
        <input type="password" id="password" name="password" placeholder="Input a password..." minlength="8"
          pattern="[0-9a-zA-Z@.]+" title="Must have letters, numbers, @ or . only" required />
        <p>Password must be at least 8 characters</p>
      </div>

      <div class="box7">
        <button type="submit">Register</button>
      </div>

      <div class="box8">
        <p>
          Already have an account?
          <a href="login.php"><span class="login-line">login</span></a>
        </p>
      </div>

      <div class="box9">
        <a href="homepage.php"><button type="button">Guest</button></a>
      </div>
    </form>
  </div>

  <div class="img">
    <img src="images\logo.png" alt="Cookbook logo" />
  </div>
</body>

</html>