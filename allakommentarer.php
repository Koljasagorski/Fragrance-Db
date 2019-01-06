
<?php

include('header.php');


    if ($_COOKIE['password'] !== $encryptPass || $_COOKIE['aduser'] !== $adminUser) {
        header('Location: rakel');
        die();
    }

require_once('./xtra/broken_dreams.php');
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

	$sqlcomments = "SELECT * FROM comments WHERE releaseID > 0 ORDER BY submittime DESC LIMIT 250";
$resultcom = $conn->query($sqlcomments);
if ($resultcom->num_rows > 0) {
while($rowc = $resultcom->fetch_assoc()) {
	if($rowc['name'] !== ""){
		if($rowc['subject'] != ""){
			$rrid = $rowc['releaseID'];
$deleteRelease = '';			
$deleteRelease = $_GET[$admindelete];
if($deleteRelease === $adminconfirm){
	
	
	$delRel = "DELETE FROM comments WHERE id='".$_GET['idt']."'";
if ($conn->query($delRel) === FALSE) { echo "Error: " . $delRel . "<br>" . $conn->error; } 
echo '<h2>'.$lang['adm_ac_deleted'].'</h2>';
echo '<a href="allakommentarer"><i class="fa fa-arrow-left" aria-hidden="true"></i>'.$lang['adm_log_det_ret_btn'].'</a>';
$conn->close();
include('footer.php');
die(':O');}



				$sqlcomments2 = "SELECT releases, id FROM feedings WHERE id = $rrid";
$resultcom2 = $conn->query($sqlcomments2);
if ($resultcom2->num_rows > 0) {
while($rowc2 = $resultcom2->fetch_assoc()) {
	$releasenamn=$rowc2['releases'];
	$releasesid=$rowc2['id']; }}
	

	echo '
	
	<div class="container-fluid"style="width:50%;">
<div class="panel panel-default">
  <div class="panel-heading"><a id="'.$rowc['id'].'" href="/X-'.$releasesid.'&#x23;'.$rowc['id'].'">&#x23;'.$rowc['id'].'</a>&nbsp;&nbsp;'.$lang['adm_ac_user'].':&nbsp;<b>'.utf8_decode($rowc['name']).'</b>&nbsp;'.$lang['adm_ac_rel'].':&nbsp;<a class="trd" href="X-'.$releasesid.'" title="'.utf8_decode($releasenamn).'">'.utf8_decode(mb_strimwidth($releasenamn, 0, 40, '...')).'</a></div>
  <div class="panel-body"><div class="subsub">'.utf8_decode(makeLinks($rowc['subject'])).'</div><br /><i><div class="subtime">'.utf8_decode($rowc['submittime']).'<a class="trd" href="allakommentarer?'.$admindelete.'='.$adminconfirm.'&idt='.$rowc['id'].'"><span class="glyphicon glyphicon-trash"></span></a></div></i></div>
</div>
	</div>
	
	';
}}}}
$conn->close();

include('footer.php');
 ?>