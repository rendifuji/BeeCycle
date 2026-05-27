<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM item WHERE itemID=?");
    $stmt->bind_param("s", $id);
    $stmt->execute();

    $stmt->close();
    $conn->close();
}

header("Location: manageListing.php");
exit();
?>