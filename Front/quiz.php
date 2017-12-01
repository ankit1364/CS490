<!DOCTYPE html>	
<html lang="en">
	<head>
		<title> Create Quiz </title>
		<meta name="robots" content="NOODP"/>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
		<link href="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.0-rc2/css/bootstrap.css" rel="stylesheet" media="screen">
		<link href="http://web.njit.edu/~asp82/490/front/styles.css" rel="stylesheet">
	</head>


<?php
session_start();
echo $ucid= $_SESSION['ucid'];
echo $name= $_SESSION['prof'];

if ($ucid != '')
	{
	
	if(isset($_POST['submit']))
	{
		$quiznm = 	$_POST["quiznm"]; 
		$sdt  	= 	$_POST["sdt"];
		$edt    = 	$_POST["edt"];
		$cbmc   = 	$_POST["cbmc"]; 
		$cbtf   = 	$_POST["cbtf"];
		$cboe   = 	$_POST["cboe"];
		$mcpnt  = 	$_POST["mcpnt"];
		$tfpnt  = 	$_POST["tfpnt"];
		$oepnt  = 	$_POST["oepnt"];

	$ucid=$_SESSION['ucid'];

	$send= "makequiz";


	$data     = array("ucid"=>$ucid, "quiznm" => $quiznm, "sdt" => $sdt,"edt" => $edt,"cbmc" => $cbmc,"cbtf" => $cbtf,"cboe" => $cboe, "mcpnt" => $mcpnt, "tfpnt" => $tfpnt, "oepnt" => $oepnt,
				"send"=>$send);
					
	$all_data = json_encode($data);

	$mr=5;
	$ch = curl_init();
	//curl_setopt($ch,CURLOPT_URL,"http://web.njit.edu/~aps64/cs490/back/addquiz.php");
	curl_setopt($ch,CURLOPT_URL,"http://web.njit.edu/~kkp34/490/middle/addquiz.php");
	curl_setopt($ch,CURLOPT_FOLLOWALLOCATION,$mr>0);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch,CURLOPT_HEADER,0);
	curl_setopt($ch,CURLOPT_POST, 1);
	curl_setopt($ch,CURLOPT_POSTFIELDS,$all_data);
	
	
	
	echo $result= curl_exec($ch);
	
	curl_close($ch);

exit();
}

else {

	
$ch = curl_init();
//curl_setopt($ch,CURLOPT_URL,"http://web.njit.edu/~aps64/cs490/back/questions.php");
curl_setopt($ch,CURLOPT_URL,"http://web.njit.edu/~kkp34/490/middle/questions.php");

$mr=5;
curl_setopt($ch,CURLOPT_FOLLOWALLOCATION,$mr>0);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch,CURLOPT_HEADER,0);
curl_setopt($ch,CURLOPT_POST, 1);
curl_setopt($ch,CURLOPT_POSTFIELDS,$all_data);

$result = curl_exec($ch);

	$ar =(json_decode($result));
	echo $NumMC = Sizeof($ar->mcq);
	$NumTF = Sizeof($ar->tfq);
	$NumOE = Sizeof($ar->oeq);
curl_close($ch);
	
	

?>

<!--navigation menu starts here -->
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
					<li class="active"> <a href="http://web.njit.edu/~asp82/490/front/quiz/quiz.php"> Add Quiz </a></li>
					<li> <a href="http://web.njit.edu/~asp82/490/front/prof/release.php"> Release Grades </a></li>
					<li> <a href="http://web.njit.edu/~asp82/490/front/logout.php"> Sign Out </a></li>
								
				</ul>
															
			</div>
		
		</div>
	</div>
	
<!-- navigation menu ends here -->

<div class="container">
		
	<div class="jumbotron text-center">
						
		<form action="quiz.php" method = "post">

		<table align="center" cellpadding="10" >

			<tr>
				<td align="right"><label for="txt"> Enter the Quiz Name:<sup>*</sup> </label></td>

				<td><input 	type=text 
					name="quiznm" 
					id="quiznm"
					autocomplete="off"
					autofocus="on"
					placeholder="Quiz Name"
					required
					></textarea>
				</td>
			</tr>

			<tr>
				<td align="right"><label for="txt">Start Date:<sup>*</sup></label></td>
				<td> <input type="date" name="sdt" required></td>
			</tr>

			<tr>
				<td align="right"><label for="txt">End Date:<sup>*</sup></label></td>
				<td><input type="date" name="edt" required></td>
			</tr>
		</table>

