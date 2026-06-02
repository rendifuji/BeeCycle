<?php
include '../db_connection.php';

$itemID = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($itemID === 0) {
    header('HTTP/1.1 404 Not Found');
    exit();
}

$query = "SELECT itemPhoto FROM item WHERE itemID = $itemID";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

if (!$row || $row['itemPhoto'] === null || $row['itemPhoto'] === '') {
    header('Content-Type: image/jpeg');
    readfile('../assets/headphones.jpeg');
    exit();
}

$image = $row['itemPhoto'];
$imageInfo = @getimagesizefromstring($image);

if ($imageInfo !== false) {
    header('Content-Type: ' . $imageInfo['mime']);
} else {
    header('Content-Type: image/jpeg');
}

echo $image;
exit();
