<?php
$choise = 0 + htmlspecialchars((int)$_GET["type"]);
if($choise == "0"){
 setcookie("type", "all", time() + (86400 * 365), "/", "", true, true);
header('Location: /releases');
}
if($choise == "1"){
 setcookie("type", "one", time() + (86400 * 365), "/", "", true, true);
header('Location: /one');
}
?>