<?php
include 'includes/functions.php';

session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$id = $_GET['id'];
if (deleteItem($id)) {
    header('Location: dashboard.php');
    exit();
} else {
    echo "Failed to delete item.";
}
