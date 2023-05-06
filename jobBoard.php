<?php

require("backend/log.php");
require("backend/session.php");
require("backend/user.php");
$username = startSession();
isLoggedIn($username, "index.php");

require("backend/jobBoardHelper.php");
require("backend/head.php");
require('backend/navbar.php');
?>

<!DOCTYPE html>
<html>

<head>
    <?php head("Job Board"); ?>
    <script src="js/jobBoard.js"></script>
    <link rel="stylesheet" href="css/jobBoard.css">
</head>

<body>
    <?php navbar($username) ?>
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
        <?php showButtons(); ?>
    </div>

</body>

</html>
