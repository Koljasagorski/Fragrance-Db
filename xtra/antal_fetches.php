<?php
require_once('./xtra/broken_dreams.php');
$m = new Memcached();
$m->addServer('localhost', 11211);

$link = mysql_connect($servername, $username, $password);
mysql_select_db($dbname, $link);

$result = mysql_query("SELECT * FROM feedings", $link);
$num_rows = mysql_num_rows($result);
if($m->get('numrows') == ''){
$m->set('numrows', $num_rows, 60*15); }


mysql_close($link);

$link = mysql_connect($servername, $username, $password);
mysql_select_db($dbname, $link);

$res = mysql_query("SELECT antal FROM visits WHERE id=1 LIMIT 1");
if (mysql_num_rows($res) == 1) {
    $arr     = mysql_fetch_assoc($res);
	if($m->get('antal') == ''){
$m->set('antal', $arr['antal'], 60*15); }
 
}
mysql_close($link);

?>