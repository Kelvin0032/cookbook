<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['profile-pic'])) {
    $profilePic = $_FILES['profile-pic'];

    $uploadDir = 'uploads/';
    $uploadFile = $uploadDir . basename($profilePic['name']);

    if (move_uploaded_file($profilePic['tmp_name'], $uploadFile)) {
        echo "Profile picture updated!";
    } else {
        echo "Error uploading profile picture.";
    }
}
?>
