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


	<!-- // This is where the schedule and options are -->
	<form method="GET" action="scheduleOptions.php">
	<button type="submit">Options</button>
	</form>

	<br>
	<?php

	function helper($item, $action){

		$conn = mysqli_connect("oceanus.cse.buffalo.edu:3306", "khlam", "50338576", "cse442_2023_spring_team_p_db");
		
		if ($action == "insert"){
		$sql_query = "INSERT INTO ScheduleDatabase (Item) VALUES ('$item')";
		}
		else if($action == "remove"){
		$sql_query = "DELETE FROM ScheduleDatabase WHERE Item='$item'";
		}

		mysqli_query($conn, $sql_query);
		mysqli_close($conn);
	}

	if (!empty($_GET["insert"])){
		// echo "insert works";
		helper($_GET["insert"], "insert")
	  }
	  else if (!empty($_GET["update_current"]) and !empty($_GET["update_new"])){
		echo "update works";
	  }
	  else if (!empty($_GET["remove"])){
		// echo "remove works";
		helper($_GET["remove"], "remove")
	  }
	
	  $conn = mysqli_connect("oceanus.cse.buffalo.edu:3306", "khlam", "50338576", "cse442_2023_spring_team_p_db");
	  $sql_query = "SELECT Item FROM ScheduleDatabase";
	  $schedule = mysqli_query($conn, $sql_query);
	
	  echo "Schedule: <br>";
	  foreach ($schedule as $n){
		echo "$n <br>";
	  }
	?>
</body>

</html>
