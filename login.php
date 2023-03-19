<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login Page</title>
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
  $nameErr = $passwordErr = "";
  $name = $password = "";
  ?>

  <h2> Login Page </h2>
  <form align="center" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    Username: <input type="text" name="username" value="<?php echo $name; ?>">
    <span class="error">* <?php echo $nameErr; ?></span>
    <br><br>
    Password: <input type="password" name="password" value="<?php echo $password; ?>">
    <span class="error">* <?php echo $passwordErr; ?></span>
    <br><br>
    <input type="submit" name="login" value="Login">
  </form>

  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["username"])) {
      $nameErr = "Name is required";
    } else {
      $name = clean_data($_POST["username"]);
      // check if name only contains letters and whitespace
    }

    if (empty($_POST["password"])) {
      $passwordErr = "Password is required";
    } else {
      // Makes the password
      $password = clean_data($_POST["password"]);
    }

    // Cheshire Database
    $conn = mysqli_connect("oceanus.cse.buffalo.edu:3306", "khlam", "50338576", "cse442_2023_spring_team_p_db");
    if (mysqli_connect_errno()) {
      echo "<br>Failed to connect to MySQL: " . mysqli_connect_error();
    }
    // Print out connection to the database.
    // else {
    //   echo "<br>We connected to the database.\n";
    // }

    // Local Database
    // $conn = mysqli_connect("localhost", "khlam", "Worldismine123**", "cse442testing");


    // Retrieve data from database
    $userData = "SELECT Username, Password FROM UserData";
    $result_query = mysqli_query($conn, $userData);

    if (mysqli_num_rows($result_query) > 0) {
      while ($row = mysqli_fetch_assoc($result_query)) {
        if ($row["Username"] == $name && password_verify($password, $row["Password"])) {
          echo "Username and password is in the database";

          $_SESSION["username"] = $name; // Save username as session variable to be accessed on other pages
          error_log("Setting user variable");
          header("Location: /CSE442-542/2023-Spring/cse-442p/project_s23-tada-1/index.php");   // Redirect to landing page
          break;
        }
      }
      echo "Info is incorect";
    }

    // Closes the connection
    mysqli_close($conn);
  }

  function clean_data($data)
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  ?>
</body>

</html>
