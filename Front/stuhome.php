<!DOCTYPE html>
<html>
	<head>
		<title>Student | Home</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
		<link href="http://web.njit.edu/~asp82/490/front/styles.css" rel="stylesheet">
	</head>

<?php 
session_start();
$ucid= $_SESSION['ucid'];
$name = $_SESSION['student'];
echo $ucid;
echo $name;
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
					<li class='off'><a href='http://web.njit.edu/~asp82/490/front/student/quizes.php'>QUIZ</a></li>
					<li class='off'><a href='http://web.njit.edu/~asp82/490/front/student/grades.php'>GRADES</a></li>
					<li class='off'><a href='http://web.njit.edu/~asp82/490/front/logout.php'>LOGOUT</a></li>
								
				</ul>
															
			</div>
		
		</div>
	</div>
	
	<div class="container">
		
		<div class="jumbotron text-center">
		<?php
					
	//$ucid = $_SESSION['ucid'];
	//$name = $_SESSION['student'];
		//$rcvd = file_get_contents('php://input');
		//$rec = json_decode($rcvd);
		//$name = $rec->name;
		
		echo "<h1>Hello!!<br>" .$name."</h1>";
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
	<script src= "js/bootstrap.js"></script>

</body>


</html>
