<?php
$config = require('./backend/config.php');
require('./backend/log.php');
require('./backend/session.php');
$username = startSession();

require('./backend/connection.php');
require('./backend/head.php');

console_log("Running on " . php_sapi_name());
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
		if ($username != "") {
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


	<!-- // This is where the schedule and options are -->
	<form method="GET" action="mySchedule.php">
		<button type="submit">My Schedule</button>
	</form>
	<br>
</body>

</html>