<br>
		<h4 align="center"> Enter Points for each type of Questions:</h4>

		<table align="center">
			<tr>
				<td>MCQ:<sup>*</sup></td> 
				<td><input type="text" name="mcpnt" id="mcpnt" size="2" pattern="^[0-9]{1,2}$" maxlength="2" required/></td>
				<td>TFQ:<sup>*</sup></td> 
				<td><input type="text" name="tfpnt" id="tfpnt" size="2" pattern="^[0-9]{1,2}$" maxlength="2" required/></td>
				<td>OEQ:<sup>*</sup></td> 
				<td><input type="text" name="oepnt" id="oepnt" size="2" pattern="^[0-9]{1,2}$" maxlength="2" required/></td>
				<td>TOTAL</td>
			</tr>
			
			<tr>
				<td colspan="2"><div type="text" id="totalMC" name="totalMC"></div></td>
				<td colspan="2"><div type="text" id="totalTF" name="totalTF"></div></td>
				<td colspan="2"><div type="text" id="totalOE" name="totalOE"></div></td>
				<td><div id="total"></div></td>
			</tr>
		</table>
<br>
		<ul>
			<li type='button' class='btn btn-lg btn-primary' onClick="showMC()" >Multiple Choice</li>	
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<li type='button' class='btn btn-lg btn-primary' onClick="showTF()">True/False</li>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<li type='button' class='btn btn-lg btn-primary' onClick="showOE()">Open Ended</li>
		</ul>
	

	<div id="quizmc" class="quiz">
			<?php echo "<h3>Select MCQ to insert into Quiz: ".$quizName."</h3>";?>
	
		
		<table id="mcTable">
			<thead>
				<tr>
					<th>Select</th>
					<th>ID</th>
					<th>Category</th>
					<th>Difficulty</th>
					<th>Question</th>
					
          		</tr>
			</thead>

			<tbody>
			
				<?php 
					for($i=0; $i<$NumMC; $i++) 
					{
						$n = $ar->mcq[$i]->id;
						$q = $ar->mcq[$i]->qst;
						$d = $ar->mcq[$i]->level;
						$c = $ar->mcq[$i]->category;
								
						echo "<tr>";
						echo "<td> <input id='cbmc' name='cbmc[]' type='checkbox' onclick='total()' value=$n> </td>";
						echo "<td align=left>".$n.".</td>";
						echo "<td align=left>".$c."</td>";
						echo "<td align=left>".$d."</td>";
						echo "<td align=left>".$q."</td>";
						echo "</tr>";
					}
				?>
			</tbody>	
		</table>
	
	</div> 
	 
	 
	 <div id="quiztf" class="quiz">
	 
		<?php echo "<h3>Select T/F to insert into Quiz: ".$quizName."</h3>";?>
	
		<table id="tfTable">
			<thead>
				<tr>
					<th>Select</th>
					<th>ID</th>
					<th>Category</th>
					<th>Difficulty</th>
					<th>Question</th>
          		</tr>
			</thead>

			<tbody>
		<?php 
			//echo $NumTF;
			
			for($i=0; $i<$NumTF; $i++) 
			{
            $n = $ar->tfq[$i]->id;
            $q = $ar->tfq[$i]->qst;
			$d = $ar->tfq[$i]->level;
			$c = $ar->tfq[$i]->category;
					echo "<tr>";
					echo "<td> <input id='cbtf' name='cbtf[]' type='checkbox' onClick='total()' value=$n> </td>";
					echo "<td align=left>".$n.".</td>";
					echo "<td align=left>".$c.".</td>";
					echo "<td align=left>".$d."</td>";
					echo "<td align=left>".$q."</td>";
					echo "</tr>";
			}
		?>
			</tbody>
        </table>
	<!--<type='button' class='button' onClick="checkboxTF()"/>Open Ended -->
	 </div> 
	 
	 
	 
	 <div id="quizoe" class="quiz">
	 
		<?php echo "<h3>Select OpenEnded to insert into Quiz: ".$quizName."</h3>";?>
		
		<table id="oeTable">
			<thead>
				<tr>
					<th>Select</th>
					<th>ID</th>
					<th>Category</th>
					<th>Difficulty</th>
					<th>Question</th>
          		</tr>
			</thead>

			<tbody>
        
		<?php 
			for($h=0; $h<$NumOE; $h++) 
			{
            $n = $ar->oeq[$h]->id;
            $c = $ar->oeq[$h]->category;
            $kq = $ar->oeq[$h]->qst;
			$d = $ar->oeq[$i]->level;
					echo "<tr>";
					echo "<td> <input id='cboe' name='cboe[]' type='checkbox' onClick='total()' value=$n> </td>";
					echo "<td align=left>".$n.".</td>";
					echo "<td align=left>".$c."</td>";
					echo "<td align=left>".$d."</td>";
					echo "<td align=left>".$kq."</td>";
					
					echo "</tr>";
			}
		?>
			</tbody>
		</table>
	
	 </div> 	 
	 
 <p> <input type="submit" class='btn btn-success' name="submit" value="Create Quiz">
 </form>

