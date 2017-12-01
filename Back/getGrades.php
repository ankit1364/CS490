<?php
    session_start();
    $_SESSION['ucid'];

	include ("account.php") ;
	( $dbh = mysql_connect ( $hostname, $user, $pwd ) )
	        or    die ( "Unable to connect to MySQL database. <br>".mysql_error() );
	mysql_select_db( $project ); 

	
	$rcvd = file_get_contents('php://input');
    $rcv = json_decode($rcvd);
      
	$ucid = $rcv->ucid;
	
	//$_session['ucid']=$ucid;
    
    $grades= array();
	
	$user = "SELECT * FROM Grades where ucid = '$ucid'";
	($a = mysql_query($user)) or print mysql_error();
    
	 while ($fetch = mysql_fetch_array($a)) 
		{$grades[] = $fetch;}
    
   echo json_encode(array('grades' => $grades, 'ucid' => $ucid));
   
		mysql_close();
	

?>