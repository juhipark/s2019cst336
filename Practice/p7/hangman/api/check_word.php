<?php
//Used to check the letter the user inputed in the form, and if the letter is in the word
//Should return an array of booleans as the api
include '../dbConnection.php';
$conn = getDatabaseConnection("ottermart");

$temp_id = intval($_GET["checkWordID"]);
$temp_letter = strval($_GET["checkLetter"]);


$sql = "SELECT word FROM words WHERE word_id = $temp_id";
$stmt = $conn -> prepare($sql);
$stmt->execute();
$temp_array = $stmt->fetch(PDO::FETCH_ASSOC);
$temp_record = strval($temp_array["word"]);

$record_array = array("bool" => is_numeric(strpos($temp_record, $temp_letter)), "index"=>strpos($temp_record, $temp_letter));

echo json_encode($record_array);

?>