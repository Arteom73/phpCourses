<html>
<head>
	<meta charset="utf8">
</head>
<body>

<?php

require "Class.php";

$text = New Word;
$text->setText("text.txt");

echo $text->getText();
echo "<br><br>";
echo $text->current();
echo "<br><br>";
$text->next();
echo $text->current();
echo "<br><br>";
$text->next();
echo $text->current();
echo "<br><br>";
$text->reset();
echo $text->current();
echo "<br><br>";
$text->next();
echo $text->current();
$text->reset();
echo "<br><br>";

while($text->ifNext()) {
	echo $text->current() . " ";
	$text->next();
}

?>

</body>
</html>