<?php
    include 'dbConn.php';    
    $conn = getDatabaseConnection();
    
    $img_mime_types = array("image/jpeg", "image/png", "image/svg+xml", "image/gif"); // images 
    $video_mime_types = array("video/ogg", "video/webm", "video/mp4"); // videos

    $sql = "SELECT `gallery_picture_mime` FROM `picture_gallery` 
            WHERE `gallery_picture_id`=".$_GET["media_id"];
            
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if(in_array($records[0]["gallery_picture_mime"], $img_mime_types)){
        echo "image";
        exit;
    }else if(in_array($records[0]["gallery_picture_mime"], $video_mime_types)){
        echo "video";
        exit;
    }
        echo "fail";
?>