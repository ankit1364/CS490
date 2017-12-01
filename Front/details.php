<!-- DETAIL.PHP -->

<style>
tr
{
background-color: white;
}
.crct
{
 background-color: red;
}
.wrng
{
}
</style>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Feedback</title>
		<meta name="robots" content="NOODP"/>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
		<link href="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.0-rc2/css/bootstrap.css" rel="stylesheet" media="screen">
		<link href="http://web.njit.edu/~asp82/490/front/styles.css" rel="stylesheet">
	</head>
	
	


<?php 
session_start();
$ucid=$_SESSION['ucid'];
echo $name = $_SESSION['student'];
echo $quizname= $_SESSION['quizName'];

if ($ucid != '')
{
		$mr=5;
		
		$quizId  = $_POST["quizId"]; 
		$quizName= $_POST["quizName"];
		$ucid = $_SESSION['ucid'];
		$send= "feedback";
		$data    = array('send'=>$send, "quizId" => $quizId, "quizName" => $quizName, "ucid" => $ucid);
					
		$all_data = json_encode($data);

		$ch = curl_init();
	
		curl_setopt($ch,CURLOPT_URL,"http://web.njit.edu/~aps64/cs490/back/feedback.php");
		curl_setopt($ch,CURLOPT_FOLLOWALLOCATION,$mr>0);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch,CURLOPT_HEADER,0);
		curl_setopt($ch,CURLOPT_POST, 1);
		curl_setopt($ch,CURLOPT_POSTFIELDS,$all_data);
		
			$rqst= curl_exec($ch);
			
			$quiz = (json_decode($rqst));                
			$Name = $quiz->quizName;      
			$ucid = $quiz->ucid;
			$quizId= $quiz->quizId;

		curl_close($ch);


