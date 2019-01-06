<?php
    $key=htmlspecialchars($_GET['key']);
    $array = array();
   
    $con=mysql_connect("localhost","root","Treblee34142");
    $db=mysql_select_db("feeds",$con);
    $query=mysql_query("select * from feedings where releases LIKE '%{$key}%' OR nfo LIKE '%{$key}%' OR genre LIKE '%{$key}%' OR imdburl LIKE '%{$key}%' order by time DESC");
    while($row=mysql_fetch_assoc($query))
    {
	    if($row['tracker'] === "SuperBits"){
		    $tracker = "SB"; }
		if($row['tracker'] === "Neverland Pirates"){
			$tracker = "NLP"; }
		if($row['tracker'] === "Nordicbits.eu"){
			$tracker = "NB"; }
		if($row['tracker'] === "Takeabyte-nordic"){
			$tracker = "TBN"; }
		if($row['tracker'] === "Infinity-T"){
			$tracker = "&infin;T"; }
		if($row['tracker'] === "Nordic-Rls"){
			$tracker = "NRL"; }
		if($row['tracker'] === "SceneHD"){
			$tracker = "SHD"; }
		if($row['tracker'] === "scanbytes.org"){
			$tracker = "SCA"; }
		if($row['tracker'] === "SceneBits.org"){
			$tracker = "SCB"; }
			$relmod = str_replace("+", "%2B", $row['releases']);
      $array[] = $tracker." | <a class='one' href='/race?rel=".$relmod."' title='".$row['time']."'>".chunk_split($row['releases'],30)."";
     
    }
 
    echo json_encode($array);
?>
