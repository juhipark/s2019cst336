<?php

    include 'dbConn.php';
    $conn = getDatabaseConnection();
    
    //	'7/4/2013' ---date format---> '%c/%e/%Y'
    //  '08:00 AM' ---time format---> '%h:%i %p'
    
    $namedParameters = array();
    $sql = "SELECT 
                scheduler_appointments.scheduler_appointment_id,
                DATE_FORMAT(scheduler_appointment_start_time_date, '%Y-%m-%d') scheduler_appointment_start_date,
                DATE_FORMAT(scheduler_appointment_start_time_date, '%H:%i %p') scheduler_appointment_start_time,
                TIME_FORMAT(scheduler_appointment_duration, '%H:%i') scheduler_appointment_duration,
                scheduler_appointments.scheduler_appointment_reserved,
                scheduler_user.scheduler_user_name
            FROM
                `scheduler_appointments`
            LEFT JOIN 
                `scheduler_user` on scheduler_appointments.scheduler_user_id = scheduler_user.scheduler_user_id
            WHERE
               scheduler_appointment_start_time_date >= CURDATE() AND scheduler_user_name = :userName
            ORDER BY 
                scheduler_appointments.scheduler_appointment_start_time_date ASC;";
                
    $stmt = $conn->prepare($sql);
    $stmt->execute(array(':userName' => $_GET['userName'])); // We NEED to include $namedParameters here
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
	echo json_encode($records);
?>