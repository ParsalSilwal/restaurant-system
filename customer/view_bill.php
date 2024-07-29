<?php
include '../includes/db.php';

// Start session
session_start();

// Retrieve customer ID
$customer_id = $_SESSION['customer_id'];

// Fetch bill data for the current customer
$sql = "SELECT i.name, s.quantity, i.price, s.total_price
        FROM sales s
        JOIN items i ON s.item_id = i.id
        WHERE s.customer_id = $customer_id";
$result = $conn->query($sql);

// Calculate total bill
$total_bill = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Bill</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <div class="logout">
        <a href="logout.php">Logout</a>
    </div>

    <h2>Your Bill</h2>

    <table>
        <thead>
            <tr>
                <th>Item Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total Price</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $total_bill += $row['total_price'];
                    echo "<tr>
                            <td>{$row['name']}</td>
                            <td>{$row['quantity']}</td>
                            <td>\${$row['price']}</td>
                            <td>\${$row['total_price']}</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No bill details available.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <h3>Total Bill: $<?php echo number_format($total_bill, 2); ?></h3>

    <a href="index.php">Back to Customer Dashboard</a>
</body>
</html>
