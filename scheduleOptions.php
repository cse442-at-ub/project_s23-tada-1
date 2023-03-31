<?php
function displayInsert()
{
	echo '
	<form method="GET" action="schedule.php">
	Insert: <input type="text" name="insert">
	<button type="submit">Insert</button>
	</form>
    ';
}

function displayUpdate()
{
	echo '
    <form method="GET" action="schedule.php">
    Current: <input type="text" name="update_current">
    New: <input type="text" name="update_new">
    <button type="submit">Update</button>
    </form>
    ';
}

function displayRemove()
{
	echo '
	<form method="GET" action="schedule.php">
    Remove: <input type="text" name="remove">
    <button type="submit">Remove</button>
    </form>
	';
}

?>


<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Welcome</title>
</head>

<body>

	<form method="GET" action="schedule.php">
		Insert: <input type="text" name="insert">
		<button type="submit">Insert</button>
	</form>
	<br>
	<form method="GET" action="schedule.php">
		Current: <input type="text" name="update_current">
		New: <input type="text" name="update_new">
		<button type="submit">Update</button>
	</form>
	<br>
	<form method="GET" action="schedule.php">
		Remove: <input type="text" name="remove">
		<button type="submit">Remove</button>
	</form>

</body>

</html>
