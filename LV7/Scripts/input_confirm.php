<?php
include 'connection.php';

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
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
    <title>Input confirmation</title>
</head>
    <body>
        <div class="d-flex justify-content-center align-items-center" style="height: auto">
            <div style="width: 50vw;">
                <div class="jumbotron">
                    <h1 class="display-4">Article has been added succesfully!</h1>
                </div>
                <div class="d-inline me-2">
                    <a href="add_article.php" class="btn btn-outline-danger" role="button">Back to add article</a>
                </div>
                <div class="d-inline">
                    <a href="articles.php" class="btn btn-primary" role="button">Show articles</a>
                </div>
            </div>
        </div>
    </body>
</html>