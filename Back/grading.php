<?php
    session_start();
	$_SESSION['ucid'];
	date_default_timezone_set("America/New_York");
  ?>

<!DOCTYPE html>
<head>
<link rel="stylesheet" type="text/css" href="http://web.njit.edu/~aps64/cs490/back/back.css">
<script type="text/javascript">

	function Redirect()
			{
			window.location='stuhome.php';
		}
	
					
</script>
</head>
  
    
  
<?php  
    include ("account.php") ;
	( $dbh = mysql_connect ( $hostname, $user, $pwd ) )
	        or    die ( "Unable to connect to MySQL database" );

	mysql_select_db( $project );
    
    $rcvd = file_get_contents('php://input');
    $rcv = json_decode($rcvd);
    
	$ucid = $rcv->rcv->ucid;    
    $quizID = $rcv->rcv->quizId;
	//$OEcheck = $rcv->FeedBack;
    //$OEpoints = $rcv->OpenEnded;
    $nMC = Sizeof($rcv->rcv->MCQ);
    $nTF = Sizeof($rcv->rcv->TFQ);
    $nOE = Sizeof($rcv->rcv->OEQ);
    $queNum = 1;
	
	
	$quiz="select * from quizes where id = $quizID";
	($z = mysql_query($quiz)) or print mysql_error();								 
	 $quname = mysql_fetch_array($z);
     $quizName = $quname['quizName'];  
    
    
	$userQuiz = $ucid."_".$quizName;

$add = "CREATE TABLE IF NOT EXISTS `aps64`.`$userQuiz`
								(`quizID` INT NOT NULL,
								`queNum` int(4) NOT NULL AUTO_INCREMENT,
								`queId` int(10),
								`type` varchar(2) NOT NULL,
								`category` varchar(255) NOT NULL,
								`qst` text NOT NULL,
								`opt1` varchar(300) NOT NULL,
								`opt2` varchar(300) NOT NULL,
								`opt3` varchar(300) NOT NULL,
								`opt4` varchar(300) NOT NULL,
								`opt5` varchar(300) NOT NULL,
								`ans` varchar(300) NOT NULL,
								`points` int NOT NULL,
								`exp` text NOT NULL,
								`urAns` varchar(300) NOT NULL,
								`urPoints` int NOT NULL, 
								 PRIMARY KEY (`queNum`))";  
 ($a = mysql_query($add)) or print mysql_error();								 
 
 $copyData = "INSERT INTO `$userQuiz`
					(quizID, queNum, queId, type, category, qst, opt1, opt2, opt3, opt4, opt5, ans, points, exp)
				select * FROM `$quizName`";
