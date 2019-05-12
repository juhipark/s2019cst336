<?php 
    include 'dbConn.php';
    $conn = getDatabaseConnection();
        // var_dump(json_encode($_GET['slotsInfo']));

   
    $sql = "";
    for($i = 0; $i < sizeof($_GET['slotsInfo']); $i++){  
        $eachInfo = $_GET['slotsInfo'][$i];
        
        $eachSql = "INSERT INTO `scheduler_appointments`
                (`scheduler_appointment_start_time_date`, `scheduler_appointment_end_time_date`, `scheduler_appointment_duration`, `scheduler_appointment_reserved`, `scheduler_user_id`) 
            VALUES
                ('".$eachInfo[0]."', '".$eachInfo[1]."', '".$eachInfo[2]."', ".$eachInfo[3].", ".$eachInfo[4].");";

        $sql .= $eachSql;   
    }
    
    
    $stmt = $conn->prepare($sql);
    $stmt->execute(); 
            

    // $sql = "INSERT INTO `scheduler_appointments`
    //             (`scheduler_appointment_start_time_date`, `scheduler_appointment_end_time_date`, `scheduler_appointment_duration`, `scheduler_user_id`) 
    //         VALUES
    //             (:something, :something, :somthing);";
 
    // $stmt = $conn->prepare($sql);
    // $stmt->execute(array(':id' => $_GET['id'])); // We NEED to include $namedParameters here

?>