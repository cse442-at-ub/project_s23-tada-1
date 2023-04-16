<?php
require('./backend/head.php');
?>
<!DOCTYPE html>
<html>
    <head><?php head("Job Application")?></head>
    <body>

        <?php
            require("./backend/log.php");
            require('./backend/connection.php');

            if ($_SERVER["REQUEST_METHOD"] === "GET") {
                if (isset($_GET["id"])) {
                    console_log($_GET["id"]);
                    //console_log("hello");
                    // echo $_GET["id"];
                    // echo urldecode($_GET["id"]);
                    // echo $_GET["table"];
                }
            }
            // echo "Job Application Details: ";
            // echo $_GET["id"];
            
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
                if ($jobs["id"] == $job_id){
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
            <input type="hidden" name="getId" value=<?php echo $job_id; ?>>
            <button type="submit" class="base-button green-button">Submit Application</button>
        </form>
    </body>
</html>