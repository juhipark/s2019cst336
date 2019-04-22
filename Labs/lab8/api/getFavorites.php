<?php
    include '../dbConnection.php';
    
    $conn = getDatabaseConnection("ottermart");

    $sql = "SELECT * FROM img_favorites ORDER BY img_favorites_keyword";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($records);
?>