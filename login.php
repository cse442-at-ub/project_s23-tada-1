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
?>

<h2> Login Page </h2>
<form align="center" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Username: <input type="text" name="username" value="<?php echo $name;?>">
  <span class="error">* <?php echo $nameErr;?></span>
  <br><br>
  Password: <input type="password" name="password" value="<?php echo $password;?>">
  <span class="error">* <?php echo $passwordErr;?></span>
  <br><br>
  <input type="submit" name="login" value="Login">  
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["username"])) {
      $nameErr = "Name is required";
  }
  else {
      $name = clean_data($_POST["username"]);
      // check if name only contains letters and whitespace
  }

  if (empty($_POST["password"])) {
    $passwordErr = "Password is required";
  }
  else {
    // Makes the password
    $password = clean_data($_POST["password"]);
  }

  // Cheshire Database
  $conn = mysqli_connect("oceanus.cse.buffalo.edu:3306", "khlam", "50338576", "cse442_2023_spring_team_p_db");
  if (mysqli_connect_errno()){
    echo "<br>Failed to connect to MySQL: " . mysqli_connect_error();
  }
// Print out connection to the database.
  else {
    echo "<br>We connected to the database.";
  }

  // Local Database
  // $conn = mysqli_connect("localhost", "khlam", "Worldismine123**", "cse442testing");


  // Retrieve data from database
  $usernameData = "SELECT Username, Password FROM UserData";  
  $result_query = mysqli_query($conn, $usernameData);

  if (mysqli_num_rows($result_query) > 0){
    while($row = mysqli_fetch_assoc($result_query)){
      if ($row["Username"] == $name){
        if (password_verify($password, $row["Password"])) {  // Hashes inputted password and checks against saved hash
          echo "Username and password is in the database";
          header("Location: /index.php");
        }
        else{
          echo "Password is incorrect";
        }
      }
    }
  }

  // Closes the connection
  mysqli_close($conn);
}

function clean_data($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
</body>
</html>
