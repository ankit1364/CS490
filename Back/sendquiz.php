<?php
    session_start();
	$_SESSION['ucid'];
	$_SESSION['student'];
	
	include ("account.php") ;
	( $dbh = mysql_connect ( $hostname, $user, $pwd ) )
	        or    die ( "Unable to connect to MySQL database. <br>".mysql_error() );
	mysql_select_db( $project ); 

    
    $rcvd = file_get_contents('php://input');
    $rcv = json_decode($rcvd);
      
	$quizId = $rcv->id;
	$ucid = $rcv->ucid;
		
	$check="SELECT * FROM Grades WHERE quizID = $quizId and ucid='$ucid'";
	($z = mysql_query($check)) or print mysql_error();
	$count=0;
	
	
	if (mysql_num_rows($z))
	{
	$count++;
	}
	
	
	else
	{
	$name = "SELECT quizName FROM quizes WHERE id = $quizId";
	($x = mysql_query($name)) or print mysql_error();
	$fetchName = mysql_fetch_array($x);
	$quizName = $fetchName['quizName'];
	
	$MCQ = array();
    $TFQ = array();
    $OEQ = array();
	
    $MC = "SELECT * FROM $quizName WHERE type = 'MC'";
	($a = mysql_query($MC)) or print mysql_error();
	 while ($fetchMC = mysql_fetch_array($a)) 
	 {   $MCQ[] = $fetchMC;  }
	
	$TF = "SELECT queNum, qst, opt1, opt2 FROM $quizName WHERE type = 'TF'";
	($b = mysql_query($TF)) or print mysql_error();
	while ($fetchTF = mysql_fetch_array($b)) 
	 {   $TFQ[] = $fetchTF;  }
		
    $OE = "SELECT queNum,qst FROM $quizName WHERE type = 'OE'";
	($c = mysql_query($OE)) or print mysql_error();
    while ($fetchOE = mysql_fetch_array($c)) 
	 {   $OEQ[] = $fetchOE;  }
    

    
}        
    echo json_encode(array('cnt'=>$count, 'quizId'=> $quizId, 'quizName' => $quizName, 'MCQ' => $MCQ, 'TFQ' => $TFQ, 'OEQ' => $OEQ, 'ucid' => $ucid));
    
   /* $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://web.njit.edu/~asp82/490/front/student/takequiz.php");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $q);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_exec($ch);
    curl_close($ch); 
}*/	
?>