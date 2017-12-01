<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
		<link href="http://web.njit.edu/~asp82/490/front/styles.css" rel="stylesheet">
		<title> Instructor | AddQue</title>

		<script>
	function showMC()
	{
		document.getElementById('mc').style.display='block';
		document.getElementById('tf').style.display='none';
		document.getElementById('oe').style.display='none';
	}

	function showTF()
	{
		document.getElementById('mc').style.display='none';
		document.getElementById('tf').style.display='block';
		document.getElementById('oe').style.display='none';
	}

	function showOE()
	{
		document.getElementById('mc').style.display='none';
		document.getElementById('tf').style.display='none';
		document.getElementById('oe').style.display='block';
	}
	
	
	
	
	</script>
		
</head>

<?php 
session_start();
$ucid = $_SESSION['ucid'];
$name = $_SESSION['prof'];


if ($ucid != '')
{
	if(isset($_POST['submit']))
	{
		$qst  = $_POST["qst"]; 
		$ans  = $_POST["ans"];
		$opt1 = $_POST["opt1"];
		$opt2 = $_POST["opt2"]; 
		$opt3 = $_POST["opt3"];
		$opt4 = $_POST["opt4"];
		$opt5 =	$_POST["opt5"];
		$ans  = $_POST["ans"];
		$exp  =	$_POST["exp"];
		$level= $_POST["level"];
		$category= $_POST["category"];
		$pnt  =	$_POST["pnt"];
		$send = "addQuestion";
		$ucid = $_SESSION['ucid'];

//echo $ucid = $_SESSION['ucid'];
//echo $name = $_SESSION['name'];
echo "<br>";

		if (strlen($opt1) > 0 && strlen($opt2) > 0 && strlen($opt3) > 0 && strlen($opt4) > 0)

			$type=MC; 
	
		else if (strlen($opt1) == 0 && strlen($opt2) == 0)
		{	
			if($ans == 'opt1' || $ans=='opt2' ) 
				$type=TF; 
			else
				$type=OE;
	
		}
		
//echo $type;

	

	$data = array("ucid" => $ucid, "name"=> $name, "send"=> $send,
				"qst" => $qst, "ans" => $ans,"opt1" => $opt1,"opt2" => $opt2,
					"opt3" => $opt3,"opt4" => $opt4,"opt5" => $opt5,
					"type"=> $type, "exp"=> $exp, "send"=>$send, "points"=>$pnt, "level"=>$level, "category"=>$category);
					
	$all_data = json_encode($data); 

	$ch = curl_init();
	  
	//curl_setopt($ch,CURLOPT_URL,"http://web.njit.edu/~aps64/cs490/back/addquestion.php");
	curl_setopt($ch,CURLOPT_URL,"http://web.njit.edu/~kkp34/490/middle/addquestion.php");
	
	$mr=5;
	curl_setopt($ch,CURLOPT_FOLLOWALLOCATION,$mr>0);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch,CURLOPT_HEADER,0);
	curl_setopt($ch,CURLOPT_POST, 1);
	curl_setopt($ch,CURLOPT_POSTFIELDS,$all_data);
	curl_exec($ch);
	curl_close($ch);
?>
	
	<script> 
	alert('Question Added to quiz Bank!!'); 
	window.location='addqst.php';
	</script>
	
	<?php
	exit();
	}

	else 
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
					<li class="active"> <a href="http://web.njit.edu/~asp82/490/front/prof/addqst.php"> Add Questions </a></li> 
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
						
			<form action = "addqst.php" method = "post">


<h2> What type of questions would you like to add? </h2>
<br>
<ul class="quetype">
			<li type='button' class='btn btn-primary' onClick="showMC()" >Multiple Choice</li>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<li type='button' class='btn btn-primary' onClick="showTF()">True/False</li>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<li type='button' class='btn btn-primary' onClick="showOE()">Open Ended</li>
	</ul>

<div class="quiz" id="mc">


<table align="center" class="table-condensed">

