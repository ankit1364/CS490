<!DOCTYPE html>
<html>
	<head>
		<title>Student | Quizes</title>
		<meta name="robots" content="NOODP"/>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
		<link href="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.0-rc2/css/bootstrap.css" rel="stylesheet" media="screen">
		<link href="http://web.njit.edu/~asp82/490/front/styles.css" rel="stylesheet">
	</head>
<?php 
session_start();
//echo "takequiz";
$ucid = $_SESSION['ucid'];
$name = $_SESSION['student'];
if($ucid != '')
{
if(isset($_POST['submitans']))
	{
		
		//echo "hi";
		 $quizName = $_POST['quizName'];
		 $qnum  = $_POST["queNum"]; 
		 $MCQ= $_POST["MCQ"];
		 $TFQ = $_POST["TFQ"];
		  $OEQ = $_POST["OEQ"];
		 $queMC= $_POST["queMC"];
		
		$queTF= $_POST["queTF"];
		 $queOE= $_POST["queOE"];
		 $quizName = $_POST['quizName'];
		 $queNum=$_POST['queNum'];
		 
		 
		 $quizId= $_POST['quizId'];
		 $send = quizans;
		
		//echo $qnum;
		 $ucid= $_SESSION['ucid'];
		//echo "hi";
		
	
		 //"ucid at takequiz form ".$ucid;
		
		$data    = array("quizId" => $quizId, "queTF"=> $queTF, "queOE"=> $queOE, "queMC"=> $queMC, "ucid" => $ucid, "quizName" => $quizName, "MCQ" => $MCQ, "TFQ" => $TFQ, "OEQ" => $OEQ,);
					
		echo $all_data = json_encode($data);	
		exit();

		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,"http://web.njit.edu/~kkp34/490/middle/grading.php");
		//curl_setopt($ch,CURLOPT_URL,"http://web.njit.edu/~aps64/cs490/back/grading.php");
		curl_setopt($ch,CURLOPT_POST, 1);
		curl_setopt($ch,CURLOPT_POSTFIELDS,$all_data);
		curl_setopt($ch,CURLOPT_FOLLOWLOCATION, 1);

curl_exec($ch);
curl_close($ch);
exit();
	}

