<?php

    include 'dbConnection.php';

    $conn = getDatabaseConnection();

//receive email and score from the quiz


//1. Get latest score based on email

    // $_GET['email'] = "juhip@gmail.com";

    $sql = "SELECT * FROM `quiz` WHERE quiz.email = '" . $_GET['email'] . "'";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($records);
    
    //2. If record found, first display it in JSON format, then update record
    if($records){
        //found in the db
        $sql = "UPDATE `quiz` SET taken = taken+1, score = ". $_GET['score'] . " WHERE email = '" . $_GET['email'] . "'";
            
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        
    //3. If record not found, insert a new record for that email
    }else{
        //didn't find in the db
        $sql = "INSERT INTO `quiz` (email, score, taken) VALUES ( '" . $_GET['email'] . "', " . $_GET['score'] . ", 1)";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute();
    }


?>