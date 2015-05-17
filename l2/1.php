<?php
	
	$string = "QWERTYUIOPASDFGHJKLqwertyuiopasdfghjkl1234567890";

	$a = 20;

	$string2 = "";

	for ($i=0; $i < $a; $i++) { 
		
		$string2 .= $string[rand ( 0 , strlen($string) - 1 )];

	}

	echo $string2;

?>