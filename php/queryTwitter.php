<?php
require_once('TwitterAPIExchange.php');

$hashtag = $_GET["q"];

$settings = array(
    'oauth_access_token' => "1066915601992560640-oOqHW7BU5piqpdeYJrwZbgRQGLRTRS",
    'oauth_access_token_secret' => "tsA7R0cVAkzq94TpCUbgnLRaljSS61YQIPS5cKAdRRf1z",
    'consumer_key' => "GOG1FOPMnejJGuwBnxKdaxIy9",
    'consumer_secret' => "rn1nCBfhbA6ESeMBqmdmU0LcktDG0WdSYMGRFueCIOwiNhMRn1"
);

$url = 'https://api.twitter.com/1.1/search/tweets.json';
$getfield = '?q= -filter:replies&lang=en&count=10&tweet_mode=extended';
$requestMethod = 'GET';

$twitter = new TwitterAPIExchange($settings);
$response = $twitter->setGetfield($getfield)
     ->buildOauth($url, $requestMethod)
     ->performRequest();

echo $response;
?>
