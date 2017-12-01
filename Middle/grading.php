<?php
	$rcv = file_get_contents('php://input');
	
	$oe = (json_decode($rcv));      	
	
	$NumOE = Sizeof($oe->OEQ);
		
		$answer=array();
		
		
		if ($NumOE > 0)
				{
					for($k=0; $k<$NumOE; $k++) 
						{
							$ans  = $oe->OEQ[$k];
							
							$fh=fopen('/tmp/test.py','w') or die("can't open file");
							fwrite($fh,$ans);
							fclose($fh);
							$command = '/tmp/test.py';
							$a=exec("python2.6 $command",$output);
							if(!empty($a))
							{
								$answer[]=$a;
							}
							else 
							{
							$answer[]='Error';
							}
							
						}
				}
					
		$data = array("answer"=> $answer, "rcv" => $oe);
					
	$all_data = json_encode($data);
	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "http://web.njit.edu/~aps64/cs490/back/grading.php");
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch,CURLOPT_HEADER,0);
	curl_setopt($ch,CURLOPT_POST, 1);
	curl_setopt($ch,CURLOPT_POSTFIELDS,$all_data);
	$result=curl_exec($ch);
	echo $result;
	curl_close($ch);
    //}
?>