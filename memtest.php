<?php
die("404");
 	error_reporting(E_ALL);
	ini_set('display_errors', 1);

		$memcached = new Memcached;
		@$memcached->addServer('127.0.0.1', 11211);

$response = $memcached->get("Bilbo");
if ($response) {
echo $response;
} else {
echo "Adding Keys (K) for Values (V), You can then grab Value (V) for your Key (K) \m/ (-_-) \m/ ";
$memcached->set("Bilbo", "Here s Your (Ring) Master stored in MemCached (^_^)") or die(" Keys Couldn't be Created : Bilbo Not Found  ");
}
?>