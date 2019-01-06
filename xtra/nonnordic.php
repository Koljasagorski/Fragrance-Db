<?php
require_once('./xtra/broken_dreams.php');
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
// Create connection
    	echo '<table style="width:100%">  <tr>
    <th>Time/Date</th>
    
    <th>Release</th>
    <th>Details</th>
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
$sql = "SELECT * FROM nonnordic"
    ." ORDER BY time DESC"
    ." LIMIT $offset, $limit";

    
    $countsql = "SELECT COUNT(*) FROM nonnordic";
    
    $sql2 = "SELECT FOUND_ROWS()";
    
    $result2 = $conn->query($sql2);
    
$totalPages = ceil($resultsPerPage / $result2);

$result = $conn->query($sql);


if ($result->num_rows > 0) {



    while($row = $result->fetch_assoc()) {

    	$strip1 = str_replace("I", "", $row['nfo']);
    	$strip2 = str_replace("#", "", $strip1);
    	$info = str_replace("?", "", $strip2);	


    	$relmod = str_replace("+", "+", $row['releases']);
		$relmod2 = str_replace(" ", ".", $relmod);


		if($row['time'] >= $_COOKIE["lastViewed"]){
    	$newtag = "<font color='hotpink'>(".$lang['coll_table_new'].")</font>";}
    	else{
	    	$newtag = ""; }
        $rating="";





	  	$tracker = "<th>".chunk_split(utf8_decode($relmod2) ,60)."";

        echo "<tr><th style='width:125px;'>".$row['time']."</th>".$tracker."".$newtag."</th><th style='width:100px;'>#".$row['id']."<br /><br /></th></tr>";
    		
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
        $prev = '<li><a href="international?page='.($page - 1).'" rel="previous">Previous</a></li>';
    }else {
	    $prev=""; }
    // no "next" link on last page
    if( $page < $totalPages ){
        $next = '<li><a href="international?page='.($page + 1).'" rel="next">Next</a></li>';
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
