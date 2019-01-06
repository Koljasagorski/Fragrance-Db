<?php
require_once('broken_dreams.php');

    $sql1="select count(*) AS cc from feedings where time < NOW() AND time > NOW() - INTERVAL 24 HOUR";
    $sql2="select count(*) AS cc from comments where submittime < NOW() AND submittime > NOW() - INTERVAL 24 HOUR";
    $sql3="select count(*) AS cc from nonnordic where time < NOW() AND time > NOW() - INTERVAL 24 HOUR";
    $sql4="select count(*) from feedings where time < NOW() AND time > NOW() - INTERVAL 24 HOUR group by releases";
    $sql5="SELECT id FROM feedings";
    $sql6="SELECT antal FROM visits WHERE id=1 LIMIT 1";
    $sql7="SELECT id FROM nonnordic";

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection//
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
    $result1 = $conn->query($sql1);
    $count1 = mysqli_fetch_array($result1);
    
    $result2 = $conn->query($sql2);
    $count2 = mysqli_fetch_array($result2);
    
    $result3 = $conn->query($sql3);
    $count3 = mysqli_fetch_array($result3);
    
    $result4 = $conn->query($sql4);
    $count4 = mysqli_num_rows($result4);
    
    $result5 = $conn->query($sql5);
    $count5 = mysqli_num_rows($result5);
    
    $result6 = $conn->query($sql6);
    $count6 = mysqli_fetch_array($result6);
    
    if($count6 < '0.9'){
	     $conn2 = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
   		 $conn2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		 $sql = "INSERT INTO visits (antal)
		 VALUES ('1')";
		 $stmt = $conn2->prepare($sql);
		 $stmt->execute();
		 $count6 = '1';
		 	}

    $result7 = $conn->query($sql7);
    $count7 = mysqli_num_rows($result7);
	
$m = new Memcached();
$m->addServer('localhost', 11211);

	if($m->get('releases') == ''){
$m->set('releases', $count1[0], 60*15); }

	if($m->get('comments') == ''){
$m->set('comments', $count2[0], 60*15); }

	if($m->get('international') == ''){
$m->set('international', $count3[0], 60*15); }

	if($m->get('group') == ''){
$m->set('group', $count4, 60*15); }

	if($m->get('numrows') == ''){
$m->set('numrows', $count5, 60*15); }

	if($m->get('antal') == ''){
$m->set('antal', $count6[0], 60*15); }

	if($m->get('intercount') == ''){
$m->set('intercount', $count7, 60*15); }


$conn->close();
?>

