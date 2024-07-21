<?php
include 'includes/functions.php';

session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$id = $_GET['id'];
$item = getItem($id);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sku = $_POST['sku'];
    $name = $_POST['name'];
    $quantity = $_POST['quantity'];
    if (updateItem($id, $sku, $name, $quantity)) {
        header('Location: dashboard.php');
        exit();
    } else {
        $error = "Failed to update item.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Update Item</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <h2>Update Item</h2>
    <?php if (!empty($error)) echo "<p>$error</p>"; ?>
    <form method="post">
        <label for="sku">SKU:</label>
        <input type="text" id="sku" name="sku" value="<?php echo htmlspecialchars($item['sku']); ?>" required>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($item['name']); ?>" required>
        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" value="<?php echo htmlspecialchars($item['quantity']); ?>" required>
        <button type="submit">Update Item</button>
    </form>
    <a href="dashboard.php">Back to Dashboard</a>
</body>

</html>