<tr> 
	<td><label for="txt"> Question Category <sup>*</sup></label></td>
	
	<td> 
		<select name="category" required>
		<option value="Other">Other</option>
		<option value="Introduction">Introduction</option>
		<option value="Loops">Loops</option>
		<option value="Functions">Functions</option>
		<option value="Objects / Classes">Objects / Classes</option>
		<option value="Math Functions, Strings / Objects"> Math Functions, Strings / Objects</option>
		<option value="Recursion">Recursion</option>
		</select>
	<td>
	
</tr>

<tr>
	<td><label for="txt"> Enter the question you would like to add:</label></td>

	<td><textarea 	name="qst" 
					id="qst"
					rows="5" cols="50"
					autocomplete="off"
					required
					autofocus="on"
					placeholder="Enter question"
					></textarea>
	</td>
</tr>

<tr>
	<td><label for="txt"> Enter options: </label></td>

	<td><input type=radio name="ans" value="A" required><label class="op">A<sup>*</sup></label> 
				<input type= text
				name="opt1"
				id="opt1"
				autofocus="on"
				autocomplete="off"
				placeholder="Enter Answer "
				required />
	</td>
</tr>
	
<tr>
	<td></td>
	<td><input type=radio name="ans" value="B" required><label class="op">B<sup>*</sup></label> 
				<input type= text
				name="opt2"
				id="opt2"
				autofocus="on"
				autocomplete="off"
				placeholder="Enter Answer "
				required />
	</td>
</tr>

<tr>
	<td></td>
	<td><input type=radio name="ans" value="C" required><label class="op">C<sup>*</sup></label> 
				<input type= text
				name="opt3"
				id="opt3"
				autofocus="on"
				autocomplete="off"
				placeholder="Enter Answer "
				required />
	</td>
</tr>

<tr>	
	<td></td>
	<td><input type=radio name="ans" value="D" required> <label class="op">D<sup>*</sup></label> 
				<input type= text
				name="opt4"
				id="opt4"
				autofocus="on"
				autocomplete="off"
				required
				placeholder="Enter Answer "/>
	</td>
</tr>

<tr>	
	<td></td>
	<td><input type=radio name="ans" value="E" required><label class="op">E</label> 
				<input type= text
				name="opt5"
				id="opt5"
				autofocus="on"
				autocomplete="off"
				placeholder="Enter Answer "/>
	</td>
</tr>

<tr>
	<td><label for="txt"> Explaination </label></td>

	<td><textarea 	name="exp" 
					id="exp"
					rows="3" 
					cols="50"
					autocomplete="off"
					autofocus="on"
					placeholder="Explanation"></textarea>
	</td>
</tr>

<tr>
	<td><label for="txt"> Difficulty Level &nbsp;</label>
		<select name="level">
		<option value="Easy">Easy</option>
		<option value="Medium">Medium</option>
		<option value="Hard">Hard</option>
		</select>
	</td>

	<td><label for="txt"> Points &nbsp;</label>
	<input type="number" name="pnt" id="pnt" min="1" max="5" value="2">
	</td>

</tr>

<tr>
<td> <input type="reset"  class="btn btn-warning" value="Reset"> </td>
<td> <input type="submit"  name="submit" class="btn btn-success" value="Add to Q Bank"> </td>
</tr>

</table>
</form>


</div> <!--mc ends--> 

<div class="quiz" id="tf"> 

<form action="addqst.php" method="post" target="Details" onSubmit="return popWindow(this.target)">

<table align="center" class="table-condensed" >

<tr> 
	<td><label for="txt"> Question Category <sup>*</sup></label></td>
	
	<td> 
		<select name="category" required>
		<option value="Other">Other</option>
		<option value="Introduction">Introduction</option>
		<option value="Loops">Loops</option>
		<option value="Functions">Functions</option>
		<option value="Objects / Classes">Objects / Classes</option>
		<option value="Math Functions, Strings / Objects"> Math Functions, Strings / Objects</option>
		<option value="Recursion">Recursion</option>
		</select>
	<td>
	
