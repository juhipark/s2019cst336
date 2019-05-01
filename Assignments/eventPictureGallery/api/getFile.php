<?php
    include 'dbConn.php';    
    $conn = getDatabaseConnection();

    $httpMethod = strtoupper($_SERVER['REQUEST_METHOD']);
    switch($httpMethod) {
       case "GET":
            $img_mime_types = array("image/jpeg", "image/png", "image/svg+xml", "image/gif"); // images 
            $video_mime_types = array("video/ogg", "video/webm", "video/mp4"); // videos

            $sql = "SELECT * FROM `picture_gallery` WHERE 1";
            
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            $html_records = array();
            
            foreach ($records as $idx => $record) {
                if(in_array($record["gallery_picture_mime"], $img_mime_types)){
                    
                    $img_elem = '<img class="d-block w-100" src="data:'.$record['gallery_picture_mime'].';base64,'
                    .base64_encode($record['gallery_picture_media']).'"/>';
                    
                    $html_records[$idx] = array("image", $img_elem);
                
                }else if (in_array($record["gallery_picture_mime"], $video_mime_types)){
                
                    $video_elem = '<video class="video-fluid d-block w-100" autoplay loop muted>
                    <source type="'.$record["gallery_picture_mime"].'" src="data:'.$record["gallery_picture_mime"].';base64,'.base64_encode($record['gallery_picture_media']) .'">
                    </video>';
                    
                    $html_records[$idx] = array("video", $video_elem);
                }
                
            }
            
            echo json_encode($html_records);
            break;
    }
?>