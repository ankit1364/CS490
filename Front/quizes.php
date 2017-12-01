<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Student | Quizes</title>
		<meta name="robots" content="NOODP"/>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
		<link href="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.0-rc2/css/bootstrap.css" rel="stylesheet" media="screen">
		<link href="http://web.njit.edu/~asp82/490/front/styles.css" rel="stylesheet">
	<style> 
	tr
	{
	text-align:left;
	}
	</style>
	
	</head>

<?php 
date_default_timezone_set("America/New_York");
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
					<li class='active'><a href='http://web.njit.edu/~asp82/490/front/student/quizes.php'>QUIZ</a></li>
					<li><a href='http://web.njit.edu/~asp82/490/front/student/grades.php'>GRADES</a></li>
					<li><a href='http://web.njit.edu/~asp82/490/front/logout.php'>LOGOUT</a></li>
								
				</ul>
															
			</div>
		
		</div>
	</div>
	
	<div class="container">
		
		<div class="jumbotron text-center">
		
		<form action="takequiz.php" method="post">
				
			<h2>List of Quizes</h2>
		
                                    
					<?php
						
						$ch = curl_init();
						curl_setopt($ch,CURLOPT_URL,"http://web.njit.edu/~kkp34/490/middle/fetchquiz.php");
						//curl_setopt($ch,CURLOPT_URL,"http://web.njit.edu/~aps64/cs490/back/fetchquiz.php");
						curl_setopt($ch,CURLOPT_FOLLOWALLOCATION,$mr>0);
						curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
						curl_setopt($ch,CURLOPT_HEADER,0);
						curl_setopt($ch,CURLOPT_POST, 1);
						curl_setopt($ch,CURLOPT_POSTFIELDS,$all_data);

						$result=curl_exec($ch);
						$a = (json_decode($result));
																
																			
                        $numquiz = Sizeof($a->quizes);
                        $numAvailable = Sizeof($a->available);
                        $numEnded = Sizeof($a->ended);
                        $numNotStarted = Sizeof($a->notStarted);
						
						curl_close($ch);
			
					echo date('Y-m-d');
					echo "<table id='list'>";
					echo "<thead>";
                	echo "<tr>";
						echo "<th>Select </th>";
						echo "<th>Quiz Name</th>";
						echo "<th>Start Date</th>";
						echo "<th>End Date</th>";
						echo "<th>Created By</th>";
						echo "<th>Status</th>";
					echo "</tr>";
					echo "</thead>";
					echo "<tbody>";
						
						for($i=0; $i<$numAvailable; $i++) 
						{
							$id   = $a-> available[$i]->id;
                            $name = $a->available[$i]->quizName;
							$sdate= $a->available[$i]->startDate;
							$edate= $a->available[$i]->endDate;
							$prof= $a->available[$i]->profName;
							
					echo "<tr>";
						echo "<td><input type='radio' name='id' value=$id required ></td>";
						echo "<td>". $name ."</td>";
						echo "<td>". $sdate."</td>";
						echo "<td>". $edate."</td>";
						echo "<td>". $prof."</td>";
						echo "<td> Available</td>";
						
                    echo "</tr>";
					}
						
						for($i=0; $i<$numNotStarted; $i++) 
						{
							$id   = $a-> notStarted[$i]->id;
                            $name = $a->notStarted[$i]->quizName;
							$sdate= $a->notStarted[$i]->startDate;
							$edate= $a->notStarted[$i]->endDate;
							$prof= $a->notStarted[$i]->profName;
							
							
					echo "<tr>";
						echo "<td><input type='radio' name='id' value=$id disabled></td>";
						echo "<td>". $name ."</td>";
						echo "<td>". $sdate."</td>";
						echo "<td>". $edate."</td>";
						echo "<td>". $prof."</td>";
						echo "<td> Not Started</td>";
                    echo "</tr>";
					}
					
					for($i=0; $i<$numEnded; $i++) 
						{
							$id   = $a-> ended[$i]->id;
                            $name = $a-> ended[$i]->quizName;
							$sdate= $a-> ended[$i]->startDate;
							$edate= $a-> ended[$i]->endDate;
							$prof= $a-> ended[$i]->profName;
							
					echo "<tr>";
						echo "<td><input type='radio' name='id' value=$id disabled></td>";
						echo "<td>". $name ."</td>";
						echo "<td>". $sdate."</td>";
						echo "<td>". $edate."</td>";
						echo "<td>". $prof."</td>";
						echo "<td> Ended</td>";
                    echo "</tr>";
					}
				echo "</tbody>";
				echo "</table>";
			
					 ?>
                
                <p>
				
                <input type="submit" class="btn btn-lg btn-success" name="takequiz" value="Take Quiz" ="center">
		</form>
		
	</div>
</div>
		
		
		
<?php		
	//}
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
		<?php }include 'footer.php' ?>
		
	</div>	
	
		
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>	
	<script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.10.2.min.js"></script>
	<script type="text/javascript" language="javascript" src="//cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" language="javascript" src="//cdn.datatables.net/plug-ins/9dcbecd42ad/integration/bootstrap/3/dataTables.bootstrap.js"></script>
	
		<script type="text/javascript" charset="utf8">
		$(document).ready(function(){
			$('#list').dataTable({bFilter:false, aLengthMenu: [[5, 10, 15, 20, -1, "All"], [5, 10, 15, 20, "All"]],
			language: {
            lengthMenu:"Display _MENU_ Quizes per page",
            info: "Showing Page _PAGE_ of _PAGES_",
            infoEmpty:"No records available",
                }		
			}
			);
		});
		
		$('#list')
			.addClass('table table-hover');
</script>	

</body>


</html>
