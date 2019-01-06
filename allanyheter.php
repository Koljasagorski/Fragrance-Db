<?php
include('header.php');
    if ($_COOKIE['password'] !== $encryptPass || $_COOKIE['aduser'] !== $adminUser) {
        header('Location: rakel');
        die();
    }

require_once('./xtra/broken_dreams.php');

 	$sql1="select id, title, message, added, addedby, newsviews from news order by id desc limit 1";
	$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection//
	if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if($_GET['added'] === '1'){
	echo '<h2>'.$lang['adm_news_added_delay'].' </h2><br />'; }
	echo '<h3>'.$lang['adm_news_no_bbcode'].' <a href="https://www.w3schools.com/tags/default.asp" title="Full try-me for HTML">HTML</a> '.$lang['adm_news_no_bb_rem'].'</h3>';
$nick='<input type="text" name="addedby" class="form-control" id="addedby" placeholder="'.$lang['adm_news_nick'].'">';
if(isset($_COOKIE['name'])){
	$nick = '<input type="text" name="addedby" class="form-control" id="addedby" value="'.$_COOKIE['name'].'">';}
	$newsTitle='<input type="text" name="title" class="form-control" id="title" placeholder="'.$lang['adm_news_title'].'">';
echo '<center>
<div class="panel panel-default text-left"style="width:50%;">
<div class="panel-heading">'.$lang['adm_news_post'].'</div>
  <div class="panel-body">
  	<form action="postnews.php" method="post">

  	  <div class="form-group">
  	  '.$newsTitle.'
  	  <br/>
	    '.$nick.'
	  </div>
	  <div class="form-group">
	     <textarea name="message" class="form-control" rows="5" required></textarea>

	   <button type="submit" class="btn btn-primary">'.$lang['adm_news_submit_btn'].'</button>
	</form>
</div>
</div>
</div>';

    $result1 = $conn->query($sql1);
	if ($result1->num_rows > 0) {
	while($row = $result1->fetch_assoc()) {
		
	$newsviews=$lang['coll_table_ad_view'];
	if($row['newsviews'] > '1'){
		$newsviews=$lang['coll_table_ad_views'];}

$m = new Memcached();
$m->addServer('localhost', 11211);

	if($m->get('newstitle') == ''){
$m->set('newstitle', $row['title'], 60*1); }

	if($m->get('newsmessage') == ''){
$m->set('newsmessage', $row['message'], 60*1); }

	if($m->get('newsadded') == ''){
$m->set('newsadded', $row['added'], 60*1); }

	if($m->get('newsaddedby') == ''){
$m->set('newsaddedby', $row['addedby'], 60*1); }

	if($m->get('newsid') == ''){
$m->set('newsid', $row['id'], 60*1); }


$deleteNews = '';			
$deleteNews = $_GET[$admindelete];
if($deleteNews === $adminconfirm){
	
$m->delete('newstitle');
$m->delete('newsadded');
$m->delete('newsaddedby');
$m->delete('newsmessage');
$m->delete('newsid');
	$delNews = "DELETE FROM news WHERE id='".$_GET['idt']."'";
if ($conn->query($delNews) === FALSE) { echo "Error: " . $delNews . "<br>" . $conn->error; } 
header('Location: /allanyheter');}

	

	echo '
	
<div class="panel panel-default text-left"style="width:50%;">
  <div class="panel-heading">
    <h3 class="panel-title"><strong>'.utf8_decode($m->get('newstitle')).'</strong></h3><h6>'.$lang['adm_news_added'].':&nbsp;'.$m->get('newsadded').'.&nbsp;'.$newsviews.':&nbsp;'.$row['newsviews'].''.$lang['adm_ctrl_amount'].'.&nbsp;'.$lang['adm_news_added_by'].':&nbsp;'.utf8_decode($m->get('newsaddedby')).'.</h6>
    <a class="trd" href="allanyheter?'.$admindelete.'='.$adminconfirm.'&idt='.$m->get('newsid').'"><span class="glyphicon glyphicon-trash"></span></a>
  </div>
  <div class="panel-body"style="height:400px;overflow-y: auto;">
  
  '.utf8_decode(nl2br(makeLinks($m->get('newsmessage')))).'
  
  
  
  
  
  
  
  
  </div>
    </div>
  </div>
</div>

</center>
</div>
	
	';
}}
$conn->close();

include('footer.php');
 ?>