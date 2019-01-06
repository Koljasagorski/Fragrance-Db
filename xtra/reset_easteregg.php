<?php
$set=$_GET['set'];
if($set==='1'){
if (isset($_COOKIE['password']) && isset($_COOKIE['aduser']) || $_COOKIE['password'] === $adminPass && $_COOKIE['aduser'] === $adminUser) {
require_once('broken_dreams.php');
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
	$setUpdateEgg = "UPDATE easteregg SET found=0 WHERE id=1";
if ($conn->query($setUpdateEgg) === FALSE) { echo "Error: " . $setUpdateEgg . "<br>" . $conn->error; }
$conn->close();
echo 'EasterEgg has been reset. redirecting to Adminpanel in 5 seconds.';
header('refresh:5;url=/adminpanel');
}}else{
echo '520 Web server is returning an unknown error'; }
?>