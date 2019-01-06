
<?php
include('header.php');
require_once('./xtra/broken_dreams.php');

	//Memcached server and mysqli//
	
	   $sql1="select id, title, message, added, addedby from news order by id desc limit 1";

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection//
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
    $result1 = $conn->query($sql1);
	if ($result1->num_rows > 0) {
	while($row = $result1->fetch_assoc()) {
		
	

$m = new Memcached();
$m->addServer('localhost', 11211);

	if($m->get('newstitle') == ''){
$m->set('newstitle', $row['title'], 60*30); }

	if($m->get('newsmessage') == ''){
$m->set('newsmessage', $row['message'], 60*30); }

	if($m->get('newsadded') == ''){
$m->set('newsadded', $row['added'], 60*30); }

	if($m->get('newsaddedby') == ''){
$m->set('newsaddedby', $row['addedby'], 60*30); }

	if($m->get('newsid') == ''){
$m->set('newsid', $row['id'], 60*30); }

}}
	
if(!empty($m->get('newsid'))){
	$newsid=$m->get('newsid'); }
	else {
		$newsid=$row['id'];}
		
	$setUpdate = "UPDATE news SET newsviews=newsviews+1 WHERE id='".$newsid."'";
	if ($conn->query($setUpdate) === FALSE) { echo "Error: " . $setUpdate . "<br>" . $conn->error; }
	
	
?>
<title><?php $siteName ?>::News!</title>

<center>
<div class="container-fluid">


<div class="panel panel-default text-left"style="width:50%;">
  <div class="panel-heading">
    <h3 class="panel-title"><strong><?php echo utf8_decode($m->get('newstitle')) ?></strong></h3><?php echo '<h6>'.$lang['news_added'].':&nbsp;'.$m->get('newsadded').'.&nbsp;'; echo $lang['news_added_by'].':&nbsp;'.utf8_decode($m->get('newsaddedby')).'.</h6>' ?>
  </div>
  <div class="panel-body"style="height:400px;overflow-y: auto;">
  <?php
  echo utf8_decode(nl2br(makeLinks($m->get('newsmessage'))));
  
  
  
  
  
  
  ?>
  
  </div>
    </div>
  </div>
</div>

</center>
</div>
<?php include('footer.php'); ?>