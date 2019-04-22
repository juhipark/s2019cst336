<?php
//step1
$cSession = curl_init();

//user input parameters

//step2
curl_setopt($cSession,CURLOPT_URL,"https://pixabay.com/api/?key=5589438-47a0bca778bf23fc2e8c5bf3e&"."q=".$_GET['searchKey']."&image_type=photo&orientation=horizontal&safesearch=true&per_page=9");
curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
curl_setopt($cSession,CURLOPT_HEADER, false);

//step3 result is string data type
$results = curl_exec($cSession);
$err = curl_error($cSession);

//step4
curl_close($cSession);
$data = json_decode($results);

//step5
// var_dump($data);
echo json_encode($data);

?>