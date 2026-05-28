<?php
session_start();
include  __DIR__.'/../db_connection.php';
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
            $_SESSION['studentID'] = $user['studentID'];
            // we add the studentid because thats what is used in the other files to make sure its still the same session

        // Simpan cookie waktu login terakhir (1 minggu)
        $last_login_time = date("Y-m-d H:i:s");
        setcookie("last_login_time", $last_login_time, time() + (7 * 24 * 60 * 60), "/");
            
            $stmt->close();
            $conn->close();
            

            header("Location: ../marketplace/sellitem.php");
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
    <meta charset="UTF-8">
    <title>Form Submission</title>
    <link rel="stylesheet" href="style.css">
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