<?php

require("./backend/log.php");
require("./backend/session.php");
$username = startSession();
if ($username == "") {    // If user isn't logged in go back to home page
    echo '<meta http-equiv="refresh" content="0; URL=./index.php">';
}

require("./backend/jobBoardHelper.php");
require("./backend/head.php");

?>

<!DOCTYPE html>
<html>

<head>
    <?php head("Job Board"); ?>
    <script src="./js/jobBoard.js"></script>
    <link rel="stylesheet" href="./css/jobBoard.css">
</head>

<body>
    <div class="page-container">
        <h1>Job Board</h1>
        <div id="job-board-container">
            <table id="job-table">
                <tr>
                    <th id="title">
                        Title
                    </th>
                    <th id="employer">
                        Employer
                    </th>
                    <th id="description">
                        Description
                    </th>
                    <th id="button">

                    </th>
                </tr>
                <?php listJobs($username); ?>
            </table>
        </div>
    </div>

</body>

</html>
