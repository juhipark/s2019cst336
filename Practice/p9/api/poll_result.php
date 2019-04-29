<?php
    include 'dbConnect.php';

    session_start();
    
    if(isset($_SESSION['answered'])){
        $_SESSION['answered'] = "false";
    }
    
    $conn = getDBConnection();
    
    $httpMethod = strtoupper($_SERVER['REQUEST_METHOD']);

    switch($httpMethod) {
        
        case "POST":
            echo $_SESSION['answered'];
            break;
        case "GET":
              
        // if($_GET['checkedIdx'] != -1){
        //     $sql = "INSERT INTO `poll_response` (`pollId`, `option1`, `option2`, `option3`, `option4`, `option5`) VALUES (";
            
        //     for ($x = 0; $x < 5; $x++) {
        //         if($x == $_GET['checkedIdx']){
        //             $sql .= "100";
        //         }else{
        //             $sql .= "0";
        //         }
        //          if($x == 4) break;
        //             $sql .= ", ";
        //     } 
            
        //     $sql .= ");";
    
        // }else{
        //     $sql = "INSERT INTO `poll_response` (`pollId`, `option1`, `option2`, `option3`, `option4`, `option5`) VALUES ('q1', 0, 0, 0, 0, 0);";
        // }
        $_SESSION['answered'] = "true";
        //Preparing the DB Table
        $sql = "UPDATE `poll_response` SET " . $_GET['checked'] . " = 100 WHERE 1;";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        
        //Get the returned value
        $sql = "SELECT * FROM poll_response;";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($records);
        break;
    }
    
 

?>