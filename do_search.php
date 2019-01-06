<?php
require_once('./xtra/broken_dreams.php');
if(empty($_GET['search_keyword'])) {
if(isset($_POST['search_keyword'])) {
	$alteredPost = str_replace(" ", ".", $_POST['search_keyword']);

    $search_keyword = $dbConnection->real_escape_string($alteredPost);
    $query = "select * from feedings where releases LIKE '%{$search_keyword}%' order by time DESC limit 25";
    $result = $dbConnection->query($query);
    if ($result === false) {
        trigger_error('Error: ' . $dbConnection->error, E_USER_ERROR);
    } else {
        $rows_returned = $result->num_rows;
    }
    $bold_search_keyword = '<strong><font color="red">' . $search_keyword . '</font></strong>';
    if ($rows_returned > 0) {
        while ($row = $result->fetch_assoc()) {
	       include('./xtra/trackers.php');

$detailsbtn = '<span class="label label-primary"><a class="snd" href="X-'.$row['id'].'">Details</a></span>&nbsp;';
                $str_key = str_ireplace($search_keyword, $bold_search_keyword, $row['releases']);
                $relmod = str_replace("+", "%2B", $row['releases']);
                $tracker = $favico."".$trackernamn."</td><td class='col-sm-8'width='99%'><a class='one' href='race?rel=".$relmod."'>".chunk_split(utf8_decode($str_key) ,140)."</a>";
                 echo "<table class='table'><td class='col-sm-1' width='135px'>".$row['time']."</td><td class='col-sm-1'width=140px'>".$tracker."<br /><div class='sub'>".$detailsbtn."</div></td><td class='col-sm-1'width='15px'>&nbsp;#".$row['id']."</td></table>";
    			echo "<title>Searching for: ".$search_keyword."</title>";
    	
        }
    } else {
        echo '<div class="show" align="left">No matching records.</div>';
    }
}
}else{

if(!empty($_GET['search_keyword'])) {
	$alteredPostGet = str_replace(" ", ".", $_GET['search_keyword']);
	$alteredPostGetCast = str_replace(".", " ", $_GET['search_keyword']);
	if(!empty($_GET['cast'])){
		$alteredPostGet = $alteredPostGetCast;}
    $search_keyword = $dbConnection->real_escape_string($alteredPostGet);
    $query = "select * from feedings where releases LIKE '%{$search_keyword}%' order by time DESC limit 25";
    $result = $dbConnection->query($query);
    if ($result === false) {
        trigger_error('Error: ' . $dbConnection->error, E_USER_ERROR);
    } else {
        $rows_returned = $result->num_rows;
    }
    $bold_search_keyword = '<strong><font color="red">' . $search_keyword . '</font></strong>';
    if ($rows_returned > 0) {
        while ($row = $result->fetch_assoc()) {
	       include('./xtra/trackers.php');

$detailsbtn = '<span class="label label-primary"><a class="snd" href="X-'.$row['id'].'">Details</a></span>&nbsp;';
                $str_key = str_ireplace($search_keyword, $bold_search_keyword, $row['releases']);
                $relmod = str_replace("+", "%2B", $row['releases']);
                $tracker = $favico."".$trackernamn."</td><td class='col-sm-8'width='99%'><a class='one' href='race?rel=".$relmod."'>".chunk_split(utf8_decode($str_key) ,140)."</a>";
                 echo "<table class='table'><td class='col-sm-1' width='135px'>".$row['time']."</td><td class='col-sm-1'width=140px'>".$tracker."<br /><div class='sub'>".$detailsbtn."</div></td><td class='col-sm-1'width='15px'>&nbsp;#".$row['id']."</td></table>";
    			echo "<title>Searching for: ".$search_keyword."</title>";
    	
        }
    } else {
        echo '<div class="show" align="left">No matching records.</div>';
    }
}
}
?>