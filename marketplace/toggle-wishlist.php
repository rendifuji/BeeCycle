<?php
include '../includes/student-check.php';
include '../db_connection.php';

$itemID = isset($_GET['id']) ? intval($_GET['id']) : 0;
$studentID = $_SESSION['studentID'];

if ($itemID > 0) {
    $checkQuery = "SELECT itemID FROM wishlist WHERE studentID = '$studentID' AND itemID = $itemID";
    $checkResult = mysqli_query($conn, $checkQuery);

    if ($checkResult && mysqli_num_rows($checkResult) > 0) {
        $query = "DELETE FROM wishlist WHERE studentID = '$studentID' AND itemID = $itemID";
        mysqli_query($conn, $query);
    } else {
        $query = "INSERT INTO wishlist (studentID, itemID) VALUES ('$studentID', $itemID)";
        mysqli_query($conn, $query);
    }
}

header('Location: product-detail.php?id=' . $itemID);
exit();
