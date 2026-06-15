<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include '../db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = [];

    if (empty($_POST['fullName'])) {
        $errors[] = "Full name is required.";
    } else {
        $fullName = htmlspecialchars(trim($_POST['fullName']));
    }

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

    if (empty($_POST['studentID'])) {
        $errors[] = "studentID is required.";
    } else {
        $studentID = htmlspecialchars(trim($_POST['studentID']));
        if (!preg_match('/^\d{10}$/', $studentID)) {
            $errors[] = "Student ID must be a 10-digit number.";
        }
    }

    if (empty($_POST['campus'])) {
        $errors[] = "campus location must be selected.";
    } else {
        $campus = $_POST['campus'];
    }

    if (empty($_POST['whatsapp'])) {
        $errors[] = "phone number is required.";
    } else {
        $whatsapp = htmlspecialchars(trim($_POST['whatsapp']));
    }

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
            $_SESSION['register_success'] = "Account created! You can log in now.";
            header('Location: logIn.php');
            exit();
        } else {
            if ($conn->errno === 1062) {
                $errors[] = "That email is already registered. Please log in instead.";
            } else {
                $errors[] = "Database Error: Registration failed. Please try again.";
            }
        }

        $stmt->close();
    }

    $conn->close();

    $_SESSION['register_errors'] = $errors;
    header('Location: register.php');
    exit();
}

header('Location: register.php');
exit();
