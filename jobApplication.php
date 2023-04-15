<?php
require('./backend/head.php');
?>
<!DOCTYPE html>
<html>
    <head><<?php head("Job Application")?>/head>
    <body>

        <?php
            require("./backend/log.php");
            require('./backend/connection.php');

            if ($_SERVER["REQUEST_METHOD"] === "GET") {
                if (isset($_GET["id"])) {
                    console_log($_GET["id"]);
                    // echo $_GET["id"];
                    // echo urldecode($_GET["id"]);
                    // echo $_GET["table"];
                }
            }
            // echo "Job Application Details: ";
            // echo $_GET["id"];

            $conn = mysqli_connect("oceanus.cse.buffalo.edu:3306", "khlam", "50338576", "cse442_2023_spring_team_p_db");
            
            $job_id = urldecode($_GET["id"]);
            // $job_serve = $conn->prepare("SELECT $job_id FROM `Jobs`");
            $query = "SELECT id FROM `Jobs`";
            $job_serve = mysqli_query($conn, $query);
            $job_info = mysqli_fetch_array($job_serve, MYSQLI_ASSOC);
            
            $job_title = "";
            $job_professor = "";
            $job_description = "";

            foreach ($job_info as $jobs){
                if ($jobs["id"] == $job_id){
                    $job_title = $jobs["Title"];
                    $job_professor = $jobs["Professor"];
                    $job_description = $jobs["Description"];
                }
            }            

        
            echo "Title: ";
            echo $job_title;
            echo "<br>";

            echo "Employer: ";
            echo $job_professor;
            echo "<br>";

            echo "Description: ";
            echo $job_description;
            echo "<br>";
            echo "<br>";
        ?>

        <form method="GET" action="index.php">
            Name: <input type="text" name="application_name">
            <br>
            <br>
            Experience: <br>
            <input type="text" style="height:140px; width:300px" name="application_experience">
            <br>
            <br>
            Why you want this job: <br>
            <input type="text" style="height:140px; width:300px" name="application_reason">
            <br>
            <br>
            <button type="submit" class="base-button green-button">Submit Application</button>
        </form>
    </body>
</html>