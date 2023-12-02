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
        $user_exists = true;
        echo "<header>
                <div class='alert alert-danger mt-3' role='alert'>
                    Username already exists!<br>Try logging in.
                </div>
            <header/>";
    } else {
        $sql = "INSERT INTO users (name, surname, e_mail, username, password) VALUES ('$name', '$surname', '$email', '$username', '$hashed_password')";
        $result = $conn->query($sql);

        if(!$result){
            echo "<header>
                    <div class='alert alert-danger mt-3' role='alert'>
                        Registration failed.
                    </div>
                <header/>";
        }
        elseif($result && !$user_exists){
            echo "<header>
                    <div class='alert alert-danger mt-3' role='alert'>
                        Registration successful!<br>Try logging in.
                    </div>
                <header/>";
        }
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
    <title>Register</title>
</head>
    <body>
        <div class="d-flex justify-content-center align-items-center" style="height: auto">
            <div style="width: 30vw;">
                <div class="jumbotron">
                    <h1 class="display-4">Register</h1>
                </div>
                <form action="register.php" method="post">
                    <div class="form-floating mb-3 mt-3">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
                        <label for="name" class="form-label">Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="surname" name="surname" placeholder="Surname"  required>
                        <label for="surname" class="form-label">Surname</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="email" name="email" placeholder="E-mail"  required>
                        <label for="email" class="form-label">E-mail</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username"  required>
                        <label for="username" class="form-label">Username</label>
                    </div>
                    <div class="form-floating mb-2">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password"  required>
                        <label for="password" class="form-label">Password</label>
                    </div>
                    <div class="d-inline me-2">
                        <button type="submit" class="btn btn-primary mt-2" name="submit">Register</button>
                    </div>
                    <div class="d-inline">
                        <a href="login.php" class="btn btn-outline-secondary mt-2" role="button">Login</a>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>