<?php

function listApplications($username)
{
    require('backend/connection.php');
    $statement = $conn->prepare("SELECT * FROM `Jobs` WHERE `Professor` = (?)");
    $statement->bind_param("s", $username);
    $statement->execute();
    $result_query = $statement->get_result();

    $jobs = array();
    while (($job = mysqli_fetch_assoc($result_query))) {
        $jobs[$job["id"]] = $job;
    }

    $apps = array();
    foreach ($jobs as $id => $job) {
        $statement = $conn->prepare("SELECT * FROM `JobApp` WHERE `Id` = (?)");
        $statement->bind_param("s", $id);
        $statement->execute();
        $result_query = $statement->get_result();

        while (($app = mysqli_fetch_assoc($result_query))) {
            array_push($apps, $app);
            $name = $app["Name"];
            $experience = $app["Experience"];
            $reason = $app["Reason"];
            $title = $job["Title"];

            $html = <<<"EOT"
                <tr class="job-row">
                    <td>
                        $title
                    </td>
                    <td>
                        $name
                    </td>
                    <td>
                        $experience
                    </td>
                    <td>
                        $reason
                    </td>
                </tr>
                EOT;
            echo $html;
        }
    }

    console_log(json_encode($jobs));
    console_log(json_encode($apps));
}
