<?php
   require_once('/var/www/html/xtra/broken_dreams.php');
			if(isset($_COOKIE['lang'])){
    $cookieLang = $_COOKIE['lang'];
    if($cookieLang === 'swe'){
	    $cookieLangTrue = 'swe';
}}
			if(isset($_COOKIE['lang'])){
    $cookieLang = $_COOKIE['lang'];
    if($cookieLang === 'eng'){
	    $cookieLangTrue = 'eng';
}}
			if(!isset($_COOKIE['lang'])){
				require_once('../lang/english/global.php');
   }
if($cookieLangTrue === 'eng'){
	require_once('../lang/english/global.php');
	  }
if($cookieLangTrue === 'swe'){
	require_once('../lang/swedish/global.php');
	  }
	$getapi=$_GET['genapi'];
	if($getapi==='1'){
	$key=md5(uniqid());

echo $lang['rss_key'].': <b>'.$key.'</b>';
echo '<br />';
echo $lang['rss_keep'];
echo '<br />';
echo $lang['rss_usage'].': <a href="'.$siteUrl.'RSS/rss_get?key='.$key.'">'.$siteUrl.'RSS/rss_get?key=<b>'.$key.'</b></a>';
echo '<br />';
echo $lang['rss_usage_int'].': <a href="'.$siteUrl.'RSS/rss_get?key='.$key.'&international=1">'.$siteUrl.'RSS/rss_get?key=<b>'.$key.'&international=1</b></a>';
echo '<br />';
echo $lang['rss_more_feat'];
die();}
$apikey=$_GET['key'];
	if(empty($apikey)){
		echo $lang['rss_no_key'].'<br /><a href="?genapi=1">'.$lang['rss_no_key_get'].'</a>';
		die();
	}
if(strlen($apikey) !== 32){
	echo $lang['rss_no_key'].'<br /><a href="?genapi=1">'.$lang['rss_no_key_get'].'</a>';
		die();
	}
	if($_GET['international']==="1"){
		 header("Content-Type: application/xml; charset=utf-8");

    $rssfeed = '<?xml version="1.0" encoding="utf-8"?>';
    $rssfeed .= '<rss version="0.91">';
    $rssfeed .= '<channel>';
    $rssfeed .= '<title>'.$siteName.' RSS</title>';
    $rssfeed .= '<link>'.$siteUrl.'</link>';
    $rssfeed .= '<description> '.$siteName.'\'s 30 latest international releases </description>';
    $rssfeed .= '<language>en-us</language>';
    $rssfeed .= '<copyright>WTFPL</copyright>';
 
    $connection = @mysql_connect(DB_HOST, DB_USER, DB_PASSWORD)
        or die('Could not connect to database');
    mysql_select_db(DB_NAME)
        or die ('Could not select database');
 
    $query = "SELECT * FROM nonnordic ORDER BY time DESC LIMIT 30";
    $result = mysql_query($query) or die ("Could not execute query");
 
    while($row = mysql_fetch_array($result)) {
        extract($row);

        $rssfeed .= '<item>';
        $rssfeed .= '<title>' . utf8_decode($releases) . '</title>';
        $rssfeed .= '<description>An international Release #'.$id.'</description>';
        $rssfeed .= '<link>'.$siteName.'international</link>';
        $rssfeed .= '<pubDate>' . $time . '</pubDate>';
        $rssfeed .= '</item>';
    }
    $rssfeed .= '</channel>';
    $rssfeed .= '</rss>';
    echo $rssfeed;
    die();
}
    header("Content-Type: application/xml; charset=utf-8");

    $rssfeed = '<?xml version="1.0" encoding="utf-8"?>';
    $rssfeed .= '<rss version="0.91">';
    $rssfeed .= '<channel>';
    $rssfeed .= '<title>'.$siteName.' RSS</title>';
    $rssfeed .= '<link>'.$siteUrl.'</link>';
    $rssfeed .= '<description>'.$siteName.'s 30 latest releases </description>';
    $rssfeed .= '<language>en-us</language>';
    $rssfeed .= '<copyright>WTFPL</copyright>';
 
    $connection = @mysql_connect(DB_HOST, DB_USER, DB_PASSWORD)
        or die('Could not connect to database');
    mysql_select_db(DB_NAME)
        or die ('Could not select database');
 
    $query = "SELECT * FROM feedings ORDER BY time DESC LIMIT 30";
    $result = mysql_query($query) or die ("Could not execute query");
 
    while($row = mysql_fetch_array($result)) {
        extract($row);

        $rssfeed .= '<item>';
        $rssfeed .= '<title>' . utf8_decode($releases) . '</title>';
        $rssfeed .= '<description>Uploaded on ' . $row["tracker"] . '</description>';
        $rssfeed .= '<link>https://swetracker.org/X-' . $id . '</link>';
        $rssfeed .= '<pubDate>' . $time . '</pubDate>';
        $rssfeed .= '</item>';
    }
 
    $rssfeed .= '</channel>';
    $rssfeed .= '</rss>';
 
    echo $rssfeed;
?>