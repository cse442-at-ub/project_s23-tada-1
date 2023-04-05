<?php

function listEvents($username)
{
    require('./backend/connection.php');
    $statement = $conn->prepare("SELECT * FROM Events where Username = (?)");
    if (!$statement) {
        $error = $conn->error;
        console_log("Error on event display: $error");
        return;
    }
    $statement->bind_param('s', $username);
    $statement->execute();
    $result_query = $statement->get_result();

    if (mysqli_num_rows($result_query) <= 0) {
        echo '<tr class="event-row"><td><p>You have no events!</p></td></tr>';
        return False;
    }

    $events = array();
    $id = 0;
    while (($event = mysqli_fetch_assoc($result_query))) {
        array_push($events, $event);
        $row = '<tr class="event-row" onclick="clickEvent(this)" data-id="' . $id . '">';
        $div = '<div class="event-container">';
        $titleLine = "<p><b>" . $event["Class"] . " " . $event["Event Type"] . "</b></p>";
        $timeLine = "<p>" . $event["Day"] . " " . $event["Time"] . "</p>";
        echo $row . '<td>' . $div . $titleLine . $timeLine . "</div></td></tr>";

        $id += 1;
    }
    console_log($events);
    $_SESSION["events"] = $events;
}

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
