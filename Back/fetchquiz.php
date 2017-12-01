<?php
    session_start();
	$_SESSION['ucid']=$ucid;
	$_SESSION['stu']=$name;
	
	date_default_timezone_set("America/New_York");
	    
	include ("account.php") ;
	( $dbh = mysql_connect ( $hostname, $user, $pwd ) )
	        or    die ( "Unable to connect to MySQL database. <br>".mysql_error() );
	mysql_select_db( $project ); 

	$allquizes = array();
    $notStarted = array();
    $available = array();
    $ended = array();
	
	$quiz = "SELECT * FROM quizes";	
	($f = mysql_query($quiz)) or print mysql_error();
     
	 while ($fetch = mysql_fetch_array($f)) 
	 {

	 $allquizes[] = $fetch;
	 $sdate = $fetch['startDate'];
	 $edate = $fetch['endDate'];
	 $today = date("Y-m-d");
	 	
	if(strtotime($sdate) > strtotime($today))
		$notStarted[] = $fetch;
    	 
	else if(strtotime($edate) < strtotime($today))
		$ended[] = $fetch;
	    	
	else if(strtotime($sdate) <= strtotime($today) && strtotime($edate) > strtotime($today))
		$available[] = $fetch;
	 
	 
	 }
	 
	mysql_close();
	    
	echo json_encode(array('quizes' => $allquizes,'available' => $available , 'ended'=>$ended ,
									'notStarted' => $notStarted, 'ucid' => $ucid));


?>