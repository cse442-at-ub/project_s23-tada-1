<!DOCTYPE HTML>
<html>

<head>
	The My Schedules Page
	<style>
		table,
		th,
		td {
			border: 1px solid black;
			border-collapse: collapse;
		}

		td:nth-child(even),
		th:nth-child(even) {
			background-color: #ffcccc;
		}
	</style>
</head>

<body>
	<?php
	/*
        Starts a session
        Starting a session stores a key on the users browser that persists until the browser is closed.
        Session variables can then be set on the server associated with the users session and can be accessed across all pages, or multiple PHP files.
        Very convenient system.
    */
	session_start();

	#commit message git commit -m "First try at displaying any content for the schedle
 #40" -m 
	include('./backend/connection.php');
	include('./database/eventDisplay.php');

	//echo "hello";

	if (isset($_SESSION["username"]) && !empty($_SESSION["username"])) {
		$username = $_SESSION["username"];
		$funcList = listDisplayEvents($username); #raw info

		//print_r($funcList);
		for($day = 0; $day < sizeof($funcList); $day++){
			$dayList = $funcList[$day];
			//echo $dayList . "\n";
			for($event = 0; $event < count($dayList); $event++){
				echo "Day no. : " . $day . " -- " . "Event: " . $funcList[$day][$event]['Class'];
				echo "<br>";
			}
		}
	}

	?>
	<h1>My Schedule<h1>
			<button type="button">Edit Schedule</button>
			<h4> Filters:<h4>
					<select name="Class" id="class">
						<option value="cse101">Class</option>
						<option value="cse101">CSE 101</option>
						<option value="cse115">CSE 115</option>
						<option value="cse220">CSE 220</option>
						<option value="cse250">CSE 250</option>
					</select>
					<select name="EventType" id="event-type">
						<option value="lecture">Event Type</option>
						<option value="lecture">Lecture</option>
						<option value="office-hours">Office Hours</option>
						<option value="recitation">Recitation</option>
					</select>
					<table>
						<tr>
							<th>Time</th>
							<th>Monday</th>
							<th>Tuesday</th>
							<th>Wednesday</th>
							<th>Thursday</th>
							<th>Friday</th>
						</tr>
						<tr>
							<th>8am</th>
							<th> </th>
							<th> </th>
							<th> </th>
							<th> </th>
							<th> </th>
						</tr>
						<tr>
							<th>9am</th>
							<th>CSE 115 Recitation</th>
							<th> </th>
							<th>CSE 115 Recitation</th>
							<th> </th>
							<th>CSE 115 Recitation</th>
						</tr>
						<tr>
							<th>10am</th>
							<th> CSE 115 Recitation</th>
							<th> </th>
							<th> CSE 115 Recitation</th>
							<th> </th>
							<th> CSE 115 Recitation</th>
						</tr>
						<tr>
							<th>11am</th>
							<th> </th>
							<th> </th>
							<th> </th>
							<th> </th>
							<th> </th>
						</tr>
						<tr>
							<th>12pm</th>
							<th> </th>
							<th> </th>
							<th> </th>
							<th> </th>
							<th> </th>
						</tr>
						<tr>
							<th>1pm</th>
							<th> </th>
							<th> CSE 220 Lab</th>
							<th> </th>
							<th> CSE 220 Lab</th>
							<th> </th>
						</tr>
						<tr>
							<th>2pm</th>
							<th> </th>
							<th> </th>
							<th> </th>
							<th> </th>
							<th> </th>
						</tr>
						<tr>
							<th>3pm</th>
							<th>CSE 312 Class </th>
							<th> </th>
							<th>CSE 312 Class </th>
							<th> </th>
							<th>CSE 312 Class </th>
						</tr>
						<tr>
							<th>4pm</th>
							<th> </th>
							<th> </th>
							<th> </th>
							<th> </th>
							<th> </th>
						</tr>
						<tr>
							<th>5pm</th>
							<th> </th>
							<th> </th>
							<th> </th>
							<th> </th>
							<th> </th>
						</tr>
					</table>
</body>

</html>
