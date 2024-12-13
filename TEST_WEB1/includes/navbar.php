<head>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .sub-nav {
            margin-top: 20px;
            text-align: center;
            width: 100%;
            font-family: Arial, Helvetica, sans-serif;
        }

        .sub-nav ul {
            margin: auto;
            list-style: none;
            display: flex;
            justify-content: center;
            gap: 100px;
            width: max-content;
            padding: 0 100px;
        }

        .sub-nav li {
            display: flex;
            justify-content: center;
        }

        .sub-nav a {
            color: #622174;
            text-decoration: none;
            font-size: 18px;
            padding: 10px 20px;
        }

        .sub-nav a:hover {
            background-color: #f0baff;
            border-radius: 5px;
        }

        .logout {
            background-color: transparent;
        }
    </style>
</head>

<body>
    <nav class="sub-nav">
        <ul>
            <li><a href="recipe-draft.php">Upload Recipe</a></li>
            <li><a href="your-information.php">Account Settings</a></li>
            <li class="logout">
                <?php include "logout-pop.html"; ?>
            </li>
        </ul>
    </nav>
</body>