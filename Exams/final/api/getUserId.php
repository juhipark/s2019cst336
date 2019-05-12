<?php

    include 'dbConn.php';
    $conn = getDatabaseConnection();
    

    $sql = "SELECT scheduler_user_id
            FROM  `scheduler_user` 
            WHERE scheduler_user_name = :userName";

    $stmt = $conn->prepare($sql);
    $stmt->execute(array(':userName' => $_GET['userName'])); 
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
	echo json_encode($records);
?>