<?php
require("./backend/log.php");
require("./backend/session.php");
$username = startSession();
if ($username == "") {	// If user isn't logged in go back to home page
	header("Location: index.php");
}

require("./backend/editSchedulerHelper.php");
require("./backend/head.php");


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
				<p> For time, input the hour in 24 hour time between 8:00 through 17:00</p>
				<div class="create-event-button-container">
					<button type="button" class="base-button green-button create-event-button" onclick="showCreateEvent()">Create event</button>
				</div>
				<div id="event-form-container">
					<div id="create-event-container" class="hide">
						<form method="POST" action="eventHandle.php" id="create-event-form">
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
							<input type="number" name="Time" min="8" max="17">
							<label for="Description">Description: </label>
							<input type="text" name="Description" maxlength="100">
							<div class="create-form-button-container">
								<input type="submit" class="base-button green-button" id="create-event-button" name="Create Event" value="Create Event">
							</div>
						</form>
					</div>
					<div id="edit-event-container" class="hide">
						<form method="POST" action="eventHandle.php" id="edit-event-form">
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
							<input type="number" name="Time" min="8" max="17">
							<label for="Description">Description: </label>
							<input type="text" name="Description" maxlength="100">
							<div class="edit-form-button-container">
								<input type="submit" class="base-button red-button" id="remove-button" name="Remove Event" value="Remove Event">
								<input type="submit" class="base-button green-button" id="edit-save-button" name="Save Changes" value="Save Changes">
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
