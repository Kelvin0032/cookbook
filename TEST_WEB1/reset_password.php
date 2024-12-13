<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Reset Password</title>
    <link rel="stylesheet" href="forgot.css" />
    <style>
        .btn button[type=submit] {
            width: fit-content;
            margin: 10px 110px;
            height: 40px;
            background-color: transparent;
            border: none;
            border-radius: 20px;
            padding: 10px;
            font-family: Bahnschrift semibold;
        }

        button[type=submit]:hover {
            box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;
            background-color: rgb(240, 186, 255);
            transition: transform 125ms;
            transform: translateY(-2px);
        }

        button[type=submit]:active {
            color: white;
            background-color: #e587ff;
            border: 1px solid #7129ab;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="recover">
            <h1>Reset Password</h1>
        </div>
        <form action="update_password.php" method="post">
            <div class="input1">
                <label for="password">New Password</label><br />
                <input type="password" name="password" id="password" minlength="6" pattern="[0-9a-zA-Z@.]+"
                    title="Must have letters, numbers, @ or . only" required />
            </div>
            <div class="btn">
                <button type="submit">Reset Password</button>
            </div>
        </form>
    </div>
</body>

</html>