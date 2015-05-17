<html>
<head>
	<meta charset="utf8">
</head>
<body>
<?php
	
	$string = "";

	$fp = fopen("text.txt", "r");
	if ($fp) {
		while (!feof($fp)) {
			$mytext = fgets($fp, 999);
			$string .= $mytext;
			echo iconv('windows-1251', 'UTF-8', $mytext) . "<br />";
		}
	} else echo "Ошибка при открытии файла";
	fclose($fp);

	$vowels = array(",", ".", "!", "?", ":", ";", "\"", "'", "(", ")", "\n", "\r");
	$string = iconv('windows-1251', 'UTF-8', mb_strtolower(trim(str_replace($vowels, " ", $string))));
	while ( strpos($string, "  ") !== false ) {

	   $string = str_replace("  ", " ", $string);

	 };

	$words = explode(" ", $string);

	$dictionary = array();

	for ($i=0; $i < count($words); $i++) { 
		
		if ($dictionary[$words[$i]]) {
			$dictionary[$words[$i]] += 1;
		} else {
			$dictionary[$words[$i]] = 1;
		}

	}

	echo "<br/><b>Словарь:</b><br/><br/>";

	foreach ($dictionary as $key => $value) {
		echo $key . " = " . $value . "<br/>";
	}

?>
</body>
</html>