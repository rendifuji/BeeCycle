<?php
include '../db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare('DELETE FROM user WHERE studentID = ?');
    $stmt->bind_param('s', $id);
    $stmt->execute();
    $stmt->close();
    $conn->close();
}

header('Location: manageUser.php');
exit();

