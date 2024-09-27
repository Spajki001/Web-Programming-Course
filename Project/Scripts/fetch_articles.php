<?php
include 'connection.php';
$name = $_SESSION['name'];
$surname = $_SESSION['surname'];
$id = $_GET['id'];

// Fetch articles from the database and return HTML
$sql = "SELECT * FROM articles";
$result = $conn->query($sql);

$html = '';
if ($result->num_rows > 0) {
    $html .= '<div class="row container">';
    while ($row = $result->fetch_assoc()) {
        $html .= '<div class="col-md-3 card-container text-center mx-auto" data-article-id="' . $row['id'] . '">';
        $html .= '<div class="card mb-3" style="height: 510px;">'; // Set a fixed height
        $html .= '<img src="' . $row['image_path'] . '" class="card-img-top p-2" alt="Article Image">';
        $html .= '<div class="card-body text-center">';
        $html .= '<h5 class="card-title">' . $row['article'] . '</h5>';
        $html .= '<p class="card-text">' . $row['price'] . ' €</p>';

        if ($_SESSION['role'] == 'admin') {
            $html .= '<a href="#" class="btn btn-primary me-2 mb-2" onclick="showArticleDetailsModal(' . $row['id'] . ')"><i class="fa-solid fa-bars"></i> Read More</a>';
            $html .= '<a href="#" class="btn btn-success me-2 mb-2 add-to-cart-btn" data-article-id="' . $row['id'] . '"><i class="fa-solid fa-cart-shopping"></i> Add to Cart</a>';
            $html .= '<a href="#" class="btn btn-secondary me-2 mb-2" onclick="showEditModal(' . $row['id'] . ')"><i class="fa-solid fa-pen-to-square"></i> Edit</a>';
            $html .= '<a href="delete_article.php?id=' . $row['id'] . '" class="btn btn-outline-danger mb-2" onclick="deleteArticle(' . $row['id'] . ')"><i class="fa-solid fa-trash"></i> Delete</a>';
        } else {
            $html .= '<a href="#" class="btn btn-primary me-2 mb-2" onclick="showArticleDetailsModal(' . $row['id'] . ')"><i class="fa-solid fa-bars"></i> Read More</a>';
            $html .= '<a href="#" class="btn btn-success me-2 mb-2 add-to-cart-btn" data-article-id="' . $row['id'] . '"><i class="fa-solid fa-cart-shopping"></i> Add to Cart</a>';
        }

        $html .= '</div>';
        $html .= '</div>';
        $html .= '</div>';
    }
    $html .= '</div>';
} else {
    $html = '<p>No articles found.</p>';
}

echo json_encode(['html' => $html]);