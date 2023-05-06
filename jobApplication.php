<?php
require('backend/log.php');
require('backend/session.php');
require('backend/user.php');
$username = startSession();
isLoggedIn($username, 'index.php');

require('backend/connection.php');
require('backend/head.php');
require('backend/navbar.php');
?>
<!DOCTYPE html>
<html>

<head>
    <?php head("Job Application") ?>
</head>

<body>
    <?php navbar($username) ?>
    <div class="page-container">
        <div class="outlined-box">
            <?php
            $job_id = urldecode($_GET["id"]);
            // $job_serve = $conn->prepare("SELECT $job_id FROM `Jobs`");
            $query = "SELECT * FROM `Jobs`";
            $job_serve = mysqli_query($conn, $query);
            //console_log($job_info);

            $job_title = "";
            $job_professor = "";
            $job_description = "";

            // console_log($job_id);

            while ($jobs = mysqli_fetch_assoc($job_serve)) {
                // console_log($jobs);
                if ($jobs["id"] == $job_id) {
                    $job_title = $jobs["Title"];
                    $job_professor = $jobs["Professor"];
                    $job_description = $jobs["Description"];
                    break;
                }
            }
            // foreach (mysqli_fetch_assoc($job_serve) as $jobs){
            //     console_log($job_info);
            //     if ($jobs["id"] == $job_id){
            //         $job_title = $jobs["Title"];
            //         $job_professor = $jobs["Professor"];
            //         $job_description = $jobs["Description"];
            //     }
            // }            


            echo "<b>Title: </b>";
            echo $job_title;
            echo "<br>";

            echo "<b>Employer: </b>";
            echo $job_professor;
            echo "<br>";

            echo "<b>Description: </b>";
            echo $job_description;
            echo "<br>";
            echo "<br>";
            ?>

            <form method="GET" action="index.php">
                Name: <input class="login-info-box" type="text" name="application_name">
                <br>
                <br>
                Experience: <br>
                <input type="text" class="login-info-box" style="height:140px; width:300px" name="application_experience">
                <br>
                <br>
                Why you want this job: <br>
                <input type="text" class="login-info-box" style="height:140px; width:300px" name="application_reason">
                <br>
                <br>
                <input type="hidden" name="getId" value=<?php echo $job_id; ?>>
                <button type="submit" class="base-button green-button">Submit Application</button>
            </form>
        </div>
    </div>
</body>

</html>
