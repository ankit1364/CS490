<?php
	$rcv = file_get_contents('php://input');
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "http://web.njit.edu/~aps64/cs490/back/questions.php");
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch,CURLOPT_HEADER,0);
	curl_setopt($ch,CURLOPT_POST, 1);
	curl_setopt($ch,CURLOPT_POSTFIELDS,$rcv);
	$result=curl_exec($ch);
	echo $result;
	curl_close($ch);
    //}
?>