<?php
include 'database.php'; //database connection file

$query = isset ($_GET['query']) ? $_GET['query'] : '';

$query = htmlspecialchars($query);

$sql = "SELECT * FROM recipes WHERE title LIKE ?";
$stmt = $conn->prepare($sql);
$searchTerm = "%" . $query . "%";
$stmt->bind_param("s", $searchTerm);
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results - CookBook</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
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

    <div class="content">
        <h1>Search Results for "<?php echo $query; ?>"</h1>
        <?php if ($result->num_rows > 0): ?>
            <ul>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <li>
                        <a href="recipes.php?id=<?php echo $row['username']; ?>"><?php echo $row['title']; ?></a>
                    </li>
                <?php endwhile; ?>
            </ul>
        <?php else: ?>
            <p>No recipes found matching your search.</p>
        <?php endif; ?>
    </div>

    <footer>
        <p>&copy; 2024 CookBook. All rights reserved.</p>
    </footer>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>