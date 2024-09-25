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
        .card-img-top {
            width: 95%;
            height: 15vw;
            object-fit: contain;
            align-self: center;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
    </style>
    <title>Articles</title>
</head>
    <body style="overflow-x: hidden;">
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
                            echo "<a href='add_article.php' class='btn btn-primary mr-1' role='button'><i class='fa-solid fa-plus'></i> Add article</a>";
                            }
                        ?>
                    </div>
                    <div class="d-inline me-2">
                        <a href="cart.php" class="btn btn-success" role="button"><i class='fa-solid fa-cart-shopping'></i> Cart</a>
                    </div>
                    <div class="d-inline">
                        <a href="logout.php" class="btn btn-outline-danger" role="button"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
                    </div>
                </div>
            </div>
            <div class="row" style="padding-top: 1%; padding-left: 5%; padding-right: 2%; padding-bottom: 1%">
                <?php
                    $sql = "SELECT * FROM articles";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0)
                    {
                        echo "<div class='container text-center'>
                            <div class='row justify-content-around row-cols-4'>";

                        while ($row = $result->fetch_assoc()){
                            echo "<div class='col'>
                                    <div class='card mb-3' style='width: 23rem;'>
                                        <img src='$row[image_path]' class='card-img-top img-fluid' alt='Image'>
                                        <div class='card-body align-items-center justify-content-center'>
                                            <h5 class='card-title text-truncate'>$row[article]</h5>
                                            <p class='card-text'>$row[price] €</p>";
                                            if($_SESSION['role'] == 'admin'){
                                                echo "<td><a href='article_info.php?id=$row[id]' class='btn btn-primary btn-sm' role='button'><i class='fa-solid fa-bars'></i> Read more</a></td>
                                                
                                                <td><a href='add_to_cart.php?id=" . $row['id'] . "' class='btn btn-success btn-sm' role='button'><i class='fa-solid fa-cart-shopping'></i> Add to cart</a></td>

                                                <td><a href='edit_article.php?id=" . $row['id'] . "' class='btn btn-secondary btn-sm' role='button'><i class='fa-solid fa-pen-to-square'></i> Edit</a></td>

                                                <td><a href='delete_article.php?id=" . $row['id'] . "' class='btn btn-outline-danger btn-sm' role='button'><i class='fa-solid fa-trash'></i> Delete</a></td>";
                                            } else {
                                                echo "<a href='article_info.php?id=$row[id]' class='btn btn-primary btn-sm' role='button'><i class='fa-solid fa-bars'></i> Read more</a>";
                                            }
                                        echo "</div>
                                    </div>
                                </div>";
                            // If user is admin, show edit and delete buttons
                            
                        }
                        echo "</div>
                        </div>";
                    }
                    else
                        echo "No articles";
                ?>
            </div>
        </div>
    </body>
</html>