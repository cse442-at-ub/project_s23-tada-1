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
</head>

<body>
	<?php navbar($username) ?>
	<div id="create-app-container">
		<h2>Create Job</h2>
		<form method="POST" action="database/createJob.php">
			<label for="Title">Title: </label>
			<input type="text" name="Title">
			<label for="Description">Description: </label>
			<input type="text" name="Description" maxlength="150">
			<button type="submit" class="base-button green-button">Post Job</button>
		</form>
	</div>

</body>

</html>
