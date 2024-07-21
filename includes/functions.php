<?php
include 'db.php';

// Create a global mysqli connection

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

function registerUser($username, $password)
{
    global $mysqli;
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $stmt = "INSERT INTO users (username, password) VALUES ('$username', '$passwordHash')";
    return $mysqli->query($stmt);
}

function loginUser($username, $password)
{
    global $mysqli;
    $stmt = "SELECT * FROM users WHERE username = '$username'";
    $result = $mysqli->query($stmt);
    $user = $result->fetch_assoc();
    if ($user && password_verify($password, $user['password'])) {
        return $user['id'];
    }
    return false;
}

function addItem($sku, $name, $quantity)
{
    global $mysqli;
    $quantity = (int)$quantity;
    $stmt = "INSERT INTO inventory (sku, name, quantity) VALUES ('$sku', '$name', $quantity)";
    return $mysqli->query($stmt);
}

function getItems()
{
    global $mysqli;
    $stmt = "SELECT * FROM inventory";
    $result = $mysqli->query($stmt);
    return $result->fetch_all(MYSQLI_ASSOC);
}

function getItem($id)
{
    global $mysqli;
    $id = (int)$id;
    $stmt = "SELECT * FROM inventory WHERE id = $id";
    $result = $mysqli->query($stmt);
    return $result->fetch_assoc();
}

function updateItem($id, $sku, $name, $quantity)
{
    global $mysqli;
    $id = (int)$id;
    $quantity = (int)$quantity;
    $stmt = "UPDATE inventory SET sku = '$sku', name = '$name', quantity = $quantity WHERE id = $id";
    return $mysqli->query($stmt);
}

function deleteItem($id)
{
    global $mysqli;
    $id = (int)$id;
    $stmt = "DELETE FROM inventory WHERE id = $id";
    return $mysqli->query($stmt);
}
