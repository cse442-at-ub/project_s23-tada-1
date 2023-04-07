<?php
$config = include('./backend/config.php');
include('./backend/log.php');
include('./backend/head.php');
include('./backend/user.php');
include('./backend/connection.php');
/*
    sessions_start(): Starts a session
    Starting a session stores a key on the users browser that persists until the browser is closed.
    Session variables can then be set on the server associated with the users session and can be accessed across all pages, or multiple PHP files.
    Very convenient system.
*/
session_start();


// define variables and set to empty values
$nameErr = $emailErr = $passwordErr = "";
$name = $email = $password = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty($_POST["username"])) {
		$nameErr = "Username is required";
		console_log("Username not entered");
	} else {
		$name = clean_data($_POST["username"]);

		// Checking for duplicate username
		$statement = $conn->prepare("SELECT * FROM UserData WHERE Username = (?)");
		$statement->bind_param('s', $name);
		$statement->execute();
		$result_query = $statement->get_result();;
		console_log($result_query);
		if (mysqli_num_rows($result_query) > 0) {
			$nameErr = "Username is already taken";
			$data = $result_query->fetch_assoc()['Username'];
			console_log("Attempted login with existing username: $data");
		}
	}

	if (empty($_POST["email"])) {
		$emailErr = "Email is required";
		console_log("Email not provided");
	} else {
		$email = clean_data($_POST["email"]);
		// check if e-mail address is well-formed
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$emailErr = "Invalid email format";
			console_log("Invalid email format");
		}
	}

	// Checks if password was entered empty
	if (empty($_POST["password"])) {
		$passwordErr = "Password is required";
		console_log("Password not provided");
	} else {
		$password = clean_data($_POST["password"]);
		if (!test_password($password)) {
			$passwordErr = 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
			console_log("Invalid password format");
		}
	}


	if ($nameErr == "" && $emailErr == "" && $passwordErr == "") {
		// Makes the password
		// Check password for correct length and characters
		insert_user($name, $email, $password);
		header("Location: $config->root_dir/index.php");
	}
}
?>

<!DOCTYPE HTML>
<html>

<head>
	<?php head('Register Page'); ?>
	<link  rel="stylesheet" type="text/css" href="css/style.css" />
</head>

<body>
	<div class="page-top-view">
		<ul class="nav justify-content-center">
			<li> <h2 class="logo"> TADA!</h2> </li>
		</ul>
  	</div>
	
	<div class='outlined-box-register'>
		<h2 class="login-title">Register Here!</h2>
		<p><span class="error">* required field</span></p>
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
			Username <br>
			<input class="login-info-box" type="text" name="username" value="<?php echo $name; ?>">
			<span class="error">* <?php echo $nameErr; ?></span>
			<br><br>
			Email<br>
			<input class="login-info-box" type="text" name="email" value="<?php echo $email; ?>">
			<span class="error">* <?php echo $emailErr; ?></span>
			<br><br>
			Password<br>
			<input class="login-info-box" type="password" name="password" value="<?php echo $password; ?>">
			<span class="error">* <?php echo $passwordErr; ?></span>
			<br><br>
			<input class="login-button" type="submit" name="register" value="Register">
			<br><br>
			Already have an account? Log in <a href="login.php">Here!</a>
		</form>
	</div>
</body>

</html>
