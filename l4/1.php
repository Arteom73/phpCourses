<html>
<head>
	<meta charset="utf8">
</head>
<body>

<?php
$user = 'root';
$pass = '';
$db = new PDO('mysql:host=localhost;dbname=addresses', $user, $pass, array(PDO::ATTR_PERSISTENT => true));
$stmt = $db->query("SELECT * FROM country ORDER BY name ASC");
while ($row = $stmt->fetch(PDO::FETCH_NAMED)){
	echo $row["name"];
	
	$city = $db->prepare('SELECT * FROM city WHERE pid=?');
	$city->execute(array($row["id"]));
	
	echo "<br/>";
	
	while ($row = $city->fetch(PDO::FETCH_NAMED)){
		echo "<div style=\"padding-left:15px;\">";
		echo $row["name"];
	
		$street = $db->prepare('SELECT * FROM street WHERE pid=?');
		$street->execute(array($row["id"]));
		
		while ($row = $street->fetch(PDO::FETCH_NAMED)){
			echo "<div style=\"padding-left:15px;\">";
			echo $row["name"];
		
			$home = $db->prepare('SELECT * FROM home WHERE pid=?');
			$home->execute(array($row["id"]));
			
			while ($row = $home->fetch(PDO::FETCH_NAMED)){
				echo "<div style=\"padding-left:15px;\">";
				echo $row["number"];
				echo "</div>";
			}
			echo "</div>";
		}
		echo "</div>";
	}
}

if ($_POST["addCountry"] && $_POST["name"] != "") {
	$sql = $db->prepare("INSERT INTO country(name) VALUES (:name)");
	$sql->bindParam(':name',$_POST["name"]);
	$sql->execute();
}

if ($_POST["addCity"] && $_POST["name"] != "") {
	$sql = $db->prepare("INSERT INTO city(pid, name) VALUES (:pid, :name)");
	$sql->bindParam(':pid',$_POST["country"]);
	$sql->bindParam(':name',$_POST["name"]);
	$sql->execute();
}
if ($_POST["addStreet"] && $_POST["step1"] == 3 && $_POST["name"] != "") {
	$sql = $db->prepare("INSERT INTO street(pid, name) VALUES (:pid, :name)");
	$sql->bindParam(':pid',$_POST["city"]);
	$sql->bindParam(':name',$_POST["name"]);
	$sql->execute();
}
if ($_POST["addHome"] && $_POST["step2"] == 4 && $_POST["number"] > 0) {
	$sql = $db->prepare("INSERT INTO home(pid, number) VALUES (:pid, :number)");
	$sql->bindParam(':pid',$_POST["street"]);
	$sql->bindParam(':number',$_POST["number"]);
	$sql->execute();
}
if ($_POST["step1"])
	$step1 = $_POST["step1"];
else
	$step1 = 1;
if ($_POST["step2"])
	$step2 = $_POST["step2"];
else
	$step2 = 1;
?>
<br/><br/>
<form action="/l4/1.php" method="post">
	Добавить страну<br/>
	<input name="name" type="text" placeholder="Введите название" />
	<br/>
	<input type="hidden" name="addCountry" value="true" />
	<input type="submit" value="Добавить" />
</form>
<form action="/l4/1.php" method="post">
	Добавить город<br/>
	<select name="country">
		<option>Выберите страну</option>

		<?php
			$c1 = $db->query("SELECT * FROM country ORDER BY name ASC");
			while ($row = $c1->fetch(PDO::FETCH_NAMED)){
				echo "<option value=\"" . $row["id"] ."\">".$row["name"]."</option>";
			}
		?>
	</select>
	<br/>
	<input name="name" type="text" placeholder="Введите название" />
	<br/>
	<input type="hidden" name="addCity" value="true" />
	<input type="submit" value="Добавить" />
</form>
<form action="/l4/1.php" method="post">
	Добавить улицу<br/>
	<?php if ($step1 == 1):?>
		<select name="country">
			<option>Выберите страну</option>

			<?php
				$c2 = $db->query("SELECT * FROM country ORDER BY name ASC");
				while ($row = $c2->fetch(PDO::FETCH_NAMED)){
					echo "<option value=\"" . $row["id"] ."\">".$row["name"]."</option>";
				}
			?>
		</select>
	<?php elseif ($step1 == 2):?>
		<select name="city">
			<option>Выберите город</option>

			<?php
				$c3 = $db->prepare("SELECT * FROM city WHERE pid = ? ORDER BY name ASC");
				$c3->execute(array($_POST["country"]));
				while ($row = $c3->fetch(PDO::FETCH_NAMED)){
					echo "<option value=\"" . $row["id"] ."\">".$row["name"]."</option>";
				}
			?>
		</select>
		<br/>
		<input name="name" type="text" placeholder="Введите название" />
	<?php endif;?>
	<br/>
	<input type="hidden" name="step1" value="<?=++$step1?>" />
	<input type="hidden" name="addStreet" value="true" />
	<input type="submit" value="Далее" />
</form>
<form action="/l4/1.php" method="post">
	Добавить дом<br/>
	<?php if ($step2 == 1):?>
		<select name="country">
			<option>Выберите страну</option>

			<?php
				$c4 = $db->query("SELECT * FROM country ORDER BY name ASC");
				while ($row = $c4->fetch(PDO::FETCH_NAMED)){
					echo "<option value=\"" . $row["id"] ."\">".$row["name"]."</option>";
				}
			?>
		</select>
	<?php elseif ($step2 == 2):?>
		<select name="city">
			<option>Выберите город</option>

			<?php
				$c5 = $db->prepare("SELECT * FROM city WHERE pid = ? ORDER BY name ASC");
				$c5->execute(array($_POST["country"]));
				while ($row = $c5->fetch(PDO::FETCH_NAMED)){
					echo "<option value=\"" . $row["id"] ."\">".$row["name"]."</option>";
				}
			?>
		</select>
	<?php elseif ($step2 == 3):?>
		<select name="street">
			<option>Выберите улицу</option>

			<?php
				$c6 = $db->prepare("SELECT * FROM street WHERE pid = ? ORDER BY name ASC");
				$c6->execute(array($_POST["city"]));
				while ($row = $c6->fetch(PDO::FETCH_NAMED)){
					echo "<option value=\"" . $row["id"] ."\">".$row["name"]."</option>";
				}
			?>
		</select>
		<br/>
		<input name="number" type="text" placeholder="Введите номер" />
	<?php endif;?>
	<br/>
	<input type="hidden" name="step2" value="<?=++$step2?>" />
	<input type="hidden" name="addHome" value="true" />
	<input type="submit" value="Далее" />
</form>
</body>
</html>