<?php
include('./backend/connection.php');
include('./backend/user.php');
include('./backend/log.php');
include('./backend/head.php');
/*
	session_start(): Starts a session
	Starting a session stores a key on the users browser that persists until the browser is closed.
	Session variables can then be set on the server associated with the users session and can be accessed across all pages, or multiple PHP files.
	Very convenient system.
*/
session_start();

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
		$userData = "SELECT * FROM UserData WHERE Username = '$name'";
		$result_query = mysqli_query($conn, $userData);
		console_log($result_query);
		if ($result_query == FALSE) {
			console_log("Database error: " . mysqli_error($conn));
		} else {
			$row = mysqli_fetch_assoc($result_query);
			if (password_verify($password, $row["Password"])) {
				console_log("Verified user: '$name'");
				$_SESSION["username"] = $name; // Save username as session variable to be accessed on other pages
				error_log("Setting user variable");
				header("Location: $config->root_dir/index.php");   // Redirect to landing page
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
	<link  rel="stylesheet" type="text/css" href="css/style.css" />
</head>

<body>
	<!-- Navigation -->
	<div class="page-top-view">
		<ul class="nav justify-content-center">
			<li> <h2 class="logo">TADA!</h2> <li>
		</ul>
  	</div>
	
	
	<div class='outlined-box-login' >
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
			<br><br>
			<input class="login-button" type="submit" name="login" value="Login">
			<br><br>
			Don't have an account? Sign Up <a href="register.php">Here!</a>
		</form>
	</div>
</body>

</html>
