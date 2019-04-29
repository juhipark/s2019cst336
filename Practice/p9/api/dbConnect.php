<?php
    // heroku_d727c510ebe6dad
    // ottermart
    function getDBConnection($dbname = 'ottermart') {
        $host = "us-cdbr-iron-east-03.cleardb.net"; //heroku
        
        $username = "bb19a5ab5a5448";
        $password = "0558428b";
        $dbname = "heroku_88859229f24938c";
        
        // $host = 'localhost'; //cloud 9 acting as host
        // $username = 'root';
        // $password = '';
   
        //creates db connection
        $dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        
        //displays errors when accessing tables
        $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        return $dbConn;
    }
?>