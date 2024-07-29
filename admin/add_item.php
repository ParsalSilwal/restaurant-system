<?php
include '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    $sql = "INSERT INTO items (name, price, description) VALUES ('$name', '$price', '$description')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Item added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Item</title>
</head>
<body>
    <h2>Add Item</h2>
    <form method="post" action="">
        <input type="text" name="name" placeholder="Item Name" required><br>
        <input type="text" name="price" placeholder="Price" required><br>
        <textarea name="description" placeholder="Description"></textarea><br>
        <input type="submit" value="Add Item">
    </form>
    <a href="index.php">Back to Dashboard</a>
</body>
</html>
