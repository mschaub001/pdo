<?php

/**
 * Use an HTML form to create a new entry in the
 * users table.
 *
 */


if (isset($_POST['submit']))
{
	
	require "../config.php";
	require "../common.php";

	try 
	{
		$connection = new PDO($dsn, $username, $password, $options);
		
		$new_question = array(
			"body"       => $_POST['body'],
			"a"          => $_POST['a'],
			"b"          => $_POST['b'],
			"c"          => $_POST['c'],
			"d"          => $_POST['d'],
			"correct"    => $_POST['correct'],
			"level"          => $_POST['level'],
		);

		$sql = sprintf(
				"INSERT INTO %s (%s) values (%s)",
				"questions",
				implode(", ", array_keys($new_question)),
				":" . implode(", :", array_keys($new_question))
		);
		
		$statement = $connection->prepare($sql);
		$statement->execute($new_question);
	}

	catch(PDOException $error) 
	{
		echo $sql . "<br>" . $error->getMessage();
	}
	
}
?>

<?php require "templates/header.php"; ?>

<?php 
if (isset($_POST['submit']) && $statement) 
{ ?>
	<blockquote>Frage erfolgreich eingefügt</blockquote>
<?php 
} ?>

<h2>Eine Frage hinzufügen</h2>

<form method="post">
	<label for="body">Frage</label>
	<input type="text" name="body" id="body">
	<label for="a">Antwort A</label>
	<input type="text" name="a" id="a">
	<label for="b">Antwort B</label>
	<input type="text" name="b" id="b">
	<label for="c">Antwort C</label>
	<input type="text" name="c" id="c">
	<label for="d">Antwort D</label>
	<input type="text" name="d" id="d">
	<label for="correct">Korrekte Antwort (1-4)</label>
	<input type="text" name="correct" id="correct">
	<label for="level">Level</label>
	<input type="text" name="level" id="level">
	<input type="submit" name="submit" value="Submit">
</form>

<a href="index.php">Zurück</a>

<?php require "templates/footer.php"; ?>