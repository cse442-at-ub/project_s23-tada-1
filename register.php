<!DOCTYPE HTML>
<html>

<head>
    <style>
        .error {
            color: #FF0000;
        }
    </style>
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

    <?php
    // define variables and set to empty values
    $nameErr = $emailErr = $passwordErr = "";
    $name = $email = $password = "";
    ?>

    <h2>register here !</h2>
    <p><span class="error">* required field</span></p>
    <form align="center" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        Username: <input type="text" name="username" value="<?php echo $name; ?>">
        <span class="error">* <?php echo $emailErr; ?></span>
        <br><br>
        Email: <input type="text" name="email" value="<?php echo $email; ?>">
        <span class="error">* <?php echo $emailErr; ?></span>
        <br><br>
        Password: <input type="password" name="password" value="<?php echo $password; ?>">
        <span class="error">* <?php echo $nameErr; ?></span>
        <br><br>
        <input type="submit" name="register" value="Register">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["username"])) {
            $nameErr = "Name is required";
        } else {
            $name = clean_data($_POST["username"]);
            // check if name only contains letters and whitespace
            //if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
            //    $nameErr = "Only letters and white space allowed";
            //}
        }

        if (empty($_POST["email"])) {
            $emailErr = "Email is required";
        } else {
            $email = clean_data($_POST["email"]);
            // check if e-mail address is well-formed
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format";
            }
        }

        // Checks if password was entered empty
        if (empty($_POST["password"])) {
            $passwordErr = "Password is required";
        } else {
            // Makes the password
            $password = clean_data($_POST["password"]);
            // Check password for correct length and characters
            if (test_password($password)) {
                insert_user($name, $email, $password);
                header("Location: /CSE442-542/2023-Spring/cse-442p/project_s23-tada-1/index.php");
            }
        }
    }

    function test_password($password)
    {
        //Checks if there is any uppercase, lowercase, numbers, and special characters
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);
        $specialChars = preg_match('@[^\w]@', $password);

        // If it doesn't have at every one of them, return error message
        if ($uppercase == 0 || $lowercase == 0 || $number == 0 || $specialChars == 0 || strlen($password) < 8) {
            echo 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
            return false;
        }
        return true;
    }

    function insert_user($name, $email, $password)
    {
        // Hash password
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Eventually I need to figure out how to hide my password and username from users...
        // Connect to database, error if couldn't connect
        // Cheshire Database
        $conn = mysqli_connect("oceanus.cse.buffalo.edu:3306", "khlam", "50338576", "cse442_2023_spring_team_p_db");

        // Kelly's Local MySQL Database
        //$conn = mysqli_connect("localhost", "khlam", "Worldismine123**", "cse442testing");

        if (mysqli_connect_errno()) {
            echo "<br>Failed to connect to MySQL: " . mysqli_connect_error();
        }
        // Print out connection to the database.
        else {
            echo "<br>We connected to the database.";
        }

        // Inserts it into the database. If it couldn't for some reason, it'll print out an error message
        $sql_query = "INSERT INTO UserData (Username, Email, Password) VALUES ('$name', '$email', '$hashed_password')";
        if (mysqli_query($conn, $sql_query)) {
            echo "<br>Has been added to the database!";
        } else {
            echo "Error: " . $sql_query . "" . mysqli_error($conn);
        }

        // Closes the connection
        mysqli_close($conn);
    }

    // Cleans input of html injections
    function clean_data($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }


    // Display inputted info
    echo "<h3>say it back:</h3>";
    echo $name;
    echo "<br><br>";
    echo $email;
    echo "<br><br>";
    echo "Not displaying password lol rekt";
    ?>
</body>

</html>
