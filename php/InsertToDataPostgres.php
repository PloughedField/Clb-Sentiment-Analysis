<html>
  <head>
    <title>PHP Test</title>
  </head>
  <body>

 <?php
 
 function guidv4($data = null) {
  // Generate 16 bytes (128 bits) of random data or use the data passed into the function.
  $data = $data ?? random_bytes(16);
  assert(strlen($data) == 16);

  // Set version to 0100
  $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
  // Set bits 6-7 to 10
  $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

  // Output the 36 character UUID.
  return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}



// $hashtag = $_GET["q"];

// $arr = json_decode( $hashtag, true );
// print_r($arr);
// echo $arr[0]["created_at"];
// foreach($array as $item) { //foreach element in $arr
//   $uses = $item['created_at']; //etc
//   echo $uses

// }
// echo " script! Executed";
// echo $hashtag;

// // echo json_encode($hashtag);
// $request_id = guidv4();
// $ts = date("Y-m-d H:i:s");

// list($search_twit, $sentiment, $score, $tweet,$created_at) = explode(";", $hashtag);
// // echo $tweet
// // echo $created_at
// // echo $search_twit, $sentiment, $score, $tweet ,$created_at
$db_handle = pg_connect("host=ec2-52-0-67-144.compute-1.amazonaws.com dbname=d5joavsksmfhff user=jzgreihhqmjaoz password=0b45ef82aa497ddd5cd13c5311a94d3bbe8cafd14621e8b5321fa46e2958adad");


if ($db_handle) {

echo 'Connection attempt succeeded.';
$ajaxadata = json_decode($_POST['jsnos'], true);

$arr_length = count($ajaxadata);

for($i=0;$i<$arr_length;$i++)
{
  $request_id = guidv4();
  $ts = date("Y-m-d H:i:s");
  $search_twit = $ajaxadata[$i]['search_twit'];
  $sentiment = $ajaxadata[$i]['sentiment'];
  $score = $ajaxadata[$i]['score']; 
  $tweet = $ajaxadata[$i]['tweet'];
  $created_tweet = $ajaxadata[$i]['created_at'];
  
  $query = "INSERT INTO twitter_clb_new (request_id,ts,search_twit,sentiment,score,tweet,created_tweet) VALUES ('$request_id','$ts','$search_twit','$sentiment','$score','''$tweet''','$created_tweet');";
 

  $result = pg_query($db_handle, $query);
  // echo $result ;
 
};


// pg_query("create table twitter_clb_new (request_id text PRIMARY KEY,
// ts timestamp NOT NULL,
// search_twit text NOT NULL,
// sentiment text NOT NULL,
// score double precision NOT NULL,
// tweet text NOT NULL,
// created_tweet text NOT NULL)");

// echo " script! Executed";
// $request_id = guidv4();
// echo $request_id;
// $score = 0.99;
// $search_twit = 'PPPP';
// $sentiment = "positiv";
// $ts = date("Y-m-d H:i:s");
// echo $ts;
// $tweet = "ABC";




// $query = "INSERT INTO twitter_clb_new (request_id,ts,search_twit,sentiment,score,tweet,created_tweet) VALUES ('$request_id','$ts','$search_twit','$sentiment','$score','$tweet','$created_at')";

// $result = pg_query($db_handle, $query);
} else {

echo 'Connection attempt failed.';

}

pg_close($db_handle);

?>
  </body>
</html>
