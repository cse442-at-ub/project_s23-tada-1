<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login Page</title>
</head>
<body>

<?php
$nameErr = $passwordErr = "";
$name = $password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["username"])) {
      $nameErr = "Name is required";
  }
  else {
      $name = test_input($_POST["username"]);
      // check if name only contains letters and whitespace
  }

  if (empty($_POST["password"])) {
    $passwordErr = "Password is required";
  }
  else {
    // Makes the password
    $password = test_input($_POST["password"]);

    //Checks if there is any uppercase, lowercase, numbers, and special characters
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);
    $specialChars = preg_match('@[^\w]@', $password);

    // If it doesn't have at least one of them, return error message
    if ($uppercase == 0 || $lowercase == 0 || $number == 0 || $specialChars == 0 || strlen($password) < 10){
        echo 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
    }
  }

  if (mysqli_connect_errno()){
    echo "<br>Failed to connect to MySQL: " . mysqli_connect_error();
  }
// Print out connection to the database.
  else {
    echo "<br>We connected to the database.";
  }
  // Cheshire Database
  $conn = mysqli_connect("oceanus", "khlam", "50338576", "cse442_2023_spring_team_p_db");

  // Local Database
  // $conn = mysqli_connect("localhost", "khlam", "Worldismine123**", "cse442testing");

  // Check the database
  // Local Database
  //$usernameData = "SELECT Username, Password FROM test";

  // Cheshire Database
  $usernameData = "SELECT Username, Password FROM UserData";
  $result_query = mysqli_query($conn, $usernameData);
  if (mysqli_num_rows($result_query) > 0){
    while($row = mysqli_fetch_assoc($result_query)){
      if ($row["Username"] == $name){
        if ($row["Password"] == $password){
          echo "Username and password is in the database";
        }
        else{
          echo "Only username is in the database";
        }
      }
      else{
        echo "Username and password are not in the database";
      }
    }
  }

  // Closes the connection
  mysqli_close($conn);
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>

<h2> Login Page </h2>
<form align="center" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Username: <input type="text" name="username" value="<?php echo $name;?>">
  <span class="error">* <?php echo $nameErr;?></span>
  <br><br>
  Password: <input type="text" name="password" value="<?php echo $password;?>">
  <span class="error">* <?php echo $passwordErr;?></span>
  <br><br>
  <input type="submit" name="login" value="Login">  
</form>

<?php
    echo "<center><h3>say it back:</h3></center>";
    echo $name;
    echo "<br><br>";
    echo $password;
?>

</body>
</html>