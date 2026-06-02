<?php
session_start();

if (!isset($_SESSION['studentID'])) {
    header('Location: ../auth/logIn.php');
    exit();
}
?>
