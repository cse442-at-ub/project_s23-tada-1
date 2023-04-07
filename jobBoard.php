<?php

require("./backend/log.php");
require("./backend/session.php");
$username = startSession();
if ($username == "") {    // If user isn't logged in go back to home page
    header("Location: index.php");
}

require("./backend/jobBoardHelper.php");
require("./backend/head.php");

?>

<!DOCTYPE html>
<html>

<head>
    <?php head("Job Board"); ?>
</head>

<body>
    <div id="job-board-container">
        <?php listJobs($username); ?>
    </div>
</body>

</html>