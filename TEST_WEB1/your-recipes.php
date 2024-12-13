<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Recipes</title>
    <style>
        .content {
            margin: 80px auto;
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <?php include "includes/header.html"; ?>
    <div class="content">
        <h1>List of Your Uploaded Recipes</h1>
        
        <?php
        include 'database.php';

        session_start();
        if (isset($_SESSION['username'])) {
            $username = $_SESSION['username'];

            $recipeQuery = "SELECT r.title, r.description, r.pdf_path, r.image_path 
                            FROM recipes r
                            WHERE r.username = ?";
            
            $stmt = $conn->prepare($recipeQuery);
            if (!$stmt) {
                die("Prepare failed: " . $conn->error);
            }
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result === false) {
                die("Query failed: " . $stmt->error);
            }

            if ($result->num_rows > 0) {
                echo "<table>";
                echo "<tr><th>Title</th><th>Description</th><th>PDF</th><th>Image</th></tr>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['title']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['description']) . "</td>";
                    echo "<td><a href='" . htmlspecialchars($row['pdf_path']) . "' target='_blank'>View PDF</a></td>";
                    echo "<td><img src='" . htmlspecialchars($row['image_path']) . "' alt='Recipe Image' style='width:100px;'></td>";
                    echo "</tr>";
                }

                echo "</table>";
            } else {
                echo "No recipes found.";
            }

            $stmt->close();
        } else {
            echo "Please log in to view your recipes.";
        }

        $conn->close();
        ?>
    </div>
    <?php include "includes/footer.html"; ?>
</body>
</html>