</div>
</div>

<?php } 
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

		
<div class="navbar navbar-default navbar-fixed-bottom">
		
		<div class="container">
			
			<a class="navbar-btn btn-danger btn pull-right" href="#contact" data-toggle="modal">Contact US</a>
			<p class="navbar-text pull-right"><b>Designed by AKA</b></p>
		
		</div>
	</div>
	

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
			
	<script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.10.2.min.js"></script>
	<script type="text/javascript" language="javascript" src="//cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" language="javascript" src="//cdn.datatables.net/plug-ins/9dcbecd42ad/integration/bootstrap/3/dataTables.bootstrap.js"></script>
	
	
	<script type="text/javascript" charset="utf8">
		$(document).ready(function(){
			$('#mcTable').dataTable();
		});
		
		$('#mcTable')
			.addClass('table table-hover');
			
		$(document).ready(function(){
		  $('#tfTable').dataTable();
		});
			
		$('#tfTable')
			.addClass('table table-hover');	
		
		$(document).ready(function(){
		  $('#oeTable').dataTable();
		});

		$('#oeTable')
			.addClass('table table-hover');
		
	function showMC()
	{
		document.getElementById('quizmc').style.display='block';
		document.getElementById('quiztf').style.display='none';
		document.getElementById('quizoe').style.display='none';
	}

	function showTF()
	{
		document.getElementById('quizmc').style.display='none';
		document.getElementById('quiztf').style.display='block';
		document.getElementById('quizoe').style.display='none';
	}

	function showOE()
	{
		document.getElementById('quizmc').style.display='none';
		document.getElementById('quiztf').style.display='none';
		document.getElementById('quizoe').style.display='block';
	}


	function countPoints(a, b)
	{
		
		var totalmc= a * b;
		return totalmc;
	
	}
	
	function total()
	{
	var to = checkMC()+checkTF()+checkOE();
	document.getElementById('total').innerHTML = to;
	document.getElementById('total').style.color="red";
	}	


	function checkMC()
	{
       
	   var check = document.getElementsByName("cbmc[]");
	   
	   var cnt = document.getElementById('mcpnt').value;
	   
	   count = 0;
          
		for (var i=0; i<check.length; i++) 
		{       
			if (check[i].type == "checkbox" && check[i].checked == true) 
			{ count++;}
		} 
	mc = countPoints(count, cnt);
	document.getElementById('totalMC').innerHTML = mc;
	document.getElementById('totalMC').style.color="black";
	
	return mc;
	}	
 

	function checkTF()
	{
       
	   var check = document.getElementsByName("cbtf[]");
	   
	   var cnt = document.getElementById('tfpnt').value;
	   
	   count = 0;
          
		for (var i=0; i<check.length; i++) 
		{       
			if (check[i].type == "checkbox" && check[i].checked == true) 
				{count++;}
		} 
		
		tf = countPoints(count, cnt);
		document.getElementById('totalTF').innerHTML = tf;
		document.getElementById('totalTF').style.color="green";
	return tf;
 
	}


function checkOE()
	{
     
	   var check = document.getElementsByName("cboe[]");
	   
	   var cnt = document.getElementById('oepnt').value;
	   
	   count = 0;
          
		for (var i=0; i<check.length; i++) 
		{       
			if (check[i].type == "checkbox" && check[i].checked == true) 
			{	count++;   	}
		}	 
		oe = countPoints(count, cnt);
		document.getElementById('totalOE').innerHTML = oe;
		document.getElementById('totalOE').style.color="blue";
	return oe;
	}
	  
</script>		
</body>
</html>