else {

		$id  = $_POST["id"]; 
		$name= $_POST["name"];
		$ucid = $_SESSION['ucid'];
		$send = "quizlist";
		//"ucid at quizes form".$ucid;
		
		$data    = array("send"=> $send, "id" => $id, "quizName" => $name, "ucid" => $ucid);
					
		$all_data = json_encode($data);

		$mr = 5;
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,"http://web.njit.edu/~aps64/cs490/back/sendquiz.php");
		curl_setopt($ch,CURLOPT_FOLLOWALLOCATION,$mr>0);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch,CURLOPT_HEADER,0);
		curl_setopt($ch,CURLOPT_POST, 1);
		curl_setopt($ch,CURLOPT_POSTFIELDS,$all_data);
		$result=curl_exec($ch);

                //$rqst = file_get_contents('php://input');
               
				$quiz = (json_decode($result));                
				$cnt = $quiz->cnt;
                $quizName = $quiz->quizName;      
				$quizId= $quiz->quizId;
				//$ucid = $quiz->ucid;
				//$_SESSION['ucid'] = $ucid;
					
		curl_close($ch);
				
				
		if ($cnt!= '0')
		{
		print "<script type='text/javascript'>
		alert('You already have taken this quiz!');
		window.location='quizes.php'</script>";
		}		
		else{
					
?>

	<body>
	<div class="navbar navbar-inverse navbar-static-top">
		<div class="container">
		
			<div class="navbar-header">
				<a class="navbar-brand" href="http://web.njit.edu/~asp82/490/front/student/stuhome.php">Python Online Exam Center</a>
			
				<button class= "navbar-toggle" data-toggle = "collapse" data-target=".navHeaderCollapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				</button>
			</div>	
			
			<div class="collapse navbar-collapse navHeaderCollapse">
			
				<ul class="nav navbar-nav navbar-right">
					<li class='off'><a href='http://web.njit.edu/~asp82/490/front/student/fetchquiz.php'>QUIZ</a></li>
					<li class='off'><a href='http://web.njit.edu/~asp82/490/front/student/fetchgrades.php'>GRADES</a></li>
					<li class='off'><a href='http://web.njit.edu/~asp82/490/front/logout.php'>LOGOUT</a></li>
								
				</ul>
															
			</div>
		
		</div>
	</div>
	
	<div class="container">
		
		<div class="jumbotron text-center">
		
     <form action="takequiz.php" method="post">
                    <?php
					echo "<input id='quizID' name='quizId' type='hidden' value=$quizId >";
					echo "<input id='quizName' name='quizName' type='hidden' value=$quizName >";
					echo "<h2>" .$quizName. "</h2>";
					echo "<table id='quiz'>";
					echo "<thead><tr><td></td></tr></thead>";
					echo "<tbody>";
					
                     $NumMC = Sizeof($quiz->MCQ);
							
					
					for($i=0; $i<$NumMC; $i++)
						{
                            $qnum = $quiz->MCQ[$i]->queNum;
                            $que  = $quiz->MCQ[$i]->qst;
                            $opt1 = $quiz->MCQ[$i]->opt1;
                            $opt2 = $quiz->MCQ[$i]->opt2;
                            $opt3 = $quiz->MCQ[$i]->opt3;
                            $opt4 = $quiz->MCQ[$i]->opt4;
							$opt5 = $quiz->MCQ[$i]->opt5;
				
				
				 echo "<input name='queMC[]' type='hidden' value=$qnum >";
				
                echo "<tr><td>";
                		
				echo "<table class='table table-hover'>";
					echo"<tr>";
					echo"<td align='left'><b>"    .$qnum. "." .$que. "</b></td>";
					echo "</tr>";
                
					echo "<tr>";
					echo "<td align='left'><input name='MCQ[]' type='checkbox' value=$opt1> <label class='options'>A. </label> " .$opt1. "</td>";
					echo "</tr>";
				
					echo "<tr>";
					echo "<td align='left'> <input name='MCQ[]' type='checkbox' value=$opt2> <label class='options'>B. </label> " .$opt2. "</td>";
					echo "</tr>";
				
					echo "<tr>";
					echo "<td align='left'> <input name='MCQ[]' type='checkbox' value=$opt3> <label class='options'>C. </label> " .$opt3. "</td>";
					echo "</tr>";
				
					echo "<tr>";
					echo "<td align='left'> <input name='MCQ[]' type='checkbox' value=$opt4> <label class='options'>D. </label> " .$opt4. "</td>";
					echo "</tr>";
				
				
				
					if ($opt5 != '')
					{
					echo "<tr>";
					echo "<td align='left'> <input name='MCQ[]' type='checkbox' value=$opt5> <label class='options'>E. </label> " .$opt5. "</td>";
					echo "</tr>";
					}
				echo "</table>";
				
				echo "</td></tr>";	
               } 
			   
					$NumTF = Sizeof($quiz->TFQ); 
						//echo "num of True and false:";
						//echo $NumTF;
                     
					for($j=0; $j<$NumTF; $j++)
						{
                             $qnum = $quiz->TFQ[$j]->queNum;
							 $que  = $quiz->TFQ[$j]->qst;
                             $opt1 = $quiz->TFQ[$j]->opt1;
                             $opt2 = $quiz->TFQ[$j]->opt2;
							 
					//echo "<tr> <td> <input name='queTF[]' type='checkbox' value='$qnum checked hidden></td></tr>";
						
						echo "<input name='queTF[]' type='hidden' value=$qnum />";
					 
                    echo "<tr><td>";
									
					echo "<table class='table table-hover'>";
						echo"<tr>";
						echo"<td align='left'><b>"    .$qnum. "." .$que. "</b></td>";
						echo "</tr>";
                
						echo "<tr>";
						echo "<td align='left'> <input name='TFQ[]' type='checkbox' value='True'>" .$opt1. "</td>";
						echo "</tr>";
					
						echo "<tr>";
						echo "<td align='left'> <input name='TFQ[]' type='checkbox' value='False'>" .$opt2. "</td>";
						echo "</tr>";
					echo "</table>";
					
					
					echo "</td></tr>";
					}
			 
					$NumOE = Sizeof($quiz->OEQ);
												//echo "Number of Open Ended:";
					//echo $NumOE;
					for($k=0; $k<$NumOE; $k++) 
					{
                            $que  = $quiz->OEQ[$k]->qst;
                            $qnum  = $quiz->OEQ[$k]->queNum;
                 
				//	echo "<tr> <td> <input name='queOE[]' type='checkbox' value=$qnum checked hidden></td></tr>";
				
					echo "<input name='queOE[]' type='hidden' value=$qnum >";
					
                    echo "<tr>";
                    				
					echo "<table class='table table-hover'>";
						echo"<tr>";
						echo"<td><b>"    .$qnum. "." .$que. "</b></td>";
						echo "</tr>";
						
						echo "</tr>";
						echo "<td><textarea name='OEQ[]' value='opt1' style='width:600px; min-height: 300px placeholder='Enter your answer here'></textarea></td>";
						echo "</tr>";
					
					
					echo "</table>";
					
					echo "</tr>";
					}
					?>
				     		
			</tbody>
			</table>
				 <input type="submit" class="btn btn-success" id="submitans" name="submitans" value="SUBMIT QUIZ">
			</form>
		</div>
</div>
<?php 

}}
}

else
{?>
			
			<div class="navbar navbar-inverse navbar-static-top">
				<div class="container">
		
					<div class="navbar-header">
					<a class="navbar-brand" href="http://web.njit.edu/~asp82/490/front/newlogin.php">Python Online Exam Center</a>
							
					</div>	
				</div>
			</div>
	
			<div class="container">
		
				<div class="jumbotron text-center">
					<br> <br>
					<h1>You are not Logged in. </h1>
					<br> <br>
					<a class="btn btn-lg btn-primary"href="http://web.njit.edu/~asp82/490/front/newlogin.php">Sign In</a>
				</div>
			</div>
		</div>
		<?php 
	} 
include 'footer.php';	
?>

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
			
	<script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.10.2.min.js"></script>
	<script type="text/javascript" language="javascript" src="//cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" language="javascript" src="//cdn.datatables.net/plug-ins/9dcbecd42ad/integration/bootstrap/3/dataTables.bootstrap.js"></script>
		
	<script type="text/javascript" charset="utf8">
		$(document).ready(function(){
			$('#quiz').dataTable({bFilter:false,bSortable:false, aLengthMenu: [[1, 2, 5, 10, 15, -1, "All"], [1, 2, 5, 10, 15, "All"]],
			dom: '<"top"lp>rt<"bottom"i><"clear">',}
			);
		});
		
		$('#quiz')
			.addClass('table table-hover');

	</script> 
 </body>
 </html>