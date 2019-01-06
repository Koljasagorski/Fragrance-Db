<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set("allow_url_fopen", 1);
ini_set('default_socket_timeout', 5);

$id = $_GET["id"];
$url = "https://swetracker.org/details.php?id=".$id."";
file_put_contents('/iMDb/'.$id.', '.$url.'?imdb=1');
header('Location: ' . $_SERVER['HTTP_REFERER']);

?>