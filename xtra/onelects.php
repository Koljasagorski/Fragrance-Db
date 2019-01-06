
<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
require_once('./xtra/broken_dreams.php');

    	echo '<table style="width:100%">  <tr>
    <th>'.$lang['coll_th_td'].'</th>
    <th>'.$lang['coll_th_tracker'].'</th>
    <th>'.$lang['coll_th_rele'].'</th>
    <th>'.$lang['coll_th_det'].'</th>
  </tr>';
    

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
    $page = isset( $_GET['page'] )? 
    $_GET['page']: 
    1;
    $limit = 25;
$resultsPerPage = 99999;
// determine offset for SQL statement
$offset = pagination_getOffset( $page,$limit );
$sql = "SELECT DISTINCT id, releases, nfo, trackerurl, tracker, time, visningar FROM feedings GROUP BY releases ORDER BY time DESC LIMIT $offset, $limit";
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
    	$strip1 = str_replace("I", "", $row['nfo']);
    	$strip2 = str_replace("#", "", $strip1);
    	$info = str_replace("?", "", $strip2);	


    	$relmod = str_replace("+", "%2B", $row['releases']);

    
include('./xtra/trackers.php');
		$newtag = "";
		if($row['time'] >= $_COOKIE["lastViewed"]){
    	$newtag = "<font color='hotpink'>(".$lang['coll_table_new'].")</font>";}
    	$maze = "";
    	$imdb = "";
    	
  $tracker = $favico."".$trackernamn."</th><th><a class='one' href='race?rel=".$relmod."'>".chunk_split(utf8_decode($row['releases']) ,40)."</a>";
    	
        echo "<tr><th style='width:120px;'>".$row['time']."</th><th style='width:125px;'>".$tracker."".$newtag."".$het."</th><th style='width:100px;'><div data-balloon-length='xlarge' data-balloon='". chunk_split($info,34)."' data-balloon-pos='left'>".$imdb."<a href='/X-".$row['id']."'><i class='glyphicon glyphicon-info-sign' aria-hidden='true'></i>".$lang['coll_th_det']."</a></div></th></tr>";
    		
    }
}
echo '</table>';
function pagination_html( $page,$totalPages ){
	$imdbpage="";
	$adminPage = "";
if (isset($_COOKIE['password']) && isset($_COOKIE['aduser']) || $_COOKIE['password'] === 'Treblee3' && $_COOKIE['aduser'] === 'Rakel') {
	$adminPage = '';}
	  	
		  	else { $adminPage = ""; }
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
        $prev = '<li><a href="one?page='.($page - 1).''.$adminPage.''.$imdbpage.'" rel="previous">Previous</a></li>';
    }else {
	    $prev=""; }
    // no "next" link on last page
    if( $page < $totalPages ){
        $next = '<li><a href="one?page='.($page + 1).''.$adminPage.''.$imdbpage.'" rel="next">Next</a></li>';
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
