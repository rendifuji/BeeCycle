<?php
session_start();
include '../db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = [];

    if (empty($_POST['email'])) {
        $errors[] = "Email Address is required.";
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid Email format.";
    } else {
        $email = htmlspecialchars(trim($_POST['email']));

        if ($email !== 'admin@gmail.com' && !str_ends_with($email, '@binus.ac.id') && !str_ends_with($email, '@binus.edu')) {
            $errors[] = "Login is exclusive to @binus.ac.id or @binus.edu email addresses.";
        }
    }

    if (empty($_POST['password'])) {
        $errors[] = "Password is required.";
    } else {
        $password = $_POST['password'];
    }

    if (empty($errors)) {
        $stmt = $conn->prepare("SELECT * FROM user WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();

        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['email'] = $user['email'];

            $last_login_time = date('Y-m-d H:i:s');
            setcookie('last_login_time', $last_login_time, time() + (7 * 24 * 60 * 60), '/');

            if ($user['email'] === 'admin@gmail.com') {
                $_SESSION['isAdmin'] = true;
                $stmt->close();
                $conn->close();
                header('Location: ../admin/dashboard.php');
                exit();
            }

            $_SESSION['studentID'] = trim($user['studentID']);
            $_SESSION['initials'] = strtoupper(substr($user['fullName'], 0, 2));

            $stmt->close();
            $conn->close();

            header('Location: ../marketplace/homepage.php');
            exit();
        } else {
            $errors[] = "Invalid email or password!";
        }

        $stmt->close();
    }

    $conn->close();

    $_SESSION['login_errors'] = $errors;
    header('Location: logIn.php');
    exit();
}

header('Location: logIn.php');
exit();
