<?php
$config = require('./backend/config.php');
require('./backend/log.php');
session_start();

require('./backend/head.php');
require('./backend/user.php');
require('./backend/connection.php');



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
		$result_query = $statement->get_result();
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
			$passwordErr = 'Password should be at least 8 characters in length and should require at least one upper case letter, one number, and one special character.';
			console_log("Invalid password format");
		}
	}


	if ($nameErr == "" && $emailErr == "" && $passwordErr == "") {
		// Makes the password
		// Check password for correct length and characters
		if (insert_user($name, $email, $password)) {
			header("Location: $config->root_dir/index.php");
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
