<?php
include('header.php');

    if ($_COOKIE['password'] !== $adminPass || $_COOKIE['aduser'] !== $adminUser) {
        header('Location: adminlogin');
        die();
    }

require_once('./xtra/broken_dreams.php');
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


$resultrand = $conn->query($sql);
if ($resultrand->num_rows > 0) {
while($rowrand = $resultrand->fetch_assoc()) {
	$sqlrand2 = "SELECT found FROM easteregg WHERE id = '1'";
$resultrand2 = $conn->query($sqlrand2);
if ($resultrand2->num_rows > 0) {
while($rowrand2 = $resultrand2->fetch_assoc()) {
	$found = $rowrand2['found'];
}}

$randValue = $rowrand['antal'];
}}
if($found < '0.9'){
if($randValue > '2000000'){
	include('/var/www/html/xtra/random.php');
}}