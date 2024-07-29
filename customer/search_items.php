<?php
include '../includes/db.php';

$search_query = $_POST['search_query'] ?? '';
$sql = "SELECT * FROM items WHERE name LIKE '%$search_query%'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search Items</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h2>Search Results</h2>
    <ul>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<li>
                        {$row['name']} - \${$row['price']}
                        <form method='post' action='index.php' style='display:inline;'>
                            <input type='hidden' name='item_id' value='{$row['id']}'>
                            <input type='number' name='quantity' min='1' placeholder='Quantity' required>
                            <input type='submit' value='Buy'>
                        </form>
                      </li>";
            }
        } else {
            echo "<li>No items found.</li>";
        }
        ?>
    </ul>
    <a href="index.php">Back to Dashboard</a>
</body>
</html>
