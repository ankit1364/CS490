<!DOCTYPE html>
<html>
	<head>
		<title>Student | Grades</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
		<link href="http://web.njit.edu/~asp82/490/front/styles.css" rel="stylesheet">
	</head>

<?php 
session_start();
echo $ucid= $_SESSION['ucid'];
echo $name= $_SESSION['student'];

if ($ucid != '')
{
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
					<li><a href='http://web.njit.edu/~asp82/490/front/student/quizes.php'>QUIZ</a></li>
					<li class='active'><a href='http://web.njit.edu/~asp82/490/front/student/grades.php'>GRADES</a></li>
					<li><a href='http://web.njit.edu/~asp82/490/front/logout.php'>LOGOUT</a></li>
								
				</ul>
															
			</div>
		
		</div>
	</div>
	
	<div class="container">
		
		<div class="jumbotron text-center">
		
		<form action="details.php" method="post" target="Details" onSubmit="return popWindow(this.target)">

		<?php
		
		$name= $_SESSION["name"];
		$ucid = $_SESSION['ucid'];

		$data    = array("ucid" => $ucid);
					
		$all_data = json_encode($data);

		
			$mr = 5; 
			$c = curl_init();
			//curl_setopt($c,CURLOPT_URL,"http://web.njit.edu/~aps64/cs490/back/getGrades.php");
			curl_setopt($c,CURLOPT_URL,"http://web.njit.edu/~kkp34/490/middle/getGrades.php");
			curl_setopt($c,CURLOPT_FOLLOWALLOCATION,$mr>0);
			curl_setopt($c,CURLOPT_RETURNTRANSFER,1);
			curl_setopt($c,CURLOPT_HEADER,0);
			curl_setopt($c,CURLOPT_POST, 1);
			curl_setopt($c,CURLOPT_POSTFIELDS,$all_data);
				
			$result=curl_exec($c);
		
			$grd = (json_decode($result));
			$quiznum = Sizeof($grd->grades); 
			
			 $quiznum;
			
			curl_close($c);		
			
			if($quiznum == 0)
				{
					echo "<h1> You do not have any graded Exams.</h1>";
					echo "<h3 align='center'> Please check later.</h3>";		
				
				}
				
                    
			else 
			{			
					echo "<h1> Grades </h1>";
					echo "<table align='center' class='table table-hover profquiz'>";
					echo "<thead>";
					echo "<tr>";
					echo "<th>Select</th>";
					echo "<th>Quiz</th>";
                    echo "<th>Score</th>";
					echo "<th>Out of</th>";
					echo "<th>Grade</th>";
                    echo "</tr>";
                    echo "</thead>";
				for($j=0; $j<$quiznum; $j++)
				{
					$quizName = $grd->grades[$j]->quizName;	
					$grades  = $grd->grades[$j]->grade;
					$quizId = $grd->grades[$j]->quizID;
					$status = $grd->grades[$j]->status;
					$urPts = $grd->grades[$j]->pointsEarned;
					$total = $grd->grades[$j]->totalPoints;
				                     
					//echo "<input id='quizID' name='quizId' type='hidden' value=$quizId >";
					echo "<input id='quizName' name='quizName' type='hidden' value=$quizName >";

					
					
					
                    echo "<tbody>";
                    echo "<tr>";
					if ($status == 'released')
					{					
						echo "<td><input type='radio' value=$quizId name='feedback'></td><td>".$quizName. "</td>";
						echo "<td>" .$urPts. "</td>";
						echo "<td>" .$total. "</td>";
						echo "<td>" .$grades. "</td>";
					}
					else
					{
						echo "<td><input type='radio' value=$quizId name='feedback' disabled></td><td>".$quizName. "</td>";
						echo "<td colspan='3'>*Grade not released</td>";
					}
					
					
                    echo "</tr>";
				}	
                    echo "</tbody>";
					
					
				echo "</table>";
				
				
				
				echo "<input type=submit class='btn btn-lg btn-primary' name='getdetails' value='Get Feedback' >"; 
				
			}
		echo "<br><p></p><h5>NOTE: You can only see the grades released by the Professor.</h5>";
		
	
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
		<?php } ?>
		
	</div>	
	
	<div class="navbar navbar-default navbar-fixed-bottom">
		
		<div class="container">
			
			<a class="navbar-btn btn-danger btn pull-right" href="#contact" data-toggle="modal">Contact US</a>
			<p class="navbar-text pull-right"><b>Designed by AKA</b></p>
		
		</div>
	</div>
	

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
	
	<script> 
		function popWindow(wName)
		{
			features = 'width=900, height=700, toolbar=no, location=no, directories=no, menubar=no, scrollbars=yes, copyhistory=no, resizable=yes';
			pop = window.open('', wName, features);
			if(pop.focus) {pop.focus();}
			return true;
		}
	
	</script>

</body>


</html>
