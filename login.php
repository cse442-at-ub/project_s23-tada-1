<?php
require('backend/log.php');
require('backend/session.php');
$username = startSession();
if ($username != "") {
	echo '<meta http-equiv="refresh" content="0; URL=index.php">';
}

require('backend/connection.php');
require('backend/user.php');
require('backend/head.php');
require('backend/navbar.php');

$nameErr = $passwordErr = $generalErr = "";
$name = $password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty($_POST["username"])) {
		$nameErr = "Name is required";
	} else {
		$name = clean_data($_POST["username"]);
		// check if name only contains letters and whitespace
	}

	if (empty($_POST["password"])) {
		$passwordErr = "Password is required";
	} else {
		// Makes the password
		$password = clean_data($_POST["password"]);
	}

	if ($nameErr == "" && $passwordErr == "") {
		// Retrieve data from database
		$statement = $conn->prepare("SELECT * FROM UserData WHERE Username = (?)");
		$statement->bind_param('s', $name);
		$statement->execute();
		$result_query = $statement->get_result();
		console_log($result_query);
		if ($result_query == FALSE) {
			console_log("Database error: " . mysqli_error($conn));
		} else {
			$row = mysqli_fetch_assoc($result_query);
			if (password_verify($password, $row["Password"])) {
				console_log("Verified user: '$name'");
				$_SESSION["username"] = $name; // Save username as session variable to be accessed on other pages
				$_SESSION["type"] = $row["Type"];
				error_log("Setting user variable");
				echo '<meta http-equiv="refresh" content="0; URL=index.php">';
			} else {
				$generalErr = "Info is incorect";
			}
		}
	}

	// Closes the connection
	mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html>

<head>
	<?php head('Login Page'); ?>
	<link rel="stylesheet" href="css/login.css">
</head>

<body>
	<!-- Navigation -->
	<?php navbar("") ?>

	<div class='outlined-box'>
		<h2 class="login-title"> Login </h2>
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
			Username <br>
			<input class="login-info-box" type="text" name="username" value="<?php echo $name; ?>">
			<span class="error">* <?php echo $nameErr; ?></span>
			<br><br>
			Password <br>
			<input class="login-info-box" type="password" name="password" value="<?php echo $password; ?>">
			<span class="error">* <?php echo $passwordErr; ?></span>
			<br><br>
			<span class="error"><?php echo $generalErr; ?></span>
			<input class="base-button green-button" type="submit" name="login" value="Login">
			<br><br>
			Don't have an account? Sign Up <a href="register.php">Here!</a>
		</form>
	</div>
</body>

</html>
