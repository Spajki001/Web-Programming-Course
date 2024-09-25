<?php
include 'connection.php';
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $image_path = "SELECT image_path FROM articles WHERE id = $id";
    $result = $conn->query($image_path);
    $row = $result->fetch_assoc();
    $image_path = $row['image_path'];
    unlink($image_path);

    $sql = "DELETE FROM articles WHERE id = $id";
    $result = $conn->query($sql);
    header("Location: articles.php");
}
?>