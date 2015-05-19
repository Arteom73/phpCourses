<html>
<head>
	<meta charset="utf8">
</head>
<body>


<?php

$lines = file("text.txt");


foreach ($lines as  $line) {
    echo htmlspecialchars($line) . "<br />\n";
}
?>
 <br> <br> <b>Строки сосстоящие только из цифр:</b> <br> <br>
 <?php
foreach ($lines as  $line) {

	if (intval(htmlspecialchars($line)))
    echo htmlspecialchars($line) . "<br />\n";
}
?>

	


</body>
</html>