<?php
include 'connection.php';

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$name = $_SESSION['name'];
$surname = $_SESSION['surname'];
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
    <title>Articles</title>
</head>
    <body>
        <div class="col">
            <div class="row d-flex justify-content-center align-items-center" style="height: auto">
                <div style="width: 30vw;">
                    <div class="jumbotron">
                        <h1 class="display-4">Articles</h1>
                        <p><script>
                            var name = "<?= $name ?>";
                            var surname = "<?= $surname ?>";
                            document.write("Logged in as " + name + " " + surname);
                        </script></p>
                    </div>
                    <div class="d-inline me-2">
                        <?php
                            if($_SESSION['role'] == 'admin'){
                            echo "<a href='add_article.php' class='btn btn-primary mr-1' role='button'>Add article</a>";
                            }
                        ?>
                    </div>
                    <div class="d-inline">
                        <a href="logout.php" class="btn btn-outline-danger" role="button">Logout</a>
                    </div>
                </div>
            </div>
            <div class="row table-container">
                <?php
                    $sql = "SELECT * FROM articles";
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
                        <th>Price</th>";
                        // If user is admin, show edit and delete columns
                        if($_SESSION['role'] == 'admin'){
                            echo "<th>Edit</th>
                            <th>Delete</th></tr>";
                        } else {
                            echo "</tr>";
                        }
                        while ($row = $result->fetch_assoc())
                        {
                            echo "<tr><td>" . $row['article'] . "</td><td>" . $row['description'] . "</td><td>" . $row['amount'] . "</td><td>" . $row['price'] . "€</td>";
                            // If user is admin, show edit and delete buttons
                            if($_SESSION['role'] == 'admin'){
                                echo "<td><a href='edit_article.php?id=" . $row['id'] . "' class='btn btn-primary btn-sm' role='button'><i class='fa-solid fa-pen-to-square'></i> Edit</a></td>
                                <td><a href='delete_article.php?id=" . $row['id'] . "' class='btn btn-outline-danger btn-sm' role='button'><i class='fa-solid fa-trash'></i> Delete</a></td></tr>";
                            } else {
                                echo "</tr>";
                            }
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