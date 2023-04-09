<!DOCTYPE HTML>
<html>

<head>
	The My Schedules Page
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
			array(array(" "), array(" "), array(" "), array(" "), array(" "),array(" "),array(" "),array(" "),array(" "),array(" "),array(" "),array(" "),array(" "),array(" "),array(" ")),
			array(array(" "), array(" "), array(" "), array(" "), array(" "),array(" "),array(" "),array(" "),array(" "),array(" "),array(" "),array(" "),array(" "),array(" "),array(" ")),
			array(array(" "), array(" "), array(" "), array(" "), array(" "),array(" "),array(" "),array(" "),array(" "),array(" "),array(" "),array(" "),array(" "),array(" "),array(" ")), 
			array(array(" "), array(" "), array(" "), array(" "), array(" "),array(" "),array(" "),array(" "),array(" "),array(" "),array(" "),array(" "),array(" "),array(" "),array(" ")), 
			array(array(" "), array(" "), array(" "), array(" "), array(" "),array(" "),array(" "),array(" "),array(" "),array(" "),array(" "),array(" "),array(" "),array(" "),array(" ")));
			#	   8a-0		9a-1	10a-2	11a-3	  12p-4	   1p-5	   2p-6	   3p-7	   4p-8	   5p-9
		for($day = 0; $day < sizeof($funcList); $day++){
			$dayList = $funcList[$day];
			for($event = 0; $event < sizeof($dayList); $event++){
				$timeChars = "";

				$timeChars = substr($funcList[$day][$event]['Time'], 0, 2); # str '10'
				if(strval($timeChars) == '08'){
					$timeChars = '8';
				}
				if(strval($timeChars) == '09'){
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

		for($eachDay = 0; $eachDay < 5; $eachDay++){
			$dayArray = $fillInList[$eachDay];

			for($eachEvent = 0; $eachEvent < 10; $eachEvent++){
				$theEvent = $fillInList[$eachDay][$eachEvent];
				if($eachEvent == 0){
					array_push($eightam, $theEvent);
				}
				if($eachEvent == 1){
					array_push($nineam, $theEvent);
				}
				if($eachEvent == 2){
					array_push($tenam, $theEvent);
				}
				if($eachEvent == 3){
					array_push($elevenam, $theEvent);
				}
				if($eachEvent == 4){
					array_push($twelvepm, $theEvent);
				}
				if($eachEvent == 5){
					array_push($onepm, $theEvent);
				}
				if($eachEvent == 6){
					array_push($twopm, $theEvent);
				}
				if($eachEvent == 7){
					array_push($threepm, $theEvent);
				}
				if($eachEvent == 8){
					array_push($fourpm, $theEvent);
				}
				if($eachEvent == 9){
					array_push($fivepm, $theEvent);
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
				echo "<td>" . strval($eightam[0]['Class']) . "</td>";
				echo "<td>" . strval($eightam[1]['Class']) . "</td>";
				echo "<td>" . strval($eightam[2]['Class']) . "</td>";
				echo "<td>" . strval($eightam[3]['Class']) . "</td>";
				echo "<td>" . strval($eightam[4]['Class']) . "</td>";
			echo "</tr>";

			echo "<tr>";
				echo "<td>" . "9:00am" . "</td>";
				echo "<td>" . strval($nineam[0]['Class']) . "</td>";
				echo "<td>" . strval($nineam[1]['Class']) . "</td>";
				echo "<td>" . strval($nineam[2]['Class']) . "</td>";
				echo "<td>" . strval($nineam[3]['Class']) . "</td>";
				echo "<td>" . strval($nineam[4]['Class']) . "</td>";
			echo "</tr>";

			echo "<tr>";
				echo "<td>" . "10:00am" . "</td>";
				echo "<td>" . strval($tenam[0]['Class']) . "</td>";
				echo "<td>" . strval($tenam[1]['Class']) . "</td>";
				echo "<td>" . strval($tenam[2]['Class']) . "</td>";
				echo "<td>" . strval($tenam[3]['Class']) . "</td>";
				echo "<td>" . strval($tenam[4]['Class']) . "</td>";
			echo "</tr>";

			echo "<tr>";
				echo "<td>" . "11:00am" . "</td>";
				echo "<td>" . strval($elevenam[0]['Class']) . "</td>";
				echo "<td>" . strval($elevenam[1]['Class']) . "</td>";
				echo "<td>" . strval($elevenam[2]['Class']) . "</td>";
				echo "<td>" . strval($elevenam[3]['Class']) . "</td>";
				echo "<td>" . strval($elevenam[4]['Class']) . "</td>";
			echo "</tr>";

			echo "<tr>";
				echo "<td>" . "12:00pm" . "</td>";
				echo "<td>" . strval($twelvepm[0]['Class']) . "</td>";
				echo "<td>" . strval($twelvepm[1]['Class']) . "</td>";
				echo "<td>" . strval($twelvepm[2]['Class']) . "</td>";
				echo "<td>" . strval($twelvepm[3]['Class']) . "</td>";
				echo "<td>" . strval($twelvepm[4]['Class']) . "</td>";
			echo "</tr>";

			echo "<tr>";
				echo "<td>" . "1:00pm" . "</td>";
				echo "<td>" . strval($onepm[0]['Class']) . "</td>";
				echo "<td>" . strval($onepm[1]['Class']) . "</td>";
				echo "<td>" . strval($onepm[2]['Class']) . "</td>";
				echo "<td>" . strval($onepm[3]['Class']) . "</td>";
				echo "<td>" . strval($onepm[4]['Class']) . "</td>";
			echo "</tr>";

			echo "<tr>";
				echo "<td>" . "2:00pm" . "</td>";
				echo "<td>" . strval($twopm[0]['Class']) . "</td>";
				echo "<td>" . strval($twopm[1]['Class']) . "</td>";
				echo "<td>" . strval($twopm[2]['Class']) . "</td>";
				echo "<td>" . strval($twopm[3]['Class']) . "</td>";
				echo "<td>" . strval($twopm[4]['Class']) . "</td>";
			echo "</tr>";

			echo "<tr>";
				echo "<td>" . "3:00pm" . "</td>";
				echo "<td>" . strval($threepm[0]['Class']) . "</td>";
				echo "<td>" . strval($threepm[1]['Class']) . "</td>";
				echo "<td>" . strval($threepm[2]['Class']) . "</td>";
				echo "<td>" . strval($threepm[3]['Class']) . "</td>";
				echo "<td>" . strval($threepm[4]['Class']) . "</td>";
			echo "</tr>";

			echo "<tr>";
				echo "<td>" . "4:00pm" . "</td>";
				echo "<td>" . strval($fourpm[0]['Class']) . "</td>";
				echo "<td>" . strval($fourpm[1]['Class']) . "</td>";
				echo "<td>" . strval($fourpm[2]['Class']) . "</td>";
				echo "<td>" . strval($fourpm[3]['Class']) . "</td>";
				echo "<td>" . strval($fourpm[4]['Class']) . "</td>";
			echo "</tr>";

			echo "<tr>";
				echo "<td>" . "5:00pm" . "</td>";
				echo "<td>" . strval($fivepm[0]['Class']) . "</td>";
				echo "<td>" . strval($fivepm[1]['Class']) . "</td>";
				echo "<td>" . strval($fivepm[2]['Class']) . "</td>";
				echo "<td>" . strval($fivepm[3]['Class']) . "</td>";
				echo "<td>" . strval($fivepm[4]['Class']) . "</td>";
			echo "</tr>";
		echo "</table>";
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
						
</body>

</html>