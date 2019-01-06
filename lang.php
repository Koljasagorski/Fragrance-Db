<?php
$lang = 0 + htmlspecialchars((int)$_GET["l"]);
if($lang == "1"){
 setcookie("lang", "swe", time() + (86400 * 365), "/", "", true, true);
header('Location: ' . $_SERVER['HTTP_REFERER']);
}
if($lang == "2"){
 setcookie("lang", "eng", time() + (86400 * 365), "/", "", true, true);
header('Location: ' . $_SERVER['HTTP_REFERER']);
}

?>