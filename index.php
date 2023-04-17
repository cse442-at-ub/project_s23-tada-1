<?php
$config = require('backend/config.php');
require('backend/log.php');
require('backend/session.php');
$username = startSession();

require('backend/connection.php');
require('backend/head.php');

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
	// mysqli_close($conn);

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

	<?php
	if (!empty($_GET["application_name"]) and !empty($_GET["application_experience"]) and !empty($_GET["application_reason"])) {
		echo "<h2>Congratulations Application Submitted</h2>";
		// 	echo "Name: ";
		// 	echo $_GET["application_name"];
		// 	echo "<br>";
		// 	echo "Experience: ";
		// 	echo $_GET["application_experience"]; 
		// 	echo "<br>";
		// 	echo "Why you want this job: ";
		// 	echo $_GET["application_reason"]; 


		$app_name = $_GET["application_name"];
		$app_experience = $_GET["application_experience"];
		$app_reason = $_GET["application_reason"];
		$app_id = $_GET["getId"];
		settype($app_id, "integer");
		// console_log(gettype($app_id));

		// $query = "INSERT INTO JobApp (id, Name, Experience, Reason) VALUES (?, ?, ?, ?)";
		$statement = $conn->prepare("INSERT INTO JobApp (id, Name, Experience, Reason) VALUES (?, ?, ?, ?)");
		$statement->bind_param('isss', $app_id, $app_name, $app_experience, $app_reason);
		$statement->execute();
		if (mysqli_error($conn)) {
			console_log("Error: " . mysqli_error($conn));
		}
		mysqli_close($conn);
	}
	?>

	<!-- // This is where the schedule and options are -->
	<form method="GET" action="mySchedule.php">
		<button type="submit">My Schedule</button>
	</form>
	<br>
</body>

</html>
