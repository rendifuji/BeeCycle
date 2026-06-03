<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header('Location: sellItem.php');
    exit();
}

if (!isset($_SESSION['studentID'])) {
    $_SESSION['sell_errors'] = ["You must be logged in to sell items."];
    header('Location: ../auth/logIn.php');
    exit();
}

include '../db_connection.php';
include '../includes/price-format.php';
$errors = [];

if (empty($_POST['itemTitle'])) {
    $errors[] = "Item title is required.";
} else {
    $itemTitle = htmlspecialchars(trim($_POST['itemTitle']));
}

if (empty($_POST['category'])) {
    $errors[] = "item category must be selected.";
} else {
    $category = $_POST['category'];
}

if (empty($_POST['itemCondition'])) {
    $errors[] = "item condition must be selected.";
} else {
    $itemCondition = $_POST['itemCondition'];
}

if (!isValidPriceInput($_POST['price'] ?? '')) {
    $errors[] = "Price must be a number greater than 0.";
} else {
    $price = normalizePriceInput($_POST['price']);
}

if (empty($_POST['description'])) {
    $errors[] = "item description is required.";
} else {
    $description = htmlspecialchars(trim($_POST['description']));
}

if (empty($_POST['COD'])) {
    $errors[] = "COD is required.";
} else {
    $COD = htmlspecialchars(trim($_POST['COD']));
}

$itemPhotoBlob = null;
if (isset($_FILES['itemPhoto']) && $_FILES['itemPhoto']['error'] == 0) {
    $imageTmpName = $_FILES['itemPhoto']['tmp_name'];
    $itemPhotoBlob = file_get_contents($imageTmpName);
} else {
    $errors[] = "item photo is required.";
}

if (!empty($errors)) {
    $_SESSION['sell_errors'] = $errors;
    header('Location: sellItem.php');
    exit();
}

$studentID = $_SESSION['studentID'];
$stmt = $conn->prepare("INSERT INTO item (studentID, itemTitle, categoryID, conditionID, price, description, COD, itemPhoto) VALUES (?,?,?, ?, ?, ?, ?, ?)");

$blobParam = null;
$stmt->bind_param(
    "sssssssb",
    $studentID,
    $itemTitle,
    $category,
    $itemCondition,
    $price,
    $description,
    $COD,
    $blobParam
);

$stmt->send_long_data(7, $itemPhotoBlob);

if ($stmt->execute()) {
    if (!empty($_POST['CampusLocation'])) {
        $campus = $_POST['CampusLocation'];
        mysqli_query($conn, "UPDATE user SET campus = '$campus' WHERE studentID = '$studentID'");
    }

    $stmt->close();
    $conn->close();
    $_SESSION['sell_success'] = "Your listing was posted!";
    header('Location: homepage.php');
    exit();
}

$errors[] = "Database Error: Could not post item. Please try again." . $stmt->error;
$stmt->close();
$conn->close();

$_SESSION['sell_errors'] = $errors;
header('Location: sellItem.php');
exit();
