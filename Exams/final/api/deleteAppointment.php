<?php 
    include 'dbConn.php';
    $conn = getDatabaseConnection();
    
    $sql = "DELETE FROM `scheduler_appointments` 
            WHERE
               scheduler_appointment_id = :id ;";
 
    $stmt = $conn->prepare($sql);
    $stmt->execute(array(':id' => $_GET['id'])); // We NEED to include $namedParameters here

?>