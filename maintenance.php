<?php
require_once('./xtra/broken_dreams.php');
header("Refresh:30");
if($siteOn==='0'){
echo '<h2>'.$siteName.'&nbsp;Sitewide maintenance! Please try again in a bit!</h2><br />We will refresh this page once every 30 seconds for you.'; }
if($siteOn==='1'){
header('location: /');
die();}