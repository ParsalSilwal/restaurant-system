<?php
include '../includes/db.php';

// Fetch items for the edit section
$sql = "SELECT * FROM items";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h2>Admin Dashboard</h2>
    <a href="add_item.php">Add Item</a><br>
    <a href="view_sales.php">View Sales</a><br>
    <h3> Items</h3>
    <table>
        <tr>
            <th>Item ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['price']}</td>
                        <td>{$row['description']}</td>
                        <td><a href='edit_item.php?id={$row['id']}'>Edit</a></td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No items available.</td></tr>";
        }
        ?>
    </table>
    <a href="../index.php">Logout</a>
</body>
</html>
