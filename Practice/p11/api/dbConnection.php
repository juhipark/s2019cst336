<?php


function getDatabaseConnection($dbname = 'ottermart'){
    
    $host = 'localhost';//cloud 9
    $username = 'root';
    $password = '';
    
    //using different database variables in Heroku
    if  (strpos($_SERVER['HTTP_HOST'], 'herokuapp') !== false) {
        $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
        $host = "us-cdbr-iron-east-03.cleardb.net"; //heroku
        $dbname = "heroku_88859229f24938c";
        $username = "bb19a5ab5a5448";
        $password = "0558428b";
    } 
    
    //creates db connection
    $dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    
    //display errors when accessing tables
    $dbConn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $dbConn;
    
}




?>