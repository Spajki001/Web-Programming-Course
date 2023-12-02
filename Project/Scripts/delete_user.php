<?php
include 'connection.php';
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM users WHERE id = $id";
    $result = $conn->query($sql);
    header("Location: user_management.php");
}
?>