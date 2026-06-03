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

$escapedStudentID = mysqli_real_escape_string($conn, $studentID);
$query = "DELETE FROM item WHERE itemID = $itemID AND studentID = '$escapedStudentID'";
$deleted = mysqli_query($conn, $query) && mysqli_affected_rows($conn) > 0;
$conn->close();

if ($deleted) {
    $_SESSION['listing_success'] = 'Your listing was deleted.';
} else {
    $_SESSION['listing_errors'] = ['Could not delete this listing. It may not exist or you do not have permission.'];
}

header('Location: ../user/user-profile-dashboard.php');
exit();
