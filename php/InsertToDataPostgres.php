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


$hashtag = $_GET["q"];

list($search_twit, $sentiment, $score, $tweet) = explode(",", $hashtag);
    
$db_handle = pg_connect("host=ec2-52-0-67-144.compute-1.amazonaws.com dbname=d5joavsksmfhff user=jzgreihhqmjaoz password=0b45ef82aa497ddd5cd13c5311a94d3bbe8cafd14621e8b5321fa46e2958adad");

if ($db_handle) {

echo 'Connection attempt succeeded.';
// // pg_query("create table twitter_clb (request_id text PRIMARY KEY,
// // ts timestamp NOT NULL,
// // search_twit text NOT NULL,
// // sentiment text NOT NULL,
// // score double precision NOT NULL,
// // tweet text NOT NULL)");


$request_id = guidv4();
echo $request_id;
$ts = date("Y-m-d H:i:s");
$query = "INSERT INTO twitter_clb (request_id,ts,search_twit,sentiment,score,tweet) VALUES ('$request_id','$ts','$search_twit','$sentiment','$score','$tweet')";
$result = pg_query($db_handle, $query);
} else {

echo 'Connection attempt failed.';

}

pg_close($db_handle);

?>
  </body>
</html>
