<?php
session_start();
include __DIR__.'/../db_connection.php';
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

// Validate Full Name
if (empty($_POST['fullName'])) {
    $errors[] = "Full name is required.";
} else {
    $fullName = htmlspecialchars(trim($_POST['fullName']));
}

// Validate Email
if (empty($_POST['email'])) {
    $errors[] = "Email Address is required.";
} elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid Email format.";
} else {
    $email = htmlspecialchars(trim($_POST['email']));

    if (!str_ends_with($email, '@binus.ac.id') && !str_ends_with($email, '@binus.edu')) {
            $errors[] = "Registration is exclusive to @binus.ac.id or @binus.edu email addresses.";
        }
}


// Validate studentID
if (empty($_POST['studentID'])) {
    $errors[] = "studentID is required.";
} else {
    $studentID = htmlspecialchars(trim($_POST['studentID']));
    if (!preg_match('/^\d{10}$/', $studentID)) {
        $errors[] = "Student ID must be a 10-digit number.";
    }
}

// Validate campus
if (empty($_POST['campus'])) {
    $errors[] = "campus location must be selected.";
} else {
    $campus = $_POST['campus']; 
}

// Validate whatsapp
if (empty($_POST['whatsapp'])) {
    $errors[] = "phone number is required.";
} else {
    $whatsapp = htmlspecialchars(trim($_POST['whatsapp']));
}

// Validate password
if (empty($_POST['password'])) {
        $errors[] = "Password is required.";
    } else {
        $password = $_POST['password'];
        if (strlen($password) <= 6) {
            $errors[] = "Password must be more than 6 characters long.";
        } else {
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        }
    }

// -----------------
if (empty($errors)) {
        $stmt = $conn->prepare("INSERT INTO user (fullName, email, studentID, campus, whatsapp, password) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param(
            "ssssss",
            $fullName,
            $email,
            $studentID,
            $campus,
            $whatsapp,
            $hashedPassword
        );

        if ($stmt->execute()) {
            $stmt->close();
            $conn->close();
            exit();
        } else {
            $errors[] = "Database Error: Registration failed. Please try again.";
        }
        
        $stmt->close();
    }
    
    $conn->close();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Form Submission</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php if (!empty($errors)): ?>
    <h2>Registration Failed</h2>
    <ul>
        <?php foreach ($errors as $error): ?>
            <li><?= $error ?></li>
        <?php endforeach; ?>
    </ul>

    <a href="register.php">Back to Register</a>
<?php endif; ?>

</body>
</html>