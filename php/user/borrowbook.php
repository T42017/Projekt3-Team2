<!DOCTYPE html>

<html>
	<head>
		<title>
			Borrow book
		</title>
	</head>
	
	<body>

		<?php require 'dbconnection.php'; ?>

		<table>
			<th>
				Social security number
			</th>

			<th>
				First name
			</th>

			<th>
				Last name
			</th>

		<?php

		$stmt = $db->query('SELECT * FROM users');

		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			echo "<tr>";
			echo "<td>" . $row["social_security_number"] . "</td>";
			echo "<td>" . $row["first_name"] . "</td>";
			echo "<td>" . $row["last_name"] . "</td>";
			echo "</tr>";
		}

		?>

		</table>
	</body>
</html>