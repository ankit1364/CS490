<!DOCTYPE html>
<?php 
session_start();
 $ucid = $_SESSION['ucid'];

if ($ucid != '')
{
$ucid = $_SESSION['ucid'];
$send = "retreiveGrades";
//echo "fetchquiz at front ucid:".$ucid;

$n = json_encode (array ('ucid' => $ucid,'send' => $send));
 
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,"http://web.njit.edu/~kkp34/490/middle/quizList.php");
//curl_setopt($ch,CURLOPT_URL,"http://web.njit.edu/~aps64/cs490/back/quizList.php");
curl_setopt($ch,CURLOPT_POST, 1);
curl_setopt($ch,CURLOPT_POSTFIELDS, $n);
curl_setopt($ch,CURLOPT_FOLLOWLOCATION, 1);
curl_exec($ch);
curl_close($ch);
}

else 
{
?>

<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
		<link href="http://web.njit.edu/~asp82/490/front/styles.css" rel="stylesheet">
	</head>
<body>			
	<div class="navbar navbar-inverse navbar-static-top">
		<div class="container">
		
			<div class="navbar-header">
				<a class="navbar-brand" href="http://web.njit.edu/~asp82/490/front/prof/professor.php">Python Online Exam Center</a>
						
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
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>	
</body>
</html>
<?php
include 'footer.php';
	}
?>



