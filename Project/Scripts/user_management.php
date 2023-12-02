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

// Handle form submission
if (isset($_POST['submit']))
{
    $ids = $_POST['id'];
    $names = $_POST['name'];
    $surnames = $_POST['surname'];
    $emails = $_POST['email'];
    $usernames = $_POST['username'];
    $roles = $_POST['role'];

    // Loop through the submitted changes
    foreach ($ids as $key => $id) {
        $name = $names[$key];
        $surname = $surnames[$key];
        $email = $emails[$key];
        $username = $usernames[$key];
        $role = $roles[$key];

        $stmt = $conn->prepare("UPDATE users SET name = ?, surname = ?, `e-mail` = ?, username = ?, role = ? WHERE id = ?");
        $stmt->bind_param("sssssi", $name, $surname, $email, $username, $role, $id);
        try {
            $stmt->execute();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    if ($stmt->affected_rows > 0) {
        echo "<header>
                    <div class='alert alert-success mt-3' role='alert'>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body{
            text-align: center;
            display: flex;
            justify-content: center;
        }
        .table-container {
            margin-top: 20px;
        }
    </style>
    <title>User management</title>
</head>
    <body>
        <div class="col">
            <div class="row d-flex justify-content-center align-items-center" style="height: auto">
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
                </div>
            </div>
                <div class="row table-container">
                    <form action="user_management.php" method="POST">
                        <table class="table table-striped table-hover justify-content-center align-items-center">
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Surname</th>
                                <th scope="col">E-mail</th>
                                <th scope="col">Username</th>
                                <th scope="col">Role</th>
                                <th scope="col">Delete</th>
                            </tr>
                                <?php
                                    $stmt = $conn->prepare("SELECT * FROM users");
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td hidden><input type='hidden' name='id' value='" . $row['id'] . "'>" . $row['id'] . "</td>";
                                        echo "<td><input type='text' class='form-control' name='name' value='" . $row['name'] . "'></td>";
                                        echo "<td><input type='text' class='form-control' name='surname' value='" . $row['surname'] . "'></td>";
                                        echo "<td><input type='text' class='form-control' name='email' value='" . $row['e_mail'] . "'></td>";
                                        echo "<td><input type='text' class='form-control' name='username' value='" . $row['username'] . "'></td>";
                                        echo "<td><select name='role' class='form-select'>";
                                        echo "<option value='admin'" . ($row['role'] == 'admin' ? ' selected' : '') . ">Admin</option>";
                                        echo "<option value='superuser'" . ($row['role'] == 'superuser' ? ' selected' : '') . ">Superuser</option>";
                                        echo "<option value='user'" . ($row['role'] == 'user' ? ' selected' : '') . ">User</option>";
                                        echo "</select></td>";
                                        echo "<td><a href='delete_user.php?id=" . $row['id'] . "' class='btn btn-outline-danger' role='button'><i class='fa-solid fa-trash'></i> Delete</a></td></tr>";
                                    }
                                    $stmt->close();
                                ?>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>