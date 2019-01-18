<?php
require_once('./xtra/broken_dreams.php');
error_reporting(0);
$time = microtime();
$time = explode(' ', $time);
$time = $time[1] + $time[0];
$start = $time;
if (stripos($_SERVER['REQUEST_URI'], 'releases') || stripos($_SERVER['REQUEST_URI'], 'one') || stripos($_SERVER['REQUEST_URI'], 'international')){
setcookie("lastViewed", date("Y-m-d H:i:s"), time() + (86400 * 30), "/", "", true, true);
}
header("X-XSS-Protection: 1; mode=block");
header("Content-Security-Policy: default-src https:");
header("Content-Security-Policy: style-src https:");
header("Content-Security-Policy: img-src https: data:");
header('X-Frame-Options: SAMEORIGIN');
header('Referrer-Policy: no-referrer-when-downgrade');
header('Cache-Control: max-age=259200');
header('Cache-Control: proxy-revalidate');

if($ddos === true){
	sleep(2); }
require_once('./xtra/cache-stats.php');
if($siteOn === '0'){ 
	header('location: maintenance'); 
	die();}
require_once('./xtra/functions.php');

///Multilang///
			$langButton = '<li><a href="lang.php?l=1"><i class="fa fa-language" aria-hidden="true"></i>Swe</a></li>';
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
			if(isset($_COOKIE['lang'])){
    $cookieLang = $_COOKIE['lang'];
    if($cookieLang === 'dk'){
	    $cookieLangTrue = 'dk';
}}
			if(!isset($_COOKIE['lang'])){
				require_once('./lang/english/global.php');
   }
if($cookieLangTrue === 'eng'){
	require_once('./lang/english/global.php');}
	  $langButtonSWE = '<a href="lang.php?l=1"><img src="https://images.weserv.nl/?url='.$siteUrl.'img/swe.png&w=25&t=fit"title="Swedish"></a>'; 
if($cookieLangTrue === 'swe'){
	require_once('./lang/swedish/global.php');}
	  $langButtonENG = '<a href="lang.php?l=2"><img src="https://images.weserv.nl/?url='.$siteUrl.'img/eng.png&w=25&t=fit"title="English"></a>'; 

///End Multilang///
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
	$setUpdate = "UPDATE visits SET antal=antal+1 WHERE id=1";
if ($conn->query($setUpdate) === FALSE) { echo "Error: " . $setUpdate . "<br>" . $conn->error; }
$sql = "SELECT antal FROM visits WHERE id = '1'";

$resultrand = $conn->query($sql);
if ($resultrand->num_rows > 0) {
while($rowrand = $resultrand->fetch_assoc()) {
	$found ='';
	$sqlrand2 = "SELECT found FROM easteregg WHERE id = '1'";
$resultrand2 = $conn->query($sqlrand2);
if ($resultrand2->num_rows > 0) {
while($rowrand2 = $resultrand2->fetch_assoc()) {
	$found = $rowrand2['found'];
}}

$randValue = $m->get('antal');
}}
if($found < '0.9'){
if($randValue > '5000000'){
	include('/var/www/html/xtra/random.php');
}}
$conn->close();
 
?>
<!DOCTYPE HTML SYSTEM>
<html lang="en-us">
<head>
<title><?php echo $siteName ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<meta name="description" content=" Movies, UHD, 1080p, 720p, dvdr, Film, serier, series">
<link rel="shortcut icon" href="<?php echo $siteUrl ?>/favicon.ico" type="image/x-icon">
<meta property="og:title" content="<?php echo $siteName ?>">
<meta property="og:type" content="video.movie">
<meta property="og:url" content="<?php echo $siteUrl ?>">
<meta property="og:image" content="<?php echo $siteUrl ?>img/logo.png">
<meta property="og:description" content="Search for Movies and Series in UHD, 1080p, 720p, DVDr">
<script src="/js/jquery-3.2.0.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="/js/jquery.js"></script>
<script src="/js/bootstrap.js"></script>
<script> $(document).ready(function(){ $("#flipc").click(function(){ $("#panelc").slideToggle("slow"); }); }); </script>
<link rel="stylesheet" href="/theme/min.baloon.css">
      
