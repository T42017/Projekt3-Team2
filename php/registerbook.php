<!DOCTYPE html>
	
<html>
	<head>
		<title>
			Register books	
		</title>
	</head>

	<body>
		<?php require 'dbconnection.php'; ?>

		<table>
			<form action="registerbook.php" method="post">
				<tr>
					<td>
						<label for="isbn">
							ISBN
						</label>
					</td>
					
					<td>
						<input type="text" name="isbn">
					</td>
				</tr>

				<tr>
					<td>
						<label for="title">
							Title
						</label>
					</td>
					
					<td>
						<input type="text" name="title">
					</td>
				</tr>

				<tr>
					<td>
						<label for="language">
							Language
						</label>
					</td>
					
					<td>
						<input type="text" name="language">
					</td>
				</tr>

				<tr>
					<td>
						<label for="year">
							Release year
						</label>
					</td>
					
					<td>
						<input type="date" name="year">
					</td>
				</tr>

				<td>
					<input type="submit" value="Submit">
				</td>
			</form>
		</table>
	</body>

	<?php

	if (isset($_POST["isbn"]) && isset($_POST["title"]) && isset($_POST["language"]) && isset($_POST["year"])) {
		$isbn = $_POST["isbn"];
		$title = $_POST["title"];
		$language = $_POST["language"];
		$release_year = $_POST["year"];

		echo "isbn: $isbn<br />title: $title<br />language: $language<br />release year: $release_year";
	}
	else {
		echo "Please fill out form.<br />";
	}

	?>
</html>