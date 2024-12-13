<?php
include 'database.php'; // Include your database connection file

session_start();
if (!isset($_SESSION['username'])) {
    die("You must be logged in to post a recipe.");
}

$username = $_SESSION['username'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $recipeName = $_POST['recipe_name'];
    $description = $_POST['description'];

    // Handle PDF upload
    $pdfPath = 'uploads/' . basename($_FILES['recipe_file']['name']);
    if (!move_uploaded_file($_FILES['recipe_file']['tmp_name'], $pdfPath)) {
        die("Error uploading PDF file.");
    }

    // Handle image upload
    $imagePath = 'uploads/' . basename($_FILES['recipe_image']['name']);
    if (!move_uploaded_file($_FILES['recipe_image']['tmp_name'], $imagePath)) {
        die("Error uploading image file.");
    }

    // Prepare and execute the SQL statement to insert the recipe
    $stmt = $conn->prepare("INSERT INTO recipes (username, title, description, pdf_path, image_path) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $username, $recipeName, $description, $pdfPath, $imagePath);

    if ($stmt->execute()) {
        // Redirect to your-recipes.php after successful upload
        header("Location: your-recipes.php");
        exit(); // Ensure no further code is executed
    } else {
        echo "Error posting recipe: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>