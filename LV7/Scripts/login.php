<?php
include 'connection.php';

if (isset($_POST['submit']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $row['username'];
            $_SESSION['password'] = $row['password'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['surname'] = $row['surname'];
            $_SESSION['role'] = $row['role'];

            if ($_SESSION['role'] == 'admin') {
                header("Location: add_article.php");
                exit;
            } else {
                header("Location: articles.php");
                exit;
            }
        } else {
            echo "Invalid password";
        }
    } else {
        echo "Username does not exist!<br>";
        echo "Try registering.<br>";
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
    <title>Login</title>
</head>
    <body>
        <h1>Login</h1>
        <form action="login.php" method="post">
            <label for="">Username</label><br>
            <input type="text" name="username"><br>
            <label for="">Password</label><br>
            <input type="password" name="password"><br>
            <button type="submit" class="btn btn-primary btn-sm mt-2" name="submit">Login</button><br>
            <a href="register.php" class="btn btn-outline-secondary btn-sm mt-2" role="button">Register</a>
        </form>
    </body>
</html>