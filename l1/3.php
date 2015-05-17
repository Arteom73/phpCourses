<html>
<head>
	<meta charset="utf8">
</head>
<body>
<?php

	$a = 0;
	$b = 1000;
	$start = microtime(true);
	for ($i = $a; $i <= $b; $i++) {
		$d = 0;
        for ($j = 1; $j <= $i; $j++) {
            if ($i % $j == 0)
                $d++;
        };
        if ($d <= 2)
            echo $i . ", ";
	}
	echo "<br/>Время выполнения скрипта: ".(microtime(true) - $start) . "<br/><br/>";
	$start = microtime(true);
	for ($i = $a; $i <= $b; $i += 2) {
		if ($i % 2 == 0) {
			$i++;
		};
		$d = 0;
        for ($j = 1; $j <= $i; $j++) {
            if ($i % $j == 0)
                $d++;
        };
        if ($d <= 2)
            echo $i . ", ";
	}
	echo "<br/>Время выполнения скрипта: ".(microtime(true) - $start);

?>
</body>
</html>