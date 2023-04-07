<?php

function listJobs($username)
{
    require('./backend/connection.php');

    $statement = $conn->prepare("SELECT * FROM `Jobs`");
    if (!$statement) {
        $error = $conn->error;
        console_log("Error on event display: $error");
        return;
    }
    $statement->execute();
    $result_query = $statement->get_result();

    if (mysqli_num_rows($result_query) <= 0) {
        echo '<tr class="job-row"><td><p>No jobs have been posted</p></td></tr>';
        return False;
    }

    $jobs = array();
    $id = 0;
    while (($job = mysqli_fetch_assoc($result_query))) {
        array_push($jobs, $event);
        // $class = $event["Class"];
        // $type = $event["Event Type"];
        // $day = $event["Day"];
        // $time = $event["Time"];
        // $html = <<<"EOT"
        //     <tr class="event-row" onclick="clickEvent(this)" data-id="$id">
        //         <td>
        //             <div class="event-container">
        //                 <p><b>$class $type</b></p>
        //                 <p>$day $time</p>
        //             </div
        //         </td>
        //     </tr>
        //     EOT;
        // echo $html;
        $id += 1;
    }
    $_SESSION["jobs"] = $jobs;
    console_log(json_encode($jobs));
}
