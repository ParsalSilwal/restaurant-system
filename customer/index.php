<?php
include '../includes/db.php';

// Start session
session_start();

// Generate or retrieve customer ID
if (!isset($_SESSION['customer_id'])) {
    $_SESSION['customer_id'] = rand(1, 1000); // For testing; replace with proper login logic
}
$customer_id = $_SESSION['customer_id'];

// Handle the purchase process
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $item_ids = $_POST['item_ids'] ?? [];
    $quantities = $_POST['quantities'] ?? [];

    foreach ($item_ids as $index => $item_id) {
        $quantity = $quantities[$index];
        if ($quantity > 0) {
            // Get price
            $price_sql = "SELECT price FROM items WHERE id = $item_id";
            $price_result = $conn->query($price_sql);
            $price = $price_result->fetch_assoc()['price'];
            $total_price = $price * $quantity;

            // Insert into sales with customer_id
            $insert_sql = "INSERT INTO sales (item_id, quantity, total_price, customer_id) VALUES ($item_id, $quantity, $total_price, $customer_id)";
            $conn->query($insert_sql);
        }
    }

    // Redirect to the same page to avoid form resubmission on refresh
    header("Location: index.php");
    exit();
}

// Fetch items for display
$sql = "SELECT * FROM items";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customer Dashboard</title>
    <link rel="stylesheet" href="../css/styles.css">
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
        .items-list {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 20px;
            justify-content: center;
        }
        .item {
            border: 1px solid #ddd;
            padding: 15px;
            width: calc(33.333% - 20px); /* Adjust width for 3 items per row */
            box-sizing: border-box;
            text-align: center;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .item img {
            max-width: 100%;
            height: auto;
        }
        .item-description {
            display: none;
            font-size: 0.9em;
            color: #666;
            margin-top: 10px;
        }
        .item:hover .item-description {
            display: block;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            text-align: center;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin: 10px;
        }
        .button:hover {
            background-color: #0056b3;
        }
        .button-container {
            display: flex;
            justify-content: center;
            gap: 10px;
        }
        .logout-container {
            text-align: center;
            margin-top: 20px;
        }
        .logout {
            color: #dc3545;
            text-decoration: none;
            font-size: 16px;
            font-weight: bold;
            background-color: #f8d7da;
            padding: 10px 20px;
            border-radius: 5px;
        }
        .logout:hover {
            background-color: #f5c6cb;
            color: #c82333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Customer Dashboard</h2>

        <h3>Items List</h3>
        <form method="post" action="index.php">
            <div class="items-list">
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='item'>
                                <h4>{$row['name']}</h4>
                                <p>\${$row['price']}</p>
                                <p class='item-description'>{$row['description']}</p>
                                <input type='hidden' name='item_ids[]' value='{$row['id']}'>
                                <input type='number' name='quantities[]' min='0' placeholder='Quantity' style='width: 60px;'>
                              </div>";
                    }
                } else {
                    echo "<p>No items available.</p>";
                }
                ?>
            </div>
            <div class="button-container">
                <input type="submit" value="Buy" class="button">
                <a href="view_bill.php" class="button">See Bill</a>
            </div>
        </form>
        
        <div class="logout-container">
            <a href="logout.php" class="logout">Logout</a>
        </div>
    </div>
</body>
</html>
