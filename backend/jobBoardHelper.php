<?php

function listJobs($username)
{
    require('backend/connection.php');

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
    while (($job = mysqli_fetch_assoc($result_query))) {
        array_push($jobs, $job);
        $title = $job["Title"];
        $professor = $job["Professor"];
        $description = $job["Description"];
        $id = urlencode($job["id"]);
        $html = <<<"EOT"
            <tr class="job-row">
                <td>
                    $title
                </td>
                <td>
                    $professor
                </td>
                <td>
                    $description
                </td>
                <td>
                    <button type="submit" class="base-button green-button" id="apply-button" onClick="apply(this)" data-id="$id">Apply</button>
                </td>
            </tr>
            EOT;
        echo $html;
    }
    console_log(json_encode($jobs));
}
