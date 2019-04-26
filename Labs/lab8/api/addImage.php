<?php
    include 'dbConnection.php';
    
    $conn = getDatabaseConnection("ottermart");
    
    $namedParameters = array();

    $sql = "INSERT INTO `img_favorites` 
    (`img_favorites_url`, `img_favorites_keyword`) VALUES ('"
    .$_GET["imgUrl"] . "', '" . $_GET["imgKeyword"] . "')";
    

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    
?>