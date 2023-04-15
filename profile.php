<!DOCTYPE html>

<?php
$config = require('./backend/config.php');
require('./backend/session.php');
require('./backend/user.php');
require('./backend/log.php');
require('./backend/connection.php');

$valueUser = $valueEmail = $valueName = $valueAboutMe = $valueExp1 = $valueExp2 = "";
$valNameErr = $valEmailErr = $valPasswordErr = $valUsernameErr= "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty($_POST["username"])) {
		$ $valUsernameErr = "Username is required";
		console_log("Username not entered");
	} else {
		$valueUser = clean_data($_POST["username"]);

		// Checking for duplicate username
		$statement = $conn->prepare("SELECT * FROM UserData WHERE Username = (?)");
		$statement->bind_param('s', $username);
		$statement->execute();
		$result_query = $statement->get_result();
		console_log($result_query);
		if (mysqli_num_rows($result_query) > 0) {
			$valUsernameErr = "Username is already taken";
			$dataUser = $result_query->fetch_assoc()['Username'];
			console_log("Attempted login with existing username: $dataUser");
		}
	}

	if (empty($_POST["email"])) {
		$valEmailErr = "Email is required";
		console_log("Email not provided");
	} else {
		$valEmail = clean_data($_POST["email"]);
		// check if e-mail address is well-formed
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$valEmailErr = "Invalid email format";
			console_log("Invalid email format");
		}
	}
	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	if (empty($_POST["name"])) {
		$valNameErr = "Name is required";
	} else {
		$valName = test_input($_POST["name"]);
		// check if name only contains letters and whitespace
		if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
		  $valNameErr = "Only letters and white space allowed";
		}
	}

	if (empty($_POST["aboutMe"])) {
		$aboutMe = "";
	} else {
		$valAboutMe = test_input($_POST["aboutMe"]);
	}
	
	if (empty($_POST["exp1"])) {
		$valExp1 = "";
	} else {
		$valExp1 = test_input($_POST["exp1"]);
	}
	
	if (empty($_POST["exp2"])) {
		$valExp2 = "";
	} else {
		$valExp2 = test_input($_POST["exp2"]);
	}

	if ($nameErr == "" && $emailErr == "" && $passwordErr == "") {
		// Makes the password
		// Check password for correct length and characters
		if (insert_user($valName, $valUser, $valEmail, $password, $valAboutMe, $valExp1, $valExp2)) {
			header("Location: $config->root_dir/index.php");
		}
	}
}
?>

<h1> My Profile </h1>

<?php
    session_start();
    if (isset($_SESSION["username"]) && !empty($_SESSION["username"])) {
        $username = $_SESSION["username"];
        $query = "SELECT * FROM UserData";
        $result = $conn -> query($query);
        while ($row = $result -> fetch_assoc()){
            if ($username == $row['Username']){
                $valueUser = $row['Username'];
                // echo "Username: ". "<input type='post' value ='".$valueUser."'>";
                // echo "<br>";
                $valueEmail = $row['Email'];
                // echo "Email: ". "<input type='post' value ='".$valueEmail."'>";
                // echo "<br>";
                $valueName = $row['Name'];
                // echo "Name: ". "<input type='post' value ='".$valueName."'>";
                // echo "<br>";

                $valueAboutMe = $row['AboutMe'];
                // echo "About Me: ". "<input type='post' value ='".$valueAboutMe."'>";
                // echo "<br>";

                $valueExp1 = $row['Experience1'];
                // echo "Experience 1: ". "<input type='post' value ='".$valueExp1."'>";
                // echo "<br>";
                
                $valueExp2 = $row['Experience2'];
                // echo "Experience 2: ". "<input type='post' value ='".$valueExp2."'>";
                // echo "<br>";
            }
            
        }
    }

    $html = <<<"EOT"
        <p>Username: $valueUser</p>
        <p>Email: $valueEmail</p>
        <p>Name: $valueName</p>
        <p>About Me: $valueAboutMe</p>
        <p>Experience 1: $valueExp1</p>
        <p>Experience 2: $valueExp2</p>
        EOT;
    echo $html;
?>



</html>