<?php
include('header.php');

    if ($_COOKIE['password'] !== $encryptPass || $_COOKIE['aduser'] !== $adminUser) {
        header('Location: rakel');
        die();
    }

require_once('./xtra/broken_dreams.php');

 	$sql1="select id, time, relid, releaseName from cleanlog order by id desc limit 25";
	$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection//
	if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo '<center><div class="panel panel-default text-left"style="width:50%;">
  <div class="panel-heading">
  <h3 class="panel-title"><strong>Cleanup Logg</strong></h3></div>';
echo '<div class="panel-body"style="height:400px;overflow-y: auto;"><table>';
    $result1 = $conn->query($sql1);
	if ($result1->num_rows > 0) {
	while($row = $result1->fetch_assoc()) {
if($row['releaseName'] !== ''){
	$release = $row['releaseName']; }
	else{
		$release = $row['relid']; }
	echo "<tr><th style='width:30px;'>".$row['id']."</th><th style='width:120px;'><a class='trd' href='logdetails?id=".$row['id']."'>".$release."</a></th><th style='width:120px;'>".$row['time']."</tr>";
}}
echo "</table></div></td></tr>";
echo '  </div></center>';
$conn->close();

include('footer.php');
 ?>