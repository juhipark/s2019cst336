<?php
    include '../dbConnection.php';
    
    $conn = getDatabaseConnection("ottermart");

  

    
    $httpMethod = strtoupper($_SERVER['REQUEST_METHOD']);
    
    switch($httpMethod) {
    case 'PUT':
      // TODO: Access-Control-Allow-Origin
      
        $namedParameters = array();
        
        $sql = "INSERT INTO img_favorites (";
        
        if(!empty($_DELETE['urlLink'])){
        $sql .= "img_favorites_keyword = :urlLink";
        $namedParameters[":urlLink"] = "%" . $_DELETE['urlLink'] . "%";
        }
        // if(){
            
            
        // }
        
        $stmt = $conn->prepare($sql);
        $stmt->execute($namedParameters);
      
      break;
    case 'DELETE':
      // TODO: Access-Control-Allow-Origin
      
    $namedParameters = array();

    $sql = "DELETE FROM img_favorites WHERE ";
    
    if(!empty($_DELETE['urlLink'])){
        $sql .= "img_favorites_keyword = :urlLink";
        $namedParameters[":urlLink"] = "%" . $_DELETE['urlLink'] . "%";
    }
    
    $stmt = $conn->prepare($sql);
    $stmt->execute($namedParameters);
      
      break;
    }
    
?>