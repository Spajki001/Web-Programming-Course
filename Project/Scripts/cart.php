<?php
include 'connection.php';

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$name = $_SESSION['name'];
$surname = $_SESSION['surname'];

if (isset($_POST['submit']) && isset($id))
{
    $amount = $_POST['amount'];
    $id = $_GET['id'];

    $stmt = $conn->prepare("UPDATE cart SET amount = ? WHERE id = ?");
    $stmt->bind_param("ii", $amount, $id);
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        h1, p{
            text-align: center;
        }
        body{
            text-align: center;
            display: flex;
            justify-content: center;
        }
        .table-container {
            margin-top: 20px;
        }
    </style>
    <title>Cart</title>
</head>
    <body>
        <div class="col">
            <div class="row d-flex justify-content-center align-items-center" style="height: auto">
                <div style="width: 30vw;">
                    <div class="jumbotron">
                        <h1 class="display-4">Cart</h1>
                        <p><script>
                            var name = "<?= $name ?>";
                            var surname = "<?= $surname ?>";
                            document.write("Logged in as " + name + " " + surname);
                        </script></p>
                    </div>
                    <div class="d-inline me-2">
                        <a href="articles.php" class="btn btn-primary" role="button">Articles</a>
                    </div>
                    <div class="d-inline me-2">
                        <a href="checkout.php" class="btn btn-success" role="button">Checkout</a>
                    </div>
                    <div class="d-inline">
                        <a href="logout.php" class="btn btn-outline-danger" role="button">Logout</a>
                    </div>
                </div>
            </div>
            <div class="row table-container">
                <?php
                    $sql = "SELECT * FROM cart";
                    $result = $conn->query($sql);

                    echo "<style>
                    td, th{
                        text-align: center;
                        vertical-align: middle;
                    }
                    </style>";

                    if ($result->num_rows > 0)
                    {
                        echo "<table class='table table-striped table-hover d-flex justify-content-center align-items-center'><tr>
                        <th>Article</th>
                        <th>Description</th>
                        <th>Amount</th>
                        <th>Save</th>
                        <th>Price</th>
                        <th>Remove</th>";
                        while ($row = $result->fetch_assoc())
                        {
                            echo "<tr>
                            <td>" . $row['article'] . "</td>
                            <td>" . $row['description'] . "</td>
                            <td><input type='number' class='form-control' min='1' name='amount' id='amount' style='width: 35%' value='" . $row['amount'] . "'></td><td>
                            <form action='cart.php?id=$row[id]' method='post' enctype='multipart/form-data'>
                              <button type='submit' class='btn btn-outline-primary btn-sm' name='submit'><i class='fa-solid fa-floppy-disk'></i> Submit</button>
                            </form></td>
                            <td>" . $row['price']*$row['amount'] . " €</td>
                            <td><a href='remove_from_cart.php?id=" . $row['id'] . "' class='btn btn-outline-danger btn-sm' role='button'><i class='fa-solid fa-trash'></i> Remove</a></td></tr>";
                        }
                        echo "</table>";
                    }
                    else
                        echo "No articles";
                ?>
            </div>
        </div>
    </body>
</html>