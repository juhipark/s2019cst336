<?php
function getDatabaseConnection(){
    
    $host = 'localhost';//cloud 9
    $username = 'root';
    $password = '';
    $dbname = "ottermart";

    //using different database variables in Heroku
    if  (strpos($_SERVER['HTTP_HOST'], 'herokuapp') !== false) {
        $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
        $host = "us-cdbr-iron-east-03.cleardb.net"; //heroku
        $dbname = "heroku_88859229f24938c";
        $username = "bb19a5ab5a5448";
        $password = "0558428b";
    } 
    
    //creates db connection
    $dbConn = new PDO("mysql:host=$host;dbname=$dbname;charset=UTF8;", $username, $password); // change into charset

    //display errors when accessing tables
    $dbConn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $dbConn;
}


?>