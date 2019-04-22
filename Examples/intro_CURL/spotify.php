<?php

/*
Here is what my command would look like on the command line
curl -X "GET" "https://api.spotify.com/v1/search?q=night%20moves&type=track&market=US" 
        -H "Accept: application/json" 
        -H "Content-Type: application/json" 
        -H "Authorization: Bearer BQAAfOE5R_xobiXxycv0-heBfPpx-ANe1qFW-FfVCQ8I_4aGR2iL8nCs3-CYUQXf9xS6eyyIlH55ywCHKE2-MvVV7Dd3wAuQwHU_uk1r_P98qvhIqelCTUXwy4MDosmZXW0jw_l8mqw9OxQXd2MEHEjGKgNihKf5aQ"   
"
*/

// Set the API key for my test account
$apiKey = "BQAAfOE5R_xobiXxycv0-heBfPpx-ANe1qFW-FfVCQ8I_4aGR2iL8nCs3-CYUQXf9xS6eyyIlH55ywCHKE2-MvVV7Dd3wAuQwHU_uk1r_P98qvhIqelCTUXwy4MDosmZXW0jw_l8mqw9OxQXd2MEHEjGKgNihKf5aQ";
$query = "blackpink";
$type = "track";
$market = "US";

// Setup the CURL session
$cSession = curl_init();

// Setup the CURL options
// curl_setopt($cSession,CURLOPT_URL,"https://api.spotify.com/v1/browse/featured-playlists");
curl_setopt($cSession,CURLOPT_URL,"https://api.spotify.com/v1/search?q=$query&type=$type&market=$market");
curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
curl_setopt($cSession,CURLOPT_HEADER, false);

// Add headers to the HTTP command
curl_setopt($cSession,CURLOPT_HTTPHEADER, array(
    "Accept: application/json",
    "Content-Type: application/json",
    "Authorization: Bearer $apiKey"
));

// Execute the CURL command
$results = curl_exec($cSession);

// Check for specific non-zero error numbers
$errno = curl_errno($cSession);
if ($errno) {
    switch ($errno) {
        default:
            echo "Error #$errno...execution halted";
            break;
    }

    // Close the session and exit
    curl_close($cSession);
    exit();
}

// Close the session
curl_close($cSession);

// HintL: it is sometimes helpful to take echo the
// $results out and copy the array, then paste it into
// a beautifier online to see the data. For example, you
// could put the string JSON $results into the site
// https://codebeautify.org/jsonviewer

// Convert the results to an associative array
$musicData = json_decode($results);

// Let's just get one of the items and echo the JSON for that only.
// echo json_encode($musicData->playlists->items[0]);
echo json_encode($musicData->tracks->items[0]);

// tokens may get expires regularly (every hour)
// function refreshToken(){
//     clientID = "51839e97c8c14629ba20b2e46b0b9887";
//     clientSecret = "b27d64aca7444e1faea5ffffd9cffbdc";
    
// }

?>

