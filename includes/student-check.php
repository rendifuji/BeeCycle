<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['studentID'])) {
    header('Location: ../auth/logIn.php');
    exit();
}
?>
