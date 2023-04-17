<?php

require('backend/log.php');
require('backend/session.php');
require("backend/user.php");
$username = startSession();
isLoggedIn($username, "index.php");

require('backend/connection.php');
require('backend/head.php');

?>

<!DOCTYPE html>

<head>
	<?php head('Profile Page') ?>
	<link rel="stylesheet" type="text/css" href="css/profile.css" />
</head>

<body>
	<div class="page-top-view">
		<ul class="nav justify-content-center">
			<li>
				<h2 class="logo"> TADA!</h2>
			</li>
		</ul>
	</div>

	<div class="page-container">
		<div class="outlined-box-profile">
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
			$html = <<<"EOT"
					<p>Username: $valueUser</p>
					<p>Email: $valueEmail</p>
					<p>Name: $valueName</p>
					<p>About Me: $valueAboutMe</p>
					<p>Experience 1: $valueExp1</p>
					<p>Experience 2: $valueExp2</p>
					EOT;
			echo $html;
			?>
		</div>
	</div>
</body>

</html>
