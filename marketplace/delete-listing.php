<?php
session_start();

include '../includes/student-check.php';
include '../db_connection.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../user/user-profile-dashboard.php');
    exit();
}

$itemID = isset($_POST['itemID']) ? intval($_POST['itemID']) : 0;
$studentID = $_SESSION['studentID'];

if ($itemID === 0) {
    $_SESSION['listing_errors'] = ['Invalid listing.'];
    header('Location: ../user/user-profile-dashboard.php');
    exit();
}

$stmt = $conn->prepare('DELETE FROM item WHERE itemID = ? AND studentID = ?');
$stmt->bind_param('is', $itemID, $studentID);
$stmt->execute();
$deleted = $stmt->affected_rows > 0;
$stmt->close();
$conn->close();

if ($deleted) {
    $_SESSION['listing_success'] = 'Your listing was deleted.';
} else {
    $_SESSION['listing_errors'] = ['Could not delete this listing. It may not exist or you do not have permission.'];
}

header('Location: ../user/user-profile-dashboard.php');
exit();
