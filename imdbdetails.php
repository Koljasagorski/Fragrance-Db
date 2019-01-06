<div id="login">
<h2><?php echo $lang['det_imdb_missing'] ?></h2>
<form action="" method="post">
<label><?php echo $lang['det_imdb_url'] ?>:</label>
<input type="text" name="url" id="name" required="required" placeholder="<?php echo $lang['det_imdb_url_field'] ?>"/><br />
<input type="submit" value=" <?php echo $lang['det_imdb_add_btn'] ?> " name="submit"/><br />
</form>
</div>

</div>
<?php
if(isset($_POST["submit"])){
require_once('./xtra/broken_dreams.php');
  $regex = '/imdb.com\/title\/(tt[0-9]+)/ms';
preg_match_all($regex, $_POST['url'], $matches);
$urls = $matches[0];
// goes over all links//
foreach($urls as $url) 
{
   $imba = $url; 
}
$idredir = $id."?imdb=1&added=1";

try {
$dbh = new PDO("mysql:host=$servername;dbname=$dbname;",$username,$password);

$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // <== add this line
$sqlii = "UPDATE feedings SET imdburl='".$url."', useradd='1' WHERE releases='".$relle."'";
if ($dbh->query($sqlii)) {

echo "<script type='text/javascript'>
location.href = 'X-$idredir';
</script>";
}
else{
echo "<script type= 'text/javascript'>alert('Data not added.');</script>";
}

$dbh = null;
}
catch(PDOException $e)
{
echo $e->getMessage();
}

}


?>