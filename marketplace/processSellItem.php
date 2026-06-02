<?php
include '../includes/student-check.php';
include '../db_connection.php';
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($errors)) {
    //validate item title
    if (empty($_POST['itemTitle'])) {
    $errors[] = "item itel is required.";
    } else {
    $itemTitle = htmlspecialchars(trim($_POST['itemTitle']));
    }

    //category
    if (empty($_POST['category'])) {
    $errors[] = "item category must be selected.";
    } else {
    $category = $_POST['category']; 
    }

    //itemCondition
    if (empty($_POST['itemCondition'])) {
    $errors[] = "item condition must be selected.";
    } else {
    $itemCondition = $_POST['itemCondition']; 
    }

    //price
    if (empty($_POST['price'])) {
    $errors[] = "item price is required.";
    } else {
    $price = htmlspecialchars(trim($_POST['price']));
    }

    //description
    if (empty($_POST['description'])) {
    $errors[] = "item description is required.";
    } else {
    $description = htmlspecialchars(trim($_POST['description']));
    }

    //COD
    if (empty($_POST['COD'])) {
    $errors[] = "COD is required.";
    } else {
    $COD = htmlspecialchars(trim($_POST['COD']));
    }

    //itemPhoto
    $itemPhotoBlob = null;
    if (isset($_FILES['itemPhoto']) && $_FILES['itemPhoto']['error'] == 0) {
        $imageTmpName = $_FILES['itemPhoto']['tmp_name'];
        $itemPhotoBlob = file_get_contents($imageTmpName);
    } else {
        $errors[] = "item photo is required.";
    }

    if (empty($errors)) {
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
            $stmt->close();
            $conn->close();
            header("Location: sellItem.php");
            exit();
        } else {
            $errors[] = "Database Error: Registration failed. Please try again.". $stmt->error;
        }
        $stmt->close();
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Post Item Failed | BeeCycle</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="../style.css" />
</head>
<body>

<?php if (!empty($errors)): ?>
    <h2>Post item Failed</h2>
    <ul>
        <?php foreach ($errors as $error): ?>
            <li><?= $error ?></li>
        <?php endforeach; ?>
    </ul>

    <a href="sellItem.php">Back to item listing</a>
<?php endif; ?>

</body>
</html>