<?php
    session_start();
	$_session['ucid'] = $ucid;
	$_session['name'] = $name;

  include ("account.php") ;
( $dbh = mysql_connect ( $hostname, $user, $pwd ) )
	        or    die ( "Unable to connect to MySQL database. <br>".mysql_error() );
mysql_select_db( $project ); 

	$error=array();

    $rcvd = file_get_contents('php://input');
    $rcv = json_decode($rcvd);
	    
    $qst = $rcv->qst;
	$qst = mysql_real_escape_string($qst);
	
    $opt1 = $rcv->opt1;
	$opt1 = mysql_real_escape_string($opt1);
	
    $opt2 = $rcv->opt2;
	$opt2 = mysql_real_escape_string($opt2);
    
	$opt3 = $rcv->opt3;
	$opt3 = mysql_real_escape_string($opt3);
	
    $opt4 = $rcv->opt4;
	$opt4 = mysql_real_escape_string($opt4);
	
	$opt5 = $rcv->opt5;
	$opt5 = mysql_real_escape_string($opt5);
	
    $ans = $rcv->ans;
	$ans = mysql_real_escape_string($ans);
	
	$exp = $rcv->exp;
	$exp = mysql_real_escape_string($exp);
	
    $level = $rcv->level;
	$points = $rcv->points;
	$type = $rcv->type;
	$category = $rcv->category;
	//echo "session at addqst back";
	//echo $ucid = $rec->ucid;
	//echo $name = $rec->name;
	        
    if ($type == 'MC') 
	{
       if ($ans == 'A') {
            $answer = $opt1;
       }
       if ($ans == 'B') {
            $answer = $opt2;
       }
       if ($ans == 'C') {
            $answer= $opt3;
       }
       if ($ans == 'D') {
            $answer = $opt4;
       }
	   if ($ans == 'E') {
            $answer = $opt5;
       }
	   
       $mc = "INSERT INTO mcq (category, qst, opt1, opt2, opt3, opt4, opt5, ans, exp, level, points) VALUES ('$category', '$qst', '$opt1', '$opt2', '$opt3', '$opt4', '$opt5', '$answer', '$exp', '$level', $points)";
       ($t = mysql_query($mc)) or (array_push($error,mysql_error()));
	   
	}
 
   else if ($type == 'TF') 
	{
		 if ($ans == 'opt1') 
		{
            $answer = 'True';
		}
       if ($ans == 'opt2') 
		{
            $answer = 'False';
		}

	 $tf = "INSERT INTO truefalse (category, qst, ans, exp, level, points) VALUES ('$category', '$qst','$answer', '$exp', '$level', $points)";
        ($t1 = mysql_query($tf)) or (array_push($error,mysql_error()));
		
    }
	else if ($type == 'OE')
	{
        //echo 'OE';
        $open = "INSERT INTO openEnded (category, qst, ans, exp, level, points) VALUES ('$category', '$qst', '$ans', '$exp', '$level', $points)";
        ($t2 = mysql_query($open)) or (array_push($error,mysql_error()));
	}   
	mysql_close();
	
?>
	