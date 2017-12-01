<?php
  session_start();
date_default_timezone_set("America/New_York");         

 include ("account.php") ;
( $dbh = mysql_connect ( $hostname, $user, $pwd ) )
	        or    die ( "Unable to connect to MySQL database. <br>".mysql_error() );
mysql_select_db( $project ); 

     
 
   $rcvd = file_get_contents('php://input');
	$rec = json_decode($rcvd);
    
    $ucid = $rec->ucid;
	$_SESSION['ucid'] = $ucid;
	
	 
    $mc = mysql_query("SELECT id, category, qst, level FROM mcq");
    $tf = mysql_query("SELECT id, category, qst, level FROM truefalse");
    $oe = mysql_query("SELECT id, category, qst, level FROM openEnded");
        
    $mcq = array();
    $tfq = array();
    $oeq = array();
    
    while($m = mysql_fetch_assoc($mc)) {
            $mcq[] = $m;
    }
    
    while($t = mysql_fetch_assoc($tf)) {
            $tfq[] = $t;
    }
    
    while($o = mysql_fetch_assoc($oe)) {
            $oeq[] = $o;
    }
   	
	echo json_encode(array('mcq' => $mcq, 'tfq' => $tfq, 'oeq' => $oeq, 'ucid'=>$ucid));
        
?>