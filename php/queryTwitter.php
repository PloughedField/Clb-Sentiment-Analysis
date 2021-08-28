<?php

$hashtag = $_GET["query"];
$new_hashtag = str_replace(" ","%20",$hashtag);
// echo $new_str

$curl = curl_init();

curl_setopt_array($curl, [
  
  CURLOPT_URL => "https://api.twitter.com/2/tweets/search/all?query=".$new_hashtag."&tweet.fields=created_at&max_results=500",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => [$_ENV["BEARER"]],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}
?>


