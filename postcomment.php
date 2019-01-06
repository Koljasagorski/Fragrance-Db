<?php
require_once('./xtra/broken_dreams.php');
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection//
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$pub='';
$name = utf8_encode($_POST['name']);
$subject = utf8_encode($_POST['subject']);
$rid = $_POST['random'];
function strip($string, $allowed_tags = NULL)
{
    if (is_array($string))
    {
        foreach ($string as $k => $v)
        {
            $string[$k] = strip($v, $allowed_tags);
        }
        return $string;
    }

    return strip_tags($string, $allowed_tags);
}
$sanname = strip($name);
$sansub = strip($subject);
$sanid = strip($rid);


$releaseID = mysqli_real_escape_string($row['id']);
$status = 'draft';
$sql = "INSERT INTO comments (name, subject, releaseID, status, submittime)
VALUES ('".$sanname."', '".$sansub."', '".$sanid."', '".$status."', NOW())";
if ($conn->query($sql) === FALSE) { echo "Error: " . $sql . "<br>" . $conn->error; }
setcookie("name", $sanname, time() + (86400 * 365), "/", "", true, true);
header('Location: ' . $_SERVER['HTTP_REFERER']);

?>
