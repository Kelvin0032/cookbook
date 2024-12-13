<?php
session_start();
include 'database.php';

// Retrieve session variables
$firstname = $_SESSION['firstname'] ?? 'Guest';
$username = $_SESSION['username'] ?? 'Guest';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>CookBook - Home</title>
  <link rel="stylesheet" href="homepage.css" />
  <style>
    /* Add your styles here */
    .search-container {
      display: flex;
      justify-content: center;
      margin: 20px 0;
    }
    .search-container input[type="text"] {
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
    .search-container input[type="submit"] {
      padding: 10px 15px;
      border: none;
      background-color:rgb(167, 76, 175);
      color: white;
      border-radius: 5px;
      cursor: pointer;
      margin-left: 10px;
    }
  </style>
</head>

<body>
  <!-- Navigation Bar -->
  <header>
    <nav class="navbar">
      <div class="logo">CookBook</div>
      <div class="search-container">
        <form action="search-results.php" method="GET">
          <input type="text" name="query" placeholder="Search for recipes..." required />
          <input type="submit" value="Search" />
        </form>
      </div>
      <ul class="nav-links">
        <?php if ($firstname !== 'Guest' && $username !== 'Guest'): ?>
          <li><a href="account.html">Upload</a></li>
        <?php else: ?>
          <li><a href="register.php">Register</a></li>
          <li><a href="login.php">Log In</a></li>
        <?php endif; ?>
        <li><a href="account-settings.php"><?php echo htmlspecialchars($firstname); ?></a></li>
        <li><a href="about.html">About</a></li>
      </ul>
    </nav>
  </header>

  <!-- Main Content Section -->
  <div class="home-content">
    <br><br><br>
    <h1>Welcome to CookBook</h1>
    <p>Explore a wide variety of recipes and create your own!</p>

    <!-- Top 3 Featured Posts Section -->
    <section class="featured-posts">
      <h2>Top 3 Featured Posts</h2>
      <div class="featured-grid">
        <a href="ginataang-manok.php" class="post">
          <img src="images/recipe1.jpg" alt="Featured Recipe 1" />
          <h3>Tinolang Manok</h3>
          <p>Amazing and delicious dish!</p>
        </a>

        <a href="fried-chicken.php" class="post">
          <img src="images/recipe2.jpg" alt="Featured Recipe 2" />
          <h3>Pork Adobo</h3>
          <p>A mouthwatering recipe!</p>
        </a>

        <a href="spaghetti.php" class="post">
          <img src="images/recipe3.jpg" alt="Featured Recipe 3" />
          <h3>Lechon Kawali</h3>
          <p>A delightful recipe to try!</p>
        </a>
      </div>
    </section>

    <!-- Other Posts Section -->
    <section class="other-posts">
      <h2>New Arrivals</h2>
      <div class="other-grid">
        <a href="fried-rice.php" class="post">
          <img src="images/recipe4.jpg" alt="Recipe 4" />
          <h3>Lumpiang Shanghai</h3>
          <p>Check out this amazing recipe!</p>
        </a>

        <a href="ribs.php" class="post">
          <img src="images/recipe5.jpg" alt="Recipe 5" />
          <h3>Filipino Beef Steaks</h3>
          <p>Another great recipe to try!</p>
        </a>

        <a href="pancit.php" class="post">
          <img src="images/recipe6.jpg" alt="Recipe 6" />
          <h3>C orned Beef w/ Cabbage</h3>
          <p>Delicious and easy to make!</p>
        </a>
      </div>
    </section>
  </div>

  <?php include "includes/footer.html"; ?>
</body>

</html>