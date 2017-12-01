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
			window.location='http://web.njit.edu/~asp82/490/front/prof/professor.php';
		}
	
					
</script>
</head>
<?php
                     
 include ("account.php") ;
( $dbh = mysql_connect ( $hostname, $user, $pwd ) )
	        or    die ( "Unable to connect to MySQL database. <br>".mysql_error() );
mysql_select_db( $project ); 

    
    $rcvd = file_get_contents('php://input');
    $rcv = json_decode($rcvd);
	
	$quizName = $rcv->quiznm;
	
	$quizName = mysql_real_escape_string($quizName);
	
	$start = $rcv->sdt;
   	
	$end = $rcv->edt;
   	
	$nmc = Sizeof($rcv->cbmc);
   	
	$ntf = Sizeof($rcv->cbtf);
   	
	$noe = Sizeof($rcv->cboe);
   	
	$mcpnt	= $rcv->mcpnt;
	
	$tfpnt = $rcv->tfpnt;
		
	$oepnt = $rcv->oepnt;
	$ucid = $rcv->ucid;
	
	
	
    
	 $sql = "select * from login where ucid='$ucid'";
	($u = mysql_query($sql)) or print mysql_error();
    $fetchName = mysql_fetch_array($u);
	$name = $fetchName['name'];
	
    
    $quiz= "insert into quizes (quizName, startDate, endDate, profucid, profName, createDate, status) values ('$quizName', '$start', '$end', '$ucid', '$name', CURDATE(),'unreleased')";
    ($a = mysql_query($quiz)) or print mysql_error();
    
    
    $q = "select * from quizes where quizName='$quizName'";
	($b = mysql_query($q)) or print mysql_error();
    $fetch = mysql_fetch_array($b);
	$id = $fetch['id'];
	
	
	$createQuiz= "CREATE TABLE IF NOT EXISTS `aps64`.`$quizName` (
																`quizID` INT NOT NULL,
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
																 PRIMARY KEY (`queNum`))";
    ($c = mysql_query($createQuiz)) or print mysql_error();
 
    //MULTIPLE CHOICE";
    for ($i=0; $i<$nmc; $i++)
	{
        $type = "MC";  
		$qstNum = $rcv->cbmc[$i];
        $queryMCQ = "SELECT * FROM mcq WHERE id=$qstNum";
        ($c = mysql_query($queryMCQ)) or print mysql_error();
		
		$mc = mysql_fetch_array($c);
		$queId = $mc['id'];      
		$category = $mc['category'];      
        $qst = $mc['qst'];
        $opt1 = $mc['opt1'];
        $opt2 = $mc['opt2'];
        $opt3 = $mc['opt3'];
        $opt4 = $mc['opt4'];
        $opt5 = $mc['opt5'];
		$ans = $mc['ans'];
		$exp = $mc['exp'];
        // echo "<br>MCQ<br>";
        // echo "MCQ:".$qst." <br>".$opt1."<br> ".$opt2."<br>".$opt3."<br> ".$opt4."<br> ".$opt5." <br>".$ans." <br>".$mcpnt."<br>";
        $insertMCQ = "INSERT INTO $quizName (quizID, queId, type, category, qst, opt1, opt2, opt3, opt4, opt5, ans, points, exp) 
							VALUES ($id, $queId, '$type', '$category', '$qst', '$opt1', '$opt2', '$opt3', '$opt4', '$opt5', '$ans', $mcpnt, '$exp')";
       ($d = mysql_query($insertMCQ)) or print mysql_error();
    } 
              
    // echo "TRUE FALSE";
    for ($i=0; $i<$ntf; $i++) {
		  $type = "TF";   
		$qstNum = $rcv->cbtf[$i];
        $queryTF = "SELECT * FROM truefalse WHERE id=$qstNum";
        ($d = mysql_query($queryTF)) or print mysql_error();
		
		$tf = mysql_fetch_array($d);
		$queId = $tf['id'];   
		$category = $tf['category'];   
		$qst = $tf['qst'];
		$ans = $tf['ans'];
		$exp = $tf['exp'];
        $opt1 = "True";
        $opt2 = "False";
        
        // echo "<br>True/False<br>";
        // echo $qst." ".$opt1." ".$opt2." ".$ans;
        $insertTF = "INSERT INTO $quizName (quizID, queId, type, category, qst, opt1, opt2, ans, points, exp) VALUES ($id, $queId, '$type', '$category', '$qst', '$opt1', '$opt2', '$ans', $tfpnt, '$exp')";
        ($e = mysql_query($insertTF)) or print mysql_error();
    }
    
    // echo "OPEN-ENDED";
    for ($i=0; $i<$noe; $i++) {
        $qstNum = $rcv->cboe[$i];
        $type = "OE";   
        $queryOE = "SELECT * FROM openEnded WHERE id=$qstNum";
        ($f = mysql_query($queryOE)) or print mysql_error();
		
		$oe = mysql_fetch_array($f);
		$queId = $oe['id'];   
		$category = $oe['category'];   
        $qst = $oe['qst'];
        $ans = $oe['ans'];
        $exp = $oe['exp'];
        // echo "<br>Open Ended<br>";
		// echo $qst." : ".$ans;
        
        $insertOE = "INSERT INTO $quizName (quizID, queId, type, category, qst, ans, points, exp) 
						VALUES ($id, $queId, '$type', '$category', '$qst', '$ans', $oepnt, '$exp')";
        ($g = mysql_query($insertOE)) or print mysql_error();
    }
  ?>
 <script>
	document.write("<span class='dot'><h1>Quiz Added!! Redirecting....</h1></span><div class='im'><img src='http://www.ppimusic.ie/images/loading_anim.gif'/></div>");
	setTimeout('Redirect()', 2000);
			
</script>
<?php 
mysql_close();
?>