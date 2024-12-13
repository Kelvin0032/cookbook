<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Recipe Draft - CookBook</title>
  <link rel="stylesheet" href="recipe-draft.css" />
</head>

<body>
  <header>
    <nav class="navbar">
      <div class="logo">CookBook</div>
      <ul class="nav-links">
        <li><a href="homepage.php">Home</a></li>
        <li><a href="about.html">About</a></li>
        <li><a href="account-settings.php">Settings</a></li>
      </ul>
    </nav>
  </header>

  <div class="draft-container">
    <h1>Post a Recipe</h1>
    <form action="upload-recipe.php" method="POST" enctype="multipart/form-data">
      <label for="recipe-name">Recipe Name:</label>
      <input type="text" id="recipe-name" name="recipe_name" required />

      <label for="description">Description:</label>
      <textarea id="description" name="description"></textarea>

      <label for="recipe-file">Upload PDF of Recipe:</label>
      <input type="file" id="recipe-file" name="recipe_file" accept=".pdf" required />

      <label for="recipe-image">Upload Recipe Image:</label>
      <input type="file" id="recipe-image" name="recipe_image" accept="image/*" required />

      <button type="submit">Post</button>
    </form>
  </div>

  <footer>
    <p>&copy; 2024 CookBook. All rights reserved.</p>
  </footer>
</body>

</html>