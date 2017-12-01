<!DOCTYPE html>
<html>
	<head>
		<title>CS490</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
		<link href="http://web.njit.edu/~asp82/490/front/styles.css" rel="stylesheet">
	</head>
<?php 
session_start();
$ucid = $_SESSION['ucid'];
$name = $_SESSION['prof'];
echo $ucid;
echo $name;
If ($ucid != '')
			{
?>

	<body>
	<div class="navbar navbar-inverse navbar-static-top">
		<div class="container">
		
			<div class="navbar-header">
				<a class="navbar-brand" href="http://web.njit.edu/~asp82/490/front/prof/professor.php">Python Online Exam Center</a>
			
				<button class= "navbar-toggle" data-toggle = "collapse" data-target=".navHeaderCollapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				</button>
			</div>	
			
			<div class="collapse navbar-collapse navHeaderCollapse">
			
				<ul class="nav navbar-nav navbar-right">
					<li> <a href="http://web.njit.edu/~asp82/490/front/prof/addqst.php"> Add Questions </a></li> 
					<li> <a href="http://web.njit.edu/~asp82/490/front/quiz/quiz.php"> Add Quiz </a></li>
					<li> <a href="http://web.njit.edu/~asp82/490/front/prof/release.php"> Release Grades </a></li>
					<li> <a href="http://web.njit.edu/~asp82/490/front/prof/endquiz.php"> End Quiz </a></li>
					<li> <a href="http://web.njit.edu/~asp82/490/front/logout.php"> Sign Out </a></li>
								
				</ul>
															
			</div>
		
		</div>
	</div>
	
	<div class="container">
		
		<div class="jumbotron text-center">
		<?php
			 
		//$rcvd = file_get_contents('php://input');
		//$rec = json_decode($rcvd);
						
				echo "<h1>Hello Professor ".$name."</h1>";
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
			<?php
			}	

		?>
		
		</div>
		
	</div>	
	
	<div class="navbar navbar-default navbar-fixed-bottom">
		
		<div class="container">
			
			<a class="navbar-btn btn-danger btn pull-right" href="#contact" data-toggle="modal">Contact US</a>
			<p class="navbar-text pull-right"><b>Designed by AKA</b></p>
		
		</div>
	</div>
	

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>

</body>


</html>
