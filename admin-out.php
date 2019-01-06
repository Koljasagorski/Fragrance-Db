<?php
setcookie("password", "", time() + (-3600), "/", "", true, true);
setcookie("aduser", "", time() + (-3600), "/", "", true, true);
header('location: /adminlogin');
?>