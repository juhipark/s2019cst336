<?php


function getDatabaseConnection($dbname = 'ottermart'){
    
    // $host = 'localhost';//cloud 9
    // //$dbname = 'tcp';
    // $username = 'root';
    // $password = '';
    
    $host = "us-cdbr-iron-east-03.cleardb.net"; //heroku
    $username = "bb19a5ab5a5448";
    $password = "0558428b";
    $dbname = "heroku_88859229f24938c";
    
    //using different database variables in Heroku
    // if  (strpos($_SERVER['HTTP_HOST'], 'herokuapp') !== false) {
    //     $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
    //     $host = $url["host"];
    //     $dbname = substr($url["path"], 1);
    //     $username = $url["user"];
    //     $password = $url["pass"];
    // } 
    
    //creates db connection
    $dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    
    //display errors when accessing tables
    $dbConn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $dbConn;
    
}




?>