<?php
require_once('TwitterAPIExchange.php');

$hashtag = $_GET["query"];

$settings = array(
    'oauth_access_token' => "1066915601992560640-oOqHW7BU5piqpdeYJrwZbgRQGLRTRS",
    'oauth_access_token_secret' => "tsA7R0cVAkzq94TpCUbgnLRaljSS61YQIPS5cKAdRRf1z",
    'consumer_key' => "GOG1FOPMnejJGuwBnxKdaxIy9",
    'consumer_secret' => "rn1nCBfhbA6ESeMBqmdmU0LcktDG0WdSYMGRFueCIOwiNhMRn1"
);

$url = 'https://api.twitter.com/1.1/tweets/search/30day/prod.json';
$getfield = '?query='.$hashtag.'&fromDate=202107292230&toDate=202107312230&maxResults=100';
$requestMethod = 'GET';

$twitter = new TwitterAPIExchange($settings);
$response = $twitter->setGetfield($getfield)
     ->buildOauth($url, $requestMethod)
     ->performRequest();

echo $response;
?>
