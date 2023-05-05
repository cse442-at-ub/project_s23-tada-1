<?php
$config = require('backend/config.php');
require('backend/log.php');
require('backend/session.php');
$username = startSession();

require('backend/connection.php');
require('backend/head.php');
require('backend/navbar.php');

console_log("Running on " . php_sapi_name());
?>

<!DOCTYPE html>
<html>

<head>
	<?php head('TA Developers Asc., Ind Inc LLC'); ?>
</head>

<body>
	<?php navbar($username) ?>
	<div class="page-header">
		<h1>Teaching Assistant Developers Association</h1>
		<div class="button-container">
			<form method="GET" action="register.php">
				<button type="submit" class="base-button green-button">Register</button>
			</form>
			<form method="GET" action="login.php">
				<button type="submit" class="base-button green-button">Login</button>
			</form>
		</div>
		<div class="welcome-message">
			<?php
			// If user has logged in during the session, display welcome message
			if ($username != "") {
				echo "Hello, $username";
			}
			?>
		</div>
	</div>

	<!-- <?php
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
	?> -->

	<?php
	if (!empty($_GET["application_name"]) and !empty($_GET["application_experience"]) and !empty($_GET["application_reason"])) {
		echo "<h2>Congratulations Application Submitted</h2>";


		$app_name = htmlspecialchars($_GET["application_name"]);
		$app_experience = htmlspecialchars($_GET["application_experience"]);
		$app_reason = htmlspecialchars($_GET["application_reason"]);
		$app_id = $_GET["getId"];
		settype($app_id, "integer");
		// console_log(gettype($app_id));

		//   Testing
		// echo "Name: ";
		// echo $app_name;
		// echo "<br>";
		// echo "Experience: ";
		// echo $app_experience; 
		// echo "<br>";
		// echo "Why you want this job: ";
		// echo $app_reason; 

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
	<br>
</body>

</html>
