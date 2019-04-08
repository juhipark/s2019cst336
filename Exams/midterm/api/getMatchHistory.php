<?php
    include "../dbConnect.php";
    
    $db = getDBConnection();
    $namedParameters = array();

    $query = "SELECT * 
                FROM `match` WHERE";
    
    if(!empty($_GET['user_id'])){
        $query .= " match_user_id = :user_id";
        $namedParameters[":user_id"] = $_GET['user_id'];
    }
    
    //Left Join ..................................................
    //  $query = "SELECT id, username, picture_url, about_me, answer_timestamp, answer_type_id 
    //             FROM 'user', `match` WHERE";
    // if(!empty($_GET['user_id'])){
        // $query .= " AND user_id = :user_id2";
        // $namedParameters[":user_id2"] = $_GET['user_id'];
        // $query .= " LEFT JOIN `user` ON `match`.`match_user_id` = `user`.id";
        // $query .= " UNION SELECT id, username, picture_url, answer_timestamp, answer_type_id";
        // $query .= " FROM user_id = :user_id2";
    // }
    
    $statement = $db->prepare($query);
    $statement->execute($namedParameters);
    
    $records= $statement->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($records); 

?>