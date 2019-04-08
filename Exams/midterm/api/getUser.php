<?php
    include "../dbConnect.php";
    
    $db = getDBConnection();
    $namedParameters = array();

    $query = "SELECT * FROM `user` WHERE 1";
    
    if(!empty($_GET['id'])){
        $query .= " AND id = :id";
        $namedParameters[":id"] = $_GET['id'];
    }
    
    $statement = $db->prepare($query);
    $statement->execute($namedParameters);
    
    $records= $statement->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($records); 

?>