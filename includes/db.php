<?php
$host = 'localhost';
$db = 'inventory_db';
$user = 'root';
$pass = '';

// Create a mysqli connection
$mysqli = new mysqli($host, $user, $pass, $db);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
