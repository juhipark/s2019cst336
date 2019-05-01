<?php 
// http://php.net/manual/en/features.file-upload.multiple.php
    session_start();
    
    include 'dbConn.php';
    
    // Single file upload
    $file = $_FILES['fileName'];


    if ($file["error"] > 0) {
        echo "Error: " . $file["error"] . "<br>";
    }
    else {
        echo "Upload: " . $file["name"] . "<br>";
        echo "Type: " . $file["type"] . "<br>";
        echo "Size: " . ($file["size"] / 1024) . " KB<br>";
        echo "Stored in: " . $file["tmp_name"] . "<br><br>";
        
        uplaodFile($file);
    }  
    
    function uplaodFile(&$file_post) {
        $temp_caption = $_POST['caption'];

        $allowed_mime_types = array("image/jpeg", "image/png", "image/svg+xml", "image/gif", "video/ogg", "video/webm", "video/mp4"); // images & videos
        if($file_post["size"] < 10000000){ // 10,000,000 bytes in 10MB
            if(in_array($file_post["type"], $allowed_mime_types)) {
                $conn = getDatabaseConnection();
                
                //get file's data
                $binary = addslashes(file_get_contents($file_post["tmp_name"]));
                
                //get mime type
                $mime = $file_post["type"];

                $sql = "INSERT INTO `picture_gallery` 
                (`gallery_picture_user_email`, `gallery_picture_caption`, `gallery_picture_mime`, `gallery_picture_media`) VALUES 
                ('".$_SESSION["email"]."', '".$temp_caption."', '".$mime."', '".$binary."')";
                
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                
            }else {
                echo "File is NOT correct format (Allowed: images or vides) <br>";
            }
        }else {
            echo "File is TOO big to uplooad (MAX: 1MB) <br>";
        }
        
    }
    
    // Multiple files upload
    // $file_ary = reArrayFiles($_FILES['fileName']);
    
    // foreach ($file_ary as $file) {
    //     if ($file["error"] > 0) {
    //       echo "Error: " . $file["error"] . "<br>";
    //     }
    //     else {
    //       echo "Upload: " . $file["name"] . "<br>";
    //       echo "Type: " . $file["type"] . "<br>";
    //       echo "Size: " . ($file["size"] / 1024) . " KB<br>";
    //       echo "Stored in: " . $file["tmp_name"] . "<br><br>";
    //     }  
    //     // print 'File Name: ' . $file['name'];
    //     // print 'File Type: ' . $file['type'];
    //     // print 'File Size: ' . $file['size'];
    // }
    
    // Function for multiple files upload
    // function reArrayFiles(&$file_post) {
    //     $file_ary = array();
    //     $file_count = count($file_post['name']);
    //     $file_keys = array_keys($file_post);
    
    //     for ($i=0; $i<$file_count; $i++) {
    //         foreach ($file_keys as $key) {
    //             $file_ary[$i][$key] = $file_post[$key][$i];
    //         }
    //     }
    
    //     return $file_ary;
    // }
?>