<?php if($_COOKIE["theme"] === "dark"){ ?>
<link rel="stylesheet" href="/theme/min.mork.css">
<?php }else{ ?>
<link rel="stylesheet" href="/theme/min.ljus.css">
<?php } ?>
</head>
<body>
<div id="floating-lang"><?php echo $langButtonSWE; echo $langButtonENG; /*echo $langButtonDK;*/ ?></div>
<div class="panel panel-default"style="position:relative;float:right;width:150px;">
	<div class="panel-heading">
    	<h3 class="panel-title"><?php echo $lang['head_last_title'] ?></h3>
    </div>
  <div class="panel-body">
      <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="1950">
      <div class="carousel-inner">
      <?php
      	$comcache='0';
      if($m->get('comments') != ''){
	      $comcache = $m->get('comments'); }
	    $relcache='0';
      if($m->get('releases') != ''){
	      $relcache = $m->get('releases'); }
	    $intcache='0';
      if($m->get('international') != ''){
	      $intcache = $m->get('international'); }
	      $actcache='0';
      if($m->get('group') != ''){
	      $actcache = $m->get('group'); }
	      $viewscache='0';
	  if($m->get('antal') != ''){
	      $viewscache = $m->get('antal'); }
	      $ulcache='0';
	  if($m->get('numrows') != ''){
	      $ulcache = $m->get('numrows'); }
	      ?>
      <div class="item">
        <?php echo $comcache.'&nbsp;'.$lang['head_last_comments'] ?>
      </div>
      <div class="item active">
        <?php echo $relcache ?> Uploads
      </div>
      <div class="item">
        <?php echo $intcache ?> Int.Rel
      </div>
      <div class="item" title="Grouped like Single-Rel.page">
        <?php echo $actcache ?> Act.Rel
      </div>
      <div class="item">
       <?php echo $viewscache.'&nbsp;'.$lang['head_last_views'] ?>
      </div>
      <div class="item">
       <?php echo $ulcache ?>&nbsp;ULs Total
      </div>

    </div>
    </div>
  </div>
</div>
<div id="header2">
<?php 
$cholink = "/";
if($_COOKIE["type"] === "all"){
$cholink = "/releases"; 
}
if($_COOKIE["type"] === "bare"){
$cholink = "/barereleases"; 
}
if($_COOKIE["type"] === "one"){
$cholink = "/one"; 
}
if($_COOKIE["theme"] === "dark"){
	?>
<a class="navbar-brand"href="<?php echo $cholink ?>" ><img src="https://images.weserv.nl/?url=<?php echo $siteUrl ?>img/<?php echo $logo ?>" alt=" "></a>
<?php
}else{
		?>
<a class="navbar-brand"href="<?php echo $cholink ?>" ><img src="https://images.weserv.nl/?url=<?php echo $siteUrl ?>img/<?php echo $logo ?>" alt=" "></a>
<?php
}
?>
</div>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <ul class="nav navbar-nav">
    <li><a class="flashit" href="/news"><i class="fa fa-newspaper-o" aria-hidden="true"></i><?php echo $lang['head_news'] ?></a></li>
      <li><a href="/releases"><i class="fa fa-home" aria-hidden="true"></i><?php echo $lang['head_rele'] ?></a></li>
	  <li><a href="/one"><i class="fa fa-home" aria-hidden="true"></i><?php echo $lang['head_sing'] ?></a></li>
	  <li><a href="/international"><i class="fa fa-home" aria-hidden="true"></i><?php echo $lang['head_inte'] ?></a></li>
    
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo $lang['head_other_drop'] ?>
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="/info"><i class="fa fa-info" aria-hidden="true"></i><?php echo $lang['head_other_info'] ?></a></li>
          <li><a href="/RSS/rss_get"><i class="fa fa-rss" aria-hidden="true"></i><?php echo $lang['head_other_rss'] ?></a></li>
          <li><a href="/tf"><?php echo $lang['head_other_tf'] ?></a></li>
        </ul>
      </li>
      <li><a href="/searches"><i class="fa fa-search" aria-hidden="true"></i><?php echo $lang['head_sear'] ?></a></li>
      <li><a href="/fund"><span class="glyphicon glyphicon-bitcoin"></span></i></a></li>
      <li><a href="/ads"><i class="fa fa-list" aria-hidden="true"></i></a></li>
