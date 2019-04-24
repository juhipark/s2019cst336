<?php
    include 'dbConnection.php';
    
    $conn = getDatabaseConnection("ottermart");
    
    $namedParameters = array();

    $sql = "DELETE FROM `img_favorites` WHERE ";
    
    if(!empty($_GET["imgUrl"])){
        $sql .= "img_favorites_url = :imgUrl, ";
        $namedParameters[":imgUrl"] = $_GET["imgUrl"];
    }
    
    $stmt = $conn->prepare($sql);
    $stmt->execute($namedParameters);
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($records);
    
?>