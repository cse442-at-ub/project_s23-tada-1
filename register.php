<?php
$config = require('./backend/config.php');
require('./backend/log.php');
session_start();

require('./backend/head.php');
require('./backend/user.php');
require('./backend/connection.php');



// define variables and set to empty values
$nameErr = $emailErr = $passwordErr = $usernameErr = "";
$name = $email = $password = $aboutMe = $username = $exp1 = $exp2 = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty($_POST["username"])) {
		$usernameErr = "Username is required";
		console_log("Username not entered");
	} else {
		$username = clean_data($_POST["username"]);

		// Checking for duplicate username
		$statement = $conn->prepare("SELECT * FROM UserData WHERE Username = (?)");
		$statement->bind_param('s', $username);
		$statement->execute();
		$result_query = $statement->get_result();
		console_log($result_query);
		if (mysqli_num_rows($result_query) > 0) {
			$usernameErr = "Username is already taken";
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
	function test_input($data)
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	if (empty($_POST["name"])) {
		$nameErr = "Name is required";
	} else {
		$name = test_input($_POST["name"]);
		// check if name only contains letters and whitespace
		if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
			$nameErr = "Only letters and white space allowed";
		}
	}

	if (empty($_POST["aboutMe"])) {
		$aboutMe = "";
	} else {
		$aboutMe = test_input($_POST["aboutMe"]);
	}

	if (empty($_POST["exp1"])) {
		$exp1 = "";
	} else {
		$exp1 = test_input($_POST["exp1"]);
	}

	if (empty($_POST["exp2"])) {
		$exp2 = "";
	} else {
		$exp2 = test_input($_POST["exp2"]);
	}

	if ($usernameErr == "" && $emailErr == "" && $passwordErr == "") {
		// Makes the password
		// Check password for correct length and characters
		if (insert_user($name, $username, $email, $password, $aboutMe, $exp1, $exp2)) {
			header("Location: $config->root_dir/index.php");
		}
	}
}


?>

<!DOCTYPE HTML>
<html>

<head>
	<?php head('Register Page'); ?>
	<link rel="stylesheet" type="text/css" href="css/style.css" />
</head>

<body>
	<div class="page-top-view">
		<ul class="nav justify-content-center">
			<li>
				<h2 class="logo"> TADA!</h2>
			</li>
		</ul>
	</div>
	<div class='outlined-box-register'>
		<h2 class="login-title">Register Here!</h2>
		<p><span class="error">* required field</span></p>
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
			Name <br>
			<input class="login-info-box" type="text" name="name" value="<?php echo $name; ?>">
			<span class="error">* <?php echo $nameErr; ?></span>
			<br><br>
			Username <br>
			<input class="login-info-box" type="text" name="username" value="<?php echo $username; ?>">
			<span class="error">* <?php echo $usernameErr; ?></span>
			<br><br>
			Email <br>
			<input class="login-info-box" type="text" name="email" value="<?php echo $email; ?>">
			<span class="error">* <?php echo $emailErr; ?></span>
			<br><br>
			Password <br>
			<input class="login-info-box" type="password" name="password" value="<?php echo $password; ?>">
			<span class="error">* <?php echo $passwordErr; ?></span>
			<br><br>
			About Me
			<textarea class="login-info-box" name="aboutMe" rows="5" cols="40"><?php echo $aboutMe; ?></textarea>
			<br><br>
			Experience 1: <textarea class="login-info-box" name="exp1" rows="5" cols="40"><?php echo $exp1; ?></textarea>
			<br><br>
			Experience 2: <textarea class="login-info-box" name="exp2" rows="5" cols="40"><?php echo $exp2; ?></textarea>
			<br><br>
			<input class="base-button green-button" type="submit" name="register" value="Register">
			<br><br>
			Already have an account? Log in <a href="login.php">Here!</a>
		</form>
	</div>
</body>

</html>
