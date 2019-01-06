
<?php
include('header.php');
echo "<title>".$siteName."</title>";
?>

<div class="container-fluid">
<?php if(!isset($_COOKIE["type"])) {

echo "Select Feed-type";
echo "<br><br>";
echo "<a href='choose?type=0'class='btn btn-info' role='button'>All releases</a>";
echo "<br><br>";
echo "<a href='choose?type=1'class='btn btn-info' role='button'>Winner only</a>";
echo '<br><br>';
echo "<a href='/international'class='btn btn-info' role='button'>International</a>";
echo '<br><br>';
echo "<a href='/info'class='btn btn-info' role='button'>I dunno, give Me some info</a>";
}
if(isset($_COOKIE["type"])) {
echo "Select Feed-type";
echo '<br><br>';
echo "<a href='/releases'class='btn btn-info' role='button'>All releases</a>";
echo '<br><br>';
echo "<a href='/one'class='btn btn-info' role='button'>Winner only</a>";
echo '<br><br>';
echo "<a href='/international'class='btn btn-info' role='button'>International</a>";
echo '<br><br>';
echo "<a href='/info'class='btn btn-info' role='button'>I dunno, give Me some info</a>";
}
?>


</div>
<?php include('footer.php'); ?>