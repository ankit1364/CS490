<?php
    session_start();
	$_SESSION['ucid'];
	date_default_timezone_set("America/New_York");

    include ("account.php") ;
( $dbh = mysql_connect ( $hostname, $user, $pwd ) )
	        or    die ( "Unable to connect to MySQL database. <br>".mysql_error() );
mysql_select_db( $project ); 

    
   $rcvd = file_get_contents('php://input');
	$rec = json_decode($rcvd);
    
    $quizID = $rec->id;
    $ucid = $rec->ucid;
	
	$date = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');
	$dat=date('Y-m-d', strtotime($date .' -1 day'));
	
	$ge="update quizes set endDate='$dat' where id=$quizID";
	($c = mysql_query($ge)) or print mysql_error();
		
	mysql_close();
	?>