<?php if($_COOKIE["theme"] === "dark"){
	?>
<li><a href="t?t=0"><i class="fa fa-lightbulb-o" aria-hidden="true"></i><?php echo $lang['head_theme_light'] ?></a></li>
<?php
}else{
		?>
<li><a href="t?t=1"><i class="fa fa-lightbulb-o" aria-hidden="true"></i><?php echo $lang['head_theme_dark'] ?></a></li>
<?php
}
if (isset($_COOKIE['password']) && isset($_COOKIE['aduser']) && $_COOKIE['password'] === $encryptPass && $_COOKIE['aduser'] === $adminUser) {
	 echo '<li><a href="/adminpanel"><span class="glyphicon glyphicon-sunglasses"></span>Admin</a></li>'; }
?>
    </ul>
    <ul class="nav navbar-nav navbar-right">
    </ul>
  </div>
</nav>
<?php
$info="";
//$info = "We've had some backend troubles through the day, but all systems should be fine now.";
if(!empty($info)){
	echo '<div id="centerwidth"><div class="alert alert-info alert-dismissible fade in"><strong>Info!</strong> '.$info.' </div></div>'; }
$success="";
//$success = "<strong>Great news!</strong>Good Informations for the users</a>";
if(!empty($success)){
	echo '<div id="centerwidth"><div class="alert alert-success alert-dismissible fade in">'.$success.' </div></div>'; }
if($ddos === true){
$danger = "We are currently experiencing a DDoS attack.";}
if(!empty($danger)){
	echo '<div id="centerwidth"><div class="alert alert-danger alert-dismissible fade in"> '.$danger.' </div></div>';
	sleep(0.5); }
$problem="";
//$problem = "Any troubles that the users might encounter.<br />Please stand by!";
if(!empty($problem)){
	echo '<div id="centerwidth"><div class="alert alert-danger alert-dismissible fade in">'.$problem.' </div></div>'; }
	?>


<div id="flipc"><?php echo $lang['head_cate_btn'] ?></div>
<div id="panelc">
<a href="/" class="btn btn-info" role="button">All</a>
<a href="/cat/DVDr/" class="btn btn-info" role="button">DVDr</a>
<a href="/cat/PAL/" class="btn btn-info" role="button">DVDr PAL</a>
<a href="/cat/720p/" class="btn btn-info" role="button">720p</a>
<a href="/cat/1080p/" class="btn btn-info" role="button">1080p</a>
<a href="/cat/2160p/" class="btn btn-info" role="button">2160p</a>
</div>
&nbsp;
<div id="huvud-div" style="width:99%;">
<?php
if (!stripos($_SERVER['REQUEST_URI'], 'searches')){
	echo '
<form action="searches" method="get">
<input type="text" name="search_keyword" class="search_keyword" id="search_keyword_id"  placeholder="'.$lang['head_search_field'].'" required/>
    <button type="submit" class="btn btn-success">'.$lang['head_search_btn'].'</button>
    </form> ';}
     if (isset($_COOKIE['password']) && isset($_COOKIE['aduser']) && $_COOKIE['password'] === $encryptPass && $_COOKIE['aduser'] === $adminUser) {
	echo '<font color=red>'.$lang['adm_active'].'</font><br />';
	
	//Echos the status of the easteregg//
	//uncomment to use the easteregg for the users!//
	/*if($randValue > '3000000'){
	$found1="EasterEgg <font color=red>[NOT FOUND]</font>";
	if($found > '0.9'){
		$found1="<h2>EasterEgg <font color=green>[FOUND!!]</font></h2>";
}
echo  $found1;
}*/
}
?>