</tr>


<tr>
	<td><label for="txt"> Enter the Question: </label></td>

	<td><textarea 	name="qst" 
					id='qst'
					rows="6" 
					cols="50"
					autocomplete="off"
					required
					autofocus="on"
					placeholder="Enter question"></textarea>
	</td>
</tr>


<tr>
	<td><label for="txt"> Answer: </label></td>
	<td><input type=radio name="ans" value="opt1" required><label class="txt1"> True</label>
	</td>
</tr>

<tr>
	<td></td>
	<td><input type=radio name="ans" value="opt2" required ><label class="txt1"> False</label>
	</td>
</tr>

<tr>
	<td><label for="txt"> Explaination </label></td>

	<td><textarea 	name="exp"
					id="exp"
					rows="6" 
					cols="50"
					autocomplete="off"
					autofocus="on"
					placeholder="Explanation"></textarea>
	</td>
</tr>

<tr>
	<td><label for="txt"> Difficulty Level &nbsp;</label>
		<select name="level">
		<option value="Easy">Easy</option>
		<option value="Medium">Medium</option>
		<option value="Hard">Hard</option>
		</select>
	</td>

	<td><label for="txt"> Points &nbsp;</label>
	<input type="number" name="pnt" id="pnt" min="1" max="5" value="2">
	</td>

</tr>
<tr>
<td> <input type="reset"  class="btn btn-warning" value="Reset"> </td>
<td> <input type="submit"  name="submit" class="btn btn-success" value="Add to Q Bank"> </td>
</tr>

</table>
</form>

</div><!--tf ends-->

<div class="quiz" id="oe">

<form action="addqst.php" method="post">

<table align="center" class="table-condensed" >

<tr><td></td></tr>

<tr> 
	<td><label for="txt"> Question Category <sup>*</sup></label></td>
	
	<td> 
		<select name="category" required>
		<option value="Other">Other</option>
		<option value="Introduction">Introduction</option>
		<option value="Loops">Loops</option>
		<option value="Functions">Functions</option>
		<option value="Objects / Classes">Objects / Classes</option>
		<option value="Math Functions, Strings / Objects"> Math Functions, Strings / Objects</option>
		<option value="Recursion">Recursion</option>
		</select>
	<td>
	
</tr>



<tr>
	<td><label for="txt"> Enter the Question </label></td>
	

	<td><textarea 	name="qst" 
					id='qst'
					rows="3" 
					cols="50"
					autocomplete="off"
					required
					autofocus="on"
					placeholder="Enter question"></textarea>
	</td>
</tr>

<tr>
	<td><label for="txt"> Answer: </label></td>
	<td><textarea 	name="ans"
					id="ans"
					rows="5"
					placeholder="Enter Answer"
					cols="50"
					autofocus="on"
					autocomplete="off"
					required /></textarea>
	</td>
</tr>

<tr>
	<td><label for="txt"> Difficulty Level &nbsp;</label>
		
		<select name="level">
		<option value="Easy">Easy</option>
		<option value="Medium">Medium</option>
		<option value="Hard">Hard</option>
		</select>
	</td>
	
	<td><label for="txt"> Points &nbsp;</label>
	<input type="number" name="pnt" id="pnt" min="5" max="20" step="5" value="5">
	</td>
</tr>



<tr>
<td> <input type="reset"  class="btn btn-warning" value="Reset"> </td>
<td> <input type="submit"  name="submit" class="btn btn-success" value="Add to Q Bank"> </td>
</tr>
</table>
</form>
		
		</div>
		
</div>	
	
	<div class="navbar navbar-default navbar-fixed-bottom">
		
		<div class="container">
			
			<a class="navbar-btn btn-danger btn pull-right" href="#contact" data-toggle="modal">Contact US</a>
			<p class="navbar-text pull-right"><b>Designed by AKA</b></p>
		
		</div>
	</div>
	

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script

</body>


</html>
	<?php 
	} 
}
	
		else 
			{
			?>
			
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
