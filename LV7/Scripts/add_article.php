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
        }
    </style>
    <title>Add_article</title>
</head>
    <body>
        <h1>Add article</h1>
        <h2><script>
            var name = "<?= $name ?>";
            var surname = "<?= $surname ?>";
            document.write("Welcome " + name + " " + surname + "!");
        </script></h2>
        <form action="add_article.php" method="post">
            <label for="">Article</label><br>
            <input type="text" name="article" maxlength="100" required><br>
            <label for="">Description</label><br>
            <textarea name="description" cols="100" rows="10" maxlength="1000"></textarea><br>
            <label for="">Amount</label><br>
            <input type="number" name="amount" max="99999" required><br>
            <label for="">Price</label><br>
            <input type="text" name="price" maxlength="5" required>
            <label for="">€</label><br><br>
            <button type="submit" name="submit" class="btn btn-success mb-1">Submit</button><br>
        </form>
        <a href="articles.php" class="btn btn-outline-primary btn-sm" role="button">Show articles</a>
        <a href="logout.php" class="btn btn-outline-danger btn-sm" role="button">Logout</a>
    </body>
</html>