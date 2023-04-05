<?php
require("./backend/head.php");
require("./backend/log.php");
require("./backend/session.php");

$username = startSession();
if ($username == "") {
	header("Location: index.php");
}

require("./backend/editSchedulerHelper.php");

$events = "";

if (isset($_GET['id'])) {
	echo $events;
}

?>

<!DOCTYPE html>
<html>

<head>
	<?php head('Edit Your Schedule'); ?>
	<link rel="stylesheet" href="./css/editSchedule.css">
	<script src="./js/editSchedule.js"></script>
</head>

<body>
	<div class="edit-container">
		<h1>Edit Schedule</h1>

		<div class="edit-container-inner">
			<div class="edit-schedule-menu">
				<p> To add a new event, press the Create Event button below. If you would like to edit or remove an existing event, click on one of your events in the list on the right.</p>
				<div class="create-event-button-container">
					<button type="button" class="base-button color-button create-event-button" onclick="showCreateEvent()">Create event</button>
				</div>
				<div id="event-form-container">
					<div id="create-event-container" class="hide">
						<form method="POST" action="mySchedule.php" id="create-event-form">
							<label for="Class">Class: </label>
							<input type="text" name="Class">
							<label for="Type">Type: </label>
							<select name="Type">
								<option value="Office Hours">Office Hours</option>
								<option value="Lecture">Lecture</option>
								<option value="Recitation">Recitation</option>
								<option value="Lab">Lab</option>
							</select>
							<label for="Day">Day: </label>
							<select name="Day">
								<option value="Monday">Monday</option>
								<option value="Tuesday">Tuesday</option>
								<option value="Wednesday">Wednesday</option>
								<option value="Thursday">Thursday</option>
								<option value="Friday">Friday</option>
							</select>
							<label for="Time">Start time: </label>
							<input type="time" name="Time">
							<label for="Description">Description: </label>
							<input type="text" name="Description" maxlength="100">
							<div class="create-form-button-container">
								<a href="/mySchedule.php"><button type="button" class="base-button green-button edit-save-button">Create Event</button></a>
							</div>
						</form>
					</div>
					<div id="edit-event-container" class="hide">
						<form method="POST" action="mySchedule.php" id="edit-event-form">
							<label for="Class">Class: </label>
							<input type="text" name="Class">
							<label for="Type">Type: </label>
							<select name="Type">
								<option value="Office Hours">Office Hours</option>
								<option value="Lecture">Lecture</option>
								<option value="Recitation">Recitation</option>
								<option value="Lab">Lab</option>
							</select>
							<label for="Day">Day: </label>
							<select name="Day">
								<option value="Monday">Monday</option>
								<option value="Tuesday">Tuesday</option>
								<option value="Wednesday">Wednesday</option>
								<option value="Thursday">Thursday</option>
								<option value="Friday">Friday</option>
							</select>
							<label for="Time">Start time: </label>
							<input type="time" name="Time">
							<label for="Description">Description: </label>
							<input type="text" name="Description" maxlength="100">
							<div class="edit-form-button-container">
								<a href="/mySchedule.php"><button type="button" class="base-button red-button remove-button">Remove Event</button></a>
								<a href="/mySchedule.php"><button type="button" class="base-button green-button edit-save-button">Save Changes</button></a>
							</div>
						</form>
					</div>
				</div>

			</div>
			<div class="edit-class-list">
				<table class="edit-class-table">
					<tr>
						<th>My events</th>
					</tr>
					<?php $events = listEvents($username) ?>
				</table>
			</div>
		</div>
		<div class="return-link">
			<a href="/mySchedule.php">Go back > </a>
		</div>

	</div>

</body>

</html>
