<?php
// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $recipeName = $_POST['recipe-name'];
    $recipeDesc = $_POST['recipe-desc'];
    $recipePdf = $_FILES['recipe-pdf'];

    // Directory for uploads
    $uploadDir = 'recipes/';
    $uploadFile = $uploadDir . basename($recipePdf['name']);

    // Move uploaded file to the server directory
    if (move_uploaded_file($recipePdf['tmp_name'], $uploadFile)) {
        // Store recipe information in a database
        echo "Recipe uploaded successfully!";
    } else {
        echo "Error uploading the recipe.";
    }
}
?>
