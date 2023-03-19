<!DOCTYPE html>
<html>

<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>TA Developers Asc., Ind Inc LLC</title>

</head>

<body>
        <?php
        /*
                Starts a session
                Starting a session stores a key on the users browser that persists until the browser is closed.
                Session variables can then be set on the server associated with the users session and can be accessed across all pages, or multiple PHP files.
                Very convenient system.
        */
        session_start();
        ?>
        <h1>TA Developers Asc., Ind Inc LLC</h1>
        <p>Hello World!</p>
        <form method="GET" action="register.php">
                <button type="submit">Register</button>
        </form>

        <form method="GET" action="login.php">
                <button type="submit">Login</button>
        </form>

        <div class="welcome-message">
                <?php
                // If user has logged in during the session, display welcome message
                if (isset($_SESSION["username"]) && !empty($_SESSION["username"])) {
                        $username = $_SESSION["username"];
                        echo "Hello, $username";
                }
                ?>
        </div>

        <?php
        error_log(print_r($_SESSION, TRUE));
        $conn = mysqli_connect("oceanus.cse.buffalo.edu:3306", "khlam", "50338576", "cse442_2023_spring_team_p_db");    // Thank you for sacrificing your user info, Kelly
        if (mysqli_connect_errno()) {
                echo "Database Status: Failed to connect: " . mysqli_connect_error();
        }
        // else {
        //         echo "Database Status: Connected, we good";
        // }
        $result = mysqli_query($conn, "SELECT * FROM UserData");
        echo "<table border='1'>
                <tr>
		<th>Username</th>
                </tr>";
        while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["Username"] . "</td>";
                echo "</tr>";
        }
        echo "</table>";
        mysqli_close($conn);
        // Sebastian: Testing that I have edit access
        ?>
</body>

</html>
