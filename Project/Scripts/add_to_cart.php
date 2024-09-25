<?php
include 'connection.php';
if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM articles WHERE id = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    $article = $row['article'];
    $description = $row['description'];
    $amount = 1;
    $price = $row['price'];
    $image_path = $row['image_path'];

    $sql = "INSERT INTO cart (article, description, amount, price, image_path) VALUES ('$article', '$description', '$amount', '$price', '$image_path')";
    $result = $conn->query($sql);

    header("Location: articles.php");
}
?>