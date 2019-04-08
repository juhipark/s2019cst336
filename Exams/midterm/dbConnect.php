<?php
function getDBConnection(){
    
    $host = "localhost";
    $dbname = "cinder";
    $username = "root";
    $password = "";
    
    $dsn = "mysql:host=$host;dbname=$dbname";
   
   $opt =[
       PDO::ATTR_ERRMODE=> PDO::ERRMODE_EXCEPTION,
       PDO::ATTR_DEFAULT_FETCH_MODE=> PDO::FETCH_ASSOC,
       PDO::ATTR_EMULATE_PREPARES => false,
       ];
       
      $pdo = new PDO($dsn,$username,$password,$opt);
      
      return $pdo;
}
?>