<?php

function listEvents($username)
{
    require('backend/connection.php');
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
        $class = $event["Class"];
        $type = $event["Event Type"];
        $day = $event["Day"];
        $time = $event["Time"];
        $html = <<<"EOT"
            <tr class="event-row" onclick="clickEvent(this)" data-id="$id">
                <td>
                    <div class="event-container">
                        <p><b>$class $type</b></p>
                        <p>$day $time</p>
                    </div>
                </td>
            </tr>
            EOT;
        echo $html;
        $id += 1;
    }
    $_SESSION["events"] = $events;
}
