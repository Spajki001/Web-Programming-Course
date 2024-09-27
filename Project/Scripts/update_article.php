<?php
include 'connection.php';
$name = $_SESSION['name'];
$surname = $_SESSION['surname'];

// Update article based on form data
$article = $_POST['article'];
$description = $_POST['description'];
$amount = $_POST['amount'];
$price = $_POST['price'];
$image = $_FILES['image'];
$articleId = $_POST['articleId'];

$image_path = "SELECT image_path FROM articles WHERE id = $articleId";
    $result = $conn->query($image_path);
    $row = $result->fetch_assoc();
    $image_path = $row['image_path'];

if ($image['name'] != '') {
    $targetDir = 'article_images/';
    $targetFile = $targetDir . $image['name'];

    // Check if file already exists
    if (!file_exists($targetFile)) {
        move_uploaded_file($_FILES['image']['tmp_name'], $targetFile);
        unlink($image_path);
    }

    $sql = "UPDATE articles SET article = ?, description = ?, amount = ?, price = ?, image_path = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssissi', $article, $description, $amount, $price, $targetFile, $articleId);
} else {
    $sql = "UPDATE articles SET article = ?, description = ?, amount = ?, price = ?, image_path = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssissi', $article, $description, $amount, $price, $image_path, $articleId);
}

$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['error' => 'Failed to update article']);
}
?>