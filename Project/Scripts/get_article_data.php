<?php
include 'connection.php';
$name = $_SESSION['name'];
$surname = $_SESSION['surname'];
$id = $_GET['id'];
// Fetch article data based on ID and return JSON
$articleId = $_GET['id'];
$sql = "SELECT * FROM articles WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $articleId);
$stmt->execute();
$result = $stmt->get_result();

$data = $result->fetch_assoc();
echo json_encode($data);
?>