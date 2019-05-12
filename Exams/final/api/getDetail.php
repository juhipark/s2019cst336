<?php

    include 'dbConn.php';
    $conn = getDatabaseConnection();
    
    //	'7/4/2013' ---date format---> '%c/%e/%Y'
    //  '08:00 AM' ---time format---> '%h:%i %p'
    $namedParameters = array();
    $sql = "SELECT 
                scheduler_appointments.scheduler_appointment_id,
                DATE_FORMAT(scheduler_appointment_start_time_date, '%a %D %b %Y %H:%i %p') scheduler_appointment_start_date,
                DATE_FORMAT(scheduler_appointment_end_time_date, '%a %D %b %Y %H:%i %p') scheduler_appointment_end_time_date,
                TIME_FORMAT(scheduler_appointment_duration, '%H:%i') scheduler_appointment_duration,
                scheduler_appointments.scheduler_appointment_reserved,
                scheduler_user.scheduler_user_name
            FROM
                `scheduler_appointments`
            LEFT JOIN 
                `scheduler_user` on scheduler_appointments.scheduler_user_id = scheduler_user.scheduler_user_id
            WHERE
               scheduler_appointment_id = :id ;";
 
    $stmt = $conn->prepare($sql);
    $stmt->execute(array(':id' => $_GET['id'])); // We NEED to include $namedParameters here
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
	echo json_encode($records);
?>