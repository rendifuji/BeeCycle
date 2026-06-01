<?php
session_start();
include '../db_connection.php';
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate Email 
    if (empty($_POST['email'])) {
        $errors[] = "Email Address is required.";
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid Email format.";
    } else {
        $email = htmlspecialchars(trim($_POST['email']));

        if (!str_ends_with($email, '@binus.ac.id') && !str_ends_with($email, '@binus.edu')) {
            $errors[] = "Login is exclusive to @binus.ac.id or @binus.edu email addresses.";
        }
    } 

    // Validate Password 
    if (empty($_POST['password'])) {
        $errors[] = "Password is required.";
    } else {
        $password = $_POST['password'];
    }

    // Process 
    if (empty($errors)) {
        $stmt = $conn->prepare("SELECT * FROM user WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        // Check 
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

            $_SESSION['studentID'] = $user['studentID'];
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
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Failed | BeeCycle</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="../style.css" />
    <link rel="stylesheet" href="../auth.css" />
</head>
<body>

<?php if (!empty($errors)): ?>
    <h2>Log in Failed</h2>
    <ul>
        <?php foreach ($errors as $error): ?>
            <li><?= $error ?></li>
        <?php endforeach; ?>
    </ul>

    <a href="logIn.php">Back to Login</a>
<?php endif; ?>

</body>
</html>