<!-- EMAIL.PHP -->

<!DOCTYPE html>
<head>
<style>
h1 { 
	margin: auto;
	margin-top:10%;
	color: blue;
	font-family:verdana;
	font-weight: bolder;
	font-size:200%;
	}


	
span	
	{
	 margin-top:5%;
	 
	}
	
.dot
{			 
	position: relative;
	-webkit-animation: mymove 15s infinite; /* Chrome, Safari, Opera */
    animation: mymove 10s infinite;
    
}

/* Chrome, Safari, Opera */
@-webkit-keyframes mymove 
{
    from {left: 50px;}
    to {left: 350px;}
}

@keyframes mymove 
{
    from {left: 50px;}
    to {left: 350px;}
}				 


    
	
div 
{  
	margin-top: 10%;
	margin-left: 30%;
	align: center;
}

.im img
{
	
	max-width: 150px;
    max-height: 150px;
}

</style>
<script type="text/javascript">

	function Redirect()
			{
			window.location='home.html';
	}
	
					
</script>
</head>


<?php
  
/*include ("account.php") ;
( $dbh = mysql_connect ( $hostname, $user, $pwd ) )
	        or    die ( "Unable to connect to MySQL database" );
//print "Connected to MySQL<br>";
mysql_select_db( $project ); */


if(isset($_POST['name'])) $name = $_POST['name']; 
 
if(isset($_POST['email'])) $from = $_POST['email'];
 
if(isset($_POST['message'])) $message = $_POST['message'];

if(isset($_POST['subject'])) $subject = $_POST['subject'];	


$to="aps64@njit.edu";

$headers =  'From:'.$name."\r\n".
$headers .= 'Reply-To: '.$from."\r\n";
$headers .= 'Cc: asp82@njit.edu' . "\r\n";
$headers .= 'Cc: kkp34@njit.edu' . "\r\n";		   

//send the email
mail( $to, $subject, $message, $headers );

?>
<script>
	document.write("<h1>Email Sent to the Developers. We'll get back to you ASAP!</h1><div class='im'><img src='http://www.ppimusic.ie/images/loading_anim.gif'/></div>");
	setTimeout('Redirect()', 3000);
			
</script>


