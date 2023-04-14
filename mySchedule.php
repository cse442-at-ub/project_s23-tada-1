<!DOCTYPE HTML>
<html>

<head>
	<h1>The Schedules Page !!!!!</h1>
	<style>
		table,
		th,
		td {
			border: 1px solid black;
			border-radius: 10px;
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
	// include('./backend/log.php');
	include('./database/eventDisplay.php');

	//echo "hello";

	if (isset($_SESSION["username"]) && !empty($_SESSION["username"])) {
		$username = $_SESSION["username"];
		$funcList = listDisplayEvents($username); #raw info

		#bertha
		$fillInList = array(
			array(array(" "), array(" "), array(" "), array(" "), array(" "), array(" "), array(" "), array(" "), array(" "), array(" "), array(" "), array(" "), array(" "), array(" "), array(" ")),
			array(array(" "), array(" "), array(" "), array(" "), array(" "), array(" "), array(" "), array(" "), array(" "), array(" "), array(" "), array(" "), array(" "), array(" "), array(" ")),
			array(array(" "), array(" "), array(" "), array(" "), array(" "), array(" "), array(" "), array(" "), array(" "), array(" "), array(" "), array(" "), array(" "), array(" "), array(" ")),
			array(array(" "), array(" "), array(" "), array(" "), array(" "), array(" "), array(" "), array(" "), array(" "), array(" "), array(" "), array(" "), array(" "), array(" "), array(" ")),
			array(array(" "), array(" "), array(" "), array(" "), array(" "), array(" "), array(" "), array(" "), array(" "), array(" "), array(" "), array(" "), array(" "), array(" "), array(" "))
		);
		#	   8a-0		9a-1	10a-2	11a-3	  12p-4	   1p-5	   2p-6	   3p-7	   4p-8	   5p-9
		for ($day = 0; $day < sizeof($funcList); $day++) {
			$dayList = $funcList[$day];
			for ($event = 0; $event < sizeof($dayList); $event++) {
				$timeChars = "";

				$timeChars = substr($funcList[$day][$event][0], 0, 2); # str '10'
				if (strval($timeChars) == '08') {
					$timeChars = '8';
				}
				if (strval($timeChars) == '09') {
					$timeChars = '9';
				}
				$timeChars = intval($timeChars) - 8; # int 10 -> idx 2
				if ($timeChars >= 0) {
					$fillInList[$day][$timeChars] = $funcList[$day][$event];
				}
			}
		}

		$eightam = array();
		$nineam = array();
		$tenam = array();
		$elevenam = array();
		$twelvepm = array();
		$onepm = array();
		$twopm = array();
		$threepm = array();
		$fourpm = array();
		$fivepm = array();

		for ($eachDay = 0; $eachDay < 5; $eachDay++) {
			$dayArray = $fillInList[$eachDay];

			for ($eachEvent = 0; $eachEvent < 10; $eachEvent++) {
				$theEvent = $fillInList[$eachDay][$eachEvent];
				if ($theEvent != " ") {
					if ($eachEvent == 0) {
						array_push($eightam, $theEvent);
					}
					if ($eachEvent == 1) {
						array_push($nineam, $theEvent);
					}
					if ($eachEvent == 2) {
						array_push($tenam, $theEvent);
					}
					if ($eachEvent == 3) {
						array_push($elevenam, $theEvent);
					}
					if ($eachEvent == 4) {
						array_push($twelvepm, $theEvent);
					}
					if ($eachEvent == 5) {
						array_push($onepm, $theEvent);
					}
					if ($eachEvent == 6) {
						array_push($twopm, $theEvent);
					}
					if ($eachEvent == 7) {
						array_push($threepm, $theEvent);
					}
					if ($eachEvent == 8) {
						array_push($fourpm, $theEvent);
					}
					if ($eachEvent == 9) {
						array_push($fivepm, $theEvent);
					}
				} else {
					if ($eachEvent == 0) {
						array_push($eightam, " ");
					}
					if ($eachEvent == 1) {
						array_push($nineam, " ");
					}
					if ($eachEvent == 2) {
						array_push($tenam, " ");
					}
					if ($eachEvent == 3) {
						array_push($elevenam, " ");
					}
					if ($eachEvent == 4) {
						array_push($twelvepm, " ");
					}
					if ($eachEvent == 5) {
						array_push($onepm, " ");
					}
					if ($eachEvent == 6) {
						array_push($twopm, " ");
					}
					if ($eachEvent == 7) {
						array_push($threepm, " ");
					}
					if ($eachEvent == 8) {
						array_push($fourpm, " ");
					}
					if ($eachEvent == 9) {
						array_push($fivepm, " ");
					}
				}
			}
		}

		echo "<br>";

		echo "<table border='1'>";
		echo "<tr>";
		echo "<th>" . " " . "</th>";
		echo "<th>" . "Monday" . "</th>";
		echo "<th>" . "Tuesday" . "</th>";
		echo "<th>" . "Wednesday" . "</th>";
		echo "<th>" . "Thursday" . "</th>";
		echo "<th>" . "Friday" . "</th>";
		echo "</tr>";

		echo "<tr>";
		echo "<td>" . "8:00am" . "</td>";
		for ($f = 0; $f < 5; $f++) {
			//echo "Event: " . strval($eightam[$f]);
			if ($eightam[$f][0] == " ") {
				//echo "Got in here";
				echo "<td>" . strval($eightam[$f][0]) . "</td>";
			} else {
				echo "<td>" . strval($eightam[$f][2]) . "</td>";
			}
		}
		echo "</tr>";

		echo "<tr>";
		echo "<td>" . "9:00am" . "</td>";
		for ($f = 0; $f < 5; $f++) {
			//echo "Event: " . strval($nineam[$f][0]);
			if ($nineam[$f][0] == " ") {
				echo "<td>" . strval($nineam[$f][0]) . "</td>";
			} else {
				echo "<td>" . strval($nineam[$f][2]) . "</td>";
			}
		}
		echo "</tr>";

		echo "<tr>";
		echo "<td>" . "10:00am" . "</td>";
		for ($f = 0; $f < 5; $f++) {
			if ($tenam[$f][0] == " ") {
				echo "<td>" . strval($tenam[$f][0]) . "</td>";
			} else {
				echo "<td>" . strval($tenam[$f][2]) . "</td>";
			}
		}
		echo "</tr>";

		echo "<tr>";
		echo "<td>" . "11:00am" . "</td>";
		for ($f = 0; $f < 5; $f++) {
			if ($elevenam[$f][0] == " ") {
				echo "<td>" . strval($elevenam[$f][0]) . "</td>";
			} else {
				echo "<td>" . strval($elevenam[$f][2]) . "</td>";
			}
		}
		echo "</tr>";

		echo "<tr>";
		echo "<td>" . "12:00pm" . "</td>";
		for ($f = 0; $f < 5; $f++) {
			if ($twelvepm[$f][0] == " ") {
				echo "<td>" . strval($twelvepm[$f][0]) . "</td>";
			} else {
				echo "<td>" . strval($twelvepm[$f][2]) . "</td>";
			}
		}
		echo "</tr>";

		echo "<tr>";
		echo "<td>" . "1:00pm" . "</td>";
		for ($f = 0; $f < 5; $f++) {
			if ($onepm[$f][0] == " ") {
				echo "<td>" . strval($onepm[$f][0]) . "</td>";
			} else {
				echo "<td>" . strval($onepm[$f][2]) . "</td>";
			}
		}
		echo "</tr>";

		echo "<tr>";
		echo "<td>" . "2:00pm" . "</td>";
		for ($f = 0; $f < 5; $f++) {
			if ($twopm[$f][0] == " ") {
				echo "<td>" . strval($twopm[$f][0]) . "</td>";
			} else {
				echo "<td>" . strval($twopm[$f][2]) . "</td>";
			}
		}
		echo "</tr>";

		echo "<tr>";
		echo "<td>" . "3:00pm" . "</td>";
		for ($f = 0; $f < 5; $f++) {
			if ($threepm[$f][0] == " ") {
				echo "<td>" . strval($threepm[$f][0]) . "</td>";
			} else {
				echo "<td>" . strval($threepm[$f][2]) . "</td>";
			}
		}
		echo "</tr>";

		echo "<tr>";
		echo "<td>" . "4:00pm" . "</td>";
		for ($f = 0; $f < 5; $f++) {
			if ($fourpm[$f][0] == " ") {
				echo "<td>" . strval($fourpm[$f][0]) . "</td>";
			} else {
				echo "<td>" . strval($fourpm[$f][2]) . "</td>";
			}
		}
		echo "</tr>";

		echo "<tr>";
		echo "<td>" . "5:00pm" . "</td>";
		for ($f = 0; $f < 5; $f++) {
			if ($fivepm[$f][0] == " ") {
				echo "<td>" . strval($fivepm[$f][0]) . "</td>";
			} else {
				echo "<td>" . strval($fivepm[$f][2]) . "</td>";
			}
		}
		echo "</tr>";
		echo "</table>";
	}

	?>


	<h2>Change My Schedule<h2>
			<form method="GET" action="profile.php">
				<button type="submit">Profile Page</button>
			</form>
			<form method="GET" action="editSchedule.php">
				<button type="submit">Edit Schedule</button>
			</form>
			<form metho="GET" action="jobBoard.php">
				<button type="submit">Job Board</button>
			</form>
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

</body>

</html>
