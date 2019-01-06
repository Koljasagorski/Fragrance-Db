<?php
require_once('broken_dreams.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);
$conn = new mysqli($servername, $username, $password, $dbname);


//////////////////////////////////////////////////////////////
////THIS PROCESSOR ARE BUILT TO WORK WITH TORRENTDAY//////////
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
  $strip1 = str_replace("?!?!?", "", $item_stuff);
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
preg_match('/^(.+?)(.S[0-9]{2}|.[0-9]{4}|.US.)/', $item_title, $matchesStart);
$matchFix = str_replace(" ", ".", $matchesStart[1]);
  
  echo ("<p>" . $item_title . "");
  echo ("<br>");
  echo ($item_desc);
  echo ($matchFix. "</p>");
 $searchterm = "nordic";
if($q==='TD'){
  $check="SELECT * FROM nonnordic WHERE releases = '$item_title'";
$rs = mysqli_query($conn,$check);
$data = mysqli_fetch_array($rs, MYSQLI_NUM);
if($data[0] > 1) {
	die();
	} else { 
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error);} 
$sql = "INSERT INTO nonnordic (url, releases, tracker, time, trackerurl, nfo, releaseStart)
VALUES ('".$item_link."', '".$item_title."', 'Torrentday', NOW(), 'https://www.torrentday.com/', '".$nfo."', '".$matchFix."') ON DUPLICATE KEY UPDATE updates=updates+1";
if ($conn->query($sql) === FALSE) { echo "Error: " . $sql . "<br>" . $conn->error; }
$conn->close();
}
}


} 
?>