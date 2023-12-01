<?php
include 'connection.php';
    
if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $options = [
        'cost' => 12,
    ];
    $hashed_password = password_hash($password, PASSWORD_BCRYPT, $options);
        
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    $user_exists = false;

    if($result->num_rows > 0){
        echo "Username already exists!<br>";
        echo "Try logging in.<br>";
        $user_exists = true;
        exit();
    }

    $sql = "INSERT INTO users (name, surname, e_mail, username, password) VALUES ('$name', '$surname', '$email', '$username', '$hashed_password')";
    $result = $conn->query($sql);

    if(!$result){
        echo "Registration failed";
    }
    elseif($result && !$user_exists){
        echo "Registration successful!<br>";
        echo "Try logging in.<br>";
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
    <title>Register</title>
</head>
    <body>
        <h1>Register</h1>
        <form action="register.php" method="post">
            <label for="">Name</label><br>
            <input type="text" name="name"><br>
            <label for="">Surname</label><br>
            <input type="text" name="surname"><br>
            <label for="">E-mail</label><br>
            <input type="email" name="email"><br>
            <label for="">Username</label><br>
            <input type="text" name="username"><br>
            <label for="">Password</label><br>
            <input type="password" name="password"><br>
            <button type="submit" class="btn btn-primary btn-sm mt-2" name="submit">Register</button><br>
            <a href="login.php" class="btn btn-outline-secondary btn-sm mt-2" role="button">Login</a>
        </form>
    </body>
</html>