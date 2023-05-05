<?php
require('backend/log.php');
require('backend/session.php');
require('backend/user.php');
$username = startSession();
isLoggedIn($username, "index.php");
if (!isProfessor()) {                                      // If user type isn't professor
	echo '<meta http-equiv="refresh" content="0; URL=index.php">';      // redirect to home page
}

require('backend/head.php');
require('backend/navbar.php');
?>

<!DOCTYPE html>
<html>

<head>
	<?php head("Create Job"); ?>
	<link rel="stylesheet" type="text/css" href="css/jobCreator.css" />
</head>

<body>
	<?php navbar($username) ?>
	<div class="outlined-box" id="create-app-container">
		<h2 class="title">Create Job</h2>
		<form method="POST" action="database/createJob.php">
			<label for="Title">Title: </label>
			<input class="info-box" type="text" name="Title">
			<label for="Description">Description: </label>
			<input class="info-box" type="text" name="Description" maxlength="150">
			<button type="submit" class="base-button green-button">Post Job</button>
		</form>
	</div>
</body>

</html>
