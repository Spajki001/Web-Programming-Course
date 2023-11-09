<?php 
    include "connect.php";
    $dataJSON = file_get_contents("php://input");
    $dataObj = json_decode($dataJSON, true);
    $stmt = $conn->prepare("SELECT * FROM models WHERE mid = :mid");
    $stmt->execute(array(":mid" => $dataObj["manid"]));
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($result, true);
?>