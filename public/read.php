<?php

/**
 * Function to query information based on 
 * a parameter: in this case, location.
 *
 */

if (isset($_POST['submit'])) 
{
	
	try 
	{
		
		require "../config.php";
		require "../common.php";

		$connection = new PDO($dsn, $username, $password, $options);

		$sql = "SELECT * 
						FROM questions
						WHERE body like :searchPattern";

		$searchPattern = $_POST['searchPattern'];

		$statement = $connection->prepare($sql);
		$statement->bindParam(':searchPattern', $searchPattern, PDO::PARAM_STR);
		$statement->execute();

		$result = $statement->fetchAll();
	}
	
	catch(PDOException $error) 
	{
		echo $sql . "<br>" . $error->getMessage();
	}
}
?>
<?php require "templates/header.php"; ?>
		
<?php  
if (isset($_POST['submit'])) 
{
	if ($result && $statement->rowCount() > 0) 
	{ ?>
		<h2>Suchresulte</h2>

		<table>
			<thead>
				<tr>
					<th>#</th>
					<th>Frage</th>
					<th>Antwort A</th>
					<th>Antwort B</th>
					<th>Antwort C</th>
					<th>Antwort D</th>
					<th>Korrekte Antwort</th>
					<th>Level</th>
				</tr>
			</thead>
			<tbody>
	<?php 
		foreach ($result as $row) 
		{ ?>
			<tr>
				<td><?php echo escape($row["questionID"]); ?></td>
				<td><?php echo escape($row["body"]); ?></td>
				<td><?php echo escape($row["a"]); ?></td>
				<td><?php echo escape($row["b"]); ?></td>
				<td><?php echo escape($row["c"]); ?></td>
				<td><?php echo escape($row["d"]); ?></td>
				<td><?php echo escape($row["correct"]); ?></td>
				<td><?php echo escape($row["level"]); ?> </td>
			</tr>
		<?php 
		} ?>
		</tbody>
	</table>
	<?php 
	} 
	else 
	{ ?>
		<blockquote>Keine Resultate gefunden für: <?php echo escape($_POST['searchPattern']); ?>.</blockquote>
	<?php
	} 
}?> 

<h2>Suche Fragen, die zu diesem LIKE Pattern passen</h2>

<form method="post">
	<label for="searchPattern">Suchpattern</label>
	<input type="text" id="searchPattern" name="searchPattern">
	<input type="submit" name="submit" value="Zeige Resulte">
</form>

<a href="index.php">Zurück</a>

<?php require "templates/footer.php"; ?>