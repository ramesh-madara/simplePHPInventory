<?php
include 'includes/functions.php';

session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sku = $_POST['sku'];
    $name = $_POST['name'];
    $quantity = $_POST['quantity'];
    if (addItem($sku, $name, $quantity)) {
        header('Location: dashboard.php');
        exit();
    } else {
        $error = "Failed to add item.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Item</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <h2>Add Item</h2>
    <?php if (!empty($error)) echo "<p>$error</p>"; ?>
    <form method="post">
        <label for="sku">SKU:</label>
        <input type="text" id="sku" name="sku" required>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" required>
        <button type="submit">Add Item</button>
    </form>
    <a href="dashboard.php">Back to Dashboard</a>
</body>

</html>