<?php
include 'connection.php';
$name = $_SESSION['name'];
$surname = $_SESSION['surname'];
$id = $_GET['id'];

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

if(isset($id)) {
    $sql = "SELECT * FROM articles WHERE id = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    $article = $row['article'];
    $description = $row['description'];
    $amount = $row['amount'];
    $price = $row['price'];
    $image_path = $row['image_path'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <style>
        body{
            text-align: center;
            display: flex;
            justify-content: center;
        }
        td, th{
            text-align: center;
            vertical-align: middle;
        }
    </style>
    <title><?= $article ?></title>
</head>
    <body>
    <div class="col">
            <div class="row d-flex justify-content-center align-items-center" style="height: auto">
                <div style="width: 30vw;">
                    <div class="jumbotron">
                        <h1 class="display-4"><?= $article ?></h1>
                        <p><script>
                            var name = "<?= $name ?>";
                            var surname = "<?= $surname ?>";
                            document.write("Logged in as " + name + " " + surname);
                        </script></p>
                    </div>
                    <div class="d-inline me-2">
                        <a href="articles.php" class="btn btn-primary" role="button"><i class="fa-solid fa-house"></i> Articles</a>
                    </div>
                    <div class="d-inline me-2">
                        <a href="cart.php" class="btn btn-success" role="button"><i class='fa-solid fa-cart-shopping'></i> Cart</a>
                    </div>
                    <div class="d-inline">
                        <a href="logout.php" class="btn btn-outline-danger" role="button"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12">
                    <h2 class="text-center fw-bold">Article Information</h2>
                </div>
                <div class="col-md-6">
                    <table class='table table-striped table-hover'>
                        <tr>
                            <th><strong>Article</strong></th>
                            <td><?= $article ?></td>
                        </tr>
                        <tr>
                            <th><strong>Description</strong></th>
                            <td><?= $description ?></td>
                        </tr>
                        <tr>
                            <th><strong>Available</strong></th>
                            <td><?= $amount ?></td>
                        </tr>
                        <tr>
                            <th><strong>Price</strong></th>
                            <td>$<?= $price ?></td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <img src="<?= $image_path ?>" alt="<?= $article ?>" class="img-fluid">
                </div>
            </div>
        </div>
    </body>
</html>