<?php
    include 'dbConn.php';
    
    $conn = getDatabaseConnection("ottermart");

    $httpMethod = strtoupper($_SERVER['REQUEST_METHOD']);
    switch($httpMethod) {
        
        case "GET":
            $sql = "SELECT * FROM om_product ORDER BY om_product.productId"; //-->productName
            
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            echo json_encode($records);
            break;
            
        case "POST":
            $productId = $_POST['productId'];
            // $productId = file_get_contents('php://input');
            
            var_dump($productId);
            // $productId = 34;

            $sql = "SELECT * FROM om_product WHERE productId = :pId";
            
            $np = array(); //np for named parameters
            $np[':pId'] = $productId;
            
            $stmt = $conn->prepare($sql);
            $stmt->execute($np);
            $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            echo json_encode($records);
            break;
            
        case "DELETE":
            
            $_DELETE = file_get_contents('php://input');
            $np = array();
            $sql = "DELETE FROM om_product WHERE ";
        
            $val_list = explode('=',$_DELETE);
            var_dump($val_list[1]);
            
            $productId = intval($val_list[1]);
     
            $sql .= "productId = :pId;";
            $np[":pId"] = $productId;
        

    
            
            $stmt = $conn->prepare($sql);
            $stmt->execute($np);
            
            // var_dump($stmt);

            $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            echo json_encode($records);
            break;
            
    }
?>