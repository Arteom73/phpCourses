<html>
<head>
	<meta charset="utf8">
</head>
<body>
<?php
	$users = array(

		1 => array(

			"name" => "Маша",
			"secondName" => "",
			"age" => "",
			"city" => "",
			"photo" => "./images/"

		),
		2 => array(

			"name" => "Таня",
			"secondName" => "",
			"age" => "",
			"city" => "",
			"photo" => "./images/"

		),
		3 => array(

			"name" => "Артем",
			"secondName" => "Овчинников",
			"age" => "19",
			"city" => "Ульяновск",
			"photo" => "./images/artem.png"

		)

	);

	foreach ($users as $value) {
		?>
		<table>
			<tr>
				<td>
					<img src="<?php echo $value["photo"];?>" alt="" />
				</td>
				<td valign="top">
					<h2><?php echo $value["name"] . " " . $value["secondName"];?></h2>
					<ul>
						<li><?php echo $value["city"];?></li>
						<li><?php echo $value["age"];?></li>
					</ul>
				</td>
			</tr>
		</table>
		<?php
	}
?>
</body>
</html>