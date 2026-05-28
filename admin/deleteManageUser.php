<?php
include __DIR__.'/../db_connection.php';
    $id = $_GET['id'];
    mysqli_query($conn,"DELETE FROM user WHERE studentID = '$id'");
    header("Location: manageUser.php");
exit();
?>

