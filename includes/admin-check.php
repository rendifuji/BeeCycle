<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['isAdmin'])) {
    header('Location: ../auth/logIn.php');
    exit();
}
?>
