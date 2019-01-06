<?php
$t = 0 + htmlspecialchars((int)$_GET["t"]);
if($t == "1"){
 setcookie("theme", "dark", time() + (86400 * 365), "/", "", true, true);
header('Location: ' . $_SERVER['HTTP_REFERER']);
}
if($t == "0"){
 setcookie("theme", "bright", time() + (86400 * 365), "/", "", true, true);
header('Location: ' . $_SERVER['HTTP_REFERER']);
}
?>