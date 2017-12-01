<?php

if(isset($_POST['login']))
{
session_start();


$ucid = $_POST["ucid"]; 
$pass = $_POST["pass"];

$send = "login";

$data     = array("ucid" => $ucid, "pass" => $pass,"role" => $role, "send" =>$send);
$all_data = json_encode($data);

$_SESSION['ucid'] = $ucid;
$mr = 5;

$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,"http://web.njit.edu/~aps64/cs490/back/login.php");
curl_setopt($ch,CURLOPT_FOLLOWALLOCATION,$mr>0);
//curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
//curl_setopt($ch,CURLOPT_HEADER,0);
curl_setopt($ch,CURLOPT_POST, 1);
//curl_setopt($ch,CURLOPT_COOKIEFILE, 'http://web.njit.edu/~aps64/cs490/back/cookies.txt');
//curl_setopt($ch,CURLOPT_COOKIEJAR, 'http://web.njit.edu/~aps64/cs490/back/cookies.txt');
curl_setopt($ch,CURLOPT_POSTFIELDS,$all_data);

$result=curl_exec($ch);
curl_close($ch);
/*echo $result;
echo $h=(json_decode($result));
$ucid = $h->ucid;
echo $role = $h->role;
echo $name = $h->name;
$session['ucid'] = $ucid;
$session['student'] = $name;
$session['prof'] = $name;

if ($role == 'Student')
{
	$_SESSION['student'] = $name;
	header("stuhome.php");
}

else if ($role == 'Instructor')
{
	$_SESSION['prof'] = $name;
	header("professor.php");
}


*/
exit();
}
 
else 
{
?>

<!DOCTYPE html>

<html>
	<head>
		<title>CS490</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
		<link href="http://web.njit.edu/~asp82/490/front/styles.css" rel="stylesheet">
	</head>

	<body>
	<div class="navbar navbar-inverse navbar-static-top">
		<div class="container">
		
			<div class="navbar-header">
				<h4>Python Online Exam Center</h4>
			
				<button class= "navbar-toggle" data-toggle = "collapse" data-target=".navHeaderCollapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				</button>
			</div>	
			
			<div class="collapse navbar-collapse navHeaderCollapse">
			
				
				<form class="navbar-form navbar-right" method="POST" action="newlogin.php" role="search">
										
					<div class="form-group">
					
						<label for="ucid" control-label>UCID: </label>
						<input type="text" class="form-control" name="ucid" id="ucid" placeholder="UCID"/>
							
						
					</div>
				
					<div class="form-group">
						<label for="pass" control-label>Password: </label>
					
						<input type="password" class="form-control" name="pass" id="pass" placeholder="Password"/>
						
					</div>
						
															
					<input type="submit" class="btn btn-primary" name="login" value="Sign In">
				
				</form>
															
			</div>
		
		</div>
	</div>
	
	<div class="container">
		
		<div class="jumbotron text-center">
		
		<h1>Python Online Exam Center</h1>
		<h3>Welcome to Python OEC</h3>
		<h1></h1>
		
		
		<p align="left"><b>Professors:</b> Professors can create quiz by using our existing Quiz Bank. They could also add new questions to QuizBank. The range of questions include Muliple Choice, True-False, Open-Ended(programming).</p>
		<p align="left"><b>Students:</b> Students can test their python skills by taking quiz created by their own Professors. As soon as the grades are relaesed by respective professor, students can check out their grades for the submitted quiz. They could also get detailed feedback including answer and exaplanation.</p>
		<a class="btn btn-primary">Register</a>
		
		
		</div>
		
	</div>
		
	<!--<div class="container">
		<div class="row">
			
			<div class="col-md-3">
		
			<h3> <a href="#">abcd</a></h3>
			<p>Images in Bootstrap 3 can be made responsive-friendly via the addition of the .img-responsive class. This applies max-width: 100%; and height: auto; to the image so that it scales nicely to the parent element.</p>
			<a href="#" class="btn btn-default">Read more</a>
			
			</div>
			
			<div class="col-md-3">
		
			<h3> <a href="#">abcd</a></h3>
			<p>Images in Bootstrap 3 can be made responsive-friendly via the addition of the .img-responsive class. This applies max-width: 100%; and height: auto; to the image so that it scales nicely to the parent element.</p>
			<a href="#" class="btn btn-default">Read more</a>
			
			</div>
		
		</div>
	</div>-->
	
	
	
	
	
	<div class="navbar navbar-default navbar-fixed-bottom">
		
		<div class="container">
			
			<a class="navbar-btn btn-danger btn pull-right" href="#contact" data-toggle="modal">Contact US</a>
			<p class="navbar-text pull-right"><b>Designed by AKA</b></p>
			<!--<a href="#" class="navbar-btn btn-danger btn pull-right">Subscribe</a>-->
		</div>
	</div>
	
	<div class="modal fade" id="contact" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<form class="form-horizontal" method="POST" action="email.php" role="form">
					<div class="modal-header">
						<h4>Contact Developers</h4>
					</div>
				
					<div class="modal-body">
					
						<div class="form-group">
						
							<label for="name" class="col-lg-2" control-label>Name: </label>
							<div class="col-lg-10">
								<input type="text" name="name" class="form-control" id="name" placeholder="Full Name"/>
							
							</div>
						
						</div>
				
						<div class="form-group">
							<label for="email" class="col-lg-2" control-label>Email: </label>
						
							<div class="col-lg-10">
								<input type="email" name="email" class="form-control" id="email" placeholder="you@example.com"/>
							</div>
						</div>
						
						
						<div class="form-group">
						
							<label for="subject" class="col-lg-2" control-label>Subject: </label>
							<div class="col-lg-10">
								<input type="text" name="subject" class="form-control" id="subject"/>
							
							</div>
						</div>
						
						<div class="form-group">
						
							<label for="cotact-msg" class="col-lg-2" control-label>Message: </label>
							<div class="col-lg-10">
								<textarea class="form-control" rows="8"></textarea>
							
							</div>
						
						</div>
				
				
					</div>
				
					<div class="modal-footer">
						<a class="btn btn-default" data-dismiss="modal">Cancel</a>
						<a class="btn btn-primary" type="submit">Send</a>
				
					</div>
			</form>
			</div>
		</div>
	</div>
	

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script src= "js/bootstrap.js"></script>

</body>


</html>
<?php } ?>