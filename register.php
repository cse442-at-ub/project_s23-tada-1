<?php
$config = include('./backend/config.php');
include('./backend/head.php');
include('./backend/user.php');
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
		$nameErr = "Name is required";
	} else {
		$name = clean_data($_POST["username"]);
	}

	if (empty($_POST["email"])) {
		$emailErr = "Email is required";
	} else {
		$email = clean_data($_POST["email"]);
		// check if e-mail address is well-formed
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$emailErr = "Invalid email format";
		}
	}

	// Checks if password was entered empty
	if (empty($_POST["password"])) {
		$passwordErr = "Password is required";
	} else {
		// Makes the password
		$password = clean_data($_POST["password"]);
		// Check password for correct length and characters
		if (test_password($password)) {
			insert_user($name, $email, $password);
			header("Location: $config->root_dir/index.php");
		} else {
			$passwordErr = 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
		}
	}
}
?>

<!DOCTYPE HTML>
<html>

<head>
	<?php head('Register Page'); ?>
</head>

<body>
	<h2>register here !</h2>
	<p><span class="error">* required field</span></p>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
		Username: <input type="text" name="username" value="<?php echo $name; ?>">
		<span class="error">* <?php echo $nameErr; ?></span>
		<br><br>
		Email: <input type="text" name="email" value="<?php echo $email; ?>">
		<span class="error">* <?php echo $emailErr; ?></span>
		<br><br>
		Password: <input type="password" name="password" value="<?php echo $password; ?>">
		<span class="error">* <?php echo $passwordErr; ?></span>
		<br><br>
		<input type="submit" name="register" value="Register">
	</form>
</body>

</html>
