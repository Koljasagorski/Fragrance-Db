<?php
 $rand = (float)rand()/(float)getrandmax();
 if ($rand < 0.000088){
 require_once('/var/www/html/xtra/broken_dreams.php');
$link = mysql_connect($servername, $username, $password);
mysql_select_db($dbname, $link);

$res = mysql_query("UPDATE easteregg SET found=found+1 WHERE id=1 LIMIT 1");
mysql_close($link);
 //if($rand < 0.5)
    header('location: /d67c3d4ae603b500cb58395daa2b0930');} //Set to whatever page you want to redirect to.
 else{
    $result = "0";}
    
?>