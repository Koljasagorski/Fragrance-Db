<?php

require_once('./xtra/broken_dreams.php');

    if ($_COOKIE['password'] !== $encryptPass || $_COOKIE['aduser'] !== $adminUser) {
        header('Location: /');
        die();
    }
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection//
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$pub='';
$name = utf8_encode($_POST['title']);
$subject = utf8_encode($_POST['message']);
$addedby = utf8_encode($_POST['addedby']);

$name1 = str_replace ("'","''", $name);
$subject1 = str_replace ("'","''", $subject);
$addedby1 = str_replace ("'","''", $addedby);
if($addedby1 ===''){
	$addedby1 = 'Staff'; }

$sql = "INSERT INTO news (title, message, addedby, added)
VALUES ('".$name1."', '".$subject1."', '".$addedby1."', NOW())";
if ($conn->query($sql) === FALSE) { echo "Error: " . $sql . "<br>" . $conn->error; }
header('Location: ' . $_SERVER['HTTP_REFERER'].'?added=1');

?>
