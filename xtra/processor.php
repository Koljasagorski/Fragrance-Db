<?php
require_once('broken_dreams.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);
$conn = new mysqli($servername, $username, $password, $dbname);

//////////////////////////////////////////////////////////////
////THIS PROCESSOR ARE BUILT TO WORK WITH RARTRACKERS/////////
//////////////////////////////////////////////////////////////

//get the q parameter from URL
$q=$_GET["q"];

//find out which feed was selected
if($q=="tracker1") {
  $xml=("https://Trackerurl.org/rsslink=passkey");
} elseif($q=="tracker2") {
  $xml=("https://Trackerurl2.org/rsslink=passkey");
} elseif($q=="tracker3") {
  $xml=("https://Trackerurl3.org/rsslink=passkey");
} elseif($q=="tracker4") {
  $xml=("https://Trackerurl4.org/rsslink=passkey");
} elseif($q=="tracker5") {
  $xml=("https://Trackerurl5.org/rsslink=passkey");
}



$xmlDoc = new DOMDocument();
$xmlDoc->load($xml);

//get elements from "<channel>"
$channel=$xmlDoc->getElementsByTagName('channel')->item(0);
$channel_title = $channel->getElementsByTagName('title')
->item(0)->childNodes->item(0)->nodeValue;
$channel_link = $channel->getElementsByTagName('link')
->item(0)->childNodes->item(0)->nodeValue;
$channel_desc = $channel->getElementsByTagName('pubDate')
->item(0)->childNodes->item(0)->nodeValue;

$img=$xmlDoc->getElementsByTagName('image')->item(0);
$favurl = $img->getElementsByTagName('url')
->item(0)->childNodes->item(0)->nodeValue;

 $chan_tit = utf8_decode($channel_title);



$x=$xmlDoc->getElementsByTagName('item');
for ($i=0; $i<=2; $i++) {
  $item_title=$x->item($i)->getElementsByTagName('title')
  ->item(0)->childNodes->item(0)->nodeValue;
  $item_link=$x->item($i)->getElementsByTagName('link')
  ->item(0)->childNodes->item(0)->nodeValue;
  $item_stuff=$x->item($i)->getElementsByTagName('description')
  ->item(0)->childNodes->item(0)->nodeValue;
  $item_desc=$x->item($i)->getElementsByTagName('pubDate')
  ->item(0)->childNodes->item(0)->nodeValue;
  
  
  $imdb = "";
  $strip1 = str_replace("I", "", $item_stuff);
    	$strip2 = str_replace("#", "", $strip1);
    	$strip3 = str_replace("'", "", $strip2);
    	$info = str_replace("?", "", $strip3);	
  $nfo = utf8_decode($info);
  
  $regex = '/imdb.com\/title\/(tt[0-9]+)/ms';
preg_match_all($regex, $nfo, $matches);
$urls = $matches[0];
// go over all links
foreach($urls as $url) 
{
   $imba = $url; 
} 
  $regex2 = '/tvmaze.com\/shows\/([0-9]+)/ms';
preg_match_all($regex2, $nfo, $matches2);
$urls2 = $matches2[0];
// go over all links
foreach($urls2 as $url2) 
{
   $maze = $url2; 
} 
//$releaseReg = "/^(.+?)(.S[0-9]{2}|.[0-9]{4}|.US.)/";
preg_match('/^(.+?)(.S[0-9]{2}|.[0-9]{4}|.US.|.SWEDiSH.|.SWESUB.|.MULTi.|.MULTiSUBS.|.DVDr.|.NORDiC.|.COMPLETE.|.E[0-9]{2}.)/i', $item_title, $matchesStart);
$matchFix = str_replace(" ", ".", $matchesStart[1]);
  
  echo ("<p>" . $item_title . "");
  echo ("<br>");
  echo ($item_desc);
  echo ($matchFix. "</p>");
 $searchterm = "nordic";
  if(stripos($item_title, $searchterm) !== false){
  $check="SELECT * FROM feedings WHERE url = '$item_link'";
$rs = mysqli_query($conn,$check);
$data = mysqli_fetch_array($rs, MYSQLI_NUM);
if($data[0] > 1) {
	die();
	} else { 
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error);} 
$sql = "INSERT INTO feedings (favico, url, releases, tracker, time, trackerurl, nfo, releaseStart)
VALUES ('".$favurl."', '".$item_link."', '".$item_title."', '".$chan_tit."', NOW(), '".$channel_link."', '".$nfo."', '".$matchFix."') ON DUPLICATE KEY UPDATE updates=updates+1";
if ($conn->query($sql) === FALSE) { echo "Error: " . $sql . "<br>" . $conn->error; }
$conn->close();
}
}
	  $searchterm2 = "swedish";
  if(stripos($item_title, $searchterm2) !== false){
  $check="SELECT * FROM feedings WHERE url = '$item_link'";
$rs = mysqli_query($conn,$check);
$data = mysqli_fetch_array($rs, MYSQLI_NUM);
if($data[0] > 1) {
	die();
	} else { 
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error);} 
$sql = "INSERT INTO feedings (favico, url, releases, tracker, time, trackerurl, nfo, releaseStart)
VALUES ('".$favurl."', '".$item_link."', '".$item_title."', '".$chan_tit."', NOW(), '".$channel_link."', '".$nfo."', '".$matchFix."') ON DUPLICATE KEY UPDATE updates=updates+1";
if ($conn->query($sql) === FALSE) { echo "Error: " . $sql . "<br>" . $conn->error; }
$conn->close();
}
}
  $searchterm2 = "swesub";
  if(stripos($item_title, $searchterm2) !== false){
  $check="SELECT * FROM feedings WHERE url = '$item_link'";
$rs = mysqli_query($conn,$check);
$data = mysqli_fetch_array($rs, MYSQLI_NUM);
if($data[0] > 1) {
	die();
	} else { 
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error);} 
$sql = "INSERT INTO feedings (favico, url, releases, tracker, time, trackerurl, nfo, releaseStart)
VALUES ('".$favurl."', '".$item_link."', '".$item_title."', '".$chan_tit."', NOW(), '".$channel_link."', '".$nfo."', '".$matchFix."') ON DUPLICATE KEY UPDATE updates=updates+1";
if ($conn->query($sql) === FALSE) { echo "Error: " . $sql . "<br>" . $conn->error; }
$conn->close();
}
}
  $searchterm2 = "multisubs";
  if(stripos($item_title, $searchterm2) !== false){
  $check="SELECT * FROM feedings WHERE url = '$item_link'";
$rs = mysqli_query($conn,$check);
$data = mysqli_fetch_array($rs, MYSQLI_NUM);
if($data[0] > 1) {
	die();
	} else { 
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error);} 
$sql = "INSERT INTO feedings (favico, url, releases, tracker, time, trackerurl, nfo, releaseStart)
VALUES ('".$favurl."', '".$item_link."', '".$item_title."', '".$chan_tit."', NOW(), '".$channel_link."', '".$nfo."', '".$matchFix."') ON DUPLICATE KEY UPDATE updates=updates+1";
if ($conn->query($sql) === FALSE) { echo "Error: " . $sql . "<br>" . $conn->error; }
$conn->close();
}
}
  $searchterm2 = "multi";
  if(stripos($item_title, $searchterm2) !== false){
  $check="SELECT * FROM feedings WHERE url = '$item_link'";
$rs = mysqli_query($conn,$check);
$data = mysqli_fetch_array($rs, MYSQLI_NUM);
if($data[0] > 1) {
	die();
	} else { 
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error);} 
$sql = "INSERT INTO feedings (favico, url, releases, tracker, time, trackerurl, nfo, releaseStart)
VALUES ('".$favurl."', '".$item_link."', '".$item_title."', '".$chan_tit."', NOW(), '".$channel_link."', '".$nfo."', '".$matchFix."') ON DUPLICATE KEY UPDATE updates=updates+1";
if ($conn->query($sql) === FALSE) { echo "Error: " . $sql . "<br>" . $conn->error; }
$conn->close();
}
}

}
  
  //  $check="SELECT * FROM feedings WHERE url = '$item_link'";
//$rs = mysqli_query($conn,$check);
//$data = mysqli_fetch_array($rs, MYSQLI_NUM);
//if($data[0] > 1) {
//	die();
//	} else { 
//if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error);} 
//$sql = "INSERT INTO feedings (favico, url, releases, tracker, time, trackerurl, imdb, nfo, maze)
//VALUES ('".$favurl."', '".$item_link."', '".$item_title."', '".$chan_tit."', '".$channel_desc."', '".$channel_link."', '".$imba."', '".$nfo."', '".$maze."') ON DUPLICATE KEY UPDATE updates=updates+1";
//if ($conn->query($sql) === FALSE) { echo "Error: " . $sql . "<br>" . $conn->error; }
//$conn->close();
//}
//}
?>