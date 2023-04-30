<?php

require("backend/log.php");
require("backend/session.php");
require("backend/user.php");
$username = startSession();
isLoggedIn($username, "index.php");

require("backend/applicationListHelper.php");
require("backend/head.php");
?>

<!DOCTYPE html>
<html>

<head>
    <?php head("Applications Received"); ?>
    <link rel="stylesheet" href="css/jobBoard.css">
</head>

<body>
    <div class="page-container">
        <h1>Applications Received</h1>
        <div id="job-board-container">
            <table id="job-table">
                <tr>
                    <th id="title">
                        Title
                    </th>
                    <th id="applicant">
                        Applicant
                    </th>
                    <th id="experiences">
                        Experiences
                    </th>
                    <th id="reason">
                        Reason
                    </th>
                </tr>
                <?php listApplications($username); ?>
            </table>
        </div>
    </div>

</body>

</html>
