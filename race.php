<?php
include('header.php');
?>
<style>
td {
   border: 1px solid black;
padding: 5px;
    margin: 5px;
    text-align: center;
}
</style>
    
<script>
function goBack() {
    window.history.back();
}
</script>
        
    <div id="floating-back">
    <a class="one" href="#" onclick="goBack()"><i class="fa fa-step-backward fa-5x"></i></a>
    </div>

<div class="container-fluid">

<?php 
require_once('./xtra/broken_dreams.php');
$rel=htmlspecialchars($_GET['rel']);
echo '<title>Race-details for '.$rel.'</title>';
if(empty($rel)){
	die("<h1>Something went very wrong...</h1>"); }
$hasNotLooped = true;
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM feedings WHERE releases LIKE '%{$rel}%' order by time ASC LIMIT 5";
$result = $conn->query($sql);
	 

    	
if($conn->field_count){
	$event = $result->fetch_assoc();
	  
		  $nfo = utf8_decode($event['nfo']);
  
  $regex = '/imdb.com\/title\/(tt[0-9]+)/ms';
preg_match_all($regex, $nfo, $matches);
$urls = $matches[0];
// go over all links
foreach($urls as $url) 
{
   $imba = $url; 
} 



$imdb = "";
    	  
  
    	echo "<h1>";
    	echo $imdb;
    	echo "</h1>";
    	$trackerurl=$event['trackerurl'];
    	
echo "<table class='table table-hover'><td class='col-sm-1' width='600px'>";
echo " <h1>".$event['tracker']."<i class='fa fa-trophy fa-1g' aria-hidden='true'></i></h1><h6><i class='fa fa-clock-o' aria-hidden='true'></i>".$event['time']."</h6>";
echo "<h3>".utf8_decode($event['releases'])."";
echo "<a class='one' href='/X-".$event['id']."' title='Details for ".$event['releases']."'><i class='fa fa-info-circle' aria-hidden='true'></i></a></h3>";
echo "<hr></td></table>";


while($events = $result->fetch_assoc()) {
	   
echo "<table class='table table-hover'><td class='col-sm-1' width='600px'>";
$trackerurl=$events['trackerurl'];
echo " <h1>".$events['tracker']."</h1><h6><i class='fa fa-clock-o' aria-hidden='true'></i>".$events['time']."</h6>";
echo "<h3>".utf8_decode($events['releases'])."";
echo "<a class='one' href='/X-".$events['id']."' title='Details for ".$events['releases']."'><i class='fa fa-info-circle' aria-hidden='true'></i></a></h3>";
echo "<hr></td></table>";

    }

?>

</div>
</div>
</body>
</html>

<?php

   }

$conn->close();
include('footer.php');
?>