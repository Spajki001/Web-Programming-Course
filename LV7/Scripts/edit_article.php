<?php
include 'connection.php';
$name = $_SESSION['name'];
$surname = $_SESSION['surname'];

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
}

if (isset($_POST['submit']))
{
    $article = $_POST['article'];
    $description = $_POST['description'];
    $amount = $_POST['amount'];
    $price = $_POST['price'];
    $id = $_POST['id'];

    $stmt = $conn->prepare("UPDATE articles SET article = ?, description = ?, amount = ?, price = ? WHERE id = ?");
    $stmt->bind_param("ssisi", $article, $description, $amount, $price, $id);
    try {$stmt->execute();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }

    if ($stmt->affected_rows > 0) {
        echo "Update successful!";
    } else {
        echo "No rows were updated.";
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
        }
    </style>
    <title>Edit_article</title>
</head>
    <body>
        <h1>Edit article</h1>
        <h2><script>
            var name = "<?= $name ?>";
            var surname = "<?= $surname ?>";
            document.write("Welcome " + name + " " + surname + "!");
        </script></h2>
        <form action="edit_article.php" method="post">
            <label for="">Article</label><br>
            <input type="text" name="article" maxlength="100" value="<?= $article ?>" required><br>
            <label for="">Description</label><br>
            <textarea name="description" cols="100" rows="10" maxlength="1000"><?= $description ?></textarea><br>
            <label for="">Amount</label><br>
            <input type="number" name="amount" max="99999" value="<?= $amount ?>" required><br>
            <label for="">Price</label><br>
            <input type="text" name="price" maxlength="5" value="<?= $price ?>" required>
            <label for="">€</label><br><br>
            <input type="hidden" name="id" value="<?= $id ?>">
            <button type="submit" name="submit" class="btn btn-success mb-1">Submit</button><br>
        </form>
        <a href="articles.php" class="btn btn-outline-primary btn-sm" role="button">Show articles</a>
        <a href="logout.php" class="btn btn-outline-danger btn-sm" role="button">Logout</a>
    </body>
</html>