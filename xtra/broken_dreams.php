<?php
$servername = "localhost"; //usally Localhost or 127.0.0.1.
$username = "user"; //MySQL/MariaDB User.
$password = "password"; //MySQL/MariaDB Password.
$dbname = "dbname"; //Database.
$charset = "utf8mb4"; //Charset for TwitterEmoji.
$root_dir = "/var/www/html/"; //Absolute path for the webserver.
$siteOn = '1'; //Set to Zero (0) if maintenance-mode should be active.
$siteName = 'FragranceDb'; //Set the sitewide name
$siteUrl = 'https://example.com/'; //complete url for your site. including last slash

//Uncomment if you want multiple logos taking turns//
//$logo=array("logo.png","logo2.png");
//Uncomment the $logo below if this are enabled//

$logo = 'logo.png'; //Name and file-extention of your logo. must be places in the /img/ folder
$ddos = false; //Set to true if there's a ddos attack aimed directly towards the webserver. Give it a delay on 2 seconds. should take the heats of the server.
///
///THIS IS FOR THE RSS. WE'RE USING AN SECONDARY SERVER IN THIS EXAMPLE///
DEFINE ('DB_USER', 'user');   
DEFINE ('DB_PASSWORD', 'password');   
DEFINE ('DB_HOST', 'localhost');   
DEFINE ('DB_NAME', 'dbname');
///END SECONDARY RSS-SERVER///
define('_ROOT_DIR', $root_dir);
define('_HOST_NAME', $servername);
define('_DATABASE_USER_NAME', $username);
define('_DATABASE_PASSWORD', $password);
define('_DATABASE_NAME', $dbname);
$dbConnection = new mysqli(_HOST_NAME, _DATABASE_USER_NAME, _DATABASE_PASSWORD, _DATABASE_NAME);
if ($dbConnection->connect_error) {
    trigger_error('Connection Failed: '  . $dbConnection->connect_error, E_USER_ERROR);
}
//Use https://passwordsgenerator.net for these hashes//
$saltKey='qVLrYGPY2SK9bs9SYVPdprYps2BwNFZFGEqYDbsUyAms6EyuZbedhPVmVzNTPu5b'; //This is the hash for the hash-salt. Change to a 64char alphanumeric hash.
$admindelete='tTtkNuJZtWfUQUzWxmwUX47HwcbBtchD'; //Change this to a 32char alphanumeric hash.
$adminconfirm='Ncx25jJEBTU8xshQ6hdNwCCWjm6TuVUEdPAaeADmWEKVXMq7tb2WWsa42Qz55ustkEgLDdR4jL4tqV3RtXhg28ZQheNA7akmBas4'; //Change this to a min 100char alphanumeric hash. This is the Allmighty deleteconfirm-key.
$adminUser="Admin"; //Admin Username.
$adminPass="AdminPassword"; //This is hashed. 
require_once('functions.php');
$encryptPass = swecrypt( $adminPass, 'e' );
$decryptPass = swecrypt( $encryptPass, 'd' );

?>