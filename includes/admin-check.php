<?php
session_start();

if (!isset($_SESSION['isAdmin'])) {
    header('Location: ../auth/logIn.php');
    exit();
}
?>
