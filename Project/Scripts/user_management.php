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

// Fetch all users from the database
$query = "SELECT * FROM users";
$result = mysqli_query($conn, $query);

// Handle form submission
if (isset($_POST['submit']))
{
    $id = $_POST['id'];
    $role = $_POST['role'];

    $stmt = $conn->prepare("UPDATE users SET role = ? WHERE id = ?");
    $stmt->bind_param("si", $role, $id);
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
    <title>User management</title>
</head>
    <body>
        <div class="col">
            <div class="d-flex justify-content-center align-items-center" style="height: auto">
                <div style="width: 30vw;">
                    <div class="jumbotron">
                        <h1 class="display-4">User management</h1>
                        <p><script>
                            var name = "<?= $name ?>";
                            var surname = "<?= $surname ?>";
                            document.write("Logged in as " + name + " " + surname);
                        </script></p>
                    </div>
                    <div class="d-inline me-2">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    <div class="d-inline me-2">
                        <a href="articles.php" class="btn btn-outline-secondary">Articles</a>
                    </div>
                    <div class="d-inline">
                        <a href="logout.php" class="btn btn-outline-danger" role="button">Logout</a>
                    </div>
                    <form method="POST">
                        <table>
                            <thead>
                                
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>