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
    <style>
        h1, p{
            text-align: center;
        }
    </style>
    <title>Articles</title>
</head>
    <body>
        <h1>Articles</h1>
        <p><script>
            var name = "<?= $name ?>";
            var surname = "<?= $surname ?>";
            document.write("Logged in as " + name + " " + surname);
        </script></p>
        <div class="text-center pb-3">    
            <?php
                if($_SESSION['role'] == 'admin'){
                    echo "<a href='add_article.php' class='btn btn-primary btn-sm mr-1' role='button'>Add article</a>";
                }
            ?>
            <a href="logout.php" class="btn btn-sm btn-outline-danger" role="button">Logout</a>
        </div>
        <?php
            $sql = "SELECT * FROM articles";
            $result = $conn->query($sql);

            echo "<style>
            td, th{
                text-align: center;
            }
            </style>";

            if ($result->num_rows > 0)
            {
                echo "<table class='table table-striped table-hover'><tr>
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
                        echo "<td><a href='edit_article.php?id=" . $row['id'] . "' class='btn btn-primary btn-sm' role='button'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-fill' viewBox='0 0 16 16'>
                        <path d='M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z'/></svg> Edit</a></td>
                        <td><a href='delete_article.php?id=" . $row['id'] . "' class='btn btn-outline-danger btn-sm' role='button'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'>
                        <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0'/>
                      </svg> Delete</a></td></tr>";
                    } else {
                        echo "</tr>";
                    }
                }
                echo "</table>";
            }
            else
                echo "No articles";
        ?>
    </body>
</html>