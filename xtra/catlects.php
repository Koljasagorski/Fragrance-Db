
<?php
require_once('./xtra/broken_dreams.php');

// Create connection
$cat=htmlspecialchars($_GET['cat']);
if(empty($cat)){
	die("<h1>Something went very wrong...</h1>"); }
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM feedings WHERE releases LIKE '%{$cat}%' order by time DESC LIMIT 250";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
    	$strip1 = str_replace("I", "", $row['nfo']);
    	$strip2 = str_replace("#", "", $strip1);
    	$info = str_replace("?", "", $strip2);	


    	$relmod = str_replace("+", "%2B", $row['releases']);


    	
include('./xtra/trackers.php');
	    	

    	$maze = "";
    	$imdb = "";
    	
  $tracker = $favico."".$trackernamn."</a></td><td class='col-sm-8'width='99%'><a class='one' href='/race?rel=".$relmod."'>".chunk_split(utf8_decode($row['releases']) ,40)."</a>";
    	
        echo "<table class='table'><td class='col-sm-1' width='135px'>".$row['time']."</td><td class='col-sm-1'width=140px'>".$tracker."</td><td class='col-sm-1'width='15px'><div data-balloon-length='large' data-balloon='". chunk_split($info,45)."' data-balloon-pos='left'>".$imdb."<a href='/X-".$row['id']."'><i class='glyphicon glyphicon-info-sign' aria-hidden='true'></i>Details</a></div></td></table>";
    		
    }
}

$conn->close();
?>
