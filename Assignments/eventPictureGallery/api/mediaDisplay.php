<?php

 include 'dbConn.php';
 
$conn = getDatabaseConnection();

 $sql = "SELECT * FROM picture_gallery WHERE gallery_picture_id = :id";
 $stmt = $conn->prepare($sql);
 $stmt->execute( array(":id"=> $_GET['id']));

 $stmt->bindColumn('gallery_picture_media', $data, PDO::PARAM_LOB);
 $record = $stmt->fetch(PDO::FETCH_BOUND);

 if (!empty($record)){
    // header('Content-Type: application/octet-stream');

    header('Content-Type:' . $record['gallery_picture_mime']);   //specifies the mime type
    header('Content-Disposition: inline;');
    header("Content-Transfer-Encoding: Binary");


    echo $data;
  }s
  
  
?>