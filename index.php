<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Restaurant System</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
        }
        .welcome {
            background: #007bff;
            color: #fff;
            padding: 60px 20px;
            border-radius: 8px;
            text-align: center;
            margin-bottom: 30px;
        }
        .welcome h1 {
            margin: 0;
            font-size: 2.5em;
        }
        .button-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
        }
        .button {
            display: inline-block;
            width: 200px; /* Fixed width for consistency */
            padding: 15px;
            font-size: 18px;
            color: #fff;
            background-color: #28a745;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            text-align: center;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .button:hover {
            background-color: #218838;
        }
        footer {
            margin-top: 30px;
            text-align: center;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Welcome Section -->
        <div class="welcome">
            <h1>Welcome to P&P Restaurant System</h1>
        </div>

        <!-- Buttons Section -->
        <div class="button-container">
            <a href="admin/index.php" class="button">Admin </a>
            <a href="customer/index.php" class="button">Customer </a>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; Parsal Silwal 2024. All rights reserved.</p>
    </footer>
</body>
</html>
