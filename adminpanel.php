<style>
.center {
    margin: auto;
    width: 50%;
    padding: 2px;
    border:1px solid;
    border-radius:6px;
    box-shadow: 2px 2px 2px 2px lightgrey;
}
</style>
<?php
include('header.php');
if($_COOKIE['aduser'] !== $adminUser) {
    if ($_COOKIE['password'] !== $encryptPass){
	    
        header('Location: adminlogin');
        die();
    } }
    if($_COOKIE['aduser'] === $adminUser) {
    if ($_COOKIE['password'] === $encryptPass){
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
//how many comments?//
$sql = "SELECT id FROM comments";
if ($conn->query($sql) === FALSE) { echo "Error: " . $sql . "<br>1" . $conn->error; }
$resultcom = $conn->query($sql);
$res=$resultcom->num_rows;
$totalCom=$res;

//how many details?//
$sql2 = "SELECT id FROM feedings";
if ($conn->query($sql2) === FALSE) { echo "Error: " . $sql2 . "<br>2" . $conn->error; }
$resultdet = $conn->query($sql2);
$res2=$resultdet->num_rows;
$totalDet=$res2;

//how many international details?//
$sql3 = "SELECT id FROM nonnordic";
if ($conn->query($sql3) === FALSE) { echo "Error: " . $sql3 . "<br>3" . $conn->error; }
$resultdet1 = $conn->query($sql3);
$res3=$resultdet1->num_rows;
$totalDet1=$res3;

//how many views?//
$sql4 = "SELECT antal FROM visits WHERE id=1 LIMIT 1";
if ($conn->query($sql4) === FALSE) { echo "Error: " . $sql4 . "<br>4" . $conn->error; }
$resultviews = $conn->query($sql4);
$res4 = $resultviews->fetch_assoc();
$totalViews=$res4['antal'];


//Database size?//
$size = 0;
$sql6 = "SHOW TABLE STATUS";
if ($conn->query($sql5) === FALSE) { echo "Error: " . $sql5 . "<br>5" . $conn->error; }
$resultlog = $conn->query($sql5);
$res6 = $conn->query($sql6);
if ($res6->num_rows > 0) {
	while($row6 = $res6->fetch_assoc()) {
$size += $row6["Data_length"] + $row6["Index_length"];  
$decimals = 2;  
$mbytes = number_format($size/(1024*1024),$decimals);
}}
$m = new Memcached();
$m->addServer('localhost', 11211);
	if($m->get('dbSz') == ''){
$m->set('dbSz', $mbytes, 60*60); }

	echo '
	
	<div class="container-fluid"style="width:50%;">
<h2>'.$lang['adm_ctrl_head'].' --- <a class="trd" href="admin-out">'.$lang['adm_ctrl_logout'].'</a></h2><br />

<a href="allakommentarer" class="btn btn-default" role="button">'.$lang['adm_ctrl_comments'].'</a> &nbsp; <a href="delete-release" class="btn btn-default" role="button">'.$lang['adm_ctrl_del_rel'].'</a> &nbsp; <a href="/xtra/reset_easteregg?set=1" class="btn btn-default" role="button"><font color=red>'.$lang['adm_ctrl_east'].'</font></a>
 &nbsp; <a href="allanyheter" class="btn btn-default" role="button">'.$lang['adm_ctrl_news'].'</a>
 <br />
</div><br />
	
	';
	echo '
	<div class="center">
  <h3>Stats</h3>           
  <table class="table table-bordered">

    <tbody>
      <tr>
        <td>'.$lang['adm_db_size'].'</td>
        <td><i>'.$m->get('dbSz').'</i> MiB</td>
      </tr>
      <tr>
        <td>'.$lang['adm_ctrl_comments'].'</td>
        <td><i>'.$totalCom.'</i> '.$lang['adm_ctrl_amount'].'&nbsp;<i>(cached:&nbsp;'.$m->get('comments').'&nbsp;'.$lang['adm_crtl_today'].')</td>
      </tr>
      <tr>
        <td>'.$lang['adm_ctrl_torrents'].'</td>
        <td><i>'.$totalDet.'</i> '.$lang['adm_ctrl_amount'].'&nbsp;<i>(cached:&nbsp;'.$m->get('numrows').')</td>
      </tr>
      <tr>
        <td>'.$lang['adm_ctrl_int_torrents'].'</td>
        <td><i>'.$totalDet1.'</i> '.$lang['adm_ctrl_amount'].'&nbsp;<i>(cached:&nbsp;'.$m->get('intercount').')</td>
      </tr>
      <tr>
        <td>'.$lang['adm_ctrl_views'].'</td>
        <td><i>'.$totalViews.'</i> '.$lang['adm_ctrl_amount'].'&nbsp;<i>(cached:&nbsp;'.$m->get('antal').')</td>
      </tr>
      

    </tbody>
  </table>
</div>
<br />
';

$conn->close();
}}
else{ echo "<h2><a href='adminlogin' class='trd'>Login</a> to use this page</h2>";}
include('footer.php');
 ?>