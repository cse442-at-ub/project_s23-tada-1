<?php
/*
	Starts a session
	Starting a session stores a key on the users browser that persists until the browser is closed.
	Session variables can then be set on the server associated with the users session and can be accessed across all pages, or multiple PHP files.
	Very convenient system.
*/
require('./backend/session.php');
$username = startSession();
if ($username == "") {	// If user isn't logged in go back to home page
	header("Location: index.php");
}
#commit message git commit -m "First try at displaying any content for the schedle
#40" -m 
require('./backend/connection.php');
require('./database/eventDisplay.php');
require('./backend/head.php');

//echo "hello";

$selectedClass = "None";
$selectedType = "None";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
	if (isset($_POST["Class"])) {
		$selectedClass = $_POST["Class"];
	}
	if (isset($_POST["Type"])) {
		$selectedType = $_POST["Type"];
	}
}

$retListDisplay = listDisplayEvents($username, $selectedClass, $selectedType); #raw info
$funcList = $retListDisplay[0];
$classes = $retListDisplay[1];
$types = $retListDisplay[2];
?>

<!DOCTYPE HTML>
<html>

<head>
	<?php head("My Schedule") ?>
	<link rel="stylesheet" type="text/css" href="css/mySchedule.css" />
	<link rel="stylesheet" type="text/css" href="css/tada.css" />
	<script src="./js/mySchedule.js"></script>
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

<body <?php echo "onload='selector(\"$selectedClass\", \"$selectedType\")'" ?>>
	<div class="page-top-view">
		<ul class="nav justify-content-center">
			<li>
				<h2 class="logo"> TADA! </h2>
			</li>
		</ul>
	</div>

	<div class="page-container">
		<div class="schedule-table-top-view">
			<div class="schedule-table-top-elements">
				<h2> My Schedule </h2>
			</div>
		</div>
		<div class="schedule-table-top-buttons">
			<form method="GET" action="editSchedule.php">
				<div class="schedule-table-top-elements"> <button type="submit" class="edit-schedule-button base-button green-button">Edit Schedule</button> </div>
			</form>
			<div class="schedule-table-top-elements"> <?php showFilters($classes, $types, $selectedClass, $selectedType); ?> </div>
		</div>
		<?php
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
				echo "<td>" . strval($eightam[$f][0]) . "</td>";
			} else {
				echo "<td>" . strval($eightam[$f][2]), "-", strval($eightam[$f][1]) . "</td>";
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
				echo "<td>" . strval($nineam[$f][2]), "-", strval($nineam[$f][1]) . "</td>";
			}
		}
		echo "</tr>";

		echo "<tr>";
		echo "<td>" . "10:00am" . "</td>";
		for ($f = 0; $f < 5; $f++) {
			if ($tenam[$f][0] == " ") {
				echo "<td>" . strval($tenam[$f][0]) . "</td>";
			} else {
				echo "<td>" . strval($tenam[$f][2]), "-", strval($tenam[$f][1]) . "</td>";
			}
		}
		echo "</tr>";

		echo "<tr>";
		echo "<td>" . "11:00am" . "</td>";
		for ($f = 0; $f < 5; $f++) {
			if ($elevenam[$f][0] == " ") {
				echo "<td>" . strval($elevenam[$f][0]) . "</td>";
			} else {
				echo "<td>" . strval($elevenam[$f][2]), "-", strval($elevenam[$f][1]) . "</td>";
			}
		}
		echo "</tr>";

		echo "<tr>";
		echo "<td>" . "12:00pm" . "</td>";
		for ($f = 0; $f < 5; $f++) {
			if ($twelvepm[$f][0] == " ") {
				echo "<td>" . strval($twelvepm[$f][0]) . "</td>";
			} else {
				echo "<td>" . strval($twelvepm[$f][2]), "-", strval($twelvepm[$f][1]) . "</td>";
			}
		}
		echo "</tr>";

		echo "<tr>";
		echo "<td>" . "1:00pm" . "</td>";
		for ($f = 0; $f < 5; $f++) {
			if ($onepm[$f][0] == " ") {
				echo "<td>" . strval($onepm[$f][0]) . "</td>";
			} else {
				echo "<td>" . strval($onepm[$f][2]), "-", strval($onepm[$f][1]) . "</td>";
			}
		}
		echo "</tr>";

		echo "<tr>";
		echo "<td>" . "2:00pm" . "</td>";
		for ($f = 0; $f < 5; $f++) {
			if ($twopm[$f][0] == " ") {
				echo "<td>" . strval($twopm[$f][0]) . "</td>";
			} else {
				echo "<td>" . strval($twopm[$f][2]), "-", strval($twopm[$f][1]) . "</td>";
			}
		}
		echo "</tr>";

		echo "<tr>";
		echo "<td>" . "3:00pm" . "</td>";
		for ($f = 0; $f < 5; $f++) {
			if ($threepm[$f][0] == " ") {
				echo "<td>" . strval($threepm[$f][0]) . "</td>";
			} else {
				echo "<td>" . strval($threepm[$f][2]), "-", strval($threepm[$f][1]) . "</td>";
			}
		}
		echo "</tr>";

		echo "<tr>";
		echo "<td>" . "4:00pm" . "</td>";
		for ($f = 0; $f < 5; $f++) {
			if ($fourpm[$f][0] == " ") {
				echo "<td>" . strval($fourpm[$f][0]) . "</td>";
			} else {
				echo "<td>" . strval($fourpm[$f][2]), "-", strval($fourpm[$f][1]) . "</td>";
			}
		}
		echo "</tr>";

		echo "<tr>";
		echo "<td>" . "5:00pm" . "</td>";
		for ($f = 0; $f < 5; $f++) {
			if ($fivepm[$f][0] == " ") {
				echo "<td>" . strval($fivepm[$f][0]) . "</td>";
			} else {
				echo "<td>" . strval($fivepm[$f][2]), "-", strval($fivepm[$f][1]) . "</td>";
			}
		}
		echo "</tr>";
		echo "</table>";

		?>

		<div class="schedule-table-bottom-view">
			<form method="GET" action="profile.php">
				<div class="schedule-table-bottom-elements"> <button class="base-button green-button" type="submit">Profile Page</button> </div>
			</form>
			<form metho="GET" action="jobBoard.php">
				<div class="schedule-table-bottom-elements"> <button class="base-button green-button" type="submit">Job Board</button> </div>
			</form>
		</div>
	</div>
</body>

</html>
