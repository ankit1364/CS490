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
	
	$get="update Grades set status='released' where quizID=$quizID";
	($a = mysql_query($get)) or print mysql_error();
	
	$ge="update quizes set status='released' where id=$quizID";
	($c = mysql_query($ge)) or print mysql_error();
		
	mysql_close();
	?>