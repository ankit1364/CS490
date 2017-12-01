
<?php
    session_start();
    $_SESSION['ucid'];
	date_default_timezone_set("America/New_York");
 	
	include ("account.php") ;
	( $dbh = mysql_connect ( $hostname, $user, $pwd ) )
	        or    die ( "Unable to connect to MySQL database. <br>".mysql_error() );
	mysql_select_db( $project ); 

	
	$rcvd = file_get_contents('php://input');
    $rcv = json_decode($rcvd);
      
	$ucid = $rcv->ucid;
	
	//echo "ucid at back:".$ucid;
    
    $allquizes = array();
    $status = array();
	
	$quiz = "SELECT * FROM quizes where profUcid='$ucid'";
	($f = mysql_query($quiz)) or print mysql_error();
	 while ($fetch = mysql_fetch_array($f)) 
		{$allquizes[] = $fetch;}
	
	$sq = "Select * from Grades,quizes where `quizID`=`id` ";
	($g = mysql_query($sq)) or print mysql_error();
		while ($fe = mysql_fetch_array($g)) 
			{$status[] = $fe;}
   
    
	echo json_encode(array('quizes' => $allquizes, 'status' => $status, 'ucid' => $ucid));
        
?>