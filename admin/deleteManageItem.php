<?php
include '../includes/admin-check.php';
include '../db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare('DELETE FROM item WHERE itemID = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->close();
    $conn->close();
}

header('Location: manageListing.php');
exit();