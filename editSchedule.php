<?php
require("./backend/head.php");
require("./backend/log.php");
require("./backend/session.php");

$username = startSession();
if ($username == "") {
	header("Location: index.php");
}

require("./backend/editSchedulerHelper.php");
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
					<button type="button" class="base-button color-button create-event-button">Create event</button>
				</div>
				<div id="event-form-container">
					<div id="create-event-container" class="">
						<form method="POST" action="mySchedule.php">
							<label for="class">Class: </label>
							<input type="text" name="class">
							<label for="type">Type: </label>
							<select name="type">
								<option value="office-hours">Office Hours</option>
								<option value="lecture">Lecture</option>
								<option value="recitation">Recitation</option>
								<option value="lab">Lab</option>
							</select>
							<label for="event-day">Day: </label>
							<select name="event-day">
								<option value="monday">Monday</option>
								<option value="tuesday">Tuesday</option>
								<option value="wednesday">Wednesday</option>
								<option value="thursday">Thursday</option>
								<option value="friday">Friday</option>
							</select>
							<label for="event-time">Start time: </label>
							<input type="time" name="event-time">
							<label for="description">Description: </label>
							<input type="text" name="description" maxlength="100">
						</form>
					</div>
					<div id="edit-event-container" class="">
						<form method="POST" action="mySchedule.php">

						</form>
					</div>
				</div>

			</div>
			<div class="edit-class-list">
				<table class="edit-class-table">
					<tr>
						<th>My events</th>
					</tr>
					<?php listEvents($username) ?>
				</table>
			</div>
		</div>
		<div class="edit-button-container">
			<a href="/mySchedule.php"><button type="button" class="base-button green-button edit-save-button">Save Changes</button></a>
			<a href="/mySchedule.php">Go back > </a>
		</div>

	</div>

</body>

</html>
