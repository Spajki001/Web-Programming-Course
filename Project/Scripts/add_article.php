<?php
include 'connection.php';
$name = $_SESSION['name'];
$surname = $_SESSION['surname'];

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

if($_SESSION['role'] != 'admin' && $_SESSION['role'] != 'superuser'){
    header("Location: articles.php");
    exit;
}

if (isset($_POST['submit']))
{
    $article = $_POST['article'];
    $description = $_POST['description'];
    $amount = $_POST['amount'];
    $price = $_POST['price'];

    $sql = "INSERT INTO articles (article, description, amount, price) VALUES ('$article', '$description', '$amount', '$price')";
    $result = $conn->query($sql);

    if ($result){
        header("Location: input_confirm.php");
        exit();
    }else{
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
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
    </style>
    <title>Add_article</title>
</head>
    <body>
        <div class="d-flex justify-content-center align-items-center" style="height: auto">
            <div style="width: 30vw;">
                <div class="jumbotron">
                    <h1 class="display-4">Add article</h1>
                    <h3 class="display-9"><script>
                    var name = "<?= $name ?>";
                    var surname = "<?= $surname ?>";
                    document.write("Welcome " + name + " " + surname + "!");
                    </script></h3>
                </div>
                <form action="add_article.php" method="post">
                    <div class="form-floating mb-3 mt-3">
                        <input type="text" class="form-control" name="article" id="article" placeholder="Article" maxlength="100" required>
                        <label for="article" class="form-label">Article</label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea name="description" class="form-control" id="description" placeholder="Description" maxlength="1000" style="height: 99px;"></textarea>
                        <label for="description" class="form-label">Description</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" name="amount" id="amount" placeholder="Amount" max="99999" required>
                        <label for="amount" class="form-label">Amount</label>
                    </div>
                    <div class="input-group mb-3">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="price" id="price" placeholder="Price" maxlength="100" required>
                            <label for="price" class="form-label">Price</label>
                        </div>
                        <span class="input-group-text">€</span>
                    </div>
                    <div class="d-inline me-2">
                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                    </div>
                    <div class="d-inline me-2">
                        <a href="articles.php" class="btn btn-outline-secondary" role="button">Show articles</a>
                    </div>
                    <div class="d-inline">
                        <a href="logout.php" class="btn btn-outline-danger" role="button">Logout</a>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>