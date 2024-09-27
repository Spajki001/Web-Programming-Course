<?php
include 'connection.php';
$name = $_SESSION['name'];
$surname = $_SESSION['surname'];

// Retrieve form data
$article = $_POST['article'];
$description = $_POST['description'];
$amount = $_POST['amount'];
$price = $_POST['price'];
$image = $_FILES['image'];

// Process uploaded image and store file path
$targetDir = 'article_images/';
$targetFile = $targetDir . $image['name'];

// Check if file already exists
if (!file_exists($targetFile)) {
    move_uploaded_file($_FILES['image']['tmp_name'], $targetFile);
}

// Prepare SQL query
$sql = "INSERT INTO articles (article, description, amount, price, image_path) VALUES ('$article', '$description', '$amount', '$price', '$targetFile')";
$result = $conn->query($sql);

// Execute query
if ($result) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['error' => 'Failed to add article']);
}
?>