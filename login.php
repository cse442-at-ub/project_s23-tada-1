<?php
require('./backend/log.php');
session_start();

require('./backend/connection.php');
require('./backend/user.php');
require('./backend/head.php');


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
</head>

<body>
	<h2> Login Page </h2>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
		Username: <input type="text" name="username" value="<?php echo $name; ?>">
		<span class="error">* <?php echo $nameErr; ?></span>
		<br><br>
		Password: <input type="password" name="password" value="<?php echo $password; ?>">
		<span class="error">* <?php echo $passwordErr; ?></span>
		<br><br>
		<span class="error"><?php echo $generalErr; ?></span>
		<br><br>
		<input type="submit" name="login" value="Login">
	</form>
</body>

</html>
