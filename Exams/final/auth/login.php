<?php
  session_start();

  $httpMethod = strtoupper($_SERVER['REQUEST_METHOD']);

  switch($httpMethod) {
    case "OPTIONS":
      // Allows anyone to hit your API, not just this c9 domain
      header("Access-Control-Allow-Headers: X-ACCESS_TOKEN, Access-Control-Allow-Origin, Authorization, Origin, X-Requested-With, Content-Type, Content-Range, Content-Disposition, Content-Description");
      header("Access-Control-Allow-Methods: POST, GET");
      header("Access-Control-Max-Age: 3600");
      exit();
    case "GET":
      // TODO: Access-Control-Allow-Origin
      http_response_code(401);
      echo "Not Supported";
      break;
    case 'POST':
      // Get the body json that was sent
      $rawJsonString = file_get_contents("php://input");

      // Make it a associative array (true, second param)
      $jsonData = json_decode($rawJsonString, true);

      // TODO: do stuff to get the $results which is an associative array
      $host = "localhost";
      $dbname = "ottermart";
      $username = "root";
      $password = "";
      
      //using different database variables in Heroku
      if  (strpos($_SERVER['HTTP_HOST'], 'herokuapp') !== false) {
          $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
          $host = "us-cdbr-iron-east-03.cleardb.net"; //heroku
          $dbname = "heroku_88859229f24938c";
          $username = "bb19a5ab5a5448";
          $password = "0558428b";
      } 
  
      // Get Data from DB
      $dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
      $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

      $sql = "SELECT * FROM scheduler_user " .
             "WHERE scheduler_user_name = :username ";
      
      $stmt = $dbConn->prepare($sql);
      $stmt->execute(array (":username" => $_POST['username']));
      
      $record = $stmt->fetch();
      
      $isAuthenticated = password_verify($_POST["password"], $record["scheduler_user_password"]);
        
      if ($isAuthenticated) {
        $_SESSION["username"] = $record["scheduler_user_name"];
      }
      
      // Allow any client to access
      header("Access-Control-Allow-Origin: *");
      // Let the client know the format of the data being returned
      header("Content-Type: application/json");

      // Sending back down as JSON
      echo json_encode(array("isAuthenticated" => $isAuthenticated));

      break;
    case 'PUT':
      // TODO: Access-Control-Allow-Origin
      http_response_code(401);
      echo "Not Supported";
      break;
    case 'DELETE':
      // TODO: Access-Control-Allow-Origin
      http_response_code(401);
      break;
  }
?>