<?php
    include "connect.php";
    $phpJSON = file_get_contents("php://input");
    $phpObject = json_decode($phpJSON, true);
    $fn = $phpObject["firstname"];
    $ln = $phpObject["lastname"];
    $un = $phpObject["username"];
    $em = $phpObject["useremail"];
    $pw = md5($phpObject["password"]);

    $stmtUN = $conn->prepare("SELECT * FROM users WHERE username = :un");
    $stmtUN->execute([":un" => $un]);
    $numUN = $stmtUN->rowCount();
    $stmtEM = $conn->prepare("SELECT * FROM users WHERE email = :em");
    $stmtEM->execute([":em" => $em]);
    $numEM = $stmtEM->rowCount();

    $result = array();
    
    if($numUN == 0 && $numEM == 0) {
        $stmtInsert = $conn->prepare(
            "INSERT INTO users (firstname, lastname, username, email, pwd, userrole) 
            VALUES (:fn, :ln, :un, :em, :pw, 'user')"
        );
        $stmtInsert->execute([
            ":fn" => $fn,
            ":ln" => $ln,
            ":un" => $un,
            ":em" => $em,
            ":pw" => $pw
        ]);
        array_push($result, ["register" => "ok"]);
    }
    else {
        $errorMsg = "";
        if($numUN > 0) {
            $errorMsg .= "Username already exists.";
        }
        if($numEM > 0) {
            $errorMsg .= " E-mail already exists.";
        }
        array_push($result, ["register" => $errorMsg]);
    }


    header('Content-Type: application/json');
    echo json_encode($result, true);
?>