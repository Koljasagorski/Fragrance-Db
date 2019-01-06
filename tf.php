<?php 
/*Loose based on TbDEV's TorrentFreak script. Rewritten for FragranceDb*/
include('header.php');
echo '<title>TorrentFreak News</title>';
$menu='<div style="border-style: solid;border-width: 1px;width:250px;margin: auto;">
<a href="/tf?action=default" class="btn btn-default" role="button">General</a>&nbsp;
<a href="/tf?action=movies" class="btn btn-default" role="button">Movies</a>
</div>';
// _GET action
if (!($action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING))) {
$action = 'default';
}
if ($action == "default") {
$use_limit = true;
$limit     = 20; // How many items to show. Default = 20
$xml       = file_get_contents('http://feed.torrentfreak.com/Torrentfreak/');
preg_match_all('/\<(title|pubDate|dc:creator|link|description)\>(.+?)\<\/\\1\>/i',$xml,$out,PREG_PATTERN_ORDER);
$feeds = $out[2];
$c     = count($feeds);
?>
<div class="container-fluid"style="width:50%;">
<?php
echo $menu;
$i   = 0; // Counter
$url = "http://feed.torrentfreak.com/Torrentfreak/"; // URL to parse
$rss = simplexml_load_file($url); // XML parser
// RSS items loop
?>
<style>
p {
	font-size: 10pt;
	text-align: center;
}
</style>
<?php
foreach($rss->channel->item as $item) {
if ($i < 10) { // Parse only 10 items
    print '<h2 style="font-size: 18px;font-weight: 700;">
	       <a href="'.$item->link.'">'.utf8_decode($item->title).'</a></h2>
		   <p style="text-align:center;">'.$item->pubDate.'</p><br />
		   <p style="font-size: 10pt;text-align:center;">'.utf8_decode($item->description).'</p><br /><br /><hr /><br /><br />';
}
$i++;
}
?>
<?php
} elseif ($action == "movies") {
$use_limit = true;
$limit     = 20; // How many items to show. Default = 20
$xml       = file_get_contents('https://torrentfreak.com/category/dvdrip/feed/');
preg_match_all('/\<(title|pubDate|dc:creator|link|description)\>(.+?)\<\/\\1\>/i',$xml,$out,PREG_PATTERN_ORDER);
$feeds = $out[2];
$c     = count($feeds);
?>
<div class="container-fluid"style="width:50%;">
<?php
echo $menu;
$i   = 0; // counter
$url = "https://torrentfreak.com/category/dvdrip/feed/"; // URL to parse
$rss = simplexml_load_file($url); // XML parser
// RSS items loop
?>
<style>
p {
	font-size: 10pt;
	text-align: center;
}
</style>
<?php
foreach($rss->channel->item as $item) {
if ($i < 10) { // Parse only 10 items
    print '<h2 style="font-size: 18px;font-weight: 700;">
	       <a href="'.$item->link.'">'.utf8_decode($item->title).'</a></h2>
		   <p style="text-align:center;">'.$item->pubDate.'</p><br />
		   <p style="font-size: 10pt;text-align:center;">'.utf8_decode($item->description).'</p><br /><br /><hr /><br /><br />';
}
$i++;
}
?>
<?php
} else {
?>
<div class="container-fluid"style="width:50%;">
<?php
echo $menu;
}
include('footer.php');
?>