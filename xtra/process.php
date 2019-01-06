<?php

include('broken_dreams.php');
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
//Retrieve form data. 
$name=$_POST['name'];
$release=$_POST['release'];
$sql = "UPDATE feedings SET imdburl='".$name."' WHERE releases='".$release."'";
if ($conn->query($sql) === FALSE) { echo "Error: " . $sql . "<br>" . $conn->error; } 
else { echo '1'; }

?>