<?php
    include 'dbConnection.php';
    
    $conn = getDatabaseConnection("ottermart");
    
    $namedParameters = array();

    // $sql = "IF NOT EXISTS (INSERT INTO `img_favorites` 
    // (`img_favorites_url`, `img_favorites_keyword`) VALUES (";
    
    $sql = " `img_favorites` 
        (`img_favorites_url`, `img_favorites_keyword`) VALUES (";
    if(!empty($_GET["imgUrl"])){
        $sql .= ":imgUrl , ";
        $namedParameters[":imgUrl"] = $_GET["imgUrl"];
    }
    
    if(!empty($_GET["imgKeyword"])){
        $sql .=":imgKeyword ))"; 
        $namedParameters[":imgKeyword"] = $_GET["imgimgKeywordUrl"];
    }
    
    $stmt = $conn->prepare($sql);
    $stmt->execute($namedParameters);
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($records);
    
?>