?>

	<body>
		
	<div class="container">
		
						
				<h2> Details </h2>
		<?php
					$pMC=0;
					$tpMC=0;
									
					$pTF=0;
					$tpTF=0;
					
					$pOE=0;
					$tpOE=0;
					
					echo "<input id='quizID' name='quizId' type='hidden' value=$quizId >";
					
					?>
					
				
		
				<table id="quiz">
				<thead>
				<tr> <th> </th></tr>
				</thead>
				<tbody>
              
                    <?php
                    
					$NumMC = Sizeof($quiz->MCQ);						
					
					for($i=0; $i<$NumMC; $i++)
						{
                            $qnum = $quiz->MCQ[$i]->queNum;
                            $que  = $quiz->MCQ[$i]->qst;
                            $opt1 = $quiz->MCQ[$i]->opt1;
                            $opt2 = $quiz->MCQ[$i]->opt2;
                            $opt3 = $quiz->MCQ[$i]->opt3;
                            $opt4 = $quiz->MCQ[$i]->opt4;
							$opt5 = $quiz->MCQ[$i]->opt5;
							$urAns = $quiz->MCQ[$i]->urAns;
							$ans  = $quiz->MCQ[$i]->ans;
							$exp = $quiz->MCQ[$i]->exp;
							$pnt = $quiz->MCQ[$i]->points;
							
						
				 echo "<input name='queMC[]' type='checkbox' value=$qnum checked hidden>";
				 
				
				 echo "<tr>";
						echo "<td align=left><ul><li><b>"    .$qnum. "." .$que. "</b></li>";
				                             
						echo "<li> <label class='options'>A. </label> " .$opt1. "</li>";
								
						echo "<li> <label class='options'>B. </label> " .$opt2. "</li>";
				
						echo "<li> <label class='options'>C. </label> " .$opt3. "</li>";
								
				        echo "<li> <label class='options'>D. </label> " .$opt4. "</li>";
				
				
				if ($opt5 != '')
				{
				echo "<li><label class='options'>E. </label> " .$opt5. "</li>";
				}
						echo "<br>";	
						if($urAns == $ans)
						{
						 $pMC = $pMC + $pnt;
						 echo "<li class='right'>&#10004; Your Ans: " .$urAns. "</li>";
						}
					
						else
						{
							echo "<li class='wrong'>&#10006;  Your Ans: " .$urAns. "</li>";
							echo "<li class='right'> Correct Ans: " .$ans. "</li>";
						}
				        
				        
						echo "<br>";						
						echo "<li><b> Explanation:  <i>" .$exp. "</i></b></li>";
				
					$tpMC = $tpMC+$pnt;
				echo "</ul></td></tr>";
				
			    } 
				
						
			   $NumTF = Sizeof($quiz->TFQ); 
						//echo "num of True and false:";
						//echo $NumTF;
                     
					for($j=0; $j<$NumTF; $j++)
						{
                             $qnum = $quiz->TFQ[$j]->queNum;
							 $que  = $quiz->TFQ[$j]->qst;
                             $opt1 = $quiz->TFQ[$j]->opt1;
                             $opt2 = $quiz->TFQ[$j]->opt2;
							 $urAns = $quiz->TFQ[$j]->urAns;
							 $ans  = $quiz->TFQ[$j]->ans;
							 $exp = $quiz->TFQ[$j]->exp;
							 $pnt = $quiz->TFQ[$j]->points;
							// echo "<input name='queTF[]' type='checkbox' value=$qnum checked hidden><b>";
                        
                    echo "<tr>";
						echo "<td align=left><ul><li><b>" .$qnum. ". " .$que. "</b></li>";
					
						echo "<li>" .$opt1. "</li>";
					
						echo "<li>" .$opt2. "</li>";
						echo "<br>";								
						if($urAns == $ans)
						{
						 $pTF = $pTF + $pnt;
						 echo "<li class='right'>&#10004; Your Ans: " .$urAns. "</li>";
						}
					
						else
						{
							echo "<li class='wrong'>&#10006;  Your Ans: " .$urAns. "</li>";
							echo "<li class='right'> Correct Ans: " .$ans. "</li>";
						}
						echo "<br>";						
					
						echo "<li> Explanation: <i>" .$exp. "</i></label></li>";
					 
					 $tpTF= $tpTF+$pnt;
					
					echo "</ul></td>";
					 echo "</tr>";
				}
					
				
					$NumOE = Sizeof($quiz->OEQ);
							
							//echo "Number of Open Ended:";
							//echo $NumOE;
							for($k=0; $k<$NumOE; $k++) {
                            $qnum = $quiz->OEQ[$k]->queNum;
                            $que  = $quiz->OEQ[$k]->qst;
							$urAns = $quiz->OEQ[$k]->urAns;
							$ans  = $quiz->OEQ[$k]->ans;
							$exp = $quiz->OEQ[$k]->exp;
							$pnt = $quiz->OEQ[$k]->points;
                
                    echo "<tr>";
						echo "<td align=left><ul><li><b>" .$qnum. " . " .$que. "</b></li>";
					
						echo "<br>";										
						
						if($urAns == $ans)
						{
						$pOE= $pOE+$pnt;
						 echo "<li> Your Ans:<label class='YourAns' > " .$urAns. "</label></li>";
						}
					
						else
						{
							echo "<li> Your Ans:<label class='YourAns' > " .$urAns. "</label></li>";
						}
						echo "<li> Correct Ans: <label class='Ans'> " .$ans. "</label></li>";
						
						echo "<br>";
				        						
						echo "<li> Explanation: <i>" .$exp. "</i></label></li></ul></td>";
					echo "</tr>";
					$tpOE = $tpOE+$pnt;
					
					} 
				
			?>
					</tbody>
			  </table>
			  
			  <?php 
					
					
					$total=$pMC + $pTF + $pOE;
					$outof = $tpMC+$tpTF+$tpOE;
					
					echo "<br><br>";
					
					echo "<table class='table'>";
					echo "<h3>Points Earned</h3>";
					echo "<thead>";
					echo "<tr><th>MC</th> <th>TF</th> <th>OE</th> <th>Total</th></tr>";
					echo "</thead>";
					
					echo "<tbody>";
					echo "<tr>";
					echo "<td>" .$pMC. "/" .$tpMC. "</td>";
					echo "<td>" .$pTF. "/" .$tpTF. "</td>";
					echo "<td>" .$pOE. "/" .$tpOE. "</td>";
					echo "<td>" .$total."/".$outof."</td>";
					echo "</tr>";
					echo "<tbody>";
					echo "</table>";
			   ?>
		
			 </div>
        
	<?php 
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
		
		<?php } ?>
		
	</div>	
	
	
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>	

	<script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.10.2.min.js"></script>
	<script type="text/javascript" language="javascript" src="//cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" language="javascript" src="//cdn.datatables.net/plug-ins/9dcbecd42ad/integration/bootstrap/3/dataTables.bootstrap.js"></script>

	<script type="text/javascript" charset="utf8">
		$(document).ready(function(){
			$('#quiz').dataTable({bFilter:false, bSort:false,pageLength:1, aLengthMenu: [[1, 2, 5, 10, -1, "All"], [1, 2, 5,10, "All"]],
			sDom: '<"top"flp>rt<"bottom"i><"clear">',	
			language: {
            lengthMenu:"Display _MENU_ Questions per page",
            info: "Showing Page _PAGE_ of _PAGES_",
            infoEmpty:"No records available",
                }		
			}
			);
		});
		
		$('#quiz')
			.addClass('table table-condesed');

	</script>
	
</body>


</html>
