

<?php

  
 $rcvd = file_get_contents('php://input');
$rec = json_decode($rcvd);

$username  	=  	$rec->ucid;
//$username  	=  	mysql_real_escape_string($username) ;
$email   	=  	$rec->email;
//$email   	=  	mysql_real_escape_string($email) ;
$fullname  	=  	$rec->fullname;
//$fullname  	=  	mysql_real_escape_string($fullname) ;
$password 	= 	$rec->password;
//$password 	= 	mysql_real_escape_string($password) ;
$role = $rec->role;

$pw = sha1($password);


include ("account.php") ;
( $dbh = mysql_connect ( $hostname, $user, $pwd ) )
	        or    die ( "Unable to connect to MySQL database" );
//print "Connected to MySQL<br>";
mysql_select_db( $project ); 

 /*WORKS WITH BOTH GET AND POST
$sq="SELECT * FROM login WHERE '$username'=username";
//print "<br> $sq <br>";
$result = mysql_query($sq) or die(mysql_error());
if (mysql_num_rows($result))
echo "<span class='taken'>&nbsp;&#x2718; " .
"Sorry, The username '$username' is taken</span><br>";
else echo "<span class='available'>&nbsp;&#x2714; ".
"This username '$username' is available</span><br>";
*/

$s="insert into login values ( '$username' ,'$pw', '$fullname', '$role', '$email' )";

mysql_query ($s) or die ( mysql_error() );

//print "<br>Query is: $s<br>";
/*echo "<b>Connected to Database. <br> Data was inserted into the Table:\"Registered\"</b> <br>";

//print "<br>mysql error message is: " . mysql_error() ;
}
else 
{
echo "<br><b><i>Could not Connect to Database.</b><br> <br>Error: Incorrect Password (Authentication Failed)</i><br>";

echo "<br><b>Data was NOT inserted:</b> <br>";
}


echo  "<table  align=center>"	;   
	   
echo  "<tr>" ;
echo  "<th>Username</th>"  ;
echo  "<th>Email</th>"  ;
echo  "<th>Full Name</th>"  ;
echo  "<th>Birth Place</th>"  ;
echo  "<th>Address</th>"  ;
echo  "<th>Registered on</th>"  ;

echo  "</tr>" ;

echo  "<tr>" ;
echo  "<td>$username</td>"  ;
echo  "<td>$email</td>"  ;
echo  "<td>$fullname</td>"  ;
echo  "<td>$birth</td>"  ;
echo  "<td>$address</td>";
echo  "<td>". date("Y-m-d") . "</td>";
echo  "</tr>" ;

echo"</table>";


echo "<a href='http://web.njit.edu/~aps64/IT202/A3/Register.php'>Home</a>"; */

?>
