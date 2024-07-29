<?php
include '../includes/db.php';

// Fetch sales data, sorted by ID
$sql = "SELECT s.id, i.name, s.quantity, i.price, s.total_price, s.sale_date, s.customer_id
        FROM sales s
        JOIN items i ON s.item_id = i.id
        ORDER BY s.id ASC"; // Sorting by ID
$result = $conn->query($sql);

// Calculate total sales
$total_sales = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Sales</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h2>Sales Report</h2>

    <table>
        <thead>
            <tr>
                <th>Sale ID</th>
                <th>Item Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total Price</th>
                <th>Sale Date</th>
                <th>Customer ID</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $total_sales += $row['total_price'];
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['name']}</td>
                            <td>{$row['quantity']}</td>
                            <td>\${$row['price']}</td>
                            <td>\${$row['total_price']}</td>
                            <td>{$row['sale_date']}</td>
                            <td>{$row['customer_id']}</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No sales data available.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <h3>Total Sales: $<?php echo number_format($total_sales, 2); ?></h3>

    <a href="index.php">Back to Admin Dashboard</a>
</body>
</html>
