<?php
//Header//
include('header.php');
?>
<link href="lib/css/emoji.css" rel="stylesheet">
  <script src="lib/js/config.js"></script>
  <script src="lib/js/util.js"></script>
  <script src="lib/js/jquery.emojiarea.js"></script>
  <script src="lib/js/emoji-picker.js"></script>
<script>
      $(function() {
        window.emojiPicker = new EmojiPicker({
          emojiable_selector: '[data-emojiable=true]',
          assetsPath: '../lib/img/',
          popupButtonClasses: 'fa fa-smile-o'
        });
        window.emojiPicker.discover();
      });
    </script>
<script>
$(document).ready(function(){
    $("#flip").click(function(){
        $("#panel").slideToggle("slow");
    });
});
</script>
<script>
function goBack() {
    window.history.back();
}
</script>

    <div id="floating-back">
    <a class="trd" href="#" onclick="goBack()"><i class="fa fa-step-backward fa-5x"></i></a>
    </div>
<div class="container-fluid">

<?php
//DB//
require_once('./xtra/broken_dreams.php');

//Get ID of Releases. Echoes an error if there are no (INT)ID//

$id = 0 + (int)$_GET["id"];
if($id == ""){
	echo "<h3>".$lang['det_err_id'];
	echo "<br />";
	echo $lang['det_err_format']."X-#####</h3>";
	}

	//DB Connection//
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection//
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM feedings WHERE id = $id";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
while($row = $result->fetch_assoc()) {
		$visning = "UPDATE feedings SET visningar=visningar+1 WHERE id='".$row["id"]."'";
if ($conn->query($visning) === FALSE) { echo "Error: " . $visning . "<br>" . $conn->error; }
//Sets favicon for the tracker//
include('./xtra/trackers.php');

//Selects the searchvariant//
	if($row['trackerurl'] === "http://37.187.94.51" || $row['tracker'] === "Nordicbits.eu" || $row['tracker'] === "Nordicbits" || $row['tracker'] === "Takeabyte-nordic" || $row['tracker'] === "Infinity-T" || $row['tracker'] === "Nordic-Rls" || $row['tracker'] === "SceneHD" || $row['tracker'] === "scanbytes.org"){
		$search = "/browse.php?search=".$row['releases']."&searchin=title&incldead=0";
	}
	if($row['tracker'] === "SuperBits" || $row['tracker'] === "SceneBits.org"){
		$search = "/search?search=".$row['releases'].""; }
		if($row['tracker'] === "Danishbits") {
			$search = "torrents.php?action=newbrowse&group=0&search=".$row['releases']."&pre_type=torrents&type="; }
		/////////
$tracker = $row['tracker'];


$trackerurl = $row['trackerurl'];

if($row['trackerurl'] === 'http://37.187.94.51' || $row['trackerurl'] === "https://nordicbits.eu" || $row['trackerurl'] === "https://nordicb.org"){
	$trackerurl = 'https://nordicb.org'; }
$relle = $row['releases'];
preg_match('/^(.+?)(.S[0-9]{2}|.[0-9]{4}|.US.|.SWEDiSH.|.SWESUB.|.MULTi.|.MULTiSUBS.|.DVDr.|.NORDiC.)/i', $relle, $matchesStart);
$matchFix = str_replace(" ", ".", $matchesStart[1]);
$updateNameStart = "";
if(empty($row["releaseStart"])){
	$updateNameStart = $matchFix;
	$setTitle = "UPDATE feedings SET releaseStart='".$matchFix."' WHERE releases='".$relle."'";
if ($conn->query($setTitle) === FALSE) { echo "Error: " . $setTitle . "<br>" . $conn->error; } }

$deleteRelease = $_GET[$admindelete];
if($deleteRelease === $adminconfirm){
if (isset($_COOKIE['password']) && isset($_COOKIE['aduser']) && $_COOKIE['password'] === $encryptPass && $_COOKIE['aduser'] === $adminUser) {
	$delRel = "DELETE FROM feedings WHERE id='".$row["id"]."'";
if ($conn->query($delRel) === FALSE) { echo "Error: " . $delRel . "<br>" . $conn->error; }
echo "Release with ID:".$row["id"]." Deleted";

include('footer.php');
$conn->close();
die();}}

//Strip out    I  #  ? from .NFO to be easier for humans to understand without ascii//
$strip1 = str_replace("I", "", $row['nfo']);
    	$strip2 = str_replace("#", "", $strip1);
    	$info = str_replace("?", "", $strip2);

 	 //Decode .NFO so that specialchars works//
		  $nfo = utf8_decode($row['nfo']);

		//Match size //
		$sizebf = '';
  $regexsz = '/(?:Storlek|Size): (.*?).*?(?:MiB|MB|GiB|GB)/';
preg_match_all($regexsz, $nfo, $matchessz);
$sz = $matchessz[0];

foreach($sz as $szs)
{
   $sizebf = $szs;
}
$size1 = str_replace("Storlek: ", "", $sizebf);
$size = str_replace("Size: ", "", $size1);
if(empty($size)){
	$size=$lang['det_size_unknown']; }
	
	if($row['size'] !== "Unknown" OR $row['size'] !== ""){
	$sqlsz = "UPDATE feedings SET size='".$size."' WHERE id='".$row['id']."'";
if ($conn->query($sqlsz) === FALSE) { echo "Error: " . $sqlsz . "<br>" . $conn->error; }}
if(!empty($row['size'])){
		$size=$row['size']; }


 $info2 = str_replace("[img=", "<br />", $info);
 $info3 = str_replace("[img]", "<br />", $info2);
 $info4 = str_replace("]", "", $info3);

//Echoes Favicon, Trackerurl, Searchvariant, Tracker, Release, potential IMDB and Time when it was uploaded on the tracker//

$het='';
if($row['visningar'] >= '10'){
	$het='<a class="trd"><span class="glyphicon glyphicon-fire" title="'.$lang['coll_table_hot'].'"></span></a>';
}
echo "<h1>".$tracker."</h1>";
echo "<h3>".utf8_decode($relle)."".$het."</h3><h6><i class='fa fa-clock-o' aria-hidden='true'></i>".$row['time']."&nbsp;".$lang['det_size'].":&nbsp;".$size."</h6>";

//Echoes Similar .Torrents//
echo '<center><div style="background-color:#FFF;width:60%;height:100px;overflow: auto"><table>';
$rs=$row['releaseStart'];
	$sqlsim1 = "SELECT * FROM feedings WHERE releaseStart = '$rs' ORDER BY id DESC LIMIT 10";
$resultsim1 = $conn->query($sqlsim1);
if ($resultsim1->num_rows > 0) {
while($rowc1 = $resultsim1->fetch_assoc()) {
	
	$sametorrent="";
	if($rowc1['id'] === $row['id']){
	$sametorrent="<font color='hotpink'>(".$lang['det_cur_det'].")</font>";}
	echo "<tr><th><a class='trd' href='X-".$rowc1['id']."'>".$rowc1['releases']."</a><div class=''style='float:right;'>".$sametorrent."</div></th></tr>";

} }
 echo "</table></div></td></tr></center>";

echo '
<center>
<div class="panel panel-default"style="width:60%;">
  <div class="panel-heading">
    <h3 class="panel-title">.NFO</h3>
  </div>
  <div class="panel-body"style="height:150px;overflow-y: auto;">
  
  '.utf8_decode(nl2br(makeLinks($info4))).'
  

  </div></div></center>';


	$rid = $row['id'];

	$sqlcomments = "SELECT * FROM comments WHERE releaseID = $rid";
$resultcom = $conn->query($sqlcomments);
if ($resultcom->num_rows > 0) {
while($rowc = $resultcom->fetch_assoc()) {
	if($rowc['name'] !== ""){
		if($rowc['subject'] != ""){

	echo '<div class="container-fluid"style="width:50%;">
<div class="panel panel-default">
  <div class="panel-heading"><a id="'.$rowc['id'].'" href="/X-'.$row['id'].'&#x23;'.$rowc['id'].'">&#x23;'.$rowc['id'].'</a>&nbsp;&nbsp;User:&nbsp;<b>'.utf8_decode($rowc['name']).'</b></div>
  <div class="panel-body"><div class="subsub">'.utf8_decode(nl2br(makeLinks($rowc['subject']))).'</div><br /><i><div class="subtime"title="">'.utf8_decode($rowc['submittime']).'</div></i></div>
</div>
	</div>';

}}}}
$nick='<input type="text" name="name" class="form-control" id="name" placeholder="'.$lang['det_comment_nick'].'" required>';
if(isset($_COOKIE['name'])){
	$nick = '<input type="text" name="name" class="form-control" id="name" value="'.$_COOKIE['name'].'" required>';}
echo '
<a id="comments"></a>
<div class="container-fluid"style="width:50%;">

<div class="panel panel-default">
<div class="panel-heading">'.$lang['det_comment'].'</div>
  <div class="panel-body">
  	<form action="postcomment.php" method="post" onsubmit="return checkform(this);">

  	  <div class="form-group">
	    '.$nick.'
	  </div>
	  <div class="form-group">
	    <textarea name="subject" class="form-control" rows="5" data-emojiable="true" data-emoji-input="unicode" required></textarea>

	  <button type="submit" class="btn btn-primary">'.$lang['det_comment_submit_btn'].'</button>
	   	<br>
<div class="capbox">

<div id="CaptchaDiv"></div>

<div class="capbox-inner">
Type the above number:<br>

<input type="hidden" id="txtCaptcha">
<input type="text" name="CaptchaInput" id="CaptchaInput" size="15"><br>
</div>
</div>
<br><br>
	  </div><input type="hidden" name="random" class="form-control" id="random" value="'.$rid.'">
	</form>
  </div>
</div>';
?>
	<script type="text/javascript">
// Captcha Script
function checkform(theform){
var why = "";
if(theform.CaptchaInput.value == ""){
why += "- Please Enter CAPTCHA Code.\n";
}
if(theform.CaptchaInput.value != ""){
if(ValidCaptcha(theform.CaptchaInput.value) == false){
why += "- The CAPTCHA Code Does Not Match.\n";
}
}
if(why != ""){
alert(why);
return false;
}
}
var a = Math.ceil(Math.random() * 9)+ '';
var b = Math.ceil(Math.random() * 9)+ '';
var c = Math.ceil(Math.random() * 9)+ '';
var d = Math.ceil(Math.random() * 9)+ '';
var e = Math.ceil(Math.random() * 9)+ '';
var code = a + b + c + d + e;
document.getElementById("txtCaptcha").value = code;
document.getElementById("CaptchaDiv").innerHTML = code;
// Validate input against the generated number
function ValidCaptcha(){
var str1 = removeSpaces(document.getElementById('txtCaptcha').value);
var str2 = removeSpaces(document.getElementById('CaptchaInput').value);
if (str1 == str2){
return true;
}else{
return false;
}
}
// Remove the spaces from the entered and generated code
function removeSpaces(string){
return string.split(' ').join('');
}
</script><?php
echo NULL;

include('footer.php');
   }
} else { echo '<h2>'.$lang['det_err_does_not_exist'].'</h2>'; 
echo '<br /><br />';
include('footer.php');
}
//Closes connection to DB//
$conn->close();
?>