($b = mysql_query($copyData)) or print mysql_error();			
	
			
for ($i=0; $i<$nMC; $i++) {
        		
		$queMC = $rcv->rcv->queMC[$i];
        
        $urAns = $rcv->rcv->MCQ[$i];
		
        $mcAns = "update $userQuiz set urAns = '$urAns' WHERE queNum = $queNum";
		($c = mysql_query($mcAns)) or print mysql_error();
		
        
        $mcPts = "select * FROM `$userQuiz` WHERE queNum=$queNum";
		($d = mysql_query($mcPts)) or print mysql_error();
       
	   $ansPts = mysql_fetch_array($d);
		$queId = $ansPts['queId'];
        $pts = $ansPts['points'];  
		$ans = 	$ansPts['ans'];
		
		$get = "select * FROM mcq WHERE id=$queId";
		($z = mysql_query($get)) or print mysql_error();
		$got = mysql_fetch_array($z);
		$taken = $got['taken'];
		$correct = $got['correct'];
		$level = $got['level'];
		
		$taken = $taken+1;
				
		$cnt = "update mcq set taken=$taken WHERE id = $queId";
		($x = mysql_query($cnt)) or print mysql_error();
		
		if ($ans == $urAns)
		{
		$addPts = "update $userQuiz set urPoints = '$pts' WHERE queNum=$queNum";
		($e = mysql_query($addPts)) or print mysql_error();
		$correct = $correct+1;
		$cor = "update mcq set correct=$correct WHERE id = $queId";
		($y = mysql_query($cor)) or print mysql_error();
		
		}
        else
		{
		$addPts = "update $userQuiz set urPoints = 0 WHERE queNum= $queNum";
		($f = mysql_query($addPts)) or print mysql_error();
		}
		
		
		$dec = ($correct/$taken)*100;
		
		
			if ($dec<=50)
			{
			$diff = "update mcq set level='Hard' WHERE id = $queId";
			($u = mysql_query($diff)) or print mysql_error();
		
			}
			else if ($dec>50 && $dec<=75)
			{
			$diff = "update mcq set level='Medium' WHERE id = $queId";
			($u = mysql_query($diff)) or print mysql_error();
			}
			
			else
			{
			$diff = "update mcq set level='Easy' WHERE id = $queId";
			($u = mysql_query($diff)) or print mysql_error();
			}
		
		
		
      $queNum++;
    }
    
    for ($i=0; $i<$nTF; $i++) {
       
	   $queTF = $rcv->rcv->queTF[$i];
        
        $urAns = $rcv->rcv->TFQ[$i];
       
		
        $tfAns = "update $userQuiz set urAns = '$urAns' WHERE queNum = $queNum";
		($g = mysql_query($tfAns)) or print mysql_error();
		
        
        $tfPts = "select * FROM `$userQuiz` WHERE queNum=$queNum";
		($h = mysql_query($tfPts)) or print mysql_error();
        $ansPts = mysql_fetch_array($h);
		$queId = $ansPts['queId'];
        $pts = $ansPts['points'];  
		$ans = 	$ansPts['ans'];
		
		$get = "select * FROM truefalse WHERE id=$queId";
		($z = mysql_query($get)) or print mysql_error();
		$got = mysql_fetch_array($z);
		$taken = $got['taken'];
		$correct = $got['correct'];
		$level = $got['level'];
		
		$taken = $taken+1;
				
		$cnt = "update truefalse set taken=$taken WHERE id = $queId";
		($x = mysql_query($cnt)) or print mysql_error();
		
		if ($ans == $urAns)
		{
		$addPts = "update $userQuiz set urPoints = '$pts' WHERE queNum=$queNum";
		($j = mysql_query($addPts)) or print mysql_error();
		
		$correct = $correct+1;
		$cor = "update truefalse set correct=$correct WHERE id = $queId";
		($y = mysql_query($cor)) or print mysql_error();
		
		}
        else
		{
		$addPts = "update $userQuiz set urPoints = 0 WHERE queNum= $queNum";
		($k = mysql_query($addPts)) or print mysql_error();
		}
		
		$dec = ($correct/$taken)*100;
		
		
			if ($dec<=50)
			{
			$diff = "update truefalse set level='Hard' WHERE id = $queId";
			($u = mysql_query($diff)) or print mysql_error();
		
			}
			else if ($dec>50 && $dec<=75)
			{
			$diff = "update truefalse set level='Medium' WHERE id = $queId";
			($u = mysql_query($diff)) or print mysql_error();
			}
			
			else
			{
			$diff = "update truefalse set level='Easy' WHERE id = $queId";
			($u = mysql_query($diff)) or print mysql_error();
			}
		
		
		
        
      $queNum++;  
    }
	
	for ($i=0; $i<$nOE; $i++) {
       
	   $queOE = $rcv->rcv->queOE[$i];
        
        $urAns = $rcv->answer[$i];
       
		
        $oeAns = "update $userQuiz set urAns = '$urAns' WHERE queNum = $queNum";
		($j = mysql_query($oeAns)) or print mysql_error();
		
        
        $oePts = "select * FROM `$userQuiz` WHERE queNum=$queNum";
		($k = mysql_query($oePts)) or print mysql_error();
        $ansPts = mysql_fetch_array($k);
		$queId = $ansPts['queId'];
        $pts = $ansPts['points'];  
		$ans = 	$ansPts['ans'];
		
		$get = "select * FROM openEnded WHERE id=$queId";
		($z = mysql_query($get)) or print mysql_error();
		$got = mysql_fetch_array($z);
		$taken = $got['taken'];
		$correct = $got['correct'];
		$level = $got['level'];
		
		$taken = $taken+1;
				
		$cnt = "update openEnded set taken=$taken WHERE id = $queId";
		($x = mysql_query($cnt)) or print mysql_error();
		
		if ($ans == $urAns)
		{
		$addPts = "update $userQuiz set urPoints = '$pts' WHERE queNum=$queNum";
		($j = mysql_query($addPts)) or print mysql_error();
		
		$correct = $correct+1;
		$cor = "update openEnded set correct=$correct WHERE id = $queId";
		($y = mysql_query($cor)) or print mysql_error();
		
		}
        else if ($urans == 'error')
		{
		$addPts = "update $userQuiz set urPoints = 0 WHERE queNum= $queNum";
		($k = mysql_query($addPts)) or print mysql_error();
		}
		
		else
		{
		$pt = 0.30*$pts;
		$addPts = "update $userQuiz set urPoints = $pts WHERE queNum= $queNum";
		($k = mysql_query($addPts)) or print mysql_error();
		}
		
		$dec = ($correct/$taken)*100;
		
		
			if ($dec<=50)
			{
			$diff = "update openEnded set level='Hard' WHERE id = $queId";
			($u = mysql_query($diff)) or print mysql_error();
		
			}
			else if ($dec>50 && $dec<=75)
			{
			$diff = "update openEnded set level='Medium' WHERE id = $queId";
			($u = mysql_query($diff)) or print mysql_error();
			}
			
			else
			{
			$diff = "update openEnded set level='Easy' WHERE id = $queId";
			($u = mysql_query($diff)) or print mysql_error();
			}
		
		
		
        
      $queNum++;  
    }
	
	
	   
    $result = "select SUM(urPoints), SUM(points) FROM $userQuiz"; 
    ($l = mysql_query($result)) or print mysql_error();
	
	$getPts = mysql_fetch_array($l); 
	
    $yourPts = $getPts['SUM(urPoints)'];
    
	$totalPts = $getPts['SUM(points)'];
 
    //echo "Total Pts ".$totalPts." Pts Received ".$yourPts;

    $grd = (($yourPts / $totalPts)*100);
    
	$Grade = round($grd,2);
     
	$insertGrade = "insert INTO Grades (ucid, quizID, quizName, pointsEarned, totalPoints, grade, status) 
					VALUES ('$ucid', $quizID, '$quizName', $yourPts, $totalPts, $Grade, 'Unreleased')";
	
	($k = mysql_query($insertGrade)) or print mysql_error(); 
	?>
	
	<script>
	document.write("<span class='dot'><h1>Your Quiz has been submitted for Grading....</h1></span><div class='im'><img src='http://www.ppimusic.ie/images/loading_anim.gif'/></div>");
	setTimeout('Redirect()', 2000);
			
</script>
<?php 
mysql_close();
?>
