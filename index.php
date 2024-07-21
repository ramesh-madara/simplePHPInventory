<?php
session_start();

if (isset($_SESSION['user_id'])) {
    // Redirect to the dashboard if the user is logged in
    header('Location: dashboard.php');
    exit();
} else {
    // Redirect to the login page if the user is not logged in
    header('Location: login.php');
    exit();
}
