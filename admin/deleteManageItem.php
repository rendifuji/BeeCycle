<?php
include __DIR__.'/../db_connection.php';


    $id = $_GET['id'];
    mysqli_query($conn, "DELETE FROM item WHERE itemID = '$id'");
    header("Location: manageListing.php");



exit();
?>