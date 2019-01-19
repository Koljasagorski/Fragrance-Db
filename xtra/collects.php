<?php
require_once('./xtra/broken_dreams.php');
// Create connection

    	echo '<table style="width:100%">  <tr>
    <th>'.$lang['coll_th_td'].'</th>
    <th>'.$lang['coll_th_tracker'].'</th>
    <th>'.$lang['coll_th_rele'].'</th>
    <th>'.$lang['coll_th_det'].'</th>
  </tr>';

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


    $page = isset( $_GET['page'] )? 
    $_GET['page']: 
    1;

// decide # of items per page
$limit = 25;
$resultsPerPage = 99999;
// determine offset for SQL statement
$offset = pagination_getOffset( $page,$limit );
$search_keyword="imdb.com/title/";



// write your sql
$sql = "SELECT * FROM feedings"
    ." ORDER BY time DESC"
    ." LIMIT $offset, $limit";


    
    $countsql = "SELECT COUNT(*) FROM feedings";
    
    $sql2 = "SELECT FOUND_ROWS()";
    
    $result2 = $conn->query($sql2);
    
$totalPages = $resultsPerPage / $result2;

$result = $conn->query($sql);


if ($result->num_rows > 0) {



    while($row = $result->fetch_assoc()) {
	    	$het='';
	    if($row['visningar'] >= '10'){
	$het='<a class="trd"><span class="glyphicon glyphicon-fire" title="'.$lang['coll_table_hot'].'"></span></a>&nbsp;';
}
$adminhet='';
if (isset($_COOKIE['password']) && isset($_COOKIE['aduser']) && $_COOKIE['password'] === $encryptPass && $_COOKIE['aduser'] === $adminUser) {
	$visningar=$lang['coll_table_ad_views'];
	if($row['visningar'] > '1'){
		$visningar=$lang['coll_table_ad_views'];}
	$adminhet='<span class="label label-default">'.$row['visningar'].'&nbsp;'.$visningar.'</span>&nbsp;';}
    	$strip1 = str_replace("I", "", $row['nfo']);
    	$strip2 = str_replace("#", "", $strip1);
    	$info = str_replace("?", "", $strip2);	


    	$relmod = str_replace("+", "%2B", $row['releases']);

    	
    	include('./xtra/trackers.php');

	    	
		$maze = "";
    	$imdb = "";

		if($row['time'] >= $_COOKIE["lastViewed"]){
    	$newtag = "<font color='hotpink'>(".$lang['coll_table_new'].")</font>";}
    	else{
	    	$newtag = ""; }

$stmt = $conn->prepare('SELECT COUNT(*) FROM comments WHERE releaseID = ?');
$stmt->bind_param('i', $row['id']); 
if ( ! $stmt->execute()) {
    trigger_error('The query execution failed; MySQL said ('.$stmt->errno.') '.$stmt->error, E_USER_ERROR);
}
$col1 = null;
$stmt->bind_result($col1);
while ($stmt->fetch()) {
    echo NULL;
}
	
		$comment='<a class="one" href="/X-'.$row['id'].'#comments"><span class="glyphicon glyphicon-comment"title="'.$lang['coll_table_com_btn'].'"></span>'.$col1.'</a>&nbsp;';

	        
	     $SubFind1 = "nordic";
	     $SubFind2 = "swesub";
	     $SubFind3 = "swedish";
	     $textad="";
        if(stripos($row['releases'], $SubFind1) !== false){
	        $textad='<span class="label label-success">'.$lang['coll_table_norsub'].'</span>&nbsp;';}
	    if(stripos($row['releases'], $SubFind2) !== false){
	        $textad='<span class="label label-success">Swedish Sub</span>&nbsp;';}
	    if(stripos($row['releases'], $SubFind3) !== false){
	        $textad='<span class="label label-success">'.$lang['coll_table_swau'].'</span>&nbsp;';}
	    $groupFind1 = "-twa";
	    $groupFind2 = "-rapidcows";
	    $groupFind3 = "-uglyduck";
	    $groupFind4 = "-g5isch";
	    $groupFind5 = "-nbretail";
	    $groupFind6 = "-dbretail";
	    $groupFind7 = "-superbits";
	    $groupFind8 = "-sb";
	    $groupFind9 = "-egen";
	    $groupFind10 = "-scb";
	    $groupFind11 = "~sandra";
	    $groupFind12 = "-PTNK";
	    $groupFind13 = "-hellgate";
	    $groupFind14 = "-nordicbits";
	     $p2p="";
        if(stripos($row['releases'], $groupFind1) !== false){
	        $p2p='<span class="label label-danger">P2P</span>&nbsp;';}
	    if(stripos($row['releases'], $groupFind2) !== false){
	        $p2p='<span class="label label-danger">P2P</span>&nbsp;';}
	    if(stripos($row['releases'], $groupFind3) !== false){
	        $p2p='<span class="label label-danger">P2P</span>&nbsp;<span class="label label-success" title="'.$lang['coll_table_supreme_hov'].'">'.$lang['coll_table_supreme'].'</span>&nbsp;';}
	    if(stripos($row['releases'], $groupFind4) !== false){
	        $p2p='<span class="label label-danger">P2P</span>&nbsp;';}
	    if(stripos($row['releases'], $groupFind5) !== false){
	        $p2p='<span class="label label-danger">P2P</span>&nbsp;';}
	    if(stripos($row['releases'], $groupFind6) !== false){
	        $p2p='<span class="label label-danger">P2P</span>&nbsp;';}
	    if(stripos($row['releases'], $groupFind7) !== false){
	        $p2p='<span class="label label-danger">P2P</span>&nbsp;';}
	    if(stripos($row['releases'], $groupFind8) !== false){
	        $p2p='<span class="label label-danger">P2P</span>&nbsp;';}
	    if(stripos($row['releases'], $groupFind9) !== false){
	        $p2p='<span class="label label-danger">P2P</span>&nbsp;<span class="label label-success" title="'.$lang['coll_table_supreme_hov'].'">'.$lang['coll_table_supreme'].'</span>&nbsp;';}
	    if(stripos($row['releases'], $groupFind10) !== false){
	        $p2p='<span class="label label-danger">P2P</span>&nbsp;';}
	    if(stripos($row['releases'], $groupFind11) !== false){
	        $p2p='<span class="label label-danger">P2P</span>&nbsp;';}
	    if(stripos($row['releases'], $groupFind12) !== false){
	        $p2p='<span class="label label-danger">P2P</span>&nbsp;';}
	    if(stripos($row['releases'], $groupFind14) !== false){
	        $p2p='<span class="label label-danger">P2P</span>&nbsp;';}
	    if(stripos($row['releases'], $groupFind13) !== false){
	        $p2p='<span class="label label-danger">P2P</span>&nbsp;<span class="label label-success" title="'.$lang['coll_table_supreme_hov'].'">'.$lang['coll_table_supreme'].'</span>&nbsp;';}
        
     
  		  	
	  	$deleteRelease = "";
if (isset($_COOKIE['password']) && isset($_COOKIE['aduser']) && $_COOKIE['password'] === $encryptPass && $_COOKIE['aduser'] === $adminUser) {
	$admin = '<a href="/X-'.$row["id"].'?imdb=1"><span class="label label-default"><i class="fa fa-refresh" aria-hidden="true"></i>'.$lang['coll_table_update'].'</span></a>&nbsp;';
	$deleteRelease = '<a href="/X-'.$row["id"].'?'.$admindelete.'='.$adminconfirm.'"><span class="label label-danger" title="'.$lang['coll_table_ad_warn'].'">'.$lang['coll_table_ad_del'].'</span></a>&nbsp;';  	}
		  	else { $admin = "";
		  	$deleteRelease = ""; }
		  	$trackerurl = $row['trackerurl'];

	  	$tracker = "".$favico."".$trackernamn."</th><th><a class='one' href='race?rel=".$relmod."' title='".$lang['coll_click_race']."'>".chunk_split(utf8_decode($row['releases']) ,60)."</a>";

        echo "<tr><th style='width:120px;'>".$row['time']."</th><th style='width:125px;'>".$tracker."".$newtag."".$het."<div class=''style='float:right;'>".$comment."</div><br /><div class='sub'>".$p2p."".$textad."".$adminhet."".$deleteRelease."</div></th><th style='width:100px;'><div data-balloon-length='xlarge' data-balloon='". chunk_split($info,34)."' data-balloon-pos='left'><a href='/X-".$row['id']."'><i class='glyphicon glyphicon-info-sign' aria-hidden='true'></i>".$lang['coll_th_det']."</a></div><br /><br /></th></tr>";
    		
    }
}
echo '</table>';

function pagination_html( $page,$totalPages ){

    // make sure both args are integers; current page cannot be greater than total pages
    if(
        ! ctype_digit( (string)$page )
        || ! ctype_digit( (string)$totalPages )
        || $page > $totalPages
    ){
        return false;
    }

    // no "prev" link if on first page
    if( $page > 1 ){
        $prev = '<li><a href="releases?page='.($page - 1).'" rel="previous">Previous</a></li>';
    }else {
	    $prev=""; }
    // no "next" link on last page
    if( $page < $totalPages ){
        $next = '<li><a href="releases?page='.($page + 1).'" rel="next">Next</a></li>';
    } else {
	    $next=""; }
    // done
    echo '<ul class="pager">';
    echo $prev;
    echo $next;
    echo "</ul>";
    return;
}
$paginationHTML = pagination_html( $page,$totalPages );

    function pagination_getOffset( $page,$itemsPerPage ){
    // make sure both args are integers
    if(
        ! ctype_digit( (string)$page )
        || ! ctype_digit( (string)$itemsPerPage )
    ){
        return 0;
    }
    return ($page - 1) * $itemsPerPage;
}
echo $paginationHTML;

$conn->close();
?>
