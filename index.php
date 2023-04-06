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
	<form method="GET" action="scheduleOptions.php">
		<button type="submit">Options</button>
	</form>

	<br>
	<?php

	function helper($item, $action)
	{
		$statement = "";
		require('./backend/connection.php');
		if ($action == "insert") {
			$statement = $conn->prepare("INSERT INTO Events (Item) VALUES (?)");
			$statement->bind_param('s', $item);
		} else if ($action == "remove") {
			$statement = $conn->prepare("DELETE FROM Events WHERE Item=(?)");
		}

		if ($statement != "") {
			$statement->bind_param('s', $item);
			$statement->execute();
		}
	}

	function updateHelper($old, $new)
	{
		$conn = mysqli_connect("oceanus.cse.buffalo.edu:3306", "khlam", "50338576", "cse442_2023_spring_team_p_db");

		$sql_query = "UPDATE ScheduleDatabase (Item) SET ('$new') WHERE (Item) = ('$old')";

		mysqli_query($conn, $sql_query);
		mysqli_close($conn);
	}

	function displayScheduleTest($username)
	{
		require("./backend/connection.php");

		$statement = $conn->prepare("SELECT * FROM Events where Username = (?)");
		if (!$statement) {
			console_log("Error on event display: " . $conn->error);
			return;
		}
		$statement->bind_param('s', $username);
		$statement->execute();
		$result_query = $statement->get_result();

		echo "Schedule: <br>";
		while (($event = mysqli_fetch_assoc($result_query))) {
			echo json_encode($event) . "\n";
		}
	}

	if (!empty($_GET["insert"])) {
		// echo "insert works";
		helper($_GET["insert"], "insert");
	} else if (!empty($_GET["update_current"]) and !empty($_GET["update_new"])) {
		// echo "update works";
		updateHelper($_GET["update_current"], $_GET["update_new"]);
	} else if (!empty($_GET["remove"])) {
		// echo "remove works";
		helper($_GET["remove"], "remove");
	}

	displayScheduleTest($username);


	?>
</body>

</html>
