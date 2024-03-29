<?php

require('backend/log.php');
require('backend/session.php');
require("backend/user.php");
$username = startSession();
isLoggedIn($username, "index.php");

require('backend/connection.php');
require('backend/head.php');
require('backend/navbar.php');

?>

<!DOCTYPE html>

<head>
	<?php head('Profile Page') ?>
	<link rel="stylesheet" type="text/css" href="css/profile.css" />
</head>

<body>
	<?php navbar($username) ?>

	<div class="page-container">
		<div class="outlined-box">
			<h1> My Profile </h1>
			<?php
			$query = "SELECT * FROM UserData WHERE `Username` = (?)";
			$statement = $conn->prepare($query);
			$statement->bind_param('s', $username);
			$statement->execute();
			$result = $statement->get_result();

			$row = $result->fetch_assoc();
			$valueUser = $row['Username'];
			$valueEmail = $row['Email'];
			$valueName = $row['Name'];
			$valueAboutMe = $row['AboutMe'];
			$valueExp1 = $row['Experience1'];
			$valueExp2 = $row['Experience2'];
			$valueType = $row['Type'];
			$html = <<<"EOT"
					<p>Username: $valueUser</p>
					<p>Email: $valueEmail</p>
					<p>Name: $valueName</p>
					<p>About Me: $valueAboutMe</p>
					<p>Experience 1: $valueExp1</p>
					<p>Experience 2: $valueExp2</p>
					<p>User Type: $valueType</p>
					EOT;
			echo $html;
			?>
		</div>
	</div>
</body>

</html>
