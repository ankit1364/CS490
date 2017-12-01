<!DOCTYPE html>

<style> 
td,th {
   
width: 180px;
}
</style> 
<html>

	<head>
		<title>Release Grades</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
		<link href="http://web.njit.edu/~asp82/490/front/styles.css" rel="stylesheet">
		
		
	</head>
<?php 
session_start();
echo $ucid = $_SESSION['ucid'];
echo $name  = $_SESSION['prof'];
if($ucid != '')
{
	if(isset($_POST['release']))
		{
		$id  = $_POST["id"]; 
		$name= $_POST["name"];
		$ucid = $_SESSION['ucid'];
		$send= "rlsGrades";
		
		$data    = array("send"=>$send, "id"=>$id, "quizName"=>$name, "ucid"=>$ucid);
					
		$mr=5;
		$all_data = json_encode($data);
		
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,"http://web.njit.edu/~kkp34/490/middle/release.php");
		//curl_setopt($ch,CURLOPT_URL,"http://web.njit.edu/~aps64/cs490/back/endquiz.php");
		curl_setopt($ch,CURLOPT_FOLLOWALLOCATION,$mr>0);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch,CURLOPT_HEADER,0);
		curl_setopt($ch,CURLOPT_POST, 1);
		curl_setopt($ch,CURLOPT_POSTFIELDS,$all_data);
		
		curl_exec($ch);
		curl_close($ch);
		
		?>
		
		<script> 
			alert('Quiz has been ended!!'); 
			window.location='endquiz.php';
	</script>
		
		
		<?php 
		exit();
		}

else {
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
					<li class="active"> <a href="http://web.njit.edu/~asp82/490/front/prof/endquiz.php"> End Quiz </a></li>
					<li> <a href="http://web.njit.edu/~asp82/490/front/logout.php"> Sign Out </a></li>
								
				</ul>
															
			</div>
		
		</div>
	</div>
	
	<div class="container">
		
		<div class="jumbotron text-center">
					
			<form action="endquiz.php" method = "post">
                    
					<?php
						$data    = array("ucid"=>$ucid);
					
						$all_data = json_encode($data);		
						
					$mr=5;
					$ch = curl_init();
					//curl_setopt($ch,CURLOPT_URL,"http://web.njit.edu/~kkp34/490/middle/quizList.php");
					curl_setopt($ch,CURLOPT_URL,"http://web.njit.edu/~aps64/cs490/back/quizList.php");
					curl_setopt($ch,CURLOPT_FOLLOWALLOCATION,$mr>0);
					curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
					curl_setopt($ch,CURLOPT_HEADER,0);
					curl_setopt($ch,CURLOPT_POST, 1);
		 			curl_setopt($ch,CURLOPT_POSTFIELDS,$all_data);
					
					 $result= curl_exec($ch);
					
						$a = (json_decode($result));
		
                $numquiz = Sizeof($a->quizes);
					
					curl_close($ch);
				
			if($numquiz == 0)
				{
					echo "<h1> You do not have any quiz to release grades.</h1>";
					echo "<h3 align='center'> Please check again later.</h3>";		
				
				}
				
			else {
			
					?>
					<br><br><br>
					
			    <table class="table table-hover profquiz "  id= "list" align="center">
					<thead>
						<tr>
							<th>select</td>
						
							<th >Quiz List</th>
							<th >Created On</th>
							<th >Start Date</th>
							<th >End Date</th>
							<th >Status</th>
				
							
						</tr>
					</thead>
					
					<tbody>
					<?php
						
						for($i=0; $i<$numquiz; $i++) 
						{
							$id   = $a-> quizes[$i]->id;
                            $name = $a->quizes[$i]->quizName;
							$crtdate = $a->quizes[$i]->createDate;
							$sdate= $a->quizes[$i]->startDate;
							$edate= $a->quizes[$i]->endDate;
							$status= $a->quizes[$i]->status;
								
							$today=date("Y-m-d");
							
							
					
					echo "<tr>";
						if(strtotime($edate) > strtotime($today))
						{
						echo "<td><input type='radio' name='id' value=$id ></td>";
						echo "<td align='left'>".$name."</td>";
						echo "<td align='left'>".$crtdate."</td>";
						echo "<td align='left'>".$sdate."</td>";
						echo "<td align='left'>".$edate."</td>";
						echo "<td align='left'>".$status."</td>";
						
						
					echo "</tr>";
						}
					
						} 
					?>
					</tbody>
                </table>
                
				
                <input type="submit" class="btn btn-success pull-center" name="release" value="End Date">

		
			</form>
	
		</div>
	</div>
	
	<?php
	}
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

	
	

include 'footer.php';
?>
	
	
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
			
	<script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.10.2.min.js"></script>
	<script type="text/javascript" language="javascript" src="//cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" language="javascript" src="//cdn.datatables.net/plug-ins/9dcbecd42ad/integration/bootstrap/3/dataTables.bootstrap.js"></script>

	
	
		<script type="text/javascript" charset="utf8">
		$(document).ready(function(){
			$('#list').dataTable({ aLengthMenu: [[5, 10, 15, 20, -1, "All"], [5, 10, 15, 20, "All"]],
			language: {
            lengthMenu:"Display _MENU_ Quizes per page",
            info: "Showing Page _PAGE_ of _PAGES_",
            infoEmpty:"No records available",
                }		
			
			});
		});
		
		$('#list')
			.addClass('table table-hover');
			
		</script>

	
</body>

</html>
