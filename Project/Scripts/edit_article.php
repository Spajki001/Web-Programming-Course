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

if($_SESSION['role'] != 'admin'){
    header("Location: articles.php");
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

if (isset($_POST['submit']))
{
    $article = $_POST['article'];
    $description = $_POST['description'];
    $amount = $_POST['amount'];
    $price = $_POST['price'];
    $id = $_POST['id'];
    $targetPath = 'article_images/';
    $targetPath .= basename($_FILES['image']['name']);

    if ($_FILES['image']['name'] == "") {
        $target_path = $image_path;
    } else {
        unlink($image_path);
        move_uploaded_file($_FILES['image']['tmp_name'], $targetPath);
    }

    $stmt = $conn->prepare("UPDATE articles SET article = ?, description = ?, amount = ?, price = ?, image_path = ? WHERE id = ?");
    $stmt->bind_param("ssissi", $article, $description, $amount, $price, $target_path, $id);
    try {$stmt->execute();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }

    if ($stmt->affected_rows > 0) {
        echo "<header>
                    <div class='alert alert-danger mt-3' role='alert'>
                        Update successful!
                    </div>
            <header/>";
    } else {
        echo "<header>
                <div class='alert alert-danger mt-3' role='alert'>
                    No rows were updated.
                </div>
            <header/>";
    }
    $stmt->close();
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
    <title>Edit_article</title>
</head>
    <body>
        <div class="d-flex justify-content-center align-items-center" style="height: auto">
            <div style="width: 30vw;">
                <div class="jumbotron">
                    <h1 class="display-4">Edit article</h1>
                    <h3 class="display-9"><script>
                    var name = "<?= $name ?>";
                    var surname = "<?= $surname ?>";
                    document.write("Welcome " + name + " " + surname + "!");
                    </script></h2>
                </div>
                <form action="edit_article.php" method="post" enctype="multipart/form-data">
                    <div class="form-floating mb-3 mt-3">
                        <input type="text" class="form-control" name="article" id="article" placeholder="Article" maxlength="100" value="<?= $article ?>" required>
                        <label for="article" class="form-label">Article</label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea name="description" class="form-control" id="description" placeholder="Description" maxlength="1000" style="height: 99px;"><?= $description ?></textarea>
                        <label for="description" class="form-label">Description</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" name="amount" id="amount" placeholder="Amount" max="99999" value="<?= $amount ?>" required>
                        <label for="amount" class="form-label">Amount</label>
                    </div>
                    <div class="input-group mb-3">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="price" id="price" placeholder="Price" maxlength="100" value="<?= $price ?>" required>
                            <label for="price" class="form-label">Price</label>
                        </div>
                        <span class="input-group-text">€</span>
                    </div>
                    <div class="input-group mb-3">
                        <input type="file" class="form-control" name="image" id="image" accept="image/*">
                        <label for="image" class="input-group-text">Upload image</label>
                    </div>
                    <div class="form-floating mb-3" hidden>
                        <input type="hidden" name="id" value="<?= $id ?>">
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