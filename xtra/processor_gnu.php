<?php
//require_once('dibbs.php')
require_once('broken_dreams.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);
$conn = new mysqli($servername, $username, $password, $dbname);

//////////////////////////////////////////////////////////////
////THIS PROCESSOR ARE BUILT TO WORK WITH Gazelle TRACkERS//////
//////////////////////////////////////////////////////////////


//get the q parameter from URL
$q=$_GET["q"];

//find out which feed was selected
if($q=="Gazelle-tracker1") {
  $xml=("https://trackerurl1.org/rsslink=passkey");
  $chan_tit="Gazelle-tracker 1";
} elseif($q=="Gazelle-tracker2") {
   $xml=("https://trackerurl2.org/rsslink=passkey");
  $chan_tit="Gazelle-tracker 2";
} 

$dc = "http://purl.org/dc/elements/1.1/";
$contan = "http://purl.org/rss/1.0/modules/content/";
$opts = array(
    'http' => array(
        'user_agent' => 'PHP libxml agent',
    )
);

$context = stream_context_create($opts);
libxml_set_streams_context($context);
$xmlDoc = new DOMDocument();
$xmlDoc->load($xml);

//get elements from "<channel>"
$channel=$xmlDoc->getElementsByTagName('channel')->item(0);
$channel_title = $channel->getElementsByTagName('title')
->item(0)->childNodes->item(0)->nodeValue;
$channel_link = $channel->getElementsByTagName('link')
->item(0)->childNodes->item(0)->nodeValue;


$x=$xmlDoc->getElementsByTagName('item');
for ($i=0; $i<=2; $i++) {
  $item_title=$x->item($i)->getElementsByTagName('title')->item(0)->childNodes->item(0)->nodeValue;
  
  $item_source=$x->item($i)->getElementsByTagName('comments')->item(0)->childNodes->item(0)->nodeValue;
  
 

 $imdb = "";
$favico = "??";
    		
  
    $stripname = str_replace(" ", ".", $item_title);
    	$releases = utf8_decode($stripname);
    		
  $nfo = "This tracker does not provide any .nfo or descr. Sorry...";
  
	$imba = "";
	$maze="";
	
	
  preg_match('/^(.+?)(.S[0-9]{2}|.[0-9]{4}|.US.|.SWEDiSH.|.SWESUB.|.MULTi.|.MULTiSUBS.|.DVDr.|.NORDiC.|.COMPLETE.|.E[0-9]{2}.)/i', $item_title, $matchesStart);
  $matchFix = str_replace(" ", ".", $matchesStart[1]);
  echo ("<p>" . $item_title . "");
  echo ("<br>");
  echo $item_source."<br />";
  echo $chan_tit."<br />";
  echo $channel_link."<br />";
  echo $item_title."<br />";
  echo ($releases);
  echo ("<br />releaseStart->".$matchFix. "</p>");

  $searchterm = "nordic";
  if(stripos($item_title, $searchterm) !== false){
  $check="SELECT * FROM feedings WHERE url = '$item_source'";
$rs = mysqli_query($conn,$check);
$data = mysqli_fetch_array($rs, MYSQLI_NUM);
if($data[0] > 1) {
	die();
	} else { 
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error);} 
$sql = "INSERT INTO feedings (favico, url, releases, tracker, time, trackerurl, nfo, releaseStart)
VALUES ('".$favico."', '".$item_source."', '".$releases."', '".$chan_tit."', NOW(), '".$channel_link."', '".$nfo."', '".$matchFix."') ON DUPLICATE KEY UPDATE updates=updates+1";
if ($conn->query($sql) === FALSE) { echo "Error: " . $sql . "<br>" . $conn->error; }
$conn->close();
}
} 
	  $searchterm2 = "swedish";
  if(stripos($item_title, $searchterm2) !== false){
   $check="SELECT * FROM feedings WHERE url = '$item_source'";
$rs = mysqli_query($conn,$check);
$data = mysqli_fetch_array($rs, MYSQLI_NUM);
if($data[0] > 1) {
	die();
	} else { 
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error);} 
$sql = "INSERT INTO feedings (favico, url, releases, tracker, time, trackerurl, nfo, releaseStart)
VALUES ('".$favico."', '".$item_source."', '".$releases."', '".$chan_tit."', NOW(), '".$channel_link."', '".$nfo."', '".$matchFix."') ON DUPLICATE KEY UPDATE updates=updates+1";
if ($conn->query($sql) === FALSE) { echo "Error: " . $sql . "<br>" . $conn->error; }
$conn->close();
}
}
	$searchterm3 = "swesub";
  if(stripos($item_title, $searchterm3) !== false){
  $check="SELECT * FROM feedings WHERE url = '$item_source'";
$rs = mysqli_query($conn,$check);
$data = mysqli_fetch_array($rs, MYSQLI_NUM);
if($data[0] > 1) {
	die();
	} else { 
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error);} 
$sql = "INSERT INTO feedings (favico, url, releases, tracker, time, trackerurl, nfo, releaseStart)
VALUES ('".$favico."', '".$item_source."', '".$releases."', '".$chan_tit."', NOW(), '".$channel_link."', '".$nfo."', '".$matchFix."') ON DUPLICATE KEY UPDATE updates=updates+1";
if ($conn->query($sql) === FALSE) { echo "Error: " . $sql . "<br>" . $conn->error; }
$conn->close();
}
}
	$searchterm3 = "multisubs";
  if(stripos($item_title, $searchterm3) !== false){
  $check="SELECT * FROM feedings WHERE url = '$item_source'";
$rs = mysqli_query($conn,$check);
$data = mysqli_fetch_array($rs, MYSQLI_NUM);
if($data[0] > 1) {
	die();
	} else { 
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error);} 
$sql = "INSERT INTO feedings (favico, url, releases, tracker, time, trackerurl, nfo, releaseStart)
VALUES ('".$favico."', '".$item_source."', '".$releases."', '".$chan_tit."', NOW(), '".$channel_link."', '".$nfo."', '".$matchFix."') ON DUPLICATE KEY UPDATE updates=updates+1";
if ($conn->query($sql) === FALSE) { echo "Error: " . $sql . "<br>" . $conn->error; }
$conn->close();
}
}
	$searchterm3 = "multi";
  if(stripos($item_title, $searchterm3) !== false){
  $check="SELECT * FROM feedings WHERE url = '$item_source'";
$rs = mysqli_query($conn,$check);
$data = mysqli_fetch_array($rs, MYSQLI_NUM);
if($data[0] > 1) {
	die();
	} else { 
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error);} 
$sql = "INSERT INTO feedings (favico, url, releases, tracker, time, trackerurl, nfo, releaseStart)
VALUES ('".$favico."', '".$item_source."', '".$releases."', '".$chan_tit."', NOW(), '".$channel_link."', '".$nfo."', '".$matchFix."') ON DUPLICATE KEY UPDATE updates=updates+1";
if ($conn->query($sql) === FALSE) { echo "Error: " . $sql . "<br>" . $conn->error; }
$conn->close();
}
}
	

}
?>