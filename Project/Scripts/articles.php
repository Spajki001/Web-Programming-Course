<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Articles</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="articles.js"></script> 
        <style>
            .container {
                max-width: 1900px;
            }
            .card-container {
                width: 300px;
            }
            .cart-item {
                border-bottom: 1px solid #ccc;
                padding: 10px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="jumbotron text-center">    
                        <h1 class="display-4">Articles</h1>
                        <p><script>
                            <?php
                                include 'connection.php';
                            ?>
                            var name = "<?= $_SESSION['name'] ?>";
                            var surname = "<?= $_SESSION['surname'] ?>";
                            document.write("Logged in as " + name + " " + surname);
                        </script></p>
                    </div>
                    <div class="d-flex justify-content-center mb-3">
                        <div class="d-inline me-2">
                            <?php
                                $html = '';
                                if($_SESSION['role'] == 'admin'){
                                    $html .= '<a href="#" class="btn btn-primary" onclick="showAddModal()" role="button"><i class="fa-solid fa-plus"></i> Add Article</a>';
                                }
                                echo $html;
                            ?>
                        </div>
                        <div class="d-inline me-2">
                            <a href="#" class="btn btn-success" id="showCartModal" role="button"><i class='fa-solid fa-cart-shopping'></i> Cart</a>
                        </div>
                        <div class="d-inline">
                            <a href="logout.php" class="btn btn-outline-danger" role="button"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
                        </div>
                    </div>
                    <div id="article-list"></div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Article</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editForm">
                            <div class="mb-3">
                                <label for="editArticleTitle" class="form-label">Article Title</label>
                                <input type="text" class="form-control" id="editArticleTitle" name="article">
                            </div>
                            <div class="mb-3">
                                <label for="editArticleDescription" class="form-label">Description</label>
                                <textarea class="form-control" id="editArticleDescription" name="description"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="editArticleAmount" class="form-label">Amount</label>
                                <input type="number" class="form-control" id="editArticleAmount" name="amount">
                            </div>
                            <div class="mb-3">
                                <label for="editArticlePrice" class="form-label">Price</label>
                                <input type="text" class="form-control" id="editArticlePrice" name="price">
                            </div>
                            <div class="mb-3">
                                <label for="editArticleImage" class="form-label">Image</label>
                                <input type="file" class="form-control" id="editArticleImage" name="image">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="saveEdit">Save Changes</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="articleDetailsModal" tabindex="-1" aria-labelledby="articleDetailsModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="articleDetailsModalLabel">Article Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <h3 id="modalArticleTitle"></h3>
                        <p id="modalArticleDescription"></p>
                        <p><strong>Amount:</strong> <span id="modalArticleAmount"></span></p>
                        <p><strong>Price:</strong> <span id="modalArticlePrice"></span></p>
                        <img id="modalArticleImage" src="" alt="Article Image" class="img-fluid">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">Add Article</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="addForm">
                            <div class="mb-3">
                                <label for="addArticleTitle" class="form-label">Article Title</label>
                                <input type="text" class="form-control" id="addArticleTitle" name="article" required>
                            </div>
                            <div class="mb-3">
                                <label for="addArticleDescription" class="form-label">Description</label>
                                <textarea class="form-control" id="addArticleDescription" name="description" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="addArticleAmount" class="form-label">Amount</label>
                                <input type="number" class="form-control" id="addArticleAmount" name="amount" required>
                            </div>
                            <div class="mb-3">
                                <label for="addArticlePrice" class="form-label">Price</label>
                                <input type="text" class="form-control" id="addArticlePrice" name="price" required>
                            </div>
                            <div class="mb-3">
                                <label for="addArticleImage" class="form-label">Image</label>
                                <input type="file" class="form-control" id="addArticleImage" name="image" required>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="addArticle">Add Article</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="cartModalLabel">Your Shopping Cart</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="cart-items"></div> 
                        <hr>
                        <div class="d-flex justify-content-end">
                        <h5 class="me-2">Total Price:</h5>
                        <h5 id="cart-total">0.00 €</h5>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="checkout.php" class="btn btn-success" id="checkout">Checkout</a>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>