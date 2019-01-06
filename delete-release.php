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
$rrid = $_POST['id'];
if(!empty($rrid)){
	$delRel = "DELETE FROM feedings WHERE id='".$rrid."'";
if ($conn->query($delRel) === FALSE) { echo "Error: " . $delRel . "<br>" . $conn->error; } 
echo '<h2>Release Deleted!<br />No turning back now! <img src="./img/smilies/wink.gif" alt=""></h2>';}

	echo '
	
	<div class="container-fluid"style="width:50%;">
<div class="panel panel-default">
<div class="panel-heading">'.$lang['adm_dr_enter_id'].'</div>
  <div class="panel-body">
  	<form action="delete-release" method="post">
 
  	  <div class="form-group">
	    '.$nick.'
	  </div>
	  <div class="form-group">
	    <input type="text" name="id" id="id" placeholder="'.$lang['adm_dr_id_field'].'" class="form-control" required>
	  
	  <button type="submit" class="btn btn-primary">'.$lang['adm_dr_submit_btn'].'</button>
	   	
	  
	</form>


  </div>
</div>

	
	';

$conn->close();

include('footer.php');
 ?>