<?php
    include 'dbConnection.php';
    
    $conn = getDatabaseConnection("ottermart");
    
    $namedParameters = array();

    $sql = "DELETE FROM `img_favorites` WHERE " . "img_favorites_url = '".
    $_GET["imgUrl"]."'";
       
    $stmt = $conn->prepare($sql);
    $stmt->execute($namedParameters);
    
?>