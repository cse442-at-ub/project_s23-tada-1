<?php
include("./backend/head.php");
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
	<?php head('Edit Your Schedule'); ?>
	<link rel="stylesheet" href="./css/editSchedule.css">
</head>

<body>
	<div class="edit-container">
		<h1>Edit Schedule</h1>

		<div class="edit-container-inner">
			<div class="edit-schedule-menu">
				<h3>Select Event</h3>
				<p> Click
					<select name="select-schedule" id="select-schedule">
						<option value="select-default">Schedule</option>
						<option value="main-schedule">Main Schedule</option>
					</select>

				<h3>Select Action</h3>
				<select name="select-action" id="select-action">
					<option value="select-default">Action</option>
					<option value="add-event">Add event</option>
					<option value="edit-event">Edit event</option>
					<option value="remove-event">Remove event</option>
				</select>
			</div>
			<div class="edit-class-list">
				<!-- Will call a function from another file to dynamically load the schedule -->
				<table class="edit-class-table">
					<tr>
						<th>My events</th>
					</tr>

					<tr>
						<td>
							<p><b>CSE 115 Recitation</b></p>
							<p>Monday 9am</p>
						</td>
					</tr>
				</table>
			</div>
		</div>
		<div class="edit-button-container">
			<a href="/mySchedule.php"><button type="button" class="edit-save-button">Save Changes</button></a>
		</div>
	</div>

</body>

</html>
