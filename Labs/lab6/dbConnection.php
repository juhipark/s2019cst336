<?php

//   // Autoloader
// if (file_exists(DIR_VENDOR . 'autoload.php')) {
//     require_once(DIR_VENDOR . 'autoload.php');
// }
//     $dotenv = Dotenv\Dotenv::create(__DIR__);
//     $dotenv->load();

function getDatabaseConnection($dbname = 'ottermart'){

    $host = "localhost"; //cloud 9
    
    $username = "root";
    $password = "";
    $dbname = "ottermart";
    
    // $host = "us-cdbr-iron-east-03.cleardb.net"; //heroku
    
    // $username = "bb19a5ab5a5448";
    // $password = "0558428b";
    // $dbname = "heroku_88859229f24938c";
    
    //creates db connection
    $dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    //display errors when accessing tables
    $dbConn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $dbConn;
}

?>