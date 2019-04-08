<?php
    include "../connect.php";
    
    $db = getDBConnection();
    $namedParameters = array();

    $query = "SELECT * FROM mp_product WHERE 1";
    
    if(!empty($_GET['productName'])){
        $query .= " AND productName = :productName";
        $namedParameters[":productName"] = $_GET['productName'];
    }
    
    $statement = $db->prepare($query);
    $statement->execute($namedParameters);
    
    $records= $statement->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($records); 
?>