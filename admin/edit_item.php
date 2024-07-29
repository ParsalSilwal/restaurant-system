<?php
include '../includes/db.php';

if (isset($_GET['id'])) {
    $item_id = $_GET['id'];
    $sql = "SELECT * FROM items WHERE id = $item_id";
    $result = $conn->query($sql);
    $item = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $item_id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    $sql = "UPDATE items SET name='$name', price='$price', description='$description' WHERE id = $item_id";
    
    if ($conn->query($sql) === TRUE) {
        echo "Item updated successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Item</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h2>Edit Item</h2>
    <form method="post" action="">
        <input type="hidden" name="id" value="<?php echo $item['id']; ?>" required>
        <input type="text" name="name" value="<?php echo $item['name']; ?>" placeholder="Item Name" required><br>
        <input type="text" name="price" value="<?php echo $item['price']; ?>" placeholder="Price" required><br>
        <textarea name="description" placeholder="Description"><?php echo $item['description']; ?></textarea><br>
        <input type="submit" value="Update Item">
    </form>
    <a href="index.php">Back to Dashboard</a>
</body>
</html>
