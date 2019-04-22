<?php
    // heroku_d727c510ebe6dad
    // ottermart
    function getDBConnection($dbname = 'ottermart') {
        // $host = 'us-cdbr-iron-east-03.cleardb.net'; //cloud 9 acting as host
        // $username = 'b8282773fb41e0';
        // $password = 'a78ad875';
        
        $host = 'localhost'; //cloud 9 acting as host
        $username = 'root';
        $password = '';
   
        //creates db connection
        $dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        
        //displays errors when accessing tables
        $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        return $dbConn;
    }
?>