<!DOCTYPE html>

<html>
	<head>
		<title>CS490</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
		<link href="http://web.njit.edu/~asp82/490/front/styles.css" rel="stylesheet">
	</head>

	<body>
<?php ?>
<div class="navbar navbar-default navbar-fixed-bottom">
		<div class="container">
			<a href="#contact" class="navbar-btn btn-danger btn pull-right"  data-toggle="modal">Contact US</a>
			<p class="navbar-text pull-right"><b>Designed by AKA</b></p>
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
						
							<label for="name" class="col-lg-2 control-label">Name: </label>
							<div class="col-lg-10">
								<input type="text" name="name" class="form-control" id="name" placeholder="Full Name">
							
							</div>
						
						</div>
				
						<div class="form-group">
							<label for="email" class="col-lg-2 control-label">Email: </label>
						
							<div class="col-lg-10">
								<input type="email" name="email" class="form-control" id="email" placeholder="you@example.com">
							</div>
						</div>
						
						
						<div class="form-group">
						
							<label for="subject" class="col-lg-2 control-label">Subject: </label>
							<div class="col-lg-10">
								<input type="text" name="subject" class="form-control" id="subject">
							
							</div>
						</div>
						
						<div class="form-group">
						
							<label for="message" class="col-lg-2 control-label">Message: </label>
							<div class="col-lg-10">
								<textarea class="form-control" name="message" id="message" rows="8"></textarea>
							
							</div>
						
						</div>
				
				
					</div>
				
					<div class="modal-footer">
						<a class="btn btn-default" data-dismiss="modal">Cancel</a>
						<a class="btn btn-primary" >Send</a>
				
					</div>
				</form>
			</div>
		</div>
	</div>
	

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
</body>	
</html>	