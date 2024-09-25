<?php
include 'connection.php';
if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM cart WHERE id = $id";
    $result = $conn->query($sql);
    header("Location: cart.php");
}
?>