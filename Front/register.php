<!-- REGISTER.PHP -->


<?php
if(isset($_POST['submit']))
	{
$ucid	  = $_POST ["UCID"] ; 
$email    = $_POST["email"]  ;
$fullname = $_POST ["fullname"]  ;
$password = $_POST ["password"];
$role	  = $_POST["role"];



	$data    = array("ucid"=> $ucid, "email" => $email, "fullname" => $fullname, "password" => $password,"role" => $role);
					
		$all_data = json_encode($data);

		$mr = 5;
		$ch = curl_init();
		//curl_setopt($ch,CURLOPT_URL,"http://web.njit.edu/~aps64/cs490/back/In_register.php");
		curl_setopt($ch,CURLOPT_URL,"http://web.njit.edu/~kkp34/490/middle/In_register.php");
		curl_setopt($ch,CURLOPT_FOLLOWALLOCATION,$mr>0);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch,CURLOPT_HEADER,0);
		curl_setopt($ch,CURLOPT_POST, 1);
		curl_setopt($ch,CURLOPT_POSTFIELDS,$all_data);
		$result=curl_exec($ch);
		curl_close($ch);
		echo "You have Successfully Registered.<br>Pleas close this window and sign in to proceed further.";
	}
	
	else {
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Register</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
		<link href="http://web.njit.edu/~asp82/490/front/styles.css" rel="stylesheet">
		<link href="http://web.njit.edu/~asp82/490/front/style.css" rel="stylesheet">
	</head>

<body>


<div class="container">
		
	<div class="jumbotron text-center">
		<form action="In_register.php" method=POST onsubmit="return test();">

			<h1>REGISTER</h1>

			<table>
			
			<tr>
				<td> <label for="fullname" > Full Name </label> </td>
				<td> <input  type=text  name="fullname"  placeholder="LastName FirstName"
					id="fullname" required
						pattern="^[A-za-z\d\s\.-]+$"
						title="A Name can not contain any special characters except '-' , '.'"> </li> 
				</td>
			</tr> 
			
			<tr>
	<td><label for="txt"> Role &nbsp;</label></td>
	<td>
		<select name="role">
		<option value="Instructor">Instructor</option>
		<option value="Student">Student</option>
		</select>
	</td>
	</TR>
			
			<tr>
				<td> <label for="email" > Email </label></td>
				<td> <input  type=email  name="email"  placeholder="Email"
					required id="email"> </li> </td>
			</tr>
			

			<tr>
				<td> <label for="UCID" >UCID </label></td>
				<td> <input  type=text  name="UCID" placeholder="Enter UCID" 
				id="UCID" autofocus required autocomplete="off"
				onkeyup="instantName(id)"></td>
			<td>
				<span id="UCID-warning"></span>
					<!--title="A UCID is a sequence of letters followed by zero to three digits."> </td> <br>-->
			</tr>


			<tr>
				<td> <label for="password" > Password </label> </td>
				<td> <input  type = "password"  name = "password" 
				id = "password" required autocomplete="off"
				pattern="(?=^.{4,8}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"
				title="A password contains At least one Upper-case, one Special Character, and one Digit!!"
				></td> <br>
			</tr>

			
			
		</table>
			
			<input type='reset' class="btn btn-default pull-left">
			<input type='submit' class="btn btn-success" value="Join Us">
			
 
	
		</form>
	</div>
</div>

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>


<script type="text/Javascript">

function test()
{
    	//alert('test')
		var result = true
		if (!instantName("UCID")) { result=false ; }  
		return result
}
/*PRIORITY OF ERRORS
 1.AlphaNumeric Characters
 2.1st letter Capital
 3.At least 4 characters
 4.At most 8 characters 
 5. At least one lower case letter
*/

function instantName(id)
{
	s = document.getElementById(id).value
	document.getElementById('UCID-warning').innerHTML=" "
	
	p = /^[\d\w]+$/				 
	if ( s.search(p) == -1 )     
	{   
	 document.getElementById('UCID-warning').innerHTML="Must consist only of AlphaNumericals."
	 return false
	}
	
	
	p  = /^[A-Z]/
	if ( s.search(p) == -1 )
	{
	 document.getElementById('UCID-warning').innerHTML="Must begin with a Uppercase letter."
	 return false
	}
	
	p=/^[\d\w]{4,8}$/
	if ( s.search(p) == -1 )
	{
	 document.getElementById('UCID-warning').innerHTML="Must be at least 4 and at Most 8 charcaters."
	 return false
	}
	
	p = /^[\d\w]+$/				 
	if ( s.search(p) == -1 )     
	{   
	 document.getElementById('UCID-warning').innerHTML="Must consist only of AlphaNumericals."
	 return false
	}
	/*p=/^[\d\w]{,8}$/
	if ( s.search(p) == -1 )
	{
	 document.getElementById('UCID-warning').innerHTML="Must be at most 8 charcaters."
	 return false
	}*/ 
	
	p=/[a-z]+/
	if ( s.search(p) == -1 )
	{
	 document.getElementById('UCID-warning').innerHTML="Must contain at least one lower-case character."
	 return false
	}
		
return true
}



function showText()
{
	document.getElementById('street').onmouseover= function text()
	{
		document.getElementById('content').innerHTML="	123 Abcd St         - 	Valid<br>"
		document.getElementById('content').innerHTML+="	123 Abcd St, Apt-B  - 	Valid<br>"
		document.getElementById('content').innerHTML+="	#123 Abcd St        - 	Invalid<br>"
		document.getElementById('content').innerHTML+="	123_Abcd St		    -	Invalid<br>" 
	};
	
}

function clearText()
{	
	document.getElementById('street').onmouseout= function blank()
	{
	document.getElementById('content').innerHTML=" "
	};
}


</script> 
<?php } ?>
</body>