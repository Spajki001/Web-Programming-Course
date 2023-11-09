<?php 
    include "connect.php";
    $stmt = $conn->prepare("SELECT * FROM manufacturers");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($result, true);
?>