<?php
    include "../connect.php";
    
    $db = getDBConnection();
    $namedParameters = array();
    
    $query = "SELECT * FROM mp_codes WHERE ";
    
    if(!empty($_GET['promo'])){
        $query .= "promoCode = :promoCodeTyped";
        $namedParameters[":promoCodeTyped"] = $_GET['promo'];
    }
    
    $statement = $db->prepare($query);
    $statement->execute($namedParameters);
    
    $records= $statement->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($records); 
?>