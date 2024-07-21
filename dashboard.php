<?php
include 'includes/functions.php';

session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_id'])) {
    $id = $_POST['delete_id'];
    if (deleteItem($id)) {
        header('Location: dashboard.php');
        exit();
    } else {
        $error = "Failed to delete item.";
    }
}

$items = getItems();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/styles.css">
    <script src="js/scripts.js" defer></script>
</head>

<body>
    <h2>Dashboard</h2>
    <div class="nav">
        <a href="add_item.php">Add Item +</a>
        <a href="logout.php">Log Out</a>
    </div>

    <?php if (!empty($error)) echo "<p>$error</p>"; ?>
    <table>
        <thead>
            <tr>
                <th>SKU</th>
                <th>Name</th>
                <th>Quantity</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items as $item) : ?>
                <tr>
                    <td><?php echo htmlspecialchars($item['sku']); ?></td>
                    <td><?php echo htmlspecialchars($item['name']); ?></td>
                    <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                    <td>
                        <a href="update_item.php?id=<?php echo $item['id']; ?>">Edit</a>
                        <form action="dashboard.php" method="post" class="delete-form" data-id="<?php echo $item['id']; ?>">
                            <input type="hidden" name="delete_id" value="<?php echo $item['id']; ?>">
                            <button type="submit" class="delete-button">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <script>
        // scripts.js

        document.addEventListener('DOMContentLoaded', function() {
            const deleteForms = document.querySelectorAll('.delete-form');

            deleteForms.forEach(form => {
                form.addEventListener('submit', function(event) {
                    if (!confirm('Are you sure you want to delete this item?')) {
                        event.preventDefault();
                    }
                });
            });
        });
    </script>
</body>

</html>