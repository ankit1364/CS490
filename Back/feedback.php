<?php
    session_start();
	$_SESSION['ucid'];
	
	include ("account.php") ;
	( $dbh = mysql_connect ( $hostname, $user, $pwd ) )
	        or    die ( "Unable to connect to MySQL database. <br>".mysql_error() );
	mysql_select_db( $project ); 

    
    $rcvd = file_get_contents('php://input');
    $rcv = json_decode($rcvd);
      
	$quizId = $rcv->id;
	$ucid = $rcv->ucid;
	$quizName = $rcv->quizName;
	//echo "ucid at sendquiz".$ucid;
	
	$userQuiz = $ucid."_".$quizName;
	
	
	$MCQ = array();
    $TFQ = array();
    $OEQ = array();
	
    $MC = "SELECT * FROM $userQuiz WHERE type = 'MC'";
	($a = mysql_query($MC)) or print mysql_error();
	 while ($fetchMC = mysql_fetch_array($a)) 
	 {   $MCQ[] = $fetchMC;  }
	
	$TF = "SELECT * FROM $userQuiz WHERE type = 'TF'";
	($b = mysql_query($TF)) or print mysql_error();
	while ($fetchTF = mysql_fetch_array($b)) 
	 {   $TFQ[] = $fetchTF;  }
		
    $OE = "SELECT * FROM $userQuiz WHERE type = 'OE'";
	($c = mysql_query($OE)) or print mysql_error();
    while ($fetchOE = mysql_fetch_array($c)) 
	 {   $OEQ[] = $fetchOE;  }
    
    
    
    echo json_encode(array('quizId'=> $quizId, 'quizName' => $quizName, 'MCQ' => $MCQ, 'TFQ' => $TFQ, 'OEQ' => $OEQ, 'ucid' => $ucid));
    
	/*	$all = "SELECT * FROM $userQuiz";
	($x = mysql_query($name)) or print mysql_error();
	$feedback = Array();
	while ($fetch = mysql_fetch_array($x)) 
	$feedback[] = $fetch;  */
		     
    //$q = json_encode(array('feedback'=> $feedback, 'ucid' => $ucid));
    //echo $Quiz;
        
     
?>