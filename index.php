<?php
include('./backend/connection.php');
include('./backend/log.php');
include('./backend/head.php');
$config = include('./backend/config.php');
console_log("Running on " . php_sapi_name());

/*
        Starts a session
        Starting a session stores a key on the users browser that persists until the browser is closed.
        Session variables can then be set on the server associated with the users session and can be accessed across all pages, or multiple PHP files.
        Very convenient system.
*/
session_start();
?>
<!DOCTYPE html>
<html>

<head>
	<?php head('TA Developers Asc., Ind Inc LLC'); ?>
</head>

<body>
	<h1>TA Developers Asc., Ind Inc LLC</h1>
	<p>Hello World!</p>
	<form method="GET" action="register.php">
		<button type="submit">Register</button>
	</form>
	<form method="GET" action="login.php">
		<button type="submit">Login</button>
	</form>
	<div class="welcome-message">
		<?php
		// If user has logged in during the session, display welcome message
		if (isset($_SESSION["username"]) && !empty($_SESSION["username"])) {
			$username = $_SESSION["username"];
			console_log("User logged in: $username");
			echo "Hello, $username";
		}
		?>
		<br><br>
	</div>

	<?php
	// Retrieving usernames
	$result = mysqli_query($conn, "SELECT Username FROM UserData");
	mysqli_close($conn);

	echo "<table border='1'>
                <tr>
		<th>Username</th>
                </tr>";
	while ($row = mysqli_fetch_assoc($result)) {
		echo "<tr>";
		echo "<td>" . $row["Username"] . "</td>";
		echo "</tr>";
	}
	echo "</table>";
	?>
</body>

</html>
